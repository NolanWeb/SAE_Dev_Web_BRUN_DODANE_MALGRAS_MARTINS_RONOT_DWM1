<?php

namespace WebDirectory\admin\core\services\annuaire;

use WebDirectory\admin\core\domain\entities\Admins;
use WebDirectory\admin\core\domain\entities\Departments;
use WebDirectory\admin\core\domain\entities\Entries;
use WebDirectory\admin\core\services\annuaire\AnnuaireServiceInterface;
use WebDirectory\core\services\annuaire\AnnuaireServiceExceptionNotFound;
use Illuminate\Database\Capsule\Manager as DB;

class AnnuaireService implements AnnuaireServiceInterface
{
    /**
     * @throws AnnuaireServiceExceptionNotFound
     */
    public function getEntries(): array
    {
        try {
            return Entries::all()->toArray();
        } catch (\WebDirectory\admin\core\services\annuaire\AnnuaireServiceExceptionNotFound $e) {
            throw new AnnuaireServiceExceptionNotFound($e->getMessage());
        }
    }

    public function getDepartments(): array
    {
        return Departments::all()->toArray();
    }

    public function getEntriesByDepartment(string $departmentId): array
    {
        $department = Departments::find($departmentId);
        if (!$department) {
            throw new AnnuaireServiceExceptionNotFound('Le département demandé n\'existe pas.');
        }
        return $department->entries()->get()->toArray();
    }

    public function createEntry(array $data): array
    {
        $entry = new Entries();
        $entry->firstName = $data['firstName'];
        $entry->lastName = $data['lastName'];
        $entry->email = $data['email'];
        $entry->phone = $data['phone'];
        $entry->address = $data['address'];
        $entry->department = $data['department'];
        $entry->description = $data['description'];

        // Générer un UUID pour le nom du fichier
        $uuid4 = \Ramsey\Uuid\Uuid::uuid4();
        $fileName = $uuid4->toString() . '.png';

        // Vérifier si le dossier 'files' existe et est accessible en écriture
        $targetDirectory = __DIR__ . '/../../../files/';
        if (!is_dir($targetDirectory) || !is_writable($targetDirectory)) {
            if (!is_dir($targetDirectory)) {
                throw new \Exception('Le dossier "files" n\'existe pas.');
            } else if (!is_writable($targetDirectory)) {
                throw new \Exception('Le dossier "files" n\'est pas accessible en écriture.');
            }
        }

        // Vérifier si le fichier a été correctement téléchargé
        if ($data['pp']->getError() !== UPLOAD_ERR_OK) {
            throw new \Exception('Le fichier n\'a pas été correctement téléchargé.');
        }

        $targetFile = $targetDirectory . $fileName;

        // Vérifier si le dossier 'files' existe et est accessible en écriture
        if (!is_dir($targetDirectory) || !is_writable($targetDirectory)) {
            throw new \Exception('Le dossier "files" n\'existe pas ou n\'est pas accessible en écriture.');
        }

        $data['pp']->moveTo($targetFile);

        // Enregistrer le nom du fichier dans la base de données
        $entry->pp = $uuid4;

        $entry->save();

        // Ajouter l'association dans la table entry2departments
        $this->addEntryToDepartment($entry->id, $data['department']);

        return $entry->toArray();
    }

    public function addEntryToDepartment(string $entryId, string $departmentId): void
    {
        DB::table('entry2departments')->insert([
            'entry_id' => $entryId,
            'department_id' => $departmentId
        ]);
    }

    public function createDepartement(array $data): array
    {
        $department = new Departments();
        $department->name = $data['name'];
        $department->stage = $data['stage'];
        $department->description = $data['description'];

        $department->save();
        return $department->toArray();
    }

    public function auth(array $data): array
    {
        // Vérifier si l'utilisateur existe dans la base de données et si le mot de passe est correct
        $admin = Admins::where('mail', $data['mail'])->first();
        print $admin;
        if ($admin === null || !password_verify($data['password'], $admin->password)) {
            print $data['password'];
            throw new \Exception('L\'adresse e-mail ou le mot de passe est incorrect.');
        }
        if (password_verify($data['password'], $admin->password)) {
            print($data['password']);
        }
        // Créer une session pour l'utilisateur
        $_SESSION['auth'] = $admin->toArray();
        return $admin->toArray();
    }
}