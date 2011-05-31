<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    session_start();
    require("PHPCommon/Commons.php");
    require("PHPCommon/User.php")
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
<link href="slidertron.css" rel="stylesheet" type="text/css" media="screen" />

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
                    <?php
                    if(isset($_GET["nick"]))
                    {   
                        $nickname = $_GET["nick"];
                        $newState = $_GET["state"];
                        ChangeUserState($nickname, $newState);
                        if($newState)
                        {
                            echo "El usuario $nickname ha sido habilitado";
                        }
                        else
                        {
                            echo "El usuario $nickname ha sido baneado de MyManga";
                        }
                    }
                    else
                    {
                            echo ShowAllUsersTable();
                    }
                    ?>
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
