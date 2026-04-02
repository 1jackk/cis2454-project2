<?php
class Faculty {
 
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM faculty");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public static function insert($pdo, $name, $email) {
        $stmt = $pdo->prepare("INSERT INTO faculty (name, email) VALUES (:name, :email)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }
 
    public static function update($pdo, $id, $name, $email){
        $stmt = $pdo->prepare("UPDATE faculty SET name = :name, email = :email WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }
 
    public static function delete($pdo, $id){
        $stmt = $pdo->prepare("DELETE FROM faculty WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
 
