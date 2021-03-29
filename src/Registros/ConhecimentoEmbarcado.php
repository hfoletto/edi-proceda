<?php


namespace EdiProceda\Registros;

use EdiProceda\Registros\Models\NotaEmbarcada;

/**
 * @property-read NotaEmbarcada[] $notas_componentes
 */
class ConhecimentoEmbarcado extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'filial_emissora_conhecimento' => [3, 10], // Filial emissora do conhecimento
        'serie_conhecimento' => [13, 5], // Série do conhecimento
        'numero_conhecimento' => [18, 12], // Número do conhecimento
        'data' => [30, 8, Registro::CAST_DATE], // Data de emissão
        'condicao_de_frete' => [38, 1, self::CONDICOES_DE_FRETE], // Condição de frete
        'peso_transportado' => [39, 7, Registro::CAST_FLOAT_2_DECIMALS], // Peso transportado
        'valor_total_frete' => [36, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor total do frete
        'base_calculo_apuracao_icms' => [61, 15, Registro::CAST_FLOAT_2_DECIMALS], // Base de cálculo para apuração ICMS
        'taxa_icms' => [76, 4, Registro::CAST_PERCENTAGE], // % de taxa do ICMS
        'valor_icms' => [80, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor do ICMS
        'valor_frete_peso_volume' => [95, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor do frete por peso/volume
        'frete_valor' => [110, 15, Registro::CAST_FLOAT_2_DECIMALS], // Frete valor
        'valor_sec_cat' => [125, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor SEC - CAT
        'valor_itr' => [140, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor ITR
        'valor_despacho' => [155, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor do despacho
        'valor_pedagio' => [170, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor do pedágio
        'valor_ademe' => [185, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor ADEME
        'substituicao_tributaria' => [200, 1, self::SUBSTITUICAO_TRIBUTARIA], // Substituição tributária
//        'filler' => [201, 3], // Filler (Antigo campo de CFOP de 3 posições)
        'cnpj_transportadora' => [204, 14], // CNPJ do emissor do conhecimento
        'cnpj_remetente' => [218, 14], // CNPJ da embarcadora
        // serie e número da nota (x40)
        'acao_documento' => [672, 1, self::ACOES_DO_DOCUMENTO], // Ação do documento
        'tipo_conhecimento' => [673, 1, self::TIPOS_DO_DOCUMENTO], // Tipo do conhecimento
        'codigo_fiscal_natureza_operacao' => [674, 4], // Código fiscal da natureza de operação
        'modelo_conhecimento' => [678, 2, self::MODELOS_DE_CONHECIMENTO], // Modelo de conhecimento
        'chave_acesso_cte' => [680, 44], // Chave de acesso do CT-e
        'protocolo_autorizacao_cte' => [724, 15], // Protocolo de autorização CT-e
    );

    const CONDICOES_DE_FRETE = array(
        'C' => 'CIF',
        'F' => 'FOB'
    );

    const SUBSTITUICAO_TRIBUTARIA = array(
        '1' => true,
        '2' => false
    );

    const ACOES_DO_DOCUMENTO = array(
        'I' => 'Incluir',
        'C' => 'Complementar',
        'E' => 'Excluir'
    );

    const TIPOS_DO_DOCUMENTO = array(
        'N' => 'Normal',
        'C' => 'Complementar',
        'D' => 'Conhecimento de devolução',
        'E' => 'Normal de entrada',
        'O' => 'Normal de retorno',
        'R' => 'Conhecimento de reentrega',
        'S' => 'Normal de saída',
        'T' => 'Normal de transferência interna',
        'W' => 'Complementar de retorno',
        'X' => 'Complementar de entrada',
        'Y' => 'Complementar de saída',
        'Z' => 'Complementar de transferência interna',
    );

    const MODELOS_DE_CONHECIMENTO = array(
        '08' => 'Modelo para conhecimento normal',
        '57' => 'Modelo para CT-e'
    );

    public $filial_emissora_conhecimento;
    public $serie_conhecimento;
    public $numero_conhecimento;
    public $data;
    public $condicao_de_frete;
    public $peso_transportado;
    public $valor_total_frete;
    public $base_calculo_apuracao_icms;
    public $taxa_icms;
    public $valor_icms;
    public $valor_frete_peso_volume;
    public $frete_valor;
    public $valor_sec_cat;
    public $valor_itr;
    public $valor_despacho;
    public $valor_pedagio;
    public $valor_ademe;
    public $substituicao_tributaria;
    public $cnpj_transportadora;
    public $cnpj_remetente;
    public $notas_componentes;
    public $acao_documento;
    public $tipo_conhecimento;
    public $codigo_fiscal_natureza_operacao;
    public $modelo_conhecimento;
    public $chave_acesso_cte;
    public $protocolo_autorizacao_cte;

    public function __construct($line)
    {
        $this->notas_componentes = array();
        for ($i = 0; $i < 40; $i++) {
            $nfe_serie = (int)trim(substr($line, 232 + 11 * $i, 3));
            $nfe_numero = (int)trim(substr($line, 235 + 11 * $i, 8));
            if ($nfe_serie || $nfe_numero) {
                $this->notas_componentes[] = new NotaEmbarcada($nfe_serie, $nfe_numero);
            }
        }
        parent::__construct($line, self::POSICOES);
    }

}