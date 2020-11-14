<?php

class VideosView {
    private static $video = 'VideosView::video';
    private static $id = 'VideosView::id';

	public function showVidoes($con) {
        $sql = "select * from videos";

        $res = mysqli_query($con, $sql);

        $HTML = '<h2>My Videos</h2>';
        // while there are new rows take each id and name
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $name = $row['name'];
            $HTML .= $this->render($id, $name);
        }
        echo $HTML;
    }

    private function render($id, $name) {
        return '
        <form method="post">
        <input name="'. self::$id . '" value="' . $id . '" hidden/>
        <input type="submit" name="'. self::$video . '" value="' . $name . '"/>
        </form>';
    }

    public function getIssetBtn() 
	{
      $btnType = self::$video;
      return isset($_POST[$btnType]);
      
  }
  
  public function getRequestBtn() 
	{
      $btnType = self::$video;

      if(isset($_POST[$btnType])) {
        return $_POST[$btnType];
      }
	}
}