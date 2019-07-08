<?php
            $db = new PDO('mysql:host=localhost;dbname=nom_de_bdd', 'identifiant', 'password');
            
            // Ici nous préparons une requete, pour plus de simplicité nous allons prendre des infos prédéfinies d'une bdd prédéfinies. Le group_concat sert a rassembler sur une unique ligne toutes les informations de la colonnes liées à l'utilisateur.
            
            $patientsPrepare = $db->prepare('SELECT patients.id,patients.lastname,patients.firstname,patients.mail,patients.phone,patients.birthdate,GROUP_CONCAT(appointments.dateHour) AS RDV FROM patients INNER JOIN appointments ON patients.id = appointments.idPatients WHERE patients.id=:id');
            
            // Ici une simple requete query
            
            $appointmentsIdQuery = $db->query('SELECT appointments.id FROM appointments INNER JOIN patients ON patients.id = appointments.idPatients');
            
            // Ici on fetch toute les infos recupérées dans la requete précédente sous forme de tableau associatif à deux dimensions.
            
            $appointmentsIdFetch = $appointmentsIdQuery->fetchAll(PDO::FETCH_ASSOC);
            
            // Ici nous definissons les marqueurs nominatifs de la requete préparée. On peu également utiliser un bindvalue.
            
            $patientsPrepare->execute(array('id' => $_GET['id']));
            
            // Ici on fetch toute les infos récupérées dans la requete préparée sous forme de tableau associatif à deux dimensions.
            
            $patientsFetch = $patientsPrepare->fetchAll(PDO::FETCH_ASSOC);
            
            // Début de la foreach sur le tableau associatifs à deux dimension $testFetch. $value renvoie donc un tableau associatif.
            
            foreach ($patientsFetch as $key => $value):
            
            // On affiche les infos stockées dans le second tableau associatif $value dont les clés sont les noms des colonnes, lastname, firstname ect.
            ?><p><?= 'Nom : ' . $value['lastname']?></p>
            <p><?= 'Prénom : ' . $value['firstname']?></p>
            <p><?= 'Date de naissance : ' . $value['birthdate']?></p>
            <p><?= 'Email : ' . $value['mail']?></p>
            <p><?= 'Téléphone : ' . $value['phone']?></p>
            <div><p class="font-weight-bold"><?= 'Vos rendez vous : '?></p>
            
            
                <?php
                
            // Cas particulier utilisant des explode pour afficher les rendez vous. Si la colonne RDV n'est pas vide alors on rentre dans la condition.
                
                if($value['RDV']!=NULL):
                    
            // Boucle for dont l'index s'arrete a la taille maximale du tableau des rendez vous, créé grâçe à la fonction explode qui va créer un tableau ['rdv1','rdv2,...,'rdvN'] à partir de la chaine de caractère 'rdv1,rdv2,...,rdvN', en séparant les éléments de la string grâçe aux virgules.
                
                for ($i=0;$i<sizeof(explode(',',$value['RDV']));$i++):
                    
            // Mise en paramètre d'url de l'id du rdv récupérée dans la requête query.
                    
                    ?><p><a href="<?='../Exercice7-8/rendezvous.php?id=' . $appointmentsIdFetch[$i]['id'] ?>"><?='Le ' . ucfirst(strftime('%A %d %B %Y',strtotime(explode(' ',explode(',',$value['RDV'])[$i])[0]))) . ' à ' . explode(' ',explode(',',$value['RDV'])[$i])[1]?></a></p><?php
                endfor;
                endif;
                ?>
            </div>
            <?php endforeach;?>