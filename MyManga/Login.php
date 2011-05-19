<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
    session_start();
    require("PHPCommon/User.php");
?>
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
    	<?php
            $user = new UserVisitor();
            $htmlStr = $user->GetAvailableOptions();
            echo $htmlStr;
        ?>
    </div>
    <div id="contenido">
    	<p class="canal">
            <form name="LoginForm" action="LoginSuccessful.php" method="POST" enctype="multipart/form-data"> 
                <table> 
                    <tr> 
                           <td>Nickname</td> 
                           <td><input type= text  name=nickname  ></td> 
                    </tr> 
                    <tr> 
                           <td>Password</td> 
                           <td><input type= password  name=password  ></td> 
                    </tr> 
                    <tr> 
                           <td><input type="reset" name="cancelBtn" value="Limpiar"> </td> 
                           <td><input type="submit" name="acceptBtn" value="Aceptar"  ></td>                            
                    </tr>                    
                </table>   
           </form> 
        </p>
  </div>
  <div class="espaciador"></div>
    <div id="pie">
        <h4 align="center">MyManga | <a href="MainPage.html">www.mymanga.com</a></h4>
    </div>
</div>
</body>
</html>