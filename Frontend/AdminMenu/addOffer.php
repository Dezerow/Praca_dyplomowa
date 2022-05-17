<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../Praca_dyplomowa/Frontend/AdminMenu/AdminMenuCss/addArticle.css" rel="stylesheet" type="text/css" />

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

    <div class="container py-5">
        <h1 class="text-center">Panel zamieszczania oferty do witryny</h1>
        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAddProduct.php">
            <div class="row">
                <div class="col-6">
                    <div id="wrapper">
                        <div id="text_div">
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
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-center mt-3 card">
                        <h5 class="d-flex justify-content-center mt-3">
                            <div class="mt-3">Podaj nazwę produktu</div>
                        </h5>
                        <div class="d-flex justify-content-center mt-3">
                            <input type="text" name="ProductName" id="ProductName" onkeyup="unblockAddOffer()" style="width: 250px;">
                        </div>

                        <div class="card-body">
                            <h5 class="d-flex justify-content-center mt-3">
                                Podaj w miarę krótki opis produktu
                            </h5>
                            <div class="mt-3">
                                <textarea class="form-control" name="ProductDesc" id="ProductDesc" onkeyup="unblockAddOffer()" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="d-flex justify-content-center mt-3">
                                Podaj cenę produktu
                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <input type="number" min="1" name="ProductPrice" id="ProductPrice" value="1" onkeyup="unblockAddOffer()" style="width: 150px;">
                                <h5 class="ms-1 mt-1"> zł</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="d-flex justify-content-center mt-3">
                                Podaj klucz produktu(Służy do łączenia z artykułami)
                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <input type="text" name="ProductKey" id="ProductKey" onkeyup="unblockAddOffer()" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <input type="submit" name="addToDatabase" id="addToDatabase" class="btn btn-success mt-5" disabled value="Zatwierdź nową ofertę" style="height: 60px; width:400px; font-size: 20px">
            </div>
        </form>
    </div>


    <?php include "../Components/Footer/footer.php" ?>

    <script>
        function unblockButton() {
            if (document.getElementById("image_name").value === "" || document.getElementById("image_url").value === "") {
                document.getElementById('save_image').disabled = true;
            } else {
                document.getElementById('save_image').disabled = false;
            }
        }

        function unblockAddOffer() {


            <?php
            $checkIfPhotoAdded = 0;
            if (isset($_SESSION['path'])) {
                $checkIfPhotoAdded = 1;
            } ?>

            enableButton = '<?php echo $checkIfPhotoAdded; ?>';

            if (document.getElementById("ProductName").value === "" || document.getElementById("ProductDesc").value === "" || document.getElementById("ProductPrice").value === "" || enableButton === "0" || document.getElementById("ProductKey").value === "") {
                document.getElementById('addToDatabase').disabled = true;
            } else {
                document.getElementById('addToDatabase').disabled = false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>