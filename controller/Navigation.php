<?php
/** This class is only made to see how the website is navigated though buttons.
 * 
 */
class NavController {
    private $res;
    private $con;
    
    public function showView(LoginView $v, DateTimeView $dtv, LayoutView $lv, VideosView $vv, VideoController $vc, WatchController $wc) {
        // https://www.000webhost.com/forum/t/how-to-connect-to-database-using-php/42093 using phpmyadmin
        // https://www.youtube.com/watch?v=PtEb8Rpr_TQ&ab_channel=InfoHifi
        $this->con = mysqli_connect('localhost','root','','vuad');
        // Upload a video.
        if (isset($_POST['LayoutView::upload'])) 
        {
            $lv->render(true, $v, $dtv);
            $this->res = $vc->addVideo($this->con);
        // Show all Videos.
        } 
        else if (isset($_POST['LayoutView::video'])) 
        {
            $lv->render(true, $v, $dtv);
            $vv->showVidoes($this->con);
        }
        // watch videos
        else if (isset($_POST['VideosView::video'])) 
        {
            $lv->render(true, $v, $dtv);
            $videoID = $_POST['VideosView::id'];
            $wc->watchVidoes($videoID, $this->con);
        }
        // Logout
        else if(isset($_POST['LoginView::Logout']))
        {
            session_destroy();
            $lv->render(false, $v, $dtv);
        }
        // try login
        else 
        {
            // if password and username is set create session varibles and render <h2> login.
            if (isset($_POST['LoginView::Password']) && $_POST['LoginView::Password'] == "Password"  && (isset($_POST['LoginView::UserName']) && $_POST['LoginView::UserName'] == "Admin"))
            {
                $_SESSION['Username'] = $_POST['LoginView::UserName'];
                $_SESSION['Password'] = $_POST['LoginView::Password'];
                $lv->render(true, $v, $dtv);
            }
            else
            { 
                if(isset($_SESSION['Username']) && $_SESSION['Username'] =='Admin' && $_SESSION['Password'] == 'Password' && isset($_SESSION['Password']))
                {
                    $lv->render(true, $v, $dtv);
                    
                    // Check if uploaded file was successfull
                    if ($this->res == 1) 
                    {
                        echo "<h2>Video uploaded successfully</h2>";
                    }
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