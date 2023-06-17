<?php 
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DAMS - Sign In (Employee)</title>
<link href="assets/img/dbku-logo.png" rel="icon">
<link href="assets/img/dbku-logo.png" rel="apple-touch-icon">

<!-- Custom fonts for this template-->
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<link rel="stylesheet" href="assets/css/front-2.css">
<script src="assets/js/front-1.js"></script>
<script src="assets/js/front-2.js"></script> 
<link href="assets/css/error-success.css" rel="stylesheet" />


<link rel="stylesheet" href="assets/css/signin.css" />
</head>
<body>
<div class="login-form">
    <form action="signin-employee.php" method="post">
		<div class="avatar">
			<i class="fa fa-user" style="font-size:80px;color: white;"></i>
		</div>
        <h2 class="text-center">Employee</h2>   

     	<?php include('errors.php'); ?>
        <?php if (isset($_SESSION['login'])) : ?>
            <div class="success">
            <h6>
              <?php 
                  echo $_SESSION['login']; 
                  unset($_SESSION['login']);
              ?>
            </h6>
            </div>
      <?php endif ?>
      <br>            

        <div class="form-group">
        	<div class="input-group">
        		<span class="input-group-addon"><i class="fa fa-user"></i></span>
        		<input type="text" class="form-control" name="username" placeholder="ID" required="required">
        	</div>
        </div>
		<div class="form-group">
			 <div class="input-group">
			 	<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
			 </div>
        </div>        
        <div class="form-group">
            <button type="submit" name="login-employee" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>
		<div class="clearfix">
            <!--<label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>-->
            <a href="index.php">Cancel</a>
            <a style="color:blue;text-decoration: none" href="forgotpw-employee.php" class="pull-right">Forgot Password?</a>
        </div>
    </form>
    <!--<p class="text-center small">Don't have an account? <a href="#">Sign up here!</a></p>-->
</body>
</html>