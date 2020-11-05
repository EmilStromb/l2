<?php

class Video {
    private $videoName;
    private $uploadDate;
    private $fileLink;

	public function setVideoName(string $videoName) {
        $validation = $this->checkFileType($videoName);
        if ($validation = false) {
            throw new WrongFileTypeException();
        } else {
        $this->videoName = $videoName;
        $this->setVideoUploadDate();
      }
	}

	public function getVideoName() {
		return $this->videoName;
    }
    public function getVideoUploadDate() {
		return $this->uploadDate;
    }

    public function setfileLink(string $fileLink) {
		$this->uploadDate = $fileLink;
	}

    public function getfileLink() {
		return $this->uploadDate;
    }

    public function setVideoUploadDate() {
		$this->uploadDate = date("Y-m-d H:i:s");
	}

    public static function checkFileType(string $videoName) : bool {
        $fileType = explode(".",$videoName);
        if ($fileType[1] == "mp4" || $fileType[1] == "mkv")
           {
              return true;
           } else {
               return false;
           }
    }
}