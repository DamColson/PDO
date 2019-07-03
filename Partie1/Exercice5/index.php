<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
<?php
$db = new PDO('mysql:host=localhost;dbname=colyseum','Fireloup','Girouette301286');
$clientsQuery = $db->query('SELECT clients.lastName,clients.firstName FROM clients WHERE clients.lastName LIKE \'M%\' ORDER BY clients.lastName');
$clientsFetch = $clientsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach($clientsFetch as $key=>$value):
    foreach($value as $secondKey=>$secondValue):
    ?><p><?=$secondKey . ' : ' . $secondValue;?></p><?php
    endforeach;
endforeach;

?>
    </body>
</html>
