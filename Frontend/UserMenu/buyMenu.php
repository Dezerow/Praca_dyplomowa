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
    <link href="../UserMenu/buyMenu.css" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>


    <?php
    require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
    $userName = $_SESSION['user'];
    $sql = "SELECT * from users WHERE username='$userName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>

    <div class="container mt-5 MainContainer" id="whenLittleMove">
        <div class="row">
            <div class="col-6 d-flex justify-content-end">
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <label id="registerTitle">
                            <h4 style=" text-align: center;">Informacje na temat wysyłki</h4>
                        </label>
                        <div class="form-group mt-3">
                            <label for="nameBuy">
                                <h5>Imię</h5>
                            </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="surnameBuy">
                                <h5>Nazwisko</h5>
                            </label>
                            <input type="email" class="form-control" name="surname" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="country">
                                <h5>Kraj</h5>
                            </label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Polska</option>
                                <option value="1">Austria</option>
                                <option value="2">Belgia</option>
                                <option value="3">Bułgaria</option>
                                <option value="4">Cypr</option>
                                <option value="5">Czechy</option>
                                <option value="6">Dania</option>
                                <option value="7">Estonia</option>
                                <option value="8">Finlandia</option>
                                <option value="9">Francja</option>
                                <option value="10">Grecja</option>
                                <option value="11">Hiszpania</option>
                                <option value="12">Holandia</option>
                                <option value="13">Irlandia</option>
                                <option value="14">Litwa</option>
                                <option value="15">Luksemburg</option>
                                <option value="16">Łotwa</option>
                                <option value="17">Malta</option>
                                <option value="18">Niemcy</option>
                                <option value="19">Polska</option>
                                <option value="20">Portugalia</option>
                                <option value="21">Rumunia</option>
                                <option value="22">Słowacja</option>
                                <option value="23">Słowenia</option>
                                <option value="24">Szwecja</option>
                                <option value="25">Węgry</option>
                                <option value="26">Wielka Brytania</option>
                                <option value="27">Włochy</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="street">
                                <h5>Ulica</h5>
                            </label>
                            <input type="text" class="form-control" name="street" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="zipCode">
                                <h5>Kod pocztowy</h5>
                            </label>
                            <input type="text" class="form-control" name="zipCode" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="city">
                                <h5>Miasto</h5>
                            </label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="phoneNumber">
                                <h5>Numer telefonu</h5>
                            </label>
                            <input type="text" class="form-control" name="phoneNumber" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="phoneNumber">
                                <h5>Adres email</h5>
                            </label>
                            <input type="text" class="form-control" name="email" placeholder="<?php echo $row['email'] ?>" required>
                        </div>
                    </div>
                </div>
            </div>


            <?php

            $idZakupu = $_GET['data'];
            $sql = "SELECT * from product_list WHERE id='$idZakupu'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="col-6 d-flex justify-content-start">
                <div class="card" style="width: 26rem;">
                    <div class="card-body">
                        <label id="registerTitle">
                            <h4 style=" text-align: center;">Informacje na temat zakupu</h4>
                        </label>
                        <div class="form-group mt-3">
                            <div class="card border-0 bg-light text-center userProducts mt-5">
                                <div class="d-flex justify-content-center card-body">
                                    <img src="<?php echo $row['product_image'] ?>" class="img-fluid" alt="...">
                                </div>
                                <h6 class="card-body"><?php echo $row['product_name'] ?></h6>
                                <p><?php echo $row['product_price'] ?>zł</p>
                            </div>
                        </div>
                        <h5 class="mt-2">Typ wysyłki:</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="deliveryType" id="flexRadioDefault1" value="0">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Odbiór osobisty: 0zł
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="deliveryType" id="flexRadioDefault2" value="10">
                            <label class="form-check-label" for="flexRadioDefault2">
                                InPost Paczkomaty: 10zł
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="deliveryType" id="flexRadioDefault3" value="12">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Kurier: 12zł
                            </label>
                        </div>
                        <h5 class="mt-2">Typ płatności:</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Payment" id="Payment1" value="1">
                            <label class="form-check-label" for="Payment1">
                                Przelew natychmiastowy
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Payment" id="Payment2" value="1">
                            <label class="form-check-label" for="Payment2">
                                Blik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Payment" id="Payment3" value="1">
                            <label class="form-check-label" for="Payment2">
                                Karta kredytowa
                            </label>
                        </div>

                        <h5>Podsumowanie:</h5>
                        <div><?php echo $row['product_price'] ?> zł</div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success mt-2" id="buyButton">Kupuję i płace</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../Components/Footer/footer.php" ?>

    <script>
        var cenaUslugi = document.querySelector('input[name="deliveryType"]:checked').value;
        var cenaOstateczna = $row['product_price'] + cenaUslugi;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>