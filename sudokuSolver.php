<?php 
	session_start();
	function sudokuSolver($sudoku){
		cell($sudoku, 0, 0);
	}
	function cell($sudoku, $row, $col){
		$newRow = 0;
		$newCol = 0;
		if($row == 9){
			// printSudoku($sudoku);
			$_SESSION['sudoku'] = $sudoku;
			return true;
		}else if ($col < 8) {
			$newRow = $row;
			$newCol = $col + 1; 
		}else{
			$newRow = $row + 1;
			$newCol = 0;
		}
		if ($sudoku[$row][$col] == '') {
			for ($item=1; $item <= 9; $item++) {
				if (isSef($sudoku, $row, $col, $item)) {
					$sudoku[$row][$col] = $item;
					if (cell($sudoku, $newRow, $newCol)) {
						return true;
					}else{
						$sudoku[$row][$col] = '';
					}
				}if ($item == 9) {
					return false;
				}
			}
		}else{
			if (cell($sudoku, $newRow, $newCol)) {
				return true;
			}
		}
		// return false;
	}
	function isSef($sudoku, $row, $col, $item){
	//	row checking ..................
		for ($rc=0; $rc < 9; $rc++) { 	//	rc = row checking;
			if ($sudoku[$row][$rc] == $item) {
				return false;
			}
		}

	//	column checking ..................
		for ($cc=0; $cc < 9; $cc++) {  // cc = column checking;
			if ($sudoku[$cc][$col] == $item) {
				return false;
			}
		}
	//	grid checking ..................
		$gr = intval($row / 3)*3;
		$gc = intval($col / 3)*3;
		for ($x = $gr; $x < $gr + 3; $x++) { 
			for($y = $gc; $y < $gc + 3; $y++){
				if ($sudoku[$x][$y] == $item) {
					return false;
				}
			}
		}
		return true;
	}
?>