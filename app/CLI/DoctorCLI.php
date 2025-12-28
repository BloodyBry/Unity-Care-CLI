<?php

namespace App\CLI;

use App\Models\Doctor;

require_once __DIR__ . '/../Models/Doctor.php';

class DoctorCLI
{
    public static function menu()
    {
        while (true) {
            system('clear');
            echo "=== Gestion des Médecins ===\n";
            echo "1. Lister les médecins\n";
            echo "2. Ajouter un médecin\n";
            echo "3. Modifier un médecin\n";
            echo "4. Supprimer un médecin\n";
            echo "5. Retour\n";
            echo "Votre choix: ";

            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    self::listDoctors();
                    break;
                case '2':
                    self::addDoctor();
                    break;
                case '3':
                    self::updateDoctor();
                    break;
                case '4':
                    self::deleteDoctor();
                    break;
                case '5':
                    return;
                default:
                    echo "Invalid choice\n";
                    fgets(STDIN);
            }
        }
    }

    private static function listDoctors()
    {
        $doctors = Doctor::list();

        if (empty($doctors)) {
            echo "\nNo doctors found.\n";
            fgets(STDIN);
            return;
        }

        echo "\n=== Doctors List ===\n";

        foreach ($doctors as $d) {
            echo "----------------------------\n";
            echo "ID          : {$d['id']}\n";
            echo "Name        : {$d['firstName']} {$d['lastName']}\n";
            echo "Email       : {$d['email']}\n";
            echo "Phone       : {$d['phone']}\n";
            echo "Specialty   : {$d['specialty']}\n";
            echo "Start Year  : {$d['startYear']}\n";
            echo "Department  : {$d['departmentId']}\n";
        }

        echo "----------------------------\n";
        echo "Press Enter to continue...";
        fgets(STDIN);
    }


    private static function addDoctor()
    {
        echo "First name: "; $fn = trim(fgets(STDIN));
        echo "Last name: ";  $ln = trim(fgets(STDIN));
        echo "Email: ";      $email = trim(fgets(STDIN));
        echo "Phone: ";      $phone = trim(fgets(STDIN));
        echo "Specialty: ";  $spec = trim(fgets(STDIN));
        echo "Start year: "; $year = (int) trim(fgets(STDIN));
        echo "Department ID: "; $dept = (int) trim(fgets(STDIN));

        $doctor = new Doctor($fn, $ln, $email, $phone, $spec, $year, $dept);

        echo $doctor->add()
            ? "\nDoctor added successfully\n"
            : "\nError adding doctor\n";

        fgets(STDIN);
    }

    private static function updateDoctor()
    {
        echo "Doctor ID: ";
        $id = (int) trim(fgets(STDIN));

        $data = Doctor::findById($id);
        if (!$data) {
            echo "Doctor not found\n";
            fgets(STDIN);
            return;
        }

        echo "First name ({$data['firstName']}): "; $fn = trim(fgets(STDIN)) ?: $data['firstName'];
        echo "Last name ({$data['lastName']}): ";  $ln = trim(fgets(STDIN)) ?: $data['lastName'];
        echo "Email ({$data['email']}): ";         $email = trim(fgets(STDIN)) ?: $data['email'];
        echo "Phone ({$data['phone']}): ";         $phone = trim(fgets(STDIN)) ?: $data['phone'];
        echo "Specialty ({$data['specialty']}): "; $spec = trim(fgets(STDIN)) ?: $data['specialty'];
        echo "Start year ({$data['startYear']}): ";$year = trim(fgets(STDIN)) ?: $data['startYear'];
        echo "Department ID ({$data['departmentId']}): "; $dept = trim(fgets(STDIN)) ?: $data['departmentId'];

        $doctor = new Doctor($fn, $ln, $email, $phone, $spec, (int)$year, (int)$dept, $id);

        echo $doctor->update()
            ? "\nDoctor updated\n"
            : "\nUpdate failed\n";

        fgets(STDIN);
    }

    private static function deleteDoctor()
    {
        echo "Doctor ID: ";
        $id = (int) trim(fgets(STDIN));

        $doctor = new Doctor('', '', null, null, '', 0, 0, $id);

        echo $doctor->delete()
            ? "\nDoctor deleted\n"
            : "\nDelete failed\n";

        fgets(STDIN);
    }
}
