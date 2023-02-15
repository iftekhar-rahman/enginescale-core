;(function($){
    'use strict';
    
    // init Isotope
    // var $grid = $('.grid').isotope({
    //     // options
    // });
    // // filter items on button click
    // $('.button-group').on( 'click', 'button', function() {
    //     var filterValue = $(this).attr('data-filter');
    //     $grid.isotope({ filter: filterValue });
    // });
    
        // /* portfolio isotope js */
        // jQuery("#portfolio").imagesLoaded(function(){
        //     var $grid = $('.grid').isotope({
        //         itemSelector: '.single-portfolio-item'
        //     });
        //     var $filterButtons = $('.filters .button');
        //     updateFilterCounts();
        //     /* store filter for each group*/
        //     var filters = {};
        //     $('.filters').on( 'click', '.button', function() {
        //         var $this = $(this);
        //         var $buttonGroup = $this.parents('.button-group');
        //         var filterGroup = $buttonGroup.attr('data-filter-group');
        //         filters[ filterGroup ] = $this.attr('data-filter');
        //         var filterValue = concatValues( filters );
        //         $grid.isotope({ filter: filterValue });
        //         updateFilterCounts();
        //     });
        //     /* change is-checked class on buttons*/
        //     $('.button-group').each( function( i, buttonGroup ) {
        //         var $buttonGroup = $( buttonGroup );
        //         $buttonGroup.on( 'click', 'button', function() {
        //             $buttonGroup.find('.is-checked').removeClass('is-checked');
        //             $( this ).addClass('is-checked');
        //         });
        //     });
        //     /* flatten object by concatting values */
        //     function concatValues( obj ) {
        //         var value = '';
        //         for ( var prop in obj ) {
        //             value += obj[ prop ];
        //         }
        //         return value;
        //     }
        //     function updateFilterCounts()  {
        //         var itemElems = $grid.isotope('getFilteredItemElements');
        //         var $itemElems = $( itemElems );
        //         $filterButtons.each( function( i, button ) {
        //             var $button = $( button );
        //             var filterValue = $button.attr('data-filter');
        //             if ( !filterValue ) {
        //                 return;
        //             }
        //             var count = $itemElems.filter( filterValue ).length;
        //             $button.find('.filter-count').text( '(' + count +')' );
        //         });
        //     }
        // });
    
        jQuery( function() {
            $( "#tabs" ).tabs();
        } );
    
        
    
    
    })(jQuery);
    