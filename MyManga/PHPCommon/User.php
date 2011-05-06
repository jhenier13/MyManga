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
    
}

?>
