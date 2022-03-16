<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

    $username = $_POST['adminname'];
    $result;

    if (isset($_POST['newAdminEmail'])  && $_POST['newAdminEmail'] !== "") {
        $email = $_POST['newAdminEmail'];
        $sql = "UPDATE adminlist SET email='$email' WHERE username='$username' ";
        $result = $conn->query($sql);
        $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Potwierdzenie zmiany zostało wysłane. Sprawdź skrzynkę pocztową.
        </div>
      </div>';
    } else if (isset($_POST['newAdminPassword']) && $_POST['newAdminPassword'] !== "") {
        $password = $_POST['newAdminPassword'];
        $sql = "UPDATE adminlist SET password='$password' WHERE username='$username' ";
        $result = $conn->query($sql);
        $_SESSION['daneZmienione'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Hasło zostało zmienione.
        </div>
      </div>';
    }

    header("Location: ../../Frontend/AdminMenu/adminMenu.php");
}
