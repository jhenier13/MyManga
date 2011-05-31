<?php
if(!is_dir("./UploadMangas/Code Geass"))
{
    mkdir("./UploadMangas/Code Geass",0777,true);
}
else
{
    echo "El directorio ya existe";
}
?>
