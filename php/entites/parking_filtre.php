<style>

input[type=text], input[type=password] {
width: 100%;
padding: 10px 8px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
}


form ul { list-style-type: none; }

form ul li { display: inline-block }

h1{
  text-align: center;
  font-family: 'Allerta Stencil';font-size: 20px;

}

.container {
padding: 10px 0;
text-align:left;
}

</style>




<form><ul>

<li><input type=”text” id=”name” value=”name”></li>

<li><input type=text” value”email” id=”emailaddress”></li>

<li><input type=”button” value”subscribe” id”subscribe-button”></li>

<li><input type="submit"></li>

</ul>

</form>


<form action="./parkings.php" method="post">
  <ul>
  <li><h1> NUM_PARKING </h1><input type="text" name="NUM_PARKING"></li>
  <li><h1> NOM_PARKING </h1> <input type="text" name="NOM_PARKING"></li>
  <li><h1> ADRESSE </h1> <input type="text" name="ADRESSE"></li>
  <li><h1> CAPACITY </h1> <input type="text" name="CAPACITY"></li>
  <li><h1> CODE_POSTALE </h1> <input type="text" name="CODE_POSTALE"></li>
  <li><h1> TARIF_HORAIRE </h1> <input type="text" name="TARIF_HORAIRE"></li>
  <input type="submit">
  <ul>
</form>
