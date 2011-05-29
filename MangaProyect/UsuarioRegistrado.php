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
			<li ><a href="#" >Descargas</a></li>
			<li class="current_page_item"><a href="Login.php">Login</a></li>
			<li><a href="Registro.php" class ="first">Registrarse</a></li>
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
				<p class="meta"><span class="date">Sunday, May 26, 2011</span> 9:27 AM </a></p>
				<h2 class="title"><a href="#"> Registrate </a></h2>
				<div class="entry">
					<p><strong>Ven </strong> y registrate, es gratuito, donde encontraras el manga de tu preferencia.
                                            <?php
                                                    require("PHPCommon/Commons.php");
                                                    $fullName = $_POST['fullName'];
                                                    $nickname = $_POST['nickname'];
                                                    $password = $_POST['password'];
                                                    $birthdate = $_POST['birthdate'];
                                                    $email = $_POST['email'];
                                                    $query = "INSERT INTO Users (FullName, Nickname, Password, Birthdate, EMail, AccountEnable)";
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
