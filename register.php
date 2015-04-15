<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="register_finish.php">
請輸入正確電子郵件視為帳號：<br><input type="text" name="id" /> <br><br>
密碼：<input type="password" name="pw" /> <br>
再一次輸入密碼：<input type="password" name="pw2" /> <br>
手機號碼:<input type="text" name="phone" /> <br>
驗證碼：(點擊圖片可刷新)<br><input name="imgCode" type="text"><br>
<img width="160" height="80" onclick="this.src='image.php?rand='+Math.random()" src="image.php" title="點擊更換驗證碼" /><br>
<input type="submit" name="button" value="確定" />
</form>
<br>
<br>
<a href="http://polochen.com/tim/index.php">重新登入</a><br>