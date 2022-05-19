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

  $emailUser = "SELECT * FROM users WHERE email='$email'";
  $emailUserResult = mysqli_query($conn, $emailUser);
  $emailAdmin = "SELECT * FROM adminlist WHERE email='$email'";
  $emailAdminResult = mysqli_query($conn, $emailAdmin);

  $nameUser = "SELECT * FROM users WHERE username='$username'";
  $nameUserResult = mysqli_query($conn, $nameUser);
  $nameAdmin = "SELECT * FROM adminlist WHERE username='$username'";
  $nameAdminResult = mysqli_query($conn, $nameAdmin);

  if ($emailUserResult->num_rows > 0 || $emailAdminResult->num_rows > 0) {
    $_SESSION['adminAddUser'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
       Podany adres email jest już używany.
    </div>
  </div>';
    header('Location: ../../Frontend/AdminMenu/adminMenu.php');
  } else if ($nameAdminResult->num_rows > 0 || $nameUserResult->num_rows > 0) {
    $_SESSION['adminAddUser'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
       Podana nazwa użytkownika jest już zajęta.
    </div>
  </div>';
    header('Location: ../../Frontend/AdminMenu/adminMenu.php');
  } else {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'pszczelarzezpasji4453@gmail.com';
      $mail->Password = 'pszczola9901a24';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->Subject = 'Weryfikacja adresu email - Pszczelarzezpasji.com';
      $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
      $mail->isHTML(true);
      $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
      $mail->Body = '<p>Witaj ' . $username . '! </p> </br> <p>Administrator stworzył twoje konto, dane logowania to: </p> </br> 
    <p>Nazwa użytkownika: ' . $username . '</p></br> <p>Hasło użytkownika: ' . $password . '</p></br>
    <p style="color:red">Zalecamy zmianę hasła</p></br>
    <p>Twój kod weryfikacji to ' . $verification_code . '</p>';
      $mail->addAddress($email, $username);
      $showCode = $verification_code;
      $mail->send();

      $sql = "INSERT INTO users(id, username, email, password, verification_code, register_date, is_verifed)
     VALUES ('', '$username', '$email', '$hashedPassword', '$verification_code', '$date', '0')";

      $result = mysqli_query($conn, $sql);


      $_SESSION['adminAddUser'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Użytkownik został dodany, hasło tymczasowe zostało wysłane na jego adres email.
    </div>
  </div>';

      header('Location: ../../Frontend/AdminMenu/adminMenu.php');
    } catch (Exception $e) {

      $_SESSION['adminAddUser'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
       Wiadomość potwierdzająca konto użytkownika, nie została wysłana. Błędny adres email.
    </div>
  </div>';
      header('Location: ../../Frontend/AdminMenu/adminMenu.php');
    }
  }
}

$conn->close();
