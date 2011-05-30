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
            return true;
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
}

class UserVisitor extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"Home.php\">Home</a></li>
                            <li><a>Series</a></li>
                            <li><a>Descargas</a></li>
                            <li><a href=\"Login.php\">Login</a></li>
                            <li><a href=\"Registro.php\">Registrarse</a></li>
                        </ul>";
        return $optionsHtml;
    }
}

class UserRegistered extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"Home.php\">Home</a></li>
                            <li><a>Series</a></li>
                            <li><a>Descargas</a></li>
                            <li><a href=\"ViewMangas.php\">Ver mis mangas</a></li>
                            <li><a href=\"VerPerfil.php\">Ver Perfil</a></li>
                            <li><a href=\"UploadManga.php\">Subir capitulo</a></li>
                            <li><a href=\"Logout.php\">Log out</a></li>
                        </ul>";
        return $optionsHtml;
    }
}

class UserAdministrator extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul>
                            <li><a href=\"Home.php\">Inicio</a></li>
                            <li><a>Series</a></li>
                            <li><a>Descargas</a></li>
                            <li><a href=\"AdminUsers.php\">Usuarios de MyManga</a></li>
                            <li><a href=\"ViewMangas.php\">Todos los mangas</a></li>
                            <li><a href=\"Logout.php\">Log out</a></li>
                        </ul>";
        return $optionsHtml;
    }
}


?>
