<?php
if (isset($_GET['search']) AND $_GET['search'] == 'Rechercher')
{
 $_GET['searchBar'] = htmlspecialchars($_GET['searchBar']); //pour sécuriser le formulaire contre les failles html
 $searchBar = $_GET['searchBar'];
 $searchBar = trim($searchBar); 
 $searchBar = strip_tags($searchBar);
}
?>