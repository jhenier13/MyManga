<?php
    function ExecuteQuery($query)
    {
        $connection = mysql_connect("localhost", "root");
        mysql_select_db("DataBaseMyManga");
        $queryResult = mysql_query($query);
        mysql_close($connection);
        return $queryResult;
    }   
    
    function GetData($query)
    {
        $connection = mysql_connect("localhost","root");
        mysql_select_db("DataBaseMyManga");
        $queryID = mysql_query($query);
        $numRows = mysql_num_rows($queryID);
        $data = array ();
        for($i=0;$i<$numRows;$i++)
        {
            $row = mysql_fetch_array($queryID);
            $data[]=$row;
        }
        mysql_close();
        return $data;
    }
    
    function HeaderHTML()
    {
        $query = "SELECT * FROM Images";
        $allImages = GetData($query);
        $headerHTML = "";
        $numberImages = count($allImages);
        for($i=0;$i<5;$i++)
        {
            $randomNumber = rand(0, $numberImages-1);
            $imagePath = $allImages[$randomNumber]["Path"];
            $headerHTML = $headerHTML."\n<div class=\"slide\"><img src=\"$imagePath\" width=\"726\" height=\"335\" alt=\"\" /> <span></span> </div>";
        }
        return $headerHTML;
    }
    
    function ShowUserOptions()
    {
        $actualUser;
        if(isset($_SESSION["Nickname"]))
        {
            switch ($_SESSION["Nickname"]) {
                case "Administrador":
                    $actualUser = new UserAdministrator();
                    break;
                default:
                    $actualUser = new UserRegistered();
                    break;
            }
        }
        else
        {
            $actualUser = new UserVisitor();
        }
       return $actualUser->GetAvailableOptions();
    }
    
    function ShowRecomendantions()
    {
          $htmlStr = " <li>
					<h2>Recomendados</h2>
					<ul>
						<li><a href=\"#\">Pandora Heart's</a></li>
						<li><a href=\"#\">Skip Beat!</a></li>
						<li><a href=\"#\">Fairy Tail</a></li>
						<li><a href=\"#\">Hunter x hunter</a></li>
						<li><a href=\"#\">Imouto</a></li>
						<li><a href=\"#\">Blue eyes</a></li>
						<li><a href=\"#\">Candy</a></li>
						<li><a href=\"#\">Paradise Kiss</a></li>
					</ul>
				</li>";
          return $htmlStr;
    }
    
    function ShowBestMangas()
    {
        $htmlStr = "<li>
					<h2>los mejores mangas </h2>
					<ul>
						<li><a href=\"#\">One Piece</a></li>
						<li><a href=\"#\">Berserk</a></li>
						<li><a href=\"#\">UxU</a></li>
						<li><a href=\"#\">Claymore</a></li>
						<li><a href\"#\">Bakuman</a></li>
						<li><a href=\"#\">Air Gear</a></li>
						<li><a href=\"#\">Pandora Heart's</a></li>
						<li><a href=\"#\">NANA</a></li>
					</ul>
				</li>";
        return $htmlStr;
    }
    
    function UserNicknameExists($nick)
    {
        $query = "SELECT * FROM Users WHERE Nickname='$nick' ";
        $data = GetData($query);
        if(count($data)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function SaveUserAvatar($avatar, $nickname)
    {
        
    }
?>
