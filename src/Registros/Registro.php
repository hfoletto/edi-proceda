<?php


namespace EdiProceda\Registros;


abstract class Registro
{

    /**
     * Registro constructor.
     * @param string $line
     * @param array $posicoes
     */
    public function __construct($line, $posicoes) {
        foreach ($posicoes as $field => $position) {
            $value = trim(substr($line, $position[0], $position[1]));
            if (is_numeric($value) && strlen($value) <= 8) {
                $value = (int)$value;
            }
            $this->{$field} = $value;
        }
    }

}