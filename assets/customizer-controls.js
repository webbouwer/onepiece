/* extend customizer on the fly */

// http://themefoundation.com/customizer-multiple-category-control/

// Holds the status of whether or not the rest of the code should be run
var onepiece_multicat_js_run = true;
 
jQuery(window).load(function() {
 
    // Prevents code from running twice due to live preview window.load firing in addition to the main customizer window.
    if( true == onepiece_multicat_js_run ) {
        onepiece_multicat_js_run = false;
    } else {
        return;
    }
 
    var api = wp.customize;
 
    // Loops through each instance of the category checkboxes control.
    jQuery('.onepiece-hidden-categories').each(function(){
 
        var id = jQuery(this).prop('id');
        var categoryString = api.instance(id).get();
        var categoryArray = categoryString.split(',');
 
        // Checks/unchecks category checkboxes based on saved data.
        jQuery('#' + id).closest('li').find('.onepiece-category-checkbox').each(function() {
 
            var elementID = jQuery(this).prop('id').split('-');
 
            if( jQuery.inArray( elementID[1], categoryArray ) < 0 ) {
                jQuery(this).prop('checked', false);
            } else {
                jQuery(this).prop('checked', true);
            }
 
        });     
 
    });
 
    // Sets listeners for checkboxes
    jQuery('.onepiece-category-checkbox').live('change', function(){
 
        var id = jQuery(this).closest('li').find('.onepiece-hidden-categories').prop('id');
        var elementID = jQuery(this).prop('id').split('-');
 
        if( jQuery(this).prop('checked' ) == true ) {
            addCategory(elementID[1], id);
        } else {
            removeCategory(elementID[1], id);
        }
 
    });
 
    // Adds category ID to hidden input.
    function addCategory( catID, controlID ) {
 
        var categoryString = api.instance(controlID).get();
        var categoryArray = categoryString.split(',');
 
        if ( '' == categoryString ) {
            var delimiter = '';
        } else {
            var delimiter = ',';
        }
 
        // Updates hidden field value.
        if( jQuery.inArray( catID, categoryArray ) < 0 ) {
            api.instance(controlID).set( categoryString + delimiter + catID );
        }
    }
 
    // Removes category ID from hidden input.
    function removeCategory( catID, controlID ) {
 
        var categoryString = api.instance(controlID).get();
        var categoryArray = categoryString.split(',');
        var catIndex = jQuery.inArray( catID, categoryArray );
 
        if( catIndex >= 0 ) {
 
            // Removes element from array.
            categoryArray.splice(catIndex, 1);
 
            // Creates new category string based on remaining array elements.
            var newCategoryString = '';
            jQuery.each( categoryArray, function() {
                if ( '' == newCategoryString ) {
                    var delimiter = '';
                } else {
                    var delimiter = ',';
                }
                newCategoryString = newCategoryString + delimiter + this;
            });
 
            // Updates hidden field value.
            api.instance(controlID).set( newCategoryString );
        }
    }
});