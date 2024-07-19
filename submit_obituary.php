<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obituary_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_death = $_POST['date_of_death'];
$content = $_POST['content'];
$author = $_POST['author'];
$slug = strtolower(str_replace(' ', '-', $name));

// Handle file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
} else {
    echo "File is not an image.";
    exit;
}

// Insert data into database
$sql = "INSERT INTO obituaries (name, date_of_birth, date_of_death, content, author, slug, image)
VALUES ('$name', '$date_of_birth', '$date_of_death', '$content', '$author', '$slug', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "New obituary submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
