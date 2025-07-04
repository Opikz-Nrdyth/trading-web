<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\userData;
use App\Models\currency;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DateTimePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Support\Facades\FilamentExport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use NumberFormatter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder("ex: John Doe"),
                        TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->placeholder("ex: john.doe@example.com")
                            ->unique(ignorable: fn($record) => $record),
                        Select::make('role')
                            ->label('Role')
                            ->default('User')
                            ->required()
                            ->options([
                                'User' => 'User',
                                'Admin' => 'Admin',
                            ]),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn($component, $get, $livewire, $model, $record, $state) => $record === null)
                            ->maxLength(255)
                            ->revealable()
                            ->placeholder("ex: John!Doe123")
                            ->minLength(8)
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record) {
                                    $component->state($record->password_view);
                                }
                            }),
                        TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->required()
                            ->revealable()
                            ->same('password')
                            ->minLength(8)
                            ->placeholder("Confirm your password")
                            ->afterStateUpdated(function ($state, $get) {
                                $password = $get('password');
                                if ($password && $password !== $state) {
                                    Notification::make()
                                        ->title('Password tidak cocok')
                                        ->danger()
                                        ->send();
                                }
                            })
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record) {
                                    $component->state($record->password_view);
                                }
                            })
                    ])->columns(2),

                Section::make('Additional Information')
                    ->schema([
                        TextInput::make('userData.username')
                            ->label('Username')
                            ->required()
                            ->maxLength(255)
                            ->placeholder("ex: john_doe")
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->username);
                                }
                            }),
                        TextInput::make('userData.address')
                            ->label('Address')
                            ->maxLength(255)
                            ->placeholder("ex: 123 Main St")
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->address);
                                }
                            }),
                        Select::make('userData.country')
                            ->label('Country')
                            ->searchable()
                            ->options(function () {
                                return Currency::query()
                                    ->pluck('country', 'country') // key dan value sama
                                    ->unique()
                                    ->toArray();
                            })
                            ->default(fn() => Currency::first()?->country)
                            ->afterStateHydrated(function (Select $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->country);
                                }
                            }),
                        TextInput::make('userData.phone_number')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(15)
                            ->placeholder("ex: 081234567890")
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->phone_number);
                                }
                            }),
                        TextInput::make('userData.bitcoin_address')
                            ->label('Bitcoin Address')
                            ->nullable()
                            ->maxLength(255)
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->bitcoin_address);
                                }
                            }),
                        TextInput::make('userData.bank_number')
                            ->label('Bank Number')
                            ->nullable()
                            ->maxLength(50)
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->bank_number);
                                }
                            }),

                        TextInput::make('userData.bank_name')
                            ->label('Bank Name')
                            ->nullable()
                            ->maxLength(50)
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->bank_number);
                                }
                            }),

                        TextInput::make('userData.members')
                            ->label('Members')
                            ->default(0)
                            ->maxLength(255)
                            ->placeholder("ex: 100")
                            ->afterStateHydrated(function (TextInput $component, $state, $record) {
                                if ($record && $record->userData) {
                                    $component->state($record->userData->members);
                                }
                            }),
                        Select::make('userData.type_currency')
                            ->label('Type Currency')
                            ->searchable()
                            ->options(fn() => Currency::all()->pluck('currency_name', 'currency_code')->toArray())
                            ->default(fn() => Currency::first()?->currency_code)
                            ->afterStateHydrated(function (Select $component, $state, $record) {
                                if ($record && $record->userData && $record->userData->type_currency) {
                                    $component->state($record->userData->type_currency);
                                } elseif (blank($state)) {
                                    // Jika create dan belum ada state, isi dengan default pertama
                                    $component->state(Currency::first()?->currency_code);
                                }
                            }),


                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        function getCurrency($amount)
        {
            $dataCurrency = Cache::get('data_currency', []);
            $currencyType = Auth::user()->userData->type_currency ? Auth::user()->userData->type_currency : "IDR";
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            return str_replace(
                ',00',
                '',
                $formatter->formatCurrency(round(intval($amount) * $dataCurrency['idr'][strtolower($currencyType)], 4), $currencyType)
            );
        }
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Admin' => 'danger',
                        'User' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('userAmount.sum_amount')
                    ->label('Balance')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        $successAmount = $record->userAmount()
                            ->where('status', 'success')
                            ->sum('amount') ?? 0;

                        $pendingNegativeAmount = $record->userAmount()
                            ->where('status', 'pending')
                            ->where('amount', '<', 0)
                            ->sum('amount') ?? 0;

                        $amount = $successAmount + $pendingNegativeAmount;
                        if ($amount < 0 || $amount == -0) {
                            $amount = 0;
                        }
                        return $amount;
                    })
                    ->formatStateUsing(function ($state) {
                        return getCurrency($state); // Gunakan fungsi kustom
                    }),

                TextColumn::make('userData.members')
                    ->label('Members')
                    ->default(0)
                    ->sortable(),

                TextColumn::make('userData.username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('userData.country')
                    ->label('Country')
                    ->searchable(),

                TextColumn::make('userData.phone_number')
                    ->label('Phone Number')
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->label('Verification')
                    ->sortable()->dateTime()
                    ->placeholder("Not Verification"),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make("updated_at")->sortable()->dateTime()
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'Admin' => 'Admin',
                        'User' => 'User',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
