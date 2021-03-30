<?php


namespace EdiProceda\Registros;


/**
 * @property-read int $quantidade
 * @property-read float $valor
 */
class TotalConhecimentosEmbarcados extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'quantidade' => [3, 4, Registro::CAST_INT], // Quantidade total de conhecimentos
        'valor' => [7, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor total dos conhecimentos
//        'filler' => [22, 658]
    );

    public function __construct($line)
    {
        parent::__construct($line, self::POSICOES);
    }

}