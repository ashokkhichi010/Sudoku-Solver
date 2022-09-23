<?php 
	for ($i=0; $i < 9; $i++) { 
	 	for ($j=0; $j < 9; $j++) { 
	 		$sudoku[$i][$j] = '';
	 	}
	 }
	 $filledItem = null;
	 include "sudokuSolver.php";
	 if(isset($_POST['submit'])){
	 	$i = 0;
 		for ($row=0; $row < 9; $row++) { 
		 	for ($col=0; $col < 9; $col++) { 
		 		$sudoku[$row][$col] = $_POST[$row.$col];
		 		if ($_POST[$row.$col] != '') {
		 			$filledItem[$i] = $row.$col;
		 			$i++;
		 		}
		 	}
		}
	 	sudokuSolver($sudoku);
	 	$sudoku = $_SESSION['sudoku'];
	 	reset($_SESSION['sudoku']);
	 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sudoku Solver</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<center>
		<form method="POST">
			<div class="container">
				<?php 
					for ($row = 0; $row < 9; $row++) { 
						echo '<div id="'.$row.'" class="row">';
						for ($col = 0; $col < 9; $col++) { 
							$backgrountColor = 'none';
							if ($row < 3 && $col < 3 || $row > 5 && $col > 5 || $row < 3 && $col > 5 || $row > 5 && $col < 3 || $row > 2 && $row < 6 && $col > 2 && $col < 6) {
								$backgrountColor = 'lightgrey';
							}
							echo '<div class="cell"><input id="'.$row.$col.'" type="text" name="'.$row.$col.'" value="'.$sudoku[$row][$col].'" style="background-color:'.$backgrountColor.'" /></div>';
							$backgrountColor = 'none';
						}
						echo '</div>';
					}
				?>
			</div>
			<input id="submit" type="submit" name="submit">
		</form>
	</center>
<script type="text/javascript">
	<?php 
		if ($filledItem != null){
			for ($i=0; $i < count($filledItem); $i++) { 
				echo "document.getElementById('".$filledItem[$i]."').style.color = 'red';";	
			}
		}
	?>
</script>
</body>
</html>