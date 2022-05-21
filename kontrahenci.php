<?php
    session_start();

    require_once("./php/Contractor.php");
    $c = new Contractor;

    if(isset($_POST['nip']) && !isset($_POST['IdEdytuj'])){
        if(isset($_POST['czyVat']))
            $data = array($_POST['nip'], $_POST['regon'], $_POST['nazwa'], 1, $_POST['ulica'], $_POST['nrDomu'], $_POST['nrMieszkania']);
        else
            $data = array($_POST['nip'], $_POST['regon'], $_POST['nazwa'], 0, $_POST['ulica'], $_POST['nrDomu'], $_POST['nrMieszkania']);
        if($c->validate($data)){
            $c->addNewConctractor();
            header('Location: dane-kontrahentow');
            echo "dodaj";
        }
    } else if(isset($_POST['IdEdytuj'])){
        if(isset($_POST['czyVat']))
            $data = array($_POST['nip'], $_POST['regon'], $_POST['nazwa'], 1, $_POST['ulica'], $_POST['nrDomu'], $_POST['nrMieszkania']);
        else
            $data = array($_POST['nip'], $_POST['regon'], $_POST['nazwa'], 0, $_POST['ulica'], $_POST['nrDomu'], $_POST['nrMieszkania']);
        if($c->validate($data)){
            $c->editContractor($_POST['IdEdytuj']);
            header('Location: dane-kontrahentow');
        }
    } else if(isset($_POST['IdUsun'])){
        $c->removeConctractor($_POST['IdUsun']);
        header('Location: dane-kontrahentow');
    }

    

    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Zadanie zdalne e-MSI</title>
    <link rel="icon" href="./img/fav.png"> <!-- Source: https://www.flaticon.com/free-icon/task_762686 -->
</head>
<body>
    <div id="container">
        <div id="lewy">
            <a href="rozne-kontrolki-HTML" title="Różne kontrolki HTML">Różne kontrolki HTML</a>
            <a href="tabela-pracownikow" title="Tabela Pracowników">Tabela Pracowników</a>
            <a href="tabela-faktur-VAT" title="Tabela Faktur VAT">Tabela Faktur VAT</a>
            <a href="tabela-delegacji-BD" title="Tabela Delegacji BD">Tabela Delegacji BD</a>
            <a href="dane-kontrahentow" title="Dane Kontrahentów">Dane Kontrahentów</a>
        </div>
        <div id="prawy">
            <table>
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>REGON</th>
                        <th>Nazwa</th>
                        <th>Czy płatnik VAT?</th>
                        <th>Ulica</th>
                        <th>Numer domu</th>
                        <th>Numer mieszkania</th>
                        <th>Operacje</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form method="POST">
                        <?php
                            $c->addForm();
                        ?>
                        </form>
                    </tr>
                    <?php
                        require_once('./php/Database.php');

                        $db = new Database();
                        $sql = 'SELECT NIP, Regon, Nazwa, Czy_vat, Ulica, Numer_domu, Numer_mieszkania, ID_Kontraheci FROM kontraheci WHERE Czy_usuniety != 1;';
                        $kontraheci = $db->selectFromDatabase($sql);

                        for($i=0; $i< sizeof($kontraheci); $i++ ){
                            echo '<tr>
                                    <form method="POST">
                                        <td><input type="text" name="nip" value="'.$kontraheci[$i][0].'"></td>
                                        <td><input type="text" name="regon" value="'.$kontraheci[$i][1].'"></td>
                                        <td><input type="text" name="nazwa" value="'.$kontraheci[$i][2].'"></td>
                                        <td><input type="checkbox" name="czyVat" value="'.$kontraheci[$i][3].'"'; 
                                        if($kontraheci[$i][3] == 1) 
                                            echo "checked"; 
                                        echo '></td>
                                        <td><input type="text" name="ulica" value="'.$kontraheci[$i][4].'"></td>
                                        <td><input type="text" name="nrDomu" value="'.$kontraheci[$i][5].'"></td>
                                        <td><input type="text" name="nrMieszkania" value="'.$kontraheci[$i][6].'"></td>
                                        <td class="optionContaienr">
                                            <input type="hidden" name="IdEdytuj" value="'.$kontraheci[$i][7].'">
                                            <input type="submit" value="Edytuj" class="Edytuj">  
                                    </form>
                                    <form method="POST">
                                            <input type="hidden" name="IdUsun" value="'.$kontraheci[$i][7].'">
                                            <input type="submit" value="Usuń" class="usun">
                                    </form>
                                        </td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php
                if(isset($_SESSION['validateError'])){
                    echo '<div class="error">'.$_SESSION['validateError'].'</div>';
                    unset($_SESSION['validateError']);
                }
            ?>
        </div>
    </div>
    <footer>
        Michał Błaszczyk &copy; 2022
    </footer>
</body>
</html>