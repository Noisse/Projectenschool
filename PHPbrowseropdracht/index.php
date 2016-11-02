<!DOCTYPE html>       
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Filebrowser</title>


        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <style type="text/css">
            textarea{
                width: 100%;
                height: 400px;
            }
            a:hover {
                text-decoration: none;
            }
            .panel-info > .panel-heading {
                color: black;
                background-color: lightskyblue;
            }
            .panel-info{
                border-color: lightblue;                 
            }
            .panel-default{
                border-color: lightblue;
            }
            .breadcrumb{
                color: black;
                background-color: lightblue;
            }
        </style>
    </head> 
    <body>
        <?php
        if (isset($_GET['map'])) {
            $dir = $_GET['map'];
            $dir = realpath($dir) . "\\";
        } else {
            //Laat de nu in werkende directory zien.
            $dir = getcwd() . "\\";
        }

        //Scandir laat zien wat er in de map zit
        $files = scandir($dir);

        //Mappen en bestanden ophalen.
        function breadcrum() {
            if (isset($_GET['map'])) {
                $dir = $_GET['map'];
                $dir = realpath($dir);

                //Scandir laat zien wat er in de map zit
                $files = scandir($dir);

                $dir = str_replace(getcwd(), "", $dir);
                $crum = explode("\\", $dir);
                $link = getcwd() . "\\";
                foreach ($crum as $breadcrum) {
                    $link = $link . $breadcrum . "/";
                    echo '<a href=index.php?map=' . $link . '>' . $breadcrum . "</a>\\";
                }
            }
        }
        ?>
        <div class="container">

            <h1><i class=""></i>Filebrowser</h1>

            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="#"><?php breadcrum() ?></a></li>
            </ol>

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-sitemap"></i>Mappen</div>
                        <div class="panel-body">
                            <?php
                            //Hier echo ik mappen mee
                            foreach ($files as $value) {
                                if (is_dir($dir . $value)) {
                                    if ($value == ".") {
                                        
                                    } elseif ($value == ".." && $dir == 'C:\XAMPP\htdocs\PHPbrowseropdracht\\') {
                                        
                                    } else {
                                        //Link naar de map van de directory
                                        $map = realpath($dir);
                                        echo '<a href="index.php?map=' . $dir . $value . '"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;' . $value . "</a><br />";
                                        //Hier heb ik de terug knop tot mij C: schijf uitgezet. als het werkt
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>  
                <div class = "col-md-3">
                    <div class = "panel panel-info">
                        <div class = "panel-heading"><i class = "fa fa-sitemap"></i>Bestanden</div>
                        <div class = "panel-body">
                            <?php
//Hier echo ik bestanden mee
                            foreach ($files as $value) {
                                if (is_file($dir . $value)) {
                                    $map = realpath($dir);
                                    echo '<a href="index.php?map=' . $dir . '&amp;bestand=' . $value . '"><i class="fa fa-file"></i>&nbsp;' . $value . "</a><br />";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="fa fa-file"></span> Bestand</div>
                        <div class="panel-body">
                            <?php
                            if (isset($_GET['bestand'])) {
                                $bestandnaam = $_GET['bestand'];
                                $huidigemap = $_GET['map'];

                                //Grotes van de bestanden ophalen.
                                function human_filesize($bytes, $decimals = 2) {
                                    $size = array('B', 'kB', 'MB', 'GB');
                                    $factor = floor((strlen($bytes) - 1) / 3);
                                    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $size[$factor];
                                }
                                ?>
                                <p class="text text-center">
                                    <?php
                                    //Alles echoen wat er in de bestand kop komt te staan
                                    $bestandenmap = $huidigemap . $bestandnaam;
                                    echo '<strong>Inhoud:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    echo 'Bestand:';
                                    echo $bestandnaam . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    echo 'Grote: ';
                                    echo human_filesize(filesize($bestandenmap)) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    echo 'Laatst aangepast: ';
                                    echo date("d m Y H:i:s.", filemtime($bestandenmap)) . '<br/>' . '</br>';
                                    ?>
                                </p>
                                <?php
                                if (is_writeable($bestandenmap)) {
                                    $boolean = "";
                                    echo '<p class="text text-center text-success"><strong>Dit bestand kan je aanpassen</strong></p>';
                                } else {
                                    $boolean = "readonly";
                                    echo '<p class="text text-center text-danger"><strong>Dit bestand kan je niet aanpassen</strong></p>';
                                }
                            } else {
                                echo '<p class="text text-center text-danger"><strong>Geen bestand geselecteerd</strong></p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel panel-body">

                            <?php
                            if (isset($_GET['bestand'])) {

//Hier de werkmap opgehaald van waaruit ik werk

                                $bestandsnaam = $_GET['bestand'];

//Variable $maplink stuurt me verder door de mappen om de het eerste deel
//te omzeilen zodat de files en bestanden worden geopenen.

                                $maplink = $_GET['map'];
                                $maplink = \str_replace(getcwd(), '', $dir);
                                $maplink.= '\\' . $bestandsnaam;
                                $maplink = ltrim($maplink, '\\');
                                $bestandext = pathinfo($bestandsnaam, PATHINFO_EXTENSION);

//Variable $bestandext word er hier bepaald welke afbeeldingen er worden getoont.
//met '<img src=' worden de afbeeldingen getoont

                                if ($bestandext == "jpg" || $bestandext == "gif") {
                                    echo '<img src="' . $maplink . '">';
                                }
//Variable $bestandext word er bepaald welke text bestanden er wel of niet getoont worden.

                                if ($bestandext == "php" || $bestandext == "css" || $bestandext == "xml" || $bestandext == "properties") {

                                    if (isset($_POST["text"])) {
                                        file_put_contents($maplink, ($_POST["text"]));
                                    }
                                    $inhoudbestand = file_get_contents($dir . $bestandsnaam);
                                    echo '<textarea ' . $boolean . '>';
                                    echo htmlentities($inhoudbestand);
                                    echo '</textarea>';

                                    //Form is hier voor om een txt bestand aantepassen.
                                } elseif ($bestandext == "txt") {
                                    if (isset($_POST["text"])) {
                                        file_put_contents($maplink, ($_POST["text"]));
                                    }
                                    $inhoudbestand = file_get_contents($dir . $bestandsnaam);
                                    echo '<form method = "post" action = "index.php?map=' . $dir . '&amp;bestand=' . $bestandsnaam . '">';
                                    echo '<textarea name = "text">' . htmlentities($inhoudbestand) . '</textarea> <br />';
                                    echo '<input class="btn btn-default" type = "submit" value = "Opslaan">';
                                    echo "</form>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
