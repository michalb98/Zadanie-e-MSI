<?php
    require_once("./php/Database.php");

    class Contractor extends Database{

        private $nip, $regon, $nazwa, $czyVat, $ulica, $nrDomu, $nrMieszkania;

        private $flag = true;

        function validate($data){
            if(strlen($data[0]) != 10) {$_SESSION['validateError'] = "Podano błeny NIP!"; $this->flag = false; } else {$this->nip = htmlspecialchars($data[0], ENT_QUOTES);}
            if(strlen($data[1]) != 9) {$_SESSION['validateError'] = "Podano błeny REGON!"; $this->flag = false; } else {$this->regon = htmlspecialchars($data[1], ENT_QUOTES);}
            if(strlen($data[2]) < 3 || strlen($data[2]) > 100) {$_SESSION['validateError'] = "Podano zlą nazwę!"; $this->flag = false; } else {$this->nazwa = htmlspecialchars($data[2], ENT_QUOTES);}
            if($data[3] == 1) $this->czyVat = 1; else $this->czyVat = 0;
            if(strlen($data[4]) < 3 || strlen($data[4]) > 50) {$_SESSION['validateError'] = "Podano zlą ulicę!"; $this->flag = false; } else {$this->ulica = htmlspecialchars($data[4], ENT_QUOTES);}
            if(strlen($data[5]) < 1 || strlen($data[5]) > 20) {$_SESSION['validateError'] = "Podano błeny numer domu!"; $this->flag = false; } else {$this->nrDomu = htmlspecialchars($data[5], ENT_QUOTES);}
            if(strlen($data[6]) > 0) $this->nrMieszkania = htmlspecialchars($data[6], ENT_QUOTES);
            if($this->flag) return true; else return false; 
        }

        function addForm(){
            echo '<td><input type="text" name="nip" value="'.$this->nip.'"></td>
            <td><input type="text" name="regon" value="'.$this->regon.'"></td>
            <td><input type="text" name="nazwa" value="'.$this->nazwa.'"></td>
            <td><input type="checkbox" name="czyVat" value="1"';
                if($this->czyVat == 1) echo 'checked';
            echo'></td>
            <td><input type="text" name="ulica" value="'.$this->ulica.'"></td>
            <td><input type="text" name="nrDomu" value="'.$this->nrDomu.'"></td>
            <td><input type="text" name="nrMieszkania" value="'.$this->nrMieszkania.'"></td>
            <td><input type="submit" value="Dodaj"></td>';
        }

        function addNewConctractor(){
            $db = new Database;
            $data = [
                'ID' => NULL,
                'nip' => $this->nip,
                'regon' => $this->regon,
                'nazwa' => $this->nazwa,
                'czyVat' => $this->czyVat,
                'ulica' => $this->ulica,
                'nrDomu' => $this->nrDomu,
                'nrMieszkania' => $this->nrMieszkania,
                'czyUsuniety' => 0
            ];

            $sql = 'INSERT INTO `kontraheci`(`ID_Kontraheci`, `NIP`, `Regon`, `Nazwa`, `Czy_vat`, `Ulica`, `Numer_domu`, `Numer_mieszkania`, `Czy_usuniety`) 
                    VALUES (:ID, :nip, :regon, :nazwa, :czyVat, :ulica, :nrDomu, :nrMieszkania, :czyUsuniety);';

            $db->databaseOperation($sql, $data);
        }

        function removeConctractor($id){
            $db = new Database;
            $sql = 'UPDATE `kontraheci` 
                    SET Czy_usuniety = :czyUsuniety
                    WHERE ID_Kontraheci = "'.$id.'"';
            $data = ['czyUsuniety' => 1];
            $db->databaseOperation($sql, $data);
        }

        function editContractor($id){
            $db = new Database;
            $data = [
                'nip' => $this->nip,
                'regon' => $this->regon,
                'nazwa' => $this->nazwa,
                'czyVat' => $this->czyVat,
                'ulica' => $this->ulica,
                'nrDomu' => $this->nrDomu,
                'nrMieszkania' => $this->nrMieszkania,
            ];
            $sql = 'UPDATE `kontraheci` 
                    SET NIP = :nip, Regon = :regon, Nazwa = :nazwa, Czy_vat = :czyVat, Ulica = :ulica, Numer_domu = :nrDomu, Numer_mieszkania = :nrMieszkania
                    WHERE ID_Kontraheci = "'.$id.'"';
            $db->databaseOperation($sql, $data);
        }
    }

?>