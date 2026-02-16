<?php 

session_start();
require_once "createAddToken.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="addArticle.php" method="POST">
            <fieldset>
                <legend>Utilisateur</legend>
                <input type="hidden" name="tokenArticle" value="<?php echo $_SESSION['tokenArticle'];?>">
                <input type="text" name="title" placeholder="Enter title">
                <input type="text" name="content" placeholder="Enter content">
                <input type="text" name="slug" placeholder="Enter slug">
            </fieldset>
            <input type="submit" value="Soumettre">
        </form>
    </main>
</body>
</html>