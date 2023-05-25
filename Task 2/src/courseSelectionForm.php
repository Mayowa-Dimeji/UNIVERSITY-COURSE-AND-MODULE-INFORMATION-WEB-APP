<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Assuming you have a database connection established
$servername = "task2-db-1";
$username = "root";
$password = "csym019";
$dbname = "csym019_assignment";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if (!$conn) {
  die("Connection failed: " . $conn->errorInfo()[2]);
}

// Retrieve course titles from the database
$sql = "SELECT course_id, iconPath, title, level FROM Course";
$result = $conn->query($sql);

$courses = array();

if ($result->rowCount() > 0) {
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $courses[] = $row;
  }
}


$conn = null;

?>

<!DOCTYPE html>
<html>

<head>
  <title>Course Report</title>
  <link rel="stylesheet" href="layout.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="course.js"></script>
</head>

<body class="body">
  <header>
    <h3>CSYM019 - UNIVERSITY COURSES</h3>
  </header>
  <nav>
    <ul>
      <li><a href="./courseSelectionForm.php">Course Report</a></li>
      <li><a href="./newCourse.php">New Course</a></li>
    </ul>
  </nav>
  <main class="main">
    <h3>Sample Course Selection Form</h3>
    <div class="sketch">
      <table class="firstTable">
        <thead>
          <tr>
            <th></th>
            <!-- Empty header for checkboxes -->
            <th>Icon</th>
            <th>Course Title</th>
            <th>Level</th>
            <th></th>
            <!-- Empty header for ellipsis -->
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $course) : ?>
            <tr>
              <td><input type="checkbox" id="course<?php echo $course['id']; ?>" /></td>
              <td><img src="<?php echo  $course['iconPath']; ?>" alt="Course Icon" /></td>
              <td><?php echo $course['title']; ?></td>
              <td><?php echo $course['level']; ?></td>
              <td>
                <button class="show-more">...</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
    <form action="./sampleReport.png" class="addmore">

      <p class="blueNote">
        You can click on the button below to view a sketch of the report you
        are expected to develop.
      </p>
      <input type="submit" value="Create Course Report" />
    </form>
  </main>
  <footer>&copy; CSYM019 2023</footer>
</body>

</html>