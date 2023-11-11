<?php
/*
Plugin Name: Click Tracking
Description: Adiciona um botão que registra cliques no banco de dados.
Version: 1.0
*/

// Função para criar a tabela no banco de dados
function create_click_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'clicks';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        click_date datetime NOT NULL,
        clicks int NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_click_table');

// Função para adicionar o botão com o shortcode
function click_tracking_button()
{
    ob_start(); ?>
    <button id="clickButton">CLIQUE AQUI AGORA MESMO!</button>
    <script>
        document.getElementById('clickButton').addEventListener('click', function() {
            // Quando o botão é clicado, faz uma requisição para registrar o clique
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Clique registrado!');
                }
            };
            xhr.send('action=track_click');
        });
    </script>
    <?php return ob_get_clean();
}
add_shortcode('click_button', 'click_tracking_button');

// Função para registrar o clique no banco de dados
function track_click()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'clicks';

    $wpdb->insert($table_name, [
        'click_date' => current_time('mysql', 1),
        'clicks' => 1,
    ]);
    wp_die();
}
add_action('wp_ajax_track_click', 'track_click');
add_action('wp_ajax_nopriv_track_click', 'track_click');

// Função para exibir os dados da tabela em um post, com botões para editar ou excluir
function display_click_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'clicks';

    if (isset($_POST['delete_click'])) {
        $delete_id = $_POST['delete_click'];
        $wpdb->delete($table_name, ['id' => $delete_id]);
    }

    $clicks = $wpdb->get_results("SELECT * FROM $table_name");

    ob_start();
    ?>
  <table>
      <thead>
          <tr>
              <th>ID</th>
              <th>Data e Hora</th>
              <th>Cliques</th>
              <th>Ações</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($clicks as $click) {
              echo '<tr>';
              echo "<td>{$click->id}</td>";
              echo "<td>{$click->click_date}</td>";
              echo "<td>{$click->clicks}</td>";
              echo "<td>
                  <form method='post'>
                      <input type='hidden' name='delete_click' value='{$click->id}'>
                      <button type='submit'>Excluir</button>
                  </form>
              </td>";
              echo '</tr>';
          } ?>
      </tbody>
  </table>
  <?php
  echo '<style>table {margin-bottom: 20px; border-collapse: collapse;} td, th {border: 1px solid #ccc; padding: 8px;}</style>';
  return ob_get_clean();
}
add_shortcode('display_click_table', 'display_click_table');

if (defined('WP_CLI') && WP_CLI) {
    // Comando WP-CLI para imprimir relatório de histórico de registros
    function click_tracking_report()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'clicks';
        $clicks = $wpdb->get_results(
            "SELECT id, click_date, clicks FROM $table_name ORDER BY id DESC LIMIT 10"
        );

        foreach ($clicks as $click) {
            WP_CLI::line(
                "ID: {$click->id}, Data e Hora: {$click->click_date}, Cliques: {$click->clicks}"
            );
        }
    }
    WP_CLI::add_command('click-tracking report', 'click_tracking_report');
}
