# EDI Proceda
Ferramenta para interpretar estruturas de dados EDI no padrão **PROCEDA** na versão ``3.1``.  
Esta ferramenta é para ser usada pela embarcadora para interpretar estruturas de dados EDI geradas por transportadoras.

## Uso:

``` 
$file_contents = file_get_contents('OCO10032021_160647.txt');
$ocoren = new \EdiProceda\Ocoren($file_contents);
print_r($ocoren);
```

#### * Exemplo de retorno:
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

## Próximos passos:

Atualmente o pacote interpreta apenas o layout [**OCOREN**](https://documentacao.senior.com.br/gestaodefretesfis/7.0.0/arquivos/ocoren.pdf).  
O próximo passo será adicionar funcionalidade para layout [**CONEMB**](https://documentacao.senior.com.br/gestaodefretesfis/7.0.0/arquivos/conemb.pdf).