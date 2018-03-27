=== WooCommerce Correios - Cálculo de Frete na Página do Produto ===
Contributors: lucasbustamante
Donate link: http://www.lucasbustamante.com.br
Tags: woocommerce, woocomerce correios, woocommerce correios produto
Requires at least: 3.0.1
Tested up to: 4.9.2
Stable tag: 4.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Habilita o cálculo de frete na página do produto.

== Description ==

Desde o lançamento da versão 3.0.0 do WooCommerce Correios em 26/06/2016, não é mais possível calcular o frete na página do produto. Este plugin implementa novamente esta função. Basta instalar e ativar.

![exemplo de implementação do cálculo de frete na página do produto no WooCommerce](https://www.lucasbustamante.com.br/uploads/u/2018/03/dia-15_16h46m15s_chrome.jpg)

= Considerações: =
1. O CEP de origem será calculado a partir do CEP informado em WooCommerce -> Configurações -> CEP.
2. Será informado preço e prazo de entrega para PAC e SEDEX (sem contrato).
3. Se o produto não tiver as dimensões ou peso especificados, o box de cálculo de frete não aparece para aquele produto.

Este plugin é gratuito, open-source e está disponível no GitHub!

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
