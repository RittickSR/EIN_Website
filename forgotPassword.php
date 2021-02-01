<?php
require 'dbconfig/cofig1.php';
    include 'otpgen.php';
    ?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                          <input type="radio" name="LOGIN-TYPE" value="EMPLOYER">Employer&emsp;<input type="radio" name="LOGIN-TYPE" value="EMPLOYEE" checked>Employee
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            
                          <input id="username" name="username" placeholder="Username/EIN" class="form-control">
                            
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
        <?php
 if(isset($_POST['submit']))
        {$otp=genotp();
     if(isset($_POST["LOGIN-TYPE"]))
     {
         $radio_val=$_POST["LOGIN-TYPE"];
         if($radio_val=="EMPLOYER")
         {
             $username=$_POST['username'];
            $query="SELECT * FROM employer1 WHERE username='$username'";
             $resource =mysqli_query($con,$query) or die (mysqli_error());
             $rowcount=mysqli_num_rows($resource);
             $row =mysqli_fetch_array($resource);
             $email=$row['email'];
            //$email=mysqli_query($con,$query);
             $query="update employer1 set otp='$otp' where username='$username'";
            $query_run= mysqli_query($con,$query);
            
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
                        $mail->Body = "LINK IS http://localhost/sih3/Reset_pageempr.php
                        OTP IS $otp";
                        $mail->AddAddress($email);
                        if(!$mail->Send())
                        {
                            echo '<script type="text/javascript"> alert("Incorrect Email")</script>';  
                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Email Sent for verification")</script>';
                        }
                       
                    

     }       if($radio_val=="EMPLOYEE")
         {
             $ein=$_POST['username'];
            $query="select * from user WHERE ein='$ein'";
             $resource =mysqli_query($con,$query) or die (mysqli_error());
             $rowcount=mysqli_num_rows($resource);
             $row =mysqli_fetch_array($resource);
             $email=$row['email'];
             
            $query="update user set otp='$otp' where ein='$ein'";
            $query_run= mysqli_query($con,$query);
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
                        $mail->Subject = 'OTP VERIFICATION';
                        $mail->Body = "LINK IS http://localhost/sih3/Reset_page.php
                        OTP IS .$otp";
                        $mail->AddAddress($email);
                        if(!$mail->Send())
                        {
                            echo '<script type="text/javascript"> alert("Incorrect Email")</script>'; 
                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Email Sent for verification")</script>';
                         
                       
                        }  header('Location: index.php'); 

     }     }
}
     ?>
    </body>
</html>