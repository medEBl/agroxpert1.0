<?php
include '../../../controller/reponsecontroller.php';
$ReclamationC = new ReponseController();
$ReclamationC->deleteReponse($_GET["id_reponse"]);
header('Location:list_reponse.php');
exit;
?>