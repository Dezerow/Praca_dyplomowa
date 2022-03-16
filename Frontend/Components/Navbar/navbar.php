<?php
session_start();

?>


<link href="../../../../Praca/Frontend/Components/Navbar/navbar.css?v=1.0 " rel="stylesheet" type="text/css" />

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top DUPA">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../../../Praca/Frontend/Main/index.php">Strona główna</a>
        <div class="row" id="wyszukiwarka">
            <div class="col px-0">
                <input class="form-control me-2" id="inputSzukaj" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="col px-0">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#onDisplayResolutionChange" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse collapse justify-content-end navbar-collapse" id="onDisplayResolutionChange">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="../../../../Praca/Frontend/UserMenu/userMenu.php"><i style="margin-right: 5px" class="fas fa-user"></i>' . $_SESSION['user'] . '</a></li>
                            <li class="nav-item"><a class="nav-link" href="../../../../Praca/Backend/Server/backLogout.php"><i style="margin-right: 5px" class="fas fa-user-plus"></i>Wyloguj się</a></li>';
                } else if (isset($_SESSION['admin'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="../../../../Praca/Frontend/AdminMenu/adminMenu.php"><i style="margin-right: 5px" class="fas fa-user"></i>' . $_SESSION['admin'] . '</a></li>
                            <li class="nav-item"><a class="nav-link" href="../../../../Praca/Backend/Server/backLogout.php"><i style="margin-right: 5px" class="fa-solid fa-arrow-right-from-bracket"></i>Wyloguj się</a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="../../../../Praca/Frontend/Login/login.php"><i style="margin-right: 5px" class="fas fa-user"></i> Zaloguj się</a></li>
                            <li class="nav-item"><a class="nav-link" href="../../../../Praca/Frontend/Register/register.php"><i style="margin-right: 5px" class="fas fa-user-plus"></i> Zarejestruj się</a></li>';
                }
                ?>
            </ul>
        </div>
</nav>