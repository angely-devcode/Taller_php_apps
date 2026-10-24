
<?php

class Calculadora
{
    private $historial;

    public function __construct()
    {
        /* Se inicia la sesión si todavía no está activa */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /* Se revisa si ya existe un historial guardado en la sesión */
        if (!isset($_SESSION['historial'])) {
            $_SESSION['historial'] = [];
        }

        /* Se conecta el historial de la clase con el guardado en la sesión */
        $this->historial = &$_SESSION['historial'];
    }

    /* Método principal para realizar las operaciones matemáticas */
    public function calcular($num1, $num2, $operacion)
    {
        $resultado = 0;
        $simbolo = '';

        /* Se selecciona la operacion que el usuario desea realizar */
        switch ($operacion) {
            case 'suma':
                $resultado = $num1 + $num2;
                $simbolo = '+';
                break;

            case 'resta':
                $resultado = $num1 - $num2;
                $simbolo = '-';
                break;

            case 'multiplicacion':
                $resultado = $num1 * $num2;
                $simbolo = 'x';
                break;

            case 'division':
                /* Se evita realizar una división entre cero */
                if ($num2 == 0) {
                    return "No se puede dividir entre cero.";
                }
                $resultado = $num1 / $num2;
                $simbolo = '÷';
                break;

            case 'porcentaje':
                /* Se calcula el porcentaje de un numro respecto al otro */
                $resultado = ($num1 * $num2) / 100;
                $simbolo = '% de';
                break;

            default:
                return "Operación no válida.";
        }

        /* Se crea un texto con los datoos de la operación realizada */
        $registro = "$num1 $simbolo $num2 = $resultado";

        /* Se guarda el resultdao en el historial */
        $this->guardarEnHistorial($registro);

        return $resultado;
    }

    /* Se agrega la operación realizada al historial */
    private function guardarEnHistorial($registro)
    {
        $this->historial[] = $registro;
    }

    /* Se obtiene la lista de operaciones guardadas */
    public function getHistorial()
    {
        return $this->historial;
    }

    /* Se elimina todo el historial guardado en la sesión */
    public function borrarHistorial()
    {
        $_SESSION['historial'] = [];
        $this->historial = [];
    }
}
