<?php

class VideoArchive {

	private $archive = array();


	public function getAll() : array {
		return $this->archive;
	}

	public function getArchiveItem(string $videoName) {
		foreach ($this->archive as $existingVideo) {
			if ($existingVideo->getVideoName() == $videoName) {
				return $existingVideo;
			}
		}

		throw new \Exception("video was not found");
	}

	public function add(Video $toBeAdded) {

		foreach ($this->archive as $existingVideo) {
			if ($existingVideo->getVideoName() == $toBeAdded->getVideoName()) {
				throw new \Exception("This video already exists in this archive");
			}
		}

		$this->archive[] = $toBeAdded;
	}


}
