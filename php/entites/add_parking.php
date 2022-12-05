<?php 
	session_start();

	if(isset($_GET["err"])){
		if($_GET["err"]=="exist"){
			echo '<script>alert("parking existe déja !!")</script>';
		}else if($_GET["err"]=="exist"){
			echo '<script>alert("Erreur d\'insertion !!")</script>';

		}
	}
	require("../connexion.php");

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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head >
    
<body>
    <?php include("../../template/header.php") ?>

<div>
	<br/>
	<br/>
	
<?php if(isset($_POST["ADD_PARKING"])){?>
<div id="NEW">
<h1> Ajouter un nouveau parking </h1> 
</div>
<form action="gestionParking.php?id=add_parking" method="post">
	<div class="container">
		<div class="form-group">
			<label for="NOM_PARKING">NOM PARKING</label>	
			<input class="form-control" type="text" id="NOM_PARKING" name="NOM_PARKING" required>
		</div>

		<div class="form-group">
			<label for="ADRESSE">ADRESSE</label>	
			<input class="form-control" type="text" id="ADRESSE" name="ADRESSE" required>
		</div>

		<div class="form-group">
			<label for="CAPACITY">CAPACITY</label>	
			<input class="form-control" id="CAPACITY" type="number" min="1" name="CAPACITY" required>
		</div>
		<div class="form-group">
			<label for="CODE_POSTALE">CODE POSTALE</label>
			<select class="custom-select"  name="CODE_POSTALE" id="CODE_POSTALE" required>
					<?php
					require("../connexion.php");
					$query = "SELECT CODE_POSTALE, NOM_COMMUNE FROM COMMUNE";
					$result = mysqli_query($con,$query) ;
					$communes=mysqli_fetch_all($result, MYSQLI_ASSOC);
					foreach($communes as $commune){ ?>
						<option value="<?php echo $commune["CODE_POSTALE"];?>"> <?php echo $commune["CODE_POSTALE"]."  :  ".$commune["NOM_COMMUNE"];?></option>
					<?php }?>

				</select>
		</div>
		<div class="form-group">
			<label for="TARIF_HORAIRE">TARIF HORAIRE</label>
			<input class="form-control" type="number" step="0.0001" id="TARIF_HORAIRE" name="TARIF_HORAIRE" required>
		</div>
	<input class="btn btn-success" value="Add" type="submit">
   	<input  class="btn btn-warning" type="reset" value="RESET">
  </div>
</form>
<?php }else if (isset($_GET["id"]) && $_POST["MODIFY_PARKING"]){
$id=$_GET["id"];
$query = "SELECT NUM_PARKING,NOM_PARKING,ADRESSE,CAPACITY,PARKING.CODE_POSTALE as cp,NOM_COMMUNE,TARIF_HORAIRE FROM PARKING INNER JOIN COMMUNE USING(CODE_POSTALE) where NUM_PARKING=$id";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1){
        header("Location : ./parking.php");
    }
    $parking = mysqli_fetch_assoc($result);


?>
<div id="NEW">
<h1> MODIFICATION PARKING </h1> 
</div>

<form action="<?php echo 'gestionParking.php?id='.$parking['NUM_PARKING']?> " method="post">
<div class="container">
<div class="form-group">
			<label for="NOM_PARKING">NUM PARKING</label>	
			<input class="form-control" type="text" id="NUM_PARKING" name="NUM_PARKING" value="<?php echo $parking['NUM_PARKING']; ?>" required disabled>
		</div>
		<div class="form-group">
			<label for="NOM_PARKING">NOM PARKING</label>	
			<input class="form-control" type="text" id="NOM_PARKING" name="NOM_PARKING" value="<?php echo $parking['NOM_PARKING'];?>"  required >
		</div>

		<div class="form-group">
			<label for="ADRESSE">ADRESSE</label>	
			<input class="form-control" type="text" id="ADRESSE" name="ADRESSE" value="<?php echo $parking['ADRESSE']; ?>" required disabled>
		</div>

		<div class="form-group">
			<label for="CAPACITY">CAPACITY</label>	
			<input class="form-control" id="CAPACITY" type="number" min="1" name="CAPACITY" value="<?php echo $parking['CAPACITY']; ?>" required>
		</div>
		<div class="form-group">
			<label for="CODE_POSTALE">CODE POSTALE</label>
			<select class="custom-select"  name="CODE_POSTALE" id="CODE_POSTALE" required disabled>
				<option value="<?php echo $parking["cp"];?>"> <?php echo $parking["cp"]."  :  ".$parking["NOM_COMMUNE"];?></option>
			</select>
		</div>
		<div class="form-group">
			<label for="TARIF_HORAIRE">TARIF HORAIRE</label>
			<input class="form-control" type="number" step="0.0001" id="TARIF_HORAIRE" name="TARIF_HORAIRE" value="<?php echo $parking['TARIF_HORAIRE']; ?>" required>
		</div>
	<input class="btn btn-success" value="Modifier" name ="MODIFY_PARKING" type="submit">
  </div>
<!--
  <div class="container">

  <h1> NOM_PARKING </h1> <input type="text" name="NOM_PARKING" value="<?php echo $parking['NOM_PARKING']; ?>">
  <h1> CAPACITY </h1> <input type="text" name="CAPACITY" value="<?php echo $parking['CAPACITY']; ?>">
  <h1> TARIF_HORAIRE </h1> <input type="text" name="TARIF_HORAIRE" value="<?php echo $parking['TARIF_HORAIRE']; ?>">
  <input  name ="MODIFY_PARKING" value ="Modifier" type="submit">
  </div>-->
</form>








<?php }?>

</div>
<?php include("../../template/footer.php") ?>

</body>
</html>
