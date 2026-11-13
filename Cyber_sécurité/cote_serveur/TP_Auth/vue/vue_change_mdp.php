<h3> Changement de MDP </h3>

<form method="POST">
    <!-- ID utilisateur: <br>
    <input type="text" name=""><br> -->
    New MDP: <br>
    <input type="password" name="mdp1"><br>
    Confirmation MDP : <br>
    <input type="password" name="mdp2"> <br>

    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="submit" name="Modifier" value="Modifier">
</form>