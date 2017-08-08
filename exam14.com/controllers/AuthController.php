<?php
class AuthController extends BaseController  {
		public function actionStart() {
			session_start();
         	$this->user->inProf(); 
			require_once(ROOT . '/views/start.php');
		}
		public function actionCheck() {
			$this->user->check(); 
			require_once(ROOT . '/views/home.php');
		}
		public function actionSignup () {
			$this->user->signUp(); 
			require_once(ROOT . '/views/signup.php');
			
		}
		public function actionProfile (){
			$this->user->profile();
			require_once(ROOT . '/views/profile.php');
		}
		public function actionLogout (){
			$this->user->session();
			$this->user->logout();
			$this->user->outLog();
		}
}

?>