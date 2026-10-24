
<?php

class Estadistica
{

    /*
        Se calcula el promedio de los numeros recibidos
    */
    public function calcularPromedio($numeros)
    {

        /*
            Se comprueba si la lista esta vacia
            Si no hay numeros, se devuelve un mensaje
        */
        if (count($numeros) == 0) {
            return "No hay números para calcular";
        }

        /* Se inicializa la variable que guarda la suma de los numeros */
        $suma = 0;

        /* Se obtiene la cantidad de numeros de la lista */
        $cantidad = count($numeros);

        /*
            Se recorren los numeros de la lista para sumarlos
        */
        for ($i = 0; $i < $cantidad; $i++) {
            $suma = $suma + $numeros[$i];
        }

        /* 
            Se calcula el promedio dividiendo la suma entre la cantidad.
        */
        $promedio = $suma / $cantidad;

        return $promedio;
    }


    /*
        Se calcula la mediana de los numeros recibidos
    */
    public function calcularMedia($numeros)
    {

        /*
            Se comprueba si la lista esta vacia
            Si no hay numeros, se devuelve un mensaje
        */
        if (count($numeros) == 0) {
            return "No hay números para calcular";
        }

        /* Se ordenan los numeros de menor a mayor */
        sort($numeros);

        /* Se obtiene la cantidad de numeros de la lista */
        $cantidad = count($numeros);

        /* Se obtiene la posicion central de la lista */
        $mitad = floor($cantidad / 2);

        /*
            Se comprueba si la cantidad de numeros es impar
            Si el resto es diferente de cero, la cantidad es impar
        */
        if ($cantidad % 2 != 0) {

            /* Se devuelve el numero que ocupa la posicion central */
            return $numeros[$mitad];
        } else {

            /*
                Si la cantidad es par, se obtienen los dos numeros
                que se encuentran en el centro de la lista
            */
            $anterior = $numeros[$mitad - 1];
            $actual = $numeros[$mitad];

            /* Se calcula el promedio de los dos numeros centrales */
            return ($anterior + $actual) / 2;
        }
    }


    /*
        Se calcula la moda.
    */
    public function calcularModa($numeros)
    {

        /*
            Se comprueba si la lista esta vacia.
            Si no hay numeros, se devuelve un mensaje.
        */
        if (count($numeros) == 0) {
            return "No hay números para calcular";
        }

        /* Se obtiene la cantidad de numeros de la lista */
        $cantidad = count($numeros);

        /* Se crea una lista vacia para guardar las modas encontradas */
        $modas = [];

        /* Se establece en cero la mayor frecuencia encontrada */
        $maxFrecuencia = 0;


        for ($i = 0; $i < $cantidad; $i++) {

            /*
                Se crea una variable para indicar si el numero
                ya aparecio en una posicion anterior.
                Inicialmente se establece en false.
            */
            $repetidoAntes = false;

            /*
                Se revisan los numeros anteriores al actual
                para comprobar si el numero ya fue analizado.
            */
            for ($j = 0; $j < $i; $j++) {

                /* Se comprueba si el numero actual ya aparecio antes. */
                if ($numeros[$i] == $numeros[$j]) {
                    $repetidoAntes = true;
                }
            }

            /*
                Si el numero no aparecio antes, se cuenta
                cuantas veces aparece en toda la lista.
            */
            if ($repetidoAntes == false) {

                /* Se inicializa el contador de apariciones del numero. */
                $frecuencia = 0;

                /*
                    Se recorre toda la lista para contar
                    las veces que aparece el numero actual.
                */
                for ($j = 0; $j < $cantidad; $j++) {

                    /* Se comprueba si los dos numeros son iguales. */
                    if ($numeros[$i] == $numeros[$j]) {

                        /* Se aumenta el contador de apariciones en uno. */
                        $frecuencia = $frecuencia + 1;
                    }
                }

                /*
                    Se comprueba si el numero actual aparece
                    mas veces que cualquier numero revisado anteriormente.
                */
                if ($frecuencia > $maxFrecuencia) {

                    /* Se actualiza la mayor frecuencia encontrada. */
                    $maxFrecuencia = $frecuencia;

                    /*
                        Se vacia la lista de modas porque se encontro
                        un numero con una frecuencia mayor.
                    */
                    $modas = [];

                    /* Se guarda el nuevo numero que tiene mayor frecuencia. */
                    $modas[] = $numeros[$i];

                    /*
                    Si el numero aparece la misma cantidad de veces
                    que la mayor frecuencia encontrada, tambien se agrega
                    a la lista de modas.
                */
                } elseif ($frecuencia == $maxFrecuencia) {

                    $modas[] = $numeros[$i];
                }
            }
        }

        /*
            Se unen las modas encontradas en un solo texto,
            separando cada numero con una coma y un espacio.
        */
        return implode(', ', $modas);
    }
}
?>
