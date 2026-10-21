<?php
class Binario {
    public function convertirBinario($numero) {
        if ($numero == 0){
            return "0";
        }
        
        if ($numero < 0){
            return "Ingrese un número positivo";
        }

        $resultado = "";
        $numeroActual = $numero;

        while($numeroActual > 0){
            $residuo = $numeroActual % 2;
            $resultado = $residuo . $resultado;
            $numeroActual = (int)($numeroActual/2);
        }
        return $resultado;
    }
}