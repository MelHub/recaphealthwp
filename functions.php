<?php

/**
 * Load theme options.
 */
$themename = "RecapHealth";
$pre = "recap";
  
$options = array();
  
$functions_path = TEMPLATEPATH . '/library/admin/';
  
define( OPTION_FILES, 'base.php' );
  
function recap_admin() {
  global $themename, $options, $pre, $functions_path;
      
  if (function_exists('add_menu_page')) {
    $basename = basename( OPTION_FILES );
    add_theme_page( $themename." Team", "$themename Team Page", 'edit_themes', 'build.php', 'build_options');
  }
}
  
function build_options() {
  global $themename, $pre, $functions_path, $options;
        
  $page = $_GET["page"];
    
  include( $functions_path . '/options/' . $page );
        
  if ( 'save' == $_REQUEST['action'] ) {
          
    foreach ($options as $value) {
      if ( is_array($value['type'])) {
        foreach($value['type'] as $meta => $type){
          if($type == 'text'){
                update_option( $meta, $_REQUEST[ $meta ]);
          }
        }                 
      }
      elseif($value['type'] != 'multicheck'){
        if(isset( $_REQUEST[ $value['id'] ])){
          update_option( $value['id'], $_REQUEST[ $value['id'] ] );} else { delete_option( $value['id'] ); }
        }
        else { 
          foreach($value['options'] as $mc_key => $mc_value){
            $up_opt = $value['id'].'_'.$mc_key;
            update_option($up_opt, $_REQUEST[$up_opt] );
          }
        } 
      }
    } 
  include( $functions_path . '/build.php' );
}
  
function build_admin_head() {
  global $functions_path;
  
  if ('themes.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/library/admin/build.css" media="screen" />';
    echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/library/script/$.min.js"></script>';
    ?>
    <script language="javascript">
      $(function(){
        var tabNav = $('.to-navsections ul li a'),
            tabContainers = $('.to-sections .to-section');

        tabNav.removeClass('selected').hide().filter(':first').show().addClass('selected');
        tabNav.show();
        tabContainers.hide().filter(':first').show();
        $('.to-navsections ul li a').on('click', function(){
          tabContainers.hide();
          tabContainers.filter(this.hash).show();
          tabNav.removeClass('selected');
          $(this).addClass('selected');
          return false;
        });
            
        $('#buildsave').on('click', function(e){
          var options_fromform = $('#buildform').serialize();
          var save_button = $(this);
              
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "themes.php?page=base.php",
            data: options_fromform,
            success: function(response){
              save_button.html("Changes Saved");
                    
              save_button.blur();
              
              setTimeout(function(){
                save_button.css("background-color","#3169b6");
                save_button.html("Save Changes");
              },1500);
            },
            error: function(err){
              save_button.html("Error");
            }
          });
              
          return false;
        });
            
        $('#buildsave').ajaxStart(function(){
          $(this).css("background-color","#09f");
          $(this).html("Saving...");
        });
      });
    </script>
    <?php
  }  //end of theme accesibility mode
}
  
add_action('admin_menu', 'recap_admin');
add_action('admin_head', 'build_admin_head');
