<?php

session_start();
session_unset();

header('Location: ../../Frontend/Main/index.php');
