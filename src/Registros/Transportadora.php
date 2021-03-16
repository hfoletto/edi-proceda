<?php


namespace EdiProceda\Registros;


/**
 * @property-read string $cnpj
 * @property-read string $razao_social
 */
class Transportadora extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'cnpj' => [3, 14], // CNPJ da transportadora
        'razao_social' => [17, 40], // Razão social da transportadora
    );

    public $cnpj;

    public $razao_social;

    public function __construct($line)
    {
        parent::__construct($line, self::POSICOES);
    }

}