<?php
$id=$_GET['id'];
setlocale (LC_TIME, 'fr_FR.UTF8','fra');
if($_POST):
    header('location:profil-patient.php?id=' . $id );
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Germania+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
    </head>
    <body>
        <div class="text-center">
            <?php
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');
            $patientsInfosPrepare = $db->prepare('SELECT patients.id,patients.lastname,patients.firstname,patients.mail,patients.phone,patients.birthdate,GROUP_CONCAT(appointments.dateHour) AS RDV FROM patients INNER JOIN appointments ON patients.id = appointments.idPatients WHERE patients.id=:id');
            $appointmentsInfosPrepare = $db->query('SELECT appointments.id FROM appointments INNER JOIN patients ON patients.id = appointments.idPatients');
            $appointmentsInfosFetch = $appointmentsInfosPrepare->fetchAll(PDO::FETCH_ASSOC);
            $patientsInfosPrepare->execute(array('id' => $_GET['id']));
            $patientsInfosFetch = $patientsInfosPrepare->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($patientsInfosFetch as $key => $value):
            ?><p><?= 'Nom : ' . $value['lastname']?></p>
            <p><?= 'Prénom : ' . $value['firstname']?></p>
            <p><?= 'Date de naissance : ' . $value['birthdate']?></p>
            <p><?= 'Email : ' . $value['mail']?></p>
            <p><?= 'Téléphone : ' . $value['phone']?></p>
            <div><p class="font-weight-bold"><?= 'Vos rendez vous : '?></p>
                <?php
                if($value['RDV']!=NULL):
                for ($i=0;$i<sizeof(explode(',',$value['RDV']));$i++):
                    ?><p><a href="<?='../Exercice7-8/rendezvous.php?id=' . $appointmentsInfosFetch[$i]['id'] ?>"><?='Le ' . ucfirst(strftime('%A %d %B %Y',strtotime(explode(' ',explode(',',$value['RDV'])[$i])[0]))) . ' à ' . explode(' ',explode(',',$value['RDV'])[$i])[1]?></a></p><?php
                endfor;
                endif;
                ?>
            </div>
            <?php endforeach;?>
        </div>

        <h1 class="text-center">Modifier une information : </h1>

        <form method="POST" class="bg-dark w-75 mx-auto" action="profil-patient.php?id=<?= $_GET['id']?>" id="inscriptionForm">
            <p class="h3 text-light mb-3 text-center">Vos informations personnelles</p>
            <fieldset class="bg-dark text-light mb-3">
                <div class="row bg-light text-dark rounded w-75 mx-auto text-center align-items-center justify-content-center no-gutters">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="newFirstName">Nouveau Prénom : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="newFirstName" name="newFirstName" placeholder="newFirstName" />
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="newLastName">Nouveau Nom : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="newLastName" name="newLastName" placeholder="newLastName" />
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-2"><label for="newMail">Nouveau mail : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-2">
                        <input type="text" class="form-control" id="newMail" name="newMail" placeholder="Votre nouveau mail"/>
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-2"><label for="newPhone">Nouveau Téléphone : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-2">
                        <input type="newPhone" class="form-control" id="newPhone" name="newPhone" placeholder="0XXXXXXXXX"/>
                    </div>
                    <div class="form-group col-lg-2"></div>

            </fieldset>

            <div class="align-items-center justify-content-center d-flex">
                <button id="submitFormButton" type="submit" class="btn btn-light text-dark mb-3">Envoyer</button>
            </div>
        </form>
        <p class="h3 text-center"><a href="../Exercice2/liste-patients.php">Retour à la liste des patients</a></p>
        <p class="text-center h4 mt-2"><a href="../index.php">Retour à l'index</a></p>
        <?php
 
      
        if ($_POST['newFirstName'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyPatientFirstName = $db->prepare('UPDATE patients SET firstname = :newFirstName WHERE id=:id');
            $modifyPatientFirstName->execute(array('newFirstName' => $_POST['newFirstName'],'id'=>$id));
        endif;
        if ($_POST['newLastName'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyPatientLastName = $db->prepare('UPDATE patients SET lastname = :newLastName WHERE id=:id');
            $modifyPatientLastName->execute(array('newLastName' => $_POST['newLastName'],'id'=>$id));
        endif;
        if ($_POST['newBirthdate'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyPatientBirthdate = $db->prepare('UPDATE patients SET birthdate = :newBirthdate WHERE id=:id');
            $modifyPatientBirthdate->execute(array('newBirthdate' => $_POST['newBirthdate'],'id'=>$id));
        endif;
        if ($_POST['newMail'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyPatientMail = $db->prepare('UPDATE patients SET mail = :newMail WHERE id=:id');
            $modifyPatientMail->execute(array('newMail' => $_POST['newMail'],'id'=>$id));
        endif;
        if ($_POST['newPhone'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyPatientPhone = $db->prepare('UPDATE patients SET phone = :newPhone WHERE id=:id');
            $modifyPatientPhone->execute(array('newPhone' => $_POST['newPhone'],'id'=>$id));
        endif;
        ?>
        <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
