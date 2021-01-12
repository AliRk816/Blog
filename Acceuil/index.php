<?php session_start(); 
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="../Css/index.css" type="text/css">




    <title>ALI_AUTO</title>
</head>
<body>
    

<?php
 include "../configdatabase.php";

if(isset($_POST['log'])){
    $Eml=$_POST['usname'];
        $requet="SELECT * FROM `utilisateur` WHERE Email= '$Eml' limit 1"; // recuperez les donners d'utilisateur
         $var = $con->query($requet); // executer la requete sql 
         $Tab=$var->fetch_assoc(); // affecter les données de la requetes dans la variable $Tab

         $hash = $Tab['Mot_de_passe']; // enregister le mot de passe dans la variable $pass (ce mot passe est hashé)
         $passe=$_POST['psword'];  // le mot de passe entré par l'utulisateur

            if(password_verify($passe, $hash)) {
                echo 'vous etes connecter !';

                $_SESSION["Img_user"]=$Tab["Img_user"];
                $_SESSION["ID_user"]=$Tab["ID_user"]; 
                $_SESSION["Email"]=$Tab["Email"];
                $_SESSION["psword"]=$Tab["Mot_de_passe"];
                $_SESSION["Nom"]=$Tab["Nom"];
                $_SESSION["Prenom"]=$Tab["Prenom"];
                $_SESSION["Username"]=$Tab["Username"];
                 
                 
                   } else {
                echo"<div class='alert alert-danger' role='alert'>
                Mot de passe incorrecte !
                </div>";
                   }

}else {
            echo"<div class='alert alert-danger' role='alert'>
             Compte non existant !
             </div>";
}


?>


<?php
    
 
    if(isset($_POST['sign'])){
        /////////////////////////verification_information_comuniquer///////////////////////////////////////////////////////////////////////////
        $errors = array();

        if(empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/',$_POST['nom']) ){
            $errors['nom']="le nom n'est pas valide";    }
        }
        if(empty($_POST['pren']) || !preg_match('/^[a-zA-Z]+$/',$_POST['pren']) ){
            $errors['pren']="le prenom n'est pas valide";    
        }
        if(empty($_POST['uname'])){
            $errors['uname']="le pseudo name n'est pas valide";    
        }else{
            $nomUtilisateur=$_POST['uname'];       
             $query = $con->query("SELECT * FROM utilisateur WHERE Username =  '$nomUtilisateur'") or die(mysqli_error($con));
            $rows=$query->fetch_assoc();
                 if($rows){
                $errors['uname']="pseudo deja existant";
                
            }


        }

            if(empty($_POST['eml']) || !filter_var($_POST['eml'], FILTER_VALIDATE_EMAIL)){
                $errors["eml"]="L'email n'est pas valide";
            }else{
            
                $email=$_POST['eml'];       
                 $query = $con->query("SELECT * FROM utilisateur WHERE Email =  '$email'");
                $rows=$query->fetch_assoc();
                     if($rows){
                    $errors['eml']="Email deja existant";
                    
                }
            
            }
        
            if(empty($_POST['pass'])  ){
                $errors['pass'] = "Le mot de passe n'est pas valide";
                
            }





        
        
        
