<?php

require_once "DatabaseConnexion.php";

session_start();

function verifyTokenCorrespondance() {
    if(!isset($_POST['tokenArticle']) || ($_POST['tokenArticle']!== $_SESSION['tokenArticle'])){
        return FALSE;
    } else {
        return TRUE;
    }
    unset($_SESSION['tokenArticle']);
}

// reception et verification des champs
if(isset($_POST['title']) && !empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
} else {
    echo "title needed";
}

if(isset($_POST['content']) && !empty($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
} else {
    echo "content needed";
}

if(isset($_POST['slug']) && !empty($_POST['slug'])) {
    $slug = htmlspecialchars($_POST['slug']);
} else {
    echo "slug needed";
}

// verification de la non existance du slug
function verify_slug($pdo, $title, $content, $slug) {
    $verify_slug = $pdo->prepare('SELECT * FROM articles WHERE slug = :slug');
    $verify_slug->execute(['slug' => $slug]);

    if ($verify_slug->rowCount() > 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

// ajouter un article
function addArticle($pdo, $title, $content, $slug) {
    $addArticle = $pdo->prepare('INSERT INTO articles (title, content, slug) VALUES(:title, :content, :slug)');
    $addArticle->execute([
        'title' => $title,
        'content' => $content,
        'slug' => $slug
    ]);
}

// verification de reception de contenu avant envoie en base
if (isset($title) && isset($content) && isset($slug)) { 
    $tokenValidation = verifyTokenCorrespondance();
    $slugValidation = verify_slug($pdo, $title, $content, $slug);
    if ($tokenValidation === TRUE && $slugValidation === TRUE) {
        addArticle($pdo, $title, $content, $slug);
        header('Location: index.php');
    } else {
        echo "tokenValidation : $tokenValidation <br>";
        echo "slugValidation : $slugValidation <br>";
    }
}

?>
