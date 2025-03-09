<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientMessageResource\Pages;
use App\Filament\Resources\ClientMessageResource\RelationManagers;
use App\Models\ClientMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ClientMessageResource extends Resource
{
    protected static ?string $model = ClientMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    protected static ?string $navigationLabel = 'Сообщения клиентов';
    
    protected static ?string $modelLabel = 'Сообщение клиента';
    
    protected static ?string $pluralModelLabel = 'Сообщения клиентов';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о клиенте')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Имя')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Телефон')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),
                
                Forms\Components\Section::make('Сообщение')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Текст сообщения')
                            ->nullable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('source')
                            ->label('Источник')
                            ->default('form')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_read')
                            ->label('Прочитано')
                            ->default(false),
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Дата прочтения')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Сообщение')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Прочитано')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('unread')
                    ->label('Непрочитанные')
                    ->query(fn (Builder $query): Builder => $query->where('is_read', false)),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Отметить как прочитанное')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (ClientMessage $record): bool => !$record->is_read)
                    ->action(fn (ClientMessage $record) => $record->markAsRead()),
                Tables\Actions\Action::make('mark_as_unread')
                    ->label('Отметить как непрочитанное')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (ClientMessage $record): bool => $record->is_read)
                    ->action(fn (ClientMessage $record) => $record->markAsUnread()),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Отметить как прочитанные')
                        ->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->markAsRead()),
                    Tables\Actions\BulkAction::make('mark_as_unread')
                        ->label('Отметить как непрочитанные')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn (Collection $records) => $records->each->markAsUnread()),
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Удалить выбранные'),
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
            'index' => Pages\ListClientMessages::route('/'),
            'create' => Pages\CreateClientMessage::route('/create'),
            'edit' => Pages\EditClientMessage::route('/{record}/edit'),
        ];
    }
}
