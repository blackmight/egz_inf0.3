<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motocykle</title>

    <link rel="stylesheet" href="styl.css">

</head>
<body>

    <img class="motocykl" src="motor.png" alt="motocykl">
    <header><i><b>Motocykle - moja pasja</b></i></header>
    
    <section class="content">
        <section class="left">
            <nav><span><b><i>Gdzie pojechać?</span></i></b></nav>

            <?php
    
                $pol = mysqli_connect("localhost", "root", "", "motory");
                if (mysqli_connect_errno()) {
                        echo "UWAGA błąd połączenia: ".mysqli_connect_error();
                        exit();
                }

                $zapytanie_2 = 'SELECT 
                                    w.nazwa, 
                                    w.opis, 
                                    w.poczatek, 
                                    z.zrodlo
                                FROM 
                                    wycieczki w
                                INNER JOIN 
                                    zdjecia z
                                ON 
                                    w.zdjecia_id = z.id;
                                ';
                
                        if ($w = mysqli_query($pol, $zapytanie_2)) {

                        while($rekord=mysqli_fetch_assoc($w)) {
                            echo "<h5 class='header_content'>{$rekord['nazwa']}, rozpoczyna się w {$rekord['poczatek']}, <a href='{$rekord['zrodlo']}.jpg'>zobacz zdjęcie</a></h5>";

                            // echo "<br>";
                            echo "<dd>".$rekord["opis"]."</dd>";
                        }

                        mysqli_free_result($w);
                    }
                        mysqli_close($pol);                    
            ?>

        </section>
        <section class="right">
            <aside id="one">
                <h2><span><b><i>Co kupić?</i></b></span></h2>
                <ol>
                    <li>Honda CBR125R</li>
                    <li>Yamaha YBR125</li>
                    <li>Honda VFR800i</li>
                    <li>Honda CBR1100XX</li>
                    <li>BMW R1200GS LC</li>
                </ol>
            </aside>
            <aside id="two">
                <span><b><i>Statystyki</i></b></span>
                <p>Wpisanych wycieczek:
                    <?php
                        $pol = mysqli_connect("localhost", "root", "", "motory");
                        if (mysqli_connect_errno()) {
                                echo "<UW</UW>AGA błąd połączenia: ".mysqli_connect_error();
                                exit();
                        }

                        $zapytanie_3 = 'SELECT wycieczki.id FROM wycieczki';
                        if ($w = mysqli_query($pol, $zapytanie_3)) {
                                echo " ".mysqli_num_rows($w);
                            }

                
                    ?>
                </p>
                <p>Użytkowników forum: 200</p>
                <p>Przesłanych zdjęć: 1300</p>
            </aside>
        </section>
    </secton>
</section>

    <footer>stopka</footer>

    

</body>
</html>