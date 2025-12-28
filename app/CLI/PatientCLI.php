<?php

namespace App\CLI;

require_once __DIR__ . '/../Models/Patient.php';

use App\Models\Patient;

class PatientCLI
{
    public static function menu()
    {
        while (true) {
            self::showMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    require_once __DIR__ . '/../Models/Patient.php';

                    $patients = \App\Models\Patient::list();

                    if (empty($patients)) {
                        echo "Aucun patient trouvé.\n";
                    } else {
                        echo "=== Liste des Patients ===\n";
                        foreach ($patients as $p) {
                            echo "[{$p['id']}] {$p['firstName']} {$p['lastName']} | {$p['email']} | {$p['phone']} | Dept: {$p['departmentId']}\n";
                        }
                    }

                    self::pause();
                    break;



                case '2':
                    echo "Rechercher un patient (à venir)\n";
                    self::pause();
                    break;

                case '3':
                    self::addPatient();
                    break;

                case '4':
                    self::updatePatient();
                    break;


                case '5':
                    self::deletePatient();
                    break;


                case '6':
                    return;

                default:
                    echo "Choix invalide. Réessayez.\n";
                    self::pause();
            }
        }
    }

    private static function showMenu()
    {
        system('clear');
        echo "=== Gestion des Patients ===\n";
        echo "1. Lister tous les patients\n";
        echo "2. Rechercher un patient\n";
        echo "3. Ajouter un patient\n";
        echo "4. Modifier un patient\n";
        echo "5. Supprimer un patient\n";
        echo "6. Retour\n";
        echo "Votre choix: ";
    }


    private static function addPatient()
    {
        system('clear');
        echo "=== Ajouter un Patient ===\n";

        echo "First name: ";
        $firstName = trim(fgets(STDIN));

        echo "Last name: ";
        $lastName = trim(fgets(STDIN));

        echo "Email: ";
        $email = trim(fgets(STDIN));

        echo "Phone: ";
        $phone = trim(fgets(STDIN));

        echo "Department ID: ";
        $departmentId = (int) trim(fgets(STDIN));

        $patient = new Patient(
            $firstName,
            $lastName,
            $email,
            $phone,
            $departmentId
        );

        if ($patient->add()) {
            echo "\nPatient added successfully!\n";
        } else {
            echo "\nError adding patient.\n";
        }

        self::pause();
    }

    private static function updatePatient()
    {
        system('clear');
        echo "=== Modifier un Patient ===\n";

        echo "Patient ID: ";
        $id = (int) trim(fgets(STDIN));

        $data = Patient::findById($id);

        if (!$data) {
            echo "\nPatient not found.\n";
            self::pause();
            return;
        }

        echo "First name ({$data['firstName']}): ";
        $firstName = trim(fgets(STDIN));
        $firstName = $firstName !== '' ? $firstName : $data['firstName'];

        echo "Last name ({$data['lastName']}): ";
        $lastName = trim(fgets(STDIN));
        $lastName = $lastName !== '' ? $lastName : $data['lastName'];

        echo "Email ({$data['email']}): ";
        $email = trim(fgets(STDIN));
        $email = $email !== '' ? $email : $data['email'];

        echo "Phone ({$data['phone']}): ";
        $phone = trim(fgets(STDIN));
        $phone = $phone !== '' ? $phone : $data['phone'];

        echo "Department ID ({$data['departmentId']}): ";
        $deptInput = trim(fgets(STDIN));
        $departmentId = $deptInput !== '' ? (int)$deptInput : (int)$data['departmentId'];

        $patient = new Patient(
            $firstName,
            $lastName,
            $email,
            $phone,
            $departmentId,
            $id
        );

        if ($patient->update()) {
            echo "\nPatient updated successfully!\n";
        } else {
            echo "\nUpdate failed.\n";
        }

        self::pause();
    }

    private static function deletePatient()
    {
        system('clear');
        echo "=== Supprimer un Patient ===\n";

        echo "Patient ID: ";
        $id = (int) trim(fgets(STDIN));

        $data = Patient::findById($id);

        if (!$data) {
            echo "\nPatient not found.\n";
            self::pause();
            return;
        }

        echo "\nPatient: {$data['firstName']} {$data['lastName']}\n";
        echo "Are you sure? (y/n): ";
        $confirm = strtolower(trim(fgets(STDIN)));

        if ($confirm !== 'y') {
            echo "\nDelete cancelled.\n";
            self::pause();
            return;
        }

        $patient = new Patient(
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['departmentId'],
            $id
        );

        if ($patient->delete()) {
            echo "\nPatient deleted successfully!\n";
        } else {
            echo "\nDelete failed.\n";
        }

        self::pause();
    }




    private static function pause()
    {
        echo "\nAppuyez sur Entrée pour continuer...";
        fgets(STDIN);
    }
}