<?php

if (isset($_COOKIE['loginAutomatico'])) {
    header("Location: ./pag_principal.php");
} 
else if (isset($_COOKIE['loginYearbook'])) {
    $nomeUser = $_COOKIE['loginYearbook'];
} 
else {
    $nomeUser = "";
}
?> 