?>


 


    <header >
    <nav class="navbar">
    <div id="divnav">
    <a href="#"><img src="../Images/logo.jpg" alt=""></a>
    <a href="http://localhost/blogphp/Article/affichage.php" class="mtop">ARTICLES</a>
    <a href="#" class="mtop">CONTACT</a>
    </button>
    </a>

    <?php if(!isset($_SESSION["ID_user"]) && !isset($_SESSION['Email'])) { ?>

    <button onclick="document.getElementById('popup-modal').style.display='block'" class="red">Sign in</button>



    <?php

    } else  {


    ?>   

        <a href="http://localhost/blogphp/Acceuil/profil.php" class="mtop">PROFIL</a>
        <a href="http://localhost/blogphp/Article/ajout.php"><button class="red">Ajouter
        <i class="fa fa-pencil"></i>
        </button>
        </a> 
        <form action="../Article/destroy.php" method="post">
        <button type="submit" name="logout">
        <i class="fa fa-sign-out"></i>Log Out
        </button>
        </form>

    <?php    
    }

    ?>
    <?php if(!isset($_SESSION["ID_user"]) && !isset($_SESSION['Email'])) { ?>

    <form action="" method="post">
        <input class="inplog" type="text" name="usname" placeholder="Email">
        <input class="inplog" type="password" name="psword" placeholder="Mot de passe">
        <button class="log" type="submit" name="log">Log In</button>

    </form>

    <?php 

    }

    ?>
    </div>
    </nav>
    </header>

    
           <?php  

           if(isset($_POST['sign'])) {
    if(empty($errors)){   
         $nom=$_POST['nom'];
        $prenom=$_POST['pren'];   
        $motDePasse = password_hash($_POST['pass'],  PASSWORD_DEFAULT );
        $photo=$_FILES['picture']['name'];
        $tel=$_FILES['picture']['tmp_name'];
        $UPL='../Images/uploads';      
        move_uploaded_file($tel,$UPL."/".$photo);

        $con->query("INSERT INTO `utilisateur` VALUES ('$photo','','$nom','$prenom','$email','$motDePasse','$nomUtilisateur','','','') ") or die(mysqli_error($con));

        $signin = ("INSERT INTO `utilisateur` VALUES ('$photo','','$nom','$prenom','$email','$motDePasse','$nomUtilisateur','','','') ");
        echo $signin;

    ?>
    <div class="alert alert-primary" role="alert">
        Votre compte a été créer avec succés
    </div>

    <?php
 
}else{
    ?>
    <div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement </p>
    <ul>
    <?php foreach($errors as $value){?>
        <li><?php echo $value; ?></li>
    <?php }    ?>
    </ul>
    </div>
    <?php 

    }
}
    ?>

    <div id="popup-modal" class="modal">


    <form class="pop-content" action="" method="post" enctype= multipart/form-data>
    <div class="imgcontainer">
    <span onclick="document.getElementById('popup-modal').style.display='none'" class="close" >x</span>
    <img src="../Images/logo.jpg" alt="" class="bkgr">
    <h1 style="text-align:center; color:red">S'inscrire</h1>


    </div>

    <div class="container">

    <label for="">Images</label>
    <input name="picture" class="ingin" type="file" placeholder="Sélectionner une image">

    <label for="">Nom </label>
    <input class="ingin" type="text" placeholder="Nom complet" name="nom">

    <label for="">Prénom </label>
    <input class="ingin" type="text" placeholder="Nom complet" name="pren">

    <label for="">Email</label>
    <input class="ingin" type="text" placeholder="Email" name="eml">

    <label for="">Mot de passe</label>
    <input class="ingin" type="password" placeholder="Mot de passe" name="pass">

    <label for="">Nom d'utilisateur</label>
    <input class="ingin" type="text" placeholder="Nom d'utilisateur" name="uname">

    <button class="login" type="submit" name="sign">S'inscrire</button>
    <input type="checkbox" style="margin:26px 30px">Remember me
    <a href="#" style="text-decoration:none; float:right; margin-right:34px;margin-top:26px;color:red">Mot de passe oublié!</a>

    </div>


    </form>

    </div>

<main>
    <h1>CONNAITRE PLUS A PROPOS DE L'AUTO AVEC ALI' <span>AUTO</span></h1>
    <div class="cars">
        <div><img src="../Images/brabus-g63.jpg"> </div>
        <div><img src="../Images/gt500.jpg"></div>
        <div><img src="../Images/Rpha.jpg"></div>
    </div>

</main>

    <section class="allcard">
        <div class="card">
            <div class="card-image"></div>
            <div class="card-text">
                <span class="date"> Il y'a 4 jours</span>
                <h2>Audi Rs3</h2>
                <p class="clr">Audi est le seul constructeur restant à proposer 
                    encore un 5 cylindres. Il équipe les roadster et coupé TT-RS,
                    mais également la RS3. À l'occasion de son restyling, 
                    la berline gagne en puissance et récupère son titre de berline 
                    compacte la plus puissante du marché avec 400 ch...</p>
            </div>
            <div class="card-button">
                <a href="http://localhost/blogphp/Article/detail.php?id=48"><button class="btncard">Consulter les articles</button></a>
            </div>
        </div>

        <div class="card">
            <div class="card-image2"></div>
            <div class="card-text">
                <span class="date"> Il y'a 2 jours</span>
                <h2>Hyundai Tucson</h2>
                <p class="clr">Après bientôt 3 années de carrière, 
                    le Tucson, best-seller de la marque Hyundai, 
                    a droit au traditionnel restylage. 
                    Beaucoup de changement, dehors, dedans, mais aussi sous le capot, 
                    avec l'apparition d'une micro hybridation. 
                    Le but : contenir la consommation et les émissions de CO2,...</p>
            </div>
            <div class="card-button">
            <a href="http://localhost/blogphp/Article/detail.php?id=47"><button class="btncard">Consulter les articles</button></a>
            </div>
        </div>

        <div class="card">
            <div class="card-image3"></div>
            <div class="card-text">
                <span class="date"> Il y'a 1 jour</span>
                <h2>Golf 7 R-line</h2>
                <p class="clr">Volkswagen vient d'associer son pack R-Line à sa Golf 7. 
                    Il est constitué de trois packs permettant de modifier le châssis, 
                    l'extérieur et l'intérieur de la berline compacte Le pack R-Line
                    de Volkswagen a pour finalité de renforcer l'allure sportive d'un mo...</p>
            </div>
            <div class="card-button">
            <a href="http://localhost/blogphp/Article/detail.php?id=46"><button class="btncard">Consulter les articles</button></a>
            </div>
        </div>

    </section>
    <hr>

