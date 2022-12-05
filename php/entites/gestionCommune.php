<?php 
    session_start();
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    }
    require("../connexion.php");

    if (isset($_POST["CODE_POSTALE"]) || isset($_POST["NOM_COMMUNE"]) ){
        
        if(isset($_POST["add_commune"])){
                                    
            $park_exist="SELECT * FROM COMMUNE WHERE CODE_POSTALE=\"$_POST[CODE_POSTALE]\" and NOM_COMMUNE=\"$_POST[NOM_COMMUNE]\" ";
            
            $result = mysqli_query($con,$park_exist);
            $rows = mysqli_num_rows($result);
            if($rows!=0){
                header("Location: AddCommune.php?err=exist");
            }
            else {

                $query_add="INSERT INTO COMMUNE 
                VALUES (\"$_POST[CODE_POSTALE]\",\"$_POST[NOM_COMMUNE]\")";
                $add = mysqli_query($con,$query_add);
                if(!$result){
                    header("Location: AddCommune.php?err=prob");
                }
                header("Location: commune.php?add=succ");

            }
        }
        else{	
            
            if(isset($_POST["MODIFY_COMMUNE"])){

                $query_modify = "UPDATE COMMUNE
                SET NOM_COMMUNE='".$_POST["NOM_COMMUNE"]."'
                WHERE CODE_POSTALE=".$_GET["id"].";";
                echo $query_modify;
                $modify = mysqli_query($con,$query_modify);
                

                if(!$modify){
                    header("Location: AddCommune.php?err=prob");
                }else{
                    header("Location: commune.php?mod=succ");
                }
            }
            
        }
    
    
    
    }
    else if(isset($_POST["DELETE_PARKING"])){    

        $del_Comm ="DELETE FROM COMMUNE WHERE CODE_POSTALE='".$_GET["id"]."'";
        
        $delete_Commune = mysqli_query($con,$del_Comm);
        if(!$delete_Commune)
            echo mysqli_error($con);
        else{
            header("Location: commune.php?del=succ");
        }       
    }




?>