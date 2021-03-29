<?php


namespace EdiProceda\Registros\Models;


/**
 * @property-read int $nfe_serie
 * @property-read int $nfe_numero
 */
class NotaEmbarcada
{

    public $nfe_serie;

    public $nfe_numero;

    public function __construct($nfe_serie, $nfe_numero)
    {
        $this->nfe_serie = $nfe_serie;
        $this->nfe_numero = $nfe_numero;
    }

}