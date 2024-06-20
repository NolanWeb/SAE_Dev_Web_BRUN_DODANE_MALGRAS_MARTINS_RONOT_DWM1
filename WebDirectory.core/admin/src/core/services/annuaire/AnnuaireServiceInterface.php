<?php

namespace WebDirectory\admin\core\services\annuaire;
interface AnnuaireServiceInterface
{
    public function getEntries(): array;
    public function getDepartments(): array;
    public function getEntriesByDepartment(string $departmentId): array;
    public function createEntry(array $data): array;
    public function addEntryToDepartment(string $entryId, string $departmentId): void;
    public function createDepartement(array $data): array;
    public function auth(array $data): array;
}