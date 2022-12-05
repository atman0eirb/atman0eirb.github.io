<head>
    <title> PARKING APP </title>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> 
    <style type="text/css">  
        .nav-extended{
            background-color: #304ffe  ;
        }
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

	 .side-barre {
	    width: 30%;
	    padding-left: 15px;
	    margin-left: 15px;
	    float: left;
	    font-style: italic;
	    background-color: white;
	}
	.affaichage{
	
	    width: 100%;
    	    padding-left: 15px;
    	    margin-left: 15px;
    	    float: right;
    	    font-style: italic;
    	    background-color: white;
		
	}
    </style>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  </head>

<body class="grey lighten-4" >


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/free-SGBD22/php/accueil.php">Parking App</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link" href="/free-SGBD22/php/entites/vehicule.php">Vehicules </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/free-SGBD22/php/entites/parkings.php">Parkings</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/free-SGBD22/php/entites/commune.php">Communes</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/free-SGBD22/php/entites/stats.php">Statisqtiques</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="https://localhost/free-SGBD22/login.php">
      <button class="btn btn-danger" type="submit">Log out</button>
    </form>
  </div>
</nav>


<!--
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="/free-SGBD22/php/accueil.php" class="brand-logo">Parking App</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="#">Log out</a></li> 
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a  class="active"href="/free-SGBD22/php/entites/vehicule.php">Vehicules</a></li>
        <li class="tab"><a class="active" href="/free-SGBD22/php/entites/parkings.php">Parkings</a></li>
        <li class="tab"><a  class="active"href="/free-SGBD22/php/entites/commune.php">Communes</a></li>
        <li class="tab"><a  class="active"href="/free-SGBD22/php/entites/stats.php">Statisqtiques</a></li>
      </ul>
    </div>
  </nav>-->
