<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

require_once('../DB_Connection/dbConnect.php');
require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

  $username = $_POST['adminname'];
  $zapytanieSql = "SELECT * FROM adminlist WHERE username='$username'";
  $wynik = $conn->query($zapytanieSql);
  $wiersz = $wynik->fetch_assoc();
  $StaryAdresEmail = $wiersz['email'];

  if (isset($_POST['newAdminEmail'])  && $_POST['newAdminEmail'] !== "") {
    $email = $_POST['newAdminEmail'];

    $sqlCheckEmailUser = "SELECT * FROM users WHERE email='$email'";
    $sqlCheckEmailUserResult = $conn->query($sqlCheckEmailUser);
    $sqlCheckEmailAdmin = "SELECT * FROM adminlist WHERE email='$email'";
    $sqlCheckEmailAdminResult = $conn->query($sqlCheckEmailAdmin);

    if ($sqlCheckEmailUserResult->num_rows > 0 || $sqlCheckEmailAdminResult->num_rows > 0) {
      $_SESSION['daneZmienione'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
         Podany adres email jest już używany.
      </div>
    </div>';
      header("Location: ../../Frontend/AdminMenu/adminMenu.php");
    } else {

      try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pszczelarzezpasji4453@gmail.com';
        $mail->Password = 'pszczola9901a24';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = "UTF-8";
        $mail->Subject = 'Zmiana adresu email - Pszczelarzezpasji.com';
        $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
        $mail->isHTML(true);
        $mail->Body = '<p>Witaj ' . $username . '! </p> </br> <p>Twój adres mailowy został zmieniony na: ' . $email . ' </p>';
        $mail->addAddress($email, $username);
        $mail->send();

        $sql = "UPDATE adminlist SET email='$email' WHERE username='$username' ";
        $result = $conn->query($sql);
        $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Adres email został zmieniony. 
          </div>
        </div>';


        try {
          $oldMail = new PHPMailer(true);
          $oldMail->isSMTP();
          $oldMail->Host = 'smtp.gmail.com';
          $oldMail->SMTPAuth = true;
          $oldMail->Username = 'pszczelarzezpasji4453@gmail.com';
          $oldMail->Password = 'pszczola9901a24';
          $oldMail->SMTPSecure = 'tls';
          $oldMail->Port = 587;

          $oldMail->CharSet = "UTF-8";
          $oldMail->Subject = 'Zmiana adresu email - Pszczelarzezpasji.com';
          $oldMail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
          $oldMail->isHTML(true);
          $oldMail->Body = '<p>Witaj ' . $username . '! </p> </br> <p>Twój adres mailowy został zmieniony na: ' . $email . ' </p>';
          $oldMail->addAddress($StaryAdresEmail, $username);
          $oldMail->send();
        } catch (Exception $e) {
          $_SESSION['daneZmienione'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
             Podano nieistniejący adres email.
          </div>
        </div>';
        }
      } catch (Exception $e) {
        $_SESSION['daneZmienione'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
         Podano nieistniejący adres email.
      </div>
    </div>';
        header("Location: ../../Frontend/AdminMenu/adminMenu.php");
      }
    }
  } else if (isset($_POST['newAdminPassword']) && $_POST['newAdminPassword'] !== "") {
    $password = $_POST['newAdminPassword'];

    $sqlPass = "SELECT * FROM adminlist WHERE username='$username'";
    $wynikPass = $conn->query($sqlPass);
    $row = $wynikPass->fetch_assoc();
    if (!password_verify($password, $row['password'])) {


      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $zapytanieSql = "SELECT * FROM adminlist WHERE username='$username'";
      $wynik = $conn->query($zapytanieSql);
      $wiersz = $wynik->fetch_assoc();
      $email = $wiersz['email'];

      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'pszczelarzezpasji4453@gmail.com';
      $mail->Password = 'pszczola9901a24';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->CharSet = "UTF-8";
      $mail->Subject = 'Zmiana hasła konta - Pszczelarzezpasji.com';
      $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
      $mail->isHTML(true);
      $mail->Body = '<p>Witaj ' . $username . '! </p> </br> <p>Twoje hasło zostało zmienione</p>';
      $mail->addAddress($email, $username);
      $mail->send();

      $sql = "UPDATE adminlist SET password='$hashedPassword' WHERE username='$username' ";
      $result = $conn->query($sql);
      $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło zostało zmienione.
        </div>
      </div>';
    } else {
      $_SESSION['daneZmienione'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Podano stare hasło. Nie naniesiono zmian.
          </div>
        </div>';
    }
  }

  header("Location: ../../Frontend/AdminMenu/adminMenu.php");
}
