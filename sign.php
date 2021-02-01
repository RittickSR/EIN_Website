<?php

include "eingen.php";
include "pass.php";
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Employee Signup Form </title>   
    <link rel="stylesheet" type="text/css" href="style/newsign.css">
</head>

<body>
    <a href=employerlogin.php>BACK</a>
       <div id="login-box">   
    <div class="left-box">
     
        <h1> Sign Up</h1>
         <form id="sign-form" method="post" action="sign.php"> 
        <input type="text" name="name" placeholder="First name" maxlength=30 required/>
        <input type="text" name="midname" placeholder="Midname" maxlength=30 required/>
        <input type="text" name="lname" placeholder="Lastname" maxlength=30 required/> 
        <input type="text" name="number" placeholder="Number"maxlength=10 required/>
        <input type="text" name="email" placeholder="Email"maxlength=30 required/>
        <input type="text" name="address" placeholder="Address"   maxlength=30 required/>
        <input type="password" name="pass" placeholder="Password"  id="pass" maxlength=30 required/>
        <input type="password" name="cpassword" placeholder="Confirm password" id="cpass" maxlength=30 required/>
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
       
    
        <?php
       
        if(isset($_POST['submit']))
        {
            
            $name=$_POST['name'];
            $midname=$_POST['midname'];
            $lname=$_POST['lname'];
            $number=$_POST['number'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $password=$_POST['pass'];
            $cpassword=$_POST['cpassword'];
            $hpass= passhash($password);
            $con1= mysqli_connect('localhost','root','',"sample") or die('UNABLE TO CONNECT');
            $query="select * from user WHERE email='$email'";
            $query_run= mysqli_query($con1,$query);
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
            else if(!ctype_digit ( $number ))
            {
                print '<script type="text/javascript">'; 
                print 'alert("The mobile number cannot contain alphabets")'; 
                print '</script>'; 
            }
            else if(strlen($number)!=10)
            {
                print '<script type="text/javascript">'; 
                print 'alert("The mobile number should be 10 digits")'; 
                print '</script>'; 
            }
            else{
                $ein=eingen();
                $query="INSERT INTO user (name,midname,lname,num,email,address,password,ein)  values('$name','$midname','$lname','$number','$email','$address','$hpass','$ein')";
                $query_run= mysqli_query($con1,$query);
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
                        $mail->Subject = 'REGISTRATION COMPLETE';
                        $mail->Body = "CONGRATULATIONS!!!!YOUR EIN is $ein' Your Password is $password";
                        $mail->AddAddress($email);
                        if(!$mail->Send())
                        {
                            echo '<script type="text/javascript"> alert("Incorrect Email")</script>';  
                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Email Sent for verification")</script>';
                        }
                       
                    
 
             $db=$_SESSION['username']; 
           $con= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
               $sql="SELECT * FROM user where ein='$ein'";
      $result = mysqli_query($con1,$sql) or die('ERROR');
   
    $row = mysqli_fetch_array($result);
      $na=$row["name"];
      $ename=$row["ename"];
            $query="INSERT INTO employeelist (EIN,name) values ('$ein','$na')";
         $query1="INSERT INTO details (EIN,name) values ('$ein','$na')";
          $query_run= mysqli_query($con,$query);
        $query_run= mysqli_query($con,$query1);
            $sq="UPDATE user SET ename='$db' WHERE ein='$ein'";
          $result = mysqli_query($con1,$sq) or die('ERROR');
                }
                else
                {    echo '<script type="text/javascript"> alert("fail")</script>';}
            }
            }
           
           
        ?>
    </div>
</body>
</html>
