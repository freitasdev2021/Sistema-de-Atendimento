<?php
require"Database/db.php";
require"Class/class_solicitacoes.php";
switch($_POST['funcao']){
    case 'setSolicitacao':
       echo Solicitacoes::setSolicitacao($_POST);
    break;
}