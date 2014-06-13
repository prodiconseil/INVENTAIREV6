<?php 
class Session{

	public static function flash(){
		if(isset($_SESSION['Flash'])){
			extract($_SESSION['Flash']);
			unset($_SESSION['Flash']);
			return "
			<div class='alert $type'>$message
			<a href='#' style='color:#fff; float:right;' class='close' onclick='$(this).parent().fadeOut();'>&times;</a>
			</div>";
		}

	}

	public static function setFlash($message, $type = 'success'){
		$_SESSION['Flash']['message'] = $message;
		$_SESSION['Flash']['type'] = $type;
	}
	

}

new Session();