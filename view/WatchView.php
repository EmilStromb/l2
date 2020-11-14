<?php

class WatchView {
    public function watchVideo($name) { // TODO change to a videomodel
        echo '<h2>' . $name . '</h2>
        <video width="700" height="400" controls>
        <source src="videos/' . $name . '" type="video/mp4"/>
        </video>';
    }
}