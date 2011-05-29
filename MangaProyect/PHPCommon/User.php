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
        require("Commons.php");
        $query ="SELECT * FROM users WHERE Nickname='$nick' AND Password='$password'";
        $numRows = ExecuteQuery($query);
        return $numRows;
    }
    
    function GetAvailableOptions()
    {
        
    }
    
    function GetUser($userNick)
    {
        if($userNick=="Administrador")
        {
            $userAdmin = new UserAdministrator();
            return $userAdmin;
        }
        else
        {
            if($userNick=="")
            {
                $userVisitor = new UserVisitor();
                return $userVisitor;
            }
            else
            {
                $userRegistered = new UserRegistered();
                return $userRegistered;
            }
        }
    }
}

class UserVisitor extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul id=\"menu_vertical\">
                            <li><a href=\"Home.html\">Inicio</a></li>
                            <li><a href=\"Login.php\">Login</a></li>
                            <li><a href=\"UserRegister.php\">Registarse</a></li>
                        </ul>";
        return $optionsHtml;
    }
}

class UserRegistered extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul id=\"menu_vertical\">
                            <li><a href=\"Home.html\">Inicio</a></li>
                            <li><a href=\"ViewMangas.php\">Ver mis mangas</a></li>
                            <li><a href=\"ViewUser.php\">Ver Perfil</a></li>
                            <li><a href=\"UploadManga.php\">Subir capitulo</a></li>
                            <li><a href=\"Logout.php\">Cerrar sesion</a></li>
                        </ul>";
        return $optionsHtml;
    }
}

class UserAdministrator extends User{
    function GetAvailableOptions() {
        $optionsHtml = "<ul id=\"menu_vertical\">
                            <li><a href=\"Home.html\">Inicio</a></li>
                            <li><a href=\"AdminUsers.php\">Usuarios de MyManga</a></li>
                            <li><a href=\"ViewMangas.php\">Todos los mangas</a></li>
                            <li><a href=\"Logout.php\">Cerrar sesion</a></li>
                        </ul>";
        return $optionsHtml;
    }
}


?>
