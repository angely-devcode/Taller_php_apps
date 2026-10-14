<?php
class Acronimo{
    public function generar($frase){
        $frase = str_replace('-', ' ', $frase); /*Reemplazar guiones por espacios*/
        
        /**Eliminar algunos signos de puntuación*/
        $frase = str_replace('!', '', $frase);
        $frase = str_replace('¡', '', $frase);
        $frase = str_replace(',', '', $frase);
        $frase = str_replace('.', '', $frase);
        $frase = str_replace('?', '', $frase);
        $frase = str_replace('¿', '', $frase);
        $frase = str_replace(':', '', $frase);
        $frase = str_replace(';', '', $frase);
        
        $palabras = explode(' ', $frase);/*Separa la frase en palabras */
        $acronimo = ''; /**Crea el acrónimo vacío */

        foreach ($palabras as $palabra){
            $palabra = trim($palabra);
            
            /**Obtener la primera letra */
            if($palabra != ''){
                $letra = mb_strtoupper(mb_substr($palabra, 0, 1));/**Toma la primera letra de la palabra, la convierte en mayúscula y la guarda en $letra*/
                $acronimo = $acronimo . $letra;
            }
        }
        return $acronimo;
    }
}
?>