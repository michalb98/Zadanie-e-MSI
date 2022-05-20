<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Zadanie zdalne e-MSI</title>
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
                        <th>Opis</th>
                        <th>MPK</th>
                        <th>Kwota Netto</th>
                        <th>Ilość</th>
                        <th>VAT</th>
                        <th>Kwota Brutto</th>
                        <th>Wartość Netto</th>
                        <th>Wartość Bruttto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./php/Database.php');

                        $db = new Database();
                        $sql = 'SELECT * FROM faktury;';
                        $faktury = $db->selectFromDatabase($sql);
                        foreach($faktury as $faktura){
                            echo '<tr>';
                            for($i=0; $i< sizeof($faktura); $i++ ){
                                ($i != 3) ? print '<td>'.$faktura[$i].'</td>' : print '<td class="kwotaNetto">'.$faktura[$i].'</td>';
                                
                            }
                            echo '<td class="ilosc"><input type="number" value="2" min="1" class="iloscValue"></td>';
                            echo '<td class="vat">
                                    <select name="vat">
                                        <option value="0">0%</option>
                                        <option value="3" selected>3%</option>
                                        <option value="8">8%</option>
                                        <option value="23">23%</option>
                                    </select>
                                </td>';
                            echo '<td class="kwotaBrutto">0</td>';
                            echo '<td class="wartoscNetto">0</td>';
                            echo '<td class="wartoscBrutto">0</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <button type="button" id="powyzej">Powyżej 1000,00 zł Netto</button>
        </div>
    </div>
    <footer>
        Michał Błaszczyk &copy; 2022
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $("document").ready(function() {
            $(".kwotaBrutto").each(function(){
                var vat = $(this).prev(".vat").find("select").val();
                var kwotaNetto = parseFloat($(this).prev().prev().prev().html());
                var kwotaBrutto = kwotaNetto + ((kwotaNetto * vat)/100);
                $(this).html(kwotaBrutto.toFixed(2));
            });   
            
            $(".wartoscNetto").each(function(){
                var ilosc = $(this).prev().prev().prev().find(".iloscValue").val();
                var kwotaNetto = parseFloat($(this).prev().prev().prev().prev().html());
                var wartoscNetto = kwotaNetto * ilosc;
                $(this).html(wartoscNetto.toFixed(2));
            });

            $(".wartoscBrutto").each(function(){
                var wartoscNetto = parseFloat($(this).prev().html());
                var vat = $(this).prev().prev().prev().find("select").val();
                var wartoscBrutto = wartoscNetto + ((wartoscNetto * vat)/100);
                $(this).html(wartoscBrutto.toFixed(2));
            });
        });

        
        $(".ilosc").change(function(){
            var kwotaNetto = parseFloat($(this).prev().html());
            var ilosc = $(this).find(".iloscValue").val();
            var vat = $(this).next().find("select").val();
            var wartoscNetto = kwotaNetto * ilosc;
            $(this).next().next().next().html(wartoscNetto.toFixed(2));

            var wartoscBrutto = wartoscNetto + ((wartoscNetto * vat)/100);
            $(this).next().next().next().next().html(wartoscBrutto.toFixed(2));
        });

        $(".vat").change(function(){
            var vat = $(this).find("select").val();
            var ilosc = $(this).prev().find(".iloscValue").val();
            var kwotaNetto = parseFloat($(this).prev().prev().html());
            var kwotaBrutto = kwotaNetto + ((kwotaNetto * vat)/100);
            $(this).next().html(kwotaBrutto.toFixed(2));
            
            var wartoscNetto = parseFloat($(this).next().next().html());
            var wartoscBrutto = wartoscNetto + ((wartoscNetto * vat)/100);
            $(this).next().next().next().html(wartoscBrutto.toFixed(2));
        });

        $("#powyzej").click( function(){
            $(".kwotaNetto").each(function(){
                if(parseFloat($(this).html()) > 1000){
                    $(this).nextAll().css("background-color", "green");
                    $(this).css("background-color", "green");
                    $(this).prevAll().css("background-color", "green");
                }
            });
        });
    </script>                    
</body>
</html>