<?php
class BaseController	{
	public function __construct () {
		$users = new classUser ();
		$this->user = $users;
	}
} 
?>