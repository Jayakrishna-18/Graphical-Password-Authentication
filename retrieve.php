<html>
<head>
    <title>Retrieving Files</title>
    <link rel="stylesheet" href="retrieve.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM files";
$result = $conn->query($sql);
echo "<header><h1>Saved Files:</h1></header>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='savedfiles'>
        <a href='" . $row['file_path'] . " ' target='_parent' >" . $row['file_name'] . "</a><br>
        </div>";
    }
} else {
    echo "<div class='container'>
    <center><h3>No files found.</h3></center>
    </div>";
}
$conn->close();
?>
</body>
</html>

