=== WooCommerce Correios - Cálculo de Frete na Página do Produto ===
Contributors: lucasbustamante
Donate link: https://www.lucasbustamante.com.br
Tags: woocommerce, woocomerce correios, woocommerce correios produto
Stable tag: 3.1.94
Requires at least: 4.4
Tested up to: 5.3.2
Requires PHP: 5.4
WC requires at least: 3.2
WC tested up to: 3.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Habilita o cálculo de frete na página do produto.

== Description ==

= WooCommerce Correios - Cálculo de Frete na Página do Produto =

Ofereça cálculo de frete na página do produto no WooCommerce.

![exemplo de implementação do cálculo de frete na página do produto no WooCommerce](https://www.lucasbustamante.com.br/uploads/u/2018/03/dia-15_16h46m15s_chrome.jpg)

= Plugin Gratuito =
Este plugin é gratuito e open-source.

= Métodos de entrega suportados: =
- WooCommerce Correios SEDEX Hoje
- WooCommerce Correios SEDEX 12
- WooCommerce Correios SEDEX 10 Pacote
- WooCommerce Correios SEDEX 10 Envelope
- WooCommerce Correios SEDEX
- WooCommerce Correios PAC
- WooCommerce Correios Mercadoria Expressa
- WooCommerce Correios Mercadoria Economica
- WooCommerce Correios Leve Internacional
- WooCommerce Correios Carta Registrada
- WooCommerce Taxa Fixa
- WooCommerce Frete Grátis
- WooCommerce Retirada no Local

= Considerações: =
1. O CEP de origem será calculado a partir do CEP informado em WooCommerce -> Configurações -> CEP.
3. Se o produto não tiver as dimensões ou peso especificados, o box de cálculo de frete não aparece para aquele produto.

= Link do GitHub: =
https://github.com/Luc45/WooCommerce-Correios-Calculo-de-Frete-na-Pagina-do-Produto

== Installation ==

Para usar este plugin, basta ativá-lo.

== Frequently Asked Questions ==

= Devo fazer alguma coisa depois de ativar o plugin? =

Não, já vai aparecer o cálculo de frete nos seus produtos.

= Não estou vendo a tabela no meu produto =

A tabela de cálculo de frete só irá aparecer se o produto tiver peso e dimensões informadas. Se mesmo assim não resolver, para fins de debug a tabela está registrada no hook 'woocommerce_before_add_to_cart_button'.

== Screenshots ==

1. Exemplo de implementação do cálculo de frete na página do produto no WooCommerce

== Changelog ==

= 1.0 =
* Primeiro lançamento.
= 1.3.2 =
* Small fixes
= 1.3.3 =
* Changing version number
= 1.3.5 =
* Changing version number
= 1.3.6 =
* Updated WordPress compatible version number
= 1.3.7 =
* Fix Warning: call_user_func_array() expects parameter 1 to be a valid callback
= 1.3.8 =
* Fix pequena variação de preços no frete
= 1.3.9 =
* Fix mensagem de erro caso WooCommerce não esteja instalado ou CEP não esteja preenchido
= 1.4.0 =
* Plugin adaptado para rodar também em PHP 5
= 1.4.1 =
* Adicionado compatibilidade com versões do WooCommerce inferiores à 3.2.0
= 1.5.0 =
* Plugin re-escrito do zero para ficar mais simples
= 1.5.1 =
* Renomeando arquivos do plugin para ficar de acordo com o SVN do WordPress
= 1.5.2 =
* Small fix SVN
= 1.5.3 =
* Small fix SVN
= 1.5.4 =
* Melhoria no sistema de verificação de dependências e outros
= 1.5.5 =
* Adicionado verificação de segurança para is_plugin_active()
= 1.5.6 =
* Corrigido "Valor" of undefined para alguns usuários
= 1.5.7 =
* Desabilita o "Valor Declarado" para produtos com preço menor que 18.50
= 1.6.0 =
* Feedback para o admin caso o cálculo não seja exibido pois o produto está com algum dado inválido/incompleto. Calculando valor declarado para produtos variáveis. Fix máscara de CEP que não funcionava às vezes.
= 1.6.1 =
* Fix produtos acima 1000 reais. Fix cálculo sendo exibido para usuário mesmo quando algum dado estava inválido/incompleto.
= 2.0.0 =
* Integração com métodos de entrega do WooCommerce. Agora o plugin irá reconhecer configurações de envio do WooCommerce como dias adicionais, sobretaxas de envio, além de identificar o CEP do destinatário por país, estado ou faixa de CEP.
= 2.0.1 =
* Fix bug na versão 2.0.0 que impedia o cálculo de frete em alguns casos.
= 2.1.1 =
* Fix minor bug que impedia o cálculo de frete em alguns casos.
= 2.2.0 =
* Exibe a opção de "Frete Grátis" para produtos com valor mínimo específicado nas áreas de entrega do WooCommerce
= 2.3.0 =
* Fix peso em gramas. Adicionado painel de administração.
= 2.3.1 =
* Fix valor adicional.
= 2.3.2 =
* Fix undefined no javascript.
= 2.3.3 =
* Fix undefined no javascript.
= 3.0.0 =
* Plugin re-escrito do zero
= 3.0.1 =
* Alterado funcionamento interno de JSON para REST API
= 3.0.2 =
* Re-escrito regras de validação de método de entrega
= 3.0.3 =
* Melhorias diversas no JavaScript e classes internas
= 3.0.4 =
* Melhorias diversas em classes internas
= 3.0.5 =
* Refatoração interna de como as respostas são enviadas
= 3.0.6 =
* Adicionado tradução pt_BR
= 3.0.7 =
* Melhorias no funcionamento interno das classes
= 3.0.8 =
* Minor fix SVN WordPress
= 3.0.9 =
* Minor fix SVN WordPress
= 3.1.0 =
* Minor fix SVN WordPress
= 3.1.1 =
* Fix Flat Rate shipping method using cents in value.
= 3.1.2 =
* Fix differences with WooCommerce Correios in specific cases.
= 3.1.3 =
* Fix some issues with postcodes starting with zero (from São Paulo, for instance).
= 3.1.4 =
* Added fallback for postcode identification, such as some from Roraima and Rondônia.
= 3.1.5 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.6 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.7 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.8 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.9 =
* Removido nonce de autenticação desnecessário que poderia causar conflitos com alguns plugins de cache.
* Removido link de creditos do CFPP
= 3.1.91 =
* Fix missing composer autoloader
= 3.1.93 =
* Fix composer
= 3.1.94 =
* Fix notice ao pesquisar um produto que nao existe

== Upgrade Notice ==

= 1.0 =
Primeiro lançamento.
= 1.3.2 =
* Small fixes
= 1.3.3 =
* Changing version number
= 1.3.5 =
* Changing version number
= 1.3.6 =
* Updated WordPress compatible version number
= 1.3.7 =
* Fix Warning: call_user_func_array() expects parameter 1 to be a valid callback
= 1.3.8 =
* Fix pequena variação de preços no frete
= 1.3.9 =
* Fix mensagem de erro caso WooCommerce não esteja instalado ou CEP não esteja preenchido
= 1.4.0 =
* Plugin adaptado para rodar também em PHP 5
= 1.4.1 =
* Adicionado compatibilidade com versões do WooCommerce inferiores à 3.2.0
= 1.5.0 =
* Plugin re-escrito do zero para ficar mais simples
= 1.5.1 =
* Renomeando arquivos do plugin para ficar de acordo com o SVN do WordPress
= 1.5.2 =
* Small fix SVN
= 1.5.3 =
* Small fix SVN
= 1.5.4 =
* Melhoria no sistema de verificação de dependências e outros
= 1.5.5 =
* Adicionado verificação de segurança para is_plugin_active()
= 1.5.6 =
* Corrigido "Valor" of undefined para alguns usuários
= 1.5.7 =
* Desabilita o "Valor Declarado" para produtos com preço menor que 18.50
= 1.6.0 =
* Feedback para o admin caso o cálculo não seja exibido pois o produto está com algum dado inválido/incompleto. Calculando valor declarado para produtos variáveis. Fix máscara de CEP que não funcionava às vezes.
= 1.6.1 =
* Fix produtos acima 1000 reais. Fix cálculo sendo exibido para usuário mesmo quando algum dado estava inválido/incompleto.
= 2.0.0 =
* Integração com métodos de entrega do WooCommerce. Agora o plugin irá reconhecer configurações de envio do WooCommerce como dias adicionais, sobretaxas de envio, além de identificar o CEP do destinatário por país, estado ou faixa de CEP.
= 2.0.1 =
* Fix bug na versão 2.0.0 que impedia o cálculo de frete em alguns casos.
= 2.1.1 =
* Fix minor bug que impedia o cálculo de frete em alguns casos.
= 2.2.0 =
* Exibe a opção de "Frete Grátis" para produtos com valor mínimo específicado nas áreas de entrega do WooCommerce
= 2.3.0 =
* Fix peso em gramas. Adicionado painel de administração.
= 2.3.1 =
* Fix valor adicional.
= 2.3.2 =
* Fix undefined no javascript.
= 2.3.3 =
* Fix undefined no javascript.
= 3.0.0 =
* Plugin re-escrito do zero
= 3.0.1 =
* Alterado funcionamento interno de JSON para REST API
= 3.0.2 =
* Re-escrito regras de validação de método de entrega
= 3.0.3 =
* Melhorias diversas no JavaScript e classes internas
= 3.0.4 =
* Melhorias diversas em classes internas
= 3.0.5 =
* Refatoração interna de como as respostas são enviadas
= 3.0.6 =
* Adicionado tradução pt_BR
= 3.0.7 =
* Melhorias no funcionamento interno das classes
= 3.0.8 =
* Minor fix SVN WordPress
= 3.0.9 =
* Minor fix SVN WordPres
= 3.1.0 =
* Minor fix SVN WordPress
= 3.1.1 =
* Fix Flat Rate shipping method using cents in value.
= 3.1.2 =
* Fix differences with WooCommerce Correios in specific cases.
= 3.1.3 =
* Fix some issues with postcodes starting with zero (from São Paulo, for instance).
= 3.1.4 =
* Added fallback for postcode identification, such as some from Roraima and Rondônia.
= 3.1.5 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.6 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.7 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.8 =
* Fix CFPP no modo quick-view de Produtos. Adiciona alguns filtros. Adiciona possibilidade do admin medir a velocidade das requisições de cálculo de frete.
= 3.1.9 =
* Removido nonce de autenticação desnecessário que poderia causar conflitos com alguns plugins de cache.
* Removido link de creditos do CFPP
= 3.1.91 =
* Fix missing composer autoloader
= 3.1.93 =
* Fix composer
= 3.1.94 =
* Fix notice ao pesquisar um produto que nao existe
