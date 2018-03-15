=== WooCommerce Correios - Cálculo de Frete na Página do Produto ===
Contributors: lucasbustamante
Donate link: http://www.lucasbustamante.com.br
Tags: woocommerce, woocomerce correios, woocommerce correios produto
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Habilita o cálculo de frete na página do produto.

== Description ==

# WooCommerce Correios - Cálculo de Frete na Página do Produto

Desde o lançamento da versão 3.0.0 do WooCommerce Correios em 26/06/2016, o WooCommerce Correios perdeu a capacidade de calcular o frete na página do produto.

Este plugin implementa novamente esta função. Basta instalar e ativar.

![exemplo de implementação do cálculo de frete na página do produto no WooCommerce](https://www.lucasbustamante.com.br/uploads/u/2018/03/dia-15_16h46m15s_chrome.jpg)

Considerações:
- O CEP de origem será calculado a partir do CEP informado em WooCommerce -> Configurações -> CEP.
- Será informado preço e prazo de entrega para PAC e SEDEX (sem contrato).
- Se o produto não tiver as dimensões ou peso especificados, o box de cálculo de frete não aparece para aquele produto.

Este plugin é gratuito e open-source. Pull-requests são bem vindos!

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

== Upgrade Notice ==

= 1.0 =
Primeiro lançamento.
