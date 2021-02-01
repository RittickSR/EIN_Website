<?php
function eingen()
{
    $alpha="A B C D E F G H I J K L M N O P Q R S T U V W X Y Z";
    $lalpha=strtolower($alpha);
    $upper=explode(" ",$alpha);
    $lower=explode(" ",$lalpha);
    $digit="0 1 2 3 4 5 6 7 8 9";
    $dig=explode(" ",$digit);
    $a=0;
    $b=0;
    $c=0;
    $pass="";
    while(($a+$b)+$c!=10)
    {
        $x=mt_rand(1,2);
        switch($x)
        {
            case 1:
            if(($a+$b)<5)
            {
            $k=mt_rand(1,2);
            $l=mt_rand(0,25);
            switch($k)
            {
            case 1:
            $pass.=$upper[$l];
            $a++;
            break;
            case 2:
            $pass.=$lower[$l];
            $b++;
            }
            }
            else
            {}
            break;
            case 2:
            if($c<5)
            {
            $m=mt_rand(0,9);
            $pass.=$dig[$m];
            $c++;
            }
            break;
            }
        }
    return $pass;
}
?>