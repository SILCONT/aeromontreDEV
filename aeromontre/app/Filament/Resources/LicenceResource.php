<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenceResource\Pages;
use App\Filament\Resources\LicenceResource\RelationManagers;
use App\Models\Licence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicenceResource extends Resource
{
    protected static ?string $model = Licence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('catalog_id')
                    ->relationship('catalog', 'description')
                    ->required(),
                Forms\Components\TextInput::make('lic_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('issued')
                    ->required(),
                Forms\Components\DatePicker::make('expiration')
                    ->required(),
                Forms\Components\FileUpload::make('img_url')
                    ->image()
                    ->imageEditor()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('catalog.description')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lic_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issued')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('img_url')
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
            'index' => Pages\ListLicences::route('/'),
            'create' => Pages\CreateLicence::route('/create'),
            'edit' => Pages\EditLicence::route('/{record}/edit'),
        ];
    }
}
