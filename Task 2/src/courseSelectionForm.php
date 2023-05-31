<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// store database info in variables
$servername = "task2-db-1";
$username = "root";
$password = "csym019";
$dbname = "csym019_database";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //database object

if (!$conn) {
  die("Connection failed: " . $conn->errorInfo()[2]);
}

function fetchData($conn)
{
  // Retrieve all courses from the database
  $sql = "SELECT * FROM Course";
  $result = $conn->query($sql);

  $courses = array(); //declare variable


  if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $course = $row;
      $course_id = $row['course_id'];


      // Retrieve modules for the current course with course id
      $sql_modules = "SELECT * FROM Modules WHERE course_id = :course_id";
      $stmt_modules = $conn->prepare($sql_modules);
      $stmt_modules->bindParam(':course_id', $course_id);
      $stmt_modules->execute();

      $modules = array(); //modules variable
      while ($module_row = $stmt_modules->fetch(PDO::FETCH_ASSOC)) {
        $modules[] = array(
          'name' => $module_row['module_name'],
          'credit' => $module_row['credits']  //add modules object to an array
        );
      }

      $course['modules'] = $modules; //make modules  an object of the course
      $courses[] = $course; //add course to array
    }
  }

  return $courses;
}



// Check if it's an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  // Set the response header
  header('Content-Type: application/json');

  // Fetch the data and encode it as JSON
  $data = fetchData($conn);
  echo json_encode($data);
  exit();
}

// Close the connection
$conn = null;
?>



<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <h3>Course Selection</h3>
    <div class="table-container">
      <table class="firstTable" id="contents">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkAll" /></th>
            <!-- Empty header for checkboxes -->
            <th>Icon</th>
            <th>Course</th>
            <th>Level</th>
            <th></th>
            <!-- Empty header for ellipsis -->

          </tr>
        </thead>
        <tbody id="tbody" class="tbody">

        </tbody>

      </table>

      <div id="overlay">
        <div id="content">
          <div id="iconOverlay"></div>
          <div id="titleOverlay"></div>
          <div id="overviewOverlay">
            <h3>Overview</h3>
          </div>
          <div id="highlightsOverlay">
            <h3>Highlights</h3>
          </div>
          <div id="detailsOverlay">
            <h3>Course Details</h3>
          </div>
          <div id="moduleListOverlay">
            <h3>Modules</h3>
          </div>
          <div id="entryReqOverlay">
            <h3>Entry Requirements</h3>
          </div>
          <div class="case">
            <div id="fees">
              <h3>Fees & Funding</h3>
            </div>
            <select name="myselect" class="selected" id="my-select" title="myselect">
              <option value="gbp">GBP £</option>
              <option value="usd">USD $</option>
              <option value="eur">EUR €</option>
            </select>
          </div>

          <div id="faqs">
            <h4>Faqs</h4>
          </div>
        </div>
        <div class="closeBtnCase"><button id="closeBtn">Close</button></div>
      </div>
    </div>
    <form action="./sampleCourseReport.php" class="addmore" method="post">
      <input type="hidden" name="checkedOnes[]" id="checkedOnesInput" value="">
      <input type="submit" id="createReportBtn" value="Create Course Report" />
      <input type="button" id="deleteBtn" value="Delete">
    </form>
    <!-- <input type="submit" id="createReportBtn" value="Create Course Report" /> -->
  </main>
  <footer>&copy; CSYM019 2023</footer>
</body>

</html>