<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/ajout.css" type="text/css" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Modif/article</title>
</head>

<?php

include "../configdatabase.php";

if(isset($_GET['ID_art']) and !empty($_GET['ID_art'])){
 //   echo "ID_art";
}

$card = "SELECT Images,Titre, Texte FROM article WHERE ID_art = $_GET[id_article]; ";
mysqli_query($con,$card) or die(mysqli_error($con));
$query = mysqli_query($con,$card);
$row= $query->fetch_assoc();






if(isset($_POST['enr'])){
    if(isset($_POST['modtit']) and isset($_POST['rule'])){
        if(!empty($_POST['modtit']) and !empty($_POST['rule'])){
            $images=rand(12,10000).$_FILES['img']['name'];
            $dos=$_FILES['img']['tmp_name'];
            $upl='../Images/uploads';      
            move_uploaded_file($dos,$upl."/".$images);
            $modtit = mysqli_real_escape_string($con,$_POST['modtit']);
            $rule = mysqli_real_escape_string($con,$_POST['rule']);

            $Mod = "UPDATE `article` SET `Images` ='$images', `Titre` ='$modtit',`Texte` ='$rule' WHERE ID_art = $_GET[id_article];";
            mysqli_query($con,$Mod) or die(mysqli_error($con));

         
        }
    }
}



?>


<body>
<header >
    <nav class="navbar">
    <div id="divnav">
    <a href="http://localhost/blogphp/Acceuil/index.php"><img src="../Images/logo.jpg" alt=""></a>
    <a href="http://localhost/blogphp/Article/affichage.php" class="mtop">ARTICLES</a>
    <a href="#" class="mtop">CONTACT</a>
    </div>
    </nav>
</header>

    <h1>MODIFIEZ VOTRE <span>ARTICLE </span> :</h1>


    <form class="chek" action="" method="post" enctype= multipart/form-data>
        <fieldset>
        <label for="">Sélectionner une image</label>
        <input name="img" class="pic" type="file" placeholder="Télechargez l'image" value=<?php echo $row['Images'] ; ?>>

        <label for="">Titre</label>
        <input name="modtit" class="title" type="text" placeholder="Entrez votre titre" value=<?php echo $row['Titre'] ; ?>>
        <label for="">Texte</label>
        <textarea name="rule" id="" cols="30" rows="10"> <?php echo $row['Texte']; ?></textarea>


        </fieldset>

        <a href="http://localhost/blogphp/Acceuil/index.php"><button type="submit" name="enr">Enregistrer</button></a>
    </form>
    









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

    <SCRIpt src="chek/ckeditor/ckeditor.js"></SCRIpt>
    <SCRIpt>
        CKEDITOR.replace("rule");
    </SCRIpt>
</body>
</html>