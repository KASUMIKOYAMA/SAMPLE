<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
#greet{
	color: #333333;
	font-size: 8pt;
}

#greet input{
	height: 14px;
	font-size: 12px;
}

</style>

<section id="greet">
	
	<h1>伝言板</h1>
	<p>ひとことどうぞ</p>
		
	<form method="post" action="">
		
		なまえ<input type="text" name="name"  size="5">
		ひとこと<input type="text" name="comment" size="20" title="タイトル" required>
		
		<input type="submit" name="a" value="GO">
		
	</form>
		
	<?php
		
		date_default_timezone_set('Asia/Tokyo');
		$date = date('Y/n/j D G:i:s');
		
	//postされたらファイルに書き込む
	if(isset($_POST['a'])){
		$name = '匿名';
		
		if(!empty($_POST['name'])){
			$name = htmlspecialchars($_POST['name']);
		}
		
		$comment = htmlspecialchars($_POST['comment']);
		$file = fopen('greeting.txt','w+b');
		fwrite($file,$name.'さん：'.$comment.'<br>at '.$date);
		fclose($file);
		
		//ログを残す
		$writeLog = fopen('log.txt','ab');
		fwrite($writeLog,'　■'.$date.' - '.$name .'さん：'.$comment);
		fclose($writeLog);
	}
	
	//ファイルを開いて表示する
	$fp = fopen('greeting.txt','rb');
	echo fgets($fp);
	fclose($fp);	
	
	
	?>

</section>