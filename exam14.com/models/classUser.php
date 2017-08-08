<?php
class classUser {	

	private $conn;
	
	public function query($sql) {               // Функция  запроса в базу  
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
	public function __construct() {
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
		return $db;

    }  
			
	public function register($umail,$userpass) {           // Функция регистрации 
			$new_password = password_hash($userpass, PASSWORD_DEFAULT); // Создаем хэш пароля
			$stmt = $this->conn->prepare("INSERT INTO users(user_email,user_pass) VALUES(:umail, :userpass)");
			$stmt->bindparam(":umail", $umail);    // Присвоение
			$stmt->bindparam(":userpass", $new_password);										  	
			$stmt->execute();	
			return $stmt;	
	}
	public function login($umail,$userpass) {   // авторизация
			$stmt = $this->conn->prepare("SELECT user_id, user_email, user_pass FROM users WHERE  user_email=:umail ");
			$stmt->execute(array( ':umail'=>$umail)); // Выполняет запрос, который был ранее подготовлен функцией
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);  // возвращает массив, индексированный именами столбцов результирующего набора
			if($stmt->rowCount() == 1) {    // Проверка количества строк изменненых запросам в базу (последним)
				if(password_verify($userpass, $userRow['user_pass'])) {// проверка пароля на соответствие хэшу пароля
					$_SESSION['user_session'] = $userRow['user_id'];   // открываем сессию, если пароли ок
					return true;
				}
				else {
					return false;
				}
			}
		
		
	}
	
	public function checkingLog() {       //  Проверка зарегистрирован или нет
		if(isset($_SESSION['user_session'])) {
			return true;
		}
	}
	
	public function redirect($url) {   // смогу переадресовывать пользователя
 		header("Location: $url");
 		return true;
	}
	
	public function outLog() {    // этим методом я смогу выходить из сессиИ
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
	public function inProf () {		
		if($this->checkingLog()!="") {
			$this->redirect('home');
		}
		if(isset($_POST['btn-login'])) {
			$umail = strip_tags($_POST['txt_uname_email']);
			$upass = strip_tags($_POST['txt_password']);
			if($this->login($umail,$upass)) {
				$this->redirect('home');
				return true;
			}
			else {
				$error = "Wrong Details !";
				return false;
			}	
		}
	}
	public function check  () { // check
		$this-> session();
		$user_id = $_SESSION['user_session'];
		$stmt = $this->query("SELECT * FROM users WHERE user_id=:user_id");
		$stmt->execute(array(":user_id"=>$user_id));
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		 return true;
	}
	public function logout (){
		if($this->checkingLog()!="") {
		$this->redirect('home');
		}
		if(isset($_GET['logout']) && $_GET['logout']=="true") {
		$this->redirect('start');
		}
		return true;
	}
	public function profile (){
		$this-> session();
		$user_id = $_SESSION['user_session'];
		$stmt = $this->query("SELECT * FROM users WHERE user_id=:user_id");
		$stmt->execute(array(":user_id"=>$user_id));
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return true;
	}
	public function session () {
		session_start();
		if(!$this->checkingLog()){
		$this->redirect('start');
		}
		return true;
	}

	public function signUp () {
		session_start();
		if($this->checkingLog()!=""){
			$this->redirect('home');
		}

		if(isset($_POST['btn-signup'])){
			$umail = strip_tags($_POST['txt_umail']);
			$upass = strip_tags($_POST['txt_upass']);	
			if($umail=="")	{
				echo "";	
			}
			else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
				$error[] = 'Please enter a valid email address !';
			}
			else if($upass=="")	{
				$error[] = "provide password !";
			}
			else if(strlen($upass) < 6){
				$error[] = "Password must be atleast 6 characters";	
			}
			else {
					$stmt = $this->query("SELECT  user_email FROM users WHERE  user_email=:umail");
					$stmt->execute(array(':umail'=>$umail));
					$row=$stmt->fetch(PDO::FETCH_ASSOC);

					if($row['user_email']==$umail) {
						$error[] = "sorry email id already taken !";
					}
					else {
						if($this->register($umail,$upass)){	
							$this->redirect('sign-up');
						}
					}
				
				
			}	
		}
	} 
	function __destruct() {
         $this->conn = null; 
         return true;    
    }

	
}
?>