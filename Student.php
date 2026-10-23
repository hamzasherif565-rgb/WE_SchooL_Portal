<?php
    require_once("./Connect.php");
    include_once("./Navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<div class="search-container">

    <div class="search-header">
        <span class="search-label">STUDENT PORTAL</span>
        <h1>Student Check</h1>
        <p>Search for a student and check their academic results.</p>
    </div>

    <div class="search-card">
        <form action="" method="POST" class="search-form">
            <label for="StduntSearch">Student Name</label>

            <div class="search-input-group">
                <input
                    type="text"
                    id="StduntSearch"
                    name="StduntSearch"
                    placeholder="Enter student name..."
                    required
                >

                <button type="submit" class="search-btn">
                    Search
                </button>
            </div>

            <small class="search-hint">
                Enter the student's name to find their results.
            </small>
        </form>
    </div>

    <!-- Search results -->
    <div class="results-card">
        <div class="results-heading">
            <h2>Search Results</h2>
            <span class="results-icon">✦</span>
        </div>

        
        <div class="results-content">

        <?php
        $Error = null;
        $Found = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $SearchName = htmlspecialchars($_POST["StduntSearch"]);

            if (empty($SearchName)) {
                $Error = "<small style='color:red;'>Please Enter Your name Correct ...</small>";
            }

            if (empty($Error)) {
                $SQL = "SELECT * FROM students WHERE name LIKE '$SearchName%'";
                $Resilt = $Connect->query($SQL);

                if ($Resilt->rowCount() >= 1):
                    $Found = true;

                    while ($row = $Resilt->fetch()) {

                        $score =($row['arabic']+$row['maths']+$row['english']+$row['physics']+$row['progrmming']) /5;
                        $Stutes = ($score >= 50) ? "Pass" : "Fail";
                        
                        $Subjects = [
                            "Arabic" => $row['arabic'],
                            "Maths" => $row['maths'],
                            "English" => $row['english'],
                            "Physics" => $row['physics'],
                            "Programming" => $row['progrmming']
                        ];

                        $FailedSubjects = [];

                        if ($row['arabic'] < 50) {
                            $FailedSubjects[] = "Arabic";
                        }

                        if ($row['maths'] < 50) {
                            $FailedSubjects[] = "Maths";
                        }

                        if ($row['english'] < 50) {
                            $FailedSubjects[] = "English";
                        }

                        if ($row['physics'] < 50) {
                            $FailedSubjects[] = "Physics";
                        }

                        if ($row['progrmming'] < 50) {
                            $FailedSubjects[] = "Programming";
                        }

                        echo "<div class='student-result'>
                            <div class='result-student-info'>
                                <span class='result-id'> #{$row['id']}  :  </span>
                                <strong>" . htmlspecialchars($row['name']) . "</strong>
                            </div>

                            <div class='result-score'>
                                <small>Final Score</small>
                                <strong>" . htmlspecialchars($score) . " / 100</strong>
                            </div>

                            <span class='status " . strtolower($Stutes) . "'>
                                $Stutes
                            </span>
                        </div>";
                                        
                    echo "<div class='subjects-results'>
                        <strong>Subject Grades:</strong>
                        <ul>";

                    foreach ($Subjects as $Subject => $Grade) {
                        $Color = ($Grade < 50) ? "red" : "green";

                        echo "<li style='color: $Color;'>
                            " . htmlspecialchars($Subject) . ":
                            " . htmlspecialchars($Grade) . " / 100
                        </li>";
                    }

                    echo "</ul></div>";

                    if (!empty($FailedSubjects)) {
                        echo "<div class='failed-subjects'>
                            <strong>Failed Subjects:</strong>
                            <ul>";

                        foreach ($FailedSubjects as $Subject) {
                            echo "<li style='color:red;'>" . htmlspecialchars($Subject) . "</li>";
                        }

                        echo "</ul></div>";
                    } else {
                        echo "<p class='passed-message'>Congratulations! You passed all subjects.</p>";
                    }

                    }
                endif;

                if (!$Found) {
                    echo "<div class='no-results'>
                        No student found. Please check the name and try again.
                    </div>";
                }
            } else {
                echo $Error;
            }
        }
        ?>

        </div>

    </div>

</div>


</body>
</html>

