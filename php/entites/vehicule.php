<?php 
	session_start();
  if(!isset($_SESSION["username"])){
    header("Location: ../../login.php");
  }
?>
<!DOCTYPE html>
<html>
<?php include('../../template/header.php'); ?>


<style>

form ul { list-style-type: none; }

form ul li { display: inline-block }

::placeholder {
  color: blue;
}



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
<div class="entete">
      <h5 class="description" > <b> Nombre De Vehicule :</b>
            
          <?php 
		  	require("../connexion.php");
            $query = "SELECT count(*) as nb FROM VEHICULE;";
            $result = mysqli_query($con,$query);
            $place_dispo= mysqli_fetch_assoc($result); 
            echo $place_dispo["nb"]; 
          ?>
      </h5>
    </div>
    <br/><br/>

<div id="filtre">
    <form class="table" action="<?php echo 'vehicule.php?id=filtre'?>" method="post">
        <ul>
        <li><input class="form-control"  type="text" name="NUM_IMMATRICULE" placeholder="NUM_IMMATRICULE"></li>
        <li> <input  class="form-control" type="text" name="MARQUE" placeholder="MARQUE"></li>
        <li> <input class="form-control" type="text" name="DATE_MIS_CIRCULATION" placeholder="DATE_MIS_CIRCULATION"></li>
        <li> <input class="form-control" type="text" name="KILOMETRAGE" placeholder="KILOMETRAGE"></li>
        <li> <input class="form-control" type="text" name="ETAT" placeholder="ETAT"></li>
        <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
        <input type="reset" class="btn btn-warning" value="RESET">

        </ul>
    </form>
</div>

<?php
	require("../connexion.php");
	
	
	if (isset($_POST["NUM_IMMATRICULE"]) || isset($_POST["MARQUE"])
                || isset($_POST["DATE_MIS_CIRCULATION"]) || isset($_POST["KILOMETRAGE"])
                || isset($_POST["ETAT"] )){
                
                
                $requet1="SELECT * FROM VEHICULE INTERSECT ";
                $requet2="SELECT * FROM VEHICULE INTERSECT ";
                $requet3="SELECT * FROM VEHICULE INTERSECT ";
                $requet4="SELECT * FROM VEHICULE INTERSECT ";
                $requet5="SELECT * FROM VEHICULE";
                
                if(!empty($_POST["NUM_IMMATRICULE"])){
                                $requet1="SELECT * FROM VEHICULE WHERE NUM_IMMATRICULE ='$_POST[NUM_IMMATRICULE]' INTERSECT ";
                                }
                if(!empty($_POST["MARQUE"])){
                                $requet2="SELECT * FROM VEHICULE WHERE MARQUE like '".$_POST["MARQUE"]."%'  INTERSECT ";
                                }
                if(!empty($_POST["DATE_MIS_CIRCULATION"])){
                                $requet3="SELECT * FROM VEHICULE WHERE DATE_MIS_CIRCULATION=\"$_POST[DATE_MIS_CIRCULATION]\" INTERSECT ";
                                }
                if(!empty($_POST["KILOMETRAGE"])){
                                $requet4="SELECT * FROM VEHICULE WHERE KILOMETRAGE=$_POST[KILOMETRAGE] INTERSECT ";
                                }
                if(!empty($_POST["ETAT"])){
                                $requet5="SELECT * FROM VEHICULE WHERE ETAT=\"$_POST[ETAT]\"";
                                }
                                
                
                
                $query = $requet1.$requet2.$requet3.$requet4.$requet5;
                
                    
                        
          }
          else {
                  $query = "SELECT * FROM VEHICULE";
          }

	  
    $result = mysqli_query($con,$query) ;
    $vehicules=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

  <table class="table">
        <thead>
          <tr>
              <th>NUM_IMMATRICULE</th>
              <th>MARQUE</th>
              <th>DATE_MIS_CIRCULATION</th>
              <th>KILOMETRAGE</th>
              <th>ETAT</th>
          </tr>
        </thead>

        <tbody>
          <?php
            foreach($vehicules as $vehicule){ ?>
              <tr>
	    <td><a href="<?php echo '../../stats/InfoVehicule.php?id='.$vehicule['NUM_IMMATRICULE']?> "><?php echo $vehicule["NUM_IMMATRICULE"]?></a></td>
            <td><?php echo $vehicule["MARQUE"]?></td>
            <td><?php echo $vehicule["DATE_MIS_CIRCULATION"]?></td>
            <td><?php echo $vehicule["KILOMETRAGE"]?></td>
            <td><?php echo $vehicule["ETAT"]?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
            
<?php include('../../template/footer.php'); ?>

</html>
