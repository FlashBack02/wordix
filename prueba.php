<?php
include_once("wordix.php");
include_once("programaRoldanReile.php");



// PRINCIPAL
//array $coleccionPalabras, $partidasCargadas
$coleccionPalabras = cargarColeccionPalabras();
$partidasCargadas = cargarPartidas();

do {
    $opcion = seleccionarOpcion();
    switch ($opcion) { //La sentencia switch es una estructura alternativa múltiple o tambien llamada *estructura selectiva*
        //La sentencia switch evalúa la ExpresionMultivalor y ejecuta el ConjuntoDeSentencias que aparece junto a la cláusula case cuyo valor corresponda con ExpresionMultivalor
        case 1: 
            //string $nombreJugador
            //int $cantPalabras, $numPalabras
            //array $partida
            $nombreJugador = solicitarJugador();
            $cantPalabras = count($coleccionPalabras);
            $numPalabra = solicitarNumeroEntre(0, $cantPalabras-1);
            $partida = jugarWordix($coleccionPalabras[$numPalabra], strtolower($nombreJugador));
            $partidasCargadas[] = [
                "palabraWordix" => $partida["palabraWordix"],
                "jugador" => $nombreJugador,
                 "intentos" => $partida["intentos"],
                 "puntaje" => $partida["puntaje"]
            ];
            break; // Las sentencias break que aparecen tras cada ConjuntoDeSentencias provocan que el control salga del switch y continúe con la siguiente instrucción al switch.
        case 2: 
            //string $nombreJugador
            //int $cantPalabras, $cantPartidas, $numRandom 
            //array $partida
            $nombreJugador = solicitarJugador();
            $cantPartidas = count($partidasCargadas);
            $cantPalabras = count($coleccionPalabras);
            $numRandom = random_int(0, $cantPalabras - 1); //Genera un número entero aleatorio entre el mínimo y el máximo dados.

           // Verificar que la palabra no ha sido usada por el jugador antes
            while (existePalabraEnPartidas($nombreJugador, $coleccionPalabras[$numRandom], $partidasCargadas)) {
              $numRandom = random_int(0, $cantPalabras - 1); 
            }

            $partida = jugarWordix($coleccionPalabras[$numRandom], strtolower($nombreJugador));
            $partidasCargadas[] = [
                 "palabraWordix" => $partida["palabraWordix"],
                 "jugador" => $nombreJugador,
                 "intentos" => $partida["intentos"],
                 "puntaje" => $partida["puntaje"]
            ];
            break;
        case 3: 
            //int  $cantPartidas
            $cantPartidas = count($partidasCargadas);

            echo "\nIngrese un número de partida: \n";
            $numPartida = trim(fgets(STDIN));

            if ($numPartida < 0 || $numPartida >= $cantPartidas) {
               do {
                echo "\n─────▄───▄ \n";
                echo "─▄█▄─█▀█▀█─▄█▄ \n";
                echo "▀▀████▄█▄████▀▀\n";
                echo "─────▀█▀█▀ \n";
                echo "Error, no existe esa partida. \n";
                echo "Vuelva a ingresar un número de partida:";
                echo "\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
                $numPartida = trim(fgets(STDIN));
                } while ($numPartida < 0 || $numPartida >= $cantPartidas);
            }

            echo "Número de partida seleccionado:" . $numPartida."\n";
            mostrarPartida($numPartida, $partidasCargadas);
            break;
        case 4: 
            //string $nombreJugador
            //int  $indice 
            $nombreJugador = solicitarJugador();
            $indice = primerPartidaGanadaPor($partidasCargadas, $nombreJugador);

            if($indice != -1){
            echo "Número de partida seleccionado:". $indice ."\n";
            mostrarPartida($indice, $partidasCargadas);
            } else{
                echo "\n─────▄───▄ \n";
                echo "─▄█▄─█▀█▀█─▄█▄ \n";
                echo "▀▀████▄█▄████▀▀\n";
                echo "─────▀█▀█▀ \n";
                echo "El jugador ". $nombreJugador. " no ganó ninguna partida. \n";
            }
            break;
        case 5: 
            //string $nombreJugador
            //int $i
            //array $resumenJugador
            $nombreJugador = solicitarJugador();
            $resumenJugador = obtenerResumenJugador($partidasCargadas, $nombreJugador);
            if($resumenJugador != null){
                echo "\n┌──────── ∘°❉°∘ ────────┐\n\n";
                echo "Jugador: ". $resumenJugador["jugador"] . "\n";
                echo "Partidas: ". $resumenJugador["partidas"] . "\n";
                echo "Puntaje total: " .  $resumenJugador["puntaje"] . "\n";
                echo "Victorias: ". $resumenJugador["victorias"] . "\n";
                echo "Porcentaje de victorias: ". (($resumenJugador["victorias"]*100)/$resumenJugador["partidas"]). "\n";
                echo "Adivinadas: \n";
                for($i=1; $i <= $resumenJugador["partidas"]; $i++){
                    echo "      Intento ". $i. " : ". $resumenJugador["intentos" . $i]. "\n";
                }
                echo "\n└──────── °∘❉∘° ────────┘\n\n";
            }else{
                echo "\n─────▄───▄ \n";
                echo "─▄█▄─█▀█▀█─▄█▄ \n";
                echo "▀▀████▄█▄████▀▀\n";
                echo "─────▀█▀█▀ \n";
                echo "El jugador ". $nombreJugador. " no ganó ninguna partida. \n";
            }
            break;
        case 6: 
            ordenarPartidas($partidasCargadas);
            break; 
        case 7: 
            //string $nuevaPalabra
            //array $coleccionPalabras
            $nuevaPalabra = leerPalabra5Letras();
            $coleccionPalabras = agregarPalabra($coleccionPalabras,$nuevaPalabra);
            print_r($coleccionPalabras);

            break;
        case 8: 
                echo "\n\n❀.•° ✿.•° ❀.•° ✿.•°•.✿ °•.❀ °•.✿ °•.❀ \n";
                echo "  Gracias por utilizar el programa \n";
                echo "❀.•° ✿.•° ❀.•° ✿.•°•.✿ °•.❀ °•.✿ °•.❀ \n\n";
            break; 
        default: 
            echo "\n─────▄───▄ \n";
            echo "─▄█▄─█▀█▀█─▄█▄ \n";
            echo "▀▀████▄█▄████▀▀\n";
            echo "─────▀█▀█▀ \n";
            echo escribirRojo("ERROR, no existe esa opción X_X")."\n";
            echo escribirRojo("▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓")."\n";
            echo escribirRojo("▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓")."\n";
        break;

    }
} while ($opcion != 8);
