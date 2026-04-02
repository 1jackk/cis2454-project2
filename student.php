<?php
require 'db.php';

if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO student (first_name, last_name, email) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email']]);
}
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE student SET first_name = ?, last_name = ?, email = ? WHERE student_id = ?");
    $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['student_id']]);
}
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM student WHERE student_id = ?");
    $stmt->execute([$_GET['delete']]);
}

$students = $pdo->query("SELECT * FROM student")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Students</title></head>
<body>
<h1>Students</h1>
<a href="index.php">Home</a>

<h2>Add Student</h2>
<form method="POST">
    First Name: <input type="text" name="first_name"><br>
    Last Name: <input type="text" name="last_name"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" name="add" value="Add Student">
</form>

<h2>Update Student</h2>
<form method="POST">
    Student ID: <input type="number" name="student_id"><br>
    First Name: <input type="text" name="first_name"><br>
    Last Name: <input type="text" name="last_name"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" name="update" value="Update Student">
</form>

<h2>Students</h2>
<table border="1">
<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th></th></tr>
<?php foreach ($students as $s): ?>
<tr>
    <td><?= $s['student_id'] ?></td>
    <td><?= $s['first_name'] ?></td>
    <td><?= $s['last_name'] ?></td>
    <td><?= $s['email'] ?></td>
    <td><a href="student.php?delete=<?= $s['student_id'] ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
