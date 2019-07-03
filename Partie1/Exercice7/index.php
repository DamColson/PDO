<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
<?php
$db = new PDO('mysql:host=localhost;dbname=colyseum','Fireloup','Girouette301286');
$clientsQuery = $db->query('SELECT clients.lastName,clients.firstName,clients.birthDate,clients.card,clients.cardNumber FROM clients ORDER BY clients.lastName');
$clientsFetch = $clientsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach($clientsFetch as $key=>$value):
    ?><p><?= 'Nom : ' . $value['lastName'];?></p>
    <p><?= 'Prénom : ' . $value['firstName'];?></p>
    <p><?= 'Date de Naissance : ' . $value['birthDate'];?></p>
    <?php
    if($value['card'] == 0):
        ?><p>Carte de fidélité : Non</p><?php
    elseif($value['card'] == 1):
        ?><p>Carte de fidélité : Oui</p>
        <p><?= 'Numéro de carte : ' . $value['cardNumber'];?></p><?php
    endif;
    ?><hr/><?php
endforeach;

?>
    </body>
</html>
