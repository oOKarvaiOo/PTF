<?php

	session_start();
	include "classes.php";
	$ajax = new USER;

	switch ($_POST['action']) {
		case 'signup':
					$email=$_POST['email'];
					$password=$_POST['password'];
					$confirm=$_POST['confirm'];
					$isTrainer=$_POST['isTrainer'];

					echo $ajax->SignUp($email,$password,$confirm,$isTrainer);
		break;
		case 'signin':
					$email=$_POST['email'];
					$password=$_POST['password'];

					echo $ajax->SignIn($email,$password);
		break;
		case 'personal_datas': 
					$id=$_SESSION['id'];
					$name=$_POST['fullname'];
					$birth=$_POST['birthday'];
					$gender=$_POST['gender'];
					$weight=$_POST['weightt'];
					$height=$_POST['heightt'];
					
					echo $ajax->UpdatePersonalDatas($id,$name,$birth,$gender,$weight,$height);
		break;
		
		case 'logout': $_SESSION['id']="";
		break;
		
		case "fill-personal-datas": $datas=$ajax->PersonalDatas($_SESSION['id']); echo json_encode($datas);
		break; 

	  default:
		// code...
		break;
	}

?>
