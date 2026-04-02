<?php
class Enrollment {
 
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM enrollment");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public static function insert($pdo, $student_id, $section_id, $grade){
        $stmt = $pdo->prepare("INSERT INTO enrollment (student_id, section_id, grade) VALUES (:student_id, :section_id, :grade)");
        $stmt->bindValue(':student_id', $student_id);
        $stmt->bindValue(':section_id', $section_id);
        $stmt->bindValue(':grade', $grade);
        $stmt->execute();
    }
 
    public static function update($pdo, $id, $student_id, $section_id, $grade) {
        $stmt = $pdo->prepare("UPDATE enrollment SET student_id = :student_id, section_id = :section_id, grade = :grade WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':student_id', $student_id);
        $stmt->bindValue(':section_id', $section_id);
        $stmt->bindValue(':grade', $grade);
        $stmt->execute();
    }
 
    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM enrollment WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
