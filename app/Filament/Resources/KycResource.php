<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KycResource\Pages;
use App\Filament\Resources\KycResource\RelationManagers;
use App\Models\kyc;
use App\Models\notification as ModelsNotification;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KycResource extends Resource
{
    protected static ?string $model = kyc::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $label = 'Data KYC Users';

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
                            ->options(User::all()->pluck('name', 'id')) // Assuming 'email' is used for author
                            ->searchable(),

                        FileUpload::make('photo')
                            ->required()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(1024)
                            ->directory('kyc')
                            ->visibility('public'),

                        FileUpload::make('identity')
                            ->required()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(1024)
                            ->directory('kyc')
                            ->visibility('public'),

                        Select::make('status')
                            ->options([
                                'pending' => "pending",
                                'success' => "success",
                                'failed' => "failed"
                            ]),
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
                ImageColumn::make('identity')->width(50)->url(fn($record) => asset('storage/' . $record->identity)),
                ImageColumn::make('photo')->width(50)->url(fn($record) => asset('storage/' . $record->photo)),
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

                        $user = $record->user;

                        ModelsNotification::create([
                            'user_id' => $record->user_id,
                            'type' => 'info',
                            'title' => 'KYC',
                            'message' => 'Your kyc has been approved',
                        ]);

                        $record->update(['status' => 'success']);

                        if ($user) {
                            $user->email_verified_at = Carbon::now();
                            $user->save();
                        }

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Approve KYC')
                    ->modalDescription('Are you sure you want to approve this data kyc? This will change the status to success.')
                    ->modalSubmitActionLabel('Yes, approve it'),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {

                        if ($record->photo && Storage::disk('public')->exists($record->photo)) {
                            Storage::disk('public')->delete($record->photo);
                        }
                        if ($record->identity && Storage::disk('public')->exists($record->identity)) {
                            Storage::disk('public')->delete($record->identity);
                        }

                        ModelsNotification::create([
                            'user_id' => $record->user_id,
                            'type' => 'error',
                            'title' => 'KYC',
                            'message' => 'Your kyc has been reject',
                        ]);

                        $record->update(['status' => 'failed']);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Reject KYC')
                    ->modalDescription('Are you sure you want to reject this data kyc? This will change the status to success.')
                    ->modalSubmitActionLabel('Yes, reject it')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListKycs::route('/'),
            'create' => Pages\CreateKyc::route('/create'),
            'edit' => Pages\EditKyc::route('/{record}/edit'),
        ];
    }
}
