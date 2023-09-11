<?php if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== TRUE) die();?><?php
  if(isset($_REQUEST['id'])){
  	if(strpos($_REQUEST['id'], '.')!==false){
  		$URL = str_replace('.','',$_SERVER['REQUEST_URI']);
  		Localredirect($URL, false, '301 Moved permanently');
  	}
  }

  use Bitrix\Main\Page\Asset,
      Bitrix\Main\Application,
      Bitrix\Main\Localization\Loc,
      Bitrix\Main\Type\ParameterDictionary;

  global $USER, $APPLICATION;

  CJSCore::Init(array("fx"));
  CJSCore::Init(array('ajax'));

  $isCompany = defined('IS_COMPANY') && IS_COMPANY === true ? true : false;
  $isJudicial = defined('IS_JUDICIAL') && IS_JUDICIAL === true ? true : false;

  define('ASSETS_PATH', SITE_TEMPLATE_PATH . '/public');
  define('INCLUDE_PATH', SITE_TEMPLATE_PATH . '/include');
  define('IS_MAIN_PAGE', $APPLICATION->GetCurPage(FALSE) === SITE_DIR ? TRUE : FALSE);
  define('CUR_PAGE', $APPLICATION->GetCurPage(FALSE));
  define('LOGIN_URL', $isCompany ? '':'https://person.nbki.ru/login');
  define('CUSTOM_HEADER', !empty($APPLICATION->GetDirProperty("custom_header")) ? : false);
  define('CUSTOM_FOOTER', !empty($APPLICATION->GetDirProperty("custom_footer")) ? : false);
  $wrapper = $APPLICATION->GetDirProperty("wrapper");
  $sTitle = $APPLICATION->GetDirProperty("sub_title");
  $pageType = $APPLICATION->GetDirProperty("page_type");
  $isContent = $APPLICATION->GetDirProperty("hide_content_block") == 'Y'? TRUE: FALSE;
  if($isContent)
      define('HIDE_CONTENT_BLOCK', 'Y');
  //canonical AMP
  $request = Application::getInstance()->getContext()->getRequest();
  $requestUri = $request->getRequestUri();
  $ampCanonical =  strpos($APPLICATION->GetCurPage(false),"poleznaya-informatsiya/") !== false ? '<link rel="amphtml" href="https://'.$_SERVER['HTTP_HOST'].'/amp'.$requestUri.'">' : '';

  if(IS_MAIN_PAGE === TRUE)
      $wrapper = 'main';

  define('WRAPPER', !empty($wrapper) ? $wrapper : 'default');

  $ASSETS = Asset::getInstance();
  $ASSETS->addCss(ASSETS_PATH . '/css/bootstrap.min.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/bootstrap-theme.min.css');
  $ASSETS->addCss(ASSETS_PATH . '/libs/font-awesome-4.7.0/css/font-awesome.min.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/slick.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/slick-theme.css');
  $ASSETS->addCss(ASSETS_PATH . '/libs/lightbox/css/lightbox.min.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/animation.css');
  $ASSETS->addCss(ASSETS_PATH . '/fonts/fonts.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/main.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/custom.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/restyle.css');
  $ASSETS->addCss(ASSETS_PATH . '/css/corp.css');

  $ASSETS->addJs(ASSETS_PATH . '/js/jquery-1.9.1.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/jquery-ui.min.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/bootstrap.min.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/slick.min.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/maskedinput.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/wow.min.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/main.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/old.main.js');
  $ASSETS->addJs(ASSETS_PATH . '/js/ingevents.4.0.9b.js');

  //$ASSETS->addJs(ASSETS_PATH . '/js/ingevents.4.0.8.js');
  //$ASSETS->addJs(ASSETS_PATH . '/js/scripts_info.js');

  $ASSETS->addString('<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->');

