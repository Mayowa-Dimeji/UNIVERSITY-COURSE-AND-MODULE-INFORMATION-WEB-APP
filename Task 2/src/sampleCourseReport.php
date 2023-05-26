<?php
session_start();

if (isset($_SESSION['courses'])) {
  $courses = $_SESSION['courses'];
}
// print_r($courses[0]);
// Now you can use $courses in this PHP file
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Course Report</title>
  <link rel="stylesheet" href="layout.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
  <main>
    <h3>Sample Course Reoprt</h3>

    <canvas style="width:100%" id="myChart"></canvas>


    <div class="barOne">

    </div>
  </main>
  <footer>&copy; CSYM019 2023</footer>
</body>

</html>