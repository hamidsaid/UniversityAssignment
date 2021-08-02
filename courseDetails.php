<?php session_start(); ?>
<?php include"includes/navbar.php"; ?>
<?php include"db.php"; ?>

<div id="details"  class=" col-lg-8">
        <div> 
         <h1 class="dance-font">Course Details</h1>
         <br>
         <br>
         </div>

<div class="details-table">

<div class=" col-lg-8 col-xs-4">


<?php

$query = "SELECT * FROM courses";

$results = mysqli_query($connection, $query);

if(!$results){
  die("Query Failed" . mysqli_error($connection));
  }


while($row = mysqli_fetch_assoc($results)){


     $course = $row["course"];
     $code = $row["code"];
     $department = $row["department"];
     $results = $row["results"];
     $date = $row["date"];
     $semester = $row["semester"];
     $lecturer = $row["lecturer"];
     $description = $row["description"];

     ?>
     <div class="details-field">
<label for="course" class="labels"><u>Course Name</u> : </label>

<?php
 echo "<h5>{$course}</h5>"
?>
  
</div>

<div class="details-field">
<label for="code" class="labels"> <u> Course Code </u>  : </label>
<?php
 echo "<h5>{$code}</h5>"
?>
  
</div>

<div class="details-field">
<label for="department" class="labels"> <u> Department </u> : </label>
<?php
 echo "<h5>{$department}</h5>"
?>
  
</div>

<div class="details-field">
<label for="instructor" class="labels"> <u> Course Instructor </u> : </label>
<?php
 echo "<h5>{$lecturer}</h5>";
?>
  
</div>

<div class="details-field">
<label for="year" class="labels"> <u> Academic Year </u> : </label>
<?php
 echo "<h5>{$date}</h5>";
?>
  
</div>

<div class="details-field">
<label for="semester" class="labels"> <u> Semester </u> : </label>
<?php
 echo "<h5>{$semester}</h5>";
?>
  
</div>

<div class="details-field">
<label for="results" class="labels"> <u> Results(grade) </u> : </label>
<?php
 echo "<h5>{$results}</h5>";
?>
  
</div>

<div class="details-field">
<label for="description" class="labels"> <u> Description </u> : </label>
<?php
 echo "<h5>{$description}</h5>";
?>
  
</div>


<?php 

break;
} ?>





</div>
</div>
</div>