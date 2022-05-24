<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();


require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';


$tresc = $_POST['problemDesc'];
$tresc = htmlentities($tresc, ENT_QUOTES, "UTF-8");
$email = $_POST['email'];

$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'pszczelarzezpasji4453@gmail.com';
  $mail->Password = 'pszczola9901a24';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  $mail->Subject = 'Wyslano prosbe o pomoc administracji - Pszczelarzezpasji.com';
  $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
  $mail->isHTML(true);
  $mail->Body = '<p>Witaj twoja prośba o pomoc została dostraczona administracji, w przeciągu kilku dni napiszemy email z odpowiedzią.</p></br></br>
    Treść problemu: </br>
    ' . $tresc . ' </p>';
  $mail->addAddress($email);
  $mail->send();


  $mail2 = new PHPMailer(true);

  try {
    $mail2->isSMTP();
    $mail2->Host = 'smtp.gmail.com';
    $mail2->SMTPAuth = true;
    $mail2->Username = 'pszczelarzezpasji4453@gmail.com';
    $mail2->Password = 'pszczola9901a24';
    $mail2->SMTPSecure = 'tls';
    $mail2->Port = 587;

    $mail2->Subject = 'Wyslano prosbe o pomoc administracji - Pszczelarzezpasji.com';
    $mail2->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
    $mail2->isHTML(true);
    $mail2->Body = '<p>Adres mailowy użytkownika: ' . $email . ' </p> </br>
        <p>Treść problemu:</p> </br>
        <p>' . $tresc . ' </p>';
    $mail2->addAddress('pszczelarzezpasji4453@gmail.com');
    $mail2->send();
  } catch (Exception $e) {

    $_SESSION['emailSend'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div class="text-center">
           Błędny adres email.
        </div>
      </div>';
    header('Location: ../../Frontend/SupportContact/contact.php');
  }

  $_SESSION['emailSend'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div class="text-center">
           Wiadomość została pomyślnie wysłana do supportu. Oczekuj odpowiedzi w przeciągu kilku dni.
        </div>
      </div>';
  header('Location: ../../Frontend/SupportContact/contact.php');
} catch (Exception $e) {

  $_SESSION['emailSend'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div class="text-center">
           Błędny adres email.
        </div>
      </div>';
  header('Location: ../../Frontend/SupportContact/contact.php');
}






$conn->close();
