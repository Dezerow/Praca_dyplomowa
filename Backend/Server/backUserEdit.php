<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

  $username = $_POST['username'];
  $result;

  if (isset($_POST['newUserEmail'])  && $_POST['newUserEmail'] !== "") {
    $email = $_POST['newUserEmail'];
    $sql = "UPDATE users SET email='$email' WHERE username='$username' ";
    $result = $conn->query($sql);
    $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Potwierdzenie zmiany zostało wysłane. Sprawdź skrzynkę pocztową.
        </div>
      </div>';
  } else if (isset($_POST['newUserPassword']) && $_POST['newUserPassword'] !== "") {
    $password = $_POST['newUserPassword'];
    $sql = "UPDATE users SET password='$password' WHERE username='$username' ";
    $result = $conn->query($sql);
    $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło zostało zmienione.
        </div>
      </div>';
  }

  header("Location: ../../Frontend/UserMenu/userMenu.php");
}
