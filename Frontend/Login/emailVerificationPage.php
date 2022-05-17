<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Login/login.css" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <?php
    if (isset($_SESSION['user']) || isset($_SESSION['admin']) || !isset($_GET['username'])) {
        header('Location: ../../Frontend/Main/index.php');
        exit();
    }
    ?>

    <div class="container-fluid mt-5 mainContainer" id="whenLittleMove">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3">
                <form action="./../../Backend/Server/backUserVerification.php" method="POST" class="form-container">
                    <label id="Verification">
                        <h4 style=" text-align: center;">Weryfikacja użytkownika</h4>
                    </label>
                    <?php
                    if (isset($_SESSION['verfCode'])) {
                        echo $_SESSION['verfCode'];
                        unset($_SESSION['verfCode']);
                    }
                    ?>
                    <div class="form-group mt-3">
                        <label for="Code">
                            <h5>Podaj kod weryfikacyjny, wysłany na twój adres email</h5>
                        </label>
                        <input hidden name="username" value="<?php echo $_GET['username'] ?>">
                        <input type="text" class="form-control" id="Code" placeholder="Wpisz kod" name="Code">
                    </div>
                    <div id="kontenerPrzyciskZaloguj">
                        <button type="submit" class="btn btn-primary mt-3" id="przyciskLogowania">Zatwierdź kod weryfikacyjny</button>
                    </div>
                </form>

            </section>
        </section>
    </div>
    <?php include "../Components/Footer/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>