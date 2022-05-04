<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

$vagas = Vaga::getVagas();
$obVaga = new Vaga;
$listaVaga = $obVaga::getVagas();
// echo "<pre>"; print_r($vagas); echo "</pre>"; exit;

require __DIR__ . '/INCLUDES/header.php';

require __DIR__ . '/INCLUDES/listagem.php';

require __DIR__ . '/INCLUDES/footer.php';
?>