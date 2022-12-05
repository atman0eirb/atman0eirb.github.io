<?php 
	require("connexion.php");
	if(isset($_POST["username"])&&isset($_POST["password"])){
		$pass=$_POST["password"];
		$username=$_POST["username"];
		$username = mysqli_real_escape_string($con, $username);
		//crypt permet de hasher une chaine en utilisant le type de hashage BLOWFISH 
		$pass=crypt($pass,'CRYPT_BLOWFISH');
		$pass = mysqli_real_escape_string($con, $pass);
		$query = "SELECT * FROM USERS WHERE USER_NAME='$username' and PASSWORD='$pass' ";
		$result = mysqli_query($con,$query) ;
		$rows = mysqli_num_rows($result);
		if($rows==1){
			session_start();
			$_SESSION['username']=$username;
			header("Location: accueil.php");
		}
		else{
		//err=1 pour indiquer que le mdp est faut
			header("Location: ../login.php?err=1");

		}

	}
?>