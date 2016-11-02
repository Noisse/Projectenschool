<!DOCTYPE html>
<?php
session_start();
if ($_SESSION['ingelogt'] == false) {
    header("Location: wachtwoord.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .panel-heading {
                color: black;
                background-color: lightcoral;
                border-style: solid;
                border-bottom-width: 1px;
                border-right-width: 1px;
                border-left-width: 1px;
                border-top-width: 1px;
            }
            .panel-body{
                border-style: solid;
                border-color: green;
                border-bottom-width: 2px;
                border-right-width: 2px;
                border-left-width: 2px;
                border-top-width: 2px;
                background-color: lightgreen;
            }
        </style>
        <title>Soundsharp</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Muteer voorraad</h1>
            <div class="panel-title-text text-right">
                <a class="btn btn-default" href="wachtwoord.php">Logout</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="panel-title-text text-center">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="index.php" button type="button" class="btn btn-default">Home</a>
                                <a href="overzichtmp3.php" button type="button" class="btn btn-default">Overzicht mp3 spelers</a>
                                <a href="Voorraadmp3spelers.php" button type="button" class="btn btn-default">Overzicht voorraad</a>
                                <a href="muteervoorraad.php" button type="button" class="btn btn-default">Muteer voorraad</a>
                                <a href="toevoegenmp3speler.php" type="button" class="btn btn-default">Toevoegen mp3 speler</a>
                                <a href="Statistichegegevens.php" type="button" class="btn btn-default">Statistische gegevens</a>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mpmodel";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?>

            <?php
            if (isset($_POST['id']) && ($_POST['voorraad'])) {
                $id = $_POST ['id'];
                $voorraad = $_POST ['voorraad'];

                $sql = "UPDATE mpmodel SET voorraad='$voorraad' WHERE id='$id'";
                //Kijkt of je nog geconnect bent met de database en geeft een goedkeuring
                //of foutmelding
                if ($conn->query($sql) === TRUE) {
                    ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> Record updated successfully
                    </div>
                    <?php
//                        echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            $conn->close();
            ?>
            <br><br><br>
            <form class="form-horizontal" role="form"  action = "muteervoorraad.php" method = "post">
                <div class="form-group">
                    <label for="ID" class="col-sm-1">ID:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="id" placeholder="ID">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Voorraad" class="col-sm-1">Voorraad:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="voorraad" placeholder="Voorraad">
                    </div>
                </div>
                <input type="submit" class="btn btn-success" ahref = "muteervoorraad.php">
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>