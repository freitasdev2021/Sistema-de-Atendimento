<?php
include"Configs/Includes/header.php";
require"Configs/Class/class_pacientes.php";
require"Configs/Class/class_solicitacoes.php";
$paciente = Pacientes::getPaciente($_GET['ID']);
// echo "<pre>";
// print_r($paciente);
// echo "</pre>";
?>
<div class="formPacientes">
    <form id="formPacientes">
        <div class="headerPaciente">
            <a href="index.php" class="btn-voltar font-label">Voltar</a>
        </div>
        <!--DADOS DO PACIENTE-->
        <div class="dadosPaciente">
            <span>
                <label for="nomePaciente">Nome Paciente</label>
                <input value='<?=$paciente['nome']?>' disabled>
            </span>
            <span>
                <label for="dataNascimento">Data de Nascimento</label>
                <input value='<?=Sitcon::data($paciente['dataNasc'],'d/m/Y')?>' disabled>
            </span>
            <span>
                <label for="cpfPaciente">CPF</label>
                <input value='<?=Sitcon::cpfCnpj($paciente['CPF'],'###.###.###-##')?>' disabled>
            </span>
        </div>
        <!--ALERTA-->
        <div id="alerta">
            <span>
                <b>Atenção!</b><p>&nbsp;Os Campos com * devem ser preenchidos obrigatoriamente.</p>
            </span>
        </div>
        <!--ESCOLHA DO PROFISSIONAL-->
        <div class="escolhaProfissional">
            <span>
                <label for="escolhaProfissional">Profissional*</label>
                <select name="escolhaProfissional" id="escolhaProfissional">
                    <?php 
                    foreach(Solicitacoes::getProfissionais() as $prof){
                        echo "<option id='".$prof['id']."'>".$prof['nome']."</option>";
                    }
                    ?>
                </select>
            </span>
        </div>
        <!--TIPO DE SOLICITAÇÃO,PROCEDIMENTOS,DATA,HORA-->
        <div class="dadosProcedimento">
            <span>
                <label for="tipoSolicitacao">Tipo de Solicitação*</label>
                <select name="tipoSolicitacao" id="tipoSolicitacao">
                    <option value="">Exames Laboratoriais</option>
                </select>
            </span>
            <span>
                <label for="procedimentosSolicitacao">Procedimentos*</label>
                <input name="procedimentosSolicitacao" id="procedimentosSolicitacao" type="text">
                <ul class="list-items" id="procedimentos">
                    <?php
                    foreach(Solicitacoes::getProcedimentos() as $proc){
                    ?>
                    <li class="item">
                        <input type="checkbox" name="procedimento" value="<?=$proc['descricao']?>" data-id='<?=$proc['id']?>' data-tipo='<?=$proc['tipo_id']?>'>&nbsp;<?=$proc['descricao']?>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </span>
        </div>
        <div class="dadosProcedimento">
            <span>
                <label for="dataSolicitacao">Data*</label>
                <input type="date" name="dataSolicitacao" id="dataSolicitacao">
            </span>
            <span>
                <label for="horaSolicitacao">Hora*</label>
                <input type="time" name="horaSolicitacao" id="horaSolicitacao">
            </span>
        </div>
        <div class="footerPaciente">
            <button class="btn-salvar">Salvar</button>
        </div>
    </form>
</div>
<?php
include"Configs/Includes/footer.php";
?>