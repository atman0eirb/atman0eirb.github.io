<!-- SELECT P.NUM_PARKING, COUNT(S.ID_PLACE)/ (SELECT count(ID_PLACE) from PLACE WHERE P.NUM_PARKING=NUM_PARKING GROUP BY NUM_PARKING) from STATIONNEMENT S,PLACE P WHERE P.ID_PLACE=S.ID_PLACE GROUP BY NUM_PARKING; -->
<?php 
	session_start();
     if(isset($_GET["id"])){
        if(isset($_POST["month"])){
            $month=$_POST["month"];
        }
        $id=$_GET["id"];
?>
<!DOCTYPE html >
<html lang= "en">

<?php
    require("../php/connexion.php");
    $query = "SELECT * FROM PARKING where NUM_PARKING='$id'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1){
        header("Location : ../php/entites/parking.php");
    }
    //$parking = $result->fetch_assoc();
    $parking = mysqli_fetch_assoc($result);
?>
    <head >
        <meta charset = " UTF - 8 ">
        <link rel="stylesheet" href="style.css">
    </head >
    
<body>
    <style>
label, input {
    display: table-cell;
    margin-bottom: 10px;
}
        
    </style>
    <?php include("../template/header.php") ?>
   
        <div class="background">
            <div class="float-child white">
                <img style="max-width:90%;" src="IMG_PARK.jpg"/>
            </div>
  
            <div class="float-child white">
                <div >
                </br>
                    <h2 class="title"><?php echo $parking["NOM_PARKING"]; ?></h2>
                    <h5 class="description" > <b>Adresse : </b><?php echo $parking["ADRESSE"]; ?></h5>
                    <h5 class="description" > <b>Code Postale :</b> <?php echo $parking["CODE_POSTALE"]; ?></h5>
                    <h5 class="description" > <b>Capacity : </b><?php echo $parking["CAPACITY"]; ?></h5>
                    <h5 class="description" > <form action="<?php echo '/free-SGBD22/stats/InfoParking.php?id='.$id ?> " method="post" class="form-example">
                                            
                                                <b>Places disponibles le:</b>
                                                <input type="month" name="month"  placeholder="2022-11" required>
                                            
                                                <input type="submit" class="btn btn-primary" value="Send">
                                            
                                                </form>
                        <?php 
                        $place_dispo=0;
                        $dates=[];
                        for($i=1; $i<30;$i++){
                            if($i<10)
                            $dates[]=$month.'-0'.$i;
                            else
                            $dates[]=$month.'-'.$i;
                        }
                           foreach($dates as $date){
                                $query = "SELECT COUNT(*) as nb FROM(SELECT PLACE.ID_PLACE,PLACE.NUM_PLACE,PLACE.NUM_PARKING FROM PLACE 
                                where PLACE.NUM_PARKING=$id
                                GROUP BY PLACE.NUM_PLACE
                                EXCEPT 
                                SELECT PLACE.ID_PLACE,PLACE.NUM_PLACE,PLACE.NUM_PARKING FROM PLACE INNER JOIN STATIONNEMENT USING(ID_PLACE)
                                where PLACE.NUM_PARKING=$id
                                AND date(STATIONNEMENT.HEURE_SORTIE)>='$date'
                                and date(STATIONNEMENT.HEURE_ENTREE)<='$date'
                                GROUP BY PLACE.NUM_PLACE) AS R;";
                                $result = mysqli_query($con,$query);
                                $place_dispo=$place_dispo+mysqli_fetch_assoc($result)["nb"]; 
                               
                            }
                            echo $place_dispo/count($dates); 
                        ?>
                    </h5>


                </div>
            </div>
        </div> 
       
        <h5 align="center" >Liste des voitures ayant stationnés dans ce parking </h5>
        <?php
            $req="SELECT VEHICULE.NUM_IMMATRICULE,VEHICULE.MARQUE, S.HEURE_ENTREE, S.HEURE_SORTIE
                    FROM VEHICULE INNER JOIN STATIONNEMENT S USING (NUM_IMMATRICULE)
                    INNER JOIN PLACE USING (ID_PLACE)
                    INNER JOIN PARKING USING (NUM_PARKING)
                    WHERE PARKING.NUM_PARKING = $id";
            $result= mysqli_query($con,$req);
            $vehicules= mysqli_fetch_all($result);  
        ?>
        <table>
            
        <thead>
          <tr>
              <th>NUM_IMMATRICULE</th>
              <th>MARQUE</th>
              <th>HEURE_ENTREE</th>
              <th>HEURE_SORTIE</th>
            
          </tr>
        </thead>

        <tbody>
          <?php
            foreach($vehicules as $vehicule){ ?>
              <tr>
            <td><?php echo $vehicule[0]?></td>
            <td><?php echo $vehicule[1]?></td>
            <td><?php echo $vehicule[2]?></td>
            <td><?php echo $vehicule[3]?></td>
          
          </tr>
          <?php }?>
        </tbody>
      </table>
        <?php include("../template/footer.php") ?>

        
        <?php
            }
        ?>






</body>
</html>