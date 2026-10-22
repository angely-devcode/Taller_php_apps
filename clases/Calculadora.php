<?php

class Calculadora {
    private $historial;

    public function __construct() {
        // Iniciar la sesión si aún no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si no existe un historial guardado en la sesión, se inicializa como un arreglo vacío
        if (!isset($_SESSION['historial'])) {
            $_SESSION['historial'] = [];
        }

        $this->historial = &$_SESSION['historial'];
    }

    // Método principal para realizar las operaciones
    public function calcular($num1, $num2, $operacion) {
        $resultado = 0;
        $simbolo = '';

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
                $simbolo = '×';
                break;

            case 'division':
                if ($num2 == 0) {
                    return "Error: No se puede dividir entre cero.";
                }
                $resultado = $num1 / $num2;
                $simbolo = '÷';
                break;

            case 'porcentaje':
                // Calcula el porcentaje de num1 respecto a num2 (ej. 20% de 50)
                $resultado = ($num1 * $num2) / 100;
                $simbolo = '% de';
                break;

            default:
                return "Operación no válida.";
        }

        // Crear una cadena legible de la operación realizada
        $registro = "$num1 $simbolo $num2 = $resultado";
        
        // Guardar la operación en el historial
        $this->guardarEnHistorial($registro);

        return $resultado;
    }

    // Agregar una operación al arreglo del historial
    private function guardarEnHistorial($registro) {
        $this->historial[] = $registro;
    }

    // Obtener todas las operaciones guardadas
    public function getHistorial() {
        return $this->historial;
    }

    // Borrar todo el historial guardado en la sesión
    public function borrarHistorial() {
        $_SESSION['historial'] = [];
        $this->historial = [];
    }
}