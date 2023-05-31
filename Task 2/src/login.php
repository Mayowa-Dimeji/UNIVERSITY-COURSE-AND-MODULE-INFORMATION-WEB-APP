<?php
session_start();

// Establish database connection

try {
  $conn = new PDO("mysql:host=task2-db-1;dbname=csym019_database", "root", "csym019");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  // Retrieve username and password from the form submission
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    // Empty username or password

  } else {
    // Prepare the query to check if the username and password is in database
    $query = "SELECT * FROM User WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
      //check username and password match, user is authenticated
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      header("Location: courseSelectionForm.php");
      exit();
    } else {
      // Username and password do not match
      $error = "Invalid credentials";
    }
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage(); // catch error 

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Course Report</title>
  <link rel="stylesheet" href="../layout.css" />
</head>

<body class="loginBody">
  <header>
    <h3>CSYM019 - UNIVERSITY COURSES</h3>
  </header>

  <main>
    <div class="container">
      <h2>Welcome Page</h2>
      <form action="login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />

        <input type="submit" value="Login" />
      </form>
      <div id="error-message"><?php echo isset($error) ? $error : ''; ?></div>
    </div>
  </main>
  <footer>&copy; CSYM019 2023</footer>
</body>

</html>