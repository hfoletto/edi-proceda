<?php


namespace EdiProceda\Registros;

use DateTime;

/**
 * @property-read string $cnpj_remetente
 * @property-read int $nfe_serie
 * @property-read int $nfe_numero
 * @property-read int $ocorrencia_codigo
 * @property-read DateTime $data
 * @property-read int $observacao_codigo
 * @property-read string $texto_livre
 */
class Ocorrencia extends Registro
{

    const POSICOES = array(
//        'identificador_de_registro' => [0 , 3], // Identificador de registro
        'cnpj_remetente' => [3, 14], // CNPJ da embarcadora
        'nfe_serie' => [17, 3, Registro::CAST_INT], // Série da nota fiscal
        'nfe_numero' => [20, 8, Registro::CAST_INT], // Número da nota fiscal
        'ocorrencia_codigo' => [28, 2], // Código de ocorrência na entrega
        'data' => [30, 12, Registro::CAST_DATETIME], // Data e hora da ocorrência
        'observacao_codigo' => [42, 2], // Código de de observação de ocorrência na entrada
        'texto_livre' => [44, 70] // Texto em formato livre
    );

    const OCORRENCIAS = array(
        '00' => 'Processo de transporte já iniciado',
        '01' => 'Entrega realizada normalmente',
        '02' => 'Entrega Fora da data programadas',
        '03' => 'Recusa por falta de pedido de compra',
        '04' => 'Recusa por pedido de compra cancelado',
        '05' => 'Falta de espaço físico no depósito do cliente destino',
        '06' => 'Endereço do cliente destino não localizado',
        '07' => 'Devolução não autorizada pelo cliente',
        '08' => 'Preço mercadoria em desacordo com o pedido compra',
        '09' => 'Mercadoria em desacordo com o pedido compra',
        '10' => 'Cliente destino somente recebe mercadoria com frete pago',
        '11' => 'Recusa por deficiência embalagem mercadoria',
        '12' => 'Redespacho não indicado',
        '13' => 'Transportadora não atende a cidade do cliente destino',
        '14' => 'Mercadoria sinistrada',
        '15' => 'Embalagem sinistrada',
        '16' => 'Pedido de compras em duplicidade',
        '17' => 'Mercadoria fora da embalagem de atacadista',
        '18' => 'Mercadorias trocadas',
        '19' => 'Reentrega solicitada pelo cliente',
        '20' => 'Entrega prejudicada por horário/falta de tempo hábil',
        '21' => 'Estabelecimento fechado',
        '22' => 'Reentrega sem cobrança do cliente',
        '23' => 'Extravio de mercadoria em trânsito',
        '24' => 'Mercadoria reentregue ao Cliente Destino',
        '25' => 'Mercadoria devolvida ao cliente de origem',
        '26' => 'Nota fiscal retida pela fiscalização',
        '27' => 'Roubo de carga',
        '28' => 'Mercadoria retida até segunda ordem',
        '29' => 'Cliente retira mercadoria na transportadora',
        '30' => 'Problema com a documentação (nota fiscal e/ou CTRC)',
        '31' => 'Entrega com indenização efetuada',
        '32' => 'Falta com solicitação de reposição',
        '33' => 'Falta com busca/reconferência',
        '34' => 'Cliente fechado para balanço',
        '35' => 'Quantidade de produto em desacordo (nota fiscal e/ou pedido)',
        '36' => 'Extravio de documentos pela cia. aérea',
        '37' => 'Extravio de carga pela cia. aérea',
        '38' => 'Avaria de carga pela cia. aérea',
        '39' => 'Corte de carga na pista',
        '40' => 'Aeroporto fechado na origem',
        '41' => 'Pedido de compra incompleto',
        '42' => 'Nota fiscal com produtos de setores diferentes',
        '43' => 'Feriado local/nacional',
        '44' => 'Excesso de veículos',
        '45' => 'Cliente destino encerrou atividades',
        '46' => 'Responsável de recebimento ausente',
        '47' => 'Cliente destino em greve',
        '48' => 'Aeroporto fechado no destino',
        '49' => 'Vôo cancelado',
        '50' => 'Greve nacional (greve geral)',
        '51' => 'Mercadoria vencida (data de validade expirada)',
        '52' => 'Mercadoria redespachada (entregue para redespacho)',
        '53' => 'Mercadoria não foi embarcada, permanecendo na origem',
        '54' => 'Mercadoria embarcada sem conhecimento/conhecimento não embarcado',
        '55' => 'Endereço de transportadora de redespacho não localizado/informado',
        '56' => 'Cliente não aceita mercadoria com pagamento de reembolso',
        '57' => 'Transportadora não atende a cidade da transportadora de redespacho',
        '58' => 'Quebra do veiculo de entrega',
        '59' => 'Cliente sem verba para pagar o frete',
        '60' => 'Endereço de entrega errado',
        '61' => 'Cliente sem verba para reembolso',
        '62' => 'Recusa da carga por valor de frete errado',
        '63' => 'Identificação do cliente não informada/enviada/insuficiente',
        '64' => 'Cliente não identificado/cadastrado',
        '65' => 'Entrar em contato com o comprador',
        '66' => 'Troca não disponível',
        '67' => 'Fins estatísticos',
        '68' => 'Data de entrega diferente do pedido',
        '69' => 'Substituição tributária',
        '70' => 'Sistema fora do ar',
        '71' => 'Cliente destino não recebe pedido parcial',
        '72' => 'Cliente destino só recebe pedido parcial',
        '73' => 'Redespacho somente com frete pago',
        '74' => 'Funcionário não autorizado a receber mercadorias',
        '75' => 'Mercadoria embarcada para rota indevida',
        '76' => 'Estrada/entrada de acesso interditada',
        '77' => 'Cliente destino mudou de endereço',
        '78' => 'Avaria total',
        '79' => 'Avaria parcial',
        '80' => 'Extravio total',
        '81' => 'Extravio parcial',
        '82' => 'Sobra de mercadoria sem nota fiscal',
        '83' => 'Mercadoria em poder da SUFRAMA para internação',
        '84' => 'Mercadoria retirada para conferência',
        '85' => 'Apreensão fiscal da mercadoria',
        '86' => 'Excesso de carga/peso',
        '87' => 'Férias coletivas',
        '88' => 'Recusado, aguardando negociação',
        '89' => 'Aguardando refaturamento das mercadorias',
        '90' => 'Recusado pelo redespachante',
        '91' => 'Entrega programada',
        '92' => 'Problemas fiscais',
        '93' => 'Aguardando carta de correção',
        '94' => 'Recusa por divergência nas condições de pagamento',
        '95' => 'Carga aguardando vôo conexão',
        '96' => 'Carga sem embalagem própria para transp. aéreo',
        '97' => 'Carga com dimensão superior ao porão da aeronave',
        '98' => 'Chegada na cidade ou filial de destino',
        '99' => 'Outros tipos de ocorrências não especificados acima'
    );

    const OBSERVACOES = array(
        '00' => '',
        '01' => 'Devolução/recusa total',
        '02' => 'Devolução/recusa parcial',
        '03' => 'Aceite/entrega de acordo'
    );

    public $cnpj_remetente;

    public $nfe_serie;

    public $nfe_numero;

    public $ocorrencia_codigo;

    public $data;

    public $observacao_codigo;

    public $texto_livre;

    public function __construct($line)
    {
        parent::__construct($line, self::POSICOES);
    }

    /**
     * @return string
     */
    public function getDescricao() {
        return array_key_exists($this->ocorrencia_codigo, self::OCORRENCIAS)
            ? self::OCORRENCIAS[$this->ocorrencia_codigo]
            : 'Código de ocorrência inválido';
    }

    /**
     * @return string
     */
    public function getObservacao() {
        return array_key_exists($this->observacao_codigo, self::OBSERVACOES)
            ? self::OBSERVACOES[$this->observacao_codigo]
            : 'Código de observação inválido';
    }

}