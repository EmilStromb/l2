<?php
session_start();

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/VideosView.php');
require_once('view/WatchView.php');
require_once('model/VideoArchiveDAL.php');
require_once('model/VideoModel.php');
require_once('controller/Navigation.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$vv = new VideosView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$wv = new WatchView();
$vm = new Video();
$vad = new VideoArchiveDAL();

$n = new NavController($vm, $vad);

$n->showView($v, $dtv, $lv, $vv, $wv);


