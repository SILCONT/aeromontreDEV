<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaneResource\Pages;
use App\Filament\Resources\PlaneResource\RelationManagers;
use App\Models\Plane;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaneResource extends Resource
{
    protected static ?string $model = Plane::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\TextInput::make('matricula')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('serie')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('fabricante')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente','nombre')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('direccion')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('rfc')
                        ->label('RFC')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('rso')
                        ->label('Razón Social')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('telefono')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\RichEditor::make('notas')
                        ->required()
                        ->maxLength(255),


                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('matricula'),
                Tables\Columns\TextColumn::make('serie'),
                Tables\Columns\TextColumn::make('fabricante'),
                Tables\Columns\TextColumn::make('cliente.nombre'),

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
            'index' => Pages\ListPlanes::route('/'),
            'create' => Pages\CreatePlane::route('/create'),
            'edit' => Pages\EditPlane::route('/{record}/edit'),
        ];
    }
}
