<?php 
    session_start();
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    }
    require("../connexion.php");

    if (isset($_POST["NUM_PARKING"]) || isset($_POST["NOM_PARKING"])
    || isset($_POST["ADRESSE"]) || isset($_POST["CAPACITY"])
    || isset($_POST["CODE_POSTALE"] ) || isset($_POST["TARIF_HORAIRE"] ) ){
        
        if($id=="add_parking"){
                                    
            $park_exist="SELECT * FROM PARKING WHERE NOM_PARKING=\"$_POST[NOM_PARKING]\" and ADRESSE=\"$_POST[ADRESSE]\" and
            CAPACITY=$_POST[CAPACITY] and CODE_POSTALE=$_POST[CODE_POSTALE] and TARIF_HORAIRE=$_POST[TARIF_HORAIRE]";
            
            $result = mysqli_query($con,$park_exist);
            $rows = mysqli_num_rows($result);
            if($rows!=0){
                header("Location: add_parking.php?err=exist");
            }
            else {
            
                $last_num_parking="SELECT MAX(NUM_PARKING) as MAX FROM PARKING";
                $result = mysqli_query($con,$last_num_parking);
                $last_num_parking= mysqli_fetch_assoc($result); 
                $NUM_PARK=$last_num_parking["MAX"]+1;
                $query_add="INSERT INTO PARKING (NOM_PARKING,ADRESSE,CAPACITY,CODE_POSTALE,TARIF_HORAIRE)
                VALUES (\"$_POST[NOM_PARKING]\",\"$_POST[ADRESSE]\",$_POST[CAPACITY],$_POST[CODE_POSTALE],$_POST[TARIF_HORAIRE])";
                $add = mysqli_query($con,$query_add);
                if(!$result){
                    header("Location: add_parking.php?err=prob");
                }
                $query_add_place="INSERT INTO PLACE (NUM_PLACE,NUM_PARKING) VALUES (1,$NUM_PARK)";
                $k=intval($_POST["CAPACITY"]);
                echo $k;
                for($i=2;$i<=$k;$i++){
                    echo $i;
                    $query_add_place=$query_add_place." ,($i,$NUM_PARK) ";
                    //$query_add_place=$query_add_place." ($_POST[CAPACITY],$NUM_PARK);";
                    
                }
                $add_place = mysqli_query($con,$query_add_place);
                echo "haha";
                header("Location: parkings.php?add=succ");

            }
        }
        else{	
            if(isset($_POST["MODIFY_PARKING"])){
                echo "hah";
                $last_Capacity="SELECT CAPACITY as cp FROM PARKING WHERE NUM_PARKING=$id";
                $result = mysqli_query($con,$last_Capacity);
                $last_Cap= mysqli_fetch_assoc($result); 
                $capacity=intval($last_Cap["cp"]);
                
                
                $query_modify = "UPDATE PARKING
                SET NOM_PARKING=\"$_POST[NOM_PARKING]\",
                CAPACITY=$_POST[CAPACITY],
                TARIF_HORAIRE=$_POST[TARIF_HORAIRE]
                WHERE NUM_PARKING='$id'";
                $modify = mysqli_query($con,$query_modify);

                
                if(!$modify){
                    header("Location: modify_parking.php?err=prob");
                    
                }else{
                    $new_capacity=intval($_POST["CAPACITY"]);
                    if($new_capacity>$capacity){

                        $query_add_place="INSERT INTO PLACE (NUM_PLACE,NUM_PARKING) VALUES (".intval($capacity+1).",$id)";
                        for($i=$capacity+2;$i<=$new_capacity;$i++){
                            $query_add_place=$query_add_place." ,($i,$id) ";
                            //$query_add_place=$query_add_place." ($_POST[CAPACITY],$NUM_PARK);";
                        }
                        $add_place = mysqli_query($con,$query_add_place);
                    }else if($new_capacity<$capacity){
                        $query_del_place ="DELETE FROM PLACE WHERE NUM_PARKING='$id' and NUM_PLACE>$new_capacity";
                        $delete_place=mysqli_query($con,$query_del_place);
                    }
                    header("Location: parkings.php?mod=succ");
                }
            }
            
        }
    
    
    
    }
    else if(isset($_POST["DELETE_PARKING"])){                
        $del_stat ="DELETE FROM STATIONNEMENT WHERE STATIONNEMENT.ID_PLACE in ( SELECT ID_PLACE FROM PLACE WHERE NUM_PARKING='$id')";
        $del_place ="DELETE FROM PLACE WHERE NUM_PARKING='$id'";
        $del_park = "DELETE FROM PARKING WHERE NUM_PARKING=$id";
        
        $delete_stat = mysqli_query($con,$del_stat);
        if(!$delete_stat)
            echo mysqli_error($con);
        $delete_place = mysqli_query($con,$del_place);
        if(!$delete_place)
            echo mysqli_error($con);
        $delete_park = mysqli_query($con,$del_park);
        if(!$delete_park)
            echo mysqli_error($con);
        else{
            header("Location: parkings.php?del=succ");
        }       
    }




?>