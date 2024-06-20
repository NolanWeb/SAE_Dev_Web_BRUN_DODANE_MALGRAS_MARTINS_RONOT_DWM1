<?php

namespace WebDirectory\api\core\services\annuaire;
interface AnnuaireServiceInterface
{
    public function getEntryById(string $id): array;
    public function getEntries(): array;
    public function getDepartmentById(string $id): array;
    public function getDepartments(): array;
}