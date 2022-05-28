<?php
session_start();
set_include_path(
    '../Navbar/navbar.css' . PATH_SEPARATOR . '../Navbar/navbar.php' . PATH_SEPARATOR .
        '../SpeechToText/SpeechToText_JS_WebKit.js' . PATH_SEPARATOR .  '../Images/Article_Images' . PATH_SEPARATOR . '../Images/Product_Images'
        . PATH_SEPARATOR . '../Images/Static_Images' . PATH_SEPARATOR . '../Footer/footer.css' . PATH_SEPARATOR . '../Footer/footer.php'
        . PATH_SEPARATOR . '../../UserMenu/' . '../../Articles' . '../../Components' . '../../Login' . '../../Main' . '../../ProductList'
        . PATH_SEPARATOR . '../../Register' . '../../SearchResults' . '../../SupportContact' . '../../UserMenu'
);

?>

<link href="../../../../Praca_dyplomowa/Frontend/Components/Navbar/navbar.css?v=1.0 " rel="stylesheet" type="text/css" />

<nav class="navbar navbar-expand-xl navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <div class="collapse collapse navbar-collapse" id="BigMenu">
            <a class="navbar-brand MainHref" href="../../../../Praca_dyplomowa/Frontend/Main/index.php">Strona główna</a>
            <a class="navbar-brand" href="../../../../Praca_dyplomowa/Frontend/ProductList/productList.php">Produkty</a>
            <a class="navbar-brand" href="../../../../Praca_dyplomowa/Frontend/Articles/articles.php">Artykuły</a>
        </div>

        <form action="../../../../Praca_dyplomowa/Backend/Server/backSearchChangeData.php" method="POST" class="navbar-nav" id="searchMenu">
            <select class="form-select text-center" name="searchCategory" id="selectCategory">
                <option value="Products">Produkty</option>
                <option value="Articles">Artykuły</option>
            </select>
            <input class="form-control me-2" pattern="^[A-Za-z0-9śćźóżŚĆŹŻÓ ]{0,25}" id="inputSzukaj" name="search" placeholder="Co chcesz znaleźć?">
            <i id="Nagraj_glos" class="fa-solid fa-volume-high fa-2xl mt-3"></i>
            <button class="btn btn-outline-success ms-2" id="szukaj" type="submit">Szukaj</button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#LittleNavMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse collapse navbar-collapse newLittleMenu" id="LittleNavMenu">
            <a class="navbar-brand alittle alittleMainHref" href="../../../../Praca_dyplomowa/Frontend/Main/index.php">Strona główna</a>
            <a class="navbar-brand alittle" href="../../../../Praca_dyplomowa/Frontend/ProductList/productList.php">Produkty</a>
            <a class="navbar-brand alittle" href="../../../../Praca_dyplomowa/Frontend/Articles/articles.php">Artykuły</a>
        </div>


        <div class="collapse collapse navbar-collapse" id="LittleNavMenu">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<li class="nav-item login"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/UserMenu/userMenu.php"><i style="margin-right: 5px" class="fas fa-user"></i>' . $_SESSION['user'] . '</a></li>
                    <li class="nav-item login"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/UserMenu/shoppingCart.php"><i style="margin-right: 5px" class="fa-solid fa-cart-shopping"></i><sup>' . count($_SESSION['userShoppingCart']) . '</sup>
                    Koszyk</a></li>
                            <li class="nav-item logout"><a class="nav-link" href="../../../../Praca_dyplomowa/Backend/Server/backLogout.php"><i style="margin-right: 5px" class="fas fa-user-plus"></i>Wyloguj</a></li>';
                } else if (isset($_SESSION['admin'])) {
                    echo '<li class="nav-item login"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/AdminMenu/adminMenu.php"><i style="margin-right: 5px" class="fas fa-user"></i>' . $_SESSION['admin'] . '</a></li>
                    <li class="nav-item login"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/UserMenu/shoppingCart.php"><i style="margin-right: 5px" class="fa-solid fa-cart-shopping"></i><sup>' . count($_SESSION['userShoppingCart']) . '</sup>
                    Koszyk</a></li>
                            <li class="nav-item logout"><a class="nav-link" href="../../../../Praca_dyplomowa/Backend/Server/backLogout.php"><i style="margin-right: 5px" class="fa-solid fa-arrow-right-from-bracket"></i>Wyloguj</a></li>';
                } else {
                    echo '<li class="nav-item login"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/Login/login.php"><i style="margin-right: 5px" class="fas fa-user"></i>Logowanie</a></li>
                            <li class="nav-item logout"><a class="nav-link" href="../../../../Praca_dyplomowa/Frontend/Register/register.php"><i style="margin-right: 5px" class="fas fa-user-plus"></i>Rejestracja</a></li>';
                }
                ?>
            </ul>
        </div>


    </div>
</nav>

<script src="https://kit.fontawesome.com/aa02b8a033.js" crossorigin="anonymous"></script>
<script src="../../../../Praca_dyplomowa/Frontend/Components/SpeechToText/SpeechToText_JS_WebKit.js"></script>