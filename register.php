<?php session_start(); ?>
<?php include "includes/navbar.php"; ?>
<?php include "db.php"; ?>

<!-- php code -->
<?php

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $Fname = test_input($_POST["Fname"]);
  $Mname = test_input($_POST["Mname"]);
  $Sname = test_input($_POST["Sname"]);
  $username = test_input($_POST["Uname"]);
  $password = test_input($_POST["password"]);
  $cv = test_input($_POST["cv"]);
  $email = test_input($_POST["email"]);
  $mobile = test_input($_POST["number"]);
  $socialMedia = test_input($_POST["socialMedia"]);


  //lets check the validity of the password
  if (strlen($password) < 10) {
    array_push($errors, "Password should be atleast 10 characters long");
  }

  $hash = "$2a$10$";
  $string = "mywebprogrammingassignment";
  $hashString = $hash . $string;
  $password = crypt($password, $hashString);


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $query = "SELECT * FROM users WHERE username = '$username' OR email='$email' LIMIT 1";
  $results = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($results);

  //Check if user exists
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }


    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
      $query = "INSERT INTO users (Fname, Mname, Lname, username, password, cv, email, mobile ,socialMedia) 
             VALUES ('$Fname' ,'$Mname' ,'$Sname' ,'$username' , '$password' ,  '$cv'  ,'$email' , '$mobile' , '$socialMedia')";

      $_SESSION["username"] = $username;

      $insertingData = mysqli_query($connection, $query);



      if (!$insertingData) {
        echo "Inserting data to the Db failed " . mysqli_error($connection);
      } else {
       
        header("Location:login.php");
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


<!-- html code -->
<div class="white-smoke">

  <div>
    <h1 class="dance-font">Become a Member</h1>
  </div>


  <div id="form">
    <div class="col-lg-4 col-xs-4">

      <form action="" method="post">
        <!-- //displaying the errors -->
        <?php include('errors.php'); ?>

        <div class="form-group">
          <label for="Fname">First Name</label>
          <input type="text" class="form-control" name="Fname" required>
        </div>
        <div class="form-group">
          <label for="Mname">Middle Name</label>
          <input type="text" class="form-control" name="Mname" required>
        </div>
        <div class="form-group">
          <label for="Sname">Sur Name</label>
          <input type="text" class="form-control" name="Sname" required>
        </div>
        <div class="form-group">
          <label for="Uname">Username</label>
          <input type="text" class="form-control" name="Uname" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
          <label for="">Attach CV</label>
          <input type="file" class="form-control-file" id="" name="cv">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label for="number">Mobile Number</label>
          <input type="tel" class="form-control" name="number" placeholder="E.g +255xxxxxxxxx" required>
        </div>
        <div class="form-group">
          <label for="">Social Media</label>
          <input type="text" class="form-control" name="socialMedia" required>
        </div>
        <div class="form-group">
          <input class="btn btn-dark " type="submit" name="submit" value="Register">
        </div>
      </form>

      <h5>Already a member?</h5>
      <a href="login.php" class="nav-link">
        <h6>Login</h6>
      </a>


    </div>
  </div>







</div>





</body>

</html>