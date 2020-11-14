<?php

class VideoArchiveDAL {

	public function getFromDatabase($id, $con) : Video {
        $sql = "select name from videos where id='$id'";
        $res = mysqli_query($con, $sql);
        
        $row = mysqli_fetch_assoc($res);

        $name = $row['name'];
        $datum = $row['datum'];

        $video = new Video();

        $video->setVideoName($name);
        $video->setVideoUploadDate($datum);
        return $video;
        
	}

	public function saveToDB($con, Video $videoModel) {
            $videoModel->setVideoName($_FILES['file']['name']);
            $videoModel->setfileLink($_FILES['file']['tmp_name']);
            $videoModel->setVideoUploadDate(date("Y-m-d H:i:s"));
        
            // this is done because I couldn't get the $sql line to work with call to methods.
            $name = $videoModel->getVideoName();
            $tmp = $videoModel->getfileLink();
            $datum = $videoModel->getVideoUploadDate();

            //take video and move it to videos file
            move_uploaded_file($tmp, "videos/".$name);

            $sql = "INSERT INTO videos (name, datum) VALUES('$name', '$datum')";

            // take the data and query in sql database. This will insert the video into the database. 
            $res = mysqli_query($con, $sql);
            return $res;

    }
}
