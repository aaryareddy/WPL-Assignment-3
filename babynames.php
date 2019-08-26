<?php
	$y	= '';
	$g	= '';

	$DB_server	= 'localhost';
	$DB_name	= 'hw3';
	$DB_username	= 'root';
	$DB_password	= 'root';
	

	$DB_conn	= '';
	$DB_SQL		= '';
	$DB_ResultSet	= '';

	if ($_SERVER ['REQUEST_METHOD']	== 'POST')
	{
		if (isset ($_POST ['year']))
		{
			if ($_POST ['year'] != 'All years')
			{
				$y	= $_POST ['year'];
			}
			else
			{
				$y	= 'All years';
			}
		}
		else
		{
			$y	= '';
		}

		if (isset ($_POST ['gender']))
		{
			if ($_POST ['gender'] != 'Both')
			{
				$g	= $_POST ['gender'];
			}
			else
			{
				$g	= 'Both';
			}
		}
		else
		{
			$g	= '';
		}

		$DB_conn	= new mysqli ($DB_server, $DB_username, $DB_password, $DB_name);

		
		echo "<table border='3' align='center'><tbody><tr>";

		if ($y != 'All years'  && $g != 'Both')
		{
			$DB_SQL		= 'SELECT * FROM babynames where year='.(int)$y.' AND gender='.'"'.$g.'"'.
					  'ORDER BY ranking ASC LIMIT 5';

			$DB_ResultSet	= $DB_conn->query ($DB_SQL);
			echo '<th>Baby Name</th>';
			echo '<th>Popularity Ranking</th>';
			echo '<th>Gender (m:Male, f:Female)</th>';
			echo '<th>Year</th>';
			echo '</tr>';

			while ($row = $DB_ResultSet->fetch_assoc ())
			{
				echo '<tr>';
				echo '<td>'.$row ['name'].'</td>';
				echo '<td>'.$row ['ranking'].'</td>';
				echo '<td>'.$row ['gender'].'</td>';
				echo '<td>'.$row ['year'].'</td>';
				echo '</tr>';
			}
		}
		else if ($y == 'All years' && $g!= 'Both')
		{
			$DB_SQL		= 'SELECT * FROM babynames where gender='.'"'.$g.'"'.
					  'ORDER BY year DESC';

			$DB_ResultSet	= $DB_conn->query ($DB_SQL);

			echo '<th>Baby Name</th>';
			echo '<th>Popularity Ranking</th>';
			echo '<th>Gender (m:Male, f:Female)</th>';
			echo '<th>Year</th>';
			echo '</tr>';

			while ($row = $DB_ResultSet->fetch_assoc ())
			{
				echo '<tr>';
				echo '<td>'.$row ['name'].'</td>';
				echo '<td>'.$row ['ranking'].'</td>';
				echo '<td>'.$row ['gender'].'</td>';
				echo '<td>'.$row ['year'].'</td>';
				echo '</tr>';
			}

			echo '</tbody></table>';
		}
		else if ($y != 'All years' && $g == 'Both')
		{
			
			$DB_SQL		= 'SELECT * FROM babynames where year='.'"'.(int)$y.'"'.
					  'ORDER BY gender';

			$DB_ResultSet	= $DB_conn->query ($DB_SQL);

			echo '<th>Baby Name</th>';
			echo '<th>Popularity Ranking</th>';
			echo '<th>Gender (m:Male, f:Female)</th>';
			echo '<th>Year</th>';
			echo '</tr>';

			while ($row = $DB_ResultSet->fetch_assoc ())
			{
				echo '<tr>';
				echo '<td>'.$row ['name'].'</td>';
				echo '<td>'.$row ['ranking'].'</td>';
				echo '<td>'.$row ['gender'].'</td>';
				echo '<td>'.$row ['year'].'</td>';
				echo '</tr>';
			}

			echo '</tbody></table>';
		}
		else
		{
		$DB_SQL		= 'SELECT * FROM babynames ORDER BY year, gender';

			$DB_ResultSet	= $DB_conn->query ($DB_SQL);

			echo '<th>Baby Name</th>';
			echo '<th>Popularity Ranking</th>';
			echo '<th>Gender (m:Male, f:Female)</th>';
			echo '<th>Year</th>';
			echo '</tr>';

			while ($row = $DB_ResultSet->fetch_assoc ())
			{
				echo '<tr>';
				echo '<td>'.$row ['name'].'</td>';
				echo '<td>'.$row ['ranking'].'</td>';
				echo '<td>'.$row ['gender'].'</td>';
				echo '<td>'.$row ['year'].'</td>';
				echo '</tr>';
			}
		}

		echo '</tbody></table>';
	}

	$DB_conn->close ();

	exit ();
?>

