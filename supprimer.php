<?php
    session_start();
    include("bd.php");
    $idLivre = mysqli_real_escape_string($con, $_GET['id_livre']);
    $check=mysqli_query($con,"SELECT id_emprunt FROM emprunt WHERE id_livre = '$idLivre'");
    $query1="DELETE FROM emprunt WHERE id_livre = '$idLivre'";
    $query = "DELETE FROM livre WHERE id_livre = '$idLivre'";
    if(mysqli_query($con, $query1) && mysqli_query($con, $query)) {
        header('location:bib.php');
        die;
    } else {
        echo "Erreur lors de la suppression du livre : " . mysqli_error($con);
    }
?>