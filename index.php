
<?php
	session_start();
	include("./functions.php");
?>

<style>

@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans:wght@500&display=swap");
@import url("https://www.w3schools.com/w3css/4/w3.css");
@import url("https://www.w3schools.com/lib/w3-theme-blue.css");

body {
  margin: 0;
  font-family: "Open sans";
}

.footer {
	position: fixed;
	bottom:5px;
	left: 50%;
	transform: translateX(-50%);
}

.grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  height: 100vh;
}

.fields>p:nth-child(2n+1) {
  align-self: center;
}

.fields {
  display: grid;
  grid-template-columns: 100px 1fr;
  grid-gap:10px;
}

.fields > p {
  margin:0;
}
.main {
  display: flex;
  height:65vh;
}

.main>*{
  margin: auto;
}

.span {
  grid-column:1/span 2;
/*   text-align:center */
}
.span>[type=submit] {
  text-align:center;
}
legend {
  padding:10px 20px;
}

.flex {
  display: flex;
  align-items: center;
  justify-content: center;
  /*   font-variant: small-caps; */
}

.flex > p.hero {
  font-size: xx-large;
  margin: auto;
}

.identification {
  font-size: medium;
}

.sidebar {
  background: steelblue;
  color: white;
}

</style>

<?php 

$username = $_GET["username"];
$password = $_GET["password"];
$login_error = $_GET["error_login"];

?>

  <div class="w3-container w3-light-grey w3-center w3-xxlarge">
    <p class="w3-text-theme">
      Call Center SophaCentre
    </p>
  </div>

  <div class="flex main">
    <form method="GET" action="">
      <fieldset>
        <legend><b>Veuillez vous identifier SVP</b></legend>
        <div class="fields">
          <p>Username</p>
          <p>
            <input type="text" name="username" class="w3-input w3-border w3-round">
          </p>
          <p>Password</p>
          <p>
            <input type="password" name="password" class="w3-input w3-border w3-round">
          </p>
          <p class="">
            <input class="w3-button w3-theme" type="submit" value="OK">
          </p>
          <p class="">
            <a href="" style="align-self:center">Mot de passe oublié?</a>
          </p>
        </div>
      </fieldset>
    </form>
  </div>

<?php
	$users = [
		"admin" => Array("pwd"=>"2bxsc58v","profile"=>"admin"),
#		"saad" => Array("pwd"=>"7g3wfknd","profile"=>"superviseur"), 
#               "saad" => Array("pwd"=>"D8WVhsJK","profile"=>"superviseur"),		
#		"saad" => Array("pwd"=>"p9SPUmZg","profile"=>"superviseur"),
		"saad" => Array("pwd"=>"Ri7LsPo7","profile"=>"superviseur"),
		"hicham" => Array("pwd"=>"6flphx10", "profile"=>"superviseur"),
		"101" => Array("pwd"=>"CLjHtKKfUAIa","profile"=>"agent"),
		"102" => Array("pwd"=>"tzedTNjuy9CU","profile"=>"agent"),
		"103" => Array("pwd"=>"qoyjm7YcNIOw","profile"=>"agent"),
		"104" => Array("pwd"=>"7NF2EgKm4nQ4","profile"=>"agent"),
		"105" => Array("pwd"=>"Kasw0tgObRvQ","profile"=>"agent")
	];


if ( (!empty($username)) && (!empty($password))) {
        if(array_key_exists($username, $users) ) {
		if ($password == $users[$username]["pwd"]) {
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $username;
			$_SESSION["profile"] = $users[$username]["profile"];
			header("Location:dashboard.php");
		}
		else {
			$msg = "Vérifier votre mot de passe et réessayer."; 
			print_error($msg);
		}
	}
	else {
		$msg = "Votre nom d'utilisateur n'existe pas. Veuillez contacer l'administrateur système.";
		print_error($msg);
	}
}

include "footer.php";

?>
