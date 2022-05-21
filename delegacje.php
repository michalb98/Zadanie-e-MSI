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
                    <th>Lp.</th>
                    <th>Imię i Nazwisko</th>
                    <th>Data od</th>
                    <th>Data do</th>
                    <th>Miejsce wyjzadu</th>
                    <th>Miejsce przyjazdu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once('./php/Database.php');
                    $db = new Database();
                    $sql = 'SELECT * FROM delegacje;';
                    $delegacje = $db->selectFromDatabase($sql);
                    foreach($delegacje as $delegacja){
                        echo '<tr>';
                        foreach($delegacja as $daneDelegacji){
                            echo '<td>'.$daneDelegacji.'</td>';
                        }
                        echo '</tr>';
                    }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    <footer>
        Michał Błaszczyk &copy; 2022
    </footer>
</body>
</html>