<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/aff.css" type="text/css" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Affichage/articles</title>
</head>
<body>

<header >
    <nav class="navbar">
    <div id="divnav">
    <a href="http://localhost/blogphp/Acceuil/index.php"><img src="../Images/logo.jpg" alt=""></a>
    <a href="#" class="mtop">ARTICLES</a>
    <a href="#" class="mtop">CONTACT</a>
    </div>
    </nav>
</header>


<div class="container">
<section class='allcard'>


<?php

include "../configdatabase.php";

if(isset($_GET['id_delete'])){
    if(!empty($_GET['id_delete'])){
        $Del = "DELETE FROM `article` WHERE ID_art = $_GET[id_delete];";
        mysqli_query($con,$Del) or die(mysqli_error($con));
    }
}
    



$card = "SELECT categorie.Genre,Images,Titre,Texte,ID_art FROM article INNER JOIN categorie ON article.id_categorie = categorie.ID_cat ; ";
echo $card;
$result = $con->query($card) or die(mysqli_error($con));
print_r($result);


if($result->num_rows > 0){
    while($cards = $result-> fetch_assoc()){

        ?>

        <div class="card">

            <img  class="card-image" src="<?php echo '../Images/uploads/'.$cards['Images'] ; ?>" alt="" srcset="">

      
    
            <div class="card-text">
                
                <h2><?php echo $cards['Titre'];  echo "<br />";
                    echo $cards['Genre']; ?></h2>
                <p class="clr"><?php
                    $txt = $cards['Texte'];
                    echo substr($txt,0,500)."...";
                ?></p>
            </div>
            <div class="card-button">
                <a href="detail.php?id=<?php echo  $cards['ID_art'];?>"><button class="supp">Consulter l'article</button></a>
            </div>
        </div>

        <?php
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