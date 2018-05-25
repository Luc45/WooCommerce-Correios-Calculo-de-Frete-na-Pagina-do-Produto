<?php

/**
 * Classe responsável pela página de configurações do plugin WooCommerce Correios - Cálculo de Frete na Página do Plugin
 */
class CFPP_Admin
{

    private $options;
    private $caminhao_svg;
    private $metodos_entrega_possiveis;

    public function __construct() {
        $this->preenche_options();

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ), 10 );
        add_action( 'admin_init', array( $this, 'first_setup' ), 11 );

        $this->caminhao_svg = file_get_contents(WOO_CORREIOS_CALCULO_CEP_BASE_PATH.'/assets/img/caminhao.svg');

        $this->metodos_entrega_possiveis = array(
            'WC_Correios_Shipping_PAC' => 'PAC',
            'WC_Correios_Shipping_SEDEX' => 'SEDEX',
        );
    }

    /**
    *   Roda na execução do código para preencher os options para uso interno do plugin
    */
    protected function preenche_options() {
        $options = get_option('cfpp_options');
        if (isset($options['metodos_entrega']) && !empty($options['metodos_entrega']) && is_array($options['metodos_entrega'])) {
            foreach ($options['metodos_entrega'] as $key => $value) {
                $options['metodos_entrega'][$value] = $value;
                unset($options['metodos_entrega'][$key]);
            }
        }
        $this->options = $options;
    }

    /**
    *   Preenche os valores padrões, se necessário
    */
    public function first_setup() {
        if (empty($this->options)) {
            $padroes = array(
                'metodos_entrega' => array('WC_Correios_Shipping_PAC', 'WC_Correios_Shipping_SEDEX'),
                'exibir_frete_gratis' => 'true',
                'exibir_retirar_em_maos' => 'true',
                'cor_do_botao' => '#03a9f4',
                'cor_do_texto' => '#FFFFFF'
            );
            update_option( 'cfpp_options', $padroes );
        }
    }

    /**
     * Irá aparecer em "Configurações", ou "Settings"
     */
    public function add_plugin_page() {
        add_options_page(
            'Settings Admin',
            'Cálc. Frete Pág. Prod.',
            'manage_options',
            'cfpp-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Callback da options page
     */
    public function create_admin_page() {
        ?>
        <div class="wrap">
            <h1>Cálculo de Frete na Página do Produto</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'cfpp_option_group' );
                do_settings_sections( 'cfpp-settings' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Registra e adiciona as configurações
     */
    public function page_init() {
        // Registra o grupo de configurações
        register_setting(
            'cfpp_option_group', // Option group
            'cfpp_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        // Cria uma seção
        add_settings_section(
            'cfpp_section_id', // ID
            'Configurações gerais', // Title
            '', // Callback
            'cfpp-settings' // Page
        );

        // Finalmente, os campos em si.

        // Lista de métodos de entrega a serem exibidos
        add_settings_field(
            'metodos_entrega', // ID
            'Métodos de Entrega a serem calculados na página do produto:', // Title
            array( $this, 'campo_metodos_entrega' ), // Callback
            'cfpp-settings', // Page
            'cfpp_section_id' // Section
        );

        // Exibir Frete Grátis?
        add_settings_field(
            'exibir_frete_gratis', // ID
            'Exibir Frete Grátis?', // Title
            array( $this, 'campo_exibir_frete_gratis' ), // Callback
            'cfpp-settings', // Page
            'cfpp_section_id' // Section
        );

        // Exibir retirar em mãos?
        add_settings_field(
            'exibir_retirar_em_maos', // ID
            'Exibir Retirar em Mãos?', // Title
            array( $this, 'campo_exibir_retirar_em_maos' ), // Callback
            'cfpp-settings', // Page
            'cfpp_section_id' // Section
        );

        /*
            Exibir créditos do plugin?

            Vou deixar esta opção desabilitada, pois este será o "preço" a pagar por usar o plugin gratuitamente... Consegui colocar os créditos de forma bem discreta que me geram back-links importantes para o meu posicionamento no Google, então vou deixar assim, ok? Se você for um programador experiente e realmente não quiser contribuir com este singelo back-link discreto, remova os créditos com CSS.

            add_settings_field(
                'exibir_creditos_do_plugin', // ID
                'Exibir Créditos do Plugin?', // Title
                array( $this, 'campo_exibir_creditos_do_plugin' ), // Callback
                'cfpp-settings', // Page
                'cfpp_section_id' // Section
            );
        */

        // Alterar cor do botão
        add_settings_field(
            'cor_do_botao',
            'Cor do Botão',
            array( $this, 'cor_do_botao' ),
            'cfpp-settings',
            'cfpp_section_id'
        );

        // Alterar cor do botão
        add_settings_field(
            'cor_do_texto',
            '',
            '',
            'cfpp-settings',
            'cfpp_section_id'
        );
    }

    /**
     * Valida todos os campos na hora de salvar
     */
    public function sanitize( $input ) {
        $new_input = array();

        if (isset($input['metodos_entrega'])) {
            if (is_array($input['metodos_entrega'])) {
                foreach ($input['metodos_entrega'] as $metodo_entrega) {
                    if (array_key_exists($metodo_entrega, $this->metodos_entrega_possiveis)) {
                        $new_input['metodos_entrega'][] = $metodo_entrega;
                    }
                }
            }
        }
        if (isset($input['exibir_frete_gratis'])) {
            if ($input['exibir_frete_gratis'] == 'true' || $input['exibir_frete_gratis'] == 'false') {
                $new_input['exibir_frete_gratis'] = $input['exibir_frete_gratis'];
            }
        }
        if (isset($input['exibir_retirar_em_maos'])) {
            if ($input['exibir_retirar_em_maos'] == 'true' || $input['exibir_retirar_em_maos'] == 'false') {
                $new_input['exibir_retirar_em_maos'] = $input['exibir_retirar_em_maos'];
            }
        }
        if (isset($input['cor_do_botao'])) {
            if (strlen($input['cor_do_botao']) == 7 && substr($input['cor_do_botao'], 0, 1) == '#') {
                $new_input['cor_do_botao'] = sanitize_text_field($input['cor_do_botao']);
            }
        }
        if (isset($input['cor_do_texto'])) {
            if (strlen($input['cor_do_texto']) == 7 && substr($input['cor_do_texto'], 0, 1) == '#') {
                $new_input['cor_do_texto'] = sanitize_text_field($input['cor_do_texto']);
            }
        }

        return $new_input;
    }

    // Exibe o HTML para o campo "Método de Entrega"
    public function campo_metodos_entrega() {

        $opcoes = $this->metodos_entrega_possiveis;

        $html = '<div class="cfpp_warning"><strong>Atenção!</strong> Cada método de entrega selecionado demora cerca de 1 a 2 segundos para calcular, logo, selecione o menor número possível de métodos de entrega aqui. O plugin já identifica se o seu SEDEX é com contrato ou sem contrato automaticamente de acordo com as configurações do método de entrega SEDEX no WooCommerce Correios.</div>';

        $html .= '<ul>';

            foreach ($opcoes as $key => $value) {
                $checked =  array_key_exists($key, $this->options['metodos_entrega']) ? 'checked="checked"' : "";
                $html .= '<li>';
                    $html .= '<input type="checkbox" id="'.$key.'" name="cfpp_options[metodos_entrega][]" value="'.$key.'" '.$checked.'/>';
                    $html .= '<label for="'.$key.'">'.$value.'</label>';
                $html .= '</li>';
            }

        $html .= '</ul>';

        echo $html;
    }

    // Exibe o HTML para o campo "Exibir Frete Grátis"
    public function campo_exibir_frete_gratis() {

        $opcoes = array(
            'true' => 'Sim',
            'false' => 'Não',
        );

        $html = '<div class="cfpp_warning">O "Frete Grátis" é um método de entrega do WooCommerce assim como o PAC e Sedex. Ele pode ser configurado para estar habilitado nas compras acima de 300 reais, por exemplo. Configure o "Frete Grátis" nas áreas de entrega do WooCommerce e deixe esta opção habilitada para que seja exibida caso o produto e o CEP informado estejam dentro dos critérios de gratuidade.</div>';

        $html .= '<ul>';

            foreach ($opcoes as $key => $value) {
                $html .= '<li>';
                    $html .= '<input type="radio" id="frete_gratis_'.$key.'" name="cfpp_options[exibir_frete_gratis]" value="'.$key.'"' . checked( $key, $this->options['exibir_frete_gratis'], false ) . '/>';
                    $html .= '<label for="frete_gratis_'.$key.'">'.$value.'</label>';
                $html .= '</li>';
            }

        $html .= '</ul>';

        echo $html;
    }

    // Exibe o HTML para o campo "Exibir Retirar em Mãos"
    public function campo_exibir_retirar_em_maos() {

        $opcoes = array(
            'true' => 'Sim',
            'false' => 'Não',
        );

        $html = '<div class="cfpp_warning">Assim como o "Frete Grátis", o "Retirar em Mãos" também é um método de entrega do WooCommerce. Ele deve ser configurado nas áreas de entrega do WooCommerce de acordo com critérios específicos, por exemplo, determinados CEPs podem "retirar em mãos". Deixe esta opção habilitada para que a opção "Retirar em Mãos" apareça caso o CEP informado esteja dentro dos critérios da zona de entrega "Retirar em Mãos" configurada no WooCommerce.</div>';

        $html .= '<ul>';

            foreach ($opcoes as $key => $value) {
                $html .= '<li>';
                    $html .= '<input type="radio" id="retirar_em_maos_'.$key.'" name="cfpp_options[exibir_retirar_em_maos]" value="'.$key.'"' . checked( $key, $this->options['exibir_retirar_em_maos'], false ) . '/>';
                    $html .= '<label for="retirar_em_maos_'.$key.'">'.$value.'</label>';
                $html .= '</li>';
            }

        $html .= '</ul>';

        echo $html;
    }

    /**
    *   Exibe o HTML para o campo "Exibir Créditos do Plugin"
    *   @deprecated
    */
    /*
    public function campo_exibir_creditos_do_plugin() {

        $opcoes = array(
            'true' => 'Sim',
            'false' => 'Não',
        );

        $html = '<div class="cfpp_warning">Este plugin é gratuito. Como forma de recompensar o investimento de tempo que despendi para criá-lo, considere deixar esta opção habilitada, por gentileza.</div>';

        $html .= '<ul>';

            foreach ($opcoes as $key => $value) {
                $html .= '<li>';
                    $html .= '<input type="radio" id="creditos_'.$key.'" name="cfpp_options[exibir_creditos_do_plugin]" value="'.$key.'"' . checked( $key, $this->options['exibir_creditos_do_plugin'], false ) . '/>';
                    $html .= '<label for="creditos_'.$key.'">'.$value.'</label>';
                $html .= '</li>';
            }

        $html .= '</ul>';

        echo $html;
    }
    */

    // Altera a cor do botão
    public function cor_do_botao() {

        $cor = isset($this->options['cor_do_botao']) ? esc_attr($this->options['cor_do_botao']) : "#03a9f4";
        $cor_do_texto = isset($this->options['cor_do_texto']) ? esc_attr($this->options['cor_do_texto']) : "#ffffff";

        $html = '<div class="cfpp_warning">Use o seletor abaixo para alterar a cor do fundo. (<span id="alterar_para_text">Prefere digitar o valor hexadecimal da cor? <a href="#" onclick="alterarParaText()">Usar Text Input</a></span><span id="alterar_para_seletor_cor">Prefere usar o seletor de cor? <a href="#" onclick="alterarParaSeletorCor()">Usar Seletor de Cor</a></span>)</div>';

        $html .= '<br>';

        $html .= '<input
                    type="color"
                    id="cor_do_botao"
                    name="cfpp_options[cor_do_botao]"
                    value="'.$cor.'"
                    maxlength="7"
                    onchange="simular_botao(this)"/>';

        $html .= '<p>Use o seletor abaixo para alterar a cor do texto.</p>';

        $html .= '<input
                    type="color"
                    id="cor_do_texto"
                    name="cfpp_options[cor_do_texto]"
                    value="'.$cor_do_texto.'"
                    maxlength="7"
                    onchange="simular_texto(this)"/>';

        $html .= '<br><div class="simulacao">';
        $html .= '<h2>Simulação:</h2>';
            $html .= '
                <style>
                    #calcular-frete svg {fill:'.$cor_do_texto.'}
                    #calcular-frete {color:'.$cor_do_texto.'}
                </style>
                <div class="calculo-de-frete">
                    <input type="text" maxlength="9" readonly=readonly style="background-color:white">
                    <div id="calcular-frete" style="background-color:'.$cor.'">'.$this->caminhao_svg.' Calcular Frete</div>
                </div>
            ';
        $html .= '</div>';

        echo $html;
    }
}
