<?php
    class Manga{
        var $mangaID;
        var $mangaName;
        var $mangaka;
        var $genres;//array
        var $summary;
        var $status;//complete|ongoing
        var $enable;
        var $createdByUser;
        
        function Manga($name, $mangaka, $genres, $status, $summary, $createdByUser)
        {
            $this->mangaName = $name;
            $this->mangaka = $mangaka;
            $this->genres = $genres;
            $this->status = $status;
            $this->summary = $summary;
            $this->createdByUser = $createdByUser;
        }
        
        function Save()
        {
            $genreStr = "";
            $numberGenres = count($this->genres);
            for($i=0;$i<$numberGenres;$i++)
            {
                if($genreStr=="")
                {
                    $genreStr.=$this->genres[$i];
                }
                else
                {
                    $genreStr= $genreStr."|".$this->genres[$i];
                }
            }
            $query = "INSERT INTO Mangas(MangaName,Mangaka,Genres,Summary,Status,Enable,CreatedByUser) 
                      VALUES ('$this->mangaName','$this->mangaka','$genreStr','$this->summary','$this->status',1,'$this->createdByUser')";
            ExecuteQuery($query);
        }
        
        function  LoadData($mangaid)
        {
            $query = "SELECT * FROM Mangas WHERE MangaID=$mangaid";
            $data = GetData($query);
            if(count($data)>0)
            {
                $this->mangaID = $mangaid;
                $this->mangaName = $data[0]["MangaName"];
                $this->mangaka = $data[0]["Mangaka"];
                $this->status = $data[0]["Status"];
                $this->summary = $data[0]["Summary"];
                $this->enable = $data[0]["Enable"];
                $genreStr = $data[0]["Genres"];
                $this->genres = explode("|", $genreStr);
                $this->createdByUser = $data[0]["CreatedByUser"];
            }
        }
        
        function LoadDataRow($row)
        {
                $this->mangaID = $row["MangaID"];
                $this->mangaName = $row["MangaName"];
                $this->mangaka = $row["Mangaka"];
                $this->status = $row["Status"];
                $this->summary = $row["Summary"];
                $this->enable = $row["Enable"];
                $genreStr = $row["Genres"];
                $this->genres = explode("|", $genreStr);
                $this->createdByUser = $row["CreatedByUser"];
        }
        
        function Modify()
        {
            $genreStr = "";
            $numberGenres = count($this->genres);
            for($i=0;$i<$numberGenres;$i++)
            {
                if($genreStr=="")
                {
                    $genreStr.=$this->genres[$i];
                }
                else
                {
                    $genreStr= $genreStr."|".$this->genres[$i];
                }
            }
            $query = "UPDATE Mangas 
                      SET Mangaka='$this->mangaka',Genres='$genreStr',Summary='$this->summary',Status='$this->status' 
                      WHERE MangaName='$this->mangaName'";
            ExecuteQuery($query);
        }


        function MangaExists($manga)
        {
            $query = "SELECT * FROM Mangas WHERE MangaName='$manga'";
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
        
    }
?>
