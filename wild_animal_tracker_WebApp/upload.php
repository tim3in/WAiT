<?php
require_once('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'DBController.php';

//This function sends an e-mail alert
function sendAlert($animal){
     $mail = new PHPMailer(true);        // Passing `true` enables exceptions
    date_default_timezone_set("Asia/Kolkata");
                $dateTime = date("Y-m-d H:i:s");
     try {
                    $mail = new PHPMailer;
                    $mail->isSMTP(); 
                    $mail->SMTPDebug = 2; 
                    $mail->Host = "smtp.gmail.com"; 
                    $mail->Port = "587"; // typically 587 
                    $mail->SMTPSecure = 'tls'; // ssl is depracated
                    $mail->SMTPAuth = true;
                    $mail->Username = "your_password";
                    $mail->Password = "your password";
                    $mail->setFrom("sender_email", "Wild Animal Tracker App");
                    $mail->addAddress("receipient_email", "receipient_name");
                    $mail->Subject = 'Alert! '.$animal.' has been detected';
                    $mail->msgHTML($animal. " has been detected at ". $dateTime); // remove if you do not want to send HTML email
                    $mail->AltBody = $animal. " has been detected at ". $dateTime;
                    //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

                    $mail->send();
             echo 'Message has been sent!';
            } catch (Exception $e) {
                                //error
                echo "error: ". $e;
     }
}


$obj = new DBController();

$val = $obj->insertData($_POST['animal']);  //Saving data to database sent by sensor node
if($val){
    sendAlert($_POST['animal']); // sending alert to users e-mail
}
?>

