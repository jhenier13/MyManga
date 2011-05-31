<?php

class User{
    var $fullName;
    var $nick;
    var $password;
    var $birthDate;
    var $EMail;
    var $accountEnable;
    
    function UserExists($nick, $password)
    {
        $query ="SELECT * FROM Users WHERE Nickname='$nick' AND Password='$password'";
        $data = GetData($query);
        if(count($data)>0)
        {
            $userSelected = $data[0]["Nickname"];
            if($userSelected=="Administrador" || $data[0]["AccountEnable"])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    function GetAvailableOptions()
    {
        
    }
    
    function LoadData($nick)
    {
        $query = "SELECT * FROM Users WHERE Nickname='$nick'";
        $data = GetData($query);
        if(count($data)>0)
        {
            $this->fullName = $data[0]["FullName"];
            $this->nick = $data[0]["Nickname"];
            $this->EMail = $data[0]["EMail"];
            $this->birthDate = $data[0]["Birthdate"];
            $this->password = $data[0]["Password"];
        }
    }
    
    function ChangeOtherUserState($nick, $newState)
    {
        
    }
    
    function ChangeMangaEnabling($mangaid, $enabled)
    {
        
    }
    
}

class UserVisitor extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"/MangaProyect/Manga/MangaSeries.php?begin=0\">Series</a></li>
                            <li><a href=\"/MangaProyect/Login.php\">Login</a></li>
                            <li><a href=\"/MangaProyect/Registro.php\">Registrarse</a></li>
                        </ul>";
        return $optionsHtml;
    }
}

class UserRegistered extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"/MangaProyect/Manga/MangaSeries.php?begin=0\">Series</a></li>
                            <li><a href=\"/MangaProyect/VerPerfil.php\">Ver Perfil</a></li>
                            <li><a href=\"/MangaProyect/Manga/MisMangas.php\">Subir manga</a></li>
                            <li><a href=\"/MangaProyect/Logout.php\">Log out</a></li>
                        </ul>";
        return $optionsHtml;
    }
    
    function GetMangaUploadOptions()
    {
        $subOptionsHtml = "<ul>
                             <li><a href=\"/MangaProyect/Manga/MisMangas.php\">Ver mis mangas</a></li>
                             <li><a href=\"/MangaProyect/Manga/NuevoManga.php\">Nuevo manga</a></li>
                             <li><a href=\"/MangaProyect/Manga/NuevoCapitulo.php\">Subir capitulo</a></li>
                           </ul>";
        return $subOptionsHtml;
    }
}

class UserAdministrator extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"/MangaProyect/Manga/MangaSeries.php?begin=0\">Series</a></li>
                            <li><a href=\"/MangaProyect/AdminUsuarios.php\">Usuarios de MyManga</a></li>
                            <li><a href=\"/MangaProyect/Manga/AdminManga.php\">Todos los mangas</a></li>
                            <li><a href=\"/MangaProyect/Logout.php\">Log out</a></li>
                        </ul>";
        return $optionsHtml;
    }
    
    function ChangeOtherUserState($nick, $newState) {
        $query = "UPDATE Users SET AccountEnable=$newState WHERE Nickname='$nick'";
        ExecuteQuery($query);
    }
    
    function ChangeMangaEnabling($mangaid, $enabled) {
        $query = "UPDATE Mangas 
                  SET Enable=$enabled 
                  WHERE MangaID=$mangaid ";
        ExecuteQuery($query);
    }
}
?>
