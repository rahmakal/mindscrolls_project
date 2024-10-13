<?php
    session_start();
    include("bd.php");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $prenom=$_POST["firstname"];
        $nom=$_POST["lastname"];
        $email=$_POST["email"];
        $pwd=$_POST["password"];
        if(!empty($email) && !empty($pwd) && !is_numeric($email)){
            $query="insert into user (prenom,nom,email,password) values('$prenom','$nom','$email','$pwd')";
            mysqli_query($con,$query);
            header("location: connect.php");
        }
        else{
            echo "<script type='text/javascript'> alert('Veuillez vérifier vos informations')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MindScrolls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-image">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-book-open-reader"></i> MindScrolls</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connect.php">Connexion</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Inscription</a>
                </li>
            </ul>
            
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark">
                    <div class="card-header">Inscription à MindScrolls</div>
                    <div class="card-body">
                        <form method="POST" style="padding:0 20px 0 20px;">
                            <div class="form-group row">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Entrez votre prénom">
                            </div>
                            <div class="form-group row">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="lastname" id="lastName" placeholder="Entrez votre nom">
                            </div>
                            <div class="form-group row">
                                <label for="email">Adresse e-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse e-mail" required>
                            </div>
                            <div class="form-group row">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" name="password" id ="password" placeholder="Entrez votre mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-info">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 ">
        <div class="container text-center">
            <span>© 2024 MindScrolls. Tous droits réservés.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
