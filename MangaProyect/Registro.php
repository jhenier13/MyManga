<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
<!-- end #header-wrapper -->
<div id="logo">
	<h1><a href="#home.php"> My Manga </a></h1>
	<p><em> </p>
</div>
<div id="header">
	<div id="menu">
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li ><a href="Series.php">Series</a></li>
			<li ><a href="Descargas.php" >Descargas</a></li>
			<li class="current_page_item"><a href="Login.php">Login</a></li>
			<li><a href="#" class ="first">Registrarse</a></li>
		</ul>
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
					<div class="slide"><img src="images/img104.jpg" width="726" height="335" alt="" /> <span></span> </div>
					<div class="slide"><img src="images/img107.jpg" width="726" height="335" alt="" /> <span></span> </div>
					<div class="slide"><img src="images/img108.jpg" width="726" height="335" alt="" /> <span></span> </div>
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
				<h2 class="title"><a href="#"> Registrate </a></h2>
				<div class="entry">
					<p><strong>Ven </strong> y registrate, es gratuito, donde encontraras el manga de tu preferencia.
                                        
                                            <FORM name="UserRegisterForm"  ACTION ="UsuarioRegistrado.php"  METHOD= POST  enctype= multipart/form-data  >  
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
			</div>		
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>Recomendados</h2>                                                                                                                                                                                                                                               
					<ul>
						<li><a href="#">Pandora Heart's</a></li>
						<li><a href="#">Skip Beat!</a></li>
						<li><a href="#">Fairy Tail</a></li>
						<li><a href="#">Hunter x hunter</a></li>
						<li><a href="#">Imouto</a></li>
						<li><a href="#">Blue eyes</a></li>
						<li><a href="#">Candy</a></li>
						<li><a href="#">Paradise Kiss</a></li>
					</ul>
				</li>
				<li>
					<h2>los mejores mangas </h2>
					<ul>
						<li><a href="#">One Piece</a></li>
						<li><a href="#">Berserk</a></li>
						<li><a href="#">UxU</a></li>
						<li><a href="#">Claymore</a></li>
						<li><a href="#">Bakuman</a></li>
						<li><a href="#">Air Gear</a></li>
						<li><a href="#">Pandora Heart's</a></li>
						<li><a href="#">NANA</a></li>
					</ul>
				</li>
				
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
