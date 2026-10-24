
<?php
class Sucesion
{

    /*
        Esta funcion recibe un numero ($n) y construye
        una lista con los numeros de Fibonacci.
    */
    public function calcularFibonacci($n)
    {

        /*
            Si el numero es menor o igual a cero,
            devuelve una lista que contiene solamente el cero.
        */
        if ($n <= 0) {
            return [0];
        }

        /*
            Crea la lista inicial con los dos primeros
            numeros de Fibonacci: 0 y 1.
        */
        $serie = [0, 1];

        /*
            Repite las instrucciones desde la posicion 2
            hasta llegar al numero de elementos solicitado.
            $i = 2: comenzamos desde la posicion 2.
        */
        for ($i = 2; $i < $n; $i++) {

            /*
                Suma los dos numeros anteriores de la lista.
                $i - 1 indica la posicion del numero anterior.
                $i - 2 indica la posicion del numero anterior a ese.
            */
            $siguiente = $serie[$i - 1] + $serie[$i - 2];

            /*
                Agrega el nuevo numero al final de la lista.
            */
            $serie[] = $siguiente;
        }

        /*
            Devuelve la lista completa con los numeros calculados.
        */
        return $serie;
    }


    /*
        Esta funcion recibe un numero ($n) y calcula su factorial.
        Tambien prepara el texto que muestra la operacion realizada.
    */
    public function calcularFactorial($n)
    {

        /*
            Si el numero es negativo, devuelve un mensaje
            indicando que no se puede calcular su factorial.
        */
        if ($n < 0) {
            return "No definido para números negativos";
        }

        /*
            El factorial de cero es uno.
            Si el numero recibido es cero, devuelve el resultado
            directamente sin realizar las multiplicaciones.
        */
        if ($n == 0) {
            return "0! = 1";
        }

        /*
            Crea la variable que guardara el resultado
            de las multiplicaciones.
            Comienza en 1 porque ese es el valor inicial.
        */
        $factorial = 1;

        /*
            Crea una variable vacia para construir
            el texto de la operacion paso a paso.
        */
        $operacion = "";

        for ($i = 1; $i <= $n; $i++) {

            /*
                Multiplica el resultado anterior por el numero actual.
            */
            $factorial = $factorial * $i;

            if ($i == 1) {
                $operacion = $i;
            } else {

                $operacion = $operacion . " x " . $i;
            }
        }

        return $operacion . " = " . $factorial;
    }
}
?>
