<!DOCTYPE html>
<html lang="fr">
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
<?php
$db = new PDO('mysql:host=localhost;dbname=colyseum','Fireloup','Girouette301286');
$showTypesQuery = $db->query('SELECT showTypes.type FROM showTypes');
$showTypesFetch = $showTypesQuery->fetchAll(PDO::FETCH_ASSOC);

foreach($showTypesFetch as $key=>$value):
    foreach($value as $secondKey=>$secondValue):
    ?><p><?=$secondKey . ' : ' . $secondValue;?></p><?php
    endforeach;
endforeach;

?>
    </body>
</html>