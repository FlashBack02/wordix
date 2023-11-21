<?php
/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Roldán, Magdalena. FAI 2855. Tecnicatura en desarrollo web. magdaroland7@gmail.com . magdaRoland  */
/* Reile, Ariana Belen. FAI 5056. Tecnicatura en desarrollo web. arireile02@gmail.com. FlashBack02 */

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


//EXPLICACIÓN 3 PUNTO 5
/**
 *  Solicita un número entero que esté entre dos números dados como parámetros, la función verifica que el número sea un INT
 *  y además verifica que el número esté en el rango correcto, de ser correcto retorna el número dado.
 * @param int $min
 * @param int $max
 * @retur int
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    echo "\nIngrese un número entero entre:  ". $min . " y " . $max . "\n";
    $numero = trim(fgets(STDIN));

    if (is_numeric($numero)) { //determina si un string es un número. puede ser float como entero.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
        if (is_numeric($numero)) {
            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * Escribe un mensaje de bienvenida con el nombre del usuario en amarillo.
 * @param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/**
 * Verifica si una cadena dada está compuesta únicamente por letras (alfabéticas).
 * Retorna true si toda la cadena de texto solo tiene letras y false si no.
 * @param string $cadena
 * @return boolean
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i
    //boolean $esLetra
    $cantCaracteres = strlen($cadena); //  Obtiene la longitud de la cadena. STRLEN = convierte un strean en INT
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]); // Verifica si el carácter en la posición actual $i de la cadena es una letra del alfabeto. CTYPE_ALPHA = Verifica que los caracteres sean LETRAS.
        $i++;
    }
    return $esLetra;
}

//EXPLICACIÓN 3 PUNTO 4
/**
 *  Solicita al usuario que ingrese una palabra de exactamente 5 letras y verifica que sí sea.
 * Y retorna la palabra en mayúsculas.
 * @return string
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra); // STROTOUPPER = Convierte la palabra ingresada a mayúscula.

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) { //STRLEN = convierte un strean en INT
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: asociativo
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) { 
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix); // COUNT = Cuenta el número de elementos en un array u objeto
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    //int $cantCaracteres
    //array $estructuraPalabraIntento
    //string $letraIntento
    $cantCaracteres = strlen($palabraIntento); //STRLEN = convierte un string en INT
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento); // STROPOS = encontra la posición de la primera aparición de una subcadena dentro de otra cadena.
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]); // ARRAY_PUSH =  Agrega uno o más elementos al final de un array
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    //array $letra, $estado, $teclado
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    //int  $cantLetras, $i
    //bool $ganado
    $cantLetras = count($estructuraPalabraIntento); // COUNT = Cuenta el número de elementos en un array u objeto
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Funcion que obtiene el puntaje segun la cantidad de intentos y las letras que se encuentran en la palabra
 * @param string $palabraIntento
 * @param int $nroIntento
 * @return int
 */
function obtenerPuntajeWordix ($palabraIntento, $nroIntento){
    //int $vocalesEncontradas, $letrasGrupo1, $letrasGrupo2, $sumaIntento, $palabraIntento, $longitud, $i, $puntosLetra, $sumaIntento
    //string $palabraIntento
    $vocalesEncontradas = 0;
    $letrasGrupo1= 0;
    $letrasGrupo2= 0;
    $sumaIntento = 0;
    $palabraIntento = strtolower($palabraIntento); //Convertimos toda la cadena a minúscula
    //La función in_array realiza comparaciones sensibles a mayúsculas y minúsculas. 
    //Si no convertimos la palabra a minúsculas antes de comparar, 
    //Podríamos tener resultados erróneos

    $longitud = strlen($palabraIntento); //obtenemos las logitud de la palabra

    for ($i = 0; $i < $longitud; $i++) { 


        if (in_array($palabraIntento[$i], ["a", "e", "i", "o", "u"])) //Ahora vemos si un carácter está dentro del arreglo ["a", "e", "i", "o", "u"]
        {
            $vocalesEncontradas++;
        }elseif (in_array($palabraIntento[$i], ["b", "c", "d", "f", "g", "h","j","k","l", "m"]))
        {
            $letrasGrupo1++; 
        }elseif (in_array($palabraIntento[$i], ["n", "o", "p", "q", "r", "s","t","v","w", "x","y","z"]))
        {
            $letrasGrupo2++; 
        }
    }
    if($nroIntento == 1) {
        $sumaIntento = 6;
    }elseif($nroIntento == 2) {
        $sumaIntento = 5;
    }elseif($nroIntento == 3) {
        $sumaIntento = 4;
    }elseif($nroIntento == 4) {
        $sumaIntento = 3;
    }elseif($nroIntento == 5) {
        $sumaIntento = 2;
    }elseif($nroIntento == 6) {
        $sumaIntento = 1;
    }

    $puntosLetras = $vocalesEncontradas + ($letrasGrupo1*2) + ($letrasGrupo2*3) + $sumaIntento;
    return $puntosLetras;//Este modulo retorna un INT con el total de los puntos por letra e intentos
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($palabraWordix, $nroIntento);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}

?>