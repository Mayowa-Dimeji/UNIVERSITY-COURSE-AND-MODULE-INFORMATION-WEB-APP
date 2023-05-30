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

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $selectedCheckboxes = json_decode($_POST['delete'], true);

    foreach ($selectedCheckboxes as $checkbox) {
        $courseId = $checkbox['courseId'];

        // Delete course from the database
        $sql_delete_course = "DELETE FROM Course WHERE course_id = :course_id";
        $stmt_delete_course = $conn->prepare($sql_delete_course);
        $stmt_delete_course->bindParam(':course_id', $courseId);
        $stmt_delete_course->execute();

        // Delete modules related to the course
        $sql_delete_modules = "DELETE FROM Modules WHERE course_id = :course_id";
        $stmt_delete_modules = $conn->prepare($sql_delete_modules);
        $stmt_delete_modules->bindParam(':course_id', $courseId);
        $stmt_delete_modules->execute();
    }

    // Redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Close the connection
$conn = null;
