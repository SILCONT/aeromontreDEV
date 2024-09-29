<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntradaResource\Pages;
use App\Filament\Resources\EntradaResource\RelationManagers;
use App\Models\Componente;
use App\Models\Entrada;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;

class EntradaResource extends Resource
{
    protected static ?string $model = Entrada::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('componente_id')
                    ->relationship('componente', 'full_desc')
                    ->searchable()
                    ->live()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('ingreso')
                    ->required()
                    ->label('Fecha de entrada'),
                Forms\Components\Select::make('estado')
                    ->required()
                    ->options([
                        'Almacenado'=>'En Almacen',    //En almacen 1
                        'Utilizado'=>'Salida de Almacen'   //Salida de Almacen 0
                    ]),
                Forms\Components\TextInput::make('parte')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serie')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->default(1)
                    ->minValue(1)
                    ->maxLength(255),
                Forms\Components\Select::make('asignacion')
                    ->required()
                    ->options([
                        'Stock'=>'Stock',
                        'Cliente'=>'Cliente',
                        'Matricula'=>'Matricula']),
                Forms\Components\Select::make('cliente_id')
                    ->default(null)
                    ->relationship('cliente','nombre')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('plane_id')
                    ->label('Matricula')
                    ->relationship('plane', 'matricula')
                    ->default(null)
                    ->searchable()
                    ->preload(),

                Forms\Components\TextInput::make('ubicacion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('caducidad'),
                Forms\Components\TextInput::make('codigo')
                    ->label('Codigo de Barras:')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->label('Cant.'),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('componente.full_desc')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ingreso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('asignacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plane.matricula')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caducidad')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parte')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubicacion')
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
            RelationManagers\SalidasRelationManager::class,


        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEntradas::route('/'),
            'create' => Pages\CreateEntrada::route('/create'),
            'edit' => Pages\EditEntrada::route('/{record}/edit'),
        ];
    }
}
