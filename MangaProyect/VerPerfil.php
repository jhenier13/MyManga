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
    function EnableAllFields()
    {
        document.UserViewForm.fullName.disabled=false;
        document.UserViewForm.password.disabled=false;
        document.UserViewForm.rePassword.disabled=false;
        document.UserViewForm.email.disabled=false;
        document.UserViewForm.birthdate.disabled=false;
        document.UserViewForm.register.disabled=false;
        document.UserViewForm.cleaner.disabled=false;
        document.UserViewForm.avatarFile.disabled = false;
    }
    
    function ValidateUserFields()
    {
        var fullName = document.UserViewForm.fullName.value;
        var userPass = document.UserViewForm.password.value;
        var rewritedPass = document.UserViewForm.rePassword.value;
        var email = document.UserViewForm.email.value;
        var birthdate = document.UserViewForm.birthdate.value;

            var error = "";
            if(fullName.length==0)
            {
                error = error + "El nombre no puede estar vacio. \n";
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
                document.UserViewForm.submit();
            }
            else
            {
                alert(error);
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
                        $nickname = $_SESSION['Nickname'];
                        $password = $_POST['password'];
                        $birthdate = $_POST['birthdate'];
                        $email = $_POST['email'];

                        $query = "UPDATE Users 
                                  SET FullName='$fullName', Password='$password', Birthdate='$birthdate', EMail='$email'
                                  WHERE Nickname='$nickname'";
                            
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
                                echo "Sus datos han sido modificados correctamente.\n"; 
                            }
                            else
                            {
                                echo "Ha ocurrido un error al momento de modificar los datos, nuestro equipo tecnico ya esta trabajando en el problema";
                            }
                        }
                    }
                    else
                    {
                        $userTemp = new User();
                        $userTemp->LoadData($_SESSION["Nickname"]);
                    ?>
                        <h2 class="title"><a href="#"> Ver perfil </a></h2>
                        <div class="entry">
                                    <FORM name="UserViewForm"  ACTION ="VerPerfil.php"  METHOD= POST  enctype= multipart/form-data  >  
                                            <table> 
                                                <tr>
                                                    <td colspan="2" height="150">
                                                        Avatar actual<br>
                                                        <?php
                                                            $fileExists = fopen("Avatars/$userTemp->nick.jpg","r");
                                                            if($fileExists)
                                                            {
                                                                echo "<img width=100 src=\"Avatars/$userTemp->nick.jpg\"></img>";
                                                            }
                                                            else
                                                            {
                                                                echo "<FONT color=red>No tienes un avatar seleccionado</FONT>";
                                                            }
                                                        ?>
                                                    </td> 
                                                </tr>
                                                <tr> 
                                                       <td> Nombre Completo</td>
                                                       <td>
                                                           <?php
                                                               echo "<input type=text name=fullName value=\"$userTemp->fullName\" disabled>";
                                                           ?>
                                                       </td> 
                                                </tr> 
                                                <tr> 
                                                       <td> Nombre de usuario 
                                                           <br>
                                                            (más de 6 caracteres)
                                                       </td> 
                                                       <td>
                                                           <?php
                                                           echo "<input type=text name=nickname value=$userTemp->nick disabled>";
                                                           ?>
                                                       </td> 
                                                </tr> 
                                                <tr> 
                                                        <td>Contraseña
                                                            <br>
                                                            (más de 4 caracteres)
                                                        </td> 
                                                        <td>
                                                            <?php
                                                                echo "<input type=password name=password value=$userTemp->password disabled>";
                                                            ?>
                                                        </td>
                                                </tr> 
                                                <tr> 
                                                        <td>Reescribir contraseña </td> 
                                                        <td>
                                                            <?php
                                                                echo "<input type=password name=rePassword value=$userTemp->password disabled>";
                                                            ?>
                                                        </td>
                                                </tr> 
                                                <tr> 
                                                        <td>Correo electronico  </td> 
                                                        <td>
                                                            <?php
                                                                 echo "<input type=text name=email value=$userTemp->EMail disabled>";
                                                            ?>
                                                        </td> 
                                                </tr> 
                                                <tr> 
                                                        <td>Fecha de nacimiento (aaaa/mm/dd) </td> 
                                                        <td>
                                                            <?php
                                                                echo "<input type=text name=birthdate value=$userTemp->birthDate disabled>";
                                                            ?>
                                                        </td>
                                                </tr> 
                                                <tr> 
                                                        <td>Avatar</td> 
                                                        <td><input type= file name= avatarFile disabled></td> 
                                                </tr> 
                                                <tr>
                                                    <td colspan="2">
                                                        <input type="button" value="Habilitar para modificacion" onclick="EnableAllFields()">
                                                    </td>
                                                </tr>
                                                <tr> 
                                                        <td><input type="reset" name="cleaner" value="Limpiar" disabled ></td>
                                                        <td><input type =button name = register value = Modificar onclick="ValidateUserFields()" disabled ></td> 
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
