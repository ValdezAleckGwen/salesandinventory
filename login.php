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
                <div class="pass"><a href="#">Forgot Password?</a></div>
            </div>
        </form>
           
    </div>
</div>

</body>

</html>