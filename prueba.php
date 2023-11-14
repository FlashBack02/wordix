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
                $nombreJugador = solicitarJugador();
                $cantPalabras = count($coleccionPalabras);
                $numPalabra = solicitarNumeroEntre(0, $cantPalabras-1);
                $partida = jugarWordix($coleccionPalabras[$numPalabra], strtolower($nombreJugador));
                array_push($partidasCargadas[$partida]);
                print_r($partidasCargadas);
            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

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
