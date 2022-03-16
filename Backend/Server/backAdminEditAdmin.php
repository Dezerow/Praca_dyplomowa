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
        $sql = "UPDATE adminlist SET username='$username' WHERE id='$userId' ";
        $result = $conn->query($sql);
        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nazwa administratora została zmieniona 
        </div>
      </div>';
        echo $userId;
    }
    if (isset($_POST['newUserEmail'])  && $_POST['newUserEmail'] !== "") {
        $email = $_POST['newUserEmail'];
        $sql = "UPDATE adminlist SET email='$email' WHERE id='$userId' ";
        $result = $conn->query($sql);
        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Adres mailowy administratora został zmieniony.
        </div>
      </div>';
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
    } else if (isset($_POST['role']) && $_POST['role'] !== "Admin") {

        $sqlGet = "SELECT id, username, email,password, register_date from adminlist WHERE id='$userId'";
        $result = $conn->query($sqlGet);
        $row = $result->fetch_assoc();


        $newUserName = $row['username'];
        $newUserEmail = $row['email'];
        $newUserPassword = $row['password'];
        $newUserRegisterdate = $row['register_date'];


        $sql = "INSERT INTO users(id, username, email, password, register_date)
          VALUES ('', '$newUserName', '$newUserEmail', '$newUserPassword', '$newUserRegisterdate')";
        $result2 = $conn->query($sql);

        $delete = "DELETE FROM adminlist WHERE id='$userId'";
        $resultDelete = $conn->query($delete);


        $_SESSION['adminUserEdit'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana roli administratora została zakończona sukcesem.
        </div>
      </div>';
    }

    header("Location: ../../Frontend/AdminMenu/editUsers.php");
}
