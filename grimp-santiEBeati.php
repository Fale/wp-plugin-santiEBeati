<?php
/*
Plugin Name: Grimp - Santi e Beati
Plugin URI: http://git.grimp.eu/projects/wp-plugin-santiebeati
Description: This plugin will allow you to show today and tomorrow Saints
Dependencies: grimp-php/grimp-php.php
Version: 0.1
Author: Fabio Alessandro Locati
Author URI: http://grimp.eu
License: GPL2
*/


add_action("widgets_init", "grimp_seb_init");

function grimp_seb_init(){
    register_widget("grimp_seb");
}


class grimp_seb extends WP_Widget {
    function grimp_seb() {
        /* Impostazione del widget */
        $widget_ops = array( 'classname' => 'grimp-seb', 'description' => 'This plugin allows you to show today and tomorrow Saints' );

        /* Impostazioni di controllo del widget */
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'grimp-seb' );
        /* Creiamo il widget */
        $this->WP_Widget( 'grimp-seb', 'Santi e Beati', $widget_ops, $control_ops );
    }


    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
        if ( $instance['day'] == "today" )
            echo "<SCRIPT LANGUAGE=javascript src='http://www.santiebeati.it/santidioggi.txt'></SCRIPT>";
        if ( $instance['day'] == "tomorrow" )
            echo "<SCRIPT LANGUAGE=javascript src='http://www.santiebeati.it/santididomani.txt'></SCRIPT>";
        echo $after_widget;
    }
    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['day'] = $new_instance['day'];
        return $instance;
    }

    function form( $instance ) {

        /* Impostazioni di default del widget */
        $defaults = array( 'title' => 'Santi', 'day' => 'today' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'today' ); ?>">Di che giorno vuoi i santi?</label>
    <select name="<?php echo $this->get_field_name( 'day' ); ?>">
        <option <?php selected( $instance['day'], 'today' ); ?> value="today" />Today
        <option <?php selected( $instance['day'], 'tomorrow' ); ?>  value="tomorrow" />Tomorrow
    </select>
</p>
        <?php
   }
}

?>
