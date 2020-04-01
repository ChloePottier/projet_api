<?php 
require_once ('bdd.php');

//fonction : Liste de toutes les lunettes
function get_list_lunettes($bdd,$id){
    //la requete
    $sqlListLunettes = " SELECT * FROM lunettes WHERE id_modele_lunette= ".$id."";
    $reqListLunettes = $bdd->query($sqlListLunettes);
    // création d'un tableau qui va contenir la liste des lunettes
    $ListLunettes = array();
    //On éxécute la réquête
    while($resListLunettesFinal = $reqListLunettes->fetch(PDO::FETCH_OBJ)){
         //on ajoute toutes les lunettes dans notre tableau
        array_push($ListLunettes, array("ref_lunettes" => $resListLunettesFinal->ref_lunettes, "col_lunettes" => $resListLunettesFinal->col_lunettes)); 
    }
    
    return $ListLunettes;
}

function get_list_modeles_lunettes($bdd){
    //la requete
    $sqlListModeleLunettes = " SELECT * FROM modele_lunettes";
    $reqListModeleLunettes = $bdd->query($sqlListModeleLunettes);
    // création d'un tableau qui va contenir la liste des lunettes
    $ListModeleLunettes = array();
    //On éxécute la réquête
    while($resListLunettesFinal = $reqListModeleLunettes->fetch(PDO::FETCH_OBJ)){
         //on ajoute toutes les lunettes dans notre tableau
        array_push($ListModeleLunettes, array("id"=>$resListLunettesFinal->id_modele_lunettes, "modele_lunettes" => $resListLunettesFinal->nom_modele_lunettes)); 
    }
    return $ListModeleLunettes;
}

function get_list_modeles_clips($bdd,$id){
    //la requete
    $sqlListModeleClip = " SELECT * FROM `modele_clips` WHERE `id_modele_lunettes`=".$id." ";
    $reqListModeleClip = $bdd->query($sqlListModeleClip);
    // création d'un tableau qui va contenir la liste des lunettes
    $ListModeleClip = array();
    //On éxécute la réquête
    while($resListClipFinal = $reqListModeleClip->fetch(PDO::FETCH_OBJ)){
         //on ajoute toutes les lunettes dans notre tableau
        array_push($ListModeleClip, array("ref_clip" => $resListClipFinal->ref_modele_clip)); 
    }
    return $ListModeleClip;
}

// je définis les url possibles et je les mets dans un tableau
$possibles_url = array('get_list_lunettes', 'get_list_modeles_lunettes', 'get_list_modeles_clips');
// on déclare une var $value qui va d'abord prendre en valeur un msg d'erreur 
$value = "Une erreur est survenue";
// si ?action = existe et dans le tableau $possibles_url aussi alors :
if(isset($_GET['action']) && in_array($_GET['action'], $possibles_url)){
    //on compare la meme variable $_GET['action']
    switch ($_GET['action']){
        // si on a ?action=get_list_lunettes alors 
        case "get_list_lunettes": 
            // $value est égale au résultat de la fonction
            if(isset($_GET['id']))  $value = get_list_lunettes($bdd,$_GET['id']);
            break;
        case "get_list_modeles_lunettes": 
            // $value est égale au résultat de la fonction
            $value = get_list_modeles_lunettes($bdd); 
            break;
        case "get_list_modeles_clips": 
            // $value est égale au résultat de la fonction
            if(isset($_GET['id']))  $value = get_list_modeles_clips($bdd,$_GET['id']);

            // $value = get_list_modeles_clips($bdd,$id); 
            break;
    }
}

// on met la variable de nos résultats au format json
exit(json_encode($value));
