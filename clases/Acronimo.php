
<?php
class Acronimo
{

    public function generar($frase)
    {

        /* Se reemplazan los guiones por espacios */
        $frase = str_replace('-', ' ', $frase);

        /* Se eliminan los signos de puntuación de la frase */
        $frase = str_replace('!', '', $frase);
        $frase = str_replace('¡', '', $frase);
        $frase = str_replace(',', '', $frase);
        $frase = str_replace('.', '', $frase);
        $frase = str_replace('?', '', $frase);
        $frase = str_replace('¿', '', $frase);
        $frase = str_replace(':', '', $frase);
        $frase = str_replace(';', '', $frase);

        /* Se separa la frase en palabras */
        $palabras = explode(' ', $frase);

        /* Se inicializa el acronimo como una cadena vacía */
        $acronimo = '';

        /* Se recorre cada palabra de la frase */
        foreach ($palabras as $palabra) {

            /* Se eliminan los espacios sobrantes de cada palabra */
            $palabra = trim($palabra);

            /* Se comprueba que la palabra no esté vacía */
            if ($palabra != '') {

                /* Se obtiene la primera letra y se convierte en mayúscula */
                $letra = mb_strtoupper(mb_substr($palabra, 0, 1));

                /* Se agrega la letra al resultdao del acrónimo */
                $acronimo = $acronimo . $letra;
            }
        }

        /* Se devuelve el acrónimo generado */
        return $acronimo;
    }
}
?>
