<?php
function genotp()
{
$digit="0 1 2 3 4 5 6 7 8 9";
    $dig=explode(" ",$digit);
    $c=0;
    $otp="";
    while($c!=4)
    {
    $l=mt_rand(0,9);
    $otp.=$dig[$l];
    $c++;
    }
return $otp;
}
?>