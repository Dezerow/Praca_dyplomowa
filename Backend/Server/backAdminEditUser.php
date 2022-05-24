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
  $zapytanieSql = "SELECT * FROM users WHERE id='$userId'";
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

      $sql = "UPDATE users SET username='$username' WHERE id='$userId' ";
      $result = $conn->query($sql);
      $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nazwa użytkownika została zmieniona 
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
            Użytkownik posiada nieistniejący adres email. ' . $emailDatabase . ' 
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

        $sql = "UPDATE users SET email='$email' WHERE id='$userId' ";
        $result = $conn->query($sql);
        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Adres mailowy użytkownika został zmieniony.
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
             Podano nieistniejący adres email 1 blad ze starym. ' . $emailDatabase;
          $usernameDatabase . '
          </div>
        </div>';
        }
      } catch (Exception $e) {

        $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Podano nieistniejący adres email 2 blad z nowym.
            </div>
          </div>';
        header("Location: ../../Frontend/AdminMenu/editUsers.php");
      }
    }
  } else if (isset($_POST['newUserPassword']) && $_POST['newUserPassword'] !== "") {
    $password = $_POST['newUserPassword'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password='$hashedPassword' WHERE id='$userId' ";
    $result = $conn->query($sql);
    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło użytkownika zostało zmienione.
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
              Użytkownik posiada nieistniejący adres email.
            </div>
          </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  } else if (isset($_POST['role']) && $_POST['role'] !== "User") {

    $sqlGet = "SELECT * from users WHERE id='$userId'";
    $result = $conn->query($sqlGet);
    $row = $result->fetch_assoc();


    $newAdminName = $row['username'];
    $newAdminEmail = $row['email'];
    $newAdminPassword = $row['password'];
    $newAdminRegisterdate = $row['register_date'];
    $newAdminVerfCode = $row['verification_code'];
    $newAdminIsVerf = $row['is_verifed'];


    $sql = "INSERT INTO adminlist(id, username, email, password, register_date, verification_code, is_verifed)
          VALUES ('', '$newAdminName', '$newAdminEmail', '$newAdminPassword', '$newAdminRegisterdate', '$newAdminVerfCode', '$newAdminIsVerf')";
    $result2 = $conn->query($sql);

    $delete = "DELETE FROM users WHERE id='$userId'";
    $resultDelete = $conn->query($delete);


    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana roli użytkownika została zakończona sukcesem.
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
      $mail->Body = '<p>Witaj ' . $newAdminName . '!</p><p>Twoje uprawnienia zostały podniesione do administratora. Gratulujemy i liczymy na owocną współpracę!</p>';
      $mail->addAddress($emailDatabase, $newAdminName);
      $showCode = $verification_code;
      $mail->send();
    } catch (Exception $e) {

      $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
                Użytkownik posiada nieistniejący adres email.
              </div>
            </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  } else if (isset($_POST['role']) && $_POST['role'] === "User") {
    $_SESSION['adminUserEdit'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Wybrano ustaloną aktualnie rolę użytkownika, nie naniesiono zmian.
    </div>
  </div>';
    header("Location: ../../Frontend/AdminMenu/editUsers.php");
  } else if (isset($_POST['is_verf'])) {
    $Sql = "SELECT * FROM users WHERE id='$userId'";
    $wyniki = $conn->query($Sql);
    $wiersz = $wyniki->fetch_assoc();
    $aktualnyStanKonta = $wiersz['is_verifed'];

    if ($_POST['is_verf'] === '1' && $aktualnyStanKonta === '0') {
      try {
        $sqlActivate = "UPDATE users SET is_verifed=1 WHERE id='$userId'";
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
              Zmieniono uprawnienia użytkowniaka na stan aktywny.
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
    } else if ($_POST['is_verf'] === '0' && $aktualnyStanKonta === '1') {
      try {
        $sqlActivate = "UPDATE users SET is_verifed=0 WHERE id='$userId'";
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
            Zmieniono uprawnienia użytkowniaka na stan nieaktywny.
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
                Wybrano aktualnie nadany stan konta użytkownika. Brak zmian.
              </div>
            </div>';
      header("Location: ../../Frontend/AdminMenu/editUsers.php");
    }
  }

  header("Location: ../../Frontend/AdminMenu/editUsers.php");
}
