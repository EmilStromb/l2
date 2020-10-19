<?php

class WatchController {
	public function watchVidoes($id, $con) {
        $sql = "select name from videos where id='$id'";
        $res = mysqli_query($con, $sql);
        
        $row = mysqli_fetch_assoc($res);

        $name = $row['name'];

        $HTML = "<h2>$name</h2> \n";

        $HTML .= '
        <video width="700" height="400" controls>
        <source src="videos/' . $name . '" type="video/mp4"/>
        </video>';
        
        echo $HTML;
    }
}