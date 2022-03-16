<?php
include '../../Backend/DB_Connection/dbConnect.php';
if (isset(($_SESSION['logged']))) {
    header('../../Frontend/Main/index.php');
    exit(); // Dzięki exit wszystko poniżej się nie wykona, wszystkie instrukcje etc tylko od razu wychodzi do headera
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Register/register.css?v=1.0" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container-fluid mt-5" id="whenLittleMove">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3">
                <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backRegistration.php" class="form-container">
                    <label id="registerTitle">
                        <h4 style=" text-align: center;">Panel Rejestracji</h4>
                    </label>
                    <div class="form-group mt-3">
                        <label for="username">
                            <h5>Nazwa użytkownika</h5>
                        </label>
                        <input type="text" class="form-control" name="username" placeholder="Podaj nazwę użytkownika" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">
                            <h5>Email</h5>
                        </label>
                        <input type="email" class="form-control" name="email" placeholder="Podaj swój adres email:" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">
                            <h5>Hasło</h5>
                        </label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">
                            <h5>Powtórz hasło</h5>
                        </label>
                        <input type="password" class="form-control" name="repeatPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" id="przyciskRejestracji">Zarejestruj się</button>
                </form>
            </section>
        </section>
    </div>
    <?php include "../Components/Footer/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>