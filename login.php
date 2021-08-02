<?php session_start(); ?>
<?php include"includes/navbar.php"; ?>
<?php include"db.php"; ?>

<?php
 $errors = array(); 

if($_SERVER["REQUEST_METHOD"] == "POST"){

   

    $login_username = test_input($_POST["username"]);
    $login_pass = test_input($_POST["password"]);

    //Encrypting the password provided by the user
    $hash = "$2a$10$";
    $string = "mywebprogrammingassignment";
    $hashString = $hash . $string;
    $login_pass = crypt($login_pass , $hashString);

  //Fetching the email entered by user from the Db
    $query = "SELECT username FROM users WHERE username='$login_username'";
    
    $username_results = mysqli_query($connection , $query);
    $username_row = mysqli_fetch_assoc($username_results);

     //Checking if the email fetched exists 
    if($username_row){
        $_SESSION["username"] = $login_username;
       
        //Fetching the password from the Db
        $query = "SELECT password FROM users WHERE password='$login_pass'";
        $pass_results = mysqli_query($connection , $query);
        $pass_row = mysqli_fetch_assoc($pass_results);
     

        //Checking if the entered password matches the one in the Db
        if($pass_row){
           header('location: courses.php');
        }else{
            array_push($errors , "Password is wrong" );
        }
   
    }else{
        array_push($errors, "User does not exist" ) ;
    }
 

}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

    //Preventing mysql injection
   $data = mysqli_real_escape_string($connection, $data);
  return $data;

}
?>







<div>
<h1 class="dance-font">Welcome Back</h1>
</div>


<div id="form" class="login-form">
<div class="col-lg-6 col-xs-4">

 <form action="" method="post">

 <?php include('errors.php'); ?>

        <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required >
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" required >
        </div>
        <div class="form-group">
        <input class="btn btn-dark " type="submit" name="submit" value="Login">
        </div>


</form>



 </div>
</div>

       