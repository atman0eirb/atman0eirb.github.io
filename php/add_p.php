<?php

    // faire qcq chose avec les donnes 
?>


<!DOCTYPE html>
<html>

<head>
    <title> PARKING APP </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> 
    <style type="text/css">
        .brand{
            background: #0000FF !important;
        }
        .brand-text{
            background: #9900FF !important;
        }
        form{
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
<section class="container grey-text">
    <h4 class="center">ADD A PARKING </h4>
    <form class="white" action="add_p.php" method="POST">
        
        <label> Nom_Parking: </label>
        <input type="text" name="name"/>

    </br>
    </br>

        <label> Adresse: </label>
        <input type="text" name="address">

        </br>
        </br>

        <label> Capacité: </label>
        <input type="int" name="capacity">

        </br>
        </br>

        <label> Tarif_Horaire: </label>
        <input type="int" name="cost">
        <!-- -->
        </br>
        </br>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

    </form>

</section>

<?php include('template/footer.php'); ?>

</html>