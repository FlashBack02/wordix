<?php
include_once("wordix.php");
include_once("programaRoldanReile.php");



// PRINCIPAL

$coleccionPalabras = cargarColeccionPalabras();
$partidasCargadas = cargarPartidas();

do {
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: 
            //string $nombreHugador
            //int $cantPalabras, $numPalabras
            //array $partida
                $nombreJugador = solicitarJugador();
                $cantPalabras = count($coleccionPalabras);
                $numPalabra = solicitarNumeroEntre(0, $cantPalabras-1);
                $partida = jugarWordix($coleccionPalabras[$numPalabra], strtolower($nombreJugador));
                $partidasCargadas[count($partidasCargadas)]=["palabraWordix"=>$partida["palabraWordix"], "jugador"=>$nombreJugador, "intentos"=>$partida["intentos"], "puntaje"=>$partida["puntaje"]];
            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            $cantPartidas = count($partidasCargadas);

            echo "\nIngrese un número de partida: \n";
            $numPartida = trim(fgets(STDIN));

            if ($numPartida < 0 || $numPartida >= $cantPartidas) {
               do {
                echo "\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
                echo "Error, no existe esa partida. \n";
                echo "Vuelva a ingresar un número de partida:";
                echo "\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
                $numPartida = trim(fgets(STDIN));
                } while ($numPartida < 0 || $numPartida >= $cantPartidas);
            }

            echo "Número de partida seleccionado: $numPartida\n";
            mostrarPartida($numPartida, $partidasCargadas);
            break;
        case 4: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
    
            break;
        case 5: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        case 6: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
    
            break; 
        case 7: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
        
            break; 
        case 8: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
        
            break; 
        default: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
        
            break; 

    }
} while ($opcion != 8);
