<?php
session_start();
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/det.css" type="text/css" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Detail/articles</title>
</head>
<body>

<header >
    <nav class="navbar">
    <div id="divnav">
    <a href="http://localhost/blogphp/Acceuil/index.php"><img src="../Images/logo.jpg" alt=""></a>
    <a  href="http://localhost/blogphp/Article/affichage.php" class="mtop">ARTICLES</a>
    <a  href="#" class="mtop">CONTACT</a>
    </div>
    </nav>
</header>




<div class="container">
<section class='allcard'>


<?php

include "../configdatabase.php";
if(isset($_GET['id']) and !empty(['id'])){

$det = $_GET['id'];
echo $det;

$card = "SELECT ID_art,ID_user,Images,Titre, Texte FROM article WHERE ID_art = $det";
echo $card;

$result = $con->query($card) or die(mysqli_error($con));
print_r($result);

if($result->num_rows == 1){
    while($cards = $result->fetch_assoc()){

        ?>

        <div class="card">
        <img  class="card-image" src="<?php echo '../Images/uploads/'.$cards['Images'] ; ?>" alt="" srcset="">
    
            <div class="card-text">
                
                <h2><?php echo $cards['Titre'] ; ?></h2>
                <p class="clr"><?php echo $cards['Texte'];?></p>
            </div>
            <div class="card-button">

            <?php if(isset($_SESSION["ID_user"]) && isset($_SESSION['Email']) && $cards['ID_user'] == $_SESSION['ID_user']) {
                
                ?>
                <a href="modif.php?id_article=<?php echo $cards['ID_art'];?>"><button class="btncard">Modifier l'article</button></a>

            <?php 
            }
            ?>
            </div>
        </div>

        <?php
    }
}else{
    "<div class='alert alert-danger' role='alert'>
                Error ID !!
              </div>";
}
} 
        ?>


</div>


<footer>
<h3 >SUIVEZ <span>NOUS</span></h3>
<div class="logos">
<a href="https://www.instagram.com/rakouk_ali4907/">
<i class="fa fa-instagram allbtn"></i>
</a>
<a href="https://www.facebook.com/ali.rakouk">
<i class="fa fa-facebook-square allbtn"></i>
</a>
<a href="https://www.linkedin.com/in/rakouk-ali-b982261a1/">
<i class="fa fa-linkedin-square allbtn"></i>
</a>
<a href="https://www.youtube.com/channel/UC0Dt2F2e-EEIj1vg_hvFTdQ">
<i class="fa fa-youtube-play allbtn"></i>
</a>
</div>
<img class="footer" src="../Images/footer.jpg" alt="">
<p class="pfoot">ON VOUS OFFRE LE MEILLEUR CHOIX</p>
<a class="copy" href="http://localhost/blogphp/Acceuil/index.php#">
<i class="fa fa-copyright"></i>
Auto ali 2020
</a>

</footer>
</body>
</html>



