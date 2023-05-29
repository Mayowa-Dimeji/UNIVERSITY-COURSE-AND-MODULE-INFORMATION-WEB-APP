<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "task2-db-1";
$username = "root";
$password = "csym019";
$dbname = "csym019_assignment";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$columnNames = [
    "fees_uk_full_time",
    "fees_uk_part_time",
    "fees_uk_integrated_foundation_year",
    "fees_international_integrated_foundation_year",
    "fee_international_full",
    "fee_international_part",
    "fees_optional_work_placement_year"
];

function saveCourseData($conn, $courseName, $courseLevel, $overview, $highlights, $details, $req, $faqs, $modules, $feesTypes, $figures)
{
    try {
        $sql = "INSERT INTO Course (title, `level`,iconPath, overview, highlights, course_details, entry_requirements, faq) VALUES (:course_name, :course_level,:iconPath, :overview, :highlights, :details, :req, :faq)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':course_name', $courseName, PDO::PARAM_STR);

        $stmt->bindParam(':course_level', $courseLevel);
        $stmt->bindParam(':overview', $overview);
        $stmt->bindParam(':highlights', $highlights);
        $iconPath = "ooo";
        $stmt->bindParam(':iconPath', $iconPath);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':req', $req);
        $stmt->bindParam(':faq', $faqs);
        $success = $stmt->execute();
        if ($success) {
            echo "Course data saved successfully.";
        } else {
            echo "Failed to save course data.";
        }

        $courseId = $conn->lastInsertId();

        foreach ($modules as $module) {
            $moduleName = $module['name'];
            $moduleCredit = intval($module['credit']);

            $sql_module = "INSERT INTO Modules (module_name, credits, course_id) VALUES (:module_name, :credits, :course_id)";
            $stmt_module = $conn->prepare($sql_module);
            $stmt_module->bindParam(':module_name', $moduleName);
            $stmt_module->bindParam(':credits', $moduleCredit);
            $stmt_module->bindParam(':course_id', $courseId);
            $success1 = $stmt_module->execute();
            if ($success1) {
                echo "Module data saved successfully.";
            } else {
                echo "Failed to save module data.";
            }
        }

        if (is_array($feesTypes)) {
            for ($i = 0; $i < count($feesTypes); $i++) {
                $feesType = $feesTypes[$i];
                $figure = $figures[$i];

                $sql_fees = "UPDATE Course SET $feesType = :figure WHERE course_id = :courseId";
                $stmt_fees = $conn->prepare($sql_fees);
                $stmt_fees->bindParam(':figure', $figure);
                $stmt_fees->bindParam(':courseId', $courseId);
                $stmt_fees->execute();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseName = $_POST['course_name'];
    $courseLevel = $_POST['course_level'];
    $overview = $_POST['overview'];
    $highlights = $_POST['highlights'];
    $details = $_POST['details'];
    $req = $_POST['req'];
    $modules = array();


    if (isset($_POST['module']) && isset($_POST['credit'])) {
        $moduleNames = $_POST['module'];
        $moduleCredits = $_POST['credit'];

        for ($i = 0; $i < count($moduleNames); $i++) {
            $moduleName = $moduleNames[$i];
            $moduleCredit = $moduleCredits[$i];
            $modules[] = array('name' => $moduleName, 'credit' => $moduleCredit);
        }
    }

    $feesTypes = $_POST['feesType'];
    $figures = $_POST['figure'];
    $faqs = $_POST['faqss'];

    // $conn, $courseName, $courseLevel, $overview, $highlights, $details, $req, $faqs, $modules, $feesTypes, $figures)
    saveCourseData($conn, $courseName, $courseLevel, $overview, $highlights, $details, $req, $faqs, $modules, $feesTypes, $figures);

    // Redirect or show success message
    // ...
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Course Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="addNewCourse.js"></script>
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
        <form action="newCourse.php" method="POST">
            <div class="sketch">
                <!-- <img src="./sampleEntryForm.png" alt="New course entry form"> -->
            </div>
            <div class="addmore">
                <div>
                    <label for="course_name">Course Name:</label>
                    <input type="text" name="course_name" id="course_name" required />
                </div>
                <div>
                    <label for="course_level">Level:</label>
                    <input type="text" name="course_level" id="course_level" required />
                </div>
                <div>
                    <label for="overview">Overview</label>
                    <textarea rows="4" cols="40" name="overview" id="overview" required></textarea>
                </div>
                <div>
                    <label for="highlights">Highlights</label>
                    <textarea rows="4" cols="40" name="highlights" id="highlights" required></textarea>
                </div>
                <div>
                    <label for="details">Course Details</label>
                    <textarea rows="4" cols="40" name="details" id="details" required></textarea>
                </div>
                <div>
                    <label for="req">Entry Requirements</label>
                    <textarea rows="4" cols="40" name="req" id="req" required></textarea>
                </div>
                <section>
                    <div id="modulesContainer">
                        <div class="module-input">
                            <input type="text" name="module[]" placeholder="Module Name">
                            <input type="text" name="credit[]" placeholder="Credit" pattern="[0-9]+" title="Please enter a number">
                        </div>
                    </div>
                    <button id="addModuleButton" type="button">Add Module</button>
                </section>
                <section>
                    <div id="feesContainer">
                        <div class="fee-input">
                            <select name="feesType[]" id="mySelect">
                                <option value="fees_uk_full_time">Uk Full Time</option>
                                <option value="fees_uk_part_time">Uk part time</option>
                                <option value="fees_uk_integrated_foundation_year">Uk foundation</option>
                                <option value="fees_international_integrated_foundation_year">International Full time</option>
                                <option value="fee_international_full">International Part time</option>
                                <option value="fee_international_part">International Foundation</option>
                                <option value="fees_optional_work_placement_year">Work Placement</option>
                            </select>
                            <input type="text" name="figure[]" placeholder="Figure" pattern="[0-9]+" title="Please enter a number">
                        </div>
                    </div>
                    <button id="addFeeButton" type="button">Add Fee</button>
                </section>

                <div>
                    <label for="faqss">FAQs</label>
                    <textarea rows="4" cols="40" name="faqss" id="faqss" required></textarea>
                </div>

                <input type="submit" value="Add Course" />
                <!--input type="reset" value="Cancel" /-->
            </div>
        </form>
    </main>
    <footer>&copy; CSYM019 2023</footer>

</body>

</html>