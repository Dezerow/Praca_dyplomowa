<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

  $userId = $_POST['id'];
  $result;

  if (isset($_POST['newUsername'])  && $_POST['newUsername'] !== "") {
    $username = $_POST['newUsername'];
    $sql = "UPDATE users SET username='$username' WHERE id='$userId' ";
    $result = $conn->query($sql);
    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nazwa użytkownika została zmieniona 
        </div>
      </div>';
  }
  if (isset($_POST['newUserEmail'])  && $_POST['newUserEmail'] !== "") {
    $email = $_POST['newUserEmail'];
    $sql = "UPDATE users SET email='$email' WHERE id='$userId' ";
    $result = $conn->query($sql);
    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Adres mailowy użytkownika został zmieniony.
        </div>
      </div>';
  } else if (isset($_POST['newUserPassword']) && $_POST['newUserPassword'] !== "") {
    $password = $_POST['newUserPassword'];
    $sql = "UPDATE users SET password='$password' WHERE id='$userId' ";
    $result = $conn->query($sql);
    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło użytkownika zostało zmienione.
        </div>
      </div>';
  } else if (isset($_POST['role']) && $_POST['role'] !== "User") {

    $sqlGet = "SELECT id, username, email,password, register_date from users WHERE id='$userId'";
    $result = $conn->query($sqlGet);
    $row = $result->fetch_assoc();


    $newAdminName = $row['username'];
    $newAdminEmail = $row['email'];
    $newAdminPassword = $row['password'];
    $newAdminRegisterdate = $row['register_date'];


    $sql = "INSERT INTO adminlist(id, username, email, password, register_date)
          VALUES ('', '$newAdminName', '$newAdminEmail', '$newAdminPassword', '$newAdminRegisterdate')";
    $result2 = $conn->query($sql);

    $delete = "DELETE FROM users WHERE id='$userId'";
    $resultDelete = $conn->query($delete);


    $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana roli użytkownika została zakończona sukcesem.
        </div>
      </div>';
  }

  header("Location: ../../Frontend/AdminMenu/editUsers.php");
}
