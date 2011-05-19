<?php
    session_start();
    require("PHPCommon/User.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My Manga</title>
        <link href="css/Structure.css" rel="stylesheet" type="text/css" />
        <link href="css/Menu.css" rel="stylesheet" type="text/css" />
        <link href="css/Text.css" rel="stylesheet" type="text/css" />
        <script language="javascript">
            function ReturnPreviusPage()
            {
                document.location = "Home.php";
            }
        </script>
    </head>

    <body>
        <div id="wrap">
            <div id="cabecera">
                <h4 ><img src="images/logo.jpg" width="74" height="83" id="logo"><br><br><br>yManga </img></h4>

            </div>
            <div id="barra_izquierda">
                <?php
                    $user = new UserVisitor();
                    $htmlStr = $user->GetAvailableOptions();
                    echo $htmlStr;
                ?>
            </div>
            <div id="contenido">
                <p class="canal">
                    <?php
                    $nick = $_POST["nickname"];
                    $password = $_POST["password"];
                    $user = new User();
                    $userExist = $user->UserExists($nick, $password);
                    if ($userExist) {
                        $_SESSION["UserNickName"] = $nick;
                        echo "<FONT SIZE=4>Bienvenido nuevamente $nick</FONT>";
                        echo "<br>";
                        echo "Sera redirigido a la anterior pagina en 3 segundos";
                        echo "<SCRIPT>
                                setInterval(ReturnPreviusPage, 3000);
                            </SCRIPT>";
                    } else {
                        echo "<FONT SIZE=4>$nick no te encuentras registrado</FONT>";
                        echo "<br>";
                        echo "<a href=\"Login.php\">Volver a intentar</a>";
                    }
                    ?>
                </p>
            </div>
            <div class="espaciador"></div>
            <div id="pie">
                <h4 align="center">MyManga | <a href="MainPage.html">www.mymanga.com</a></h4>
            </div>
        </div>
    </body>
</html>
