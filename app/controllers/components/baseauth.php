<?php


App::import('Core', array('Router', 'Baseauth'), false);

class BaseauthComponent extends Object {

	var $allow;
	var $components = array('Session', 'RequestHandler');

	function mastgoon(){
		$this->Session->write('auth',0);
		die('Вышли');
	}
	
	function base()
	{
		echo '
<html>
	<head>
		<link rel="stylesheet" href="./css/style2.css" type="text/css" media="screen" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>Admin</title>
	</head>
	<body>
		<div id="wrap2" align="center" style="margin-top:200px">
			<div align="center">
				<form name="login" method="post" action="">
				<table width="235" height="62" border="0" bgcolor="#FFFFFF" class="formstyle">
					<tr>
						<td width="73">Username:</td>
						<td width="146"> 
							<label>
								<input name="login" type="text" class="formstyle" id="txtUser">
							</label>
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input name="pass" type="password" class="formstyle" id="txtPass"></td>
					</tr>
				</table>
				<p>&nbsp;</p>
				<table width="234" class="formstyle">
					<tr>
						<td width="109">
							<label>
								<div align="center">
									<input name="btnLogin" type="submit" class="formstyle" id="btnLogin" value="Login">
								</div>
							</label>
						</td>
					</tr>
				</table>
				</form>
				<p><br/></p>
			</div>
		</div>
	</body>
</html>';
		exit;
	}

	function chek($params){
		if(@$params['requested']=='1')return;
		$auth = intval($this->Session->read('auth'));
		if($auth==1)
			return;
		else{
			if(!empty($_POST)){
				if(md5($_POST['pass'])==adminpass AND $_POST['login']==adminlogin){
					$this->Session->write('auth',1);
					header("Location:?");
				}
			}

		}
		$this->base();
	}
	
	function startup(&$controller) {
		if(!in_array($controller->params['action'], $this->allow)){
			$this->chek($controller->params);
		}
	}
	
}
