<?php


if ($_POST['lang']=='fr') {           // si la langue est 'fr' (français) on inclut le fichier fr-lang.php
include('fr-lang.php');
}

else if ($_POST['lang']=='en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php
 include('en-lang.php');
}

else {                       // si aucune langue n'est déclarée on inclut le fichier fr-lang.php par défaut
include('fr-lang.php');
}								

// if (isset($_COOKIE['lang'])) {

// 	if (isset($_POST['enregistrer_parametres'])) {

// 		$lang = $_POST['lang'];
// 	} else {
// 		// si aucune langue n'est déclarée on tente de reconnaitre la langue par défaut du navigateur
// 		//$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
// 		$lang = $_POST['lang'];
// 	}
// }
// //script d'origine
// if ($lang == 'fr') {           // si la langue est 'fr' (français) on inclut le fichier fr-lang.php
// 	include('fr-lang.php');
// } elseif ($lang == 'en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php
// 	include('en-lang.php');
// }
// //fin du script d'origine

// //définition de la durée du cookie (1 an)
// $expire = 365 * 24 * 3600;

// //enregistrement du cookie au nom de lang
// setcookie('lang', $lang, time() + $expire);
