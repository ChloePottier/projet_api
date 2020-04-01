
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
                if(isset($_GET['action'])){

                } else { // sinon : si $_GET['action'] n'existe pas (donc client.php)
                    $ListModeleLunettes = file_get_contents("http://localhost/api_zenka/api.php?action=get_list_modeles_lunettes");
                    $ListModeleLunettes = json_decode($ListModeleLunettes, true); 
                    echo "<h2>Listing de toutes les montures</h2>";
                    echo "<div class='row bold'><div class='modele_lunettes'>Modèles de lunettes</div></div>";
                    foreach($ListModeleLunettes as $lunettes):
                    echo "<div class='row'><div class='modele_lunettes'>".$lunettes['modele_lunettes']."</div></div>";
                    endforeach;
                }
                        ?>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>