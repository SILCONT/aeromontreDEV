<?php

namespace App\Filament\Resources\EntradaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalidasRelationManager extends RelationManager
{
    protected static string $relationship = 'salidas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fechasalida')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fechasalida')
            ->columns([
                Tables\Columns\TextColumn::make('fechasalida'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('cantidad'),
                Tables\Columns\TextColumn::make('orden'),
                Tables\Columns\TextColumn::make('matricula'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
