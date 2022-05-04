<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

//Validação do ID
if (!isset($_GET['id'])  || !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//Consulta Vaga
$obVaga = Vaga::getVaga($_GET['id']);
// echo "<pre>"; print_r($obVaga); echo "<pre>"; exit;

//Validação da Vaga
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}
//Validação do POST
if (isset($_POST['excluir'])) {

    $obVaga->excluir();

    header('location: index.php?status=error');
    exit;
}

require __DIR__ . '/INCLUDES/header.php';
require __DIR__ . '/INCLUDES/confirmarExclusao.php';
require __DIR__ . '/INCLUDES/footer.php';
