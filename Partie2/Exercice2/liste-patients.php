<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>

        <form method="POST" action="patientsSearch.php">
            <input type = "search" name = "searchBar" />
            <button type = "submit" >Rechercher</button>     
        </form>

        <?php
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');

        $patientsPerPage = 5;

        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $start = ($page - 1) * $patientsPerPage;

        $query = 'SELECT patients.id,patients.lastname,patients.firstname FROM patients LIMIT :patientsPerPage OFFSET :start';
        $patientsPrepare = $db->prepare($query);
        $patientsPrepare->bindValue('patientsPerPage', $patientsPerPage, PDO::PARAM_INT);
        $patientsPrepare->bindValue('start', $start, PDO::PARAM_INT);
        $patientsPrepare->execute();
        $patientsFetch = $patientsPrepare->fetchAll(PDO::FETCH_ASSOC);
        
        $patientsCount = $db->query('SELECT COUNT(patients.id) AS patientsNumber FROM patients');
        $patientsTotalArray = $patientsCount->fetchAll(PDO::FETCH_ASSOC);
        $patientsTotalNumber = (int)$patientsTotalArray[0]['patientsNumber'];
        
        $pageQuantity = ceil($patientsTotalNumber / $patientsPerPage);

        
        foreach ($patientsFetch as $key => $value):
            ?><p><a href="../Exercice3-4/profil-patient.php?id=<?= $value['id'] ?>"><?= 'Patient n°' . $value['id'] . ' : ' . $value['lastname'] . ' ' . $value['firstname']; ?></a><a href="<?= 'deletionPatient.php?id=' . $value['id'] ?>">X</a></p>
            <hr/><?php
        endforeach;
       

        if ($page > 1):
            ?><a href="liste-patients.php?page=<?php echo $page - 1; ?>">Page précédente</a><span> - </span><?php
        endif;

        for ($i = 1; $i <= $pageQuantity; $i++):
            ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
        endfor;
        
        if ($page < $pageQuantity):
            ?><span> - </span><a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
        endif;
        ?>
        
        <p><a href="../Exercice1/ajout-patient.php"</a>Ajouter un patient</p>
        <p><a href="../index.php"</a>Retour à l'index</p>
    </body>
</html>




