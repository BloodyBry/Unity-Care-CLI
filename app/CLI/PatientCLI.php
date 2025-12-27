<?php

namespace App\CLI;

class PatientCLI
{
    public static function menu()
    {
        while (true) {
            self::showMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    echo "Lister tous les patients (à venir)\n";
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
