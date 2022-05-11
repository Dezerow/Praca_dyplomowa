<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();


require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
include "../DB_Connection/dbConnect.php";



$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

  $date = date('Y-m-d');
  $username =  $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $username = htmlentities($username, ENT_QUOTES, "UTF-8");   // Przepuszczanie przez html entities aby funkcja wstawiła nam automatycznie encje htmla, dzięki temu nie odczyta tekstu jako kod JS, zabiezpieczając nas przed atakiem na naszą strone
  $password = htmlentities($password, ENT_QUOTES, "UTF-8");
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  //  $email = htmlentities($password, ENT_QUOTES, "UTF-8");

  $mail = new PHPMailer(true);

  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.protonmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Pszczelarzezpasji4352@protonmail.com';
    $mail->Password = 'pszczola312';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 465;

    $mail->setFrom('Pszczelarzezpasji4352@protonmail.com', 'Mailer');
    $mail->addAddress($email, $username);

    $mail->isHTML(true);
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $mail->Subject = 'Email verification';
    $mail->Body = '<p>Twój kod weryfikacji to ' . $verification_code . '</p>';
    $showCode = $verification_code;
    $mail->send();

    $sql = "INSERT INTO users(id, username, email, password, verification_code, register_date, is_verifed)
     VALUES ('', '$username', '$email', '$hashedPassword', '$verification_code', '$date', '0')";

    $result = mysqli_query($conn, $sql);


    $_SESSION['registerSucc'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Rejestracja przebiegła pomyślnie. Zaloguj się.
    </div>
  </div>';

    header('Location: ../../Frontend/Login/emailVerificationPage.php');
    exit();
  } catch (Exception $e) {

    $_SESSION['registerFailed'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
       Wiadomość potwierdzająca konto użytkownika, nie została wysłana. Błędny adres email.
    </div>
  </div>';
    header('Location: ../../Frontend/Register/register.php');
  }
}

$conn->close();
