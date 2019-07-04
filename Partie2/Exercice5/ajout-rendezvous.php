<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Germania+One" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
        <title>m</title>
    </head>
    
    <body class="font-family-germania">
        <?php
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');
            $patientsInfosQuery = $db->query('SELECT patients.id,patients.firstName,patients.lastName FROM patients');
            $patientsInfosFetch = $patientsInfosQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>
        <form method="POST" class="bg-dark w-75 mx-auto" action="ajout-rendezvous.php" id="inscriptionForm">
            <p class="h3 text-light mb-3 text-center">Ajouter un rendez vous</p>
            <fieldset class="bg-dark text-light mb-3">
                <div class="row bg-light text-dark rounded w-75 mx-auto text-center align-items-center justify-content-center no-gutters">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="date">Date : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="date" name="date" placeholder="date" required />
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="time">Heure : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="time" name="time" placeholder="time" required />
                    </div>
                    <div class="form-group col-lg-2"></div>
   
                    <div class="form-group col-lg-3"></div>    
                    <div class="form-group col-11 col-lg-6">
                        <label for="" id="">Nom du patient : </label>
                        <select class="form-control" id="patientName" name="patientName">
                            <option selected disabled></option>
                                <?php 
                                foreach($patientsInfosFetch as $key=>$value):
                                    ?><option value='<?=$value['id']?>'><?=$value['firstName'] . ' ' . $value['lastName'] ?></option>
                                    <?php
                                endforeach;
                                ?>
                        </select>    
                    </div>
                    <div class="form-group col-lg-3"></div>
                    </div>
            </fieldset>

            <div class="align-items-center justify-content-center d-flex">
                <button id="submitFormButton" type="submit" class="btn btn-light text-dark mb-3">Envoyer</button>
            </div>
        </form>
        
        <p class="text-center h4 mt-2"><a href="../Exercice6/liste-rendezvous.php">liste des rendez vous</a></p>
        <p class="text-center h4 mt-2"><a href="../index.php"</a>Retour à l'index</p>
        
        
        <?php

        if ($_POST):
            
            $addAppointment = $db->prepare('INSERT INTO appointments(dateHour,idPatients)VALUES(:dateTime,:idPatient)');
            $addAppointment->execute(array('dateTime'=>$_POST['date'] . ' ' . $_POST['time'],'idPatient'=>$_POST['patientName']));
        endif;
        ?>
        <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>    
</html>