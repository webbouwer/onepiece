<?php
/**
 * Extend customize control class.
 */
 
/** 
 * http://themefoundation.com/customizer-multiple-category-control/
 * Adds multiple category selection support to the theme customizer via checkboxes
 *
 * The category IDs are saved in the database as a comma separated string.
 */
class onepiece_multiselect_exclude_categories extends WP_Customize_Control {
    public $type = 'category-checkboxes';
 
    public function render_content() {
 
        // Loads theme-customizer.js javascript file.
        echo '<script src="' . get_template_directory_uri() . '/assets/customizer-controls.js"></script>';
 
        // Displays checkbox heading
        echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
        // Displays checkbox description
		if($this->description != ''){
        echo '<span class="customize-control-description">' . esc_html( $this->description ) . '</span>';
        }
        // Displays category checkboxes.
        foreach ( get_categories() as $category ) {
            echo '<label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="onepiece-category-checkbox"> ' . $category->cat_name . '</label><br>';    
        }
 
        // Loads the hidden input field that stores the saved category list.
        ?><input type="hidden" id="<?php echo $this->id; ?>" class="onepiece-hidden-categories" <?php $this->link(); ?> value="<?php echo sanitize_text_field( $this->value() ); ?>"><?php
    }
}
?>