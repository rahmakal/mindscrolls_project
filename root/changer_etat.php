<?php
    session_start();
    include("bd.php");
    if (isset($_GET['id_livre'])) {
        $idLivre = $_GET['id_livre'];
        $check=mysqli_query($con,"SELECT etat from livre where id_livre=$idLivre");
        $etat=mysqli_fetch_assoc($check);
        if($etat['etat']=="disponible"){
            $sql = "UPDATE livre SET etat = 'indisponible' WHERE id_livre = $idLivre";
        }
        else{
            $sql = "UPDATE livre SET etat = 'disponible' WHERE id_livre = $idLivre";
        }
        if (mysqli_query($con, $sql)) {
            
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            echo "Erreur lors de la mise à jour de l'état du livre : " . mysqli_error($con);
        }
    } else {
        
        header("Location: erreur.php");
        exit();
    }
?>
