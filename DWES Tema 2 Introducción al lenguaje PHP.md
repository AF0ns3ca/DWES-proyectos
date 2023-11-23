# 1. PHP y HTML. Código incrustado
PHP es el lenguaje de programación para desarrollo web en el lado del servidor. Desde su aparición en 1994 ha tenido gran aceptación y se puede decir que es lenguaje más extendido para el desarrollo en el lado del servidor. Aunque no es la única opción, lo normal es que el intérprete de PHP sea un módulo del servidor web.

El lenguaje PHP es flexible y permite programar pequeños scripts con rapidez. Comparado con lenguajes como Java, requiere escribir menos código y, en general, resulta menos engorroso.

La sintaxis de los elementos básicos es bastante parecida a la de lenguajes muy extendidos como Java y C. Por estos motivos, es un lenguaje rápido de aprender para las personas con alguna experiencia en programación.

En este capítulo se presentan la sintaxis y los elementos básicos del lenguaje PHP. Se espera que el lector esté familiarizado con los conceptos básicos de programación estructurada y orientada a objetos.

En el desarrollo web es muy habitual utilizar PHP incrustado dentro ficheros HTML. El código PHP se introduce dentro del HTML utilizando la etiqueta `<? php` para abrir el bloque de PHP y la etiqueta `?>` para cerrarlo.

El ejemplo hola_mundo. php muestra una página HTML completa con un bloque PHP

```php
<!/DOCTYPE html>
<html>
	<head>
		<title>Hola mundo</title>
	</head>
	<body>
		<?php
			echo "Hola mundo";
		?>
	</body>
</html>
```

Si abrimos la página en un navegador (desde el servidor, no desde el explorador de archivos), veremos por pantalla el mensaje:

Hola mundo

Y si consultamos el código fuente con las herramientas de desarrollador, veremos el siguiente html:

```html
<!/DOCTYPE html>
<html>
	<head>
		<title>Hola mundo</title>
	</head>
	<body>
		Hola mundo
	</body>
</html>
```

Vemos que el servidor ha modificado una parte del fichero. En lugar del bloque PHP, aparece "Hola mundo"; la cadena que pedíamos que devolviese a través de la instrucción `echo`.

# 2. Sintaxis de PHP
El elemento básico es el bloque. Un bloque viene delimitado por las etiquetas correspondientes, y sus sentencias separadas por punto y coma.

```php
<?php
	sentencia1;
	sentenciaN
?>
```

Si dentro de un fichero, solo tenemos PHP, es recomendable no cerrar la etiqueta del último bloque; puede llevar a problemas si trabajamos con varios ficheros.
# 3. Variables y tipos de dato
PHP es un lenguaje no fuertemente tipado. No necesitamos indicar el tipo de dato cuando declaramos una variable. Las variables se crean cuando se les asigna un valor por primera vez, y el tipo depende del valor con que se inicialicen.

Esto agiliza la codificación de programas, pero tiene inconvenientes; puede llevar a errores y a un código de baja calidad si no se presta atención. Los errores en aplicaciones de gran tamaño pueden ser más difíciles de depurar.

## 3.1. Declaración de variables
Los identificadores de variables van precedidos por el carácter `$`. Debe comenzar por una letra o un guion bajo `_` y puede estar formado por números, letras y guiones bajos.
Para declararla, solo hay que asignarle un valor:

```php
$nombre = valor;
```

También es posible cambiar el tipo de dato de una variable simplemente asignándole un valor de otro tipo de dato, como se puede ver en el ejemplo tipos_dato php (líneas 8-12). El ejemplo utiliza la función `gettype `, que devuelve el tipo de dato de una variable.
```php
<?php
/* declaración de variables */
$entero = 4; // tipo integer
$numero = 4.5; // tipo coma flotante
$cadena = "cadena"; // tipo cadena de caracteres
$bool = TRUE; // tipo booleano
/* cambio de tipo de una variable */
$a = 5; // entero
echo gettype($a); // imprime el tipo de dato de a
echo "<br>";
$a = "Hola"; // cambia a cadena
echo gettype($a); // se comprueba que ha cambiado
```

