<?php

$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'crud_notas';


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS notes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
)";
$conn->query($sql);

FA


if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "INSERT INTO notes (title, content) VALUES ('$title', '$content')";
    $conn->query($sql);
    echo "Note created successfully!";
}


elseif (isset($_GET['read'])) {
    $sql = "SELECT * FROM notes";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Title: " . $row['title'] . "<br>";
        echo "Content: " . $row['content'] . "<br>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form><br><br>";
    }
}

elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM notes WHERE id = '$id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Title: " . $row['title'] . "<br>";
        echo "Content: " . $row['content'] . "<br><br>";
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "UPDATE notes SET title = '$title', content = '$content' WHERE id = '$id'";
    $conn->query($sql);
    echo "Note updated successfully!";
}


elseif (isset($_POST['id']) && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM notes WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Note deleted successfully!";
    } else {
        echo "Error deleting note: " . $conn->error;
    }
}


$conn->close();

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title"><br><br>
    <label for="content">Content:</label>
    <textarea id="content" name="content"></textarea><br><br>
    <input type="submit" value="Create Note">
</form>


<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?read">Read All Notes</a></p>
<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=1">Read Note 1</a></p>