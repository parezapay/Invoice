<?php

$a=$_REQUEST['name'];
$b=$_REQUEST['aemail'];
$c=$_REQUEST['subject'];
$d=$_REQUEST['message'];

$msg="Name=$a Email=$b Subject=$c Message=$d";
mail("sarannyamt@gmail.com","subscribe",$msg);
header("locaton:index.html");
?>