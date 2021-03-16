<?php

namespace EdiProceda\Registros;

use DateTime;

/**
 * @property-read string $identificacao_do_remetente
 * @property-read string $identificacao_do_destinatario
 * @property-read string $identificacao_do_intercambio
 * @property-read DateTime $data
 */
class Intercambio extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'identificacao_do_remetente' => [3, 35], // Identificação do remetente
        'identificacao_do_destinatario' => [38, 35], // Identificação do destinatário
//        'data' => [73, 6], // Data
//        'hora' => [79, 4], // Hora
        'identificacao_do_intercambio' => [83, 12] // Identificação do Intercâmbio
    );

    public $identificacao_do_remetente;

    public $identificacao_do_destinatario;

    public $identificacao_do_intercambio;

    public $data;

    /**
     * Intercambio constructor.
     * @param string $line
     */
    public function __construct($line)
    {

        $this->data = DateTime::createFromFormat('dmyHi', substr($line, 73, 10));

        parent::__construct($line, self::POSICOES);

    }
}