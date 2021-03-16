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
        'nfe_serie' => [17, 3], // Série da nota fiscal
        'nfe_numero' => [20, 8], // Número da nota fiscal
        'ocorrencia_codigo' => [28, 2], // Código de ocorrência na entrega
//        'data' => [30, 8], // Data da ocorrência
//        'hora' => [38, 4], // Hora da ocorrência
        'observacao_codigo' => [42, 2], // Código de de observação de ocorrência na entrada
        'texto_livre' => [44, 70] // Texto em formato livre
    );

    const OCORRENCIAS = array(
        'Processo de transporte já iniciado',
        'Entrega realizada normalmente',
        'Entrega Fora da data programadas',
        'Recusa por falta de pedido de compra',
        'Recusa por pedido de compra cancelado',
        'Falta de espaço físico no depósito do cliente destino',
        'Endereço do cliente destino não localizado',
        'Devolução não autorizada pelo cliente',
        'Preço mercadoria em desacordo com o pedido compra',
        'Mercadoria em desacordo com o pedido compra',
        'Cliente destino somente recebe mercadoria com frete pago',
        'Recusa por deficiência embalagem mercadoria',
        'Redespacho não indicado',
        'Transportadora não atende a cidade do cliente destino',
        'Mercadoria sinistrada',
        'Embalagem sinistrada',
        'Pedido de compras em duplicidade',
        'Mercadoria fora da embalagem de atacadista',
        'Mercadorias trocadas',
        'Reentrega solicitada pelo cliente',
        'Entrega prejudicada por horário/falta de tempo hábil',
        'Estabelecimento fechado',
        'Reentrega sem cobrança do cliente',
        'Extravio de mercadoria em trânsito',
        'Mercadoria reentregue ao Cliente Destino',
        'Mercadoria devolvida ao cliente de origem',
        'Nota fiscal retida pela fiscalização',
        'Roubo de carga',
        'Mercadoria retida até segunda ordem',
        'Cliente retira mercadoria na transportadora',
        'Problema com a documentação (nota fiscal e/ou CTRC)',
        'Entrega com indenização efetuada',
        'Falta com solicitação de reposição',
        'Falta com busca/reconferência',
        'Cliente fechado para balanço',
        'Quantidade de produto em desacordo (nota fiscal e/ou pedido)',
        'Extravio de documentos pela cia. aérea',
        'Extravio de carga pela cia. aérea',
        'Avaria de carga pela cia. aérea',
        'Corte de carga na pista',
        'Aeroporto fechado na origem',
        'Pedido de compra incompleto',
        'Nota fiscal com produtos de setores diferentes',
        'Feriado local/nacional',
        'Excesso de veículos',
        'Cliente destino encerrou atividades',
        'Responsável de recebimento ausente',
        'Cliente destino em greve',
        'Aeroporto fechado no destino',
        'Vôo cancelado',
        'Greve nacional (greve geral)',
        'Mercadoria vencida (data de validade expirada)',
        'Mercadoria redespachada (entregue para redespacho)',
        'Mercadoria não foi embarcada, permanecendo na origem',
        'Mercadoria embarcada sem conhecimento/conhecimento não embarcado',
        'Endereço de transportadora de redespacho não localizado/informado',
        'Cliente não aceita mercadoria com pagamento de reembolso',
        'Transportadora não atende a cidade da transportadora de redespacho',
        'Quebra do veiculo de entrega',
        'Cliente sem verba para pagar o frete',
        'Endereço de entrega errado',
        'Cliente sem verba para reembolso',
        'Recusa da carga por valor de frete errado',
        'Identificação do cliente não informada/enviada/insuficiente',
        'Cliente não identificado/cadastrado',
        'Entrar em contato com o comprador',
        'Troca não disponível',
        'Fins estatísticos',
        'Data de entrega diferente do pedido',
        'Substituição tributária',
        'Sistema fora do ar',
        'Cliente destino não recebe pedido parcial',
        'Cliente destino só recebe pedido parcial',
        'Redespacho somente com frete pago',
        'Funcionário não autorizado a receber mercadorias',
        'Mercadoria embarcada para rota indevida',
        'Estrada/entrada de acesso interditada',
        'Cliente destino mudou de endereço',
        'Avaria total',
        'Avaria parcial',
        'Extravio total',
        'Extravio parcial',
        'Sobra de mercadoria sem nota fiscal',
        'Mercadoria em poder da SUFRAMA para internação',
        'Mercadoria retirada para conferência',
        'Apreensão fiscal da mercadoria',
        'Excesso de carga/peso',
        'Férias coletivas',
        'Recusado, aguardando negociação',
        'Aguardando refaturamento das mercadorias',
        'Recusado pelo redespachante',
        'Entrega programada',
        'Problemas fiscais',
        'Aguardando carta de correção',
        'Recusa por divergência nas condições de pagamento',
        'Carga aguardando vôo conexão',
        'Carga sem embalagem própria para transp. aéreo',
        'Carga com dimensão superior ao porão da aeronave',
        'Chegada na cidade ou filial de destino',
        'Outros tipos de ocorrências não especificados acima'
    );

    const OBSERVACOES = array(
        '',
        'Devolução/recusa total',
        'Devolução/recusa parcial',
        'Aceite/entrega de acordo'
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

        $this->data = DateTime::createFromFormat('dmYHi', substr($line, 30, 12));

        parent::__construct($line, self::POSICOES);

    }

    /**
     * @return string
     */
    public function getDescricao() {
        return in_array($this->ocorrencia_codigo, array_keys(self::OCORRENCIAS))
            ? self::OCORRENCIAS[$this->ocorrencia_codigo]
            : 'Código de ocorrência inválido';
    }

    public function getObservacao() {
        return in_array($this->observacao_codigo, array_keys(self::OBSERVACOES))
            ? self::OBSERVACOES[$this->observacao_codigo]
            : 'Código de observação inválido';
    }

}