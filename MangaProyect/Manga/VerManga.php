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
<script language="javascript">
    function EnableAllFields()
    {
        var inputs = document.MangaForm.getElementsByTagName("input");
        for(var i =0;i<inputs.length;i++)
        {
            inputs[i].disabled = false;
        }
        document.MangaForm.status.disabled=false;
        document.MangaForm.manganame.disabled=true;
        document.MangaForm.summary.disabled=false;
    }
    
    function SubmitMangaForm()
    {
        document.MangaForm.manganame.disabled = false;
        document.MangaForm.submit();
    }
</script>
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
                                $mangaka = $_POST["mangaka"];
                                $mangaka = ltrim($mangaka);
                                $mangaka = rtrim($mangaka);
                                $mangaka = ucwords($mangaka);
                                $estado = $_POST["status"];
                                $summary = $_POST["summary"];
                                $genres = GenerateGenresArray();
                                $user = $_SESSION["Nickname"];
                                $mangaTemp = new Manga($mangaName,$mangaka,$genres, $estado, $summary, $user);
                                $mangaTemp->Modify();
                                echo "$mangaName ha sido exitosamente modificado...";
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
                            else
                            {
                                $mangaTemp = new Manga("","","","","","","");
                                $mangaid = $_GET["mangaid"];
                                $mangaTemp->LoadData($mangaid);
                        ?>
                        <form name="MangaForm" action="VerManga.php" method="post" enctype="multipart/form-data" >
                            <table width="100%">
                                <tr>
                                    <td colspan="2"><input type="button" value="Habilitar para modificacion" onclick="EnableAllFields()"></td>
                                </tr>
                                <?php
                                    $fileExists = fopen("../MangaImages/$mangaTemp->mangaName.jpg","r");
                                    if($fileExists)
                                    {
                                ?>
                                <tr height="150">
                                    <td colspan="2" >
                                        <?php
                                            echo "<img width=100 src=\"../MangaImages/$mangaTemp->mangaName.jpg\"></img>"
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <td>(*)Nombre</td>
                                    <td>
                                        <?php
                                            echo "<input type=text name=manganame value=\"$mangaTemp->mangaName\" disabled>";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mangaka</td>
                                    <td>
                                        <?php
                                            echo "<input type=text name=mangaka value=\"$mangaTemp->mangaka\" disabled>";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Generos</td>
                                    <td>
                                        <?php
                                             echo ShowMangaGenres($mangaTemp->genres);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>(*)Estado</td>
                                    <td>
                                        <select length="1" name="status" disabled>
                                            <?php 
                                                $estates = Array("Publicandose","Completo","Cancelado","Suspendido");
                                                $statesStr = "";
                                                for($i=0;$i<4;$i++)
                                                {
                                                    if($estates[$i]==$mangaTemp->status)
                                                    {
                                                        $statesStr.= "<option value=\"$estates[$i]\" selected>$estates[$i]</option>";
                                                    }
                                                    else
                                                    {
                                                        $statesStr.= "<option value=\"$estates[$i]\" >$estates[$i]</option>";
                                                    }
                                                }
                                                echo $statesStr;
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sinopsis</td>
                                    <td>
                                        <?php
                                            echo "<textarea cols=60 rows=10 name=summary  disabled>$mangaTemp->summary</textarea>";
                                        ?>
                                        <texta
                                    </td>
                                </tr>
                                <tr>
                                    <td>Imagen</td>
                                    <td><input type="file" name="mangaImage" disabled></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="reset" value="LIMPIAR" disabled name="resetBtn"><input type="button" value="ACEPTAR" name="acceptBtn" disabled onclick="SubmitMangaForm()"></td>
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
