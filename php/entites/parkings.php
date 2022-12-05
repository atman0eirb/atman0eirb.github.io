<?php 
	
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: ../../login.php");
	  }
	 if(isset($_GET["id"])){
        	$id=$_GET["id"];
        }

       
?>
<!DOCTYPE html>
<html>
	<head>
<?php include('../../template/header.php'); ?>
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
        
form ul { list-style-type: none; }

form ul li { display: inline-block }

::placeholder {
  color: blue;
}

</style>


</head>
<body>
<br/><br/>

<div>
<div class="entete">
      <h5 class="description" > <b> NOMBRE DE Parking :</b>
            
          <?php 
		  	require("../connexion.php");
            $query = "SELECT count(*) as nb FROM PARKING;";
            $result = mysqli_query($con,$query);
            $place_dispo= mysqli_fetch_assoc($result); 
            echo $place_dispo["nb"]; 
          ?>
      </h5>
    </div>
<div>
 	<form class="form_add" method="post" action="add_parking.php">
	<div style="text-align: center;	">
        	<input type="submit" name="ADD_PARKING"  value="ADD PARKING" class="btn btn-primary"/>
	</div>
               
    </form>
</div>
<br/>

</div>
<div>

<form action="<?php echo 'parkings.php?id=filtre'?>" method="post">
  <ul>
  <li><input class="form-control" type="text" name="NUM_PARKING" placeholder="NUM_PARKING" ></li>
  <li> <input class="form-control" type="text" name="NOM_PARKING" placeholder="NOM_PARKING"></li>
  <li> <input class="form-control" type="text" name="ADRESSE" placeholder="ADRESSE"></li>
  <li> <input class="form-control" type="text" name="CAPACITY" placeholder="CAPACITY"></li>
  <li> <input class="form-control" type="text" name="CODE_POSTALE" placeholder="CODE_POSTALE"></li>
  <li> <input class="form-control" type="text" name="TARIF_HORAIRE" placeholder="TARIF_HORAIRE"></li>
  <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
  <input type="reset" class="btn btn-warning" value="RESET">
  <!--&ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; -->
  	
  <ul>
</form>
</div>

<?php
	
	if(isset($_GET["add"])){
		if($_GET["add"]=="succ"){
			echo '<script>alert("parking ajouté!!")</script>';
		}
	}
	if(isset($_GET["mod"])){
		if($_GET["mod"]=="succ"){
			echo '<script>alert("parking modifié!!")</script>';
		}
	}
	if(isset($_GET["del"])){
		if($_GET["del"]=="succ"){
			echo '<script>alert("parking supprimé!!")</script>';
		}
	}
	 if(isset($_GET["id"])){
        	$id=$_GET["id"];
        
	
		if($id=="filtre"){
		
			$requet1="SELECT * FROM PARKING INTERSECT ";
		        $requet2="SELECT * FROM PARKING INTERSECT ";
		        $requet3="SELECT * FROM PARKING INTERSECT ";
		        $requet4="SELECT * FROM PARKING INTERSECT ";
		        $requet5="SELECT * FROM PARKING INTERSECT ";
		        $requet6="SELECT * FROM PARKING";
		        
		        if(!empty($_POST["NUM_PARKING"])){
		                        $requet1="SELECT * FROM PARKING WHERE NUM_PARKING ='$_POST[NUM_PARKING]' INTERSECT ";
		                        }
		        if(!empty($_POST["NOM_PARKING"])){
		                        $requet2="SELECT * FROM PARKING WHERE NOM_PARKING like '".$_POST["NOM_PARKING"]."%'  INTERSECT ";
		                        }
		        if(!empty($_POST["ADRESSE"])){
		                        $requet3="SELECT * FROM PARKING WHERE ADRESSE like '".$_POST["ADRESSE"]."%'  INTERSECT ";
		                        }
		        if(!empty($_POST["CAPACITY"])){
		                        $requet4="SELECT * FROM PARKING WHERE CAPACITY=$_POST[CAPACITY] INTERSECT ";
		                        }
		        if(!empty($_POST["CODE_POSTALE"])){
		                        $requet5="SELECT * FROM PARKING WHERE CODE_POSTALE=$_POST[CODE_POSTALE] INTERSECT ";
		                        }
		        if(!empty($_POST["TARIF_HORAIRE"])){
		                        $requet6="SELECT * FROM PARKING WHERE TARIF_HORAIRE=$_POST[TARIF_HORAIRE]";
		                        }
		                        
		        	$query = $requet1.$requet2.$requet3.$requet4.$requet5.$requet6;
		}
	}
	else {
	
		$query = "SELECT * FROM PARKING";
	}
	
    
    	$result = mysqli_query($con,$query);
    	$parkings=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

  <table class="table">
        <thead>
          <tr style="text-align:left">
              <th >NUM_PARKING</th>
              <th>NOM_PARKING</th>
              <th>ADRESSE</th>
              <th>CAPACITY</th>
              <th>CODE_POSTALE</th>
              <th>TARIF_HORAIRE</th>
              <th>Modifier Parking</th>
			  <th>Supprimer Parking</th>
          </tr>
        </thead>


        <tbody>
        <?php
            foreach($parkings as $parking){ ?>
              <tr>
            <td><a href="<?php echo '../../stats/InfoParking.php?id='.$parking['NUM_PARKING']?> "><?php echo $parking["NUM_PARKING"]?></a></td>
            <td><?php echo $parking["NOM_PARKING"]?></td>
            <td><?php echo $parking["ADRESSE"]?></td>
            <td><?php echo $parking["CAPACITY"]?></td>
            <td><?php echo $parking["CODE_POSTALE"]?></td>
            <td><?php echo $parking["TARIF_HORAIRE"]?></td>
			<td>
				<form method="post" action="<?php echo 'add_parking.php?id='.$parking['NUM_PARKING']?> ">
				<button class="btn btn-warning" type="submit" name="MODIFY_PARKING" class="MODIFY_PARKING" value="<?php echo $parking['NUM_PARKING'];?>"> 
					<i class="bi bi-pencil-fill"></i>
				</button>
			</form>
			</td>
			<td>
				<form method="post" action="<?php echo 'gestionParking.php?id='.$parking['NUM_PARKING']?> " >
				<button  class="btn btn-danger" type="submit" name="DELETE_PARKING" class="DELETE_PARKING" value="<?php echo $parking['NUM_PARKING'];?>"> 
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
