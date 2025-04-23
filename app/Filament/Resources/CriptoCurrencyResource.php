<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriptoCurrencyResource\Pages;
use App\Models\cripto_currency;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CriptoCurrencyResource extends Resource
{
    protected static ?string $model = cripto_currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $label = 'Cripto Currency';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('currency_logo')
                            ->required()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(1024)
                            ->directory('images')
                            ->visibility('public'),
                        TextInput::make('currency_code')->maxLength(5)->required()->placeholder("Ex: BTC")->extraInputAttributes(['onChange' => 'this.value = this.value.toUpperCase()']),
                        TextInput::make('currency_name')->required()->placeholder("Ex: BITCOIN")->extraInputAttributes(['onChange' => 'this.value = this.value.toUpperCase()']),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('currency_logo')
                    ->width(50)
                    ->url(fn($record) => url('storage/' . $record->currency_logo)),
                TextColumn::make('currency_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('currency_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListCriptoCurrencies::route('/'),
            'create' => Pages\CreateCriptoCurrency::route('/create'),
            'edit' => Pages\EditCriptoCurrency::route('/{record}/edit'),
        ];
    }
}
