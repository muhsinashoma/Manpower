<?php

$to=$EmailAddress[18].'; muhsina.akter@fiberathome.net'."\n";    // echo $to; 

$subject = "Business Card Requisition";                          // echo $subject;

$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no :  $reference_no and user id # $request_empid</b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                                //  echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) {
            //echo "Message sent successfully.....";
            }

         else {
               //echo "Message could not be sent......";
             }


/* ------------------End HOF Mail Function ------------------*/



?> 