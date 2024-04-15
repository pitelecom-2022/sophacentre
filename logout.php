<style>

@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans:wght@300&display=swap");
@import url("https://www.w3schools.com/w3css/4/w3.css");

body { display: flex; fontdisplay;
family: "Open Sans"; 
}

body >  * {
margin: auto;
}


</style>

<?php

session_start();
session_unset();
session_destroy();

echo "<div class=\"w3-container\">";
echo "<p>Votre session a été terminée.</p>";
echo "</div>";

header("Refresh:1;  url=index.php");

?>
