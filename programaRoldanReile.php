<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Roldán, Magdalena. FAI 2855. Tecnicatura en desarrollo web. magdaroland7@gmail.com. magdaRoland  */
/* Reile, Ariana Belen. FAI 5056. Tecnicatura en desarrollo web. arireile02@gmail.com. FlashBack02 */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

//EXPLICACIÓN 3 PUNTO 1
/** Obtiene una colección de palabras en un arreglo indexado
 * @return array
 */
function cargarColeccionPalabras()
{
    // ARRAY $coleccionPalabras
    $coleccionPalabras = [
        //"MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        //"GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        //"VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "CASAS", "LIMON", "JAMON", "PERRO", "SOPAS"
    ];

    return ($coleccionPalabras);
}


//EXPLICACIÓN 3 PUNTO 2
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
    $coleccionPartidas[2] = ["palabraWordix"=> "YUYOS" , "jugador" => "pink2000", "intentos"=> 3, "puntaje" => 10];
    $coleccionPartidas[3] = ["palabraWordix"=> "MELON" , "jugador" => "pink2000", "intentos"=> 4, "puntaje" => 2];
    $coleccionPartidas[4] = ["palabraWordix"=> "JAMON" , "jugador" => "majo", "intentos"=> 2, "puntaje" => 5];
    $coleccionPartidas[5] = ["palabraWordix"=> "CASAS" , "jugador" => "pink2000", "intentos"=> 4, "puntaje" => 6];
    $coleccionPartidas[6] = ["palabraWordix"=> "VERDE" , "jugador" => "rudolf", "intentos"=> 1, "puntaje" => 3];
    $coleccionPartidas[7] = ["palabraWordix"=> "FUEGO" , "jugador" => "pink2000", "intentos"=> 5, "puntaje" => 9];
    $coleccionPartidas[8] = ["palabraWordix"=> "YUYOS" , "jugador" => "rudolf", "intentos"=> 4, "puntaje" => 11];
    $coleccionPartidas[9] = ["palabraWordix"=> "RASGO" , "jugador" => "majo", "intentos"=> 2, "puntaje" => 10];

    //retorna la colección de partidas
    return $coleccionPartidas;
}

//EXPLICACIÓN 3 PUNTO 9
/**
 * Retorna el resumen del jugador según la estructura especificada.
 *
 * @param array $colecciónPartidas Colección de partidas.
 * @param string $nombreJugador Nombre del jugador.
 * @return array|null Estructura asociativa con el resumen del jugador o null si el jugador no se encuentra.
 */
function obtenerResumenJugador($coleccionPartidas, $nombreJugador) 
{
    //array/null $resumenJugador
    //int $cantPartidas,$contadorPartidas, $contadorPuntaje,$contadorVictorias, $contadorIntentos, $i
    $resumenJugador = null;
    $cantPartidas = count($coleccionPartidas);
    $contadorPartidas = 0;
    $contadorPuntaje = 0;
    $contadorVictorias = 0;
    $contadorIntentos1 = 0;
    $contadorIntentos2 = 0;
    $contadorIntentos3 = 0;
    $contadorIntentos4 = 0;
    $contadorIntentos5 = 0;
    $contadorIntentos6 = 0;

    for ($i = 0; $i < $cantPartidas; $i++) {
        if ($nombreJugador == $coleccionPartidas[$i]["jugador"]) {
            $contadorPartidas++;
            $contadorPuntaje = $contadorPuntaje + $coleccionPartidas[$i]["puntaje"];

            if ($coleccionPartidas[$i]["puntaje"] > 0) {
                $contadorVictorias++;
                if($coleccionPartidas[$i]["intentos"] == 1)
                $contadorIntentos1++;
                elseif($coleccionPartidas[$i]["intentos"] == 2)
                $contadorIntentos2++;
                elseif($coleccionPartidas[$i]["intentos"] == 3)
                $contadorIntentos3++;
                elseif($coleccionPartidas[$i]["intentos"] == 4)
                $contadorIntentos4++;
                elseif($coleccionPartidas[$i]["intentos"] == 5)
                $contadorIntentos5++;
                elseif($coleccionPartidas[$i]["intentos"] == 6)
                $contadorIntentos6++;
            }
        }
    }
    if ($contadorPartidas > 0) {
        $resumenJugador = [
            "jugador" => $nombreJugador, 
            "partidas" => $contadorPartidas,
            "puntaje" => $contadorPuntaje,
            "victorias" => $contadorVictorias,
            "intentos" . 1  => $contadorIntentos1,
            "intentos" . 2  => $contadorIntentos2,
            "intentos" . 3  => $contadorIntentos3,
            "intentos" . 4  => $contadorIntentos4,
            "intentos" . 5  => $contadorIntentos5,
            "intentos" . 6  => $contadorIntentos6
        ];
    }

    return $resumenJugador;
}

//EXPLICACIÓN 3 PUNTO 3
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
     $opc = solicitarNumeroEntre(1, 8);
     return $opc;
 }
 

 //EXPLICACIÓN 3 PUNTO 10
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
         $esLetra = ctype_alpha($nombreJ[$i]); // Verifica si el carácter en la posición actual $i de la cadena es una letra del alfabeto
     }return strtolower($nombreJ); // Devuelve el usuario en minúsculas
 }
 
 //EXPLICACIÓN 3 PUNTO 6
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
    //bool $existe
    $numPartidas = count($partidasC);
    $existe = false;
    
    $i = 0;
    while ($i < $numPartidas && $existe == false) {

        if ($partidasC[$i]["jugador"] == $jugador && strtolower($partidasC[$i]["palabraWordix"]) == strtolower($palabra)) { // strtolower — Convierte un string a minúsculas
            $existe = true;
        }

        $i++;
    }
    
    return $existe;
}


