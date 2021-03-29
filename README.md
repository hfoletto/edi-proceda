# EDI Proceda
Ferramenta para interpretar estruturas de dados EDI no padrão **PROCEDA** na versão ``3.1``.  
Esta ferramenta é para ser usada pela embarcadora para interpretar estruturas de dados EDI geradas por transportadoras.

Atualmente interpreta os layouts [**OCOREN**](https://documentacao.senior.com.br/gestaodefretesfis/7.0.0/arquivos/ocoren.pdf) e [**CONEMB**](https://documentacao.senior.com.br/gestaodefretesfis/7.0.0/arquivos/conemb.pdf).

## Uso:

### Ocoren

``` 
$file_contents = file_get_contents('OCO10032021_160647.txt');
$ocoren = new \EdiProceda\Ocoren($file_contents);
print_r($ocoren);
```

#### Exemplo de retorno:
```
EdiProceda\Ocoren Object
(
    [intercambio] => EdiProceda\Registros\Intercambio Object
        (
            [identificacao_do_remetente] => IDENTIFICAÇÃO DA TRANSPORTADORA
            [identificacao_do_destinatario] => IDENTIFICAÇÃO DA EMBARCADORA
            [identificacao_do_intercambio] => OCO100321160
            [data] => DateTime Object
                (
                    [date] => 2021-03-10 16:06:00.000000
                    [timezone_type] => 3
                    [timezone] => UTC
                )

        )

    [documento] => EdiProceda\Registros\Documento Object
        (
            [identificacao_do_documento] => OCORR100316060
        )

    [transportadora] => EdiProceda\Registros\Transportadora Object
        (
            [cnpj] => 12345678901234
            [razao_social] => RAZÃO SOCIAL DA TRANSPORTADORA
        )

    [ocorrencias] => Array
        (
            [0] => EdiProceda\Registros\Ocorrencia Object
                (
                    [cnpj_remetente] => 12345678000123
                    [nfe_serie] => 1
                    [nfe_numero] => 12345
                    [ocorrencia_codigo] => 1
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-10 07:09:00.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [observacao_codigo] => 3
                    [texto_livre] => ENTREGA REALIZADA NORMALMENTE
                )

            [1] => EdiProceda\Registros\Ocorrencia Object
                (
                    [cnpj_remetente] => 12345678000123
                    [nfe_serie] => 1
                    [nfe_numero] => 12346
                    [ocorrencia_codigo] => 1
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-10 07:57:00.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [observacao_codigo] => 3
                    [texto_livre] => ENTREGA REALIZADA NORMALMENTE
                )

            [2] => EdiProceda\Registros\Ocorrencia Object
                (
                    [cnpj_remetente] => 12345678000123
                    [nfe_serie] => 1
                    [nfe_numero] => 12347
                    [ocorrencia_codigo] => 21
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-10 08:00:00.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [observacao_codigo] => 0
                    [texto_livre] => ESTABELECIMENTO FECHADO
                )

        )

)
```

Para os objetos de ``Ocorrencia`` também há os métodos públicos ``getDescricao`` e ``getObservacao``.

```
echo $ocoren->ocorrencias[0]->getDescricao(); // Retornará "Entrega realizada normalmente"
echo $ocoren->ocorrencias[0]->getObservacao(); // Retornará "Aceite/entrega de acordo"
```

### Conemb

``` 
$file_contents = file_get_contents('CONEMB10032021_160647.txt');
$conemb = new \EdiProceda\Conemb($file_contents);
print_r($conemb);
```

#### Exemplo de retorno:

```
EdiProceda\Conemb Object
(
    [intercambio] => EdiProceda\Registros\Intercambio Object
        (
            [identificacao_do_remetente] => IDENTIFICAÇÃO DA TRANSPORTADORA
            [identificacao_do_destinatario] => IDENTIFICAÇÃO DA EMBARCADORA
            [identificacao_do_intercambio] => CON260310400
            [data] => DateTime Object
                (
                    [date] => 2021-03-26 10:40:00.000000
                    [timezone_type] => 3
                    [timezone] => UTC
                )

        )

    [documento] => EdiProceda\Registros\Documento Object
        (
            [identificacao_do_documento] => CON312603001
        )

    [transportadora] => EdiProceda\Registros\Transportadora Object
        (
            [cnpj] => 12345678901234
            [razao_social] => RAZÃO SOCIAL DA TRANSPORTADORA
        )

    [conhecimentos_embarcados] => Array
        (
            [0] => EdiProceda\Registros\ConhecimentoEmbarcado Object
                (
                    [filial_emissora_conhecimento] => RIBEIRAO P
                    [serie_conhecimento] => 1
                    [numero_conhecimento] => 123456
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-03 14:57:56.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [condicao_de_frete] => CIF
                    [peso_transportado] => 2.5
                    [valor_total_frete] => 0.21
                    [base_calculo_apuracao_icms] => 35.33
                    [taxa_icms] => 0.12
                    [valor_icms] => 4.24
                    [valor_frete_peso_volume] => 35.33
                    [frete_valor] => 0
                    [valor_sec_cat] => 0
                    [valor_itr] => 0
                    [valor_despacho] => 0
                    [valor_pedagio] => 0
                    [valor_ademe] => 0
                    [substituicao_tributaria] => 
                    [cnpj_transportadora] => 12345678901234
                    [cnpj_remetente] => 12345678000123
                    [notas_componentes] => Array
                        (
                            [0] => EdiProceda\Registros\Models\NotaEmbarcada Object
                                (
                                    [nfe_serie] => 1
                                    [nfe_numero] => 12345
                                )

                        )

                    [acao_documento] => Incluir
                    [tipo_conhecimento] => Conhecimento de devolução
                    [codigo_fiscal_natureza_operacao] => 6353
                    [modelo_conhecimento] => 
                    [chave_acesso_cte] => 
                    [protocolo_autorizacao_cte] => 
                )

            [1] => EdiProceda\Registros\ConhecimentoEmbarcado Object
                (
                    [filial_emissora_conhecimento] => BLUMENAU
                    [serie_conhecimento] => 3
                    [numero_conhecimento] => 123457
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-02 14:57:56.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [condicao_de_frete] => CIF
                    [peso_transportado] => 25.22
                    [valor_total_frete] => 0.21
                    [base_calculo_apuracao_icms] => 36.81
                    [taxa_icms] => 0.12
                    [valor_icms] => 4.42
                    [valor_frete_peso_volume] => 29.62
                    [frete_valor] => 1.58
                    [valor_sec_cat] => 0
                    [valor_itr] => 0
                    [valor_despacho] => 0
                    [valor_pedagio] => 4.03
                    [valor_ademe] => 1.58
                    [substituicao_tributaria] => 
                    [cnpj_transportadora] => 12345678901234
                    [cnpj_remetente] => 12345678000123
                    [notas_componentes] => Array
                        (
                            [0] => EdiProceda\Registros\Models\NotaEmbarcada Object
                                (
                                    [nfe_serie] => 1
                                    [nfe_numero] => 12346
                                )

                        )

                    [acao_documento] => Incluir
                    [tipo_conhecimento] => Normal
                    [codigo_fiscal_natureza_operacao] => 6353
                    [modelo_conhecimento] => 
                    [chave_acesso_cte] => 
                    [protocolo_autorizacao_cte] => 
                )

            [2] => EdiProceda\Registros\ConhecimentoEmbarcado Object
                (
                    [filial_emissora_conhecimento] => BLUMENAU
                    [serie_conhecimento] => 3
                    [numero_conhecimento] => 123458
                    [data] => DateTime Object
                        (
                            [date] => 2021-03-02 14:57:56.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [condicao_de_frete] => CIF
                    [peso_transportado] => 8.22
                    [valor_total_frete] => 0.21
                    [base_calculo_apuracao_icms] => 35.33
                    [taxa_icms] => 0.12
                    [valor_icms] => 4.24
                    [valor_frete_peso_volume] => 35.33
                    [frete_valor] => 0
                    [valor_sec_cat] => 0
                    [valor_itr] => 0
                    [valor_despacho] => 0
                    [valor_pedagio] => 0
                    [valor_ademe] => 0
                    [substituicao_tributaria] => 
                    [cnpj_transportadora] => 12345678901234
                    [cnpj_remetente] => 12345678000123
                    [notas_componentes] => Array
                        (
                            [0] => EdiProceda\Registros\Models\NotaEmbarcada Object
                                (
                                    [nfe_serie] => 1
                                    [nfe_numero] => 12347
                                )

                        )

                    [acao_documento] => Incluir
                    [tipo_conhecimento] => Normal
                    [codigo_fiscal_natureza_operacao] => 6353
                    [modelo_conhecimento] => 
                    [chave_acesso_cte] => 
                    [protocolo_autorizacao_cte] => 
                )
        )
)
```

## Próximos passos:

O próximo passo será inserir o registro **D C C – DADOS COMPLEMENTARES DO CONHECIMENTO EMBARCADO** no layout CONEMB.