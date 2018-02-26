        <?php

        $firstname ='';
        $nom='';
        $email='';
        $telephone='';
        $message='';

        $firstnameError ='';
        $nomError='';
        $emailError='';
        $telephoneError='';
        $messageError='';

        $validationTotale= false ;


        $emailTo = 'alexleborgne@hotmail.fr';


        if ($_SERVER["REQUEST_METHOD"]=="POST"){

           $firstname= verifyInput($_POST["firstname"]);
           $nom=verifyInput($_POST["nom"]);
           $email=verifyInput($_POST['email']);
           $telephone=verifyInput($_POST['telephone']);
           $message=verifyInput($_POST['message']);
           $validationTotale=true;
           $emailText='';


        if (empty($firstname)){

          $firstnameError= 'Vous avez oublié(e) devez mettre un prénom !';
          $validationTotale= false ;

        }
        else{
          $emailText.='Prenom: $firstname\n';
        }

        if (empty($nom)){

          $nomError=' Vous avez oublié(e) de mettre le nom !';
          $validationTotale= false ;
        }

        else{

          $emailText.='Nom: $nom\n';
        }


        if (!emailverif($email)){

         $emailError ='Ce n\'est pas un Email valide !';
         $validationTotale= false;

        }

        else{

          $emailText.='Email: $email\n';
        }

        if (empty($message)){

          $messageError.='Dites quelque chose !';
          $validationTotale= false ;

        }

        else {
          $emailText.='Messsage: $message\n';
        }

        // ETAPE FINALE = ENVOIE
        if ($validationTotale){
          $headers="From: $firstname $nom <$email>\r\nReply-To: $email";
          mail($emailTo, 'Message de votre site', $emailText , $headers);
          $firstname ='';
          $nom='';
          $email='';
          $telephone='';
          $message='';
        }

      }

        // Verification
        function verifyInput($var){

            $var=trim($var);
            $var=stripslashes($var);
            $var=htmlspecialchars($var);

            return $var;

        }

        // Verification Email
        function emailverif($var){

          return filter_var($var, FILTER_VALIDATE_EMAIL);
        }
          ?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>formulaire</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">


</head>

<body>

  <div class='container'>
  <div class='divider'></div>
  <div class='heading'>
    <h2> Me contacter </h2>
  </div>
  <div class='row'>
    <div class='col-lg-10 col-lg-offset-1'>
      <form id='contact-form' method='post' action ='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' role='form'>
      <div class='row'>

       <!--PRENOM-->
       <div class='col-md-6'>
         <label for='prenom'>Prénom<span>*</span></label>
         <input id='firstname' type='text' class='form-control' name='firstname' placeholder='Indiquez votre Prénom.' value='<?php echo $firstname  ?>'>
         <p class='comments'><?php echo $firstnameError  ?></p>
        </div>

        <!--NOM-->
        <div class='col-md-6'>
         <label for='nom'>Nom<span>*</span></label>
         <input id='nom' type='text' class='form-control' name='nom' placeholder='Indiquez votre Nom.' value='<?php echo $nom ?>'>
         <p class='comments'><?php echo $nomError ?></p>
        </div>

        <!--EMAIL-->
        <div class='col-md-6'>
         <label for='email'>Email<span>*</span></label>
         <input id='email' type='text' class='form-control' name='email' placeholder='Indiquez votre Email.'value='<?php echo $email ?>'>
         <p class='comments'><?php echo $emailError ?></p>
        </div>

        <!--TELEPHONE-->
        <div class='col-md-6'>
         <label for='phone'>Téléphone</label>
         <input id='phone' type='tel' class='form-control'name='telephone' placeholder='Indiquez votre numéro de téléphone.' value='<?php echo $telephone ?>'>
         <p class='comments'></p>
        </div>
        <!--TEXTAREA-->
        <div class='col-md-12'>
          <label for='message'>Message<span>*</span></label>
          <textarea id='message' name='message' class='form-control' placeholder='Ecrivez votre message.' rows='4'><?php echo $message ?></textarea>
          <p class='comments'><?php echo $messageError ?></p>
        </div>

        <!--Informations requises-->
        <div class='col-md-12'>
          <p><strong> * ces informations sont requises</strong> </p>
        </div>
        <!--Boutton d'envoie-->
      <div class='col-md-12'>
        <input type ='submit' class='button1' value='envoyer'>
        </div>

        <p class='merci' style='display:<?php if ($validationTotale){ echo 'block';} else {echo 'none';} ?>'> Votre message à bien été envoyé ! Merci :)</p>
      </form>
  </div>
</div>
</div>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/1.3.1/js/fontawesome-iconpicker.js'></script>



</body>

</html>
