
<?php
class Binario
{
    public function convertirBinario($numero)
    {

        /* Se comprueba si el numro ingresado es cero */
        if ($numero == 0) {
            return "0";
        }

        /* Se verifica si el número es negativo */
        if ($numero < 0) {
            return "Ingrese un número positivo";
        }

        /* Se inicializa el resultado como una cadena vacía */
        $resultado = "";
        $numeroActual = $numero;

        while ($numeroActual > 0) {

            /* Se obtiene el residuo de la división entre dos */
            $residuo = $numeroActual % 2;

            /* Se agrega el residuo al inicio del resultdao */
            $resultado = $residuo . $resultado;

            /* Se divide el número entre dos y se guarda la parte entera */
            $numeroActual = (int)($numeroActual / 2);
        }

        /* Se devuelve el número convertido a binario */
        return $resultado;
    }
}
