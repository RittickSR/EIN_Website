<?php
session_start();
?>

<html>
<head>
<title> Log in</title>
<link rel="stylesheet" type="text/css" href="style/login2.css">
</head>
<body>
    <div class="login">
    <form id="loginf" method="post" action="loginaccess.php">
         <h1> LOGIN</h1>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        Username <input name="uname" type="text" class="formc"required><br>
        <!--<i class="fa fa-lock fa-4x"></i>--> Password <input name="password" type="password" class="formc" id="pass"required><br><br>
         <input type="checkbox" onclick="validatePassword();">Show Password<br><br>
         <script>
            function validatePassword() 
            {
                var x = document.getElementById("pass");
               // var y = document.getElementById("cpass");
                if (x.type === "password")//||(y.type==="password"))
                {
                    x.type = "text";
                   // y.type = "text";
                }
                else 
                {
                    x.type = "password";
                   // y.type = "password";
                }
            }
        </script>
        You are  
        <input type="radio" name="LOGIN-TYPE" value="EMPLOYER">Employer&nbsp;<input type="radio" name="LOGIN-TYPE" value="EMPLOYEE" checked>Employee
        <br><br>
        
        <ul> <a href="sign2.php"><button type="button" class="btn">Sign up as employer</button></a></ul>
        <input type="submit" class="formsub" name="submit"placeholder="Login"><br>
        <a href="forgotPassword.php" class="forget">Forgot Password?</a>
    </form>
     </div>
    
</body>
</html>