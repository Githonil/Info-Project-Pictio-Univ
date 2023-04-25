<?php
    include("./php/connect_check.php");
    include("./php/force_unaccess.php");
    include("./php/email.php");
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Gestion des emails</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link rel="stylesheet" type="text/css" href="./styles/email.css">
    </head>
    <body>
        <header>
            <img src="./images/logo.svg" alt="Logo">
        </header>
        <main>
            <section class="email">
                <form method="POST">
                    <h1>Gestion des emails</h1>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Vos emails</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Supprimer</th>
                                <th>Email</th>
                            </tr>
                            <?php
                                $id_player = $_SESSION["id"];
                                $request = "SELECT email.id_mail, email.mail FROM email
                                                WHERE email.id_player = $id_player;";

                                $result = @($db->query($request));

                                while (($row = $result->fetch_assoc()) !== null) {
                                    ?>

                                    <tr>
                                        <td>
                                            <input type="checkbox" name="remove_emails[]" value=<?= $row["id_mail"]; ?>>
                                        </td>
                                        <td><?= $row["mail"]; ?></td>
                                    </tr>

                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php if (!$remove_no_error) echo "<p class=\"error\">Impossible de supprimer votre seul email !</p>"; ?>

                    <label>
                        Ajout d'email :
                        <input type="email" name="email" placeholder="prenom.nom@etu.univ-tours.fr">
                    </label>
                    <?php if (!$email_no_error) echo "<p class=\"error\">L'email a déjà été enregistrer !</p>"; ?>

                    <label>
                        Confimation de l'identité, saisissez votre mot de passe :
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </label>
                    <?php if (!$password_no_error) echo "<p class=\"error\">Le mot de passe est incorrect !</p>"; ?>

                    <input type="submit" name="submit" value="Modifier">
                </form>

                <a href="./account.php">Retour au compte</a>
            </section>
        </main>
    </body>
</html>

<?php
    close_dataBase($db);
?>