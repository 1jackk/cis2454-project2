<?php
class Section {
 
    public static function getAll($pdo){
        $stmt = $pdo->query("SELECT * FROM section");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public static function insert($pdo, $course_code, $faculty_id, $semester) {
        $stmt = $pdo->prepare("INSERT INTO section (course_code, faculty_id, semester) VALUES (:course_code, :faculty_id, :semester)");
        $stmt->bindValue(':course_code', $course_code);
        $stmt->bindValue(':faculty_id', $faculty_id);
        $stmt->bindValue(':semester', $semester);
        $stmt->execute();
    }
 
    public static function update($pdo, $id, $course_code, $faculty_id, $semester){
        $stmt = $pdo->prepare("UPDATE section SET course_code = :course_code, faculty_id = :faculty_id, semester = :semester WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':course_code', $course_code);
        $stmt->bindValue(':faculty_id', $faculty_id);
        $stmt->bindValue(':semester', $semester);
        $stmt->execute();
    }
 
    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM section WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
 
