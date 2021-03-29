<?php


namespace EdiProceda\Registros;


use DateTime;

abstract class Registro
{

    const CAST_INT = 'int';
    const CAST_FLOAT_2_DECIMALS = 'float';
    const CAST_PERCENTAGE = 'percentage';
    const CAST_DATE = 'date';
    const CAST_DATETIME = 'datetime';

    /**
     * Registro constructor.
     * @param string $line
     * @param array $posicoes
     */
    public function __construct($line, $posicoes) {
        foreach ($posicoes as $field => $position) {
            $value = trim(substr($line, $position[0], $position[1]));
            if (isset($position[2])) {
                switch ($position[2]) {
                    case self::CAST_INT:
                        $value = (int)$value;
                        break;
                    case self::CAST_FLOAT_2_DECIMALS:
                        $value = ((float)$value/100);
                        break;
                    case self::CAST_PERCENTAGE:
                        $value = (float)((int)$value/10000);
                        break;
                    case self::CAST_DATE:
                        $value = DateTime::createFromFormat('dmY', $value);;
                        break;
                    case self::CAST_DATETIME:
                        $value = DateTime::createFromFormat('dmYHi', $value);;
                        break;
                    default:
                        if (is_array($position[2]) && array_key_exists($value, $position[2])) {
                            $value = $position[2][$value];
                        }
                }
            }
            $this->{$field} = $value;
        }
    }

}