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

function saveCourseData($conn, $courseName, $courseLevel, $overview, $highlights, $details, $req, $modules, $feesTypes, $figures, $faqs)
{
  // Insert course details into the database
  $sql = "INSERT INTO Course (course_name, course_level, overview, highlights, details, req) VALUES (:course_name, :course_level, :overview, :highlights, :details, :req)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':course_name', $courseName);
  $stmt->bindParam(':course_level', $courseLevel);
  $stmt->bindParam(':overview', $overview);
  $stmt->bindParam(':highlights', $highlights);
  $stmt->bindParam(':details', $details);
  $stmt->bindParam(':req', $req);
  $stmt->execute();

  $courseId = $conn->lastInsertId();

  // Insert module details into the database
  foreach ($modules as $index => $module) {
    $moduleName = $module['name'];
    $moduleCredit = $module['credit'];

    $sql_module = "INSERT INTO Modules (module_name, credits, course_id) VALUES (:module_name, :credits, :course_id)";
    $stmt_module = $conn->prepare($sql_module);
    $stmt_module->bindParam(':module_name', $moduleName);
    $stmt_module->bindParam(':credits', $moduleCredit);
    $stmt_module->bindParam(':course_id', $courseId);
    $stmt_module->execute();
  }

  // Insert fee details into the database
  foreach ($feesTypes as $index => $feeType) {
    $feeFigure = $figures[$index];

    $sql_fee = "INSERT INTO Fees (fee_type, fee_figure, course_id) VALUES (:fee_type, :fee_figure, :course_id)";
    $stmt_fee = $conn->prepare($sql_fee);
    $stmt_fee->bindParam(':fee_type', $feeType);
    $stmt_fee->bindParam(':fee_figure', $feeFigure);
    $stmt_fee->bindParam(':course_id', $courseId);
    $stmt_fee->execute();
  }

  // Insert faqs into the database
  foreach ($faqs as $index => $faq) {
    $sql_faq = "INSERT INTO FAQs (faq) VALUES (:faq)";
    $stmt_faq = $conn->prepare($sql_faq);
    $stmt_faq->bindParam(':faq', $faq);
    $stmt_faq->execute();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $courseName = $_POST["course_name"];
  $courseLevel = $_POST["course_level"];
  $overview = $_POST["overview"];
  $highlights = $_POST["highlights"];
  $details = $_POST["details"];
  $req = $_POST["req"];
  $modules = array();
  $feesTypes = $_POST["feesType"];
  $figures = $_POST["figure"];
  $faqs = $_POST["faqss"];

  // Collect module data
  if (isset($_POST["module"]) && isset($_POST["credit"])) {
    $moduleNames = $_POST["module"];
    $moduleCredits = $_POST["credit"];
    $moduleCount = count($moduleNames);

    for ($i = 0; $i < $moduleCount; $i++) {
      $moduleName = $moduleNames[$i];
      $moduleCredit = $moduleCredits[$i];

      $modules[] = array(
        'name' => $moduleName,
        'credit' => $moduleCredit
      );
    }
  }

  // Save the course data to the database
  saveCourseData($conn, $courseName, $courseLevel, $overview, $highlights, $details, $req, $modules, $feesTypes, $figures, $faqs);

  // Redirect to a success page or perform any other necessary actions
  header("Location: success.php");
  exit();
}

// Close the connection
$conn = null;
