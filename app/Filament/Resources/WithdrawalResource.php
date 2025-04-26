<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Withdrawal;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WithdrawalResource\Pages;
use App\Filament\Resources\WithdrawalResource\RelationManagers;
use App\Models\amount;
use App\Models\notification as ModelsNotification;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationGroup = 'Balance';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('user_id')
                            ->required()
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable(),

                        Select::make('currency_type')
                            ->options([
                                'SGD (Singapure Dollar)' => 'SGD (Singapure Dollar)',
                                'IDR (Indonesia Rupiah)' => 'IDR (Indonesia Rupiah)',
                            ])
                            ->required()
                            ->label('Currency Type'),

                        TextInput::make('pass_bank')
                            ->required()
                            ->placeholder("Ex: 123456")
                            ->label('Bank Name'),

                        TextInput::make('user_bank')
                            ->required()
                            ->placeholder("Ex: Admin")
                            ->label('User Bank'),

                        TextInput::make('bank_number')
                            ->required()
                            ->placeholder("Ex: 1234567890")
                            ->label('Bank Number'),

                        TextInput::make('fee')
                            ->required()
                            ->placeholder("Ex: 1234")
                            ->label('Fee')
                            ->default(\App\Models\setting::first()->fee)
                            ->readOnly(),

                        TextInput::make('amount_withdraw')
                            ->required()
                            ->placeholder("Ex: 1000")
                            ->label('Amount Withdrawn'),

                        Select::make('status')
                            ->options([
                                'pending' => "pending",
                                'success' => "success",
                                'failed' => "failed"
                            ])
                            ->required()
                            ->label('Status'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->label('User')->searchable(),
                TextColumn::make('currency_type'),
                TextColumn::make('pass_bank')->label("Bank Name"),
                TextColumn::make('bank_number'),
                TextColumn::make('user_bank'),
                TextColumn::make('amount_withdraw')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make("updated_at")->sortable()->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record->status === 'success' || $record->status === 'failed'),

                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'success']);

                        ModelsNotification::create([
                            'user_id' => $record->user_id,
                            'type' => 'info',
                            'title' => 'Withdraw',
                            'message' => 'Your withdraw has been approved',
                        ]);

                        amount::where('created_at', $record->created_at)
                            ->where('from_user', $record->user_id)
                            ->where('user_id', $record->user_id)
                            ->update([
                                'status' => 'success'
                            ]);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Approve Withdraw')
                    ->modalDescription('Are you sure you want to approve this withdraw? This will change the status to success.')
                    ->modalSubmitActionLabel('Yes, approve it'),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {

                        ModelsNotification::create([
                            'user_id' => $record->user_id,
                            'type' => 'error',
                            'title' => 'Withdraw',
                            'message' => 'Your withdraw has been reject!, Try again leter',
                        ]);

                        amount::create([
                            'user_id' => $record->user_id,
                            'amount' => $record->amount_withdraw,
                            'type' => 'refund',
                            'status' => 'success',
                            'from_user' => Auth::id(),
                            'noted' => "Refund of Rejected Withdrawal",
                        ]);

                        $record->update(['status' => 'failed']);

                        amount::where('created_at', $record->created_at)
                            ->where('from_user', $record->user_id)
                            ->where('user_id', $record->user_id)
                            ->update([
                                'status' => 'success'
                            ]);
                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Reject Withdraw')
                    ->modalDescription('Are you sure you want to reject this withdraw? This will change the status to success.')
                    ->modalSubmitActionLabel('Yes, reject it')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }
}
