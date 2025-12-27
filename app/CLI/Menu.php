<?php

namespace App\CLI;

class Menu
{
    public static function main()
    {
        while (true) {
            self::showMainMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    echo "Gestion des patients (à venir)\n";
                    self::pause();
                    break;

                case '2':
                    echo "Gestion des médecins (à venir)\n";
                    self::pause();
                    break;

                case '3':
                    echo "Gestion des départements (à venir)\n";
                    self::pause();
                    break;

                case '4':
                    echo "Statistiques (à venir)\n";
                    self::pause();
                    break;

                case '5':
                    echo "Au revoir\n";
                    exit;

                default:
                    echo "Choix invalide. Réessayez.\n";
                    self::pause();
            }
        }
    }

    private static function showMainMenu()
    {
        system('clear'); 
        echo "=== Unity Care CLI ===\n";
        echo "1. Gérer les patients\n";
        echo "2. Gérer les médecins\n";
        echo "3. Gérer les départements\n";
        echo "4. Statistiques\n";
        echo "5. Quitter\n";
        echo "Votre choix: ";
    }

    private static function pause()
    {
        echo "\nAppuyez sur Entrée pour continuer...";
        fgets(STDIN);
    }
}