La salida de este programa confirma que la variable ha cambiado de tipo de dato.

## 3.2. Asignación por copia y por referencia
En principio, la asignación de variables se realiza mediante copia. Es decir, si hacemos:

```php
$a = $b;
``` 

se crea una nueva variable *a* y se le asigna el valor que tenga *b*. Las variables *a* y *b* representan posiciones diferentes de memoria, aunque tengan el mismo valor después de la asignación.

También es posible definir una referencia a una variable utilizando el operador ampersand:
```php
$var2 = &$var1;
```

Con esta operación, no creamos una variable `$var2` con el valor de `$var1`, sino una variable que apunta a la misma dirección de memoria que `$var1`. Podemos pensar que tenemos dos nombres (`$var1` y `$var2`) que se refieren al mismo dato en memoria.
## 3.3. Constantes
Utilizamos la función `define()`para definir constantes. Recibe el nombre de la constante y el valor que queremos darle. El nombre se suele escribir en mayúsculas.
```php
define("MINIMO", 20);
```
## 3.4. Tipos de datos escalares.
PHP presenta cuatro tipos: *integer*, *float*, *boolean* y *string*.
### 3.5.1. Números
Podemos hallar el tamaño, los valores mínimos y los valores máximos con las constantes globales PHP_INT_SIZE, PHP_INT_MIN y PHP_INT_MAX.

Para números reales utilizaremos el tipo *float*. La conversión entre integer y float se realiza de forma automática, pero se pueden utilizar también operadores de conversión `(int)`o `(float)`.
```php
echo PHP_INT_SIZE . '<br>'; // tamaño en bytes
echo PHP_INT_MIN . '<br>';
echo PHP_INT_MAX . '<br>';
$a = 3 / 2; // división de enteros no da problemas
echo $a . '<br>';
$b = 7.6;
$a = (int) $b; // casting a int
echo $a . '<br>'; // 7 se trunca
$b = 7e2; // notación científica
echo $b . '<br>';
$b = 7E2;
echo $b . '<br>'; // equivalentes
```

### 3.5.2. Cadenas
Las variables de tipo *string* almacenan cadenas de caracteres. Se utilizan comillas simples o dobles (conocidas como *comillas mágicas*). Las dobles son útiles para insertar directamente variables en lugar de concatenarlas.
```php
$var = "Paco";
$a = "Hola $var <br>"; //Comillas mágicas!
$b = 'Hola $var';
$c = "<br>"."hola ".$var;
echo $a;
echo $b;
echo $c;
```

Salida:

Hola Paco
Hola $var
Hola Paco

### 3.5.3. Booleanos
 Solo puede tomar los valores TRUE y FALSE. Pero se pueden valorar otros tipos de dato como booleanos tal y como se observa en el código a continuación:
```php
$a = 23; //true
$b = 0; //false
$c = 0.0; //false
$d = '0'; // false
$e = 'hola'; //true
$f = null; // false
$g = []; // false
$h = ['gominolas', 'chicle']; // true

if ($a) {
echo 'a distinto de 0<br>';
}

if (!$b) {
echo 'b es 0<br>';
}

if (!$c) {
echo 'c es 0<br>';
}

if (!$d) {
echo 'd es string 0<br>';
}

if ($e) {
echo 'e es string hola<br>';
}

if (!$f) {
echo 'f es null<br>';
}

if (!$g) {
echo 'g es un array vacío<br>';
}

if ($h) {
echo 'h es un array no vacío<br>';
}
```

### 3.5.4. Otros tipos de datos
1. ﻿﻿﻿*array*. Alberga colecciones de elementos. Explicados más adelante.
2. ﻿﻿﻿*object*, PHP soporta POO.
3. ﻿﻿﻿*callable*. Tipo de función que se puede pasar como argumento a otra.
4. ﻿﻿﻿*null*. El valor que alberga una variable no asignada.
5. ﻿﻿﻿*resource*. Un recurso externo como una conexión a una base de datos.

### 3.5.5. Variables predefinidas
`$GLOBALS`
Variables globales definidas en la aplicación

