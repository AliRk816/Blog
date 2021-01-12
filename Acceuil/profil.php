<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/Prof.css" type="text/css">
    <title>Profil</title>
</head>
<body>
<header >
    <nav class="navbar">
    <div id="divnav">
    <a href="http://localhost/blogphp/Acceuil/index.php"><img src="../Images/logo.jpg" alt=""></a>
    <a href="http://localhost/blogphp/Article/affichage.php" class="mtop">ARTICLES</a>
    <a href="http://localhost/blogphp/Article/ajout.php"><button class="red">Ajouter
    <i class="fa fa-pencil"></i>
    </button>
    </a>




</header>

<?php
include "../configdatabase.php";

$detail = "SELECT Img_user,Nom,Prenom,Email,Username FROM `utilisateur` WHERE ID_user = 10 ";
echo $detail;
$result = $con->query($detail) or die(mysqli_error($con));
print_r($result);

if($result->num_rows > 0){
    while($cards = $result-> fetch_assoc()){

?>


<div class="container">
<?php 
if($_SESSION["Img_user"]) {
?>
<img  class="pic" src="<?php echo '../Images/uploads/'.$_SESSION["Img_user"] ; ?>" alt="" srcset="">
<?php
} else {
?>
<img  class="pic" src="<?php echo '../Images/uploads/inconnu.jpg'; ?>" alt="" srcset="">
<?php
}
?>
<div class="text">
<h2 class="hhead"><?php echo $_SESSION["Username"]; ?>

</h2>

<p class="shead">
Prenom: <span><?php echo $_SESSION["Prenom"]; echo "<br />"?></span>
Email: <span><?php echo $_SESSION["Email"]; ?></span>

</p>

<a href="../Acceuil/edit.php"><button class="edt">Editer
<i class="fa fa-cog"></i>
</button></a>

</div>

</div>


<?php
}
}
?>

<hr>

<h1>MES <span>ARTICLES</span></h1>

<?php

if(isset($_GET['id_delete'])){
    if(!empty($_GET['id_delete'])){
        $Del = "DELETE FROM `article` WHERE ID_art = $_GET[id_delete];";
        mysqli_query($con,$Del) or die(mysqli_error($con));
    }
}



$aff = "SELECT categorie.Genre,Images,Titre,Texte,ID_art FROM article INNER JOIN categorie ON article.id_categorie = categorie.ID_cat WHERE article.ID_user = $_SESSION[ID_user]; ";

$resultat = $con->query($aff) or die(mysqli_error($con));


if($resultat->num_rows > 0){
    while($det = $resultat-> fetch_assoc()){

        ?>

        <div class="card">

            <img  class="card-image" src="<?php echo '../Images/uploads/'.$det['Images'] ; ?>" alt="" srcset="">

      
    
            <div class="card-text">
                
                <h2><?php echo $det['Titre'];  echo "<br />";
                    echo $det['Genre']; ?></h2>
                <p class="clr"><?php
                    $txt = $det['Texte'];
                    echo substr($txt,0,500)."...";
                ?></p>
            </div>
            <div class="card-button">



                <a href="../Article/affichage.php?id_delete=<?php echo $det['ID_art']; ?>"><button name="delete" class="del">Supprimer</button></a>
    
                <a href="../Article/detail.php?id=<?php echo  $det['ID_art'];?>"><button class="supp">Consulter l'article</button></a>
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
