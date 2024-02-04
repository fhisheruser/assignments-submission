<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>
<body>

<?php
$localhost = "localhost";
$username = "root";
$password = "";
$database = "contactus";

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM images");

while ($row = $result->fetch_assoc()) {
    echo '<div style="margin-bottom: 20px;">';
    echo '<a href="' . $row['path'] . '" target="_blank">';
    if (pathinfo($row['path'], PATHINFO_EXTENSION) === 'pdf') {
        echo 'View PDF';
    } else {
        echo '<img src="' . $row['path'] . '" alt="' . $row['alt'] . '" title="' . $row['title'] . '" height="100">';
    }
    echo '</a>';
    echo '</div>';
}

$conn->close();
?>

</body>
</html>

