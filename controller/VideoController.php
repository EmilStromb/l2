<?php

class VideoController {
    
    public function addVideo($con) {
        // connect to localhost sql
        $name = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        
        //take video and move it to videos file
        move_uploaded_file($tmp, "videos/".$name);

        $sql = "INSERT INTO videos (name) VALUES('$name')";

        // take the data and query in sql database. This will insert the video into the database. 
        $res = mysqli_query($con, $sql);
        return $res;
    }
}