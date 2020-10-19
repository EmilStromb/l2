<?php


class LayoutView {
  private static $video = 'LayoutView::video';
  private static $upload = 'LayoutView::upload';


  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) 
  {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
          </div>
          <div>
          ' . $this->LoggedIn($isLoggedIn) . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) 
  {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
  private function LoggedIn($isLoggedIn) 
  {
    if ($isLoggedIn) {
      return '<h3>Video uploader</h3>
      <form method="post">
      <input type="submit" name="'. self::$video . '" value="videos"/>
      </form>
      <hr>
      <form method="post" enctype="multipart/form-data">
      <input type="file" name="file"/>
      <input type="submit" name="'. self::$upload . '" value="upload"/>
      </form>';
    } else {
      return '';
    }
  }
}