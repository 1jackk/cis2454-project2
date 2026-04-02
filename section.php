<?php
require 'db.php';

if(isset($_POST['add'])){
    $stmt = $pdo->prepare("INSERT INTO section (course_id, faculty_id, semester) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['course_id'], $_POST['faculty_id'], $_POST['semester']]);
}

if(isset($_POST['update'])){
    $stmt = $pdo->prepare("UPDATE section SET course_id = ?, faculty_id = ?, semester = ? WHERE section_id = ?");
    $stmt->execute([$_POST['course_id'], $_POST['faculty_id'], $_POST['semester'], $_POST['section_id']]);
}

if(isset($_GET['delete'])){
    $stmt = $pdo->prepare("DELETE FROM section WHERE section_id = ?");
    $stmt->execute([$_GET['delete']]);
}

$sections = $pdo->query("SELECT * FROM section")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Sections</title></head>
<body>
<h1>Sections</h1>
<a href="index.php">Home</a>

<h2>Add Section</h2>
<form method="POST">
Course ID: <input type="number" name="course_id">
Faculty ID: <input type="number" name="faculty_id">
Semester: <input type="text" name="semester">
<button name="add">Add</button>
</form>

<h2>Update Section</h2>
<form method="POST">
Section ID: <input type="number" name="section_id">
Course ID: <input type="number" name="course_id">
Faculty ID: <input type="number" name="faculty_id">
Semester: <input type="text" name="semester">
<button name="update">Update</button>
</form>

<h2>All Sections</h2>
<table border="1">
<tr><th>Section ID</th><th>Course ID</th><th>Faculty ID</th><th>Semester</th><th></th></tr>
<?php foreach($sections as $s){ ?>
<tr>
    <td><?php echo $s['section_id']; ?></td>
    <td><?php echo $s['course_id']; ?></td>
    <td><?php echo $s['faculty_id']; ?></td>
    <td><?php echo $s['semester']; ?></td>
    <td><a href="section.php?delete=<?php echo $s['section_id']; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
</body>
</html>
