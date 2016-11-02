<?PHP
session_start();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .panel-body{
                border-style: solid;
                border-bottom-width: 5px;
                border-right-width: 5px;
                border-left-width: 5px;
                border-top-width: 5px;
                border-color: #7FFF00;
                background-color: lightgreen;                
            }
            @font-face {
                font-family: Lato-Light;
                src: url('fonts/Lato-Light.ttf');
            }
            .active{
                font-family: Lato-Light;
            }
            h1{
                font-family: Lato-Light;
                color: black;
            }
            h3{
                font-family: Lato-Light;
            }
        </style>
        <title>Soundsharp inlog</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">   
                <?php
                // Check of iemand op het knopje heeft gedrukt:
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    // Knopje is ingedrukt!
                    // controleren of de gebruikersnaam en wachtwoord kloppen
                    if ($_POST['username'] == "s" && $_POST['password'] == "1") {
                        
                        $_SESSION['ingelogt'] = true;
                        //Roept me directory aan van waar ik naar toe wil na het succesvol inloggen
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        //hoofdsite verwijst naar de map waar ik naar toe wil las ik op login druk
                        $hoofdsite = 'index.php';
                        //Header maakt de van alle andere varriablen een URL :kijk naar Location dan word het duidelijk:
                        header("Location: http://$host$uri/$hoofdsite");
                        //exit zorgt ervoor als de inlog niet juist is dat hij hem er uitgooit en verdergaat met de loop denk ik.
                        exit;
                        ?>
                        <?php
                    } else {
                        ?>                   
                        <!--bootstrap aanpassen tussen de php delen door niet in de php stukken-->
                        <div class="text-center text-danger">
                            <img src="errorstop.png" width="400px" height="400px"/>
                            <h1>
                                <?php
                                ?>
                            </h1>
                            <button type="button" class="btn btn-default"><a href="wachtwoord.php">Terug naar login pagina</a></button>
                        </div>
                        <?php
                    }
                } else {
                    // Knoppie nie...
                    ?>
                    <div class="panel-title-text text-center">
                        <h1><div class="panel-body">Welkom bij SoundSharp</div></h1>

                        <p>Vul hier onder u meegegeven inlog gegevens in</p>
                        <form method="post" action="wachtwoord.php">
                            Username<br />
                            <input type="text" name="username"><br />

                            Password<br />
                            <input type="password" name="password"><br />

                            <input type="submit" value="Login">            
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>