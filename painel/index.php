<?php
if($_SERVER["REMOTE_ADDR"] == "::1"){
	header("Location: http://localhost/quiz-v2/index.php/painel");
}
else{
	header("Location: https://quiz-v2.profdavid.com.br/index.php/painel");
}

exit;
?>