<?php
			session_start();
			$con = mysqli_connect("localhost", "root", "", "WPD");
			if(mysqli_connect_error()) echo "Connection Error.";
				
				$sql = "SELECT Beam_ID, Round( AVG(Thickness) , 2) as AvgThick, Round( AVG(TTV), 2) as AvgTTV, Round(AVG(Sawmark) ,2) as AvgSawmark, 
					Round(AVG(Bow), 2) as AvgBow, Round( AVG(Warp) ,2) as AvgWarp, Round(AVG(Resistivity) , 2) as AvgResistivity, 
					Day FROM wpd_table GROUP BY Beam_ID, Day order by Day ASC";	

				$result = mysqli_query($con, $sql);
				
				if ($result) 
					{	
						echo "<table border=1 style='width:100%; text-align:center'><tr>";	
						echo "<td>Beam_ID</td><td>AvgThick</td><td>AvgTTV</td><td>AvgSawmark</td><td>AvgBow</td><td>AvgWarp</td><td>AvgResistivity</td><td>Day</td></tr>";	
						while ($row = mysqli_fetch_assoc($result)) // output data of each row
						{ 						
							echo "<tr>";
							echo "<td>" .$row["Beam_ID"]. "</td><td>" .$row["AvgThick"]. "</td><td>" . $row["AvgTTV"]. "</td><td>" .$row["AvgSawmark"]. "</td>";
							echo "<td>" .$row["AvgBow"]. "</td><td>" .$row["AvgWarp"]. "</td><td>" .$row["AvgResistivity"]. "</td><td>" .$row["Day"]. "</td>";
							echo "</tr>";
						}		
					echo "</table>";
				} 
				else { echo "0 results";}	

?>
<html>
  <head>
    <title>WPD Line Chart</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"> 
		google.charts.load('current', {'packages':['corechart']}); 
		google.charts.setOnLoadCallback(drawChart);      
	
 function drawChart() 
 {
    var data = google.visualization.arrayToDataTable([ ['Beam_ID', 'AvgThick', 'AvgTTV', 'AvgSawmark', 'AvgBow', 'AvgWarp', 'AvgResistivity'],
<?php
					echo "b";
					if ($result) 
					{		echo "a";
						while ($row = mysqli_fetch_assoc($result)) // output data of each row
						{
							$beam = $row['Beam_ID'];
							$thick = $row['AvgThick']; $ttv = $row['AvgTTV']; $saw = $row['AvgSawmark'];
							$bow = $row['AvgBow']; $warp = $row['AvgWarp']; $res = $row['AvgResistivity'];
							$day = $row['Day'];
							
							echo "['" .$beam. "'," .$thick. "," .$ttv. "," .$saw. "," .$bow. "," .$warp. "," .$res."],";							
						} 
					}	
					else { echo "0 results";}	

		 mysqli_close($con);
?>   ]); //end bracket
 
        var options = { title: 'Company Performance', curveType: 'function', legend: { position: 'bottom' } };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
}
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 100%; height: 500px"> h</div>
	<p>test	
  </body>
</html>
