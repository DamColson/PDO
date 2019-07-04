<?php
$id;

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
            $appointmentsInfosPrepare = $db->prepare('SELECT appointments.id,appointments.dateHour,patients.firstname,patients.lastname FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id WHERE appointments.id=:id');
            $appointmentsInfosPrepare->execute(array('id' => $_GET['id']));
            $appointmentsInfosFetch = $appointmentsInfosPrepare->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($appointmentsInfosFetch as $key => $value):
                $id=(int)$value['id'];
                foreach ($value as $secondKey => $secondValue):
                    ?><p><?=
                        $secondKey . ' : ' . $secondValue;
                    endforeach;
                endforeach;
                ?>
        </div>

        <h1 class="text-center">Modifier un rendez vous : </h1>

        <form method="POST" class="bg-dark w-75 mx-auto" action="rendezvous.php?id=<?= $_GET['id']?>" id="inscriptionForm">
            <p class="h3 text-light mb-3 text-center">Vos informations personnelles</p>
            <fieldset class="bg-dark text-light mb-3">
                <div class="row bg-light text-dark rounded w-75 mx-auto text-center align-items-center justify-content-center no-gutters">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="newDate">Nouvelle date : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="newDate" name="newDate" placeholder="newDate" />
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="newHour">Nouvel horaire : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="newHour" name="newHour" placeholder="newHour" />
                    </div>
                    <div class="form-group col-lg-2"></div>

            </fieldset>

            <div class="align-items-center justify-content-center d-flex">
                <button id="submitFormButton" type="submit" class="btn btn-light text-dark mb-3">Envoyer</button>
            </div>
        </form>
        <p class="h3 text-center"><a href="../Exercice6/liste-rendezvous.php"</a>Retour à la liste des rendez vous</p>
        <p class="text-center h4 mt-2"><a href="../index.php"</a>Retour à l'index</p>
        <?php

        if ($_POST['newDate'] != '' && $_POST['newHour'] != ''):
            $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
            $modifyAppointmentsDateHour = $db->prepare('UPDATE appointments SET dateHour = :newDateHour WHERE id=:id');
            $modifyAppointmentsDateHour->execute(array('newDateHour' => $_POST['newDate'] . ' ' . $_POST['newHour'],'id'=>$id));
            header('location:rendezvous.php?id=' . $id );
        endif;
        ?>
        <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

