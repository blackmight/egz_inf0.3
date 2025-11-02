<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>

    <link rel="stylesheet" href="styl.css">
</head>
<body>

    <header><img src="obraz1.png" alt="Mapa Polski"></header>
    <header><h1>Rzeki w województwie dolnośląskim</h1></header>
    
    <menu>
        <form method="POST" action="">
            <input type="radio" name=radioWybor id="wszystkie" value="wszystkie">
            <label class="opcja" for="wszystkie">Wszystkie</label>

            <input type="radio" name=radioWybor id="ponadStanOstrzegawczy" value="ponadStanOstrzegawczy">
            <label class="opcja" for="ponadStanOstrzegawczy">Ponad stan ostrzegawczy</label>

            <input type="radio" name=radioWybor id="ponadStanAlarmowy" value="ponadStanAlarmowy">
            <label class="opcja" for="ponadStanAlarmowy">Ponad stan alarmowy</label>
            <button>Pokaż</button>
        </form>
    </menu>

    <section>
        <nav>
            <h3>Stany na dzień 2022-05-05</h3>
            <table>
                <tr>
                    <th>Wodomierz</th>
                    <th>Rzeka</th>
                    <th>Ostrzegawczy</th>
                    <th>Alarmowy</th>
                    <th>Aktualny</th>
                </tr>

                <?php
                $pol = mysqli_connect("localhost", "root", "", "rzeki");
                if(mysqli_connect_errno()){
                    echo "Błąd przy połączeniu do bazy danych.".mysqli_connect_error();
                    exit();
                }
                if(!isset($_POST["radioWybor"]) || $_POST["radioWybor"] == "wszystkie"){
                    $z = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = wodowskazy_id WHERE dataPomiaru='2022-05-05'";
                    if($w = mysqli_query($pol,$z)){
                        // echo "Z bazy danych odczytano: ".mysqli_num_rows($w)." rekordów";
                        while($rekord=mysqli_fetch_assoc($w)){
                            echo "<tr><td>".$rekord["nazwa"]."</td><td>".$rekord["rzeka"]."</td><td>".$rekord["stanOstrzegawczy"]."</td><td>".$rekord["stanAlarmowy"]."</td><td>".$rekord["stanWody"]."</td></tr>";
                        }
                        mysqli_free_result($w);
                    }
                }
                if($_POST["radioWybor"] == "ponadStanOstrzegawczy"){
                    $z = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = wodowskazy_id WHERE dataPomiaru='2022-05-05' AND stanWody > stanOstrzegawczy";
                    if($w = mysqli_query($pol,$z)){
                        // echo "Z bazy danych odczytano: ".mysqli_num_rows($w)." rekordów";
                        while($rekord=mysqli_fetch_assoc($w)){
                            echo "<tr><td>".$rekord["nazwa"]."</td><td>".$rekord["rzeka"]."</td><td>".$rekord["stanOstrzegawczy"]."</td><td>".$rekord["stanAlarmowy"]."</td><td>".$rekord["stanWody"]."</td></tr>";
                        }
                        mysqli_free_result($w);
                    }
                }
                if($_POST["radioWybor"] == "ponadStanAlarmowy"){
                    $z = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = wodowskazy_id WHERE dataPomiaru='2022-05-05' AND stanWody > stanAlarmowy";
                    if($w = mysqli_query($pol,$z)){
                        // echo "Z bazy danych odczytano: ".mysqli_num_rows($w)." rekordów";
                        while($rekord=mysqli_fetch_assoc($w)){
                            echo "<tr><td>".$rekord["nazwa"]."</td><td>".$rekord["rzeka"]."</td><td>".$rekord["stanOstrzegawczy"]."</td><td>".$rekord["stanAlarmowy"]."</td><td>".$rekord["stanWody"]."</td></tr>";
                        }
                        mysqli_free_result($w);
                    }
                }

                mysqli_close($pol);
                
                ?>

                <!-- <tr>
                    <td>TEST</td>
                    <td>TEST</td>
                    <td>TEST</td>
                    <td>TEST</td>
                    <td>TEST</td>
                </tr> -->
            </table>
        </nav>

        <aside>
            <h3>Informacje</h3>
            <ul>
                <li>Brak ostrzeżeń o burzach z gradem</li>
                <li>Smog w mieście Wrocław</li>
                <li>Silny wiatr w Karkonoszach</li>
            </ul>
            <h3>Średnie stany wód</h3>
            <!-- Efekt działania skryptu 2 -->

            <?php
                $pol = mysqli_connect("localhost", "root", "", "rzeki");
                if(mysqli_connect_errno()){
                    echo "Wystąpił błąd połączenia z bazą danych: ".mysqli_connect_error();
                    exit();
                }
                $x = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru";
                if($q = mysqli_query($pol, $x)){
                    while($rekord = mysqli_fetch_assoc($q)){
                        echo $rekord["dataPomiaru"].": ".$rekord["AVG(stanWody)"]."<br><br>";
                    };
                }
            ?>

            <a href="https://komunikaty.pl">Dowiedz się więcej</a>
            <img src="obraz2.jpg" alt="rzeka">

        </aside>
    </section>

    <footer>Stronę wykonał: ???</footer>

</body>
</html>