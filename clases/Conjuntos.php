<?php
class Conjuntos{
    public function union($conjuntoA, $conjuntoB){
        $arrayUnion = array_merge($conjuntoA,$conjuntoB);
        $resultado = array_unique($arrayUnion);
        return $resultado;
    }

    public function interseccion ($conjuntoA, $conjuntoB){
        $resultado = array_intersect($conjuntoA, $conjuntoB);
        return $resultado;
    }
    public function diferencia ($conjuntoA, $conjuntoB){
        $resultado = array_diff($conjuntoA, $conjuntoB);
        return $resultado;
    }
}
?>