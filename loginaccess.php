 <?php 

    include "pass.php";
    include "otpgen.php";


session_start();

 $con= mysqli_connect('localhost','root','','sample') or die('UNABLE TO CONNECT');

     mysqli_select_db($con,'sample');

     

     if(isset($_POST['submit']))

        { $otp=genotp();

        $username=$_POST['uname'];

        $pass=$_POST['password'];

        $pass1=$_POST['password'];

        $password=passhash($pass);

        if($_POST['LOGIN-TYPE']=="EMPLOYER")

        {

            

            $sql="SELECT * FROM employer1 where username='$username'";

             $resource =mysqli_query($con,$sql) or die (mysqli_error());

             $rowcount=mysqli_num_rows($resource);

            if($rowcount==1)

            {

                while($row =mysqli_fetch_array($resource))

                {

                    $pass=$row['password'];

                    $flag=$row['flag'];



                }

                if($pass==$password)

                {

                         echo '<script type="text/javascript"> alert("password has been matched")</script>';           //checking if the employer is loging in for the first time

                    if($flag==0)

                    {

                        //mysqli_close($con);

                       // echo '<script type="text/javascript"> alert("yesssss")</script>';

                        /*if(!mysqli_close($con))

                        {

                            echo '<script type="text/javascript"> alert("FAIL")</script>';

                        }*/

                       // $username2=$_POST['uname'];

                        $con1= mysqli_connect('localhost','root','') or die('UNABLE TO CONNECT');

                        //mysqli_select_db($con,'$username2');

                        if($con1)

                        {

                           

                        }

                        //finding the db

                        mysqli_select_db($con1,$username);

                        if(mysqli_select_db($con1,$username))

                        {

                           

                        }

                        else

                        {

                            echo '<script type="text/javascript"> alert("database not selected")</script>';

                        }

            

                        //creating table

                       $createtb="CREATE TABLE details(

                        EIN varchar(200),

                        name text(200),

                        salary int(200),

                        mode text(200),

                        bonus text(200),

                        pf text(200),

                        pension text(200),

                        Esi text(200),

                        empcut text(200),

                        total int(200),

                        month varchar(200)

                        )";    

                        $createtb1=mysqli_query($con1,$createtb);

                         $createtb2="CREATE TABLE employeelist(

                        EIN varchar(200),

                        name text(200)

                        )";    

                        $createtb3=mysqli_query($con1,$createtb2);

                         $createtb4="CREATE TABLE employerlist(

                        username varchar(200),

                        password text(200)

                        )";

                        

                    

                        $createtb5=mysqli_query($con1,$createtb4);

                        $comp="SELECT * FROM employerlist WHERE username='$username' && password='$pass1'";

                        $check=mysqli_query($con1,$comp);

                        if(!$comp)

                        {

                        $enter="INSERT INTO employerlist(username,password) values ('$username','$pass1')";

                        $createb6=mysqli_query($con1,$enter);

                        }









                        if($createtb1 && $createtb3)

                        {

                            echo '<script type="text/javascript"> alert("table created")</script>';

                        }

                      

                        

                        else

                        {

                           
                        }

                        //header('Location: employerlogin.php');





                        //now setting the flag to one

                        $con1= mysqli_connect('localhost','root','') or die('UNABLE TO CONNECT');

                        mysqli_select_db($con1,'sample');

                        $query="select * from employer1 WHERE username='$username'";

                        $query_run= mysqli_query($con1,$query);

                        $query="INSERT INTO employer1(flag)  values(1)";

                        $query_run= mysqli_query($con1,$query);
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
                       
                    


                    }

                    /*else

                    {

                         echo '<script type="text/javascript"> alert("failed")</script>';  # code...

                    }*/



                    $_SESSION['username']=$username;



                  header('Location: otppage.php');

                }

                else

                {

                 

                    header('Location: index.php');

                    echo '<script type="text/javascript"> alert("FAIL")</script>'; 

                }

             }

        }

        if($_POST['LOGIN-TYPE']=="EMPLOYEE")

        {

            $sql="SELECT * FROM user where ein='$username' && password='$password'";

             $resource=mysqli_query($con,$sql) or die (mysqli_error());

             $rowcount=mysqli_num_rows($resource);

            

            if($rowcount==1)

            {

                 $_SESSION['username']=$username;

                  header('Location: employeelogin1.php');

            }

            else

            {

                

                header('Location: index.php');

                echo '<script type="text/javascript"> alert("fail")</script>';  

            }

        }  

    }

     ?>

