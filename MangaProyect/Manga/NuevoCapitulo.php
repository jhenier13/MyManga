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
    numberActualImages = 5;
    function AddImageFileInput()
    {
        var imagesContainer = document.getElementById("imagesToUpload");
        var newFileInput = document.createElement("input");
        newFileInput.type = "file";
        numberActualImages = numberActualImages+1;
        newFileInput.name="image"+numberActualImages;
        document.ChapterForm.numberImages.value=numberActualImages;
        imagesContainer.appendChild(newFileInput);
        var espacio = document.createElement("br");
        imagesContainer.appendChild(espacio);
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
                            if(isset($_POST["chapterTitle"]))
                            {
                                $chapterTemp = new Chapter();
                                $mangaidTemp = $_POST["mangasId"];
                                $arrayTemp = explode("|", $mangaidTemp,2);
                                $chapterTemp->mangaID= $arrayTemp[0];
                                $chapterTemp->title = $_POST["chapterTitle"];
                                $numberImages = $_POST["numberImages"];
                                $chapterTemp->uploader = $_SESSION["Nickname"];
                                $chapterTemp->uploadDate = date("Y-m-d");
                                $chapterTemp->numberImages = $numberImages;
                                $chapterTemp->hasDownload = 0;
                                $mangaName = $arrayTemp[1];

                                if(!$chapterTemp->title=="")
                                {
                                    if($chapterTemp->TheUserUploadTheChapter($chapterTemp->title, $chapterTemp->uploader, $chapterTemp->mangaID))
                                    {
                                        echo "Este usuario ya ha subio este episodio, no puede subirlo nuevamente, intente subiendolo como V2";
                                    }
                                    else
                                    {
                                        $chapterTemp->Save();
                                        $folderPath = "../UploadMangas/$mangaName/$chapterTemp->uploader/$chapterTemp->title";
                                        if(!is_dir($folderPath))
                                        {
                                            mkdir($folderPath,0777,true);
                                        }

                                        for($i=1;$i<=$numberImages;$i++)
                                        {
                                            $imageNameAux = "image$i";
                                            $tempImagePath= $_FILES[$imageNameAux]["tmp_name"];
                                            if($tempImagePath!="")
                                            {
                                                $newImagePath = "$folderPath/$imageNameAux.jpg";
                                                move_uploaded_file($tempImagePath, $newImagePath);
                                            }
                                        }

                                        echo "El capitulo ha sido subido exitosamente";
                                    }
                                }
                                else
                                {
                                    echo "El capitulo no tiene TITULO";
                                }
                            }
                            else
                            {
                        ?>
                        <form name="ChapterForm" action="NuevoCapitulo.php" method="POST" enctype="multipart/form-data">
                            <table width="100%">
                                <tr>
                                    <td>(*)Manga</td>
                                    <td>
                                        <?php
                                            echo GetAllMangasComboBox();
                                        ?>
                                        <br>
                                        No hay el manga que buscas? entonces crealo <a href="NuevoManga.php">AQUI</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>(*)Nombre capitulo</td>
                                    <td><input type="text" name="chapterTitle"></input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        Imagenes a subir (No pueden ser mayores de 1 MB);
                                        <div id="imagesToUpload">
                                            <input type="file" name="image1" ><br>
                                            <input type="file" name="image2"><br>
                                            <input type="file" name="image3"><br>
                                            <input type="file" name="image4"><br>
                                            <input type="file" name="image5"><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="numberImages" value="5">
                                    </td>
                                    <td ><input type="button" value="Agregar otra imagen para subir" onclick="AddImageFileInput()"  ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="reset" value="LIMPIAR"></input><input type="submit" value="ACEPTAR"></td>
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
