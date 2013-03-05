<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>EasyCMS - Administracja</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<style type="text/css">
@import url(../css/admin_login.css);
</style>
<script language="javascript" type="text/javascript">
	function setFocus() {
	    document.loginForm.elements[0].select();
		document.loginForm.elements[0].focus();
	}
</script>
<link rel="shortcut icon" href="../src/favicon.ico"></head><body onload="setFocus();">
<div id="wrapper">
	<div id="header">
			<div id="joomla"><img src="../img/header-logo.jpg" alt="Joomla! Logo" width="230" height="42"></div>
	</div>
</div>
<div id="messsage">&nbsp;<?=$message?>&nbsp;</div>
<div id="ctr" align="center">
	<div class="login">
		<div class="login-form">
		  <img src="../img/login.gif" alt="Login" width="140" height="33" />
		  <form action="" method="post" name="loginForm" id="loginForm">
			<div class="form-block">
				<div class="inputlabel">Użytkownik</div>
				<div><input name="user[login]" class="inputbox" size="15" type="text"></div>
				<div class="inputlabel">Hasło</div>
				<div>
				  <input name="user[password]" class="inputbox" size="15" type="password" />
				</div>
				<div align="left"><input name="submit" class="button" value="Zaloguj" type="submit"></div>
			</div>
		  </form>
	  </div>
		<div class="login-text">
			<div class="ctr"><img src="../img/security.png" alt="security" height="64" width="64"></div>
			<p>Witamy w EasyCMS!</p>
			<p>Aby zalogować się do konsoli administracyjnej wprowadź użytkownika oraz hasło. </p>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div id="break"></div>
<noscript>
Uwag! Obsługa skryptów Javascript musi być włączona. W przypadku problemów skontaktuj się z administratorem
</noscript>
<div class="footer" align="center">
	<div align="center">
		<a href="http://www.sadkosoft.com.pl/produkty/easycms">EasyCMS </a>1.00 by <a href="http://www.sadkosoft.com.pl/" target="_blank">Sadkosoft</a>	</div>
</div>
</body></html>