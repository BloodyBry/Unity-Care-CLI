<?php

namespace App\Models;

require_once __DIR__ . '/Personne.php';

class Patient extends Personne
{
    private int $departmentId;

    public function __construct(
        string $firstName,
        string $lastName,
        ?string $email,
        ?string $phone,
        int $departmentId,
        int $id = 0
    ) {
        parent::__construct($firstName, $lastName, $email, $phone, $id);
        $this->departmentId = $departmentId;
    }

    /**
     * Lister tous les patients (CRUD - READ)
     */
    public static function list(): array
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        if ($conn->connect_error) {
            die("Erreur DB: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM patient");
        $patients = [];

        while ($row = $result->fetch_assoc()) {
            $patients[] = $row;
        }

        $conn->close();
        return $patients;
    }
}
