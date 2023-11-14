<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Roldán, Magdalena. FAI 2855. Carrera. mail. Usuario Github */
/* Reile, Ariana Belen. FAI 5056. Tecnicatura en desarrollo web. arireile02@gmail.com. https://github.com/FlashBack02 */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/** Obtiene una colección de palabras en un arreglo indexado
 * @return array
 */
function cargarColeccionPalabras()
{
    // ARRAY $coleccionPalabras
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "CASAS", "LIMON", "JAMON", "PERRO", "SOPAS"
    ];

    return ($coleccionPalabras);
}



/**
 * Crea un arreglo multidimensional que almacena las partidas con la palabra, el jugador, la cantidad de intentos y el puntaje
 * @return array
 */
function cargarPartidas()
{
    //array  $coleccionPartidas
    //Crea el arreglo multidimencional (indexado que almacena arreglos asociativos)
    $coleccionPartidas = [];
    $coleccionPartidas[0] = ["palabraWordix"=> "QUESO" , "jugador" => "majo", "intentos"=> 0, "puntaje" => 0];
    $coleccionPartidas[1] = ["palabraWordix"=> "CASAS" , "jugador" => "rudolf", "intentos"=> 3, "puntaje" => 15];
    $coleccionPartidas[2] = ["palabraWordix"=> "YUYOS" , "jugador" => "pink2000", "intentos"=> 6, "puntaje" => 10];
    $coleccionPartidas[3] = ["palabraWordix"=> "MELON" , "jugador" => "pink2000", "intentos"=> 6, "puntaje" => 2];
    $coleccionPartidas[4] = ["palabraWordix"=> "JAMON" , "jugador" => "majo", "intentos"=> 2, "puntaje" => 5];
    $coleccionPartidas[5] = ["palabraWordix"=> "CASAS" , "jugador" => "pink2000", "intentos"=> 4, "puntaje" => 6];
    $coleccionPartidas[6] = ["palabraWordix"=> "VERDE" , "jugador" => "rudolf", "intentos"=> 1, "puntaje" => 3];
    $coleccionPartidas[7] = ["palabraWordix"=> "FUEGO" , "jugador" => "pink2000", "intentos"=> 5, "puntaje" => 9];
    $coleccionPartidas[8] = ["palabraWordix"=> "YUYOS" , "jugador" => "rudolf", "intentos"=> 4, "puntaje" => 11];
    $coleccionPartidas[9] = ["palabraWordix"=> "RASGO" , "jugador" => "majo", "intentos"=> 2, "puntaje" => 10];

    //retorna la colección de partidas
    return $coleccionPartidas;
}

/**
 * Retorna el resumen del jugador según la estructura especificada.
 *
 * @param array $colecciónPartidas Colección de partidas.
 * @param string $nombreJugador Nombre del jugador.
 * @return array|null Estructura asociativa con el resumen del jugador o null si el jugador no se encuentra.
 */
function obtenerResumenJugador($coleccionPartidas, $nombreJugador) 
{
    //array|null $resumenJugador
    //int $cantPartidas, $contadorPartidas, $ContadorPuntaje, $contadorVictorias, $contadorIntentos
    $resumenJugador = null;
    $cantPartidas = count($coleccionPartidas);
    $contadorPartidas = 0;
    $contadorPuntaje = 0;
    $contadorVictorias = 0;

    for ($i = 0; $i < $cantPartidas; $i++) {
        if ($nombreJugador == $coleccionPartidas[$i]["jugador"]) {
            $contadorPartidas++;
            $contadorPuntaje = $contadorPuntaje + $coleccionPartidas[$i]["puntaje"];
    
            
            if ($coleccionPartidas[$i]["puntaje"] > 0) {
                $contadorVictorias++;
            }
            
        }
    }

    if ($contadorPartidas > 0) {
        $resumenJugador = [
            "jugador" => $nombreJugador, 
            "partidas" => $contadorPartidas,
            "puntaje" => $contadorPuntaje,
            "victorias" => $contadorVictorias
        ];
    }
        $contadorIntentos = 1;
        for ($j = 0; $j < $cantPartidas; $j++) {
        
            if ($nombreJugador == $coleccionPartidas[$j]["jugador"]) {
                $resumenJugador["intentos" . $contadorIntentos] = $coleccionPartidas[$j]["intentos"];
                $contadorIntentos++;
            }
        }    
   
    return $resumenJugador;
}

