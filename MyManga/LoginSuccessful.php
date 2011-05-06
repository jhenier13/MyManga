
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My Manga</title>
        <link href="css/Structure.css" rel="stylesheet" type="text/css" />
        <link href="css/Menu.css" rel="stylesheet" type="text/css" />
        <link href="css/Text.css" rel="stylesheet" type="text/css" />


    </head>

    <body>
        <div id="wrap">
            <div id="cabecera">
                <h4 ><img src="images/logo.jpg" width="74" height="83" id="logo"><br><br><br>yManga </img></h4>

            </div>
            <div id="barra_izquierda">
                <ul id="menu_vertical">
                    <li><a href="MainPage.html">Inicio</a></li>
                    <li><a href="Login.php">Login</a></li>
                    <li><a href="UserRegister.php">Registarse</a></li>
                    <li><a href="#">Otras opciones</a></li>
                </ul>
            </div>
            <div id="contenido">
                <p class="canal">
                    <?php
                    require("PHPCommon/User.php");
                    $nick = $_POST["nickname"];
                    $password = $_POST["password"];
                    $user = new User();
                    $userExist = $user->UserExists($nick, $password);
                    if ($userExist) {
                        echo "<FONT SIZE=4>Bienvenido nuevamente $nick</FONT>";
                    } else {
                        echo "<FONT SIZE=4>$nick no te encuentras registrado</FONT>";
                        //header("location:Login.php");
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
