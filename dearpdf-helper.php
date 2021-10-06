<?php
/**
 * Plugin Name:     Dearpdf Helper
 * Plugin URI:      https://pixelnib.com
 * Description:     Helper plugin for DearPDF
 * Author:          PixelNib
 * Author URI:      https://pixelnib.com
 * Text Domain:     dearpdf-helper
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Dearpdf_Helper
 */


//Adding tags to cpt
function reg_tag() {
    register_taxonomy_for_object_type('post_tag', 'dearpdf');
}
add_action('init', 'reg_tag');


//Fixing slug for CPT
add_filter( 'register_taxonomy_args', 'pn_taxonomy_args', 10, 2 );
function pn_taxonomy_args( $args, $taxonomy ) {

    // Target "my-taxonomy"
    if ( 'dearpdf_category' !== $taxonomy ) {
        return $args;
    }

    // Set slug
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'dearpdf-helper' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'dearpdf-helper' ),
        'search_items'      => __( 'Search Categories', 'dearpdf-helper' ),
        'all_items'         => __( 'All Categories', 'dearpdf-helper' ),
        'view_item'         => __( 'View Category', 'dearpdf-helper' ),
        'parent_item'       => __( 'Parent Category', 'dearpdf-helper' ),
        'parent_item_colon' => __( 'Parent Category:', 'dearpdf-helper' ),
        'edit_item'         => __( 'Edit Category', 'dearpdf-helper' ),
        'update_item'       => __( 'Update Category', 'dearpdf-helper' ),
        'add_new_item'      => __( 'Add New Category', 'dearpdf-helper' ),
        'new_item_name'     => __( 'New Category Name', 'dearpdf-helper' ),
        'not_found'         => __( 'No Categories Found', 'dearpdf-helper' ),
        'back_to_items'     => __( 'Back to Categories', 'dearpdf-helper' ),
        'menu_name'         => __( 'Categories', 'dearpdf-helper' ),
    );

    $args = array(
            'labels' => $labels,
            'rewrite' => array('slug' => "books"),
    );

    // Return
    return $args;
}
// Single book
        function pn_single_template_content()
        {
            global  $post ;
            echo  '<div class="dearpdf-single-content">' ;
            echo  do_shortcode( '[dearpdf type="button" id="' . $post->ID . '"]Hello world![/dearpdf]' ) ;
            echo  '</div>' ;
            $post_data = get_post_meta( $post->ID, '_dearpdf_data' ,true);
            echo '<img src=" ' . $post_data['pdfThumb'] . ' "></img>';
            

        }

        add_action("dearpdf_single_content", "pn_single_template_content", 10, 1);

        function pn_before_single_content() {
            echo 'Before content';
        }

        add_action( "before_dearpdf_single_content", "pn_before_single_content", 10, 1 );

       