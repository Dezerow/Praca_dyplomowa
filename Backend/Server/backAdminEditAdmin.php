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

  $userId = $_POST['id'];
  $zapytanieSql = "SELECT * FROM adminlist WHERE id='$userId'";
  $wynik = $conn->query($zapytanieSql);
  $wiersz = $wynik->fetch_assoc();
  $emailDatabase = $wiersz['email'];
  $usernameDatabase = $wiersz['username'];

  if (isset($_POST['newUsername'])  && $_POST['newUsername'] !== "") {
    $username = $_POST['newUsername'];

    $nameUser = "SELECT * FROM users WHERE username='$username'";
    $nameUserResult = mysqli_query($conn, $nameUser);
    $nameAdmin = "SELECT * FROM adminlist WHERE username='$username'";
    $nameAdminResult = mysqli_query($conn, $nameAdmin);

    if ($nameAdminResult->num_rows > 0 || $nameUserResult->num_rows > 0) {
      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
         Podana nazwa użytkownika jest już zajęta.
      </div>
    </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    } else {

      $sql = "UPDATE adminlist SET username='$username' WHERE id='$userId' ";
      $result = $conn->query($sql);
      $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nazwa administratora została zmieniona 
        </div>
      </div>';

      try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pszczelarzezpasji4453@gmail.com';
        $mail->Password = 'pszczola9901a24';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
        $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Body = '<p>Witaj!</p><p>Twoja nowa nazwa użytkownika to: ' . $username . '</p>';
        $mail->addAddress($emailDatabase, $username);
        $showCode = $verification_code;
        $mail->send();
      } catch (Exception $e) {

        $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Administrator posiada nieistniejący adres email.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      }
    }
  }
  if (isset($_POST['newUserEmail'])  && $_POST['newUserEmail'] !== "") {
    $email = $_POST['newUserEmail'];

    $emailUser = "SELECT * FROM users WHERE email='$email'";
    $emailUserResult = mysqli_query($conn, $emailUser);
    $emailAdmin = "SELECT * FROM adminlist WHERE email='$email'";
    $emailAdminResult = mysqli_query($conn, $emailAdmin);

    if ($emailUserResult->num_rows > 0 || $emailAdminResult->num_rows > 0) {
      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
         Podany adres email jest już używany.
      </div>
    </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
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

        $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
        $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Body = '<p>Witaj ' . $usernameDatabase . '! </p> </br> <p>Twój adres mailowy został zmieniony na: ' . $email . ' </p>';
        $mail->addAddress($email, $usernameDatabase);
        $sql = "UPDATE adminlist SET email='$email' WHERE id='$userId' ";
        $result = $conn->query($sql);
        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Adres mailowy administratora został zmieniony.
        </div>
      </div>';
        $mail->send();
        try {
          $oldMail = new PHPMailer(true);
          $oldMail->isSMTP();
          $oldMail->Host = 'smtp.gmail.com';
          $oldMail->SMTPAuth = true;
          $oldMail->Username = 'pszczelarzezpasji4453@gmail.com';
          $oldMail->Password = 'pszczola9901a24';
          $oldMail->SMTPSecure = 'tls';
          $oldMail->Port = 587;

          $oldMail->Subject = 'Zmiana adresu email - Pszczelarzezpasji.com';
          $oldMail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
          $oldMail->isHTML(true);
          $oldMail->Body = '<p>Witaj ' . $usernameDatabase . '! </p> </br> <p>Twój adres mailowy został zmieniony na: ' . $email . ' </p>';
          $oldMail->addAddress($emailDatabase, $usernameDatabase);
          $oldMail->send();
        } catch (Exception $e) {
          $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
             Podano nieistniejący adres email 1 blad ze starym.          
          </div>
        </div>';
        }
      } catch (Exception $e) {

        $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Podano nieistniejący adres email.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      }
    }
  } else if (isset($_POST['newUserPassword']) && $_POST['newUserPassword'] !== "") {
    $password = $_POST['newUserPassword'];
    $sql = "UPDATE adminlist SET password='$password' WHERE id='$userId' ";
    $result = $conn->query($sql);
    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło administratora zostało zmienione.
        </div>
      </div>';
    try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'pszczelarzezpasji4453@gmail.com';
      $mail->Password = 'pszczola9901a24';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
      $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
      $mail->isHTML(true);
      $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
      $mail->Body = '<p>Witaj ' . $usernameDatabase . '!</p><p>Twoje hasło zostało zmienione</p>';
      $mail->addAddress($emailDatabase, $usernameDatabase);
      $showCode = $verification_code;
      $mail->send();
    } catch (Exception $e) {

      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
                Administrator posiada nieistniejący adres email.
              </div>
            </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  } else if (isset($_POST['role']) && $_POST['role'] !== "Admin") {

    $sqlGet = "SELECT * from adminlist WHERE id='$userId'";
    $result = $conn->query($sqlGet);
    $row = $result->fetch_assoc();


    $newUserName = $row['username'];
    $newUserEmail = $row['email'];
    $newUserPassword = $row['password'];
    $newUserRegisterdate = $row['register_date'];
    $newUserVerfCode = $row['verification_code'];
    $newUserIsVerf = $row['is_verifed'];


    $sql = "INSERT INTO users(id, username, email, password, verification_code, register_date, is_verifed)
          VALUES ('', '$newUserName', '$newUserEmail', '$newUserPassword', '$newUserVerfCode', '$newUserRegisterdate', $newUserIsVerf)";
    $result2 = $conn->query($sql);

    $delete = "DELETE FROM adminlist WHERE id='$userId'";
    $resultDelete = $conn->query($delete);


    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana roli administratora została zakończona sukcesem.
        </div>
      </div>';

    try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'pszczelarzezpasji4453@gmail.com';
      $mail->Password = 'pszczola9901a24';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
      $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
      $mail->isHTML(true);
      $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
      $mail->Body = '<p>Witaj ' . $newUserEmail . '!</p><p>Twoje uprawnienia zostały zdegradowane do poziomu zwykłego użytkownika.</p>';
      $mail->addAddress($emailDatabase, $newUserName);
      $showCode = $verification_code;
      $mail->send();
    } catch (Exception $e) {

      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                  Administrator posiada nieistniejący adres email.
                </div>
              </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  } else if (isset($_POST['role']) && $_POST['role'] === "Admin") {
    $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Wybrano ustaloną aktualnie rolę administratora, nie naniesiono zmian.
    </div>
  </div>';
    header("Location: ../../Frontend/AdminMenu/editUsers.php");
  } else if (isset($_POST['is_verf'])) {
    $Sql = "SELECT * FROM adminlist WHERE id='$userId'";
    $wyniki = $conn->query($Sql);
    $wiersz = $wyniki->fetch_assoc();
    $aktualnyStanKonta = $wiersz['is_verifed'];

    if ($_POST['is_verf'] === '1' && $aktualnyStanKonta === '0') {
      try {
        $sqlActivate = "UPDATE adminlist SET is_verifed=1 WHERE id='$userId'";
        $resultActivate = $conn->query($sqlActivate);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pszczelarzezpasji4453@gmail.com';
        $mail->Password = 'pszczola9901a24';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
        $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Body = '<p>Witaj ' . $usernameDatabase . '!</p><p>Twoje konto zostało aktywowane przez administratora</p>';
        $mail->addAddress($emailDatabase, $usernameDatabase);
        $showCode = $verification_code;
        $mail->send();

        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Zmieniono stan konta administratora na aktywny.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      } catch (Exception $e) {

        $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Administrator posiada nieistniejący adres email.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      }
    } else if ($_POST['is_verf'] === '0' && $aktualnyStanKonta === '1') {
      try {
        $sqlActivate = "UPDATE adminlist SET is_verifed=0 WHERE id='$userId'";
        $resultActivate = $conn->query($sqlActivate);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pszczelarzezpasji4453@gmail.com';
        $mail->Password = 'pszczola9901a24';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->Subject = 'Zmiana nazwy użytkownika - Pszczelarzezpasji.com';
        $mail->setFrom('pszczelarzezpasji4453@gmail.com', 'Pszczelarzezpasji.com');
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Body = '<p>Witaj ' . $usernameDatabase . '!</p><p>Twoje konto zostało dezaktywowane przez administratora</p>';
        $mail->addAddress($emailDatabase, $usernameDatabase);
        $showCode = $verification_code;
        $mail->send();

        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Zmieniono stan konta administratora na nieaktywny.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      } catch (Exception $e) {

        $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Użytkownik posiada nieistniejący adres email.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      }
    } else {
      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
                Wybrano aktualnie nadany stan konta administratora. Brak zmian.
              </div>
            </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  }

  header("Location: ../../Frontend/AdminMenu/editUsers.php");
}
