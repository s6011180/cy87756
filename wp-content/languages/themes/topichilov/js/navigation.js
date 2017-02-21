/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), button, menu;
	if ( ! nav )
		return;
	button = nav.getElementsByTagName( 'h3' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	if ( ! button )
		return;

	// Hide button if menu is missing or empty.
	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function() {
		if ( -1 == menu.className.indexOf( 'nav-menu' ) )
			menu.className = 'nav-menu';

		if ( -1 != button.className.indexOf( 'toggled-on' ) ) {
			button.className = button.className.replace( ' toggled-on', '' );
			menu.className = menu.className.replace( ' toggled-on', '' );
		} else {
			button.className += ' toggled-on';
			menu.className += ' toggled-on';
		}
	};
} )();

jQuery(document).ready(function(){
    jQuery(".call-me a").colorbox({iframe:true, width: '595px', height: '300px', scrolling: false});
    
     jQuery('a.spoiler-title').click(function(e){
            e.preventDefault();
            if( jQuery(this).text() === 'Свернуть' )
                jQuery(this).text( jQuery(this).attr('title') )
            else
                jQuery(this).text( 'Свернуть' );
            jQuery(this).next('.spoiler-content').toggle();
        });
        
        jQuery('a.definition-title').click(function(e){
            e.preventDefault();
            jQuery(this).parent().next('.definition-content').toggle();
        });
        
        jQuery(function(jQuery){
            jQuery.datepicker.regional['ru'] = {
                    closeText: 'Закрыть',
                    prevText: '&#x3c;Пред',
                    nextText: 'След&#x3e;',
                    currentText: 'Сегодня',
                    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                    'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                    'Июл','Авг','Сен','Окт','Ноя','Дек'],
                    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                    weekHeader: 'Не',
                    dateFormat: 'dd.mm.yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
            jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']);

        });
//        if ( ! jQuery.browser.chrome) {
            jQuery(".field-your-date-of-birth input, .field-date-of-arrive input").datepicker();
//        }
        jQuery("body").bind("copy", function () {
                var body_element = document.getElementsByTagName('body')[0];
                var selection;
                selection = window.getSelection();
                var pre = "Материалы сайта защищены авторским правом. Любое копирование запрещено и преследуется по закону!<br />";
                var pagelink = "<br />Запрещается копирование или свободное изложение текста, размещенного на сайте используя замену слов, но без изменения смыслового содержания. Все материалы сайта, включая фотоматериалы и дизайн, защищены российским и международным законодательством об авторских и смежных правах.";
                var copytext = pre + selection + pagelink;
                var newdiv = document.createElement('div');
                newdiv.style.position = 'absolute';
                newdiv.style.left = '-99999px';
                body_element.appendChild(newdiv);
                newdiv.innerHTML = copytext;
                selection.selectAllChildren(newdiv);
                window.setTimeout(function () {
                    body_element.removeChild(newdiv);
                }, 0);
        });
        
        jQuery(".youtube-video-link").click(function(e){
              e.preventDefault();
              var imageHeight = jQuery(this).next(".image-instead-swf").height();
              jQuery(this).parents('.custom-movie-container').height(imageHeight);
              var videoId = jQuery(this).attr('href');
              var elemId = jQuery(this).parent().attr("id");
              var movieContainerId = jQuery(this).parent().attr('id');
                      jQuery(this).parent().html('');
              var movieIframe = '<iframe width="263" height="192" src="//rutube.ru/play/embed/'+videoId+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>';
              jQuery("#"+movieContainerId).html(movieIframe);
          });
});