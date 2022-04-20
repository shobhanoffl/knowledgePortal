<?php
include('handling/auth.php');
include('handling/redirect.php');
include('handling/write.php');
include('handling/read.php');
if(isset($_SESSION['reg_clgid'])){
    header('location: home.php&getPosts=journal');
    exit();
}
?>
<html>
	<head>
		<title> login page</title>
		<link rel="stylesheet"	href="assets/login-signup/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	</head>
<body>
<div class="container">
<div class="card">
<br><br><br><br>
<center>
<span class="back-item"><a class="btn-outline" href="index.php"><span class="material-icons">arrow_back_ios_new</span> Back&nbsp;&nbsp;&nbsp;</a></span>
</center>
<?php  if (count($errors) > 0) : ?>
        <div class="notif-container top right">
		<center style="padding-right:3px;"><span class="material-icons" style="font-size:16px;">error</span> Error</center><br>
  	<?php foreach ($errors as $error) : ?>
  	    <div class="content"><?php echo $error ?></div><br>
  	<?php endforeach ?>
	  <button class="close"><a href="">Close</a><br></button>	
        </div>
<?php  endif ?>
<br>
<div class="inner-box" id="card">
<div class="card-front">
	<h2>LOGIN</h2>
	<form action="login-signup.php" method="POST">
		<input type="text" class="input-box" placeholder="College ID" name="clgid" required>
		<input type="Password" class="input-box" placeholder="Password" name="pass" required>
		
		<button type="submit" class="submit-btn" name="login_btn">LOGIN</button>
	</form>
	<button type="button" class="btn" onclick="openRegister()">New User?</button>
	<!-- <a href="">Forgot Password</a> -->
	<br>
</div>

<div class="card-back">
	<h2>REGISTER</h2>
	<form action="login-signup.php" method="POST">
    	<input type="text" class="input-box" placeholder="College ID" name="clgid" required>
		<input type="Password" class="input-box" placeholder="Password" name="pass" required>
		<input type="Password" class="input-box" placeholder="Confirm Password" name="cpass" required>
		<button type="submit" name="signup_btn" class="submit-btn">CREATE ACCOUNT</button>
	</form>
	<button type="button" class="btn" onclick="openLogin()">Already have an Account?</button>
	<!-- <a href="">Forgot Password</a> -->
</div>
</div>
</div>
</div>
<script>
var card = document.getElementById('card');

function openRegister(){
    card.style.transform = "rotateY(-180deg)";
}
function openLogin(){
    card.style.transform = "rotateY(0deg)";
}
let button = document.querySelector('.close');
button.onclick = function(){
  document.querySelector('.notif').style.display = 'none';
};
</script>

</body>
</html>
