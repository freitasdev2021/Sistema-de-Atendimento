<?php
require"./Configs/Database/db.php";
require"./Configs/Class/class_sitcon.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/headerfooter.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/paciente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sitcon Teste</title>
</head>
<body>
<main>
    <header>
        <nav>
            <button class="btn-sitcon font-label <?=(basename($_SERVER['PHP_SELF']) == "index.php") ? 'pageSelected' : ''?>" onclick="window.location.href='index.php'">Solicitações Clinicas</button>
            <button class="btn-sitcon font-label <?=(basename($_SERVER['PHP_SELF']) == "listasolicitacoes.php") ? 'pageSelected' : ''?>" onclick="window.location.href='listasolicitacoes.php'">Listagem de Solicitações</button>
        </nav>
    </header>