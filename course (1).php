<?php
require 'db.php';

class Course {
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM course");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($pdo, $code, $name, $description, $credits) {
        $stmt = $pdo->prepare("INSERT INTO course (code, name, description, credits) VALUES (:code, :name, :description, :credits)");
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':credits', $credits);
        $stmt->execute();
    }

    public static function update($pdo, $code, $name, $description, $credits) {
        $stmt = $pdo->prepare("UPDATE course SET name = :name, description = :description, credits = :credits WHERE code = :code");
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':credits', $credits);
        $stmt->execute();
    }

    public static function delete($pdo, $code) {
        $stmt = $pdo->prepare("DELETE FROM course WHERE code = :code");
        $stmt->bindValue(':code', $code);
        $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        Course::insert($pdo, $_POST['code'], $_POST['name'], $_POST['description'], $_POST['credits']);
    }
    if (isset($_POST['update'])) {
        Course::update($pdo, $_POST['code'], $_POST['name'], $_POST['description'], $_POST['credits']);
    }
    header("Location: course.php");
    exit;
}

if (isset($_GET['delete'])) {
    Course::delete($pdo, $_GET['delete']);
    header("Location: course.php");
    exit;
}

$courses = Course::getAll($pdo);
?>
<!DOCTYPE html>
<html>
<head><title>Courses</title></head>
<body>
<h1>Courses</h1>
<a href="index.php">Home</a>

<h2>Add Course</h2>
<form method="POST">
    Code: <input type="text" name="code">
    Name: <input type="text" name="name">
    Description: <input type="text" name="description">
    Credits: <input type="number" name="credits">
    <input type="submit" name="add" value="Add">
</form>

<h2>Update Course</h2>
<form method="POST">
    Code: <input type="text" name="code">
    Name: <input type="text" name="name">
    Description: <input type="text" name="description">
    Credits: <input type="number" name="credits">
    <input type="submit" name="update" value="Update">
</form>

<h2>All Courses</h2>
<table border="1">
<tr><th>Code</th><th>Name</th><th>Description</th><th>Credits</th><th></th></tr>
<?php foreach ($courses as $c): ?>
<tr>
    <td><?php echo $c['code']; ?></td>
    <td><?php echo $c['name']; ?></td>
    <td><?php echo $c['description']; ?></td>
    <td><?php echo $c['credits']; ?></td>
    <td><a href="course.php?delete=<?php echo $c['code']; ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
