<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>

        <form method="GET" action="patientsSearch.php">
            <input type = "search" name = "searchBar" />
            <button type = "submit" >Rechercher</button>     
        </form>

        <?php
                
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');

        $patientsPerPage = 5;

        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $start = ($page - 1) * $patientsPerPage;
        
        $searchedPatientsCount = $db->prepare('SELECT COUNT(patients.id) AS searchedPatientsQuantity FROM patients WHERE patients.firstname LIKE :search OR patients.lastname LIKE :search');
        $searchedPatientsCount->execute(array('search' => '%' . $_GET['searchBar'] . '%'));
        $searchedPatientsArray = $searchedPatientsCount->fetchAll(PDO::FETCH_ASSOC);
        $searchedPatientsQuantity = (int)$searchedPatientsArray[0]['searchedPatientsQuantity'];
        
        $query = 'SELECT patients.id,patients.lastname,patients.firstname FROM patients WHERE patients.firstname LIKE :search OR patients.lastname LIKE :search LIMIT :patientsPerPage OFFSET :start';
        $searchedPatientsPrepare = $db->prepare($query);
        $searchedPatientsPrepare->bindValue('patientsPerPage', $patientsPerPage, PDO::PARAM_INT);
        $searchedPatientsPrepare->bindValue('start', $start, PDO::PARAM_INT);
        $searchedPatientsPrepare->bindValue('search','%' . $_GET['searchBar'] . '%', PDO::PARAM_STR);
        $searchedPatientsPrepare->execute();   
        $searchedPatientFetch = $searchedPatientsPrepare->fetchAll(PDO::FETCH_ASSOC);
        
        $pageQuantity = ceil($searchedPatientsQuantity / $patientsPerPage);

        foreach ($searchedPatientFetch as $key => $value):
            ?><p><a href="../Exercice3-4/profil-patient.php?id=<?= $value['id'] ?>"><?= 'Patient n°' . $value['id'] . ' : ' . $value['lastname'] . ' ' . $value['firstname']; ?></a><a href="<?= 'deletionPatient.php?id=' . $value['id'] ?>">X</a></p>
            <hr /> <?php
        endforeach;



        if ($page > 1):
            ?><a href="?page=<?php echo $page - 1; ?>&searchBar=<?=$_GET['searchBar']?>">Page précédente</a><span> - </span><?php
        endif;

        for ($i = 1; $i <= $pageQuantity; $i++):
            ?><a href="?page=<?php echo $i; ?>&searchBar=<?=$_GET['searchBar']?>"><?php echo $i; ?></a> <?php
        endfor;

        if ($page < $pageQuantity):
            ?><span> - </span><a href="?page=<?php echo $page + 1; ?>&searchBar=<?=$_GET['searchBar']?>">Page suivante</a><?php
        endif;
        
        if($_GET['searchBar']!=''):
           ?><p><a href="liste-patients.php"</a>Retourner à la liste de tout les patients</p><?php 
        endif;
        ?>
         
        
        <p><a href="../Exercice1/ajout-patient.php"</a>Ajouter un patient</p>
        <p><a href="../index.php"</a>Retour à l'index</p>

    </body>
</html>