<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\package;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PackageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PackageResource\RelationManagers;

class PackageResource extends Resource
{
    protected static ?string $model = package::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Investment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('plan')->placeholder("Ex: Basic")->required()->unique(ignorable: fn($record) => $record),
                        TextInput::make('min_amount')->placeholder("Ex: 1000")->required(),
                        TextInput::make('max_amount')->placeholder("Ex: 10000")->required(),
                        TextInput::make('min_contract')->placeholder("Ex: 1")->required(),
                        TextInput::make('max_contract')->placeholder("Ex: 1")->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plan')->sortable()->searchable(),
                TextColumn::make('min_amount')->sortable(),
                TextColumn::make('max_amount')->sortable(),
                TextColumn::make('min_contract')->sortable(),
                TextColumn::make('max_contract')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make("updated_at")->sortable()->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
