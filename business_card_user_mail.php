<?php

/*----------------------User Mail Function ---------------------*/


if(($_POST['approve_hr']=='X')) 
{

$info=$control->UserBusinessEmailFunction($data);

echo "<br>";
echo 'To : '; echo $to=$info[0]; 
echo '<br> <br>';

$subject = "HRIS Information";  //echo "<br>"; echo $subject;

echo $subject;

echo '<br> <br>';

$message = "
<html>
<head>
<title>HTML email</title>
</head>

<body>
<p>Your Requistion has been Successfully Approved........! </p>

</body>
</html>
";

echo $message;

$headers="From: $other_info[18]";  

//echo $headers;

$headers='From: hr@fiberathome.net';   //echo "<br>"; echo $headers;

echo "<br>"; echo $headers;

$retrival = mail($to,$subject,$message,$headers);  //echo "<br>"; echo $retrival;



if($retrival) {
            echo "Message sent successfully.....";
         }else {
            echo "Message could not be sent......";
         }

 }




 /*-----------------User Rejected Mail-----------------------------*/

if(($_POST['approve_line_man']=='2') || ($_POST['approve']=='B') || ($_POST['approve_hod']=='B')  || ($_POST['approve_cfo_dmd_md']=='5') || ($_POST['approve_hr']=='Y')) 
{

$info=$control->UserBusinessEmailFunction($data);

echo "<br>";
echo 'To : '; echo $to=$info[0]; 
echo '<br> <br>';

$subject = "HRIS Information";  //echo "<br>"; echo $subject;

echo $subject;

echo '<br> <br>';

$message = "
<html>
<head>
<title>HTML email</title>
</head>

<body>

<tr><td>Your Requistion has been rejected.......! </p> </td></tr>

</body>
</html>
";

echo $message;

$headers="From: $other_info[18]";  

//echo $headers;

$headers='From: hr@fiberathome.net';   //echo "<br>"; echo $headers;

echo "<br>"; echo $headers;

$retrival = mail($to,$subject,$message,$headers);  //echo "<br>"; echo $retrival;



if($retrival) {
            echo "Message sent successfully.....";
         }else {
            echo "Message could not be sent......";
         }

 }
   


/* ------------------End HOF Mail Function ------------------*/





?> 