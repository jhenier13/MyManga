<?php
    function ExecuteQuery($query)
    {
        $connection = mysql_connect("localhost", "administrator");
        mysql_select_db("mymangadb");
        $queryID = mysql_query($query);
        $numRows = mysql_num_rows($queryID);
        mysql_close($connection);
        return $numRows;
    }
    
    function GetData($query)
    {
        $connection = mysql_connect("localhost","administrator");
        mysql_select_db("mymangadb");
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
?>
