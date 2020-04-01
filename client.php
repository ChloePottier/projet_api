
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Zenka</title>
</head>
<body>
    <header>
    </header>
    <div class="container-fluid">
        <div class="container">
        <?php
                    //si $_GET['action'] existe
                if(isset($_GET['action']) && $_GET["action"] == "get_list_lunettes"){
                    //on récupère le contenu du lien
                    $ListLunettes = file_get_contents("http://localhost/api_zenka/api.php?action=get_list_lunettes&id=".$_GET['id']."");
                    // on décode le fichier json
                    $ListLunettes = json_decode($ListLunettes, true); 
                    $ListModeleClip = file_get_contents("http://localhost/api_zenka/api.php?action=get_list_lunettes&id=".$_GET['id']."");
                    $ListModeleClip = json_decode($ListModeleClip, true);
                    echo "<h2>Listing de toutes les montures du modèle</h2>";
                    echo"<div class='col-6'>";
                        echo "<div class='row bold'><div class='ref_lunettes'>Référence</div> <div class='col_lunettes'>Coloris</div></div>";
                        foreach($ListLunettes as $lunettes2):
                        echo "<div class='row'><div class='ref_lunettes'>".$lunettes2['ref_lunettes']."</div><div  class='col_lunettes'>".$lunettes2['col_lunettes']."</div></div>";
                        endforeach;
                    echo"</div>";
                    // echo "<div col-6>"
                    //     echo "<div class='row bold'><div class='ref_lunettes'>Référence</div> <div class='col_lunettes'>Coloris</div></div>";
                    //     foreach($ListModeleClip as $clip):
                    //     echo "<div class='row'><div class='ref_lunettes'>".$clip['ref_lunettes']."</div><div  class='col_lunettes'>".$clip['col_lunettes']."</div></div>";
                    //     endforeach;
                    // echo "</div>";
                    
                } else { // sinon : si $_GET['action'] n'existe pas (donc client.php)
                    $ListModeleLunettes = file_get_contents("http://localhost/api_zenka/api.php?action=get_list_modeles_lunettes");
                    $ListModeleLunettes = json_decode($ListModeleLunettes, true); 
                    echo "<h2>Listing de toutes les montures</h2>";
                    echo "<div class='row bold'><div class='modele_lunettes'>Modèles de lunettes</div></div>";
                    foreach($ListModeleLunettes as $lunettes):
                    echo "<div class='row'><div class='modele_lunettes'>".$lunettes['modele_lunettes']."</div><a href='http://localhost/api_zenka/client.php?action=get_list_lunettes&id=".$lunettes['id']."'> voir toutes les montures</a></div>";
                    endforeach;
                }
                        ?>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>