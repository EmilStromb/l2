<?php

/** This class is only made to see how the website is navigated though buttons.
 * 
 */
class NavController {
    
    public function showView(LoginView $v, DateTimeView $dtv, LayoutView $lv) {
        // Upload a video.
        if (isset($_POST['LayoutView::upload'])) 
        {
            $con = mysqli_connect('localhost','root','','vuad');
            $name = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];

            move_uploaded_file($tmp, "videos/".$name);

            $sql = "INSERT INTO videos (name) VALUES('$name')";

            $res = mysqli_query($con, $sql);

            if ($res == 1) 
            {
                echo "<h1>Video uploaded successfully</h1>";
            }
        }
        // Logout
        if(isset($_POST['LoginView::Logout']))
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