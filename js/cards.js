jQuery(function(){
    jQuery('.pbp-card-handle').on('mouseenter', function(){
        var container = jQuery(this);
        var card = jQuery("#div-" +id);
        
        var id = container.attr('id');
        card.show();
        
        card.position();
    });
    
    jQuery('.pbp-card-handle').on('mouseleave', function(){
        var id = jQuery(this).attr('id');
        jQuery("#div-" +id).hide();
    });
})