- `$_SERVER`: Información sobre el servidor
- `$_GET`: Parámetros enviados con el método GET (en la URL)
- `$_POST`: Parámetros enviados con el método POST (formularios)
- `$ FILES`: Ficheros subidos al servidor
- `$ COOKIE` : Cookies enviadas por el cliente
- `$ SESSION`: Información de sesión
- `$ REQUEST`: Contiene la información de $_GET, $_POST y $_COOKIE
- `$ ENV`: Variables de entorno

# 4. Comentarios
Los comentarios de PHP se pueden escribir de varias formas:

```php
// Comentario de una línea
#  Comentario de una línea
/* Comentario de una o varias líneas */
```

# 5. Estructuras de control

Vamos a hacer un repaso muy rápido por las estructuras de control de PHP. Si ya conoces otros lenguajes como Java, todas te resultarán familiares.

## 5.1. Condicionales

El condicional doble tiene la sintaxis habitual:

```php
if (condición) {
	acciones-1;
} else {
	acciones-2;
}
```

Por supuesto, la parte del `else` puede eliminarse si no la necesitas, y obtendrías un condicional simple.

## 5.2. Bucle while

El bucle de _tipo while_ tiene este aspecto:

```php
while (condición) {
	acciones;
}
```

## 5.3. Bucle repeat

El bucle de _tipo repeat_, es decir, con la condición al final, tiene esta sintaxis:

```php
do {
	acciones;
} while (condición);
```

## 5.4. Bucles for y foreach

El bucle _for_ controlado por contador es idéntico a C/C++ y Java:

```php
for (inicialización; condición; incremento) {
	acciones;
}
```

Hay una variedad de bucle _for_ muy interesante: el bucle _foreach_ para recorrido de arrays asociativos:

```php
foreach ($array as $índice=>$var) {
	acciones;
}
```

El bucle _foreach_ se repite una vez para cada valor guardado en el array. Ese valor se asigna a la variable _$var_ en cada repetición.

Por ejemplo:

```php
$a["ESP"] = "España";
$a["FRA"] = "Francia";
$a["POR"] = "Portugal";

foreach ($a as $pais=>$codigo) {
    echo "Nombre del país: $pais - Código: $codigo<br>";
}
```

La salida de este programa será:

```
Nombre del país: España - Código: ESP
Nombre del país: Francia - Código: FRA
Nombre del país: Portugal - Código: POR
```

## 5.5. break y continue

Como en muchos otros lenguajes, las instrucciones **break** y **continue** pueden usarse en el interior del cuerpo de los bucles para lograr este comportamiento:

- `break`. “Rompe” el bucle, es decir, se sale del bucle y continúa ejecutando el programa por la instrucción que haya inmediatamente después del mismo.
- `continue`. Deja de ejecutar la iteración actual y vuelve al comienzo del bucle para iniciar una nueva iteración.

## 5.6. Sintaxis alternativa con dos puntos

Las estructuras de control de PHP tienen una sintaxis alternativa que elimina el uso de las llaves, muy denostadas por algunos programadores. Por ejemplo, una instrucción _if_ puede escribirse de forma tradicional:

```php
if ($i < 0) {
    echo "La variable es menor que cero";
}
```

…o bien con la “sintaxis dos puntos”:

```php
if ($i < 0):
    echo "La variable es menor que cero";
endif;
```

La sintaxis con dos puntos viene muy bien cuando se quiere insertar html complejo dentro del bloque, ya que nos facilita la tarea. Podemos cerrar la etiqueta de php, usar html, abrir etiquetas de php dentro del bloque, y abrir una nueva de php para cerrar el bloque. Se puede apreciar en el siguiente ejemplo:

```php
<?php foreach ($filteredBooks as $book) : ?>
	<li>
	<a href="<?= $book['purchaseUrl'] ?>">
	<?= $book['name']; ?>
	</a>
	</li>
<?php endforeach; ?>
```

# 6. Operadores
Los operadores en PHP son iguales que los de Java, que, a su vez, los heredó de C/C++:

- Asignación: `$a = 3`;
- Comparación: ==, <=, >=, !=, <=>, etc.
- Operadores aritméticos: +, -, *, /, %…
- Operadores lógicos: &&, ||, !
- Operadores de asignación combinados: +=, -=, ++, –, *=, /=, etc

