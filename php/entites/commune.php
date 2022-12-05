<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
<?php include('../../template/header.php'); require("../connexion.php"); ?>

<style>


.entete  {
  border: 5px outset lightblue;
  background-color: lightblue;    
  text-align: center;
}
.form_add
{
    border:solid 1px #0094ff;
    padding:10px;
    margin:5px;
    font-size:15px;
    font-family:Verdana;
    text-align:center;
    border-radius:10px;
    justify-content: center;
}
        


</style>

<?php
if(!isset($_SESSION["username"])){
  header("Location: ../../login.php");
}
if(isset($_GET["add"])){
		if($_GET["add"]=="succ"){
			echo '<script>alert("Commune ajouté!!")</script>';
		}
	}
	if(isset($_GET["mod"])){
		if($_GET["mod"]=="succ"){
			echo '<script>alert("Commune modifié!!")</script>';
		}
	}
	if(isset($_GET["del"])){
		if($_GET["del"]=="succ"){
			echo '<script>alert("Commune supprimé!!")</script>';
		}
	}
  ?>
</head>
<body>

<div>
  <div class="entete">
      <h5 class="description" > <b> NOMBRE DES COMMUNES :</b>
            
          <?php 
            $query = "SELECT count(*) as nb FROM COMMUNE;";
            $result = mysqli_query($con,$query);
            $place_dispo= mysqli_fetch_assoc($result); 
            echo $place_dispo["nb"]; 
          ?>
      </h5>
    </div>
<div id="NEW">
  <form class="form_add" method="post" action="AddCommune.php">
  <input  class="btn btn-primary" type="submit" name="ADD_COMMUNE" value="ADD_COMMUNE" />
</form>
</div>
</div>
<?php
	
   
	  if (isset($_POST["CODE_POSTALE"]) || isset($_POST["NOM_COMMUNE"])){
	  
	  $query_modify="INSERT INTO COMMUNE (CODE_POSTALE,NOM_COMMUNE)
 			VALUES ($_POST[CODE_POSTALE],\"$_POST[NOM_COMMUNE]\")";
			
			
	$modify = mysqli_query($con,$query_modify);
	  
	  
	  }
	  
	  	$query = "SELECT * FROM COMMUNE";
	 
    $result = mysqli_query($con,$query) ;
    $communes=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
  <table class="table">
        <thead>
          <tr>
              <th>CODE_POSTALE</th>
              <th>NOM_COMMUNE</th>
              <th>MODIFIER COMMUNE</th>
              <th>SUPPRIMER COMMUNE</th>
              
          </tr>
        </thead>

        <tbody>
        <?php
            foreach($communes as $commune){ ?>
              <tr>
            <td><a href="<?php echo '../../stats/Infocommune.php?id='.$commune['CODE_POSTALE']?> "><?php echo $commune["CODE_POSTALE"]?></a></td>
            <td><?php echo $commune["NOM_COMMUNE"]?></td>
            <td>
                <form method="post" action="<?php echo 'AddCommune.php?id='.$commune['CODE_POSTALE']?> ">
                <button class="btn btn-warning" type="submit" name="modifier_commune" class="modifier_commune" value="<?php echo $commune['CODE_POSTALE'];?>"> 
                  <i class="bi bi-pencil-fill"></i>
                </button>
                </form>
            </td>
            <td>
              <form method="post" action="<?php echo 'gestionCommune.php?id='.$commune['CODE_POSTALE']?> " >
              <button  class="btn btn-danger" type="submit" name="DELETE_PARKING" value="<?php echo $commune['CODE_POSTALE'];?>"> 
                <i class="bi bi-trash"></i>
              </buttton>
              </form>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
            
<?php include('../../template/footer.php'); ?>
            </body>
</html>
