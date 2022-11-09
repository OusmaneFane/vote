<?php
try {
  $bdd = new PDO('mysql:host=localhost;bdname=connection_users;charset=utf8', 'root', '');
} catch (Exception $e ){
  die('Erreur : '.$e->getMessage());
}
if(isset($_POST['matricule']) AND isset($_POST['password']))

{
  $matricule=$_POST['matricule'];
  $password= $_POST['password'];
  /*
  $requette=$bdd->prepare("SELECT * FROM users WHERE matricule=? AND password=?");
  $requette->execute(array($mat,$pass));
  $userexist= $requette->rowcount();
  if
}*/
//01
$query = $bdd->query("SELECT matricule FROM users WHERE matricule = $matricule");
if(mysql_num_rows($query) > 0){
   // Pseudo déjà utilisé
   echo 'Ce matricule est déjà utilisé';
   die();
   }else{
   // Pseudo libre
   $bdd->query("INSERT INTO users (matricule) VALUES ($matricule)");
}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Connection</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ url('designs/defaut.css') }}">
</head>
<body>
		<header>
      <img src="/public/picturesform/SUP.png">
			<h1>VOTE EN LIGNE </h1>
		</header>

   <section id="hello">

		<div class="container">

			<h2>Bienvenu sur le site de vote en ligne de SUP'MANAGEMENT !!! <br>Le momment tant attendu est afin arrivé, celui de choisir un Président au poste de<br> LEADER MANAGER 2021-2022</h2>
	</section>
			<?php
		if (isset($_GET['error'])){
	if(isset($_GET['pass'])){
		echo'<p id="error"> Le mot de passe est incorrect.</p>';
	}
  else if(isset($_GET['matricule'])){
    echo '<p id="error">Ce matricule a été déjà utilisé</p>';
  }
}
?>
			<div id="form">
			<form method="post" action="form.php">
				<table>
					<tr>

						<td><h4>Matricule</h4></td> <br>
						<td><input type="text" name="matricule" required=""></td>
					</tr>

					<tr>
						<td><h4>Mot de passe<h4></td>
						<td><input type="password" name="password" required=""></td>
					</tr>

				</table>
        <br>



			<div id="button">
				<button>Connexion</button>
			</div>

			</form>
		</div>
		</div>
    <br>
    <section>
    <h3>
      Contacts<br>
      Quartier HIPPODROME RUE 214-PORTE 297 Bamako Mali <br>+22378012020<br>info@supmanagement.ml
      <br>
    </h3>


    <h3>
      <i>LIEN UTILES</i><br>
      <nav>
        <a href="https://kairos.supmanagement.ml/kairos/login/auth?_ga=2.107393413.62101792.1639827278-1950264543.1633955410&_gl=1*npme0f*_ga*MTk1MDI2NDU0My4xNjMzOTU1NDEw*_ga_W3MPKN6X7H*MTYzOTgyNzI3Ny4xMS4wLjE2Mzk4MjcyNzcuMA..">Kairos</a><br>
        <a href="https://e-sup.ml/login/index.php">E-learning</a><br>
        <a href="https://international.scholarvox.com/">Scholarvox</a><br>
        <a hr-ef="">Demandes</a><br>
        <a href="">Calendrier</a><br>


      </nav>

    </h3>
  </section>


  </header>

  <script src="jquery.js" defer></script>
  <script src="pops.js" defer></script>

</body>
<footer>
  <span>Copyright &copy; Sup'Management 2021, all Rights are reserved</span>



</body>
</html>

