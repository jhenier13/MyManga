
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Manga</title>
<link href="css/Structure.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<link href="css/Text.css" rel="stylesheet" type="text/css" />
<script language="javascript">
    function ValidateUserFields()
    {
        var fullName = document.UserRegisterForm.fullName.value;
        var nickName = document.UserRegisterForm.nickname.value;
        var userPass = document.UserRegisterForm.password.value;
        var rewritedPass = document.UserRegisterForm.rePassword.value;
        var email = document.UserRegisterForm.email.value;
        var birthdate = document.UserRegisterForm.birthdate.value;
        var avatar = document.UserRegisterForm.avatarFile.value; //solo obtiene una ruta falsa, pero si tiene el nomnbre del archivo
        var termsAccepted = document.UserRegisterForm.acceptTerms.checked;
        if(termsAccepted)
        {
            var error = "";
            if(fullName.length==0)
            {
                error = error + "El nombre no puede estar vacio. \n";
            }
            if(nickName.length<7)
            {
                error = error + "El nick debe tener más de 6 caracteres. \n";
            }
            if(userPass.length<5)
            {
                error = error + "El password debe tener mas de 4 caracteres. \n";
            }
            if(rewritedPass!=userPass)
            {
                error = error + "El password no ha sido reescrito correctamente. \n";
            }
            var arrobaFirstIndex = email.indexOf("@", 0);
            var arrobaLastIndex = email.lastIndexOf("@", email.length-1);
            alert(arrobaFirstIndex + "-->"+arrobaLastIndex);
            if(arrobaFirstIndex!=arrobaLastIndex || arrobaFirstIndex==-1)    
            {
                error = error + "Correo electronico no valido. \n";
            }
            //comprobar extension del archivo
            
            if(error.length==0)
            {
                document.UserRegisterForm.submit();
            }
            else
            {
                alert(error);
            }
            
        }
        else
        {
            alert("No ha aceptado los terminos de uso asi que no puede registrarse");
        }
    }
</script>

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
           <FORM name="UserRegisterForm"  ACTION ="UserRegistered.php"  METHOD= POST  enctype= multipart/form-data  >  
                <table> 
                    <tr> 
                           <td> Nombre Completo
                           </td> 
                           <td> <input type= text  name= fullName  > </td> 
                    </tr> 
                    <tr> 
                           <td> Nombre de usuario 
                               <br>
                                (más de 6 caracteres)
                           </td> 
                           <td><input type= text  name= nickname  ></td> 
                    </tr> 
                    <tr> 
                            <td>Contraseña
                                <br>
                                (más de 4 caracteres)
                            </td> 
                            <td><input type= text  name= password ></td> 
                    </tr> 
                    <tr> 
                            <td>Reescribir contraseña </td> 
                            <td><input type= text  name="rePassword"  ></td> 
                    </tr> 
                    <tr> 
                            <td>Correo electronico  </td> 
                            <td><input type= text  name= email  ></td> 
                    </tr> 
                    <tr> 
                            <td>Fecha de nacimiento </td> 
                            <td><input type= text  name= birthdate  ></td> 
                    </tr> 
                    <tr> 
                            <td>Avatar</td> 
                            <td><input type= file name= avatarFile ></td> 
                    </tr> 
                    <tr> 
                            <td>Acepto</td> 
                            <td><input type=checkbox name= acceptTerms > Los <a target="blank" href="Terminos.html">terminos</a>  de MyManga</td> 
                    </tr> 
                    <tr> 
                            <td><input type="reset" value="Limpiar"> </td>
                            <td><input type =button name = register value = Registrar onclick="ValidateUserFields()" ></td> 
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