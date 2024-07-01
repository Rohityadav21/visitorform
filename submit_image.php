<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "visitor_management"; // Updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageData = $_POST['imageData'];
    $full_name = $_POST['full_name'];

    // Decode the image data
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);

    // Save the image
    $imagePath = 'uploads/' . $full_name . '.png';
    file_put_contents($imagePath, $image);

    // Store the image path in the database
    $sql = "UPDATE visitors SET image_path='$imagePath' WHERE full_name='$full_name'";

    if ($conn->query($sql) === TRUE) {
        header("Location: confirmation.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
