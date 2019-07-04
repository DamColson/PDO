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
        <form method="POST" class="bg-dark w-75 mx-auto" action="ajout-patient.php" id="inscriptionForm">
            <p class="h3 text-light mb-3 text-center">Vos informations personnelles</p>
            <fieldset class="bg-dark text-light mb-3">
                <div class="row bg-light text-dark rounded w-75 mx-auto text-center align-items-center justify-content-center no-gutters">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="firstName">Prénom : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="firstName" required />
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-4"><label for="lastName">Nom : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-3">
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="lastName" required />
                    </div>
                    <div class="form-group col-lg-2"></div>

                    <div class="form-group col-lg-1"></div>                   
                    <div class="form-group col-lg-4 mt-2"><label for="birthdate">Date de naissance : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-2">
                        <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="birthdate" />
                    </div>
                    <div class="form-group col-lg-2"></div>

                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-2"><label for="mail">Email : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-2">
                        <input type="text" class="form-control" id="mail" name="mail" placeholder="Votre Email" required />
                    </div>
                    <div class="form-group col-lg-2"></div>

                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-4 mt-2"><label for="phone">Téléphone : </label></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-11 col-lg-4 mt-2">
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="0XXXXXXXXX" required />
                    </div>
                    <div class="form-group col-lg-2"></div>

            </fieldset>

            <div class="align-items-center justify-content-center d-flex">
                <button id="submitFormButton" type="submit" class="btn btn-light text-dark mb-3">Envoyer</button>
            </div>
        </form>
        <p class="text-center h4 mt-2"><a href="../Exercice2/liste-patients.php">liste des patients</a></p>
        <p class="text-center h4 mt-2"><a href="../index.php">Retour à l'index</a></p>
        <?php
//        var_dump($_POST);
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');
        $testMail = $db->prepare('SELECT COUNT(patients.mail) AS mail FROM patients WHERE patients.mail=:mail');
        $testMail->execute(array('mail' => $_POST['mail']));
        $testMailFetch = $testMail->fetchAll(PDO::FETCH_ASSOC);
        $testPhone = $db->prepare('SELECT COUNT(patients.phone) AS phone FROM patients WHERE patients.phone=:phone');
        $testPhone->execute(array('phone' => $_POST['phone']));
        $testPhoneFetch = $testPhone->fetchAll(PDO::FETCH_ASSOC);

        if ($testMailFetch[0]['mail']<1 && $testPhoneFetch[0]['phone']<1):   
        $addPatient = $db->prepare('INSERT INTO patients(lastname,firstname,birthdate,phone,mail)VALUES(:lastname,:firstname,:birthdate,:phone,:mail)');
        $addPatient->execute(array('lastname' => $_POST['lastName'], 'firstname' => $_POST['firstName'], 'birthdate' => $_POST['birthdate'], 'phone' => $_POST['phone'], 'mail' => $_POST['mail']));    
        else:
            echo 'Adresse mail ou numéro de téléphone déjà présent dans la base de données';
        endif;
        
        ?>
        <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>    
</html>