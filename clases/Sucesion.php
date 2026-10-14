<?php
class Sucesion{
    public function calcularFibonacci($n){
        if ($n<=0){
            return[0];
        }

    $serie = [0, 1];

    for ($i = 2; $i < $n; $i++){
        $siguiente = $serie[$i-1] + $serie[$i-2];
        $serie[] = $siguiente;
        }

    return $serie;

    }

    public function calcularFactorial($n){
        if ($n<0){
            return "No definido para números negativos";
        }

        if ($n==0){
            return "0! = 1";
        }

        $factorial = 1;
        $operacion = "";

        for ($i = 1; $i <= $n; $i++){
        $factorial = $factorial * $i;

            if ($i == 1){
                $operacion = $i;
            } else {
            $operacion = $operacion . " x " . $i;
            }
        }
        return $operacion . " = " . $factorial;
    }

}
?>