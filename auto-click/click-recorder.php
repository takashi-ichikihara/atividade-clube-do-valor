<?php
/*
Plugin Name: Click Recorder
Description: Adiciona um shortcode para registrar cliques no banco de dados.
*/

// Função para criar a tabela no banco de dados durante a ativação do plugin
function criar_tabela_cliques()
{
    global $wpdb;
    $tabela = $wpdb->prefix . 'registros_cliques';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabela (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        data_hora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'criar_tabela_cliques');

// Função para registrar o clique no banco de dados
function registrar_clique()
{
    global $wpdb;
    $tabela = $wpdb->prefix . 'registros_cliques';

    $wpdb->insert($tabela, ['data_hora' => current_time('mysql')]);
}

// Função que exibe o botão via shortcode
function exibir_botao_registro()
{
    ob_start(); ?>
    <button id="botao-registro">Registrar Clique</button>
    <script>
        document.getElementById('botao-registro').addEventListener('click', function() {
            // Faz uma requisição AJAX para registrar o clique
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: 'action=registrar_clique',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
        });
    </script>
    <?php return ob_get_clean();
}
add_shortcode('botao_registro', 'exibir_botao_registro');
add_action('wp_ajax_registrar_clique', 'registrar_clique');
add_action('wp_ajax_nopriv_registrar_clique', 'registrar_clique');
