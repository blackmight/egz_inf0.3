<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <header><h1>Zdjęcia</h1></header>

    <nav>
        <h2>Tematy zdjęć</h2>
        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </nav>

    <main>

        <!-- SKRYPT 1 -->
        <!-- Dla bloku generowanego skryptem 1 i zawierającego zdjęcie i opis: bloki ustawione obok siebie
(opływanie), szerokość 46%, marginesy zewnętrzne 2%, pozycjonowanie względne -->

<!-- W momencie, gdy kursor myszy znajdzie się na bloku generowanym skryptem 1:
− Zdjęcia z bloku środkowego przyjmują wartość przezroczystości 0.3 i jest ona zmieniana płynnie
przez 0.5 sekundy efektem ease
− Nagłówka trzeciego stopnia: brak przezroczystości (1)
− Paragrafu: brak przezroczystości
− Odnośnika: brak przezroczystości -->

    <!-- <div class="image_block">
        <img src="kiev.jpg" alt="image">
    </div> -->

    <?php

        $pol = mysqli_connect("localhost", "root", "", "galeria");
        if (mysqli_connect_errno()) {
                echo "<UW</UW>AGA błąd połączenia: ".mysqli_connect_error();
                exit();
        }

        $zapytanie_2 = "SELECT plik, tytul, polubienia, imie, nazwisko FROM zdjecia JOIN autorzy ON autorzy_id = autorzy.id ORDER BY nazwisko;";
    
        if ($result_2 = mysqli_query($pol, $zapytanie_2)) {
            while($row = mysqli_fetch_assoc($result_2)) {

                echo "<div class='image_container'>";
                echo "<img src='{$row["plik"]}' alt='zdjęcie'>";
                echo "<h3>{$row["tytul"]}</h3";
                echo "</div>";
                
            }

            mysqli_close($pol);
        }

    ?>

    </main>

    <aside>
        <h2>Najbardziej lubiane</h2>
        <!-- SKRYPT 2 -->

        <?php
        
        $pol = mysqli_connect("localhost", "root", "", "galeria");
        if (mysqli_connect_errno()) {
                echo "<UW</UW>AGA błąd połączenia: ".mysqli_connect_error();
                exit();
        }

        $zapytanie = "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100;";
        $result = mysqli_query($pol, $zapytanie);

        $row = mysqli_fetch_assoc($result);
        echo "<img src='{$row["plik"]}' alt='{$row["tytul"]}'>";

        mysqli_free_result($result);

        mysqli_close($pol);
        ?>
        <br>
        <b>Zobacz wszystkie nasze zdjęcia</b>
    </aside>

    <footer>Stronę wykonał: 000000000000</footer>
    
</body>
</html>