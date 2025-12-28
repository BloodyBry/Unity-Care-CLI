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


    public static function findById(int $id): ?array
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM patient WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $patient ?: null;
    }


    public function add(): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');

        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare(
            "INSERT INTO patient (firstName, lastName, email, phone, departmentId)
            VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssi",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phone,
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

        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare(
            "UPDATE patient 
            SET firstName = ?, lastName = ?, email = ?, phone = ?, departmentId = ?
            WHERE id = ?"
        );

        $stmt->bind_param(
            "ssssii",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phone,
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

        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM patient WHERE id = ?");
        $stmt->bind_param("i", $this->id);

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }



    public static function count(): int
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT COUNT(*) as total FROM patient");
        $count = $result->fetch_assoc()['total'];

        $conn->close();
        return (int)$count;
    }



}
