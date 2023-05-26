<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Rest of your code for courseSelectionForm.php
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Course Report</title>
    <link rel="stylesheet" href="layout.css">
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
        <h3>Sample New Course Entry Form</h3>
        <form action="processCourse.php" method="POST">
            <div class="sketch">
                <!-- <img src="./sampleEntryForm.png" alt="New course entry form"> -->
            </div>
            <div class="addmore">
                <!-- add more fields for the remaining course info ...-->
                <label for="course_name">Course Name:</label>
                <input type="text" name="course_name" id="course_name" required />
                <label for="course_code">Course Code:</label>
                <input type="text" name="course_code" id="course_code" required />
                <!-- Add more fields for other course details -->

                <input type="submit" value="Add Course" />
                <!--input type="reset" value="Cancel" /-->
            </div>
        </form>
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>