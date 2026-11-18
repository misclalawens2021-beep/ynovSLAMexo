<h3> Changement de MDP </h3> <!-- Titre de niveau 3 du formulaire -->

<form method="POST"> <!-- Formulaire envoyé en POST (données non visibles dans l'URL) -->
    <!-- ID utilisateur: <br>
    <input type="text" name=""><br> --> <!-- Ancien champ ID utilisateur, désactivé -->
    New MDP: <br> <!-- Libellé du nouveau mot de passe + retour à la ligne -->
    <input type="password" name="mdp1"><br> <!-- Champ masqué du nouveau MDP (lu via $_POST['mdp1']) -->
    Confirmation MDP : <br> <!-- Libellé de la confirmation + retour à la ligne -->
    <input type="password" name="mdp2"> <br> <!-- Champ masqué de confirmation (lu via $_POST['mdp2']) -->

    <input type="hidden" name="email" value="<?= $email ?>"> <!-- Champ caché : transmet l'email de l'utilisateur connecté ($email défini dans index.php) -->
    <input type="submit" name="Modifier" value="Modifier"> <!-- Bouton d'envoi ; son nom 'Modifier' sert de test dans index.php -->
</form> <!-- Fin du formulaire -->