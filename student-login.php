<?php
  // Start session to track the user
  session_start();
  if (isset($_SESSION['error'])) {
      echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']); // Clear the error after displaying
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
  <header>
    <div class="logo">
      <img src="https://paf-iast.edu.pk/wp-content/uploads/2024/06/PAFIASTLOGOPNGFinal.png" 
      width="300" 
      height="70" 
      alt="University Logo">
    </div>

    <nav>
      <ul>
        <li><a href="/index.html">Home</a></li>
        <li><a href="student-login.php">Login</a></li>
        <li><a href="student-signup.php">Sign Up</a></li>
        <li><a href="admin-login.php">Admin Login</a></li>
      </ul>
    </nav>
  </header>

  <main class="login-page">
    <div class="login-form-container">
      <h2>Login With Your Official Email To Join</h2>
      <form action="login-handler.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2024 University Clubs</p>
  </footer>
</body>
</html>

