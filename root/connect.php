<?php
    session_start();
    include("bd.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["email"];
        $pwd=$_POST["password"];
        if(!empty($email) && !empty($pwd) && !is_numeric($email)){
            $query="select * from user where email='$email' limit 1";
            $result=mysqli_query($con,$query);
            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $userdata=mysqli_fetch_assoc($result);
                    if($userdata['password']==$pwd && $userdata['role']=='membre'){
                        $_SESSION["id_user"]=$userdata['id_user'];
                        header("location: livre.php");
                        die;
                    }
                    if($userdata['password']==$pwd && $userdata['role']=='admin'){
                        header("location: bib.php");
                        die;
                    }
                }
            }
            echo "<script type='text/javascript'> alert('Veuillez vérifier vos informations')</script>";
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
    <title>Connexion - MindScrolls</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="connect.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Inscription</a>
                </li>
            </ul>
            
        </div>
    </nav>
    <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark">
                    <div class="card-header">Connexion à MindScrolls</div>
                    <div class="card-body ">
                        <form method="POST">
                            <br>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Adresse mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse mail" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Mot de passe</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block btn-info">Se connecter</button>
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
