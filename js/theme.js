jQuery(document).ready(function($){
    //Preloader
    jQuery(window).load(function() {
        preloaderFadeOutTime = 500;
        function hidePreloader() {
            var preloader = jQuery('.preloader');
            preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
    });
    
    $(".button-collapse").sideNav();
    
    $('.slider').slider({
        full_width: true,
        height: 520,
    });
    
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
    
    jQuery("a.post-like").click(function(){
     
        heart = jQuery(this);
     
        // Retrieve post ID from data attribute
        post_id = heart.data("post_id");
         
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
            success: function(count){
                // If vote successful
                if(count != "already")
                {
                    heart.addClass("disabled");
                    heart.children(".count").text(count);
                }
            }
        });
         
        return false;
    })
    
});