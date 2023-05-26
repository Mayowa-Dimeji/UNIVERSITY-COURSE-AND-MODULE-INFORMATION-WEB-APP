<?php
// // Establish a database connection (Replace with your own credentials)
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Retrieve form data
// $courseName = $_POST['course_name'];
// $courseCode = $_POST['course_code'];

// // Create and execute the SQL query to insert data into the database
// $sql = "INSERT INTO courses (course_name, course_code) VALUES ('$courseName', '$courseCode')";

// if ($conn->query($sql) === TRUE) {
//     echo "New course added successfully!";
// } else {
// echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();
// 
?>

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
$sql = "SELECT * FROM Course";
$result = $conn->query($sql);

$courses = array();

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $courses[] = $row;
    }
}
// header('Content-Type: application/json');
json_encode($courses);


$conn = null;
// Check if it's an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Set the appropriate response headers
    header('Content-Type: application/json');

    // Echo the encoded JSON data
    echo json_encode($courses);
    exit();
}

?>