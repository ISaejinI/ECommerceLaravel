<?php

namespace App\Filament\Resources;

use App\Enums\CustomerGenre;
use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Utilisateurs';
    protected static ?string $navigationLabel = 'Clients';
    protected static ?string $modelLabel = 'Client';
    protected static ?string $pluralModelLabel = 'Clients';



    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', UserRole::CUSTOMER);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Identifiant')
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse mail')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Mot de passe')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create'),
                Fieldset::make('Informations générales')
                    ->relationship('customer')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Prénom')
                            ->required(),
                        TextInput::make('last_name')
                            ->label('Nom')
                            ->required(),
                        Radio::make('genre')
                            ->options([
                                CustomerGenre::FEMALE->value => CustomerGenre::FEMALE->label(),
                                CustomerGenre::MALE->value => CustomerGenre::MALE->label(),
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->label('Numéro de téléphone')
                            ->required(),
                        DatePicker::make('birth_date')
                            ->label('Date de naissance')
                            ->required(),
                        Fieldset::make('Adresses')
                            ->schema([
                                Repeater::make('Adresses')
                                    ->relationship('addresses')
                                    ->schema([
                                        TextInput::make('street')
                                            ->label('Rue')
                                            ->columnSpanFull()
                                            ->required(),
                                        TextInput::make('postcode')
                                            ->label('Code postal')
                                            ->required(),
                                        TextInput::make('city')
                                            ->label('Ville')
                                            ->required(),
                                        Toggle::make('is_default')
                                            ->label('Adresse par défaut')
                                            ->default(false),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2),
                            ]),
                        Fieldset::make('Panier')
                            ->relationship('cart')
                            ->schema([
                                Repeater::make('Produits de la commande')
                                    ->relationship('products')
                                    ->label('')
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Nom du produit')
                                            ->disabled()
                                            ->required(),
                                        TextInput::make('quantity')
                                            ->label('Quantité')
                                            ->numeric()
                                            ->disabled()
                                            ->required(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2)
                                    ->disabled()
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
