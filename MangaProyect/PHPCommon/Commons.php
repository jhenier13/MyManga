<?php
    function ExecuteQuery($query)
    {
        $connection = mysql_connect("localhost", "root");
        mysql_select_db("DataBaseMyManga");
        $queryID = mysql_query($query);
        $numRows = mysql_affected_rows();
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
