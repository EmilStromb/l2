<?php

class VideoController {
    
    public function addVideo($con, video $videoModel) {
        $videoModel->setVideoName($_FILES['file']['name']);
        $videoModel->setfileLink($_FILES['file']['tmp_name']);
        
        $name = $videoModel->getVideoName();
        $tmp = $videoModel->getfileLink();

        //take video and move it to videos file
        move_uploaded_file($tmp, "videos/".$name);

        $sql = "INSERT INTO videos (name) VALUES('$name')";

        // take the data and query in sql database. This will insert the video into the database. 
        $res = mysqli_query($con, $sql);
        return $res;
    }
}