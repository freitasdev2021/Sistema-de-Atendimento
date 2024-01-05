<?php
include"Configs/Includes/header.php";
require"Configs/Class/class_pacientes.php";
// for($i=0;$i<1000;$i++){
//     mysqli_query(Database::DB(),"insert into pacientes (nome, dataNasc, CPF, status) values ('PACIENTE_$i','2000-08-10', 21029829309, 'ativo')");
// }
if(!isset($_GET['page'])){
header("location:index.php?page=1");
}
?>
<div class="table-sitcon">
    <span id="pesquisa">
        <i class="fa fa-search"></i><input type="search" name="pesquisar" placeholder="Pesquisar">
    </span>
    <table>
        <thead class="font-label">
            <tr>
                <th>Paciente</th>
                <th>Nascimento</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo Pacientes::getPacientes()['debug'];
            $QuantidadeItens = Pacientes::getPacientes()['quantidadeItens'];
            $linksPaginaveis = ceil($QuantidadeItens/10);
            foreach(Pacientes::getPacientes()['rows'] as $p){
            ?>
            <tr>
                <td><?=$p['nome']?></td>
                <td><?=Sitcon::data($p['dataNasc'],'d/m/Y')?></td>
                <td><?=Sitcon::cpfCnpj($p['CPF'],'###.###.###-###')?></td>
                <td><a href="paciente.php?ID=<?=$p['id']?>" class="btn-prosseguir">Prosseguir</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <span id="pagination">
         <ul>
            <li id="back" style="font-size:1.1em"><a href='index.php?page=1' class='linkUnselected'><</a></li>
            <?php
            $primeiraPagina = max($_GET['page'] - 3,1);
            $ultimaPagina = min($QuantidadeItens,$_GET['page'] + 3);
            
            for($i=$primeiraPagina;$i<=$ultimaPagina;$i++){
                $active = "class=\"linkUnselected\"";
                if($_GET['page'] == $i){
                    $active = "class=\"linkSelected\"";
                }
                if($i <= $linksPaginaveis){
                    echo "<li><a href='index.php?page=$i' $active >$i</a></li>";  
                }
            }
            ?>
            <li id="next" style="font-size:1.1em"><a href='index.php?page=<?=$linksPaginaveis?>' class='linkUnselected'>></a></li>
        </ul>
    </span>
</div>
<?php
include"Configs/Includes/footer.php";
?>