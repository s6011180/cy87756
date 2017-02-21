<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/ichilov/css/fonts.css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88479306-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59123707-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter28140006 = new Ya.Metrika({
                    id:28140006,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/28140006" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <div class="head_block">
    <div class="first_line">
      <div class="cont">
      <p>Телефон в тель-авиве:   <span><a href="tel:+972 73 7690429">+972 73 7690429</a></span></p>
      <p>Телефон в москве:   <span><a href="tel:+7 499 350 1227">+7 499 350 1227</a></span></p>
      </div>
    </div>
    <header id="masthead" class="site-header" role="banner">
      <div class="cont"><div class="one_col">
        <a href="/"><img src="/wp-content/themes/ichilov/images/newlogo.png"></a>
      </div>   
      <div class="two_col">
       <p class="title"> <a href="/">Больница <span>ихилов</a></span></p>
        <p class="podtext">Напишите врачу ихилов:</p>
        <p class="mail_e"><a href="mailto:doctor@ichilov-international.com">doctor@ichilov-international.com</a></p>
        <a  class="call" id="calll">Заказать звонок из клиники</a>
      </div>
      </div>
    </header>
    <div class="second_line">
      <div class="cont">
      <div class="bluemenu">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="menu-title">'.get_option('tp_menu_title').'</li>%3$s</ul>' ) ); ?>
      </div></div>
    </div>  
  </div>


	<div id="main" class="wrapper">