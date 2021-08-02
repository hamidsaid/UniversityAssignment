<?php session_start(); ?>
<?php include "includes/navbar.php"; ?>
<?php include "db.php"; ?>


<!-- php -->
<?php

$errors = array();

if (!isset($_SESSION["username"])) {
    $_SESSION["msg"] = "You must be a member to view courses menu";
    echo "You must be a member";
    header("location: login.php");
}



if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $course = test_input($_POST["course"]);
    $code = test_input($_POST["code"]);
    $department = test_input($_POST["department"]);
    $lecturer = test_input($_POST["lecturer"]);
    $date = test_input($_POST["date"]);
    $semester = test_input($_POST["semester"]);
    $description = test_input($_POST["descript"]);
    $results = test_input($_POST["results"]);

    if(strlen($lecturer) > 30){
        array_push($errors, "Intructor's name should not exceed 30 characters");

    }else{

    if (strlen($description) > 50) {
        array_push($errors, "Course description should not exceed 30 characters");
    } else {

        $query = "INSERT INTO courses(course, code, department, lecturer, date, semester, description, results) 
    VALUES ('$course' ,'$code' ,'$department' ,'$lecturer' , '$date' ,  '$semester'  ,'$description' , '$results' )";

        $insertingData = mysqli_query($connection, $query);

        if (!$results) {
            die("Inserting the added category failed" . mysqli_error($connection));
        }
    }

}

}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

    //Preventing mysql injection
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}

?>


<div class="row col-lg-12 col-sm-12 col-xs-12">
    <div class="course-table col-sm-12 col-xs-12 col-lg-8">
        <div>
            <h1 class="dance-font">Courses Taken</h1>
            <br>
            <br>
        </div>

        <!-- table -->
        <div class="">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color: rgb(8, 11, 65); color:#fff;">

                        <th>Course</th>
                        <th>Code</th>
                        <th>Academic Year</th>
                        <th>Semester</th>
                        <th>Lecturer</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>


                    <?php


                    $query = "SELECT * FROM courses";
                    $results = mysqli_query($connection, $query);

                    if (!$results) {
                        die("Query Failed" . mysqli_error($connection));
                    }

                    //displaying the categories in the table
                    while ($row = mysqli_fetch_assoc($results)) {
                        $id = $row["id"];
                        $course = $row["course"];
                        $code = $row["code"];
                        $date = $row["date"];
                        $semester = $row["semester"];
                        $lecturer = $row["lecturer"];

                        echo "<tr>";
                        echo " <td>{$course}</td>";
                        echo " <td>{$code}</td>";
                        echo " <td>{$date}</td>";
                        echo " <td>{$semester}</td>";
                        echo " <td>{$lecturer}</td>";
                        echo " <td><a href='courseDetails.php' > Details</a></td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>

        </div>

    </div>

    <!-- vertical line -->
    <div class="vertical"></div>

    <div class="col-lg-4 col-xs-12 courses-form">

        <div>
            <h1 class="dance-font">Add a course</h1>
            <br>
            <br>
        </div>


        <div id="">
            <div class="">
                <form action="" method="post">
                      <!-- //displaying the errors -->
                       <?php include('errors.php'); ?>

                    <div class="form-group">
                        <label for="courseName">Course Name</label>
                        <select class="form-select" aria-label="Default select example" style="margin:16px 0;" name="course" required>
                            <option>Choose Course</option>
                            <option value="Web programming">Web programming</option>
                            <option value="Java Programming">Java Programming</option>
                            <option value="Introduction to Computer Networks"> Introduction to Computer Networks</option>
                            <option value="Discrete Structures">Discrete Structures</option>
                            <option value="Business Computer Communication">Business Computer Communication</option>
                            <option value="Computer hardware and Maintainance">Computer hardware and Maintainance</option>
                            <option value="Discrete Mathematics">Discrete Mathematics</option>
                            <option value="C programming">C programming</option>
                            <option value=" Development Perspectives II"> Development Perspectives II</option>
                            <option value="Computer Organization and Architecture I">Computer Organization and Architecture I</option>
                            <option value="Development Perspectives I"> Development Perspectives I</option>
                            <option value="Introduction to Information Systems">Introduction to Information Systems</option>
                            <option value="Communication Skills for Engineers">Communication Skills for Engineers</option>


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Course Code</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <select class="form-select" aria-label="Default select example" name="department" required>
                        <option selected>Choose Department </option>
                        <option value="Computer science and engineering">Computer science and engineering</option>
                        <option value="Electronics and telecommunication">Electronics and telecommunication</option>
                    </select>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="lecturer">Instructor's Name</label>
                        <input type="text" class="form-control" name="lecturer" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Enrolled Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <select class="form-select" aria-label="Default select example" name="semester" required>
                        <option>Choose Semester</option>
                        <option value="One">One</option>
                        <option value="Two">Two</option>
                    </select>
                    <div class="form-floating">
                        <textarea class="form-control" name="descript" placeholder="Course description" id="floatingTextarea2" style="margin:16px 0; height: 100px" required></textarea>
                    </div>
                    <label for="">Course results</label>
                    <select class="form-select" aria-label="Default select example" style="margin:16px 0;" name="results" required>
                        <option>Choose grade</option>
                        <option value="A">A</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="F">F</option>
                    </select>
                    <div class="form-group">
                        <input class="btn btn-dark " type="submit" name="submit" value="Add Course">
                    </div>

                </form>
                <p> <a href="courses.php?logout='1'" style="color: red;">Logout</a> </p>
            </div>
        </div>
    </div>

</div>