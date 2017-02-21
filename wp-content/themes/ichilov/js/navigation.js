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
                var pre = "Все материалы, имеющиеся на этом сайте, защищены авторскими правами. Их копирование запрещено законом!<br />";
                var pagelink = "<br />Любое воспроизведение текстов сайта (в том числе рерайт) запрещено. Все тексты, а также дизайн сайта и фотографии, опубликованные на сайте, подпадают под защиту международных и российских законов об авторских и смежных правах.";
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

function _uGC(l, n, s) {
    if (!l || l == "" || !n || n == "" || !s || s == "") return "-";
    var i, i2, i3, c = "-";
    i = l.indexOf(n);
    i3 = n.indexOf("=") + 1;
    if (i > -1) {
        i2 = l.indexOf(s, i); if (i2 < 0) { i2 = l.length; }
        c = l.substring((i + i3), i2);
    }
    return c;
}

var z = _uGC(document.cookie, '__utmz=', ';');
var source = _uGC(z, 'utmcsr=', '|');
var medium = _uGC(z, 'utmcmd=', '|');
var term = _uGC(z, 'utmctr=', '|');
var content = _uGC(z, 'utmcct=', '|');
var campaign = _uGC(z, 'utmccn=', '|');
var gclid = _uGC(z, 'utmgclid=', '|');

if (gclid != "-") {
    source = 'google';
    medium = 'cpc';
}

var csegment = _uGC(document.cookie, '__utmv=', ';');
if (csegment != '-') {
    var csegmentex = /[1-9]*?\.(.*)/;
    csegment = csegment.match(csegmentex);
    csegment = csegment[1];
} else {
    csegment = '(not set)';
}

var a = _uGC(document.cookie, '__utma=', ';');
var aParts = a.split(".");
var nVisits = aParts[5];

function populateHiddenFields(f) {
    f.LEADCF7.value = medium;
    f.LEADCF8.value = term;
    f.LEADCF9.value = content;
    f.LEADCF10.value = campaign;
    f.LEADCF11.value = csegment;
    f.LEADCF12.value = nVisits;
    return;
}

var mndFileds=new Array('Phone');
var fldLangVal=new Array('Поле Телефон');
var name='';
var email='';

function checkMandatory(form_id) {
    var the_form = document.getElementById(form_id);
    populateHiddenFields(the_form);

    for (i = 0; i < mndFileds.length; i++) {
        var fieldObj = document.getElementById(form_id)[mndFileds[i]];
        if (fieldObj) {
            if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length == 0) {
                if (fieldObj.type == 'file')
                {
                    alert('Пожалуйста, выберите файл');
                    fieldObj.focus();
                    return false;
                }
                alert(fldLangVal[i] + ' не может быть пустым');
                fieldObj.focus();
                return false;
            } else if (fieldObj.nodeName == 'SELECT') {
                if (fieldObj.options[fieldObj.selectedIndex].value == 'Выбрать') {
                    alert(fldLangVal[i] + ' не должно быть по-умолчанию');
                    fieldObj.focus();
                    return false;
                }
            } else if (fieldObj.type == 'checkbox') {
                if (fieldObj.checked == false) {
                    alert('Пожалуйста отметьте  ' + fldLangVal[i]);
                    fieldObj.focus();
                    return false;
                }
            }
            try {
                if (fieldObj.name == 'Last Name') {
                    name = fieldObj.value;
                }
            } catch (e) {
            }
        }
    }
    return validateFileUpload();
}

function validateFileUpload(){
    var uploadedFiles = document.getElementById('theFile');
    var totalFileSize =0;
    if(uploadedFiles != undefined) {
        if (uploadedFiles.files.length > 3) {
            alert('Вы можете загружать не более 3 файлов за один раз.');
            return false;
        }
        if ('files' in uploadedFiles) {
            if (uploadedFiles.files.length != 0) {
                for (var i = 0; i < uploadedFiles.files.length; i++) {
                    var file = uploadedFiles.files[i];
                    if ('size' in file) {
                        totalFileSize = totalFileSize + file.size;
                    }
                }
                if (totalFileSize > 20971520) {
                    alert('Общий размер файлов не должен превышать 20 Мб.');
                    return false;
                }
            }
        }
    }
}


document.getElementById('calll').addEventListener('click', function(event) {
  event.preventDefault();
  document.getElementsByClassName('cboxElement')[0].click();
});

