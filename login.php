<?php 
    session_start();
    include 'x-function/redirect_if_login.php';

?>
<html>
<title>Log In</title>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="login_style.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper">
        <h2>Login to your account</h2>

        <div class="login">

        <form method="post" action="actions/login.php">
            <div class="textbox">
        	   <input type="text" name="email" placeholder="E-Mail"/><br><br>
            </div>

            <div class="textbox">
                <input type="password" name="password" placeholder="Password"/><br><br>
            </div>

            <div class="button">
                <button type="submit" class="btn1">LOGIN</button>
                <div class="pass"><a href="" id="forgot">Forgot Password?</a></div>
            </div>
        </form>
           
    </div>
</div>

</body>

</html>

<script>
    $(document).ready(function(){
      //jquery for toggle sub menus
      $(document).on('click', '.pass', function() {
        alert('Please contact your system administrator for resetting of password')
      });

     




    });

</script>