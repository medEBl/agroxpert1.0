<?php
include '../../../controller/reclamationcontroller.php';
$ReclamationC = new ReclamationController();
$ReclamationC->deleteReclamation($_GET["id"]);
header('Location:list_reclamations.php');
exit;
?>