$mainPageUrl = '/';
//костыли
$curUrl = strtok($_SERVER["REQUEST_URI"],'?');
if (in_array(
        $curUrl,
        [
            '/serviceszaem/svedeniya/yuridicheskim-litsam/',
            '/serviceszaem/spor/juridical_person/',
            '/serviceszaem/code/juridical_person/',
            '/serviceszaem/historylist/juridical_person/'
        ]
)) {
    $mainPageUrl = '/judicial/';
}
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>">
  <head>
    <? if (1==2):?>
    <!-- Anti-flicker snippet (recommended)  -->
    <style>.async-hide { opacity: 0 !important} </style>
    <script data-skip-moving="true">(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
      h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
      (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
      })(window,document.documentElement,'async-hide','dataLayer',4000,
      {'OPT-NZKJPWS':true});
    </script>
    <script data-skip-moving="true" src="https://www.googleoptimize.com/optimize.js?id=OPT-NZKJPWS"></script>
    ?>
    <? endif; ?>
    <? if(SetNoindexNofollow()): ?>
    <?/*<meta name="robots" content="noindex, nofollow" />*/?>
    <? $APPLICATION->SetPageProperty("robots", "noindex, nofollow"); ?>
    <!-- noindex  nofollow -->
    <? endif; ?>
    <?php
      if (CUR_PAGE === '/press/pressrelease/' && count($_GET) > 0) {
          echo '<meta name="robots" content="noindex, nofollow" />';
      }
      if (CUR_PAGE === '/press/pressabout/' && count($_GET) > 0) {
          echo '<meta name="robots" content="noindex, nofollow" />';
      }
      ?>
    <?php
      if($_SERVER['REQUEST_URI'] == '/'){
      ?>
    <meta name="cmsmagazine" content="15cc099f999c16f78c2bbc44c4fc6690" />
    <?php
      }
      ?>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= LANG_CHARSET; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="03f288b6d60c8630" />
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/local/templates/nbkiv2/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/local/templates/nbkiv2/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/local/templates/nbkiv2/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/local/templates/nbkiv2/img/apple-touch-icon-152x152.png">
      <link rel="shortcut icon" type="image/x-icon" href="/apple-touch-icon-76x76.ico">
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowMeta("keywords");?>
    <?$APPLICATION->ShowMeta("description");?>
    <?$APPLICATION->ShowMeta("robots");?>
    <?=$ampCanonical?>
    <?
      if(strpos($_SERVER['REQUEST_URI'], '?utm_') !== false) {
      	$url = 'http';
      	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
      		$url .= "s";
      	}
      	$url .= "://" . $_SERVER["HTTP_HOST"] . strtok($_SERVER["REQUEST_URI"],'?');
      //			echo '<link rel="canonical" href="'.$url.'">';
      	//echo '<meta name="robots" content="index,follow">';
      }

      ?>
    <link rel="canonical" href="https://nbki.ru<?=($APPLICATION->GetCurDir() != '/'?$APPLICATION->GetCurDir():'')?>" />
<!--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <?$APPLICATION->ShowCSS();?>
    <?$APPLICATION->ShowHeadStrings();?>
    <?$APPLICATION->ShowHeadScripts();?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="3eLZpq2rB7exHwIYdmew2kn9qNQPjqWOfde47H9rGbU" />
    <? if(false && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') == false &&  strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0') == false):?>
    <script async charset="UTF-8" src="https://nbki.ramfy.ru/push/wj160ghlmw964.js"></script>
    <? endif; ?>
    <script>
      window.dataLayer = window.dataLayer || [];
    </script>
    <meta name="facebook-domain-verification" content="0guzch520p76gmd2pcmqbznka14hz7" />
    <script type="text/javascript" >
      (function (m, e, t, r, i, k, a) {
           m[i] = m[i] || function () {
               (m[i].a = m[i].a || []).push(arguments)
           };
           m[i].l = 1 * new Date();
           k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
       })
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
       ym(9726127, "init", {
           clickmap: true,
           trackLinks: true,
           accurateTrackBounce: true,
           webvisor: true,
           ecommerce: "dataLayer"
       });
    </script>
    <!-- Rating Mail.ru counter --><script type="text/javascript">var _tmr = window._tmr || (window._tmr = []);_tmr.push({id: "3251463", type: "pageView", start: (new Date()).getTime(),pid: "USER_ID"});(function (d, w, id) {  if (d.getElementById(id)) return;  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;  ts.src = "https://top-fwz1.mail.ru/js/code.js";  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }})(document, window, "topmailru-code");</script><noscript><div><img src="https://top-fwz1.mail.ru/counter?id=3251463;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript><!-- //RatingMail.rucounter -->
    <? /*
      <script type="text/javascript">
          document.addEventListener('DOMContentLoaded', () => {
              setTimeout(function () {
                  !function(f,b,e,v,n,t,s)
                  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                      n.queue=[];t=b.createElement(e);t.async=!0;
                      t.src=v;s=b.getElementsByTagName(e)[0];
                      s.parentNode.insertBefore(t,s)}(window, document,'script',
                      'https://connect.facebook.net/en_US/fbevents.js');
                  fbq('init', '251650636951155');
                  fbq('track', 'PageView');
                  function gtag(){dataLayer.push(arguments);}
                  gtag('js', new Date());
                  gtag('config', 'UA-23246610-1');
                  (function (m, e, t, r, i, k, a) {
                      m[i] = m[i] || function () {
                          (m[i].a = m[i].a || []).push(arguments)
                      };
                      m[i].l = 1 * new Date();
                      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
                  })
                  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
                  ym(9726127, "init", {
                      clickmap: true,
                      trackLinks: true,
                      accurateTrackBounce: true,
                      webvisor: true,
                      ecommerce: "dataLayer"
                  });
              }, 1000); // время указано в мс = 0,001 секунды, изменить по вкусу
          });
      </script>

      */?>

