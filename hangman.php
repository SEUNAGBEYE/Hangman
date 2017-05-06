
<?php
	session_start();
	// function load_words()
	$word_file = 'words.txt';
	
	$read_words = file_get_contents('words.txt');
	$words_list = explode(' ',$read_words);

	
function choose_word($words_list)
{
	$total_words = count($words_list);
	$random_keys=$words_list[mt_rand(0, ($total_words+1))];
	return $random_keys;

}

	$alphabelt = "a b c d e f g h i j k l m n o p q r s t u v w x y z";
	echo "<h1>$alphabelt</h1>","<br>";
	
	$word = choose_word($words_list);
	
	if (!isset($_SESSION['word'])){
		$_SESSION['word'] = $word;
	}

	
	$word_lenght = strlen($_SESSION['word']);
	$max_attempt = $word_lenght +1;
	echo "Am thinking of a word, lenght of ".$word_lenght;
	echo "<br>";
	echo "Maximum attempt is :",$max_attempt;


	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hangman</title>
</head>
<body>
	<form action="hangman.php" method="post">	<br>
		<label>Enter Letter</label>
		<input type="text" name="letter" maxlength="1">
		<button>Sumbit Guess</button>
	</form>
</body>
</html>