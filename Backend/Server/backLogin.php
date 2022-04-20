<?php

session_start();

if ((!isset($_POST['username']) || !isset($_POST['password']))) {
  header('Location: index.php');
  exit();
}

//error_reporting(0);
//Trzeba zakryć info o błędzie połączenie aby użytkownik go nie zobaczył


// Require once uzywamy zamiast require bo dzieki once sprawdzi czy wczesniej pisalismy to wywołanie przez co unikniemy pomylki piszac ten sam kod dwa razy
require_once('../DB_Connection/dbConnect.php'); // Jeśli pliku nie uda się dołączyć bo nie istnieje to funkcja include wygeneruje tylko ostrzeżenie i reszta kodu się wykona, natomiast require wymaga pliku więc jeżeli pliku nie uda się odnaleźć to zostanie zatrzymane wykonywanie skryptu i nie pokaże użytkownikowi prób zapytań do bazy

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = htmlentities($username, ENT_QUOTES, "UTF-8");   // Przepuszczanie przez html entities aby funkcja wstawiła nam automatycznie encje htmla, dzięki temu nie odczyta tekstu jako kod JS, zabiezpieczając nas przed atakiem na naszą strone
  $password = htmlentities($password, ENT_QUOTES, "UTF-8");


  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $_SESSION['user'] = $username;

    $ar = array();
    $_SESSION['userShoppingCart'] = $ar;

    unset($_SESSION['error']);  // TUTAJ MOJE ZWOLNIENIE SESJI
    unset($_SESSION['registerSucc']);  // TUTAJ MOJE ZWOLNIENIE SESJI

    $result->free_result(); // Jest to zwolnienie pamięci, można dać close(); lub free(); lub free-result(); Mega ważne, duży błąd
    header('Location: ../../Frontend/Main/index.php');
  } else {

    $sql2 = "SELECT * FROM adminlist WHERE username='$username' AND password='$password'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
      $row2 = $result2->fetch_assoc();
      $adminName = $row2['username'];
      $_SESSION['admin'] = $adminName;

      unset($_SESSION['error']);
      unset($_SESSION['registerSucc']);

      $result2->free_result();
      header('Location: ../../Frontend/Main/index.php');
    } else {

      $_SESSION['error'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nie znaleziono użytkownika.
        </div>
      </div>';
      header('Location: ../../Frontend/Login/login.php');
    }
  }

  $conn->close();
}
