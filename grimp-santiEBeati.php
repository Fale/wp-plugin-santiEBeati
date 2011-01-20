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

function grimp_seb_oggi() {
  echo "<SCRIPT LANGUAGE=javascript src='http://www.santiebeati.it/santidioggi.txt'></SCRIPT>";
}

function grimp_seb_domani() {
  echo "<SCRIPT LANGUAGE=javascript src='http://www.santiebeati.it/santididomani.txt'></SCRIPT>";
}

function grimp_seb_init(){
  register_sidebar_widget("Santi di Oggi", "grimp_seb_oggi");
  register_sidebar_widget("Santi di Domani", "grimp_seb_domani");
}

add_action("plugins_loaded", "grimp_seb_init");
?>
