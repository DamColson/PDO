<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>

        <form method="GET" action="search.php">
            <input type = "search" name = "searchBar" />
            <input type = "submit" name = "search" value = "Rechercher">
            
        </form>
        <?php
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
        $patientsQuery = $db->query('SELECT patients.id,patients.lastname,patients.firstname FROM patients');
        $patientsFetch = $patientsQuery->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($patientsFetch as $key => $value):
                
            
            ?><p><a href="../Exercice3-4/profil-patient.php?id=<?=$value['id']?>"><?= 'Patient ' . $value['id'] . ' : ' . $value['lastname'] . ' ' . $value['firstname']; ?></a><a href="<?='deletionPatient.php?id=' . $value['id']?>">X</a></p><?php
            ?><hr/><?php
        endforeach;
        ?>
        <p><a href="../Exercice1/ajout-patient.php"</a>Ajouter un patient</p>
        <p><a href="../index.php"</a>Retour à l'index</p>
    </body>
</html>
