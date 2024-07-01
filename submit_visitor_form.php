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

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO visitors (full_name, email, phone, department, contact_person, position, id_proof, id_proof_number, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $full_name, $email, $phone, $department, $contact_person, $position, $id_proof, $id_proof_number, $gender);

// Set parameters and execute
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$contact_person = $_POST['contact_person'];
$position = $_POST['position'];
$id_proof = $_POST['id_proof'];
$id_proof_number = $_POST['id_proof_number'];
$gender = $_POST['gender'];
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
