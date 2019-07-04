<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
        
        <?php
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');
        $appointmentsQuery = $db->query('SELECT appointments.id,appointments.dateHour FROM appointments');
        $appointmentsFetch = $appointmentsQuery->fetchAll(PDO::FETCH_ASSOC);
        var_dump($appointmentsFetch);
        foreach ($appointmentsFetch as $key => $value):
            ?><p><a href="../Exercice7-8/rendezvous.php?id=<?=$value['id']?>"><?= 'Rendez vous ' . $value['id'] . ' : ' . $value['dateHour']; ?></a><a href="<?='deletion.php?id=' . $value['id']?>">X</a></p><?php
            ?><hr/><?php
           
        endforeach;
        
        ?>
       
        <?php ?>
        <p><a href="../Exercice5/ajout-rendezvous.php"</a>Ajouter un rendez vous</p> 
        <p><a href="../index.php"</a>Retour à l'index</p>
        
    </body>
</html>