<?php
require 'db.php';

class Faculty {

    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM faculty");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($pdo, $name, $email) {
        $stmt = $pdo->prepare("INSERT INTO faculty (name, email) VALUES (:name, :email)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }

    public static function update($pdo, $id, $name, $email){
        $stmt = $pdo->prepare("UPDATE faculty SET name = :name, email = :email WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }

    public static function delete($pdo, $id){
        $stmt = $pdo->prepare("DELETE FROM faculty WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}

if (isset($_GET['delete'])) {
    Faculty::delete($pdo, $_GET['delete']);
    header("Location: faculty.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        Faculty::insert($pdo, $_POST['name'], $_POST['email']);
    }
    if (isset($_POST['update'])) {
        Faculty::update($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
    }
    header("Location: faculty.php");
    exit;
}

$faculty = Faculty::getAll($pdo);
?>
<!DOCTYPE html>
<html>
<head><title>Faculty</title></head>
<body>
<h1>Faculty</h1>
<a href="index.php">Home</a>

<h3>Add Faculty</h3>
<form method="POST">
Name: <input type="text" name="name">
Email: <input type="text" name="email">
<input type="submit" name="add" value="Add">
</form>

<h3>Update Faculty</h3>
<form method="POST">
Faculty ID: <input type="number" name="id">
Name: <input type="text" name="name">
Email: <input type="text" name="email">
<input type="submit" name="update" value="Update">
</form>

<h3>Faculty List</h3>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
<?php foreach($faculty as $f){ ?>
<tr>
    <td><?php echo $f['id']; ?></td>
    <td><?php echo $f['name']; ?></td>
    <td><?php echo $f['email']; ?></td>
    <td><a href="faculty.php?delete=<?php echo $f['id']; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
</body>
</html>
