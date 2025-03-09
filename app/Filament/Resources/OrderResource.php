<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Gestion';
    protected static ?string $navigationLabel = 'Commandes';
    protected static ?string $modelLabel = 'Commande';
    protected static ?string $pluralModelLabel = 'Commandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('total_amount')
                    ->label('Total de la commande')
                    ->required()
                    ->numeric()
                    ->prefix('€')
                    ->disabled(),

                Select::make('status')
                    ->options(
                        OrderStatus::selectOptions()
                    )
                    ->required(),
                Fieldset::make('Informations de l\'utilisateur')
                    ->relationship('customer')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->disabled(),
                        TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->disabled(),
                    ])
                    ->disabled(),

                Fieldset::make('Adresse de livraison')
                    ->relationship('shipping_address')
                    ->schema([
                        TextInput::make('street')
                            ->label('Rue')
                            ->columnSpanFull()
                            ->disabled()
                            ->required(),
                        TextInput::make('postcode')
                            ->label('Code postal')
                            ->disabled()
                            ->required(),
                        TextInput::make('city')
                            ->label('Ville')
                            ->disabled()
                            ->required(),
                    ])
                    ->disabled(),

                Fieldset::make('Produits')
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
                    ])
                    ->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn (OrderStatus $state) => $state->label())
                    ->badge()
                    ->color(fn (OrderStatus $state) => match($state) {
                        OrderStatus::PAID => 'success',
                        OrderStatus::READY => 'warning',
                        OrderStatus::SHIPPED => 'info',
                        OrderStatus::DELIVERED => 'gray'
                    }),
                Tables\Columns\TextColumn::make('shipping_address.city')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
