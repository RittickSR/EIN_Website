<?php
require 'dbconfig/cofig.php';
include "pass.php";
session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Employer Signup Form </title>   
    <link rel="stylesheet" type="text/css" href="style/newsign.css">
</head>
<body>
    <div id="login-box">   
    <div class="left-box">
     
        <h1> Sign Up</h1>
         <form id="sign-form" method="post" action="sign2.php"> 
        <input type="text" name="name" placeholder="Company name" maxlength=30 required/>
        <input type="text" value="" name="username" placeholder="Username" method="post" required/>
        <input type="text" name="address" placeholder="Company address" maxlength=30 required/> 
        <input type="text" name="rnumber" placeholder="Company registration number"maxlength=30 required/>
        <input type="text" name="mnumber" placeholder="Mobile number"maxlength=10 required/>
        <input type="text" name="email" placeholder="Email"maxlength=30 required/>
        <input type="password" name="pass" placeholder="Password"maxlength=30 id="pass" required/>
        <input type="password" name="cpass" placeholder="Confirm password" maxlength=30 id="cpass" required/>
        <input type="checkbox" onclick="validatePassword();">Show Password<br><br>
             
        <script>
            function validatePassword() 
            {
                var x = document.getElementById("pass");
                var y = document.getElementById("cpass");
                if ((x.type === "password")||(y.type==="password"))
                {
                    x.type = "text";
                    y.type = "text";
                }
                else 
                {
                    x.type = "password";
                    y.type = "password";
                }
            }
        </script>
        <input type="submit" name="submit" value="submit"/>
          </form>     
        </div>  
       
        <?php
        if(isset($_POST['submit']))
        {   $_SESSION['username']=$_POST['username'];
            $_SESSION['name']=$_POST['name'];
            $_SESSION['username']=$_POST['username'];
            $_SESSION['address']=$_POST['address'];
            $_SESSION['rnumber']=$_POST['rnumber'];
            $_SESSION['mnumber']=$_POST['mnumber'];
            $_SESSION['email']=$_POST['email'];
            $_SESSION['pass']=$_POST['pass'];
            $_SESSION['cpass']=$_POST['cpass'];
            $name=$_SESSION['name'];
            $username=$_SESSION['username'];
            $address=$_SESSION['address'];
            $rnumber=$_SESSION['rnumber'];
            $mnumber=$_SESSION['mnumber'];
            $email=$_SESSION['email'];
            $password=$_SESSION['pass'];
            $cpassword=$_SESSION['cpass'];
            $hpass=passhash($password);
            $query="select * from employer1 WHERE email='$email'";
            $query_run= mysqli_query($con,$query);
            
            if(mysqli_num_rows($query_run)>0)
            {
               echo '<script type="text/javascript"> alert("SAME USER EXISTS")</script>';  
            }
            else if($email[0]=='@')
            {
                 echo '<script type="text/javascript"> alert("invalid email-id")</script>';
            }
            else if($password!=$cpassword)
            {
                 echo '<script type="text/javascript"> alert("password and confirm password should be identical")</script>';
            }
            else if(!ctype_digit ( $mnumber ))
            {
                print '<script type="text/javascript">'; 
                print 'alert("The mobile number cannot contain alphabets")'; 
                print '</script>'; 
            }
            else if(strlen($mnumber)!=10)
            {
                print '<script type="text/javascript">'; 
                print 'alert("The mobile number should be 10 digits")'; 
                print '</script>'; 
            }
            
            else
            {
                    
                    $query="INSERT INTO employer1 (name,username,address,registration,number,email,password,flag)  values('$name','$username','$address','$rnumber','$mnumber','$email','$hpass','0')";
                    $query_run= mysqli_query($con,$query);
                    echo '<script type="text/javascript"> alert("SUBMITTED")</script>';
                    if($query_run==true)
                    {
                        echo '<script type="text/javascript"> alert("REGISTERED")</script>';
                        
                        require_once('PHPMailer/PHPMailerAutoload.php');
                
                        $mail = new PHPMailer();
                        $mail->isSMTP(); 
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = '465';
                        $mail->isHTML();
                        $mail->Username = 'smarindia1999@gmail.com';
                        $mail->Password = 'smarindia99';
                        $mail->SetFrom('no-reply');
                        $mail->Subject = 'Hello World';
                        $mail->Body = 'A test email!';
                        $mail->AddAddress($email);
                        if(!$mail->Send())
                        {

                            echo '<script type="text/javascript"> alert("Incorrect Email")</script>';  session_destroy();
                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Email sent for verification")</script>';
                            
                        }
                        $con= mysqli_connect('localhost','root','') or die('UNABLE TO CONNECT');


            //creating company database
            $username1=$_POST['username'];
            if(!$con)
            {
                die("cannot connect".mysqli_error());
            }
            $createdb="CREATE DATABASE $username1";
            $createdatabase=mysqli_query($con,$createdb);

            if($createdatabase)
            {
                echo '<script type="text/javascript"> alert("database created")</script>';
            }
            
            //$con= mysqli_connect('localhost','root','','$username1') or die('UNABLE TO CONNECT');
            //mysqli_select_db($con,'$username1');
            $createtb="CREATE TABLE details(
            EIN varchar(200),
            name text(200),
            salary int(200),
            mode text(200)
            )";    
            $createtb1=mysqli_query($con,$createtb);
            if($createtb1)
            {
                echo '<script type="text/javascript"> alert("table created")</script>';
            }

                    }
                    else
                    {    echo '<script type="text/javascript"> alert("fail")</script>';}
            }
             
        }
        ?>
    
</body>    
</html>