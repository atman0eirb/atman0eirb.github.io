<?php 
	session_start();
?>
<!DOCTYPE html >
<html lang= "en">

    <head >
        <meta charset = " UTF - 8 ">
        <link rel="stylesheet" href="style.css">
        <style>

	input[type=text], input[type=password] {
	width: 100%;
	padding: 10px 8px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	box-sizing: border-box;
	}

	h1{
	  text-align: center;
	  font-family: 'Allerta Stencil';font-size: 20px;

	}

	.container {
	padding: 10px 0;
	text-align:left;
	}

	</style>
    </head >
    
<body>
    <?php 
	include("../../template/header.php") ;
	    require("../connexion.php");
		?>
		<br/><br/><br/>
<?php 
if(!isset($_GET["id"]))
{
	?>
	<div id="NEW">
		<h1> Ajouter une nouvelle commune </h1> 
	</div>
	<form action="gestionCommune.php" method="post">
		<div class="container">
		<div class="form-group">
			<label for="CODE_POSTALE">CODE_POSTALE</label>	
			<input class="form-control" id="CODE_POSTALE"  type="number" min="1" name="CODE_POSTALE" required>
		</div>
		<div class="form-group">
			<label for="NOM_COMMUNE">NOM_COMMUNE</label>	
			<input class="form-control" id="NOM_COMMUNE" type="text"  name="NOM_COMMUNE" required >
		</div>



		<!--<h1> CODE_POSTALE </h1> <input type="text" name="CODE_POSTALE" required>
		<h1> NOM_COMMUNE </h1> <input type="text" name="NOM_COMMUNE" required>-->
		<button class="btn btn-success" value="add_commune" name="add_commune" type="submit">Ajouter Commune</button>
		</div>
	</form>
<?php
}else{
	$query = "SELECT CODE_POSTALE,NOM_COMMUNE FROM COMMUNE where CODE_POSTALE='".$_GET["id"]."';";
    $result = mysqli_query($con,$query) ;

    $communes=mysqli_fetch_all($result, MYSQLI_ASSOC);

	$commune=$communes[0];
	?>
	<div id="NEW">
	<h1> Modifier une commune </h1> 
	</div>
	<form action="gestionCommune.php?id=<?php echo $_GET["id"];?>" method="post">
  	<div class="container">
  	<div class="form-group">
		<label for="CAPACITY">CODE_POSTALE</label>	
		<input class="form-control" value="<?php echo $commune['CODE_POSTALE'];?>" type="number" min="1" name="CODE_POSTALE" disabled required>
	</div>
	<div class="form-group">
		<label for="CAPACITY">NOM_COMMUNE</label>	
		<input class="form-control" value="<?php echo $commune['NOM_COMMUNE'];?>" type="text"  name="NOM_COMMUNE" required >
	</div>



  <!--<h1> CODE_POSTALE </h1> <input type="text" value="<?php echo $commune['CODE_POSTALE'];?>" name="CODE_POSTALE" disabled required>
  <h1> NOM_COMMUNE </h1> <input type="text" value="<?php echo $commune['NOM_COMMUNE'];?>" name="NOM_COMMUNE" required>-->
  <button class="btn btn-warning" value="MODIFY_COMMUNE" name="MODIFY_COMMUNE" type="submit">modifier Commune</button>
  </div>
</form>

<?php 
}
?>

</div>


<?php include("../../template/footer.php") ?>

        
      
</body>
</html>
