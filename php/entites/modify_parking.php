<?php 
	session_start();
     if(isset($_GET["id"])){
        $id=$_GET["id"];
?>
<!DOCTYPE html >
<html lang= "en">
<?php
    require("../connexion.php");
    $query = "SELECT * FROM PARKING where NUM_PARKING='$id'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1){
        header("Location : ./parking.php");
    }
    $parking = mysqli_fetch_assoc($result);
?>
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
    <?php include("../../template/header.php") ?>

<div>

<h1> MODIFICATION PAGE </h1> 

<form action="<?php echo 'gestionParking.php?id='.$parking['NUM_PARKING']?> " method="post">
  <div class="container">

  <h1> NOM_PARKING </h1> <input type="text" name="NOM_PARKING" value="<?php echo $parking['NOM_PARKING']; ?>">
  <h1> CAPACITY </h1> <input type="text" name="CAPACITY" value="<?php echo $parking['CAPACITY']; ?>">
  <h1> TARIF_HORAIRE </h1> <input type="text" name="TARIF_HORAIRE" value="<?php echo $parking['TARIF_HORAIRE']; ?>">
  <input  name ="MODIFY_PARKING" value ="Modifier" type="submit">
  </div>
</form>
</div>
<?php include("../../template/footer.php") ?>

        
        <?php
            }
        ?>
</body>
</html>
