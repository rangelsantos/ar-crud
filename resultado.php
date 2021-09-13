<?php include "layout/header.html" ?>

<?php
if (isset($_GET["message"])) {
    $format_mensagem = '<div>Mensagem: %s</div>';
    printf($format_mensagem, $_GET["message"]);
}
?>

<?php include "layout/footer.html" ?>