Existen operadores más esotéricos, como el operador ternario o los operadores a nivel de bit, que no usaremos demasiado. 

**Operador nave espacial**. Así se conoce el operador <==>. Se usa para comparar dos expresiones y decidir cuál es la menor. Devuelve -1 (si la primera expresión es menor que la segunda), 0 (si son iguales) o 1 (si la primera expresión es mayor que la segunda):

```php
$resultado = $var1 <==> $var2;
echo $resultado;   // Mostrará -1, 0 o 1, dependiendo de los valores de $var1 y $var2
```

# 7. Arrays
Los arrays en PHP son colecciones de variables del mismo o de distinto tipo identificadas por un índice. Se parecen más a los ArrayList de Java que a los arrays clásicos propiamente dichos.

```php
$a[1] = "lunes";
$a[2] = 1;        // El array de PHP puede contener datos de diferente tipo en cada elemento
$a[3] = "martes";
$a[4] = 2;
etc.
```

El índice no tiene por qué ser un número entero: puede ser un String (array asociativo):

```php
$a["ESP"] = "España";
$a["FRA"] = "Francia";
$a["POR"] = "Portugal";
```

Como los arrays son objetos, dispones de un montón de métodos y atributos para consultarlos y manipularlos. No es mi intención proporcionarte aquí una lista exhaustiva, porque son muchos y para eso ya está la documentación oficial, pero sí te voy a mostrar algunos que te permitan hacerte una idea:

- `count($a)`: devuelve el número de elementos del array $a.
- `in_array(“valor”, $a)`: busca el elemento “valor” en el array $a. Devuelve _true_ o _false_.
- `unset($a[4])`: elimina un elemento (el 4, en este ejemplo) del array $a.
- `next($a)`: devuelve el siguiente elemento de un array (el primero, si es la primera vez que se invoca).
- `prev($a)`: devuelve el elemento anterior de un array (el último si es la primera vez que se invoca).
- `array_push($a, $elemento)`: añade el $elemento al final del array $a.
- `$elemento = array_pop($a)`: elimina el último elemento del array $a (y lo asigna a la variable $elemento).
- `sort($a)` y `asort($a)`: ordena el array `$a. sort()` se utiliza con arrays convencionales y `asort()` con arrays asociativos.

# 8. Funciones
Los subprogramas (funciones y procedimientos) se escriben en PHP del mismo modo: con la palabra _function_.

- Las **funciones** deben devolver un valor en su última línea con _return_. Si necesitas devolver varios valores, puedes empaquetarlos en un array o en un objeto. Ten en cuenta que, después de un _return_, la función terminará de forma inmediata y devolverá el control de ejecución al código desde la que fue invocada. Es decir: cualquier línea de código de la función que esté por debajo del _return_ nunca se ejecutará.
- Los **procedimientos** no tienen _return_. Realizan su función y terminan.

Los **argumentos** de las funciones o procedimientos en PHP siembre se pasan **_por valor_**, es decir, se copiará en el parámetro de la función el _valor_ de la variable con la que se invoca a dicha función, pero serán dos variables distintas. Si modificamos un parámetro dentro del código de la función, la variable con la que fue invocada no se verá afectada.

Veámoslo con un ejemplo. Esta es una función con dos argumentos:

```php
function calcular_iva($base, $porcentaje)
{
   $total = $base * $porcentaje / 100;
   return $total;
}
```

Para invocar a esta función, haremos algo como esto en algún otro punto del código fuente:

```php
$iva = $calcular_iva($precio_del_articulo, 21);
```

En esta ocasión, hemos invocado a la función `$calcular_iva()` con dos parámetros: una variable (`$precio_del_articulo`) y una constante literal (`21`). Ambos parámetros se pasan por valor a la función. Eso significa que el valor de `$precio_del_articulo` se copia en el parámetro `$base`, y el valor del literal `21` se copia en `$porcentaje`. Cualquier modificación de `$base` o `$porcentaje` que pudiera producirse dentro del código de la función, no afectaría para nada a las variables originales (`$precio_del_articulo` y el literal `21`). Por último, la función devuelve un valor mediante su `return` y ese valor se asigna a la variable `$iva`.

