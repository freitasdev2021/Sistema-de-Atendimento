<?php
class Pacientes{
    //PEGA LISTA E FILTRA OS PACIENTES
    public static function getPacientes($pesquisa){
        //CONSULTA DE PESQUISA
        $whereSearch = '';
        if(!empty($pesquisa)){
            $whereSearch = ' WHERE nome LIKE "%'.$pesquisa.'%" OR CPF LIKE "%'.$pesquisa.'%" ';
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
        $SQLQuantidade = "SELECT * FROM pacientes $whereSearch"; //CONSULTA ESCRITA DA QUANTIDADE
        $qtItem = mysqli_num_rows(mysqli_query(Database::DB(),$SQLQuantidade)); // QUERY DA QUANTIDADE
        $SQL = "SELECT * FROM pacientes $whereSearch $limit"; //CONSULTA ESCRITA TOTAL
        //
        $return = array(
            "rows" => mysqli_query(Database::DB(),$SQL),
            "quantidadeItens" => ceil($qtItem),
            "debug"=> $SQL
        );
        return $return;
    }
    //PEGA OS DADOS DO PACIENTE
    public static function getPaciente($ID){
        $SQL = "SELECT * FROM pacientes WHERE id = $ID";
        return mysqli_fetch_assoc(mysqli_query(Database::DB(),$SQL));
    }
}
