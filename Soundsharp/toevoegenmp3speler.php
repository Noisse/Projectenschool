<?php
session_start();
if ($_SESSION['ingelogt'] == false) {
    header("Location: wachtwoord.php");
}
?>
<!DOCTYPE html>
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
            <h1>Toevoegen MP3 speler</h1>
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
            $make = "";
            $model = "";
            $mbsize = "";
            $price = "";
            $voorraad = "";
            
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //echo "Formulier hierna gaan verwerken";

                if (isset($_POST['make']) && ($_POST['model']) && ($_POST['mbsize']) && ($_POST['price']) && ($_POST['voorraad'])) {
                    $make = $_POST ['make'];
                    $model = $_POST ['model'];
                    $mbsize = $_POST ['mbsize'];
                    $price = $_POST ['price'];
                    $voorraad = $_POST ['voorraad'];

                    //checken op numeric
                    if (empty($make)){
                       ?>
                        <br><br>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Vul alstublieft het merk in <strong>Maker</strong>.
                        </div>
                        <?php 
                    }
                    if (empty($model)){
                        ?>
                        <br><br>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Vul alstublieft het model in <strong>Model</strong>.
                        </div>
                        <?php
                    }
                    if (!is_numeric($mbsize) OR empty($mbsize)) {
                        ?>
                        <br><br>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Vul alstublieft een nummer in <strong>MBsize</strong>.
                        </div>
                        <?php
                    }
                    if (!is_numeric($price)OR empty ($price)) {
                        ?>
                        <br><br>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Vul alstublieft een nummer in <strong>Prijs</strong>.
                        </div>
                        <?php
                    }
                    if (!is_numeric($voorraad)OR empty($voorraad)) {
                        ?>
                        <br><br>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Vul alstublieft een nummer in <strong>Voorraad</strong>.
                        </div>
                        <?php    
                    }

                    $sql = "INSERT INTO mpmodel (make, model, mbsize, price, voorraad) VALUES ('$make', '$model', $mbsize, $price, $voorraad)";

                    if ($conn->query($sql) === TRUE) {
                        ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Record succusfully added.
                        </div>
                        <?php
                    }
//                    else {
//                        echo "Error: " . $sql . "<br>" . $conn->error;
//                    }
                    $conn->close();
                }
            }
            ?>
            <br><br><br>
            <form class="form-horizontal" role="form" action="toevoegenmp3speler.php" method="post">

                <div class="form-group">
                    <label for="maker" class="col-sm-1">Maker:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="make" placeholder="Maker" value="<?php echo $make; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="model" class="col-sm-1">Model:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="model" placeholder="Model" value="<?php echo $model; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mbsize" class="col-sm-1">MBsize:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="mbsize" placeholder="MBsize" value="<?php echo $mbsize; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="price" class="col-sm-1">Prijs:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="price" placeholder="Prijs" value="<?php echo $price; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="voorraad" class="col-sm-1">Voorraad:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="voorraad" placeholder="Voorraad"value="<?php echo '500'; ?>">
                    </div>
                </div>

                <input type="submit" class="btn btn-success">
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>