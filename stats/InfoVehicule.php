<!-- SELECT P.NUM_PARKING, COUNT(S.ID_PLACE)/ (SELECT count(ID_PLACE) from PLACE WHERE P.NUM_PARKING=NUM_PARKING GROUP BY NUM_PARKING) from STATIONNEMENT S,PLACE P WHERE P.ID_PLACE=S.ID_PLACE GROUP BY NUM_PARKING; -->
<?php 
	session_start();
     if(isset($_GET["id"])){
        if(isset($_POST["NUM_PARKING"])){
            $num_parking=$_POST["NUM_PARKING"];
        }
        if(isset($_POST["month"])){
            $month=$_POST["month"];
            $first_day=$month.'-01';
            $last_day=$month.'-30';
            
        }
        $id=$_GET["id"];
?>
    
<!DOCTYPE html >
<html lang= "en">
<?php
    require("../php/connexion.php");
    $query = "SELECT * FROM VEHICULE where NUM_IMMATRICULE='$id'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1){
        header("Location : ../php/entites/vehicule.php");
    }
    $vehicule = mysqli_fetch_assoc($result);
?>
    <head >
        <meta charset = " UTF - 8 ">
        <link rel="stylesheet" href="style.css">
    </head >
    
<body>
    <?php include("../template/header.php") ?>
   
        <div class="background">
            <div class="float-child white">
                <img style="max-width:70%;" src="car.jpeg"/>
            </div>
  
            <div class="float-child white" class="input-group mb-3">
                <div >
                </br>
                    <h5 class="description" > <b>Numéro immatriculation : </b><?php echo $vehicule["NUM_IMMATRICULE"]; ?></h5>
                    <h5 class="description" > <b>Marque : </b><?php echo $vehicule["MARQUE"]; ?></h5>
                    <h5 class="description" > <b>Date mis en circulation:</b> <?php echo $vehicule["DATE_MIS_CIRCULATION"]; ?></h5>
                    <h5 class="description" > <b>Kilométrage : </b><?php echo $vehicule["KILOMETRAGE"]; ?></h5>
                    <h5 class="description" > <b>Etat : </b><?php echo $vehicule["ETAT"]; ?></h5>
                    <h5 class="description" > <b>Dernier Parking dont la véhicule a stationné :</b>
                        <?php 
                           /* $query = "SELECT NOM_PARKING  FROM STATIONNEMENT S,PLACE P,PARKING PA where P.ID_PLACE=S.ID_PLACE and PA.NUM_PARKING=P.NUM_PARKING 
                            and NUM_IMMATRICULE = $id and ID_DATE in ( select max(ID_DATE) from STATIONNEMENT where NUM_IMMATRICULE=$id);";
                            $result = mysqli_query($con,$query);
                            $rows = mysqli_num_rows($result);
                            if($rows==0){
                                echo "Jamais stationné";
                            }
                            else{
                                $last_park= mysqli_fetch_assoc($result); 
                                echo $last_park["NOM_PARKING"]; 
                            }


                            */
                        ?>
                    </h5>
                    
                    <h5 class="description" ><form  action="<?php echo '/free-SGBD22/stats/InfoVehicule.php?id='.$id ?> " method="post" class="form-example">
                                            
                                <b>durée moyenne de stationnement dans le parking:</b>                                
                                <select class="form-select"  name="NUM_PARKING" id="inputGroupSelect04" aria-label="Example select with button addon" >
                                    <?php
                                       
                                        $query = "SELECT NUM_PARKING FROM PARKING PA
                                                 INNER JOIN PLACE P USING (NUM_PARKING)
                                                 INNER JOIN STATIONNEMENT S USING (ID_PLACE)
                                                 WHERE S.NUM_IMMATRICULE =$id
                                                 GROUP BY NUM_PARKING";
                                        $result = mysqli_query($con,$query) ;
                                        $parkings=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                       
                                        foreach($parkings as $parking){ ?>
                                            <option value="<?php echo $parking["NUM_PARKING"];?>"> <?php echo $parking["NUM_PARKING"];?></option>
                                    <?php }?>

                                </select>
                                <button  class="btn btn-primary" type="submit" class="btn btn-outline-secondary">send</button>
                                        
                                </form> </h5>
                   
                                <?php 
                           
                                $query = "SELECT P.NUM_PARKING,S.NUM_IMMATRICULE , avg(TIMESTAMPDIFF(MINUTE,S.HEURE_ENTREE,S.HEURE_SORTIE) ) as avg_minutes
                                from STATIONNEMENT S, PLACE P 
                                where S.ID_PLACE=P.ID_PLACE
                                and S.NUM_IMMATRICULE='$id'
                                and P.NUM_PARKING='$num_parking'
                                GROUP BY S.NUM_IMMATRICULE;";
                                $result = mysqli_query($con,$query);
                                $a=mysqli_fetch_assoc($result); 
                                echo $a["avg_minutes"];

                            
                        ?>
                    <h5>
                        
                        <form action="<?php echo '/free-SGBD22/stats/InfoVehicule.php?id='.$id ?> " method="post" class="form-example">
                        <div class="input-group mb-3">
                        <b>cout moyen du stationnement durant le mois:</b>
                                                <input type="month" class="form-control" placeholder="2022-11"  name="month"  required>
                                            
                                                <button class="btn btn-primary" type="submit"  >send</button>
                                            
                                                </form>
                        </div>
                        <?php
                        $query = "SELECT  AVG(TIMESTAMPDIFF(SECOND, S.HEURE_ENTREE,S.HEURE_SORTIE)/3600*tarif_horaire) AS avg
                                    from STATIONNEMENT S, PLACE P , PARKING PAR
                                    where S.NUM_IMMATRICULE=$id 
                                        and S.ID_PLACE = P.ID_PLACE
                                        and PAR.NUM_PARKING = P.NUM_PARKING
                                        AND date(S.HEURE_SORTIE)<='$last_day' 
                                        and date(S.HEURE_ENTREE)>='$first_day';";
                                $result = mysqli_query($con,$query);
                                $a=mysqli_fetch_assoc($result); 
                                echo $a["avg"];

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
        </div> 


    <?php include("../template/footer.php") ?>

    <?php
    }
    ?>



    




</body>
</html>
