<?php
	if(isset($_GET['err'])){
		echo "<h3 style='color:red'> Mot de passe incorrect!! </h1>";
	}

?>
<form method="POST" action="verifLogin.php">
	<input type="text" name="username" placeholder="username"/>
	<input type="password" name="password" placeholder="password"/>
	<input type="submit" />
</form>





