<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "society_website";

try {
    // Create a PDO instance 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO error mode to exception 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully using PDO!";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}
// Check if form data is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password']; // User-entered password

    try {
        // Use a prepared statement to find the user by email
        $stmt = $pdo->prepare("SELECT * FROM login WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the user data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Verify the password using password_verify()
            if (password_verify($password, $row['password'])) {
                // Login successful, store user info in session
                $_SESSION['user_name'] = $row['Name'];

                // Redirect to the dashboard or home page
                header("Location: index.html");
                exit(); // Stop further execution
            } else {
                // Invalid password
                $_SESSION['error'] = "Invalid password. Please try again.";
                header("Location: society-admin-login.php");
                exit();
            }
        } else {
            // No user found with that email
            $_SESSION['error'] = "No account found with this email.";
            header("Location: society-admin-page.html");
            exit();
        }
    } catch (PDOException $e) {
        // Handle any query execution errors
        die("Error during query execution: " . $e->getMessage());
    }
}

// Close the PDO connection (optional, as it closes automatically when the script ends)
$pdo = null;

// Close the database connection
$conn->close();
?>