<?php

class Database {
    private $pdo;

    public function __construct() {
        // 올바른 DSN 문자열
        $dsn = 'mysql:host=localhost;dbname=roadmapdb;charset=utf8mb4';
        $username = 'kyumin';
        $password = '1234';

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('❌ Database connection failed: ' . htmlspecialchars($e->getMessage()));
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

    // 쿼리 실행 메서드
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // 단일 결과 반환
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    // 다중 결과 반환
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
}