//EXPLICACIÓN 3 PUNTO 7
/**
 * Función que agrega una nueva palabra al array con la colección de palabras para jugar
 * @param array $palabraColeccion
 * @param string $palabra
 * @return array //retorna el array con la nueva palabra
 */
function agregarPalabra($palabraColeccion, $palabra)
{
    $palabraColeccion[] = $palabra;
    //Si no se especifica una clave,
    //se toma el máximo de los índices int existentes, y la nueva clave será ese valor máximo más 1
    //(aunque al menos 0). Si todavía no existen índices int, la clave será 0 (cero).
    return $palabraColeccion;
}


//EXPLICACIÓN 3 PUNTO 8
/**
 * funcion que  dada una colección de partidas y el nombre de un jugador, retorne el índice de la primer
 * partida ganada por dicho jugador. Si el jugador ganó ninguna partida, la función debe retornar el valor -1
 * @param array $partidasColeccion
 * @param string $jugador
 * @return int
 */
function primerPartidaGanadaPor($partidasColeccion, $jugador) {
    //int $i, $cantPartidas, $indicePartidas
    $i = 0;
    $cantPartidas = count($partidasColeccion);
    $indicePartida = -1;

    while ($indicePartida == -1 && $i < $cantPartidas) {
        if ($partidasColeccion[$i]["jugador"] == $jugador && $partidasColeccion[$i]["puntaje"] > 0) {
            $indicePartida = $i;
        }
        $i++;
    }

    return $indicePartida;
}

//EXPLICACIÓN 3 PUNTO 11
/**
 * Funcion que sirve como parametro para uasort para comparar los elementos de un arreglo
 * @param array $partida1
 * @param array $partida2
 * @return int
*/ 
function comparacionPartidas($partida1, $partida2) {
    //int $num
    // Comparamos por jugador y luego por palabra
    if ($partida1["jugador"] < $partida2["jugador"]) {
        $num= -1;
    } elseif ($partida1["jugador"] > $partida2["jugador"]) {
        $num = 1;
    } else {
        // Los jugadores son iguales, comparamos por palabra
        if ($partida1["palabraWordix"] < $partida2["palabraWordix"]) {
            $num = -1;
        } elseif ($partida1["palabraWordix"] > $partida2["palabraWordix"]) {
            $num = 1;
        } else {
            $num = 0;
        }
    } return $num;
}

//EXPLICACIÓN 3 PUNTO 11
/**
 * Función sin retorno que muestra ordena un arreglo y luego lo muestra por pantalla
 * @param array $coleccionPartidas
 */
function ordenarPartidas($coleccionPartidas)
{
    uasort($coleccionPartidas, 'comparacionPartidas'); //Ordena un array con una función de comparación definida por el usuario y mantiene la asociación de índices
    print_r($coleccionPartidas); //Imprime el arreglo ordenado por pantalla
}



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

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
            $numPalabra = solicitarNumeroEntre(1, $cantPalabras);
            $partida = jugarWordix($coleccionPalabras[$numPalabra-1], $nombreJugador);
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
            $i = 1;

           // Verificar que la palabra no ha sido usada por el jugador antes
            while (existePalabraEnPartidas($nombreJugador, $coleccionPalabras[$numRandom], $partidasCargadas) && $i <= $cantPalabras) {
              $numRandom = random_int(0, $cantPalabras - 1); 
              $i++;
            }

            if ($i != $cantPalabras + 1){
                $partida = jugarWordix($coleccionPalabras[$numRandom], $nombreJugador);
                $partidasCargadas[] = [
                     "palabraWordix" => $partida["palabraWordix"],
                     "jugador" => $nombreJugador,
                     "intentos" => $partida["intentos"],
                     "puntaje" => $partida["puntaje"]
                ];
            } else {
                echo "\n─────▄───▄ \n";
                echo "─▄█▄─█▀█▀█─▄█▄ \n";
                echo "▀▀████▄█▄████▀▀\n";
                echo "─────▀█▀█▀ \n";
                echo "Error, el jugador ". $nombreJugador  . ":\n";
                echo "ya jugó con todas las palabras";
                echo "\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
            }
            break;
        case 3: 
            //int  $cantPartidas
            $cantPartidas = count($partidasCargadas);

            echo "\nIngrese un número de partida: \n";
            $numPartida = trim(fgets(STDIN));
            $numPartida = $numPartida -1;

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
                for($i=1; $i <= 6; $i++){
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

           break;
        case 8: 
                echo "\n\n❀.•° ✿.•° ❀.•° ✿.•°•.✿ °•.❀ °•.✿ °•.❀ \n";
                echo "  Gracias por utilizar el programa \n";
                echo "❀.•° ✿.•° ❀.•° ✿.•°•.✿ °•.❀ °•.✿ °•.❀ \n\n";
            break; 

    }
} while ($opcion != 8);

?>
