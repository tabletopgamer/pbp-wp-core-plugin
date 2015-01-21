jQuery(function(){
    jQuery('.pbp-card-handle').on('mouseenter', function(){
        var container = jQuery(this);
        var id = container.attr('id');
        var card = jQuery("#div-" +id);
        

        card.show();
        
        card.position();
    });
    
    jQuery('.pbp-card-handle').on('mouseleave', function(){
        var id = jQuery(this).attr('id');
        jQuery("#div-" +id).hide();
    });
})