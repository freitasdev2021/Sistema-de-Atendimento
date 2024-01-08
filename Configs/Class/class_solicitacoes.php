<?php
class Solicitacoes{
    //LISTAGEM DE PROFISSIONAIS
    public static function getProfissionais(){
        $SQL = "SELECT * FROM profissional";
        return mysqli_query(Database::DB(),$SQL);
    }
    //LISTAGEM DOS PROCEDIMENTOS
    public static function getProcedimentos($tipo){
        if($tipo == "exames"){
            $SQL = "SELECT * FROM procedimentos WHERE tipo_id = 2";
        }else{
            $SQL = "SELECT * FROM procedimentos WHERE tipo_id = 1";
        }
        
        return mysqli_query(Database::DB(),$SQL);
    }
    //LISTAGEM DOS TIPOS DE SOLICITAÇÃO
    public static function getTipoSolicitacao(){
        $SQL = "SELECT * FROM tiposolicitacao";
        return mysqli_query(Database::DB(),$SQL);
    }
    //SALVAR SOLICITAÇÃO
    public static function setSolicitacao($dados){
        try{
            $retorno =  "Enviado com Sucesso";
            extract($dados);
            mysqli_query(Database::DB(),"INSERT INTO solicitacoes (paciente_id,horaAtendimento,diaAtendimento,tipo_id,profissional_id,Procedimentos) VALUES('$paciente','$horaSol','$dataSol','$tipoSolicitacao','$profissional','$procedimentos')");
        }catch(\Throwable $th){
            $retorno = $th;
        }
        return $retorno;
    }
    //PEGA AS SOLICITACOES
    public static function getSolicitacoes($pesquisa){
        //CONSULTA DE PESQUISA
        $whereSearch = '';
        if(!empty($pesquisa)){
            $whereSearch = ' WHERE pacientes.nome LIKE "%'.$pesquisa.'%" OR CPF LIKE "%'.$pesquisa.'%" ';
        }
        //PAGINA ATUAL
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }
        //PERGUNTA O ESTADO DA PAGINA ATUAL
        if($page == 1){
            $limit = " LIMIT 10";
        }else{
            $limit = " LIMIT ".($page-1) * 10 .",10";
        }
        //CONSULTA ESCRITA RESULTANTE
        $SQLQuantidade = <<<SQL
        SELECT 
            pacientes.nome as paciente,
            diaAtendimento as data,
            horaAtendimento as hora,
            Procedimentos,
            CPF,
            tipo_id,
            tiposolicitacao.descricao as tipo
        FROM solicitacoes
        INNER JOIN pacientes ON(pacientes.id = solicitacoes.paciente_id)
        INNER JOIN tiposolicitacao ON(tiposolicitacao.id = solicitacoes.tipo_id) $whereSearch
        SQL; //CONSULTA ESCRITA DA QUANTIDADE
        $qtItem = mysqli_num_rows(mysqli_query(Database::DB(),$SQLQuantidade)); // QUERY DA QUANTIDADE
        $SQL = <<<SQL
        SELECT 
            pacientes.nome as paciente,
            diaAtendimento as data,
            horaAtendimento as hora,
            Procedimentos,
            CPF,
            tipo_id,
            tiposolicitacao.descricao as tipo
        FROM solicitacoes
        INNER JOIN pacientes ON(pacientes.id = solicitacoes.paciente_id)
        INNER JOIN tiposolicitacao ON(tiposolicitacao.id = solicitacoes.tipo_id) $whereSearch $limit
        SQL; //CONSULTA ESCRITA TOTAL
        //
        $return = array(
            "rows" => mysqli_query(Database::DB(),$SQL),
            "quantidadeItens" => ceil($qtItem),
            "debug"=> $SQL
        );
        return $return;
    }
}