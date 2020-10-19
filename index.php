<?php
session_start();

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/VideosView.php');
require_once('controller/Navigation.php');
require_once('controller/VideoController.php');
require_once('controller/WatchController.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$vv = new VideosView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$wc = new WatchController();
$vc = new VideoController();


$n = new NavController();

$n->showView($v, $dtv, $lv, $vv, $vc, $wc);


