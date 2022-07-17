<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$to='info@599135.ru'; // получатель письма
		
	$fio = htmlspecialchars($_POST['fio']);
	$phone = htmlspecialchars($_POST['phone']);
	$message = htmlspecialchars($_POST['message']);
	$subject = "Заявка с сайта 599135.ru";
	$message = '<html><head><title>'.$subject.'</title></head><body>
			Имя: '.$fio.'<br>
			Телефон: '.$phone.'<br>
			Сообщение: '.$message.'<br>
			</body></html>';
    
	$headers="MIME-Version: 1.0\r\n"
	."Content-type: text/html; charset=UTF-8\r\n"
	."From: ".$fio."  <".$to.">\r\n"
	."Reply-To: ".$to."\r\n"
	."X-Mailer: PHP/" . phpversion();

	$recaptcha=$_POST['g-recaptcha-response'];
	if(!empty($recaptcha)){
		$google_url="https://www.google.com/recaptcha/api/siteverify";
		$secret='6LdaXvoeAAAAAIqSdYMfPtxd0_03eztBfnYQSR7g';
		$ip=$_SERVER['REMOTE_ADDR'];
		$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
		$res=getCurlData($url);
		$res= json_decode($res, true);

		if($res['success']){
			$mail = mail($to, $subject, $message,$headers);
				if($mail)
					echo 'Ваше сообщение отправлено. Мы перезвоним Вам в рабочее время';
				else 
					echo '<div class="notification_error">Что-то пошло не так, попробуйте позже.</div>';
		}
		else{
			echo 'Пожалуйста, подтвердите, что Вы не робот';
		}
	}
	else{
		echo 'Пожалуйста, подтвердите, что Вы не робот';
	}		
	
}
else echo "error";


function getCurlData($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	$curlData = curl_exec($curl);
	curl_close($curl);
	return $curlData;
}
?>