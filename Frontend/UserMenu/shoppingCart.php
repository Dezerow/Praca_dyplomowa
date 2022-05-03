<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/UserMenu/shoppingCart.css" rel="stylesheet" type="text/css" />


</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container" id="MainContent">
        <h2 class="d-flex justify-content-center" style="margin-top:40px">Koszyk użytkownika</h2>
        <div class="row mt-5">
            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
            $cena = 0;

            echo '                        
            <div class="col-md-4 col-sm-12 d-flex justify-content-center"></div>
            <div class="col-md-4 col-sm-4 d-flex justify-content-left toHideShoppingCart"><h5>Spis dodanych produktów:</h5></div>
            <div class="col-md-4 col-sm-8">
                <h5>Podsumowanie</h5>
                <div class="d-flex justify-content-left">
                    Ilość produktów w koszyku: 
                        <h5 class="ms-2" style="color:red">' . count($_SESSION['userShoppingCart']) . ' </h5>                                    
                </div>
                <div class="d-flex justify-content-left">
                    Cena całkowita: 
                        <h5 class="ms-2" style="color:red">' . $_SESSION['CartTotalPrice'] . ' zł</h5>                                    
                 </div>
                 <div class="d-flex justify-content-left">
                 <form method="POST" action="../UserMenu/buyMenu.php">
                   <input hidden name="buyFromShoppingCart">
                   <input type="submit" class="btn btn-success" value="Zakup dodane produkty">  
                 </form>                                                    
                 </div>
            </div> ';
            echo '<div class="row">';
            foreach ($_SESSION['userShoppingCart'] as $singleProduct) {
                $sql = "SELECT * from product_list WHERE id='$singleProduct'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo '    
                        <div class="col-md-4 col-sm-6">
                        <div class="card border-0 bg-light text-center userProducts mt-5">
                            <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=' . $row['id'] . '" class="Products">
                                <div class="d-flex justify-content-center card-body">
                                    <img src="' . $row['product_image'] . '" class="img-fluid" alt="...">
                                </div>
                                <h6 class="card-body">' . $row['product_name'] . '</h6>
                                <p>' . $row['product_price'] . ' zł</p>
                            </a>
                            <form method="POST" action="../../Backend/Server/backDeleteFromShoppingCart.php">
                            <input name="id" hidden value=' . $row['id'] . '>
                            <button style="width:100%" class="btn btn-danger">Usuń z koszyka</button>
                            </form>
                        </div>
                        </div>
                        ';
            }
            echo ' </div>';



            ?>
        </div>
    </div>

    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>