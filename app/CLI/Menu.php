<?php

// namespace App\CLI;
namespace App\CLI;

// Include the CLI files
require_once __DIR__ . '/PatientCLI.php';
require_once __DIR__ . '/DoctorCLI.php';
require_once __DIR__ . '/DepartmentCLI.php';

// Include the Models
require_once __DIR__ . '/../Models/Patient.php';
require_once __DIR__ . '/../Models/Doctor.php';
require_once __DIR__ . '/../Models/Department.php';

use App\CLI\PatientCLI;
use App\CLI\DoctorCLI;
use App\CLI\DepartmentCLI;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Department;

class Menu
{
    public static function main()
    {
        while (true) {
            self::showMainMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    require_once __DIR__ . '/PatientCLI.php';
                    \App\CLI\PatientCLI::menu();
                    break;

                case '2':
                    require_once __DIR__ . '/DoctorCLI.php';
                    \App\CLI\DoctorCLI::menu();
                    break;


                case '3':
                    require_once __DIR__ . '/DepartmentCLI.php';
                    \App\CLI\DepartmentCLI::menu();
                    break;


                case '4':
                    echo "=== Statistics ===\n";
                    echo "Total Patients: " . \App\Models\Patient::count() . "\n";
                    echo "Total Doctors: " . \App\Models\Doctor::count() . "\n";
                    echo "Total Departments: " . \App\Models\Department::count() . "\n";
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