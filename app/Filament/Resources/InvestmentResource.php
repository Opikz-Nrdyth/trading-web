<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\investment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InvestmentResource\Pages;
use App\Filament\Resources\InvestmentResource\RelationManagers;
use App\Models\notification as ModelsNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;

class InvestmentResource extends Resource
{
    protected static ?string $model = investment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Investment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('invoice')->placeholder("ex: 1000 (SGD)")->required()->default(function () {
                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            $length = 20; // panjang string acak yang diinginkan
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        })->readOnly()->required(),
                        Select::make('user_id')
                            ->required()
                            ->options(User::all()->pluck('name', 'id')) // Assuming 'email' is used for author
                            ->searchable(),

                        Select::make('package')
                            ->required()
                            ->options(
                                [
                                    "basic" => "basic",
                                    "bronze" => "bronze",
                                    "silver" => "silver",
                                    "gold" => "gold",
                                    "platinum" => "platinum",
                                    "diamond" => "diamond",
                                    "crown" => "crown"
                                ]
                            ),
                        TextInput::make('amount')->label("Amount (SGD)")->placeholder("ex: 1000 (SGD)")->required(),
                        Select::make('status')
                            ->options([
                                "success" => "success",
                                "canceled" => "canceled",
                                "pending" => "pending"
                            ])->default("success"),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice'),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('package')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        "basic" => "gray",
                        "bronze" => "warning",
                        "silver" => "secondary",
                        "gold" => "warning",
                        "platinum" => "primary",
                        "diamond" => "info",
                        "crown" => "success",
                        default => 'gray',
                    }),
                TextColumn::make('amount'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'canceled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make("updated_at")->sortable()->dateTime()
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'Admin' => 'Admin',
                        'User' => 'User',
                    ]),
                SelectFilter::make('package')
                    ->options([
                        "basic" => "basic",
                        "bronze" => "bronze",
                        "silver" => "silver",
                        "gold" => "gold",
                        "platinum" => "platinum",
                        "diamond" => "diamond",
                        "crown" => "crown"
                    ]),
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
                            'title' => 'Investment',
                            'message' => 'Your investment has been approved',
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Approve Investment')
                    ->modalDescription('Are you sure you want to approve this investment? This will change the status to success.')
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
                            'title' => 'Investment',
                            'message' => 'Your investment has been reject!, Try again leter',
                        ]);

                        $record->update(['status' => 'failed']);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Reject Investment')
                    ->modalDescription('Are you sure you want to reject this investment? This will change the status to success.')
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
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestment::route('/create'),
            'edit' => Pages\EditInvestment::route('/{record}/edit'),
        ];
    }
}
