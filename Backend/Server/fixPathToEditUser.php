<?php

$UserId = $_POST['id'];
$Username = $_POST['name'];
$email = $_POST['email'];

header('Location: ../../Frontend/AdminMenu/editUser.php?id=' . $UserId . '&name=' . $Username . '&email=' . $email . '');
