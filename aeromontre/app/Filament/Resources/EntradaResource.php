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

class EntradaResource extends Resource
{
    protected static ?string $model = Entrada::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Forms\Components\Select::make('componente_id')
                  //  ->relationship('componente', 'descripcion')
                    //->searchable()
                    //->live()
                    //->afterStateUpdated(fn(Set $set)=>$set('fabricante_id',null))
                    //->preload()
                    //->required(),
                Forms\Components\Select::make('component_id')
                    ->options(fn (Get $get):Collection=>Componente::query()
                    ->where ('id' , $get('componente_id'))
                    ->pluck('fabricante', 'descripcion'))
                    ->searchable()
                    ->preload()
                    ->label('Fabricante')
                    ->live()
                    ->required(),
                Forms\Components\DatePicker::make('ingreso')
                    ->required()
                    ->label('Fecha de entrada'),
                Forms\Components\TextInput::make('parte')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serie')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('asignacion')
                    ->required()
                    ->options([
                        'stock'=>'Stock',
                        'cliente'=>'Cliente',
                        'matricula'=>'Matricula']),
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
                Tables\Columns\TextColumn::make('componente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plane.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caducidad')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ingreso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parte')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asignacion')
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
