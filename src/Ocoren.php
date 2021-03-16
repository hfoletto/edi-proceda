<?php


namespace EdiProceda;

use EdiProceda\Registros\Intercambio;
use EdiProceda\Registros\Documento;
use EdiProceda\Registros\Transportadora;
use EdiProceda\Registros\Ocorrencia;

/**
 * @property-read Intercambio $intercambio
 * @property-read Documento $documento
 * @property-read Transportadora $transportadora
 * @property-read Ocorrencia[] $ocorrencias
 */
class Ocoren
{

    public $intercambio;

    public $documento;

    public $transportadora;

    public $ocorrencias;

    /**
     * Ocoren constructor.
     * @param string $file_contents
     */
    public function __construct($file_contents) {
        $this->ocorrencias = array();
        $lines = explode(PHP_EOL, $file_contents);
        foreach ($lines as $line) {
            $this->analyseLine($line);
        }
    }

    /**
     * @param string $line
     */
    private function analyseLine($line) {
        $identificador_de_registro = substr($line, 0, 3);
        switch ($identificador_de_registro) {
            case '000':
                $registro = new Intercambio($line);
                $this->intercambio = $registro;
                break;
            case '340':
                $registro = new Documento($line);
                $this->documento = $registro;
                break;
            case '341':
                $registro = new Transportadora($line);
                $this->transportadora = $registro;
                break;
            case '342':
                $registro = new Ocorrencia($line);
                $this->ocorrencias[] = $registro;
                break;
        }

    }
}