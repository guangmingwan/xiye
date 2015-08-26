<?php
    
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];
    }
    move_uploaded_file($_FILES["file"]["tmp_name"],
                       "./" . $_FILES["file"]["name"]);//将上传的文件存储到服务器
    //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

?>