<?php

namespace App\Models;

require_once __DIR__ . '/Personne.php';

class Doctor extends Personne
{
    private string $specialty;
    private int $startYear;
    private int $departmentId;

    public function __construct(
        string $firstName,
        string $lastName,
        ?string $email,
        ?string $phone,
        string $specialty,
        int $startYear,
        int $departmentId,
        int $id = 0
    ) {
        parent::__construct($firstName, $lastName, $email, $phone, $id);
        $this->specialty = $specialty;
        $this->startYear = $startYear;
        $this->departmentId = $departmentId;
    }

    public static function list(): array
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        $result = $conn->query("SELECT * FROM doctor");

        $doctors = [];
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }

        $conn->close();
        return $doctors;
    }

    public static function findById(int $id): ?array
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        $stmt = $conn->prepare("SELECT * FROM doctor WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $doctor ?: null;
    }



    public function add(): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        $stmt = $conn->prepare(
            "INSERT INTO doctor (firstName, lastName, email, phone, specialty, startYear, departmentId)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssiii",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phone,
            $this->specialty,
            $this->startYear,
            $this->departmentId
        );

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }


    public function update(): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        $stmt = $conn->prepare(
            "UPDATE doctor
             SET firstName=?, lastName=?, email=?, phone=?, specialty=?, startYear=?, departmentId=?
             WHERE id=?"
        );

        $stmt->bind_param(
            "ssssiiii",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phone,
            $this->specialty,
            $this->startYear,
            $this->departmentId,
            $this->id
        );

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }


    public function delete(): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        $stmt = $conn->prepare("DELETE FROM doctor WHERE id = ?");
        $stmt->bind_param("i", $this->id);

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }
}
