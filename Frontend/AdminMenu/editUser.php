<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <?php
    if (!isset($_SESSION['admin'])) {
        header('Location: ../../Frontend/Main/index.php');
        exit();
    }
    ?>

    <?php
    $UserId = $_POST['id'];
    $Username = $_POST['name'];
    $email = $_POST['email'];
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card-block text-center bg-light" style="width:500px">
                <div class="row ms-2" style="width:480px; background-color:whitesmoke">
                    <div class="col-12"> <i class="fa-regular fa-address-card fa-10x"></i>
                    </div>
                </div>
                <div class="text-start mt-5 ms-3">

                    <div>
                        <div class="mt-5 ms-0">
                            <h3 class="mt-5 ms-2">Edycja użytkownika: <?php echo $Username ?></h3>
                            <hr class="badge-primary mt-0 w-50">
                        </div>
                        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAdminEditUser.php">
                            <div class="mt-5">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazNazweUzytkownika" aria-expanded="false" aria-controls="collapseExample">
                                    Zmień nazwę użytkownika
                                </button>
                            </div>
                            <div class="collapse" id="pokazNazweUzytkownika">
                                <div class="row mt-4">
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>
                                    <div class="col mt-1"><input type="text" placeholder="<?php echo $Username; ?>" name="newUsername" required></div>
                                    <div class="col"> <input type="submit" class="btn btn-success" value="Zatwierdź zmianę nazwy">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAdminEditUser.php">
                            <div class="mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeEmaila" aria-expanded="false" aria-controls="collapseExample">
                                    Zmień adres email użytkownika
                                </button>
                            </div>
                            <div class="collapse" id="pokazEdycjeEmaila">
                                <div class="row mt-4">
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>
                                    <div class="col mt-1"><input type="text" placeholder="<?php echo $email ?>" name="newUserEmail" required></div>
                                    <div class="col"> <input type="submit" class="btn btn-success" value="Zatwierdź email">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAdminEditUser.php">
                            <div class="mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeHasla" aria-expanded="false" aria-controls="collapseExample">
                                    Zmień hasło użytkownika
                                </button>
                            </div>
                            <div class="collapse" id="pokazEdycjeHasla">
                                <div class="row mt-4">
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>
                                    <div class="col mt-1"><input type="password" placeholder="Podaj nowe hasło" name="newUserPassword" required></div>
                                    <div class="col"> <input type="submit" class="btn btn-success" value="Zatwierdź hasło">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAdminEditUser.php">
                            <div class="mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeRoli" aria-expanded="false" aria-controls="collapseExample">
                                    Zmień uprawnienia użytkownika
                                </button>
                            </div>
                            <div class="collapse" id="pokazEdycjeRoli">
                                <div class="row mt-4">
                                    <div class="col mt-0">
                                        <select class="form-select" name="role">
                                            <option value="User">Użytkownik</option>
                                            <option value="Admin">Administrator</option>
                                        </select>
                                    </div>
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>
                                    <div class="col"> <input type="submit" class="btn btn-success" value="Zatwierdź rolę">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/deleteUser.php">
                            <div class="mt-3">
                                <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#pokazUsuwanie" aria-expanded="false" aria-controls="collapseExample">
                                    Usuń użytkownika
                                </button>
                            </div>
                            <div class="collapse" id="pokazUsuwanie">
                                <div class="row mt-4">
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>

                                    <div class="col mt-0">
                                        <select class="form-select" name="deleteUser" id="ConfirmDelete" required onchange="enableDelete()">
                                            <option selected>Czy jesteś pewny?</option>
                                            <option value="No">Nie</option>
                                            <option value="Yes">Tak</option>
                                        </select>
                                    </div>
                                    <input type='hidden' name='id' value='<?php echo $UserId ?>'>
                                    <div class="col"> <input type="submit" id="DeleteButton" disabled class="btn btn-danger" value="Usuń">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>



    <script type="text/javascript">
        function enableDelete() {
            var select = document.getElementById('ConfirmDelete');
            var btn = document.getElementById('DeleteButton');
            if (select.value == "Yes") {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>