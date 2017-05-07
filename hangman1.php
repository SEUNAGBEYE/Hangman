
<?php
	session_start();
	// function load_words()
	$word_file = 'words.txt';
	
	$read_words = file_get_contents('words.txt');
	$words_list = explode(' ',$read_words);

	$letters_available = "a b c d e f g h i j k l m n o p q r s t u v w x y z";
	echo "<h1>$letters_available</h1>","<br>";
	
	$word = choose_word($words_list);

	$letters_available1 = explode(' ', $letters_available);

	$word_lenght = strlen($_SESSION['word']);
	$max_attempt = $word_lenght +1;
	$guessed_letters = array();
	if (isset($_POST['submit'])) {
		$guess = $_POST['letter'];
	}
	
	if (!isset($_SESSION['word'])){
		$_SESSION['word'] = $word;
	}

	if (isset($_POST['submit'])) {
		$guess = $_POST['letter'];
	}

	// $guess = $_POST['letter'];
	echo "Am thinking of a word, lenght of ".$word_lenght;
	echo "<br>";
	echo "Maximum attempt is :",$max_attempt,'<br>';
	
function choose_word($words_list)
{
	$total_words = count($words_list);
	$random_keys=$words_list[mt_rand(0, ($total_words+1))];
	return $random_keys;

}
	

function del_letter($guess, $letters_available1){
	if(in_array($guess, $letters_available)){
		$letters_remaining = str_replace($guess, '_', $letters_available);
		return $letters_remaining;
	}
}

function game_progress($guess, $word){
	$guessed_display = array();

	foreach ($word as $key => $value) {
		if(in_array($value, $guessed_display)){
			array_push($guessed_display, $value);
		}

		else{
			array_push($guessed_display, '_');
		}
	}
	return $guessed_display;
}

function check_guess($guess, $word,$word_lenght,$max_attempt){
	$wrong_guesses = 0;
	$correct_guesses = 0;
	// $letters_available = "a b c d e f g h i j k l m n o p q r s t u v w x y z";
	// echo "<h1>$letters_available</h1>","<br>";
	
	// // $word = choose_word($words_list);

	$letters_available1 = explode(' ', $letters_available);

	// $word_lenght = strlen($_SESSION['word']);
	// $max_attempt = $word_lenght +1;
	$guessed_letters = array();

	while ($max_attempt > 1){
		if(in_array($guess, $guessed_letters)){
			 print_r($guess, "Is already guessed");
		}
		else{
			array_push($guessed_letters, $guess);
			if (in_array($guess, $word)) {
				echo "Good guess made ", $guess,'Appeared ',substr_count($word, $guess), 'times';
				$letters_available = del_letter($guess, $letters_available);
				echo "Progress :", $game_progress($guessed_letters, $word);
				echo "<br>";
				echo "Available letters are: ", $letters_available;
				$correct_guesses+=substr_count($word, $guess);
				if (correct_guesses==$word_lenght) {
					echo "Mavelous Play!!!! The Word is ", $word;
				}
			}
			else{
				echo "Sorry!!! wrong guess made";
				$max_attempt-= 1;
				echo "Progress :", game_progress($guessed_letters, $word);
				echo "Available letters are: ", $letters_available;
			}
			
		}
	}
	if ($max_attempt < 1) {
		echo "Game Over!!!!";
	echo "The word is :", $word;
	}
	
}

	// check_guess($words_list);
	check_guess($guess, $word);

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
		<input type="submit" name="submit" value="SUBMIT GUESS">
	</form>
</body>
</html>