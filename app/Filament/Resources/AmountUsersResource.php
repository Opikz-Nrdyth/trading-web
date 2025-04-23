<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\amount;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Collection;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AmountUsersResource\Pages;
use App\Filament\Resources\AmountUsersResource\RelationManagers;
use App\Models\notification as ModelsNotification;
use Filament\Actions\DeleteAction;

class AmountUsersResource extends Resource
{
    protected static ?string $model = amount::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Balance';
    protected static ?string $label = 'Balance Users';

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
                            ->options(User::where('role', '!=', 'Admin')->pluck('name', 'id'))
                            ->searchable(),
                        Select::make('from_user')
                            ->required()
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable(),
                        TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->placeholder("ex: 100")->default(0)
                            ->label("Amount (IDR)")->required()->minValue(1),
                        Select::make('type')
                            ->options([
                                "bonus" => "bonus",
                                "transfer" => "transfer",
                                "topup" => "topup",
                                "profits"=>"profits",
                            ])->label("Type Air Drop")->default("bonus"),
                        Select::make('status')
                            ->options([
                                "pending" => "pending",
                                "success" => "success",
                            ]),

                        RichEditor::make('noted')->placeholder('Enter the noted'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')->label("Amount (SGD)"),
                TextColumn::make('type'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('userFrom.name')
                    ->label('From')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make("updated_at")->sortable()->dateTime()
            ])
            ->filters([

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'pending',
                        'success' => 'success',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

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
                            'title' => 'Balance',
                            'message' => 'Your balance has been approved',
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Approve Transaction')
                    ->modalDescription('Are you sure you want to approve this transaction? This will change the status to success.')
                    ->modalSubmitActionLabel('Yes, approve it')
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
            'index' => Pages\ListAmountUsers::route('/'),
            'create' => Pages\CreateAmountUsers::route('/create'),
            'edit' => Pages\EditAmountUsers::route('/{record}/edit'),
        ];
    }
}
