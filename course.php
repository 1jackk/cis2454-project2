<?php
class Course {
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM course");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public static function insert($pdo, $code, $name, $description, $credits) {
        $stmt = $pdo->prepare("INSERT INTO course (code, name, description, credits) VALUES (:code, :name, :description, :credits)");
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':credits', $credits);
        $stmt->execute();
    }
 
    public static function update($pdo, $code, $name, $description, $credits) {
        $stmt = $pdo->prepare("UPDATE course SET name = :name, description = :description, credits = :credits WHERE code = :code");
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':credits', $credits);
        $stmt->execute();
    }
 
    public static function delete($pdo, $code) {
        $stmt = $pdo->prepare("DELETE FROM course WHERE code = :code");
        $stmt->bindValue(':code', $code);
        $stmt->execute();
    }
}
 
