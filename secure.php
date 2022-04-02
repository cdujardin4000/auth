<?php
// Initialisation ou reprise de session session_start();

// On vérifie si l'utilisateur est identifié
if ( !isset( $_SESSION['pseudo'] )) {
    // La variable de session n’existe pas,
    // donc l'utilisateur n'est pas authentifié!
    // On le redirige sur la page permettant de s’authentifier.
    header('Location: auth.php') ;
    // On arrête l'exécution.
    exit();
}

