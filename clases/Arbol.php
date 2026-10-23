<?php

/**Clase para representar cada nodo del árbol */
class Nodo
{
    public $valor;
    public $izquierdo;
    public $derecho;

    public function __construct($valor)
    {
        $this->valor = $valor;
        $this->izquierdo = null;
        $this->derecho = null;
    }
}

/**Clase principal que maneja la lógica del Árbol Binario */
class Arbol
{
    public $raiz;

    public function __construct()
    {
        $this->raiz = null;
    }

    /**Construir usando PREORDEN e INORDEN */
    public function construirPreIn($preorden, $inorden)
    {
        if (empty($preorden) || empty($inorden)) {
            return null;
        }

        /**El primer elemento de preorden siempre es la raíz actual */
        $valorRaiz = array_shift($preorden);
        $nodo = new Nodo($valorRaiz);

        /**Buscar la posición de la raíz dentro del recorrido inorden */
        $indiceInorden = array_search($valorRaiz, $inorden);

        /**Dividir el arreglo inorden en subárbol izquierdo y subárbol derecho */
        $inordenIzq = array_slice($inorden, 0, $indiceInorden);
        $inordenDer = array_slice($inorden, $indiceInorden + 1);

        /**Dividir el arreglo preorden en base a las cantidades del subárbol izquierdo */
        $preordenIzq = array_slice($preorden, 0, count($inordenIzq));
        $preordenDer = array_slice($preorden, count($inordenIzq));

        /**Llamadas recursivas para construir los subárboles */
        $nodo->izquierdo = $this->construirPreIn($preordenIzq, $inordenIzq);
        $nodo->derecho = $this->construirPreIn($preordenDer, $inordenDer);

        return $nodo;
    }

    /**Construir usando INORDEN y POSTORDEN */
    public function construirInPost($inorden, $postorden)
    {
        if (empty($inorden) || empty($postorden)) {
            return null;
        }

        /**El último elemento de postorden siempre es la raíz actual */
        $valorRaiz = array_pop($postorden);
        $nodo = new Nodo($valorRaiz);

        /**Buscar la posición de la raíz dentro de inorden */
        $indiceInorden = array_search($valorRaiz, $inorden);

        /**Dividir inorden */
        $inordenIzq = array_slice($inorden, 0, $indiceInorden);
        $inordenDer = array_slice($inorden, $indiceInorden + 1);

        /**Dividir postorden segun las cantidades */
        $postordenIzq = array_slice($postorden, 0, count($inordenIzq));
        $postordenDer = array_slice($postorden, count($inordenIzq));

        /**Llamadas recursivas */
        $nodo->izquierdo = $this->construirInPost($inordenIzq, $postordenIzq);
        $nodo->derecho = $this->construirInPost($inordenDer, $postordenDer);

        return $nodo;
    }

    /**Construir usando PREORDEN y POSTORDEN */
    public function construirPrePost($preorden, $postorden)
    {
        if (empty($preorden) || empty($postorden)) {
            return null;
        }

        $valorRaiz = array_shift($preorden);
        array_pop($postorden);
        /**Eliminar la raíz actual de postorden */
        $nodo = new Nodo($valorRaiz);

        if (empty($preorden)) {
            return $nodo;
        }

        /**El siguiente elemento en preorden es la raíz del subárbol izquierdo */
        $raizSubIzq = $preorden[0];
        $indicePost = array_search($raizSubIzq, $postorden);

        /**Dividir arreglos */
        $preordenIzq = array_slice($preorden, 0, $indicePost + 1);
        $preordenDer = array_slice($preorden, $indicePost + 1);

        $postordenIzq = array_slice($postorden, 0, $indicePost + 1);
        $postordenDer = array_slice($postorden, $indicePost + 1);

        /**Llamadas recursivas */
        $nodo->izquierdo = $this->construirPrePost($preordenIzq, $postordenIzq);
        $nodo->derecho = $this->construirPrePost($preordenDer, $postordenDer);

        return $nodo;
    }

    /**Función para imprimir el arbol*/
    public function imprimirArbolHTML($nodo = null, $nivel = 0)
    {
        if ($nodo === null && $nivel === 0) {
            $nodo = $this->raiz;
        }

        if ($nodo === null) {
            return "";
        }

        $html = '<div class="nodo-arbol">';

        $html .= '<div class="valor-nodo">';
        $html .= htmlspecialchars($nodo->valor);
        $html .= '</div>';

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

        $html .= '</div>';

        return $html;
    }
}
