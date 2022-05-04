<?php
require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Cadastrar Vaga');

use \App\Entity\Vaga;

$obVaga = new Vaga;

// echo "<pre>"; print_r($_POST['descricao']); echo "</pre>"; exit;
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['status'])) {

    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->status = $_POST['status'];

    $obVaga->cadastrar();
    // echo "<pre>"; print_r($obVaga); echo "</pre>"; exit; 

    header('location: index.php?status=success');
    exit;
}

require __DIR__ . '/INCLUDES/header.php';

require __DIR__ . '/INCLUDES/formulario.php';

require __DIR__ . '/INCLUDES/footer.php';
