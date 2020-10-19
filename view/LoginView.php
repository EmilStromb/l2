<?php

class LoginView 
{
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		// If checkbox Keep me logged in is checked.
		if (isset($_POST[self::$keep])) {
			// hashing password
			$hashedPass = password_hash($_SESSION['Password'], PASSWORD_DEFAULT);
			// Setting cookies
			setcookie(self::$cookieName, $_SESSION['Username'], time() + (86400 * 30), "/" );
			setcookie(self::$cookiePassword, $hashedPass , time() + (86400 * 30), "/" );
			// Adding message and generating html
			$_SESSION['Message'] = "Welcome and you will be remembered";
			$response = $this->generateLogoutButtonHTML();
			return $response;
		}
		// Check if its first time and if loggedin has been set.
		if (!isset($_SESSION['LoggedIn'])) 
		{
			$_SESSION['LoggedIn'] = false;
		}

		$_SESSION['Message'] = '';

		// Check if you are logged in.
		if ($_SESSION['LoggedIn'] == true) 
		{
		    if(isset($_POST[self::$logout])) 
	    	{
		    	$_SESSION['Message'] = "Bye bye!";
		    	$response = $this->generateLoginFormHTML();
		    	return $response;
		    	$_SESSION['LoggedIn'] = false;
		    }
		}
		else
		{
		// Check if button is pressed
		    if(isset($_POST[self::$login])) 
		    {
		    	$_SESSION['LoggedIn'] = false;
		    	$username = "Admin";
			    $password = "Password";

			    // Check if username has been inputted
		    	if($this->getRequestUserName() == '') 
			    {
			     	$_SESSION['Message'] = "Username is missing";
			    } 
			    // Check if password has been inputted
				else if ($this->getRequestPassword() == '') 
				{
					$_SESSION['Message'] = "Password is missing";
				}
				// check if username and password matches
				else if ($password == $this->getRequestPassword() && $username == $this->getRequestUserName()) 
				{
				    $_SESSION['LoggedIn'] = true;
				    $_SESSION['Message'] = "Welcome";
				    $response = $this->generateLogoutButtonHTML();
				    return $response;	
				} 
				else 
				{
					$_SESSION['Message'] = "Wrong name or password";
				}
			}
		}
		if (isset($_SESSION['Username']) && $_SESSION['Username'] =='Admin' && $_SESSION['Password'] == 'Password' && isset($_SESSION['Password'])) 
		{
			// if you are logged in generate logout form
				 $response = $this->generateLogoutButtonHTML();
				return $response;
		}

		$response = $this->generateLoginFormHTML();
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML() 
	{
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $_SESSION['Message'] .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML()
	{
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $_SESSION['Message'] . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLESS
	private function getRequestUserName() 
	{
		$name = self::$name;
		//RETURN REQUEST VARIABLE: USERNAME
		if(isset($_POST[$name])) {
			return $_POST[$name];
		}
	}
	
	private function getRequestPassword() 
	{
		$password = self::$password;
		//RETURN REQUEST VARIABLE: USERNAME
		if(isset($_POST[$password])) {
			return $_POST[$password];
		}
	}
	private function getName() 
	{
		return $this->getRequestUserName();
	}
}