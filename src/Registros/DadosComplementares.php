<?php


namespace EdiProceda\Registros;


class DadosComplementares extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0, 3], // Identificador de registro
        'tipo_transporte' => [3, 5, self::TIPOS_DO_MEIO_DE_TRANSPORTE], // Tipo do meio de transporte
        'valor_total_despesas_extras' => [8, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor total de despesas extras/adicionais, tipo: diárias, taxas, complementos, etc
        'valor_total_iss' => [23, 15, Registro::CAST_FLOAT_2_DECIMALS], // Valor total do ISS do documento
        'filial_emissora' => [38, 10], // Filial emissora do conhecimento originador deste conhecimento - Transportadora contratante
        'serie_conhecimento' => [48, 5], // Série do conhecimento originador deste conhecimento - Transportadora contratante
        'numero_conhecimento' => [53, 12], // Número do conhecimento originador deste conhecimento - Transportadora contratante
        'codigo_solicitacao_coleta' => [65, 15], // Código da solicitação de coleta
        'ident_doc_tranporte_embarcadora' => [80, 20], // Ident. do doc. de transporte da embarcadora (Romaneio/viagem/resumo, etc)
        'ident_doc_autorizacao_carregamento' => [100, 20] // Identificacao do documento de autorização de carregamento e transporte da transportadora
    );

    const TIPOS_DO_MEIO_DE_TRANSPORTE = array(
        '12   ' => 'Navio tanque',
        '21   ' => 'Vagão ferroviário tanque',
        '23   ' => 'Vagão ferroviário graneleiro',
        '25   ' => 'Expresso ferroviário',
        '31   ' => 'Caminhão (carga seca)',
        '32   ' => 'Caminhão tanque (carga líquida)',
        '33   ' => 'Remessa expressa rodoviária',
        '41   ' => 'Frete aéreo',
        '43   ' => 'Expresso aéreo',
        '51   ' => 'Encomenda postal',
        '52   ' => 'Correio expresso',
        '55   ' => 'Correio aéreo',
        '101  ' => 'Mensageiro expresso',
        'BR01 ' => 'Peruas (Kombi, Besta, etc)',
        'BR02 ' => 'Caminhonete 0,5 ton (Saveiro, etc)',
        'BR03 ' => 'Toco aberto',
        'BR04 ' => 'Toco fechado',
        'BR05 ' => 'Truck aberto',
        'BR06 ' => 'Truck fechado',
        'BR07 ' => 'Carreta aberta',
        'BR08 ' => 'Carreta fechada',
        'BR10 ' => 'Truck refrigerado',
        'BR11 ' => 'Carreta refrigerada',
        'BR12 ' => 'Truck slider',
        'BR13 ' => 'Carreta slider',
        'BR60 ' => 'Carreta 60 metros cúbicos',
        'BR80 ' => 'Carreta 80 metros cúbicos',
        'C20  ' => 'Container 20 pés',
        'C40  ' => 'Container 40 pés',
        'C4H  ' => 'Container 40 pés HC',
        'C2R  ' => 'Container 20 pés refrigerado',
        'C4R  ' => 'Container 40 pés refrigerado',
    );

    public function __construct($line)
    {
        parent::__construct($line, self::POSICOES);
    }

}