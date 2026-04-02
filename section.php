<?php
require 'db.php';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        Section::insert($pdo, $_POST['course_code'], $_POST['faculty_id'], $_POST['semester']);
    }
    if (isset($_POST['update'])){
        Section::update($pdo, $_POST['id'], $_POST['course_code'], $_POST['faculty_id'], $_POST['semester']);
    }
    header("Location: section.php");
    exit;
}

if (isset($_GET['delete'])){
    Section::delete($pdo, $_GET['delete']);
    header("Location: section.php");
    exit;
}

$sections = Section::getAll($pdo);
?>
<!DOCTYPE html>
<html>
<head><title>Sections</title></head>
<body>
<h1>Sections</h1>
<a href="index.php">Home</a>

<h2>Add a Section</h2>
<form method="POST">
    Course Code: <input type="text" name="course_code">
    Faculty ID: <input type="number" name="faculty_id">
    Semester: <input type="text" name="semester">
    <button name="add">Add</button>
</form>

<h2>Update a Section</h2>
<form method="POST">
    Section ID: <input type="number" name="id">
    Course Code: <input type="text" name="course_code">
    Faculty ID: <input type="number" name="faculty_id">
    Semester: <input type="text" name="semester">
    <button name="update">Update</button>
</form>

<h2>All Sections</h2>
<table border="1">
<tr><th>ID</th><th>Course Code</th><th>Faculty ID</th><th>Semester</th><th></th></tr>
<?php foreach ($sections as $s): ?>
<tr>
    <td><?php echo $s['id']; ?></td>
    <td><?php echo $s['course_code']; ?></td>
    <td><?php echo $s['faculty_id']; ?></td>
    <td><?php echo $s['semester']; ?></td>
    <td><a href="section.php?delete=<?php echo $s['id']; ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
