<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\news;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;

class NewsResource extends Resource
{
    protected static ?string $model = news::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->required()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(1024)
                            ->directory('news')
                            ->visibility('public'),
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255),
                        Select::make('author')
                            ->label('Author')
                            ->required()
                            ->options(User::all()->pluck('name', 'id'))
                            ->default(function () {
                                return User::where('id', 1)->orWhere('name', 'Admin')->value('id');
                            })
                            ->searchable(),

                        Select::make('status')
                            ->options([
                                "publish" => "publish",
                                "pending" => "pending",
                            ])->default("publish"),
                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_news')->width(50)->defaultImageUrl(fn($record) => asset(config('services.storage_public') . $record->thumbnail)),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'publish' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'publish']);

                        Notification::make()
                            ->success()
                            ->title('Status updated successfully')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Publish News')
                    ->modalDescription('Are you sure you want to publish this News? This will change the status to publish.')
                    ->modalSubmitActionLabel('Yes, publish it')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