/**
 * Menu de opciones que retorna la opción elegida por el usuario
 * @return int 
 */
function seleccionarOpcion()
 {
     //int $opc
     echo "\n \n┏━━━━━━•(=^●ω●^=)•━━━━━━┓ \n \n";
     echo escribirGris("Elija una opción del 1 al 8"). "\n";
     echo "Menú de opciones: \n";
     echo "1) Jugar al wordix con una palabra elegida \n";
     echo "2) Jugar al wordix con una palabra aleatoria \n";
     echo "3) Mostrar una partida \n";
     echo "4) Mostrar la primer partida ganadora \n";
     echo "5) Mostrar resumen de Jugador \n";
     echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra \n";
     echo "7) Agregar una palabra de 5 letras a Wordix \n";
     echo "8) salir \n \n";
     echo "┗━━━━━━•(=^●ω●^=)•━━━━━━┛ \n";
     $opc = trim(fgets(STDIN));
     return $opc;
 }
 
 /**
  * Función que solicita el nombre del usuario, verifica que el nombre inicie con una letra y retorna el nombre en minúsculas.
  * @return string
  */
function  solicitarJugador()
 {
     //int $i
     //string $nombreJ, $esLetra
     $i = 0;
     $esLetra = false;
     while ($esLetra == false){
         echo "Ingrese el nombre del jugador/a: \n";
         echo "El nombre debe iniciar con una letra ⚠️ \n";
         $nombreJ = trim(fgets(STDIN));
         $esLetra = ctype_alpha($nombreJ[$i]); // = Verifica si el carácter en la posición actual $i de la cadena es una letra del alfabeto
     }return strtolower($nombreJ); // Devuelve el usuario en minúsculas
 }
 
 /**
 * Funcion que muestra una partida por pantalla
 * @param int $num
 * @param array $partidas
 */
function mostrarPartida($num, $partidas)
{
    echo "\n┌──────── ∘°❉°∘ ────────┐\n\n";
    echo "Partida WORDIX ". $num . ":" . "\n";
    echo "palabra ". $partidas[$num]["palabraWordix"] . "\n";
    echo "Jugador: " .  $partidas[$num]["jugador"] . "\n";
    echo "Puntaje: ". $partidas[$num]["puntaje"]  . " puntos" . "\n";
    if ($partidas[$num]["puntaje"] > 0){
        echo "Adivinó la palabra en " . $partidas[$num]["intentos"]  . " intentos" . "\n";
    }else {
        echo "Intento: No adivinó la palabra" . "\n";
    }
    echo "\n└──────── °∘❉∘° ────────┘\n\n";
}

/**
 * Funcion que verifica que el usuario no haya jugado anteriormente con una palabra
 * @param string $jugador
 * @param string $palabra
 * @param array $partidasC
 * @return bool
 */
function existePalabraEnPartidas($jugador, $palabra, $partidasC) {
    //int $numPartidas, $i
    $numPartidas = count($partidasC);

    for ($i = 0; $i < $numPartidas; $i++) {
        $partida = $partidasC[$i];

        if ($partida["jugador"] == $jugador && strtolower($partida["palabraWordix"]) == strtolower($palabra)) { // strtolower — Convierte un string a minúsculas
            return true;
        }
    }

    return false;
}

/**
 * Función que agrega una nueva palabra al array con la colección de palabras para jugar
 * @param array $palabraColeccion
 * @param string $palabra
 * @return array //retorna el array con la nueva palabra
 */
function agregarPalabra($palabraColeccion, $palabra)
{
    $palabraColeccion[] = $palabra;
    return $palabraColeccion;
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/

?>