En el siguiente código pasamos una variable por referencia utilizando el operador `&` antes de la variable en la cabecera de nuestra función. No es necesario utilizar `&` cuando escribimos la variable en la llamada a la función.
```php
// Definimos una función que incrementa el valor de la variable pasada por referencia
function incrementar(&$numero) {
    $numero++;
}
// Declaramos una variable con el valor 5
$valor = 5;
// Imprimimos el valor antes de llamar a la función
echo "Valor antes de la función: " . $valor . "<br>";
// Llamamos a la función pasando la variable $valor por referencia
incrementar($valor);
// Imprimimos el valor después de llamar a la función
echo "Valor después de la función: " . $valor;
```
y obtendríamos como resultado por pantalla:
5
6

## 8.1. Definir el tipo de los argumentos

Desde PHP7, se puede definir el tipo de los argumentos de cualquier función:

```php
function calcular_iva(float $base, float $porcentaje) {
    ...
}
```

Esto es completamente optativo. Ahora bien, si defines el tipo de los argumentos y luego le pasas a la función un argumento de otro tipo, obtendrás un error de ejecución _TypeError_, como es lógico.

## 8.2. Definir el tipo de la función

Desde PHP7 también se puede, optativamente, definir el tipo de datos que devolverá la función en el _return_:

```php
function calcular_iva(float $base, float $porcentaje): float {
    ...
}
```

Esto provocará que se evalúe de forma estricta el tipo de datos durante la invocación a la función y que se puedan producir errores de tipo (_TypeError_) en tiempo de ejecución, como es natural.

## 8.3. Argumentos con valor predefinido

Algo muy útil que nos ofrece PHP es la posibilidad de asignar un valor por defecto a los argumentos de las funciones. Observa este ejemplo:

```php
function calcular_iva($base, $porcentaje = 0.21) {
    ...
}
```

El argumento _$porcentaje_ tiene un valor por defecto, 0.21. Eso significa que podemos invocar esta función de dos maneras:

```php
$a = calcular_iva(1000, 0.04); // Calculará el IVA de 1000 euros con un porcentaje del 4%
$b = calcular_iva(1000);       // Calculará el IVA de 1000 euros con un porcentaje del 21%
```

Como ves, en la primera invocación pasamos un valor para el argumento `$porcentaje`(`0.04`), por lo que ese argumento tomará ese valor. En cambio, en la segunda invocación nos olvidamos del segundo parámetro. Esto que provocaría un error en otros lenguajes de programación, en PHP se puede ejecutar porque le hemos asignado un valor por defecto a `$porcentaje`.

Eso significa que, si no le pasamos ningún valor, el argumento tomará su valor por defecto (`0.21`), y la función se ejecutará con ese valor asignado a esa variable.

## 8.4. Funciones anónimas o _closures_
Se trata de funciones que no tienen nombre y que se usan directamente en una asignación a una variable o como parámetro de otra función.

Es buena idea utilizar funciones anónimas solo cuando la función en cuestión no va a invocarse nunca desde ningún otro punto del programa: el hecho de no asignarles nombre hace que su código no sea reutilizable.

Aquí puedes ver un ejemplo sencillo de función anónima:

```php
$numero = 8;
$doble = function(int $numero) {
    return $numero * 2;
}
echo $doble;   // Imprimirá 16
```

## 8.5. Include y require

Cuando desarrollamos mucho código, a menudo colocamos colecciones de funciones (llamadas **bibliotecas**) en archivos diferentes que el resto del código.

Para usar una función definida en otro archivo, necesitamos incluir ese código en nuestro archivo actual. Para ello utilizaremos  `include` y `require`:

- `include` se utiliza para incluir el código fuente de la biblioteca en nuestro archivo actual. Si la biblioteca no se encuentra, se produce un error de ejecución, pero el script actual continúa ejecutándose.
- `require` también se utiliza para incluir el código fuente de la biblioteca en nuestro archivo actual. Pero si la biblioteca no se encuentra, se produce un error de ejecución y el script actual se detiene.

