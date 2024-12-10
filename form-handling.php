<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "society_website";


// PDO connection established
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error mode setting
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $position = trim($_POST['position']);
    $interest = trim($_POST['interest']);
    $society_name = isset($_POST['society_name']) ? $_POST['society_name'] : 'Unknown Society';
    $submission_time = date("Y-m-d H:i:s"); 

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO form (Full_Name, Email, Phone, Society_Name, Position, Reason, Submission_Time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //$stmt->bind_param("sssssss", $full_name, $email, $phone, $society_name, $position, $interest, $submission_time);
    
    if ($stmt->execute([$full_name, $email, $phone, $society_name, $position, $interest, $submission_time])) {
        echo "<script>alert('Application submitted successfully!');</script>";
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
