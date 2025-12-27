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
                    echo "Ajouter un patient (à venir)\n";
                    self::pause();
                    break;

                case '4':
                    echo "Modifier un patient (à venir)\n";
                    self::pause();
                    break;

                case '5':
                    echo "Supprimer un patient (à venir)\n";
                    self::pause();
                    break;

                case '6':
                    return; // go back to main menu

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

    private static function pause()
    {
        echo "\nAppuyez sur Entrée pour continuer...";
        fgets(STDIN);
    }
}