<?php

namespace App\Models;

class Department
{
    private int $id;
    private string $name;
    private ?string $description;

    public function __construct(string $name, ?string $description = null, int $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    
    public static function list(): array
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM department");
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }

        $conn->close();
        return $departments;
    }

    
    public static function add(string $name, ?string $description = null): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO department (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function update(int $id, string $name, ?string $description = null): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE department SET name=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $description, $id);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $result;
    }

    
    public static function delete(int $id): bool
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM department WHERE id=?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $result;
    }



    public static function count(): int
    {
        $conn = new \mysqli('127.0.0.1', 'root', '', 'clinic_cli_oop');
        if ($conn->connect_error) {
            die("DB Error: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT COUNT(*) as total FROM department");
        $count = $result->fetch_assoc()['total'];

        $conn->close();
        return (int)$count;
    }

}
