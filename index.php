<?php
// Cargamos todas las clases que vamos a usar.
require_once 'Monoplaza.php';
require_once 'F4.php';
require_once 'F3.php';
require_once 'F2.php';
require_once 'F1.php';
require_once 'FAcademy.php';


$f3 = new F3("Pepe", "Española", 7, "Campos", 0, "Academia X");
// Le damos puntos por quedar en posición 1 y dice que hizo vuelta rápida (pero F3 no da punto por vuelta rápida).
$f3->otorgarPuntos(1, true); // 10 puntos (F3 no da punto por vuelta rápida)
echo "Puntos F3: " . $f3->getPuntos() . "<br>";

$f1 = new F1("Juan", "Española", 14, "Aston Martin", 0, "Aramco");
// Le damos puntos por quedar en posición 1 y vuelta rápida. F1 sí da punto extra por vuelta rápida.
$f1->otorgarPuntos(1, true);          // 25 + 1 = 26
echo "Puntos F1: " . $f1->getPuntos() . "<br>";

// Comprobamos si la posición 23 es válida en F1 (debería ser false porque solo hay 22 pilotos).
var_dump($f1->posicionValida(23));    // false (en F1 hay 22 pilotos)
echo "<br>";


$f2 = $f3->subirCategoria("Prema", true); // Ok, tiene superlicencia, sube a F2 con 0 puntos.
// Ese F2 sube de F2 a F1 con el equipo "Williams" y patrocinador "Sparco".
$nuevoF1 = $f2->subirCategoria("Williams", "Sparco");
// Mostramos si realmente subió a F1 (sí o no).
echo "Ha subido a F1: " . (($nuevoF1 instanceof F1) ? "sí" : "no") . "<br><br>";

// ---------- LLAMADA A LA API (OpenF1) ----------

// Pedimos los datos de un piloto por su número (session_key=latest = la última sesión de carrera).
function pedirPiloto($numero) {
    // Construimos la dirección de internet (URL) con el número del piloto.
    $url = "https://api.openf1.org/v1/drivers?driver_number=" . $numero . "&session_key=latest";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $respuesta = curl_exec($ch);
    // Convertimos el texto de respuesta (JSON) en un array de PHP para poder usarlo.
    return json_decode($respuesta, true);
}

// Probamos la función con los números de piloto 16 y 44.
foreach ([16, 44] as $numero) {
    $datos = pedirPiloto($numero);  // Pedimos los datos del piloto.
    // Mostramos el nombre y el equipo del piloto.
    echo "Piloto " . $numero . ": " . $datos[0]['full_name'] . " - " . $datos[0]['team_name'] . "<br>";
}

// ---------- EXTRA -------------

// 1. Usamos una página gratuita que sirve para hacer pruebas de envío de datos.
$url = "https://jsonplaceholder.typicode.com/posts";

// 2. Preparamos los datos que queremos enviar.
$datos = [
    "title" => "Nuevo piloto registrado",   // Título del mensaje.
    "body" => "Pepe ha sido añadido a la base de datos.",  // Contenido del mensaje.
    "userId" => 1                           // ID del usuario que lo envía.
];

// 3. Configuramos cURL para enviar los datos.
$ch = curl_init($url);                                                   // Iniciamos la conexión a la URL.
curl_setopt($ch, CURLOPT_POST, true);                                    // Decimos que usamos el método POST (enviar datos).
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));               // Convertimos el array a texto JSON para enviarlo.
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Avisamos al servidor que el contenido es JSON.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                          // Que nos devuelva la respuesta como texto.
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                         // Evita fallos de https en tu servidor local.

// 4. Ejecutamos y guardamos lo que nos responde el servidor.
$respuesta = curl_exec($ch);

// 5. Mostramos la respuesta
echo "<h3>Respuesta del servidor al enviar el POST:</h3>";
echo "<pre>" . $respuesta . "</pre>";