<?php

namespace App\Repositories;

use App\Database;
use PDO;

class LoanRepository
{

    public function __construct(private DataBase $database)
    {

    }

    public function getAll($sum, $dataCreate)
    {
        $pdo = $this->database->getConnection();
        if (isset($dataCreate) && isset($sum)) {
            $sql = 'SELECT * FROM loans WHERE sum = :sum and created_at = :created_at';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':sum', $sum);
            $stmt->bindValue(':created_at', $dataCreate);
        } elseif (isset($dataCreate)) {
            $sql = 'SELECT * FROM loans WHERE created_at = :created_at';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':created_at', $dataCreate);
        } elseif (isset($sum)) {
            $sql = 'SELECT * FROM loans WHERE sum = :sum';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':sum', $sum);
        } else {
            $sql = 'SELECT * FROM loans';
            $stmt = $pdo->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM loans WHERE id = :id';
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($dataFromBody)
    {
        $sql = 'INSERT INTO loans (sum) VALUES (:sum)';
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sum', $dataFromBody['sum'], PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update($dataFromBody, $id)
    {

        $sql = 'UPDATE loans SET sum = :sum WHERE id = :id';
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sum', $dataFromBody['sum'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = 'DELETE from loans WHERE id = :id';
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}