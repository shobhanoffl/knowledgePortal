<?php
session_start();
// Initializing DB Connection
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// Connection to the DB
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);

// To Catch errors during login & signup
$errors = array();

//$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

   //***************//
  // Register User //
 //***************//
if (isset($_POST['signup_btn'])) {
  $clgid = mysqli_real_escape_string($db, $_POST['clgid']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);
  $cpass = mysqli_real_escape_string($db, $_POST['cpass']);
  
  // Checking errors during authentication
  if ($pass != $cpass) {
	array_push($errors, "Passwords not matching");
  }

  // Checking existing users with the new credentials
  $existing_user_check = "SELECT * FROM users WHERE clgid='$clgid'";
  $result = mysqli_query($db, $existing_user_check);
  $existing_user = mysqli_fetch_assoc($result);
  
  if ($existing_user) {
    if ($existing_user['clgid'] === $clgid) {
      array_push($errors, "Email ID already exists");
    }
  }

  // Finally Register user if there are no errors
  if (count($errors) == 0) {
  	$password = md5($pass);
  	$query = "INSERT INTO users (name,clgid,pass) VALUES('$name', '$clgid', '$password')";
  	if(mysqli_query($db, $query)){
      $_SESSION['reg_clgid'] = $clgid;
      $_SESSION['entry'] = "success";
      header('location: editprofile.php');
      exit;
    }else{
      header('location: login-signup.php?msg=Account+Creation+Failed+-+Kindly+Raise+Issue');
    }
  }
}

   //************//
  // Login User //
 //************//
if (isset($_POST['login_btn'])) {
    $clgid = mysqli_real_escape_string($db, $_POST['clgid']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);

    // Checking existing users with the credentials
    $existing_user_check = "SELECT * FROM users WHERE clgid='$clgid'";
    $result = mysqli_query($db, $existing_user_check);
    $existing_user = mysqli_fetch_assoc($result);

    if ($existing_user){
        if($existing_user['pass'] != md5($pass)) {
            array_push($errors, "Incorrect Password");
        }else{
            if (count($errors) == 0) {
                $_SESSION['reg_clgid'] = $clgid;
  	            $_SESSION['entry'] = "success";
  	            header('location: home.php?getPosts=journal');
                exit;
            }
        }
    }else{
        array_push($errors, "User does not exist");
    }
}
?>