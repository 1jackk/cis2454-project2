<?php
require 'db.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM faculty WHERE faculty_id = ?");
    $stmt->execute([$_GET['delete']]);
}

if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO faculty (first_name, last_name, department) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['department']]);
}

if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE faculty SET first_name = ?, last_name = ?, department = ? WHERE faculty_id = ?");
    $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['department'], $_POST['faculty_id']]);
}

$faculty = $pdo->query("SELECT * FROM faculty")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Faculty</title></head>
<body>
<h1>Faculty</h1>
<a href="index.php">Home</a>

<h3>Add Faculty</h3>
<form method="POST">
First Name: <input type="text" name="first_name">
Last Name: <input type="text" name="last_name">
Department: <input type="text" name="department">
<button name="add">Add</button>
</form>

<h3>Update Faculty</h3>
<form method="POST">
Faculty ID: <input type="number" name="faculty_id">
First Name: <input type="text" name="first_name">
Last Name: <input type="text" name="last_name">
Department: <input type="text" name="department">
<button name="update">Update</button>
</form>

<h3>Faculty List</h3>
<table border="1">
<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Department</th><th>Actions</th></tr>
<?php foreach($faculty as $f): ?>
<tr>
    <td><?php echo $f['faculty_id']; ?></td>
    <td><?php echo $f['first_name']; ?></td>
    <td><?php echo $f['last_name']; ?></td>
    <td><?php echo $f['department']; ?></td>
    <td><a href="faculty.php?delete=<?php echo $f['faculty_id']; ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
