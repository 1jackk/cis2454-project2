<?php
require 'db.php';

if (isset($_GET['delete'])){
    $stmt = $pdo->prepare("DELETE FROM enrollment WHERE enrollment_id = ?");
    $stmt->execute([$_GET['delete']]);
}

if (isset($_POST['add'])){
    $stmt = $pdo->prepare("INSERT INTO enrollment (student_id, section_id, grade) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['student_id'], $_POST['section_id'], $_POST['grade']]);
}

if (isset($_POST['update'])){
    $stmt = $pdo->prepare("UPDATE enrollment SET student_id = ?, section_id = ?, grade = ? WHERE enrollment_id = ?");
    $stmt->execute([$_POST['student_id'], $_POST['section_id'], $_POST['grade'], $_POST['enrollment_id']]);
}

$enrollments = $pdo->query("SELECT * FROM enrollment")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Enrollment</title></head>
<body>
<h1>Enrollment</h1>
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
    Enrollment ID: <input type="number" name="enrollment_id">
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
    <td><?php echo $e['enrollment_id']; ?></td>
    <td><?php echo $e['student_id']; ?></td>
    <td><?php echo $e['section_id']; ?></td>
    <td><?php echo $e['grade']; ?></td>
    <td><a href="enrollment.php?delete=<?php echo $e['enrollment_id']; ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
