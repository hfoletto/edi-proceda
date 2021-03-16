<?php


namespace EdiProceda\Registros;

/**
 * @property-read string $identificacao_do_documento
 */
class Documento extends Registro
{
    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'identificacao_do_documento' => [3, 14], // Identificação do documento
    );

    public $identificacao_do_documento;

    /**
     * Documento constructor.
     * @param string $line
     */
    public function __construct($line)
    {
        parent::__construct($line, self::POSICOES);
    }
}