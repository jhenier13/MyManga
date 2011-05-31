<?php
    session_start();
    require("../PHPCommon/Commons.php");
    require("../PHPCommon/User.php");
    require("../PHPCommon/Manga.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Manga</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="../jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../jquery/jquery.slidertron-0.1.js"></script>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../slidertron.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>
<!-- end #header-wrapper -->
<div id="logo">
	<h1><a href="../Home.php"> My Manga </a></h1>
	<p><em> </p>
</div>
<div id="header">
	<div id="menu">
            <?php
                echo ShowUserOptions();
            ?>
	</div>
	<!-- end #menu -->
	<!--<div id="search">
		<form method="get" action="">
			<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
			</fieldset>
		</form>
	</div>-->
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
                    <div id="submenu">
                        <?php
                            $userRegistered = new UserRegistered();
                            echo $userRegistered->GetMangaUploadOptions();
                        ?>
                    </div>
                    <div id="subcontent">
                        <?php
                            if(isset($_POST["manganame"]))
                            {
                                $mangaName = $_POST["manganame"];
                                $mangaName = ltrim($mangaName);
                                $mangaName = rtrim($mangaName);
                                $mangaName = ucwords($mangaName);
                                $mangaka = $_POST["mangaka"];
                                $mangaka = ltrim($mangaka);
                                $mangaka = rtrim($mangaka);
                                $mangaka = ucwords($mangaka);
                                $estado = $_POST["status"];
                                $summary = $_POST["summary"];
                                $genres = GenerateGenresArray();
                                $user = $_SESSION["Nickname"];
                                $mangaTemp = new Manga($mangaName,$mangaka,$genres, $estado, $summary, $user);
                                if($mangaTemp->MangaExists($mangaName))
                                {
                                    echo "$mangaName ya se encuentra registrado, intente subir los capitulos directamente...";
                                }
                                else
                                {
                                    $mangaTemp->Save();
                                    echo "$mangaName ha sido exitosamente registrado, ahora puede subir capitulos de esta serie...";
                                    $fileSize = $_FILES["mangaImage"]["size"];
                                    if($fileSize>200000)
                                    {
                                        echo "<br>El tamaño de la imagen no puede ser mayor a 200 KB, intentelo nuevamente modificando el perfil del manga";
                                    }
                                    else
                                    {
                                        $tempPath = $_FILES["mangaImage"]["tmp_name"];
                                        $destination = "../MangaImages/$mangaName.jpg";
                                        move_uploaded_file($tempPath, $destination);
                                    }
                                }
                            }
                            else
                            {
                        ?>
                        <form name="MangaForm" action="NuevoManga.php" method="post" enctype="multipart/form-data">
                            <table width="100%">
                                <tr>
                                    <td>(*)Nombre</td>
                                    <td><input type="text" name="manganame" ></td>
                                </tr>
                                <tr>
                                    <td>Mangaka</td>
                                    <td><input type="text" name="mangaka"></td>
                                </tr>
                                <tr>
                                    <td>Generos</td>
                                    <td>
                                        <?php
                                            echo GenerateUnchekedGenresList();
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>(*)Estado</td>
                                    <td>
                                        <select length="1" name="status">
                                            <option value="Publicandose">Publicandose</option>
                                            <option value="Completo">Completo</option>
                                            <option value="Cancelado">Cancelado</option> 
                                            <option value="Suspendido">Suspendido</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sinopsis</td>
                                    <td>
                                        <textArea cols="60" rows="10" name="summary"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Imagen</td>
                                    <td><input type="file" name="mangaImage"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="reset" value="LIMPIAR"><input type="submit" value="ACEPTAR"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            }
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
