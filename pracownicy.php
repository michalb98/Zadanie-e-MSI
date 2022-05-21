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
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Stanowisko</th>
                        <th>Data zatrudnienia</th>
                        <th>Ilość dni urlopowych</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./php/Database.php');

                        $db = new Database();
                        $sql = 'SELECT pracownicy.ID_Pracownicy, pracownicy.Imie, pracownicy.Nazwisko, stanowisko.Stanowisko, pracownicy.Data_zatrudnienia, pracownicy.Ilosc_urlopu 
                                FROM pracownicy 
                                LEFT JOIN stanowisko ON pracownicy.ID_Stanowisko = stanowisko.ID_Stanowisko;';
                        $pracownicy = $db->selectFromDatabase($sql);
                        foreach($pracownicy as $pracownik){
                            echo '<tr>';
                            foreach($pracownik as $danePracownika){
                                echo '<td>'.$danePracownika.'</td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <div id="picker">
                <label>Parzyste <input type="color" id="even" name="even" value="#72757e"></label>
                <label>Nieparzyste <input type="color" id="odd" name="odd" value="#7f5af0"></label>
            </div>
        </div>
    </div>
    <footer>
        Michał Błaszczyk &copy; 2022
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#odd').change(function(){
            $('tr:nth-child(odd)').css("background-color", $(this).val());
        });
        $('#even').change(function(){
            $('tr:nth-child(even)').css("background-color", $(this).val());
        });
    </script>
</body>
</html>