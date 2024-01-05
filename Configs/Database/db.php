<?php
class Database{
    public static function DB(){
        return mysqli_connect('localhost','root','','desafiositcon');
    }
}