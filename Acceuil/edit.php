<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/edit.css" type="text/css">
    <title>Edit</title>
</head>
<body>

<?php
include "../configdatabase.php";

$edit = "SELECT Img_user,Nom, Prenom,Email,Mot_de_passe,Username FROM utilisateur WHERE ID_user = $_SESSION[ID_user] LIMIT 1; ";

mysqli_query($con,$edit) or die(mysqli_error($con));
$just = mysqli_query($con,$edit);
$Row= $just->fetch_assoc();

if(isset($_POST['save'])){
    if(isset($_POST['Name']) and isset($_POST['Pre']) and isset($_POST['Mail']) and isset($_POST['Unm'])){
        if(!empty($_POST['Name']) and !empty($_POST['Pre']) and !empty($_POST['Mail']) and !empty($_POST['Unm'])){
            $picture=rand(12,10000).$_FILES['pic']['name'];
            $pic=$_FILES['pic']['tmp_name'];
            $UPL='../Images/uploads';      
            move_uploaded_file($pic,$UPL."/".$picture);
            $Name = mysqli_real_escape_string($con,$_POST['Name']);
            $Pren = mysqli_real_escape_string($con,$_POST['Pre']);
            $mail = mysqli_real_escape_string($con,$_POST['Mail']);
            $uname = mysqli_real_escape_string($con,$_POST['Unm']);

            $edt = "UPDATE `utilisateur` SET `Img_user` ='$picture', `Nom` ='$Name',`Prenom` ='$Pren',`Email` ='$mail',`Username` ='$uname'  WHERE ID_user = $_SESSION[ID_user];";
            mysqli_query($con,$edt) or die(mysqli_error($con));
            $_SESSION["Img_user"]=$picture; 
            $_SESSION["Email"]=$mail;
            $_SESSION["Nom"]=$Name;
            $_SESSION["Prenom"]=$Pren;
            $_SESSION["Username"]=$uname;

         
        }
    }
}


?>
    
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



<div class="form">

<h2>Modifier <span>vos données</span></h2>

<form class="edt" action="" method="post" enctype= multipart/form-data>

    <fieldset>
        <label for="">Images</label>
        <input name="pic" class="ingin" type="file" value=<?php echo $Row['Img_user']; ?>>

        <label for="">Nom </label>
        <input class="ingin" type="text" value="<?php echo $Row['Nom']; ?>" name="Name">

        <label for="">Prénom </label>
        <input class="ingin" type="text" value="<?php echo $Row['Prenom']; ?>" name="Pre">

        <label for="">Email</label>
        <input class="ingin" type="text" value="<?php echo $Row['Email']; ?>" name="Mail">

        <label for="">Nom d'utilisateur</label>
        <input class="ingin" type="text" value="<?php echo $Row['Username']; ?>" name="Unm">
    </fieldset>

    <a href="http://localhost/blogphp/Acceuil/index.php"><button type="submit" class="btn" name="save">Enregistrer</button></a>

</form>

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
AUTO ALI 2020
<i class="fa fa-copyright"></i>
</a>

</footer>

</body>
</html>