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
            $headerHTML = $headerHTML."\n<div class=\"slide\"><img src=\"/MangaProyect/$imagePath\" width=\"726\" height=\"335\" alt=\"\" /> <span></span> </div>";
        }
        return $headerHTML;
    }
    
    function ShowUserOptions()
    {
        $actualUser=  CreateUserFromSession();
       return $actualUser->GetAvailableOptions();
    }
    
    function CreateUserFromSession()
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
        return $actualUser;
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
    
    function ShowAllUsersTable()
    {
        $query = "SELECT * FROM Users ";
        $data = GetData($query);
        $htmlStr = "<TABLE width=100% height=100%>";
        $rowsCount = count($data);
        for($i=0;$i<$rowsCount;$i++)
        {
            $usernick = $data[$i]["Nickname"];
            $accountEnabled = $data[$i]["AccountEnable"];
            if($accountEnabled)
            {
                $htmlStr = $htmlStr."\n<tr><td><FONT color=blue>$usernick</FONT></td> <td><a href=\"/MangaProyect/AdminUsuarios.php?nick=$usernick&state=0\">Banear usuario</a></td></tr>";
            }
            else
            {
                $htmlStr = $htmlStr."\n<tr><td><FONT color=blue>$usernick</FONT></td> <td><a href=\"/MangaProyect/AdminUsuarios.php?nick=$usernick&state=1\">Habilitar usuario</a></td></tr>";
            }
        }
        $htmlStr = $htmlStr."\n</TABLE>";
        return $htmlStr;
    }
    
    function ChangeUserState($nick, $newState)
    {
        $actualUser = CreateUserFromSession();
        $actualUser->ChangeOtherUserState($nick, $newState);
    }
    
    function GenerateGenresArray()
    {
        $genresStr = Array();
        $allGenres = array("shounen"=>"Shounen","cienciaFiccion"=>"Ciencia Ficcion","fantasia"=>"Fantasia","shoujo"=>"Shoujo","aventura"=>"Aventura","comedia"=>"Comedia","drama"=>"Drama","mecha"=>"Mechas","misterio"=>"Misterio","psicologico"=>"Psicologico","sobrenatural"=>"Sobrenatural","tragedia"=>"Tragedia","deportes"=>"Deportes","seinen"=>"Seinen","schoolLife"=>"school life","otros"=>"Otros");

        foreach ($allGenres as $key=>$value) {
            if(isset($_POST[$key]))
            {
                $genresStr[] = $value;
            }
        }
        
        return $genresStr;
    }
    
    function GenerateUnchekedGenresList()
    {
        $genresHTML = "<TABLE width=100%><tr>";
        $counter = 0;
        $allGenres = array("shounen"=>"Shounen","cienciaFiccion"=>"Ciencia Ficcion","fantasia"=>"Fantasia","shoujo"=>"Shoujo","aventura"=>"Aventura","comedia"=>"Comedia","drama"=>"Drama","mecha"=>"Mechas","misterio"=>"Misterio","psicologico"=>"Psicologico","sobrenatural"=>"Sobrenatural","tragedia"=>"Tragedia","deportes"=>"Deportes","seinen"=>"Seinen","schoolLife"=>"school life","otros"=>"Otros");
        foreach ($allGenres as $key => $value) {
            if($counter<4)
            {
               $counter=$counter +1; 
            }
            else
            {
                $counter=1;
                $genresHTML.="</tr><tr>";
            }
            $genresHTML.="\n<td><input type=checkbox name=\"$key\">$value</td>";

        }
        $genresHTML.="\n</tr></TABLE>";
        return $genresHTML;
    }
    
    function ShowUserMangas()
    {
        $uploaderNick = $_SESSION['Nickname'];
        $query = "SELECT MangaName, MangaID FROM Mangas WHERE CreatedByUser='$uploaderNick' AND Enable=1 ORDER BY MangaName ASC";
        $userMangas = GetData($query);;
        $mangasHTML = "<UL >";
        $numberMangas = count($userMangas);
        for($i=0;$i<$numberMangas;$i++)
        {
            $mangaName = $userMangas[$i]["MangaName"];
            $mangaID = $userMangas[$i]["MangaID"];
            $mangasHTML.="\n<li><a href=\"VerManga.php?mangaid=$mangaID\">$mangaName</a></li>";
        }
        $mangasHTML.="\n</UL>";
        return $mangasHTML;
    }
    
    function GenreExist($genres, $singleGenre)
    {
        foreach ($genres as $key => $value) {
            if($value==$singleGenre)
            {
                return true;
            }
        }
        return false;
    }
    
    function ShowMangaGenres($genres)
    {
        $genresHTML = "<TABLE width=100% ><tr>";
        $counter = 0;
        $allGenres = array("shounen"=>"Shounen","cienciaFiccion"=>"Ciencia Ficcion","fantasia"=>"Fantasia","shoujo"=>"Shoujo","aventura"=>"Aventura","comedia"=>"Comedia","drama"=>"Drama","mecha"=>"Mechas","misterio"=>"Misterio","psicologico"=>"Psicologico","sobrenatural"=>"Sobrenatural","tragedia"=>"Tragedia","deportes"=>"Deportes","seinen"=>"Seinen","schoolLife"=>"school life","otros"=>"Otros");
        foreach ($allGenres as $key => $value) {
            if($counter<4)
            {
               $counter=$counter +1; 
            }
            else
            {
                $counter=1;
                $genresHTML.="</tr><tr>";
            }
            $genreExist = GenreExist($genres, $value);
            if($genreExist)
            {
                $genresHTML.="\n<td><input type=checkbox name=\"$key\" checked disabled>$value</td>";
            }
            else
            {
                $genresHTML.="\n<td><input type=checkbox name=\"$key\" disabled>$value</td>";
            }
        }
        $genresHTML.="\n</tr></TABLE>";
        return $genresHTML;
    }
    
    function ShowMangasForAdmin()
    {
        $query = "SELECT * FROM Mangas";
        $data = GetData($query);
        $numberRows = count($data);
        $tableHTML = "<TABLE width=100%>";
        
        for($i=0;$i<$numberRows;$i++)
        {
            $mangaid = $data[$i]["MangaID"];
            $manga = $data[$i]["MangaName"];
            $uploader = $data[$i]["CreatedByUser"];
            $enabled = $data[$i]["Enable"];
            $tableHTML.="<tr>
                            <td height=100><img width=70 src=\"../MangaImages/$manga.jpg\"></img></td>
                            <td><FONT color=blue>$manga</FONT></td>
                            <td><FONT color=blue>$uploader</FONT></td>";
            if($enabled)
            {
                $tableHTML.="<td><a href=AdminManga.php?mangaid=$mangaid&enabled=0>Prohibir manga</a></td></tr>\n";
            }
            else
            {
                $tableHTML.="<td><a href=AdminManga.php?mangaid=$mangaid&enabled=1>Habilitar manga</a></td></tr>\n";
            }
        }
        $tableHTML.="</TABLE>";
        return $tableHTML;
    }
    
    function ShowAllAvailableMangasForView($limiteInferior)
    {
        if($limiteInferior<0)
        {
            $limiteInferior=0;
        }
        $limiteSuperior = $limiteInferior + 10;
        $query = "SELECT * FROM Mangas WHERE Enable=1 LIMIT $limiteInferior , $limiteSuperior ";
        $data = GetData($query);
        $numberRows = count($data);
        $contentHTML = "<ul>";
        
        for($i=0;$i<$numberRows;$i++)
        {
             $manga = new Manga("","","","","","","");
             $manga->LoadDataRow($data[$i]);
             $mangaGenres = "";
             $numberGenres = count($manga->genres);
             for($j=0;$j<$numberGenres;$j++)
             {
                 $singleGenre = $manga->genres[$j];
                 $mangaGenres.="$singleGenre,";
             }
             $shortSummary = substr($manga->summary, 0, 70);
             $contentHTML.="<li>
                                <TABLE width=100%>
                                <tr><td rowspan=5><img width=80 src=\"../MangaImages/$manga->mangaName.jpg\"></img></td>
                                    <td><a href=\"VerCapitulos.php?mangaid=$manga->mangaID\" >$manga->mangaName</a></td>
                                </tr>
                                <tr><td>Mangaka: $manga->mangaka</td></tr>
                                <tr><td>Estado: $manga->status</td></tr>
                                <tr><td>Generos: $mangaGenres</td></tr>
                                <tr><td>Sinopsis: $shortSummary...</td></tr>
                                </TABLE>
                            </li>";
        }
        
        $contentHTML.="</ul>";
        $newlimiteInferior = $limiteInferior-10;
        if($newlimiteInferior<0)
            $contentHTML.="<a href=\"MangaSeries.php?begin=0\">Anterior</a>      <a href=\"MangaSeries.php?begin=10\">Siguiente</a>";
        else
            $contentHTML.="<a href=\"MangaSeries.php?begin=$newlimiteInferior\">Anterior</a>      <a href=\"MangaSeries.php?begin=$limiteSuperior\">Siguiente</a>";
        
        return $contentHTML;
    }
?>
