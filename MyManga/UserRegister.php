
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
        	<li><a href="MainPage.html">Inicio</a></li>
        	<li><a href="Login.php">Login</a></li>
            <li><a href="UserRegister.php">Registarse</a></li>
            <li><a href="#">Otras opciones</a></li>
        </ul>
    </div>
    <div id="contenido">
    	<p class="canal">
           <FORM  ACTION ="UserRegistered.php"  METHOD= POST  enctype= multipart/form-data  >  
                <table> 
                    <tr> 
                           <td> FullName </td> 
                           <td> <input type= text  name= fullName  > </td> 
                    </tr> 
                    <tr> 
                           <td> Nickname </td> 
                           <td><input type= text  name= nickname  ></td> 
                    </tr> 
                    <tr> 
                            <td>Password </td> 
                            <td><input type= text  name= password ></td> 
                    </tr> 
                    <tr> 
                            <td>Re-Password </td> 
                            <td><input type= text  name="rePassword"  ></td> 
                    </tr> 
                    <tr> 
                            <td>Email  </td> 
                            <td><input type= text  name= email  ></td> 
                    </tr> 
                    <tr> 
                            <td>Birthdate </td> 
                            <td><input type= text  name= birthdate  ></td> 
                    </tr> 
                    <tr> 
                            <td>Avatar</td> 
                            <td><input type= file name= file ></td> 
                    </tr> 
                    <tr> 
                            <td>Acepto</td> 
                            <td><input type=checkbox name= file > Los <a target="blank" href="Terminos.html">terminos</a>  de MyManga</td> 
                    </tr> 
                    <tr> 
                            <td><input type="reset" value="Limpiar"> </td>
                            <td><input type = submit name = register value = Registrar ></td> 
                    </tr>
                </table> 
           </FORM> 
        </p>
  </div>
  <div class="espaciador"></div>
    <div id="pie">
        <h4 align="center">MyManga | <a href="MainPage.html">www.mymanga.com</a></h4>
    </div>
</div>
</body>
</html>