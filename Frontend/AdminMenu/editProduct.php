<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../Praca_dyplomowa/Frontend/AdminMenu/AdminMenuCss/editArticle.css" rel="stylesheet" type="text/css" />

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
    $productId;
    if (isset($_POST['id'])) {
        $productId = $_POST['id'];
    } else if (isset($_SESSION['zapisaneID'])) {
        $productId = $_SESSION['zapisaneID'];
    }

    require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


    $sql = "SELECT id, product_name, product_description, product_price, product_image, product_article from product_list WHERE id='$productId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>

    <div class="container py-5">
        <h1 class="text-center">Podgląd artykułu </h1>
        <div class="row">
            <div class="col-6"> <img src="<?php echo $row['product_image'] ?>" id="EditProductPhoto" alt="" class="img-fluid mb-3 mt-4"> </div>
            <div class="col-6">
                <h3 class="d-flex justify-content-center mt-3"><?php echo $row['product_name'] ?></h3>
                <div class="d-flex justify-content-center mt-3 card">
                    <div class="card-body">
                        <?php echo $row['product_description'] ?>
                        </br>
                        </br>
                        Przypisany do artykułu o kluczu: <?php echo $row['product_article'] ?>
                        </br>
                        </br>
                        Cena: <?php echo $row['product_price'];  ?>zł
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-center mt-3">Panel edycji produktu</h1>
            <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backEditProduct.php">
                <input type='hidden' name='id' value="<?php echo $productId; ?>">
                <div>


                    <div class="row">
                        <div class="col-6">
                            <div class="mt-5">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeNazwy" aria-expanded="false" aria-controls="collapseExample">
                                    Zmień nazwę produktu
                                </button>
                            </div>
                            <div class="collapse" id="pokazEdycjeNazwy">
                                <div class="mt-3"><input type="text" name="newProductName" required style="width: 450px;"></div>
                                <div class="mt-4"> <input type="submit" class="btn btn-success" value="Zatwierdź zmianę nazwy">
                                </div>
                            </div>


                            <div class="mt-5">
                                <div class="mt-5">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeKlucza" aria-expanded="false" aria-controls="collapseExample">
                                        Zmień klucz produktu
                                    </button>
                                </div>
                                <div class="collapse" id="pokazEdycjeKlucza">
                                    <div class="mt-3">
                                        <div class="mt-3"><input type="text" name="newProductKey" style="width: 150px;"></div>
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" class="btn btn-success" value="Zatwierdź zmianę klucza">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="mt-5">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeCeny" aria-expanded="false" aria-controls="collapseExample">
                                        Zmień cenę produktu
                                    </button>
                                </div>
                                <div class="collapse" id="pokazEdycjeCeny">
                                    <div class="mt-3">
                                        <div class="mt-3"><input type="number" min="1" name="newProductPrice" style="width: 150px;"></div>
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" class="btn btn-success" value="Zatwierdź zmianę ceny">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="mt-5">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazEdycjeTresci" aria-expanded="false" aria-controls="collapseExample">
                                        Zmień opis produktu
                                    </button>
                                </div>
                                <div class="collapse" id="pokazEdycjeTresci">
                                    <div class="mt-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="newProductContent" rows="4" col="5" placeholder="Maksymalnie 50 znaków"></textarea>
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" class="btn btn-success" value="Zatwierdź zmianę opisu produktu">
                                    </div>
                                </div>
                            </div>
            </form>

            <form method="POST" action="../../Backend/Server/backDeleteProduct.php">
                <input type='hidden' name='id' value="<?php echo $productId; ?>">
                <div class="mt-5">
                    <div class="mt-5">
                        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#pokazUsuwanie" aria-expanded="false" aria-controls="collapseExample">
                            Usuń produkt
                        </button>
                    </div>
                    <div class="collapse" id="pokazUsuwanie">
                        <div class="mt-4">
                            <input type="submit" class="btn btn-danger" name="DeleteProduct" value="Zatwierdź usunięcie produktu">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-6">
            <div id="wrapper" class="mt-4">

                <div id="text_div">
                    <form method="post" action="../../Backend/Server/backImageProductUpload.php">
                        <input type='hidden' name='id' value=<?php
                                                                if (isset($_POST['id'])) {
                                                                    echo $_POST['id'];
                                                                } else if (isset($_SESSION['zapisaneID'])) {
                                                                    echo $_SESSION['zapisaneID'];
                                                                }
                                                                ?>>
                        <input type="text" onkeyup="unblockButton()" name="image_name" id="image_name" <?php if (!isset($_SESSION['path'])) {
                                                                                                            echo 'required';
                                                                                                        } ?> placeholder="Podaj nazwę zdjęcia">
                        <input type="text" onkeyup="unblockButton()" name="image_url" id="image_url" <?php if (!isset($_SESSION['path'])) {
                                                                                                            echo 'required';
                                                                                                        } ?> placeholder="Podaj link do zdjęcia">
                        <input type="submit" disabled name="save_image" id="save_image" value="Wyślij zdjęcie">
                        <img class="mt-3" style="max-width: 350px; max-height: 350px" src="<?php if (isset($_SESSION['path'])) {
                                                                                                echo $_SESSION['path'];
                                                                                            } ?>">
                        <?php
                        if (isset($_SESSION['path'])) {
                            echo '
                                <form action="../../Backend/Server/backImageProductUpload.php" method="POST">';
                        ?>

                            <input type="hidden" name="id" value=<?php
                                                                    if (isset($_SESSION["zapisaneID"])) {
                                                                        echo $_SESSION["zapisaneID"];
                                                                    }
                                                                    ?>>
                            </br>
                        <?php
                            echo '
                                <input type="submit" name="upload_image" class="btn btn-success mt-3" value="Czy chcesz zatwierdzić zdjęcie?">
                                </form>                                
                                ';
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script>
        function unblockButton() {
            if (document.getElementById("image_name").value === "" || document.getElementById("image_url").value === "") {
                document.getElementById('save_image').disabled = true;
            } else {
                document.getElementById('save_image').disabled = false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>