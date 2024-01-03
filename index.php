<?php
include"Configs/Includes/header.php";
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
            <tr>
                <td>Ellen Camila Klen Sales</td>
                <td>10/08/2001</td>
                <td>659.295.950-97</td>
                <td><a href="paciente.php" class="btn-prosseguir">Prosseguir</a></td>
            </tr>
        </tbody>
    </table>
    <span id="pagination">
         <ul>
            <li id="back" style="font-size:1.1em"><</li>
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>...</li>
            <li>10</li>
            <li id="next" style="font-size:1.1em">></li>
        </ul>
    </span>
</div>
<?php
include"Configs/Includes/footer.php";
?>