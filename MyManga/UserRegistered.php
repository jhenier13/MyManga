
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        	<li><a href="Home.html">Inicio</a></li>
        	<li><a href="Login.php">Login</a></li>
            <li><a href="UserRegister.php">Registarse</a></li>
            <li><a href="#">Otras opciones</a></li>
        </ul>
    </div>
    <div id="contenido">
    	<p class="canal">
            <?php
                require("PHPCommon/Commons.php");
                $fullName = $_POST['fullName'];
                $nickname = $_POST['nickname'];
                $password = $_POST['password'];
                $birthdate = $_POST['birthdate'];
                $email = $_POST['email'];
                $query = "INSERT INTO users (FullName, Nickname, Password, Birthdate, EMail, AccountEnable)";
                $query .= "VALUES ('$fullName','$nickname','$password','$birthdate','$email',1)";
                $rowsAffected = ExecuteQuery($query);
                if($rowsAffected)
                {
                  echo "¡Gracias! Hemos recibido sus datos.\n"; 
                }
                else
                {
                    echo "Ha ocurrido un error al momento de registrar, nuestro equipo tecnico ya esta trabajando en el problema";
                }
            ?>
           <br>
               <a href="Home.php" >regresar a la pagina principal</a>
        </p>
      </div>
      <div class="espaciador"></div>
        <div id="pie">
            <h4 align="center">MyManga | <a href="MainPage.html">www.mymanga.com</a></h4>
        </div>
</div>
</body>
</html>
