<html>
<head>
    <link rel="stylesheet" href="home.css">
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

if (isset($_POST['submit'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    if ($fileError === 0) {
        $uploadPath = "uploads/" . $fileName;
        move_uploaded_file($fileTmpName, $uploadPath);

        $sql = "INSERT INTO files (file_name, file_path) VALUES ('$fileName', '$uploadPath')";
        if ($conn->query($sql) === TRUE) {
            echo "
            <div class='container'>
            <h1 id='head'>File uploaded successfully.<h1>
            <center><img src='https://th.bing.com/th/id/R.779b9dc3928c2dbc304bcf6702bef6df?rik=YcBZULcBaENJ%2bA&riu=http%3a%2f%2fwww.clipartbest.com%2fcliparts%2fxig%2f67a%2fxig67ak5T.gif&ehk=nEkxZPycTq5aonhibetdIGtbEyVfNPMLT0nhCiz1DSg%3d&risl=&pid=ImgRaw&r=0' width='200px'></center>
            <p id='head'>You can now access your saved files:</p> 
            <center><a  href='retrieve.php' class='head'>Access Here</a></center>
            </div>";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
</body>
</html>
