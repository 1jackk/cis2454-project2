<?php
require 'db.php';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['add'])){
        Student::insert($pdo, $_POST['name'], $_POST['major']);
    }
    if (isset($_POST['update'])){
        Student::update($pdo, $_POST['id'], $_POST['name'], $_POST['major']);
    }
    header("Location: student.php");
    exit;
}

if (isset($_GET['delete'])){
    Student::delete($pdo, $_GET['delete']);
    header("Location: student.php");
    exit;
}

$students = Student::getAll($pdo);
?>
<!DOCTYPE html>
<html>
<head><title>Students</title></head>
<body>
<h1>Students</h1>
<a href="index.php">Home</a>

<h2>Add Student</h2>
<form method="POST">
    Name: <input type="text" name="name"><br>
    Major: <input type="text" name="major"><br>
    <button name="add">Add</button>
</form>

<h2>Update Student</h2>
<form method="POST">
    Student ID: <input type="number" name="id"><br>
    Name: <input type="text" name="name"><br>
    Major: <input type="text" name="major"><br>
    <button name="update">Update</button>
</form>

<h2>Students</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Major</th><th></th></tr>
<?php foreach($students as $s): ?>
<tr>
    <td><?= $s['id'] ?></td>
    <td><?= $s['name'] ?></td>
    <td><?= $s['major'] ?></td>
    <td><a href="student.php?delete=<?= $s['id'] ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
