<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/ajout.css" type="text/css" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Ajout/article</title>
</head>
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

<?php 

include "../configdatabase.php";

if(isset($_POST['env'])){
    print_r($_REQUEST);
    echo "<br />";
    if(empty($_POST['env'])){

        if(isset($_POST['inp']) and isset($_POST['txt'])){
            if(!empty($_POST['inp']) and !empty($_POST['txt'])){

               // $folder_upload = '../uplaods';
                $images=$_FILES['img']['name'];
                $dos=$_FILES['img']['tmp_name'];
                $upl='../Images/uploads';      
                move_uploaded_file($dos,$upl."/".$images);

                $txt = $_POST['txt'];
                $title = $_POST['inp'];
                $cat = $_POST['listcat'];
                $sql  = "INSERT INTO  article (`ID_user`, `Images`, `Titre`, `Texte`, `id_categorie`, `Creation_date`, `Modif_date`, `Supp_date`) VALUES ('$_SESSION[ID_user]','$images','$title','$txt','$cat',NULL,NULL,NULL);";
                $con->query($sql) or die(mysqli_error($con));
                header('Location: ../Acceuil');
                

            }else{ echo "<div class='alert alert-danger' role='alert'>
                L'article est bien reçu!!
              </div>";
            }


        }


    }
}




?>


    <h1>AJOUTEZ VOTRE <span>ARTICLE</span> :</h1>


    <form class="chek" action=""  method="post" enctype= multipart/form-data>
        <fieldset>

        <label for="">Sélectionner une image</label>
        <input name="img" class="pic" type="file" placeholder="Télechargez l'image">

        <label for="">Titre</label>
        <input name="inp" class="title" type="text" placeholder="Entrez votre titre">

        <label for="">Catégorie</label>
        <select name="listcat" id="defaultSelect">
        <option selected>Choisisez une catégorie</option>
        <?php $query2 = $con->query("SELECT * FROM categorie"); ?>
        <?php while($row = $query2->fetch_assoc()){ ?>
            <option value=<?php echo $row['ID_cat'] ?>><?php echo $row['Genre'] ?>   </option>

            <?php
            }
            ?>

        </select>
        <label for="">Texte</label>
        <textarea name="txt" id="area" cols="30" rows="10"></textarea>


        

        </fieldset>


        <a href="http://localhost/blogphp/Acceuil/index.php"><button type="submit" name="env">Envoyer</button></a>
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
        CKEDITOR.replace("txt");
    </SCRIpt>



</body>
</html>