Las variantes `include_once` y `require_once` se utilizan para evitar las inclusiones repetidas de código. Estas suelen ocurrir cuando nuestro programa es muy grande y varios scripts incluyen las mismas bibliotecas.

```php
include_once "mi_biblioteca.php";    // Incluye las funciones del archivo mi_biblioteca.php
```

El uso de _include_ y _require_ está en retroceso gracias a los **espacios con nombre** de las versiones recientes de PHP. Más adelante hablaremos de ellos.

# 9.  Excepciones y errores

El sistema de control de errores de PHP ha ido evolucionando a lo largo de las versiones. En el sistema básico, se generan errores de diferentes tipos, representados por un número. Por otro lado, desde PHP 5 hay un sistema de excepciones similar al de Java y otros lenguajes utilizando bloques `try/catch/finally`. Finalmente, en PHP 7 aparecieron las excepciones de clase Error.

## 9.1. Errores
En el sistema básico, ante determinadas condiciones (por ejemplo, utilizar una variable no inicializada) PHP genera un error. Hay diferentes tipos de errores, cada uno asociado con un número y una constante predefinida. Se puede controlar cómo se comporta PHP ante los errores mediante tres directivas del fichero php.ini:

- `error_reporting`: indica qué errores deben reportarse. Lo normal es utilizar `E_ALL`, es decir, todos.
- `display_errors`: señala si los mensajes de error deben aparecer en la salida del  script. Esta opción es apropiada durante el desarrollo, pero no en producción.
- `log_errors`: indica si los mensajes de error deben almacenarse en un fichero. Es especialmente útil en producción, cuando no se muestran los errores en la salida.
- `error_log`: si la directiva anterior está activada, es la ruta en la que se guardan los mensajes de error.

El valor de la directiva `error_reporting` es un número, pero para especificarlo lo habitual es utilizar las constantes predefinidas y el operador `or` a nivel de bit.

![[Screenshot 2023-11-02 at 09.29.49.png]]

Ejemplo donde pedimos mostrar notificaciones y errores en tiempo de ejecución
```php
error_reporting(E_NOTICE | E_RUNTIME);
```

### Función propia
También es posible definir una función propia para que se encargue de los errores utilizando `set_error_handler ()`. La función que se ocupe de los errores tendrá que tener la siguiente firma:
```php
bool handler ( int $errno, string $errstr [, string $errfile [, int $errline [, array Serrcontext ]]]);
```

Podemos imaginar situaciones de uso:
- Enviar un correo al administrador si ocurre un error crítico.
- Personalizar los errores para el sitio web en concreto.
- Controlar si queremos seguir o no la ejecución.
- Guardar un registro detallado y compartirlo con un sistema de monitoreo.
- ...

El siguiente ejemplo muestra cómo utilizar `set_error_handler ()` para manejar los errores con una función propia. En este caso guardaremos en un archivo (`errors.log`) una cadena donde figuran el momento en que se produjo y los datos. El error predeterminado de PHP no se mostrará gracias al `return true` al final del `error_handler`.
```php
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Registrar el error en un archivo
    $log = date("Y-m-d H:i:s") . " [Error $errno] $errstr in $errfile on line $errline" . PHP_EOL;
    file_put_contents('errors.log', $log, FILE_APPEND);

    // Mostrar un mensaje personalizado al usuario
    echo "Lo sentimos, algo salió mal. Por favor, inténtalo de nuevo más tarde.";

    // No mostrar el error predeterminado de PHP
    return true;
}

// Establecer el manejador de errores personalizado
set_error_handler("customErrorHandler");

// Generar un error para probar el manejador
echo $undefined_variable;
```

## 9.2. Excepciones

Otra opción para indicar un error es lanzar una excepción. Para controlar las excepciones se utilizan bloques `try/catch/finally`, como en Java. Cuando se lanza una excepción y no es capturada por un bloque `catch`, la ejecución del programa se detiene. Si es capturada, se ejecuta el código del bloque correspondiente.

