<?php
session_start();

require_once('../DB_Connection/dbConnect.php');
$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {
  $code = $_POST['Code'];
  $code = htmlentities($code, ENT_QUOTES, "UTF-8");
  $username = $_POST['username'];
  $username = htmlentities($username, ENT_QUOTES, "UTF-8");
  $sql = "SELECT * FROM users WHERE verification_code='$code'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['username'] === $username) {
      $sql2 = "UPDATE users SET is_verifed='1' WHERE verification_code='$code'";
      $result2 = $conn->query($sql2);
      $_SESSION['registerSucc'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Kod weryfikacyjny potwierdzony, zaloguj się.
            </div>
          </div>';
      header('Location: ../../Frontend/Login/login.php');
    } else {
      $_SESSION['verfCode'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Podany użytkownik nie posiada takiego kodu weryfikacyjnego.
            </div>
          </div>';
      header('Location: ../../Frontend/Login/emailVerificationPage.php?username=' . $username . '');
    }
  } else {
    $_SESSION['verfCode'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Błędny kod weryfikacyjny.
        </div>
      </div>';
    header('Location: ../../Frontend/Login/emailVerificationPage.php?username=' . $username . '');
  }
}
