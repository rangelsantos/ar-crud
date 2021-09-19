<?php 
include "layout/header.html";
include "menu.php";
include "session.php";

if (isset($_GET["message"])) {
    $format_mensagem = '<div>Mensagem: %s</div>';
    printf($format_mensagem, $_GET["message"]);
}

include "layout/footer.html" ?>