Para capturar una excepción se introduce la instrucción que puede causarla dentro de un bloque `try` y se añade el bloque `catch` correspondiente. Se puede añadir un bloque `finally`, que se ejecuta después del `try/catch`, haya habido excepción o no.
```php
try {
	instrucciones;
} catch(Exception e) {
	instrucciones;
} finally {
	instrucciones;
}
```
En el ejemplo `excepciones.PHP` declaramos dos funciones. En la primera, arrojamos un objeto de clase `Exception` si el segundo argumento es igual a 0, y en la segunda si es negativo. Para lanzar una excepción se utiliza `throw`, que recibe como argumento un objeto de clase `Exception` o de alguna subclase de esta.
```php
function dividir($num1, $num2) {
	if ($num2 == 0) {
		throw new Exception("No es posible dividir por cero.");
	}
	return $num1 / $num2;
} 

function calcularRaiz($numero) {
	if ($numero < 0) {
		throw new Exception("No es posible calcular la raíz cuadrada de un número negativo.");
	}
	return sqrt($numero);
}

echo "<h1>Inicio del programa</h1>";
try {
	echo dividir(10, 2) . "<br>"; // Esto funciona correctamente
	echo calcularRaiz(-1) . "<br>"; // Esto lanzará una excepción
	echo dividir(10, 0) . "<br>"; // Esto nunca se ejecutará debido a la excepción anterior
} catch (Exception $e) {
	echo "Ha ocurrido un error: " . $e->getMessage() . "<br>";
} finally {
	echo "Final del programa<br>";
}
```

# 10. Clases y objetos
A partir de la versión 5, PHP incluyó un completo soporte para orientación a objetos. Las clases, métodos y atributos se declaran de forma muy semejante a C++ y Java.

## 10.1 Declaración de clases

En este ejemplo puedes ver cómo se declara una clase en PHP. Observa cómo se indica la **herencia** (_extends_) y cómo se declara el **constructor** (`__construct()`):

```php
class MiClase extends ClaseMadre
{
    // Declaración de propiedades (atributos)
    public  $var1 = 'soy una variable pública de instancia';
    private $var2 = 'y yo soy otra variable de instancia, pero privada';

    // Método constructor (siempre se llama __construct)
    public function __construct($valor) {
        $this->var2 = $valor;
    }

    // Declaración de un método público
    public function mostrarVar() {
        echo $this->var2;
    }

    // Declaración de un método privado
    private function resetVar() {
       $this->var2 = '';
    }

    public function otroMetodo() {
        // ...etc...
    }
}
```

Algo que suele llamar la atención de los programadores que vienen de Java u otros lenguajes semejantes es que PHP **no utiliza la notación punto** para acceder a los miembros de una clase, sino la **notación flecha (->)**. Por eso en el ejemplo anterior ves cosas como _$this->var_ en lugar de _this.var_

## 10.2. Instanciación de objetos

Para **instanciar** un objeto de una clase, se usa la palabra **_new_**. El constructor puede llevar parámetros o no, como en Java. En el ejemplo anterior, el constructor tenía un argumento, así que _new_ se usará así:

```php
$miObjeto = new miClase('Estoy aprendiendo PHP');
$miObjeto->mostrarVar();
```

La salida de este programa sería “Estoy aprendiendo PHP”.

## 10.3. `$this` y `parent`

La variable **$this** se refiere siempre al objeto que está ejecutando el código, exactamente igual que en Java, Javascript y muchos otros lenguajes orientados a objeto.

A veces, cuando tenemos una jerarquía de clases y unas heredan de otras, necesitamos invocar algún método de la clase madre o superclase. En ese caso, usaremos la palabra `parent` seguida de la **notación cuatro puntos** (`::`). Observa cómo se hace en este ejemplo, en el que el constructor de la subclase invoca al constructor de la superclase:

```php
class MiClase {
    private $var1;
    public function __construct($param) {
        $this->var1 = $param;
    }
}

class MiSubclase extends MiClase {
    private $var2;
    public function __construct($param1, $param2) {
        $this->var2 = $param2;
        parent::__construct($param1);   // Llamada a un método de la superclase
    }
}
```

## 10.4. Miembros públicos, privados y protegidos

En PHP, mientras no se indique otra cosa, todos los miembros de una clase se considerarán públicos (_public_). Como en Java, existen tres niveles de visibilidad que podemos escoger para cada atributo y cada método:

