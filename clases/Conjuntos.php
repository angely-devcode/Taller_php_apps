
<?php

class Conjuntos
{

    public function union($conjuntoA, $conjuntoB)
    {

        /* Se juntan los elementos de los dos conjuntos */
        $arrayUnion = array_merge($conjuntoA, $conjuntoB);

        /*
            Se eliminan los elementos repetidos para conservar
            solamente una aparicion de cada elemento
        */
        $resultado = array_unique($arrayUnion);

        /* Se devuelve el resultado de la union */
        return $resultado;
    }

    public function interseccion($conjuntoA, $conjuntoB)
    {

        /* Se buscan los elementos que aparecen en los dos conjuntos */
        $resultado = array_intersect($conjuntoA, $conjuntoB);

        return $resultado;
    }

    public function diferencia($conjuntoA, $conjuntoB)
    {

        /* Se buscan los elementos del primer conjunto que no estan en el segundo */
        $resultado = array_diff($conjuntoA, $conjuntoB);

        return $resultado;
    }
}
?>
