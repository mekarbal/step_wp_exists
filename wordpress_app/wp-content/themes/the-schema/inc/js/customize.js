jQuery(document).ready(function($){
    /* Move widgets to their respective sections */
	wp.customize.section( 'sidebar-widgets-the-schema-about' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-the-schema-about' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-the-schema-client' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-the-schema-client' ).priority( '25' );   
    wp.customize.section( 'sidebar-widgets-the-schema-service' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-the-schema-service' ).priority( '35' );
    
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        the_schemea_scrollToSection( section_id );
    });

    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( the_schema_customize_data.home );
            }
        });
    });

});

function the_schemea_scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-header_image':
        preview_section_id = "banner_section";
        break;

        case 'accordion-section-sidebar-widgets-the-schema-about':
        preview_section_id = "about_section";
        break;

        case 'accordion-section-sidebar-widgets-the-schema-client':
        preview_section_id = "client_section";
        break;
        
        case 'accordion-section-sidebar-widgets-the-schema-service':
        preview_section_id = "service_section";
        break;
        
        case 'accordion-section-blog_section':
        preview_section_id = "content";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );