<?php
    require_once("./Connect.php");
    include_once("./Navbar.php");
    
$Errors= Null;

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    $StudentName = htmlspecialchars($_POST["StudentName"]);

    if (empty($StudentName)) {
        $Errors[] = "<small style='color:red;'>Please Enter Student Name Correct</small>";
    }

    $Subjects = ["arabic", "english", "maths", "physics", "progrmming"];

    foreach ($Subjects as $Subject) {
        if (
            !isset($_POST[$Subject]) ||
            $_POST[$Subject] === "" ||
            !is_numeric($_POST[$Subject]) ||
            $_POST[$Subject] < 0 ||
            $_POST[$Subject] > 100
        ) {
            $Errors[] = "<small style='color:red;'>Please Enter a Valid $Subject Score</small>";
        }
    }

    
    if (empty($Errors)) {
        $Quary = "INSERT INTO students
        (name, arabic, english, maths, physics, progrmming)
        VALUES (:name,:arabic,:english,:maths,:physics,:progrmming)";

        $Stmt = $Connect->prepare($Quary);

        $Stmt->execute([
            ":name"=> $StudentName,
            ":arabic"=>$_POST["arabic"],
            ":english"=>$_POST["english"],
            ":maths"=>$_POST["maths"],
            ":physics"=>$_POST["physics"],
            ":progrmming"=>$_POST["progrmming"]
        ]);
    }
    else{
        foreach($Errors as $e){
            echo $e ."<br>";
        }
    }
}
    if (isset($_GET["DeleteId"])) {
    $id = $_GET["DeleteId"];
    $SqlDelete = "DELETE FROM students WHERE id = $id";
    $Connect->query($SqlDelete);
    header("Location: index.php");
    exit();
}
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
    

<div class="container-dashboard">

    <div class="header-dashboard">
        <div>
            <h1>Students Dashboard</h1>
            <p>Manage students and track their academic performance.</p>
        </div>

        <button type="button" class="add-btn" id="openModal">
            + Add Student
        </button>
    </div>

    <!-- Add Student Modal -->
    <div class="modal-overlay" id="studentModal">
        
<div class="modal-box">

    <div class="modal-heading">
        
        <div>
            <h2>Add New Student</h2>
            <p>Enter student information below.</p>
        </div>

        <button type="button" class="close-btn" id="closeModal">
            &times;
        </button>
    </div>

    <form method="POST" class="student-form">

        <div class="form-group full-width">
            <label>Student Name</label>
            <input type="text" name="StudentName"
                placeholder="Enter student name..." required>
        </div>

        <div class="form-group">
            <label>Arabic Score</label>
            <input type="number" name="arabic"
                placeholder="0 - 100" min="0" max="100"
                step="0.1" required>
        </div>

        <div class="form-group">
            <label>English Score</label>
            <input type="number" name="english"
                placeholder="0 - 100" min="0" max="100"
                step="0.1" required>
        </div>

        <div class="form-group">
            <label>Maths Score</label>
            <input type="number" name="maths"
                placeholder="0 - 100" min="0" max="100"
                step="0.1" required>
        </div>

        <div class="form-group">
            <label>Physics Score</label>
            <input type="number" name="physics"
                placeholder="0 - 100" min="0" max="100"
                step="0.1" required>
        </div>

        <div class="form-group">
            <label>Programming Score</label>
            <input type="number" name="progrmming"
                placeholder="0 - 100" min="0" max="100"
                step="0.1" required>
        </div>

        <div class="form-actions full-width">
            <button type="button" class="cancel-btn"
                id="cancelModal" onclick=" closeStudentModal() ">Cancel</button>

            <button type="submit" class="submit-btn">
                Add Student
            </button>
        </div>

    </form>

</div>

    </div>

    <!-- Students Table -->
    <div class="table-card">
        <div class="table-title">All Students</div>

        <div class="table-wrapper">
            <table class="student-table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Student Name</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $SQL = "SELECT * FROM students";
                        $Resilt = $Connect ->query($SQL);

                        if ($Resilt->rowCount() > 0):
                            while ($row = $Resilt->fetch()):
                                $score =($row['arabic']+$row['maths']+$row['english']+$row['physics']+$row['progrmming']) /5;
                                $Stutes = ($score >= 50) ? "Pass" : "Fail";
                    ?>

                    <tr>
                        <td>#<?= $row['id'] ?></td>

                        <td class="student-name">
                            <?= htmlspecialchars($row['name']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($score) ?> / 100
                        </td>

                        <td>
                            <span class="status <?= strtolower($Stutes) ?>">
                                <?= $Stutes ?>
                            </span>
                        </td>

                        <td>
                            <a class="delete-btn"
                            href="index.php?DeleteId=<?= $row['id'] ?>"
                            onclick="return confirm('Are you sure?')">
                                Delete
                            </a>
                        </td>
                    </tr>

                    <?php
                            endwhile;
                        else:
                    ?>

                    <tr>
                        <td colspan="5" class="empty-state">
                            No students found. Click Add Student to get started.
                        </td>
                    </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</div>

    </div>

</div>

<script src="./script.js"></script>

</body>
</html> 


