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
            .table th {
                text-align: center;
            }
            .table td {
                text-align: center;   
            }
        </style>
        <title>Soundsharp</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Overzicht mp3</h1>
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

            $sql = "SELECT * FROM `mpmodel`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                ?>
                <br>
                <br>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Maker</th>
                            <th>Model</th>
                            <th>MBsize</th>
                            <th>Prijs</th>
                            <th>Voorraad</th>           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['make']; ?></td>
                                <td><?= $row['model']; ?></td>
                                <td><?= $row['mbsize']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['voorraad']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>