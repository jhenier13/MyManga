<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    session_start();
    require("PHPCommon/Commons.php");
    require("PHPCommon/User.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Manga</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery.slidertron-0.1.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
@import "slidertron.css";
</style>

<script language="javascript">
    function ValidateUserFields()
    {
        var fullName = document.UserRegisterForm.fullName.value;
        var nickName = document.UserRegisterForm.nickname.value;
        var userPass = document.UserRegisterForm.password.value;
        var rewritedPass = document.UserRegisterForm.rePassword.value;
        var email = document.UserRegisterForm.email.value;
        var birthdate = document.UserRegisterForm.birthdate.value;
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
            if(arrobaFirstIndex!=arrobaLastIndex || arrobaFirstIndex==-1)    
            {
                error = error + "Correo electronico no valido. \n";
            }
            
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
<!-- end #header-wrapper -->
<div id="logo">
	<h1><a href="#home.php"> My Manga </a></h1>
	<p><em> </p>
</div>
<div id="header">
	<div id="menu">
		<?php
                    echo ShowUserOptions();
                ?>
	</div>
	<!-- end #menu -->
	<div id="search">
		<form method="get" action="">
			<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
			</fieldset>
		</form>
	</div>
	<!-- end #search -->
</div>
<!-- end #header -->
<hr />
<!-- end #logo -->
<div id="slideshow">
	<!-- start -->
	<div id="foobar">
		<div id="col1"><a href="#" class="previous">&nbsp;</a></div>
		<div id="col2">
			<div class="viewer">
				<div class="reel">
                    		    <?php
                                        $headerStr = HeaderHTML();
                                        echo $headerStr;
                                    ?>
				</div>
			</div>
		</div>
		<div id="col3"><a href="#" class="next">&nbsp;</a></div>
	</div>
	<script type="text/javascript">

						$('#foobar').slidertron({
							viewerSelector:			'.viewer',
							reelSelector:			'.viewer .reel',
							slidesSelector:			'.viewer .reel .slide',
							navPreviousSelector:	'.previous',
							navNextSelector:		'.next',
							navFirstSelector:		'.first',
							navLastSelector:		'.last'
						});
						
					</script>
	<!-- end -->
</div>

<div id="page">
	<div id="page-bgtop">
		<div id="content">
                    <div class="post">
                 <?php
                    if(isset($_POST['fullName']))
                    {
                        $fullName = $_POST['fullName'];
                        $fullName = ltrim($fullName);
                        $fullName = rtrim($fullName);
                        $fullName = ucwords($fullName);
                        $nickname = $_POST['nickname'];
                        $nickname = ltrim($nickname);
                        $nickname = rtrim($nickname);
                        $password = $_POST['password'];
                        $birthdate = $_POST['birthdate'];
                        $email = $_POST['email'];
                        $userExists = UserNicknameExists($nickname);
                        
                        if($userExists)
                        {
                            echo "<CENTER><FONT>El nick $nickname ya se encuentra registrado en nuestro sistema. <a href=\"Registro.php\"> Intente Nuevamente</a></FONT></CENTER>\n";
                        }
                        else
                        {
                            $query = "INSERT INTO Users (FullName, Nickname, Password, Birthdate, EMail, AccountEnable)";
                            $query .= "VALUES ('$fullName','$nickname','$password','$birthdate','$email',1)";
                            
                            $fileSize = $_FILES["avatarFile"]["size"];
                            if($fileSize>10000)
                            {
                                echo "El avatar no puede exceder el tamaño de 10 KB ";
                            }
                            else
                            {
                                $rowsAffected = ExecuteQuery($query);
                                if($rowsAffected)
                                {
                                    $avatarFile = $_FILES["avatarFile"]["tmp_name"]; 
                                    move_uploaded_file($avatarFile, "Avatars/$nickname.jpg");
                                    echo "¡Gracias! Hemos recibido sus datos.\n"; 
                                }
                                else
                                {
                                    echo "Ha ocurrido un error al momento de registrar, nuestro equipo tecnico ya esta trabajando en el problema";
                                }
                            }
                        }
                    ?>
                    <?php
                    }
                    else
                    {
                    ?>
                        <h2 class="title"><a href="#"> Registrate </a></h2>
                        <div class="entry">
                                <p><strong>Ven </strong> y registrate, es gratuito, donde encontraras el manga de tu preferencia.

                                    <FORM name="UserRegisterForm"  ACTION ="Registro.php"  METHOD= POST  enctype= multipart/form-data  >  
                                            <table> 
                                                <tr> 
                                                       <td> Nombre Completo
                                                       </td> 
                                                       <td> <input type= text  name= fullName > </td> 
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
                                                        <td>Fecha de nacimiento (aaaa/mm/dd) </td> 
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
                    <?php
                    }//end if
                    ?>
                        </div>	
		</div>
            
		<!-- end #content -->
		<div id="sidebar">
			<ul>
                            <?php
                                echo ShowRecomendantions();
                                echo ShowBestMangas();
                            ?>
                        </ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) 2011 MyManga. All rights reserved. Design by Cruz and Jhenier.</p>
</div>
<!-- end #footer -->
</body>
</html>
