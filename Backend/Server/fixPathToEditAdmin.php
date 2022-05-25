<?php

$UserId = $_POST['id'];
$Username = $_POST['name'];
$email = $_POST['email'];

header('Location: ../../Frontend/AdminMenu/editAdmin.php?id=' . $UserId . '&name=' . $Username . '&email=' . $email . '');
