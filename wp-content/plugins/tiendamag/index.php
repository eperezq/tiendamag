<?php

/*
Plugin Name: tiendamag
Plugin URI: youtube.com
Description: Pruebas de formularios
Version:1.0
Author:Erick
Author https://raiolanetworks.es
License:GPL2
*/

//funcion ejecuta al activar el plugins
function mag_activarplugin()
{
    //
}
register_activation_hook(__FILE__,'mag_activarplugin');


//funcion para agregar contenido de head
function hook_css() { 
    wp_enqueue_style('css-librerias-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',array());
    wp_enqueue_script('js-librerias-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    wp_enqueue_script('js-librerias-jquerygoogle', 'https://code.jquery.com/jquery-migrate-1.3.0.min.js');  

    global $wpdb;

    $output='<style>
                    .prueba {
                        width: 100%;
                        height: 60px;
                    }
                </style>';
   echo $output;   

}

add_action('wp_head','hook_css');

// Cuando el plugin se active se crea la tabla para recoger los datos si no existe
register_activation_hook(__FILE__, 'mensajes_usuario');


 
/**
 * Crea la tabla para recoger los datos del formulario
 *
 * @return void
 */
function mensajes_usuario() 
{
    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
    // Crea la tabla sólo si no existe
    // Utiliza el mismo prefijo del resto de tablas
    $tabla_mensaje = $wpdb->prefix . 'mensaje';
    // Utiliza el mismo tipo de orden de la base de datos
    $charset_collate = $wpdb->get_charset_collate();
    // Prepara la consulta
    $query = "CREATE TABLE IF NOT EXISTS $tabla_mensaje (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        texto varchar(100) NOT NULL,
        UNIQUE (id)
        ) $charset_collate;";
    // La función dbDelta permite crear tablas de manera segura se
    // define en el archivo upgrade.php que se incluye a continuación
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query); // Lanza la consulta para crear la tabla de manera segura
}

/** 
 * Define la función que ejecutará el shortcode
 * Comprueba si se han enviado los datos desde el formulario
 * y pinta el formulario
 *
 * @return string
 */
add_shortcode('mag_erick', 'mag_shorcode'); 
// funcion ejecuta shortcode
function mag_shorcode($atts, $content = null){
    //$_POST['texto'] = '';
    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
   
    ?>

    <form action="<?php get_the_permalink(); ?>" method="post" id="form_mensaje">
    
    <?php wp_nonce_field('graba_mensaje', 'mensaje_nonce'); ?>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
        <input type="mail" class="form-control" id="nombre" name="nombre" placeholder="name@gmail.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
        <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
    </div>
    <br>
    <div class="mb-3">
        <input type="submit" value="Enviar">
    </div>
    </form>
    
    <?php
  
     // Si viene del formulario  graba en la base de datos
    

    if ($_POST['texto'] != ''
    AND is_email($_POST['nombre'])
    //AND wp_verify_nonce($_POST['mensaje_nonce'], 'graba_mensaje')
    ) {
        $tabla_mensaje = $wpdb->prefix . 'mensaje'; 
        $nombre = ($_POST['nombre']);
        $texto = ($_POST['texto']);

        $wpdb->insert(
            $tabla_mensaje,
            array(
                'nombre' => $nombre,
                'texto' => $texto,
            )
        );
        
        echo "<div class='alert alert-success' role='alert'>Tus datos han sido registrados</div>";
          // Devuelve el contenido del buffer de salida
        
    } 
    return ob_get_clean();

 
}

// El hook "admin_menu" permite agregar un nuevo item al menú de administración
add_action("admin_menu", "mensajes_Contacto_menu");
 
/**
 * Agrega el menú del plugin al escritorio de WordPress
 *
 * @return void
 */
function mensajes_Contacto_menu() 
{
    add_menu_page(
        'Formulario Mensaje', 'Mensaje', 'manage_options', 
        'mensajes_contacto_menu', 'mensaje_Contacto_admin', 'dashicons-feedback', 75
    );
}

function mensaje_Contacto_admin()
{
    global $wpdb;
    $tabla_mensaje = $wpdb->prefix . 'mensaje';

    echo '<div class="wrap"><h1>Lista de Mensajes</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '  <thead>
                <tr>
                    <th width="30%">Correo</th>
                    <th width="20%">Mensaje</th>
                </tr>
            </thead>';
    echo '<tbody id="the-list">';

    $mensajes = $wpdb->get_results("SELECT * FROM $tabla_mensaje");

    foreach ( $mensajes as $mensaje ) {
        $nombre = esc_textarea($mensaje->nombre);
        $texto = esc_textarea($mensaje->texto);

        echo "<tr>
                <td><a href='#' >$nombre</a></td>
                <td>$texto</td>
            </tr>";
    }
    echo '</tbody></table></div>';
}


  
