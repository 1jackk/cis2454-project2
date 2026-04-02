<?php
require 'db.php';

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

if (isset($_GET['delete'])) {
    Enrollment::delete($pdo, $_GET['delete']);
    header("Location: enrollment.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['add'])){
        Enrollment::insert($pdo, $_POST['student_id'], $_POST['section_id'], $_POST['grade']);
    }
    if(isset($_POST['update'])){
        Enrollment::update($pdo, $_POST['id'], $_POST['student_id'], $_POST['section_id'], $_POST['grade']);
    }
    header("Location: enrollment.php");
    exit;
}

$enrollments = Enrollment::getAll($pdo);
?>
<!DOCTYPE html>
<html>
<head><title>Enrollments</title></head>
<body>
<h1>Enrollments</h1>
<p><a href="index.php">Back to Home</a></p>

<h2>Add Enrollment</h2>
<form method="POST">
    Student ID: <input type="number" name="student_id">
    Section ID: <input type="number" name="section_id">
    Grade: <input type="text" name="grade">
    <input type="submit" name="add" value="Add">
</form>

<h2>Update Enrollment</h2>
<form method="POST">
    Enrollment ID: <input type="number" name="id">
    Student ID: <input type="number" name="student_id">
    Section ID: <input type="number" name="section_id">
    Grade: <input type="text" name="grade">
    <input type="submit" name="update" value="Update">
</form>

<h2>Enrollments</h2>
<table border="1">
<tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Section ID</th>
    <th>Grade</th>
    <th>Action</th>
</tr>
<?php foreach ($enrollments as $e): ?>
<tr>
    <td><?php echo $e['id']; ?></td>
    <td><?php echo $e['student_id']; ?></td>
    <td><?php echo $e['section_id']; ?></td>
    <td><?php echo $e['grade']; ?></td>
    <td><a href="enrollment.php?delete=<?php echo $e['id']; ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
