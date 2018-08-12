<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<? if(wpmd_is_phone()) : ?>
		<meta name="viewport" content="width=640px">
	<? else : ?>
		<meta name="viewport" content="width=device-width">
	<? endif; ?>
	<?php wp_head(); ?>
  <script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114411873-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-114411873-1');
  </script>
  <script type="text/javascript">
    var _alloka = {
      objects: {
        '3e8e3b3f1be94840': {
          block_class: 'phone_alloka',
          jivosite: false,
          email: false
        }
      },
      trackable_source_types:  ["type_in", "referrer", "utm"],
      last_source: false,
      use_geo: true
    };
  </script>
  <script src="https://analytics.alloka.ru/v4/alloka.js" type="text/javascript"></script>
</head>
<body <?php body_class(); ?>>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
      (function (d, w, c) {
          (w[c] = w[c] || []).push(function() {
              try {
                  w.yaCounter47765593 = new Ya.Metrika({
                      id:47765593,
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
  <noscript><div><img src="https://mc.yandex.ru/watch/47765593" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->

<? 
if(is_home() || is_front_page() || is_404()){
	$class_menu = 'absolute';
} else{
	$class_menu = null;
} ?>
<header class="sect head <?=$class_menu;?>">
  <div class="wrapper">
    <div class="content">
      <div class="head_left">
		    <a href="<?=site_url();?>" target="_self">
          <img class="logotype" src="<?=get_template_directory_uri();?>/img/svg/new/logo.svg" alt=""/>  
        </a>
	    </div>
      <div class="head_right">
        <div class="head_contacts">
          <a class="phone_alloka" href="tel:+73472250245">+7 347 225-02-45</a>
          <p class="mb_none">поможем в любое время суток</p>
          <p class="link_mail_tablet"><a class="link_mail" href="mailto:info@advokatk1.ru">info@advokatk1.ru</a></p>
        </div>
        <div class="head_menu">
          <div class="menu_icon mb_block" id="menu">
            <span></span><span></span><span></span>
          </div>
          <nav class="menu">
          	<ul>
          	  <?
		        wp_nav_menu( array(
		            'items_wrap'     => '%3$s',
		            'theme_location' => 'menu-1',
		            'menu_id'        => 'primary-menu',
		            'container'      => '',
		            'container_class' => '',
		        ) );
		      ?>
		    </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
