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

// Retrieve data from database
$sql = "SELECT * FROM obituaries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Obituaries</h1><table border='1'>
    <tr><th>Name</th><th>Date of Birth</th><th>Date of Death</th><th>Content</th><th>Author</th><th>Submission Date</th><th>Image</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['date_of_birth']}</td>
        <td>{$row['date_of_death']}</td>
        <td>{$row['content']}</td>
        <td>{$row['author']}</td>
        <td>{$row['submission_date']}</td>
        <td><img src='{$row['image']}' alt='{$row['name']}' width='100'></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
