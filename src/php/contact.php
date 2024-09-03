<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $from_name = $_POST['name'];
  $from_email = $_POST['email'];
  $from_subject = $_POST['subject'];
  $from_message = $_POST['message'];
  $secret_message = getenv("SECRET_TUNNEL");

  $mail = new PHPMailer(true);

  //Configure an SMTP
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'tefthobber@gmail.com';
  $mail->Password = 'REDACTED';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom("tefthobber@gmail.com", "$from_name");

  $mail->addAddress('contact@accrudent.com', 'AccruDent Contact'); 

  $mail->isHTML(false);

  $mail->Subject = "$from_subject";

  $mail->Body    = "You have recieved the following message from $from_email on the accrudent.com form:\n\n$from_message\n\n$secret_message";

  // Attempt to send the email
  if (!$mail->send()) {
      echo 'Email not sent. An error was encountered: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent.';
  }

  $mail->smtpClose();
?>
