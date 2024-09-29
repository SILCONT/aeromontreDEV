<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalidaResource\Pages;
use App\Filament\Resources\SalidaResource\RelationManagers;
use App\Models\Salida;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalidaResource extends Resource
{
    protected static ?string $model = Salida::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('entrada_id')
                    ->label('Codigo de barras')
                    ->relationship('entrada', 'codigo')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Receptor')
                    ->required(),
                Forms\Components\DatePicker::make('fechasalida')
                    ->label('Fecha de Salida')
                    ->required(),
                Forms\Components\TextInput::make('matricula')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->minValue(1)
                    ->default(1)
                    ->numeric(),
                Forms\Components\Select::make('destino')
                    ->required()
                    ->default(null)
                    ->options([
                        'Discrepancia'=>'Discrepancia',
                        'Orden'=>'Orden',
                        'Cliente'=>'Cliente',
                        'Prestamo'=>'Prestamo',
                        'Scrap'=>'Scrap']),
                Forms\Components\TextInput::make('discrepancia')
                        ->maxLength(255),
                Forms\Components\TextInput::make('orden')
                        ->maxLength(255),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entrada.codigo')
                    ->label('Codigo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fechasalida')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matricula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discrepancia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orden')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListSalidas::route('/'),
            'create' => Pages\CreateSalida::route('/create'),
            'edit' => Pages\EditSalida::route('/{record}/edit'),
        ];
    }
}
