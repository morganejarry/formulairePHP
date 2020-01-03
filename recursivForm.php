<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire</title>
</head>

<body>
    <?php
        session_start();

        if(isset($_GET['fin']) && $_GET['fin'] == 'ok'){
            unset($_SESSION['question1']);
            unset($_SESSION['question2']);
            unset($_SESSION['reponse1']);
            unset($_SESSION['reponse2']);
        }
        if(isset($_POST['question1'])){
            $_SESSION['question1'] = $_POST['question1'];
        }
        if(isset($_POST['question2'])){
            $_SESSION['question2'] = $_POST['question2'];
        }
        if(isset($_POST['reponse1'])){
            $_SESSION['reponse1'] = $_POST['reponse1'];
        }
        if(isset($_POST['reponse2'])){
            $_SESSION['reponse2'] = $_POST['reponse2'];
        }
        $errorQuestion = '';
    ?>

    <p class="titre">Formulaire</p>

    <?php 
        if(empty($_SESSION['question1']) || empty($_SESSION['question2']) || !preg_match('/\?/', $_SESSION['question1']) || !preg_match('/\?/', $_SESSION['question2'])){
    ?>
           <form class="formulaire" action="recursivForm.php" method="post">
            <?php
                if(empty($_SESSION['question1'])){
                    $errorQuestion = 'Vous devez renseigner une question.';
                }elseif(!empty($_SESSION['question1']) ) {
                    if(!preg_match('/\?/', $_SESSION['question1'])) {
                        echo '<p style="color:red">Vous devez poser une question contenant le symbole "?".</p>';
                    }
                }?>
            <label for="question1">Votre première question:</label><br />
            <textarea id="question1" class="input" name="question1" required="required" rows="3" cols="80"><?php echo isset($_SESSION['question1']) ? $_SESSION['question1'] : ''?></textarea><br />
            <?php
                if(empty($_SESSION['question2'])){
                    $errorQuestion = 'Vous devez renseigner une question.';
                }elseif(!empty($_SESSION['question2'])) {
                    if(!preg_match('/\?/', $_SESSION['question2'])) {
                        echo '<p style="color:red">Vous devez poser une question contenant le symbole "?".</p>';
                    }
                }?>
            <label for="question2">Votre seconde question:</label><br />
            <textarea id="question2" class="input" name="question2" required="required" rows="3" cols="80"><?php echo isset($_SESSION['question2']) ? $_SESSION['question2'] : '' ?></textarea><br />
            <p><input type="submit" class="submit_button" value="Valider" value="Valider"></p>
        </form>
    <?php
        }else if(empty($_SESSION['reponse1']) && empty($_SESSION['reponse2'])){
    ?>
            <p class="titre">Vos questions posées :</p><br>
            <form class="formulaire" action="recursivForm.php" method="post">
            
           <?php
               if(empty($_SESSION['reponse1'])){
                   $errorQuestion = 'Vous devez renseigner une réponse.';
               }?>
           <label for="question1"><?php echo $_SESSION['question1']; ?></label><br />
           <textarea id="reponse1" class="input" name="reponse1" required="required" rows="3" cols="80"></textarea><br />
           
           <?php
               if(empty($_SESSION['reponse2'])){
                   $errorQuestion = 'Vous devez renseigner une réponse.';
               }?>
           <label for="question2"><?php echo $_SESSION['question2']; ?></label><br />
           <textarea id="reponse2" class="input" name="reponse2" required="required" rows="3" cols="80"></textarea><br />
           <p><input type="submit" class="submit_button" value="Valider" value="Valider"></p>
       </form>
    <?php
        }else{
    ?>
            <p class="titre">Récapitulatif</p><br>
            
            <?php
                echo '<div class="formulaire"> ' . $_SESSION['question1'] . '<br/>';
                echo ' ' . $_SESSION['reponse1'] . ' <br/>';
                echo ' ' . $_SESSION['question2'] . ' <br/>';
                echo ' ' . $_SESSION['reponse2'] . ' </div>';
        }
    ?>
    
    
    <p>Si tu veux changer tes questions, <a href="recursivForm.php?fin=ok">clique ici</a> pour revenir à la page formulaire.</p>
</body>
</html>
