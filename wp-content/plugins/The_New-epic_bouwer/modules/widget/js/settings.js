(function($){

    EPBOUWER.registerModuleHelper('widget', {

        init: function()
        {
            var form    = $('.ep-bouwer-settings'),
                missing = form.find('.ep-bouwer-widget-missing');
                
            if(missing.length > 0) {
                form.find('.ep-bouwer-settings-save').hide();
            }
        }
    });

})(jQuery);