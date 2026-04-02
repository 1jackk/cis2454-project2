<?php
require 'db.php';

if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO course (course_name, credits) VALUES (?, ?)");
    $stmt->execute([$_POST['course_name'], $_POST['credits']]);
}

if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE course SET course_name = ?, credits = ? WHERE course_id = ?");
    $stmt->execute([$_POST['course_name'], $_POST['credits'], $_POST['course_id']]);
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM course WHERE course_id = ?");
    $stmt->execute([$_GET['delete']]);
}

$courses = $pdo->query("SELECT * FROM course")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Courses</title></head>
<body>
<h1>Courses</h1>
<a href="index.php">Home</a>

<h2>Add a Course</h2>
<form method="POST">
    Course Name: <input type="text" name="course_name">
    Credits: <input type="number" name="credits">
    <input type="submit" name="add" value="Add">
</form>

<h2>Update a Course</h2>
<form method="POST">
    Course ID: <input type="number" name="course_id">
    Course Name: <input type="text" name="course_name">
    Credits: <input type="number" name="credits">
    <input type="submit" name="update" value="Update">
</form>

<h2>All Courses</h2>
<table border="1">
    <tr><th>ID</th><th>Course Name</th><th>Credits</th><th></th></tr>
    <?php foreach ($courses as $c): ?>
    <tr>
        <td><?php echo $c['course_id']; ?></td>
        <td><?php echo $c['course_name']; ?></td>
        <td><?php echo $c['credits']; ?></td>
        <td><a href="course.php?delete=<?php echo $c['course_id']; ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
