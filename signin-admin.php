<?php 
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DAMS - Sign In (Admin)</title>
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
    <form action="signin-admin.php" method="post">
		<div class="avatar">
			<svg xmlns="http://www.w3.org/2000/svg" height="4.5em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M610.5 373.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 400.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm201.2 226.5c-2.3-1.2-4.6-2.6-6.8-3.9l-7.9 4.6c-6 3.4-12.8 5.3-19.6 5.3-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-5.5-17.7 1.9-36.4 17.9-45.7l7.9-4.6c-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-16-9.2-23.4-28-17.9-45.7.9-2.9 2.2-5.8 3.2-8.7-3.8-.3-7.5-1.2-11.4-1.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c10.1 0 19.5-3.2 27.2-8.5-1.2-3.8-2-7.7-2-11.8v-9.2z"/></svg>
		</div>
        <h2 class="text-center">Admin</h2>   

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
            <button type="submit" name="login-admin" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>
		<div class="clearfix">
            <!--<label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>-->
            <a href="index.php">Cancel</a>
            <a style="color:blue;text-decoration: none" href="forgotpw-admin.php" class="pull-right">Forgot Password?</a>
        </div>
    </form>
    <!--<p class="text-center small">Don't have an account? <a href="#">Sign up here!</a></p>-->
</body>
</html>