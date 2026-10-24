
<?php

class Nodo
{
    public $valor;
    public $izquierdo;
    public $derecho;

    /* Se inicializa el nodo con su valor y sus dos hijos vacíos */
    public function __construct($valor)
    {
        $this->valor = $valor;
        $this->izquierdo = null;
        $this->derecho = null;
    }
}

class Arbol
{
    public $raiz;

    /* Se crea el árbol sin una raíz inicial */
    public function __construct()
    {
        $this->raiz = null;
    }
    /*
    Preorden:  Raiz - Izquierda - Derecha 
    Inorden:  Izquierda - Raiz - Derecha 
    Postorden: Izquierda - Derecha - Raiz
     */

    public function construirPreIn($preorden, $inorden)
    {
        /* Se comprueba si alguno de los recorridos está vacío */
        if (empty($preorden) || empty($inorden)) {
            return null;
        }

        /* Se obtiene el primer dato de preorden, que representa la raíz */
        $valorRaiz = array_shift($preorden);
        $nodo = new Nodo($valorRaiz);

        /* Se busca la posicion de la raíz dentro del recorrido inorden */
        $indiceInorden = array_search($valorRaiz, $inorden);

        /* Se separa inorden en los elementos de la izquierda y la derecha */
        $inordenIzq = array_slice($inorden, 0, $indiceInorden);
        $inordenDer = array_slice($inorden, $indiceInorden + 1);

        /* Se divide preorden según la cantidadd de elementos del lado izquierdo */
        $preordenIzq = array_slice($preorden, 0, count($inordenIzq));
        $preordenDer = array_slice($preorden, count($inordenIzq));

        /* Se construyen los subárboles mediante llamadas recursivas */
        $nodo->izquierdo = $this->construirPreIn($preordenIzq, $inordenIzq);
        $nodo->derecho = $this->construirPreIn($preordenDer, $inordenDer);

        return $nodo;
    }

    public function construirInPost($inorden, $postorden)
    {
        /* Se comprueba si alguno de los recorridos está vacío */
        if (empty($inorden) || empty($postorden)) {
            return null;
        }

        /* Se obtiene el último elemento de postorden, que representa la raíz */
        $valorRaiz = array_pop($postorden);
        $nodo = new Nodo($valorRaiz);

        /* Se busca la posición de la raíz dentro de inorden */
        $indiceInorden = array_search($valorRaiz, $inorden);

        /* Se separa inorden en los elementos de ambos lados */
        $inordenIzq = array_slice($inorden, 0, $indiceInorden);
        $inordenDer = array_slice($inorden, $indiceInorden + 1);

        /* Se divide postorden según la cantidad de elementos de cada lado */
        $postordenIzq = array_slice($postorden, 0, count($inordenIzq));
        $postordenDer = array_slice($postorden, count($inordenIzq));

        /* Se construyen los subárboles mediante llamadas recursivas */
        $nodo->izquierdo = $this->construirInPost($inordenIzq, $postordenIzq);
        $nodo->derecho = $this->construirInPost($inordenDer, $postordenDer);

        return $nodo;
    }

    public function construirPrePost($preorden, $postorden)
    {
        /* Se comprueba si alguno de los recorridos está vacío */
        if (empty($preorden) || empty($postorden)) {
            return null;
        }

        /* Se obtiene la raíz actual y se elimina del recorrido postorden */
        $valorRaiz = array_shift($preorden);
        array_pop($postorden);

        $nodo = new Nodo($valorRaiz);

        /* Se comprueba si ya no quedan elementos para crear más nodos */
        if (empty($preorden)) {
            return $nodo;
        }

        /* Se obtiene el siguiente elemento de preorden como raíz del subárbol izquierdo */
        $raizSubIzq = $preorden[0];
        $indicePost = array_search($raizSubIzq, $postorden);

        /* Se dividen los recorridos para separar los dos subárboles */
        $preordenIzq = array_slice($preorden, 0, $indicePost + 1);
        $preordenDer = array_slice($preorden, $indicePost + 1);

        $postordenIzq = array_slice($postorden, 0, $indicePost + 1);
        $postordenDer = array_slice($postorden, $indicePost + 1);

        /* Se construyen los subárboles mediante llamadas recursivas */
        $nodo->izquierdo = $this->construirPrePost($preordenIzq, $postordenIzq);
        $nodo->derecho = $this->construirPrePost($preordenDer, $postordenDer);

        return $nodo;
    }

    public function imprimirArbolHTML($nodo = null, $nivel = 0)
    {
        /* Se utiliza la raíz del árbol cuando no se recibe un nodo inicial */
        if ($nodo === null && $nivel === 0) {
            $nodo = $this->raiz;
        }

        /* Se devuelve una cadena vacía si no existe un nodo para mostrar */
        if ($nodo === null) {
            return "";
        }

        $html = '<div class="nodo-arbol">';

        $html .= '<div class="valor-nodo">';
        $html .= htmlspecialchars($nodo->valor);
        $html .= '</div>';

        /* Se comprueba si el nodo tiene al menos un hijo */
        if ($nodo->izquierdo !== null || $nodo->derecho !== null) {
            $html .= '<div class="ramas-arbol">';

            $html .= '<div class="rama">';
            if ($nodo->izquierdo !== null) {
                $html .= $this->imprimirArbolHTML($nodo->izquierdo, $nivel + 1);
            }
            $html .= '</div>';

            $html .= '<div class="rama">';
            if ($nodo->derecho !== null) {
                $html .= $this->imprimirArbolHTML($nodo->derecho, $nivel + 1);
            }
            $html .= '</div>';

            $html .= '</div>';
        }

        /* Se cierra la estructura HTML del nodo */
        $html .= '</div>';

        return $html;
    }
}
