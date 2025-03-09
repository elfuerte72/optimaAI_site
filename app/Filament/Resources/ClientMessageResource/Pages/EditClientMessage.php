<?php

namespace App\Filament\Resources\ClientMessageResource\Pages;

use App\Filament\Resources\ClientMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientMessage extends EditRecord
{
    protected static string $resource = ClientMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
