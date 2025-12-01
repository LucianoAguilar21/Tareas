<?php

namespace App\Models;

use PDO;

class Task
{
    private $conn;
    private $table = "tasks";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getTasksByUser($user_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $title, $description)
    {
        $sql = "INSERT INTO {$this->table} (user_id, title, description) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $title, $description]);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function getById($id, $user_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? AND user_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id, $user_id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $user_id]);
    }
}
