<?php

    class Database {

        //Zmiene do bazy danych
        private $host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "emsi";

        private $db;

        public function __construct() {
            try {
                $this->db = new PDO("mysql:dbname=$this->db_name;charset=utf8;host=$this->host", "$this->db_user", "$this->db_pass");
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->db;
            }
            catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        function selectFromDatabase($select) {
            if ($this->db) {
                $sth = $this->db->prepare("$select");
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Error';
            }
        }

        function databaseOperation($sql, $data){
            if ($this->db) {
                try {
                    $sth = $this->db->prepare($sql);
                    $sth->execute($data);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }
    }
?>