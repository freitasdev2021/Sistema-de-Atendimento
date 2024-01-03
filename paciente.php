<?php
include"Configs/Includes/header.php";
?>
<div class="formPacientes">
    <form id="formPacientes">
        <div class="headerPaciente">
            <a href="index.php" class="btn-voltar">Voltar</a>
        </div>
        <!--DADOS DO PACIENTE-->
        <div class="dadosPaciente">
            <span>
                <label for="nomePaciente">Nome Paciente</label>
                <input type="name" id="nomePaciente" name="nomePaciente">
            </span>
            <span>
                <label for="dataNascimento">Data de Nascimento</label>
                <input type="name" id="dataNascimento" name="dataNascimento">
            </span>
            <span>
                <label for="cpfPaciente">CPF</label>
                <input type="name" id="cpfPaciente" name="cpfPaciente">
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
                    <option value="1">Esmeralda Figueroa Barbalho</option>
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
                <input name="procedimentosSolicitacao" id="procedimentosSolicitacao">
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