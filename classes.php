<?php
	class SQL{

	  private $servername = "localhost";
	  private $username = "root";
	  private $password = "";
	  private $table = "ptf";

	  protected function Conn(){

		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->table);
		$conn->query("SET NAMES utf8");
		return $conn;

	  }

	}

	class USER extends SQL{

	  function __construct(){
		// Check connection
		if ($this->Conn()->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	  }

	  public function SignUp($email,$password,$confirm,$isTrainer){
		$result=$this->Conn()->query("SELECT * FROM users WHERE email = '$email'");
		if ($result->num_rows<1) {
		  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				return "wrong_email";
		  }else if (strlen($password)>32 || strlen($password)<6) {
		  	return "wrong_pw_length";
		  }else{
				$password=md5($password);
				$sql="INSERT INTO `users`( `email`, `password`, `reg_date`, `last_login`, `is_trainer`) VALUES ('$email','$password',NOW(),NOW(),'$isTrainer')";
				$this->Conn()->query($sql);
				return "succes";
			}
		}else{
		  return "Ezzel az email címmel már regisztráltak!";
			}
	  }

		public function SignIn($email,$password){
			$password=md5($password);
			$result=$this->Conn()->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
			$rows=$result->num_rows;
			if ($rows>0) {
				$row=$result->fetch_array();
				$_SESSION['id']=$row[0];
				return "success";
			}else{
				return "wrong_login";
			}

		}
		
		public function UpdatePersonalDatas($id,$name,$birth,$sex,$weight,$height){
			$sql="select id from people where user_id=$id";
			$result=$this->Conn()->query($sql);
			if($result->num_rows<1){
				$sql="INSERT INTO `people`(`user_id`, `name`, `sex`, `is_trainer`, `birth_date`, `weight`, `height`) VALUES ($id,'$name','$sex','$isTrainer','$birth',$weight,$height)";
				$this->Conn()->query($sql);
			}else{
				$sql="UPDATE `people` SET `name`='$name',`sex`='$sex',`birth_date`='$birth',`weight`=$weight,`height`=$height WHERE user_id=$id";
				$this->Conn()->query($sql);
			}
		}
		
		public function PersonalDatas($id){
			$sql="select name, sex, weight, height, birth_date from people where user_id=$id";
			$result=$this->Conn()->query($sql);
			if($result->num_rows>0){
				return $result->fetch_assoc();
			}else{
				return "error";
			}
		}

	}

?>
