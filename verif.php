<?php
// Gestion des erreurs
error_reporting(E_WARNING); //MODE dev
//error_reporting(0);         //MODE prod

// Initialisation de la session
session_start();

function verification($nom,$pass){
    // Connexion au serveur MySQL et sélection de la base de données
    if($link = mysqli_connect('localhost','root', 'root', 'gestion')) {
        // Nettoyage des données externes
        $nom = mysqli_real_escape_string($link, $nom);
        // Exécution de la requête SQL
        $result = mysqli_query($link, "SELECT * FROM users WHERE username='$nom'");

    if($result) {
        // Extraction des données
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result); // Libérer la mémoire

        if(password_verify($pass, $user['password'])) {
            mysqli_close($link); // Fermer la connexion au serveur
            return true;
        }
    }

    mysqli_close($link); // Fermer la connexion au serveur

    return false;

    }
}

// Si on a reçu les données d'un formulaire :
if ( !empty( $_POST['pseudo'] ) && !empty( $_POST['motdepasse'] ) ) {
    // On les récupère
    $pseudo = $_POST['pseudo']; $motdepasse = $_POST['motdepasse'];
    // On teste si le pseudo et le mot de passe sont valides :
    if ( verification( $pseudo, $motdepasse ) ) {
        // On sauvegarde le pseudo dans la session
    $_SESSION['pseudo'] = $pseudo; $message = 'Vous êtes correctement identifié.';
    } else {
        // Sinon on avertit l'utilisateur :
    $message = 'Login et/ou mot de passe incorrect';
    $message .='<a href="auth.php">Retour</a>';
    }
} else {
    // Un des champs n'est pas rempli
    $message = 'Le login ou le mot de passe est vide.';
    $message .='<a href="auth.php">Retour</a>';
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Identification</title>
</head>
<body>
    <p><?php echo $message ?></p>
</body>
</html>
