<?php

namespace WebDirectory\api\core\services\annuaire;

use WebDirectory\core\services\annuaire\AnnuaireServiceExceptionNotFound;
use WebDirectory\api\core\domain\entities\Entries;
use WebDirectory\api\core\domain\entities\Departments;

class AnnuaireService implements AnnuaireServiceInterface
{

    public function getEntries(): array
        {
            return Entries::all()->toArray();
        }

    /**
     * @throws AnnuaireServiceExceptionNotFound
     */
    public function getEntryById(string $id): array
    {
        try {
            return Entries::find($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new AnnuaireServiceExceptionNotFound($e->getMessage());
        }
    }
    public function getDepartments(): array
    {
        return Departments::all()->toArray();
    }

    public function getDepartmentById(string $id): array
    {
        try {
            return Departments::find($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new AnnuaireServiceExceptionNotFound($e->getMessage());
        }
    }
}