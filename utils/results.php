<?php
require_once"../functions/userCrud.php";
/**
 * La page résults va permettre de faire le traitement 
 * de tous les formulaires il faut donc que je sache 
 * dans quel formulaire je suis pour en faire le traitement
  */

  //Avec if
  /**if (isset($_POST)) {
    var_dump($_POST);
    if ($_POST['action']=='signup') {
        //Traitement pour l'enregistre
    }
    elseif($_POST['action']=='login'){
        //Traitement pour le login
    }
    else {
        //redirection vers index.php
    }
    
  }*/

  //Ou Switch case

  if(isset($_POST)){
    var_dump($_POST);
    switch ($_POST['action']) {
        case 'signup':
            //Validation des data
            
            $newUserData=[
                'usder_name' => $_POST['user_name'],
                'email' => $_POST['email'],
                'pwd' => $_POST['pwd'],

            ];
            //Creation d'un user dans la DB

            createUser(($newUserData));
            break;
        case 'login':
            # code...
            break;
        
        default:
            # code...
            break;
    }
  } else{
    //redirection vers index.php
  }

?>