<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>"/>
<meta property="og:description" content="<?$APPLICATION->ShowProperty('description');?>"/>
<meta property="og:image" content="<?="https://".$_SERVER['HTTP_HOST']."/local/templates/nbkiv3/public/img/nbki-logo.svg"?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content= "<?="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />


  </head>
	<? /* <body class="no-scroll"> */ ?>
 <body>
    <?if(1==2):?>
    <div style="display:none;">
      <script type="text/javascript">
        (function(w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter9726127 = new Ya.Metrika({id:9726127, enableAll: true, webvisor:true});
                }
                catch(e) { }
            });
        })(window, "yandex_metrika_callbacks");
      </script>
    </div>
    <script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer></script>
    <noscript>
      <div><img src="//mc.yandex.ru/watch/9726127" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <?endif;?>
    <!-- /Yandex.Metrika counter -->
    <!--
      Start of Floodlight Tag: Please do not remove
      Activity name of this tag: nbki.ru_tracking
      URL of the webpage where the tag is expected to be placed:
      This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
      Creation Date: 12/24/2019
      -->
    <script type="text/javascript">
      var axel = Math.random() + "";
      var a = axel * 10000000000000;
      document.write('<iframe src="https://9834311.fls.doubleclick.net/activityi;src=9834311;type=invmedia;cat=nbkir0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=' + a + '?" width="1" height="1"  style="display:none"></iframe>');
    </script>
    <noscript>
      <iframe src="https://9834311.fls.doubleclick.net/activityi;src=9834311;type=invmedia;cat=nbkir0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1"  style="display:none"></iframe>
    </noscript>
    <!-- End of Floodlight Tag: Please do not remove -->
    <?if($USER->IsAdmin()):?>
	  <div id="panel"><? $APPLICATION->ShowPanel()?></div>
    <?endif;?>
    <? /* if (CUSTOM_HEADER && file_exists($_SERVER['DOCUMENT_ROOT']. SITE_TEMPLATE_PATH . '/wrappers/'.WRAPPER.'/custom.header.php')):?>
    <?require_once 'wrappers/'.WRAPPER.'/custom.header.php';?>
    <? else: */ ?>
    <header id="header" class="header clearfix">
      <? /* <a name="top"></a> */?>
      <? /*<div class="header__top clearfix">
        <div class="container">
            <div class="headertop">
                <div class="headertop__items">
                    <div class="headertop__item">
                        <div class="headertop__menu">
                            <div class="mainmenubtn">
                                <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0.5" y1="0.5" x2="15.5" y2="0.5" stroke="white" stroke-linecap="round"/>
                                    <line x1="0.5" y1="4.5" x2="15.5" y2="4.5" stroke="white" stroke-linecap="round"/>
                                    <line x1="0.5" y1="8.5" x2="15.5" y2="8.5" stroke="white" stroke-linecap="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="headertop__links">
                            <div class="headertop__link <?=($isCompany || $isJudicial)?'notcurrent':'current'?>">
      <a href="/" <?=($isCompany || $isJudicial)?'':'class="active current"'?>>Физические лица</a>
      </div>
      <div class="headertop__link <?=$isJudicial?'current':'notcurrent'?>">
        <a href="/judicial/" <?=$isJudicial?'class="active current"':''?>>Юридические лица</a>
      </div>
      <div class="headertop__link <?=$isCompany?'current':'notcurrent'?>">
        <a href="/servicescredit/" <?=$isCompany?'class="active current"':''?>>Корпоративные клиенты</a>
      </div>
      </div>
      </div>
      <div class="headertop__item">
        <div class="headertop__langs">
          <div class="langs">
            <div class="langs__current">
              <div class="langs__text">РУС</div>
              <div class="langs__icon">
                <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.73624 1L5.36811 5.3682L1 1.00009" stroke="#7B7794" stroke-linecap="round"/>
                </svg>
              </div>
            </div>
            <div class="langs__list">
              <div class="langs__lang"><a href="/en/">ENG</a></div>
            </div>
          </div>
        </div>
        <div class="headertop__login">
          <a href="https://person.nbki.ru/">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12.5" cy="6.5" r="3.5" stroke="white" stroke-width="2"/>
              <path d="M20 20C20 16.134 16.6421 13 12.5 13C8.35786 13 5 16.134 5 20" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </a>
        </div>
      </div>
      </div>
      </div>
      <div class="mainmenu">
        <div class="mainmenu__content">
          <div class="mainmenu__cols">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => INCLUDE_PATH . "/header/all_links.php"
              )
              );?>
          </div>
        </div>
      </div>
      <div class="mobilemenu">
        <span class="mobilemenuclose">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 15L15 1" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"></path>
            <path d="M1 1L15 15" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"></path>
          </svg>
        </span>
        <div class="mobilemenu__wrapper">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => INCLUDE_PATH . "/header/mobile_links.php"
            )
            );?>
        </div>
      </div>
      </div>
      </div> */?>
      <div class="header__main clearfix">
        <div class="container">
          <div class="headermain">
            <div class="headermain__items">
              <div class="headermain__item">
                <div class="headerrow">
                  <div class="burgermenu burgermenu_desktop">
                    <button class="headermain__menu js-menu js-menu_desktop">
                    <img src="<?=SITE_TEMPLATE_PATH?>/public/img/burger.svg" alt="" class="burgermenu--open ">
                    <img src="<?=SITE_TEMPLATE_PATH?>/public/img/Union.svg" alt="" class="burgermenu--close ">
                    </button>
                  </div>
                  <div class="headerleft">
                    <div class="logo">
                      <? if (!IS_MAIN_PAGE):?>
                      <a href="<?=$mainPageUrl?>">
                      <? endif; ?>
                      <img src="<?=SITE_TEMPLATE_PATH?>/public/img/nbki-logo.svg" alt="" class="nbki-logo_desktop">
                      <img src="<?=SITE_TEMPLATE_PATH?>/public/img/nbki-logo2.svg" alt="" class="nbki-logo_mobile">
                      <? if (!IS_MAIN_PAGE):?>
                      </a>
                      <? endif; ?>
                    </div>
                  </div>
                  <div class="headerchange">
                    <div class="headertop__links">
                      <div class="headertop__link <?=($isCompany || $isJudicial)?'notcurrent':'current'?>">
                        <a href="#" <?=($isCompany || $isJudicial)?'':'class="active current"'?>>Физические лица</a>
                      </div>
                      <div class="headertop__link <?=$isJudicial?'current':'notcurrent'?>">
                        <a href="#" <?=$isJudicial?'class="active current"':''?>>Юридические лица</a>
                      </div>
                      <div class="headertop__link <?=$isCompany?'current':'notcurrent'?>">
                        <a href="#" <?=$isCompany?'class="active current"':''?>>Корпоративные клиенты</a>
                      </div>

                      <div class="headertop__dropdown">
                        <? if (!($isCompany && $isJudicial)):?>
                        <div class=" <?=($isCompany || $isJudicial)?'visible':'hidden'?>">
                          <a href="/" <?=($isCompany || $isJudicial)?'':'class="active current"'?>>Физические лица</a>
                        </div>
                        <? endif; ?>
                        <? if (!($isJudicial)):?>
                        <div class=" <?=$isJudicial?'hidden':'visible'?>">
                          <a href="/judicial/" <?=$isJudicial?'class="active current"':''?>>Юридические лица</a>
                        </div>
                        <? endif; ?>
                        <? if (!($isCompany)):?>
                        <div class=" <?=$isCompany?'hidden':'visible'?>">
                          <a href="/servicescredit/" <?=$isCompany?'class="active current"':''?>>Корпоративные клиенты</a>
                        </div>
                        <? endif; ?>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.headerrow -->
              </div>
              <div class="headermain__item headermain__item_right">
                <div class="mobilepanel">
                  <div class="headercenter__search">
                    <div class="searchbutton searchbutton_mobile">
                      <img src="<?=SITE_TEMPLATE_PATH?>/public/img/mobilesearch.svg" alt="">
                    </div>
                  </div>
                  <? if (!defined('HIDE_LOGIN') && HIDE_LOGIN !== true): ?>
                    <? if (!($isJudicial)): ?>
                  <div class="headerright">

                    <div class="lklink lklink_mobile">
                      <a href="<?= LOGIN_URL."?utm_source=fl&utm_medium=mainpage&utm_campaign=button&utm_term=lk"?>" onclick="ym('9726127','reachGoal', 'lk_click'); return true;" <?=$isCompany?'class="js-acc__link"':''?> >
                        <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="8.5" cy="4.5" r="3.5" stroke="#AEB5D1" stroke-width="2"/>
                          <path d="M16 18C16 14.134 12.6421 11 8.5 11C4.35786 11 1 14.134 1 18" stroke="#AEB5D1" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </a>
                    </div>

                  </div>
                  <? endif; ?>
                  <? endif; ?>
                  <div class="burgermenu burgermenu_mobile">
                  <button class="headermain__menu js-menu js-menu_mobile">
                  <svg class="burgermenu--open " width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 2H17" stroke="#AEB5D1" stroke-width="2" stroke-linecap="round"/>
                  <path d="M1 8H17" stroke="#AEB5D1" stroke-width="2" stroke-linecap="round"/>
                  <path d="M1 14H17" stroke="#AEB5D1" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  <img src="<?=SITE_TEMPLATE_PATH?>/public/img/hamburger2.svg" alt="" class="burgermenu--close ">
                  </button>
                  </div>
                </div>
                <div class="headercenter">
                <div class="headercenter__menu">
                <div class="headermenu">
                <? if ($isCompany):?>
                    <?// Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "header",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
                        array(
                            // region Основные параметры
                            "ROOT_MENU_TYPE"         =>  "menu1",  // Тип меню для первого уровня : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                            // endregion
                            // region Настройки кеширования
                            "MENU_CACHE_TYPE"        =>  "A",     // Тип кеширования : array ( 'A' => 'Авто', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
                            "MENU_CACHE_TIME"        =>  "36000",  // Время кеширования (сек.)
                            "MENU_CACHE_USE_GROUPS"  =>  "N",     // Учитывать права доступа
                            "MENU_CACHE_GET_VARS"    =>  "",      // Значимые переменные запроса
                            // endregion
                            // region Дополнительные настройки
                            "MAX_LEVEL"              =>  "1",     // Уровень вложенности меню : array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', )
                            "CHILD_MENU_TYPE"        =>  "left",  // Тип меню для остальных уровней : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                            "USE_EXT"                =>  "N",     // Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "DELAY"                  =>  "N",     // Откладывать выполнение шаблона меню
                            "ALLOW_MULTI_SELECT"     =>  "N",     // Разрешить несколько активных пунктов одновременно
                            // endregion
                        )
                    );?>
                <? else: ?>
                    <?// Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                  $APPLICATION->IncludeComponent(
                      "bitrix:menu",
                      "top",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
                      array(
                          // region Основные параметры
                          "ROOT_MENU_TYPE"         =>  "top",  // Тип меню для первого уровня : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                          // endregion
                          // region Настройки кеширования
                          "MENU_CACHE_TYPE"        =>  "N",     // Тип кеширования : array ( 'A' => 'Авто', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
                          "MENU_CACHE_TIME"        =>  "3600",  // Время кеширования (сек.)
                          "MENU_CACHE_USE_GROUPS"  =>  "Y",     // Учитывать права доступа
                          "MENU_CACHE_GET_VARS"    =>  "",      // Значимые переменные запроса
                          // endregion
                          // region Дополнительные настройки
                          "MAX_LEVEL"              =>  "1",     // Уровень вложенности меню : array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', )
                          "CHILD_MENU_TYPE"        =>  "left",  // Тип меню для остальных уровней : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                          "USE_EXT"                =>  "N",     // Подключать файлы с именами вида .тип_меню.menu_ext.php
                          "DELAY"                  =>  "N",     // Откладывать выполнение шаблона меню
                          "ALLOW_MULTI_SELECT"     =>  "N",     // Разрешить несколько активных пунктов одновременно
                          // endregion
                      )
                  );?>
                <? endif; ?>

                </div>
                </div>

              <? if ($isCompany):?>
               <!--  <div class="headermain__button">
                    <a href="/login" class="btn_main" target="_blank">Подключиться к НБКИ</a>
                </div> -->
                <? endif; ?>

                <div class="headercenter__search">
                <div class="searchbutton searchbutton_desktop">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="7" stroke="#000"/>
                <path d="M20.2927 21.2929C20.6833 21.6834 21.3164 21.6834 21.707 21.2929C22.0975 20.9024 22.0975 20.2692 21.707 19.8787L20.2927 21.2929ZM14.207 15.2071L20.2927 21.2929L21.707 19.8787L15.6212 13.7929L14.207 15.2071Z" fill="#000"/>
                </svg>
                </div>
                </div>
                <span class="mobilemenubtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="5" y1="6" x2="19" y2="6" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"/>
                <line x1="5" y1="12" x2="19" y2="12" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"/>
                <line x1="5" y1="18" x2="19" y2="18" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"/>
                </svg>
                </span>
                </div>
                
                <? if (!defined('HIDE_LOGIN') && HIDE_LOGIN !== true): ?>
                <? /* <div class="lklink"><a href="<?= LOGIN_URL ?>" onclick="ym('9726127','reachGoal', 'lk_click'); return true;" <?=$isCompany?'class="js-acc__link"':''?> >Личный кабинет</a></div> */ ?>
                  <? if (!($isJudicial)): ?>
                    <div class="headerright">
                    <div class="lklink lklink_desktop"><a href="<?= LOGIN_URL."?utm_source=fl&utm_medium=mainpage&utm_campaign=button&utm_term=lk
                    "?>" onclick="ym('9726127','reachGoal', 'lk_click'); return true;" <?=$isCompany?'class="js-acc__link"':''?> > <span>Войти</span>  <img src="<?=SITE_TEMPLATE_PATH?>/public/img/hlogin.svg" alt=""></a></div>
                    </div>
                  <? endif; ?>
                <? endif; ?>
              
            </div>
          </div>
        </div>
        <div class="search__full"  itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="url" content="https://nbki.ru/"/>
          <form action="/search/" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
            <div class="search__items">
            <meta itemprop="target" content="https://nbki.ru/search/?q={q}"/>
              <input itemprop="query-input" class="search__input" type="text" name="q" placeholder="Что вы ищете?">
              <div class="search__buttons">
                <button class="search__submit btn_main" type="submit">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.5" cy="9.5" r="7" stroke="#fff"></circle>
                    <path d="M20.2927 21.2929C20.6833 21.6834 21.3164 21.6834 21.707 21.2929C22.0975 20.9024 22.0975 20.2692 21.707 19.8787L20.2927 21.2929ZM14.207 15.2071L20.2927 21.2929L21.707 19.8787L15.6212 13.7929L14.207 15.2071Z" fill="#fff"></path>
                  </svg>
                  <span>Найти</span>
                </button>
                <span class="search__button_close search__button_open">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 15L15 1" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"/>
                    <path d="M1 1L15 15" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
      </div>
      <div class="mainmenu">
        <div class="container">
          <div class="mainmenu__content mainmenu__content--desktop">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => INCLUDE_PATH . "/header/all_links.php"
              )
              );?>
          </div>
          <div class="mainmenu__content mainmenu__content--mobile mainmenumob">
            <? if ($isCompany):?>
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Услуги</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/servicescredit/">Подробная информация</a></li>
                    <li><a href="//person.nbki.ru" target="_blank">Стать клиентом НБКИ</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>О компании</span></div>
                <div class="accordmenu__content">
                <ul class="allmenu__lvl1">
                  <li><a href="/company/">О бюро</a></li>
                  <li><a href="/company/documents/">Документы НБКИ</a></li>
                  <li><a href="/company/rekvizit/">Реквизиты</a></li>
                </ul>
                </div>
              </div><!-- /.accordmenu -->

              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Информация</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/contacts/">Контакты</a></li>
                    <li><a href="/company/news/">Новости</a></li>
                    <li><a href="/press/pressabout/">Пресса о нас</a></li>
                    <li><a href="/faq/">Вопросы и ответы</a></li>
                    <li><a href="/poleznaya-informatsiya/">Полезная информация</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->

                <?// Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                /* $APPLICATION->IncludeComponent(
                	"bitrix:menu",
                	"header",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
                	array(
                		// region Основные параметры
                		"ROOT_MENU_TYPE"         =>  "menu1",  // Тип меню для первого уровня : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                		// endregion
                		// region Настройки кеширования
                		"MENU_CACHE_TYPE"        =>  "A",     // Тип кеширования : array ( 'A' => 'Авто', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
                		"MENU_CACHE_TIME"        =>  "36000",  // Время кеширования (сек.)
                		"MENU_CACHE_USE_GROUPS"  =>  "N",     // Учитывать права доступа
                		"MENU_CACHE_GET_VARS"    =>  "",      // Значимые переменные запроса
                		// endregion
                		// region Дополнительные настройки
                		"MAX_LEVEL"              =>  "1",     // Уровень вложенности меню : array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', )
                		"CHILD_MENU_TYPE"        =>  "left",  // Тип меню для остальных уровней : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                		"USE_EXT"                =>  "N",     // Подключать файлы с именами вида .тип_меню.menu_ext.php
                		"DELAY"                  =>  "N",     // Откладывать выполнение шаблона меню
                		"ALLOW_MULTI_SELECT"     =>  "N",     // Разрешить несколько активных пунктов одновременно
                		// endregion
                	)
                ); */?>
            <? elseif ($isJudicial): ?>
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Услуги</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/serviceszaem/pkr/">Узнать кредитный рейтинг</a></li>
                    <li><a href="/nbki-history/">Получить кредитную историю</a></li>
                    <li><a href="/serviceszaem/spor/">Оспорить кредитную историю</a> </li>
                    <li><a href="/serviceszaem/historylist/">Справка из ЦККИ</a></li>
                    <li><a href="/serviceszaem/code/">Действия с кодом субъекта</a></li>
                    <li><a href="/zashchita-ot-moshennichestva/">Защита от мошенничества</a></li>
                    <li><a href="/podpiska-na-credithistory/">Подписка на кредитную историю</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>О компании</span></div>
                <div class="accordmenu__content">
                <ul class="allmenu__lvl1">
                  <li><a href="/company/">О бюро</a></li>
                  <li><a href="/company/documents/">Документы НБКИ</a></li>
                  <li><a href="/company/rekvizit/">Реквизиты</a></li>
                </ul>
                </div>
              </div><!-- /.accordmenu -->

              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Информация</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/contacts/">Контакты</a></li>
                    <li><a href="/company/news/">Новости</a></li>
                    <li><a href="/press/pressabout/">Пресса о нас</a></li>
                    <li><a href="/faq/">Вопросы и ответы</a></li>
                    <li><a href="/poleznaya-informatsiya/">Полезная информация</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title"><a href="//story.nbki.ru" target="_blank">Истории о кредитах</a></div>
              </div><!-- /.accordmenu -->

            <? else: ?>
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Услуги</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/serviceszaem/pkr/">Узнать кредитный рейтинг</a></li>
                    <li><a href="/nbki-history/">Получить кредитную историю</a></li>
                    <li><a href="/serviceszaem/spor/">Оспорить кредитную историю</a> </li>
                    <li><a href="/serviceszaem/historylist/">Справка из ЦККИ</a></li>
                    <li><a href="/serviceszaem/code/">Действия с кодом субъекта</a></li>
                    <li><a href="/zashchita-ot-moshennichestva/">Защита от мошенничества</a></li>
                    <li><a href="/podpiska-na-credithistory/">Подписка на кредитную историю</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>О компании</span></div>
                <div class="accordmenu__content">
                <ul class="allmenu__lvl1">
                  <li><a href="/company/">О бюро</a></li>
                  <li><a href="/company/documents/">Документы НБКИ</a></li>
                  <li><a href="/company/rekvizit/">Реквизиты</a></li>
                </ul>
                </div>
              </div><!-- /.accordmenu -->

              <div class="accordmenu">
                <div class="accordmenu__title js-accord"><span>Информация</span></div>
                <div class="accordmenu__content">
                  <ul>
                    <li><a href="/contacts/">Контакты</a></li>
                    <li><a href="/company/news/">Новости</a></li>
                    <li><a href="/press/pressabout/">Пресса о нас</a></li>
                    <li><a href="/faq/">Вопросы и ответы</a></li>
                    <li><a href="/poleznaya-informatsiya/">Полезная информация</a></li>
                  </ul>
                </div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title"><a href="//story.nbki.ru" target="_blank">Истории о кредитах</a></div>
              </div><!-- /.accordmenu -->
              <div class="accordmenu">
                <div class="accordmenu__title"><a href="/application/" target="_blank">Мобильное приложение</a></div>
              </div><!-- /.accordmenu -->

                <?// Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                /* $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "header",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
                    array(
                        // region Основные параметры
                        "ROOT_MENU_TYPE"         =>  "menu2",  // Тип меню для первого уровня : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                        // endregion
                        // region Настройки кеширования
                        "MENU_CACHE_TYPE"        =>  "A",     // Тип кеширования : array ( 'A' => 'Авто', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
                        "MENU_CACHE_TIME"        =>  "36000",  // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS"  =>  "N",     // Учитывать права доступа
                        "MENU_CACHE_GET_VARS"    =>  "",      // Значимые переменные запроса
                        // endregion
                        // region Дополнительные настройки
                        "MAX_LEVEL"              =>  "1",     // Уровень вложенности меню : array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', )
                        "CHILD_MENU_TYPE"        =>  "left",  // Тип меню для остальных уровней : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                        "USE_EXT"                =>  "N",     // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY"                  =>  "N",     // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT"     =>  "N",     // Разрешить несколько активных пунктов одновременно
                        // endregion
                    )
                ); */?>
            <? endif; ?>

              <? if ($isCompany):?>
                <div class="mainmenumob__button mainmenumob__button_corp">
                    <a href="/login" class="btn_main btn_main_white" target="_blank">Подключиться к НБКИ</a>
                </div>
                <? elseif ($isJudicial): ?>
                <? else: ?>
                <div class="mainmenumob__button">
                    <a href="/login?utm_source=fl&utm_medium=mainpage&utm_campaign=button&utm_term=lk" class="btn_main btn_main_white" target="_blank">Личный кабинет</a>
                </div><!-- /.mainmenumob -->
                <? endif; ?>




              <div class="mainmenu__phones <? echo $isCompany ? 'mainmenu__phones_corp' : '' ?>">
                <div class="phone"><span>Наш телефон в Москве:</span><a href="tel:84952217837">8 (495) 221-78-37</a></div>
                <? if (!($isCompany)):?>
                <div class="phone"><span>Бесплатный звонок:</span><a href="tel:88006006404">8 (800) 600-64-04</a></div>
                <? endif; ?>
                </div>
          </div>
        </div>
        <div class="mobilemenu">
          <span class="mobilemenuclose">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 15L15 1" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"></path>
              <path d="M1 1L15 15" stroke="#C2BFCC" stroke-width="2" stroke-linecap="round"></path>
            </svg>
          </span>
          <div class="mobilemenu__wrapper">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => INCLUDE_PATH . "/header/mobile_links.php"
              )
              );?>
          </div>
        </div>
        <!-- /.container -->
      </div>
    </header>
    <? /* endif; */ ?>
    <?
      if ($APPLICATION->GetCurPage() == '/poleznaya-informatsiya/' && 1==2){ //$USER->IsAdmin() &&
          require_once 'wrappers/info/header.php';
      }
      else{
          if(WRAPPER && file_exists($_SERVER['DOCUMENT_ROOT']. SITE_TEMPLATE_PATH . '/wrappers/'.WRAPPER.'/header.php'))
              require_once 'wrappers/'.WRAPPER.'/header.php';
      }
      ?>
