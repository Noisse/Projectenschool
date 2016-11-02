
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
            <h1>Statistische gegevens</h1>
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
            } else {
                $sql = "SELECT * FROM `mpmodel`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $voorraadtotaal = 0;
                    $prijstotaal = 0;
                    $prijsgemiddeld = 0;
                    $prijspermb = 0;
                    $besteprijs = 99999999;
                    $idplayer = 0;
                    ?>
                    <br>
                    <br>
                    <br>
                    <table class="table vertical-align">
                        <thead>
                            <tr>
                                <th rowspan="3">ID</th>
                                <th rowspan="1">Beste prijs per MB</th>
                            </tr>
                        </thead>
                        <?php
                        $rowcounter = 0;
                        $prijstotaalperproduct = 0;
                        while ($row = $result->fetch_assoc()) {
                            $voorraadtotaal = $voorraadtotaal + $row['voorraad'];
                            $prijstotaal = $prijstotaal + ($row['price'] * $row['voorraad']);
                            $prijstotaalperproduct += $row['price'];
                            $rowcounter = $rowcounter + 1;
                            $prijspermb = $row['mbsize'] / $row['price'];
                            $prijsgemiddeld = $prijstotaalperproduct / $rowcounter;

                            //Goedkoopste mp3speler per mb wordt hier uitgerekent
                            if ($prijspermb < $besteprijs) {
                                $besteprijs = $prijspermb;
                                $idplayer = $row['id'];
                            }
                        }
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $idplayer ?></td>
                                <td><?= "&euro; " . number_format((float) $besteprijs, 2, '.', ''); ?></td>
                            </tr>
                        </tbody>
                    </table>
                        <table class="table vertical-align">
                            <br>
                            <br>
                        <thead>
                            <tr>
                                <th>Prijs totaal</th>
                                <th>Voorraad Totaal</th>
                                <th>Gemiddelde prijs</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                            <tr>
                                <td><?= "&euro; " . $prijstotaal ?></td>
                                <td><?= $voorraadtotaal ?></td>
                                <td><?= "&euro; " . number_format((float) $prijsgemiddeld, 2, '.', ''); ?></td>
                            </tr>
                            <?php
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
