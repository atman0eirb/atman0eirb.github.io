<!-- SELECT P.NUM_commune, COUNT(S.ID_PLACE)/ (SELECT count(ID_PLACE) from PLACE WHERE P.NUM_commune=NUM_commune GROUP BY NUM_commune) from STATIONNEMENT S,PLACE P WHERE P.ID_PLACE=S.ID_PLACE GROUP BY NUM_commune; -->
<?php 
	session_start();
     if(isset($_GET["id"])){
        $id=$_GET["id"];
?>
<!DOCTYPE html >
<html lang= "en">
<?php
    require("../php/connexion.php");
    $query = "SELECT * FROM COMMUNE where CODE_POSTALE='$id'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1){
        header("Location : ../php/entites/commune.php");
    }
    //$commune = $result->fetch_assoc();
    $commune = mysqli_fetch_assoc($result);
?>
    <head >
        <meta charset = " UTF - 8 ">
        <link rel="stylesheet" href="style.css">
        <style>
            			 div.gauche {float : left; width : 50%;}
			 div.droite {float : right; width : 50%;}
			 fieldset {margin:1px;padding: 0 0 1em 0; background:none;text-align:center;display:block;}
             </style>
    </head >
    
<body>
    <?php include("../template/header.php") ?>
   
        <div class="background">
            <div class="gauche white">
                <img style="max-width:90%;" src="IMG_PARK.jpg"/>
            </div>
  
            <div class="droite white">
                <div >
                </br>
                    <h5 class="description"><b> CODE POSTALE : </b> <?php echo $commune["CODE_POSTALE"]; ?></h5>
                    <h5 class="description" > <b>NOM DE LA COMMUNE : </b><?php echo $commune["NOM_COMMUNE"]; ?></h5>
                    
                      <h5 class="description" > <b> NOMBRE DES PARKINGS :</b>
                    
                       <?php 
                            $query = "SELECT count(*) as nb FROM PARKING where CODE_POSTALE=$commune[CODE_POSTALE];";
                            $result = mysqli_query($con,$query);
                            $place_dispo= mysqli_fetch_assoc($result); 
                            echo $place_dispo["nb"]; 
                        ?>
                       
                    </h5>
       
                    <h5 class="description" > <b> GRAND PARKING DE LA  COMMUNE :</b>
                    
                    	 <?php 
                    	 
                    	    $query = "SELECT max(PARKING.CAPACITY) as nb FROM PARKING where CODE_POSTALE=$commune[CODE_POSTALE]  ;";
                            $result = mysqli_query($con,$query);
                            $max= mysqli_fetch_assoc($result); 
                    	 
                            $query = "SELECT PARKING.NOM_PARKING as nb FROM PARKING where CODE_POSTALE=$commune[CODE_POSTALE] 
                            and CAPACITY >= $max[nb];";
                            $result = mysqli_query($con,$query);
                            $place_dispo= mysqli_fetch_assoc($result); 
                            echo $place_dispo["nb"]." -- $max[nb] places"; 
                        ?>
                       
                    </h5>


                </div>
            </div>
            
            <!--
            <img src="jeans3.jpg" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans..</p>
            <p><button>Add to Cart</button></p>-->
        <?php
            $req="SELECT *
            FROM PARKING INNER JOIN COMMUNE USING (CODE_POSTALE)
            
            WHERE COMMUNE.CODE_POSTALE = $id;";
            $result= mysqli_query($con,$req);
            $parkings= mysqli_fetch_all($result); 
        ?>
                <h5 align="center" >Liste des parkings dans cette commune</h5>

        <table class="table">
        <thead>
          <tr>
              <th>NUM_PARKING</th>
              <th>NOM_PARKING</th>
              <th>ADRESSE</th>
              <th>CAPACITY</th>
              <th>CODE_POSTALE</th>
              <th>TARIF_HORAIRE</th>
              
          </tr>
        </thead>

        <tbody>
          <?php
            foreach($parkings as $parking){ ?>
              <tr>
            <td><?php echo $parking[1]?></td>
            <td><?php echo $parking[2]?></td>
            <td><?php echo $parking[3]?></td>
            <td><?php echo $parking[4]?></td>
            <td><?php echo $parking[0]?></td>
            <td><?php echo $parking[5]?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
        <?php include("../template/footer.php") ?>

        
        <?php
            }
        ?>
                </div> 

                </div> 







</body>
</html>