<section class="end">
<h3>PLUS  DE  <span>RESSOURCES</span></h3>
    <div class="row">
    <ul>
        <h4>Nouveautés</h4>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/lalfa-romeo-tonale-de-serie-se-devoile-lheure-221659.html#item=1">Alfa Romeo Tonale 2020</a></li>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/nouveautes-auto-2019-2020/aston-martin-dbx-2019-infos-photos-officielles-225037.html#item=1">Aston Martin DBX 2020</a></li>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/nouveautes-auto-2019-2020/ferrari-roma-2019-elegance-a-litalienne-224504.html#item=1">Ferrari Roma 2020</a></li>
        <li><a class="list" href="https://www.auto-moto.com/green/ford-mustang-mach-e-toutes-infos-officielles-suv-electrique-224825.html#item=1">Ford Mustang Mach-E 2020</a></li>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/scoop/nouvelle-audi-a3-2020-inquieter-futures-rivales-229837.html#item=1">Future Audi A3 2020</a></li>
        <li><a class="list" href="https://www.auto-moto.com/marques-auto/citroen/actualites-citroen/citroen-gs-ln-cx-retour-appellations-historiques-225631.html#item=1">Citroen GS 2020</a></li>
    </ul>

    <ul>
        <h4>Populaires</h4>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/toyota-corolla-trek-break-enfile-tenue-de-randonneur-220577.html#item=1">Toyota Corolla</a></li>
        <li><a class="list" href="https://www.auto-moto.com/occasion/ford-fiesta-5-doccasion-lalternative-209744.html#item=1">Ford F-Series</a></li>
        <li><a class="list" href="https://www.auto-moto.com/nouveautes/nouvelle-volkswagen-golf-8-lon-sait-revelation-222738.html#item=1">Volkswagen Golf</a></li>
        <li><a class="list" href="https://www.auto-moto.com/actualite/environnement/volkswagen-passat-gte-passation-de-pouvoir-tendance-verte-video-44440.html#item=1">Volkswagen Passat</a></li>
        <li><a class="list" href="https://www.auto-moto.com/occasion/occasion-passion/ford-escort-cosworth-occasion-video-avis-cote-frais-fiabilite-fiche-technique-52058.html#item=1">Ford Escort</a></li>
        <li><a class="list" href="https://www.auto-moto.com/essais/honda-civic-cette-dixieme-generation-merite-t-10-76470.html#item=1">Honda Accord</a></li>
    </ul>

    <ul>
        <h4>Auto ressources</h4>
        <li><a class="list" href="https://www.autoblog.com/research/">New car research tools</a></li>
        <li><a class="list" href="https://www.autoblog.com/car-finder/">Car finder</a></li>
        <li><a class="list" href="https://www.autoblog.com/cars-compare/">Compare cars</a></li>
        <li><a class="list" href="https://www.autoblog.com/cars-for-sale/vcond-New">New cars for sale</a></li>
        <li><a class="list" href="https://www.autoblog.com/car-dealers/">Dealers near you</a></li>
        <li><a class="list" href="https://www.autoblog.com/calculators/">Calculators</a></li>
    </ul>

    <ul>
        <h4>Ressources Auto occasion</h4>
        <li><a class="list" href="https://www.autoblog.com/car-finder/2017-2019/">Populaires 2017/2018</a></li>
        <li><a class="list" href="https://www.autoblog.com/car-values/">Location Auto</a></li>
        <li><a class="list" href="https://www.autoblog.com/cars-for-sale/vcond-Used">Ressources vente auto</a></li>
        <li><a class="list" href="https://www.autoblog.com/buy/certified-used-cars/">Détail auto</a></li>
    </ul>

    </div>


</section>


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




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.cars').bxSlider();
        });

    </script>
</body>
</html>