- `public`: ese método o atributo es accesible desde el exterior de la clase.
- `private`: ese método o atributo solo puede usarse desde dentro de la clase.
- `protected`: ese método o atributo puede usarse desde dentro de la clase o desde cualquier clase hija.

## 10.5  Getters y setters

En PHP también es habitual, como en muchos lenguajes de programación, que los atributos sean a menudo privados y que existan métodos **_getters_** y **_setters_** que se encarguen de manipularlos adecuadamente, sin que se acceda a los datos de los objetos desde el exterior. Esto es esencial para que los objetos funcionen como “cajas negras”.

Los _getters_ suelen devolver el valor de un atributo, pero los _setters_, en otros lenguajes, no devuelven nada. Sin embargo, en PHP es costumbre que los _setters_ devuelvan el objeto completo, es decir, que terminen con un **_return $this_**. Así:

```php
class MiClase {
    private $var1 = "Esto es un atributo privado";
    // Getter
    public function getVar1() {
        return $var1;
    }
    // Setter
    public function setVar1($value) {
        $var1 = $value;
        return $this;   // Devolvemos el objeto al terminar
    }
}
```

Si lo hacemos así, estaremos creando lo que se llama un **fluent interface** o interfaz fluido, lo cual quiere decir que podremos encadenar varias invocaciones a métodos del objeto en una sola instrucción, algo que permite que el código se vea más organizado y legible.

Para ilustrar en qué consiste el _fluent interface_, vamos a poner un ejemplo. Imagina que la clase anterior tuviera más atributos (_$var1, $var2, $var3_, etc), cada uno con sus respectivos _setters_. La forma tradicional de invocarlos todos sería algo así:

```php
$obj = new MiClase();
$obj->setVar1($valor1);
$obj->setVar2($valor2);
$obj->setVar3($valor3);
// etc.
```

En cambio, si los _setters_ devuelven _this_ podemos usar un _fluent interface_ y escribirlo así:

```php
$obj = new MiClase();
$obj->setVar1($valor1)
    ->setVar2($valor2)
    ->setVar3($valor2);
```

Puede parecer un cambio insignificante, pero cuando los objetos son muy complejos, el código _fluent_ se hace mucho más legible que el código tradicional.

## 10.6 Clases abstractas e interfaces

Como Java y otros lenguajes orientados a objetos, PHP también permite construir **clases abstractas**, que son clases que no se pueden instanciar. El objetivo de estas clases, como recordarás, es crear un molde a partir del cual puedan heredar otras clases que sí sean instanciables.

Una clase abstracta se crea añadiendo la palabra _abstract_ a la definición de la clase:

```php
abstract class MiClase {
    ...
}
```

También existen los **interfaces**, que son parecidos a las clases abstractas pero no pueden incorporar nada de código a los métodos. Es decir, se trata de una mera definición de métodos. Todas las clases que usen ese interfaz deben respetar e implementar esos métodos. Esto se hace cuando queremos que una colección de clases independientes proporcionen un conjunto de métodos homogéneos.

Los interfaces se definen así:

```php
interface MiInterface {
    public function unMetodo();
    public function otroMetodo($parametro1, $parametro2);
    etc.
}
```

Posteriormente, todas las clases que vayan a usar ese interface deben declararse de este modo:

```php
class MiClase implements MiInterface {
    ...
}
```

## 10.7. Métodos estáticos

Los métodos estáticos en PHP funcionan igual que en Java: se usan cuando una clase no tiene estado (es decir, no tiene atributos), o bien cuando ese método no tiene nada que ver con el estado de los objetos, sino que responde exactamente igual para todas las instancias.

Los métodos estáticos se declaran así:

```php
class MiClase {
    // Esto es un método estático
    public static function miMetodo() {
        ...
    }
}
```

Para invocar un método estático, como es lógico, no es necesario instanciar ningún objeto. De hecho, si intentamos invocarlo a través de un objeto, fallará. Estos métodos se invocan a través del nombre de la clase directamente, usando la **notación cuatro puntos** (`::`):

```php
// Esto invocará el método estático del ejemplo anterior
MiClase::miMetodo();
```




