<?php

if(!isset($_SESSION ['tokenArticle']) || empty($_SESSION ['tokenArticle'])){
    $_SESSION['tokenArticle'] = bin2hex(random_bytes(32));
}

?>