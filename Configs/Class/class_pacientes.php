<?php
class Pacientes{
    public static function getPacientes(){
        $SQLQuantidade = "SELECT * FROM pacientes";
        $qtItem = mysqli_num_rows(mysqli_query(Database::DB(),$SQLQuantidade));
        //
        if($_GET['page'] == 1){
            $limit = " LIMIT 10";
        }else{
            $limit = " LIMIT ".($_GET['page'] -1) * 10 .",10";
        }
        $SQL = "SELECT * FROM pacientes $limit";
        //
        $return = array(
            "rows" => mysqli_query(Database::DB(),$SQL),
            "quantidadeItens" => ceil($qtItem),
            "debug"=> $SQL
        );
        return $return;
    }
}
