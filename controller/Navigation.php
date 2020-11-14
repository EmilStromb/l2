<?php
/** This class is only made to see how the website is navigated though buttons.
 * 
 */
class NavController {
    private $con;
    private $videoModel;
    private $videoArchiveDAL;

    public function __construct(video $vm, VideoArchiveDAL $vad)  {
        $this->videoModel = $vm;
        $this->videoArchiveDAL = $vad;
        $this->con = mysqli_connect('localhost','root','','id14880337_myadmin');
	}
    
    public function showView(LoginView $v, DateTimeView $dtv, LayoutView $lv, VideosView $vv, WatchView $wv) {
        // https://www.000webhost.com/forum/t/how-to-connect-to-database-using-php/42093 using phpmyadmin
        // https://www.youtube.com/watch?v=PtEb8Rpr_TQ&ab_channel=InfoHifi
        // Upload a video.
        if ($lv->getIssetBtn("upload"))
        {
            try {
                $lv->render(true, $v, $dtv);
                $this->videoArchiveDAL->saveToDB($this->con, $this->videoModel);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } 
        else if ($lv->getIssetBtn("video")) 
        {
            $lv->render(true, $v, $dtv);
            $vv->showVidoes($this->con);
        }
        // watch videos
        else if ($vv->getIssetBtn("video")) 
        {
            $lv->render(true, $v, $dtv);
            $videoName = $vv->getRequestBtn();
            $wv->watchVideo($videoName);
        }
        // Logout
        else if($v->getIssetBtn("logout"))
        {
            session_destroy();
            $lv->render(false, $v, $dtv);
        }
        // try login
        else 
        {
            // if password and username is set create session varibles and render <h2> login.
            if ($v->getIssetBtn("password") && $v->getRequestBtn("password") == "Password"  && $v->getIssetBtn("name") && $v->getRequestBtn("name") == "Admin")
            {
                $_SESSION['Username'] = $v->getRequestBtn("name");
                $_SESSION['Password'] = $v->getRequestBtn("password");
                $lv->render(true, $v, $dtv);
            }
            else
            { 
                if(isset($_SESSION['Username']) && $_SESSION['Username'] =='Admin' && $_SESSION['Password'] == 'Password' && isset($_SESSION['Password']))
                {
                    $lv->render(true, $v, $dtv);
                }
                // if the user is not logged in. 
                else
                {
                    $lv->render(false, $v, $dtv);
                }
            }
        }
    }
}