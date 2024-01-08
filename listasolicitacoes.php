<?php
include"Configs/Includes/header.php";
require"Configs/Class/class_solicitacoes.php";
?>
<div class="table-sitcon-solicitacoes">
    <form id="pesquisa" action="listasolicitacoes.php" method="GET">
        <i class="fa fa-search"></i><input type="search" name="pesquisar" value="<?=(isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '' )?>" placeholder="Pesquisar">
    </form>
    <table>
        <thead class="font-label">
            <tr>
                <th>Paciente</th>
                <th>CPF</th>
                <th>Tipo de Solicitação</th>
                <th>Procedimentos</th>
                <th>Data e Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //echo Solicitacoes::getSolicitacoes((isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '' ))['debug'];
            $QuantidadeItens = Solicitacoes::getSolicitacoes((isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '' ))['quantidadeItens'];
            $linksPaginaveis = ceil($QuantidadeItens/10);
            foreach(Solicitacoes::getSolicitacoes((isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '' ))['rows'] as $p){
            ?>
            <tr>
                <td><?=$p['paciente']?></td>
                <td><?=Sitcon::cpfCnpj($p['CPF'],'###.###.###-###')?></td>
                <td><?=$p['tipo']?></td>
                <td><?=($p['tipo_id'] == 2) ? implode(",",json_decode($p['Procedimentos'],true)) : $p['Procedimentos'] ?></td>
                <td><?=Sitcon::data($p['data']." ".$p['hora'],'d/m/Y - H:i')?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <span id="pagination">
         <ul>
         <li id="back" style="font-size:1.1em"><a href='listasolicitacoes.php<?=(isset($_GET['pesquisar']) ? '?pesquisar='.$_GET['pesquisar']."&page=1" : '?page=1' )?>' class='linkUnselected'><</a></li>
            <?php
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $primeiraPagina = max($page - 3,1);
            $ultimaPagina = min($QuantidadeItens,$page + 3);
            
            for($i=$primeiraPagina;$i<=$ultimaPagina;$i++){
                $active = "class=\"linkUnselected\"";
                if($page == $i){
                    $active = "class=\"linkSelected\"";
                }
                if($i <= $linksPaginaveis){
                ?>
                    <li><a href='listasolicitacoes.php<?=(isset($_GET['pesquisar']) ? '?pesquisar='.$_GET['pesquisar'].'&page='.$i : '?page='.$i )?>' <?=$active?>><?=$i?></a></li>
                <?php 
                }
            }
            ?>
        <li id="next" style="font-size:1.1em"><a href='listasolicitacoes.php<?=(isset($_GET['pesquisar']) ? '?pesquisar='.$_GET['pesquisar'].'&page='.$linksPaginaveis : '?page='.$linksPaginaveis )?>' class='linkUnselected'>></a></li>
        </ul>
    </span>
</div>
<?php
include"Configs/Includes/footer.php";
?>