<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aa02b8a033.js" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>


</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container mt-5">
        <div class="text-center">
            <div>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazUzytkownikow" aria-expanded="false" aria-controls="collapseExample">
                    Wyświetl listę użytkowników
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pokazAdministratorów" aria-expanded="false" aria-controls="collapseExample">
                    Wyświetl listę administratorów
                </button>
            </div>
            <?php
            if (isset($_SESSION['adminUserEdit'])) {
                echo $_SESSION['adminUserEdit'];
                unset($_SESSION['adminUserEdit']);
            }
            ?>
        </div>


        <div class="collapse" id="pokazAdministratorów">
            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


            $sql = "SELECT id, username, email,register_date from adminlist";
            $result = $conn->query($sql);

            ?>
            <table class="table" style="margin-top:100px">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nazwa administratora</th>
                        <th scope="col">Adres email administratora</th>
                        <th>Data utworzenia konta</th>
                        <th scope="col">Edytuj dane administratora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>            
            <form method='POST' action='../../../Praca_dyplomowa/Frontend/AdminMenu/editAdmin.php'>                          
            <td><input type='hidden' name='id' value=" . $row['id'] . ">" . $row['id'] . "</td>
            <td><input type='hidden' name='name' value=" . $row['username'] . ">" . $row['username'] . "</td>
            <td><input type='hidden' name='email' value=" . $row['email'] . ">" . $row['email'] . "</td>
            <td>" . $row['register_date'] . "</td> 
            <td><input class='btn btn-warning' type='submit' value='Edytuj dane administratora' ></td>
            </form>
            </tr>";
                        }
                    }


                    ?>
                </tbody>
            </table>
        </div>


        <div class="collapse" id="pokazUzytkownikow">
            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


            $sql = "SELECT id, username, email, register_date from users";
            $result = $conn->query($sql);

            ?>
            <table class="table" style="margin-top:100px">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nazwa użytkownika</th>
                        <th scope="col">Adres email użytkownika</th>
                        <th scope="col">Data utworzenia konta</th>
                        <th scope="col">Edytuj dane użytkownika</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>  
            <form method='POST' action='../../../Praca_dyplomowa/Frontend/AdminMenu/editUser.php'>                                    
            <td><input type='hidden' name='id' value=" . $row['id'] . ">" . $row['id'] . "</td>
            <td><input type='hidden' name='name' value=" . $row['username'] . ">" . $row['username'] . "</td>
            <td><input type='hidden' name='email' value=" . $row['email'] . ">" . $row['email'] . "</td>
            <td>" . $row['register_date'] . "</td>          
            <td><input class='btn btn-warning' type='submit' value='Edytuj dane użytkownika'></td>
            </form>
            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>