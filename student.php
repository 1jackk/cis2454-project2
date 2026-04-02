<?php
class Student {
 
    public static function getAll($pdo){
        $stmt = $pdo->query("SELECT * FROM student");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public static function insert($pdo, $name, $major){
        $stmt = $pdo->prepare("INSERT INTO student (name, major) VALUES (:name, :major)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':major', $major);
        $stmt->execute();
    }
 
    public static function update($pdo, $id, $name, $major){
        $stmt = $pdo->prepare("UPDATE student SET name = :name, major = :major WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':major', $major);
        $stmt->execute();
    }
 
    public static function delete($pdo, $id){
        $stmt = $pdo->prepare("DELETE FROM student WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
 
