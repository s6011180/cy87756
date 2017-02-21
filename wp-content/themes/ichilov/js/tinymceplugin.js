function getBaseURL () {
   return location.protocol + '//' + location.hostname + 
      (location.port && ':' + location.port) + '/';
}

(function() {
    tinymce.create('tinymce.plugins.spanb', {
        init : function(ed, url) {
                console.log(url);
            ed.addButton('spanb', {
                title : 'Жирный *',image : url+'/icons/behance.png',onclick : function() {
                     ed.selection.setContent('<span class="bold">' + ed.selection.getContent() + '</span>');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('spanb', tinymce.plugins.spanb);
})();