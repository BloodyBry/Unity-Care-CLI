<?php

namespace App\CLI;

require_once __DIR__ . '/../Models/Department.php';

use App\Models\Department;

class DepartmentCLI
{
    public static function menu()
    {
        while (true) {
            self::showMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1': // List
                    $departments = Department::list();
                    if (empty($departments)) {
                        echo "No departments found.\n";
                    } else {
                        echo "=== Departments List ===\n";
                        foreach ($departments as $d) {
                            echo "[{$d['id']}] {$d['name']} | {$d['description']}\n";
                        }
                    }
                    self::pause();
                    break;

                case '2': // Add
                    echo "Department Name: ";
                    $name = trim(fgets(STDIN));
                    echo "Description: ";
                    $desc = trim(fgets(STDIN));
                    Department::add($name, $desc);
                    echo "Department added!\n";
                    self::pause();
                    break;

                case '3': // Update
                    echo "Enter Department ID to update: ";
                    $id = (int)trim(fgets(STDIN));
                    echo "New Name: ";
                    $name = trim(fgets(STDIN));
                    echo "New Description: ";
                    $desc = trim(fgets(STDIN));
                    Department::update($id, $name, $desc);
                    echo "Department updated!\n";
                    self::pause();
                    break;

                case '4': // Delete
                    echo "Enter Department ID to delete: ";
                    $id = (int)trim(fgets(STDIN));
                    Department::delete($id);
                    echo "Department deleted!\n";
                    self::pause();
                    break;

                case '5':
                    return; // Back to main menu

                default:
                    echo "Invalid choice. Try again.\n";
                    self::pause();
            }
        }
    }

    private static function showMenu()
    {
        system('clear');
        echo "=== Department Management ===\n";
        echo "1. List all departments\n";
        echo "2. Add department\n";
        echo "3. Update department\n";
        echo "4. Delete department\n";
        echo "5. Back\n";
        echo "Your choice: ";
    }

    private static function pause()
    {
        echo "\nPress Enter to continue...";
        fgets(STDIN);
    }
}
