<?php


namespace EdiProceda;

use EdiProceda\Registros\DadosComplementares;
use EdiProceda\Registros\Intercambio;
use EdiProceda\Registros\Documento;
use EdiProceda\Registros\TotalConhecimentosEmbarcados;
use EdiProceda\Registros\Transportadora;
use EdiProceda\Registros\ConhecimentoEmbarcado;

/**
 * @property-read Intercambio $intercambio
 * @property-read Documento $documento
 * @property-read Transportadora $transportadora
 * @property-read ConhecimentoEmbarcado[] $conhecimentos_embarcados
 * @property-read DadosComplementares $dados_complementares
 * @property-read TotalConhecimentosEmbarcados $total_conhecimentos_embarcados
 */
class Conemb
{

    public $intercambio;

    public $documento;

    public $transportadora;

    public $conhecimentos_embarcados;

    public $dados_complementares;

    public $total_conhecimentos_embarcados;

    /**
     * Conemb constructor.
     * @param string $file_contents
     */
    public function __construct($file_contents) {
        $this->conhecimentos_embarcados = array();
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
            case '320':
                $registro = new Documento($line);
                $this->documento = $registro;
                break;
            case '321':
                $registro = new Transportadora($line);
                $this->transportadora = $registro;
                break;
            case '322':
                $registro = new ConhecimentoEmbarcado($line);
                $this->conhecimentos_embarcados[] = $registro;
                break;
            case '329':
                $registro = new DadosComplementares($line);
                $this->dados_complementares = $registro;
                break;
            case '323':
                $registro = new TotalConhecimentosEmbarcados($line);
                $this->total_conhecimentos_embarcados = $registro;
                break;
        }
    }

}