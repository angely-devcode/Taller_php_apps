<?php
class Estadistica {
    public function calcularPromedio($numeros) {
        if (count($numeros) == 0) {
        return "No hay números para calcular";
        }
        $suma = 0;
        $cantidad = count($numeros);

        for ($i = 0; $i < $cantidad; $i++) {
        $suma = $suma + $numeros[$i];
        }
        $promedio = $suma / $cantidad;

        return $promedio;
        }

    public function calcularMedia($numeros) {
        if (count($numeros) == 0) {
        return "No hay números para calcular";
        }

        sort($numeros); /**Organiza los número de menor a mayor */
        $cantidad = count($numeros);
        $mitad = floor($cantidad / 2); /**Divide y redondea hacia abajo */

        if ($cantidad % 2 != 0) {
            return $numeros[$mitad];
        } else {
            $anterior = $numeros[$mitad - 1];
            $actual = $numeros[$mitad];
            return ($anterior + $actual) / 2;
        }
    }

    public function calcularModa($numeros) {
        if (count($numeros) == 0) {
        return "No hay números para calcular";
        }
        
        $cantidad = count($numeros);
        $modas = [];
        $maxFrecuencia = 0;
        
        for ($i = 0; $i < $cantidad; $i++) {

        $repetidoAntes = false;

        for ($j = 0; $j < $i; $j++) {
            if ($numeros[$i] == $numeros[$j]) {
                $repetidoAntes = true;
            }
        }

        if ($repetidoAntes == false) {

            $frecuencia = 0;

            for ($j = 0; $j < $cantidad; $j++) {
                if ($numeros[$i] == $numeros[$j]) {
                    $frecuencia = $frecuencia + 1;
                }
            }

            if ($frecuencia > $maxFrecuencia) {
                $maxFrecuencia = $frecuencia;
                $modas = [];
                $modas[] = $numeros[$i];

            } elseif ($frecuencia == $maxFrecuencia) {
                $modas[] = $numeros[$i];
            }
        }
    }
        return implode(', ', $modas);
    }
}
?>