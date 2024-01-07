<?php
class Solicitacoes{
    public static function getProfissionais(){
        $SQL = "SELECT * FROM profissional";
        return mysqli_query(Database::DB(),$SQL);
    }

    public static function getProcedimentos(){
        $SQL = "SELECT * FROM procedimentos";
        return mysqli_query(Database::DB(),$SQL);
    }
}