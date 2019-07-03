<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
<?php
$db = new PDO('mysql:host=localhost;dbname=colyseum','Fireloup','Girouette301286');
$showsQuery = $db->query('SELECT shows.title,shows.performer,shows.date,shows.startTime FROM shows ORDER BY shows.title');
$showsFetch = $showsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach($showsFetch as $key=>$value):
    foreach($value as $secondKey=>$secondValue):
    ?><p><?=$secondKey . ' : ' . $secondValue;?></p><?php
    endforeach;
    ?><hr/><?php
endforeach;

?>
    </body>
</html>
