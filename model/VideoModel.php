<?php

class Video {
    private $videoName;
    private $uploadDate;
    private $fileLink;

	public function setVideoName(string $videoName) {
        if ($this->checkFileType($videoName)) {
             $this->videoName = $videoName;
        } else {
             throw new \Exception("The file $videoName is not of file type .mkv or .mp4");
      }
	}

	public function getVideoName() {
		return $this->videoName;
    }
  public function getVideoUploadDate() {
		return $this->uploadDate;
    }

  public function setfileLink(string $fileLink) {
		$this->fileLink = $fileLink;
	}

  public function getfileLink() {
		return $this->fileLink;
  }

  public function setVideoUploadDate(string $date) {
		$this->uploadDate = $date;
  }

  public static function checkFileType(string $videoName) {
      $fileType = explode(".",$videoName);
      if (end($fileType) == "mp4" || end($fileType) == "mkv")
         {
            return true;
         } else {
              return false;
         }
    }
}