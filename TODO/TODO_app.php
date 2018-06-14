<?php
	function GetRows()
	{	
	$myfile = fopen("data.json", "r");
	$str_data = file_get_contents("data.json");
	$data = json_decode($str_data,true);
	$lmt = count($data);
	$no=1;
			for ($i=0; $i < $lmt; $i++) { 
				$Name = $data[$i]["Name"];
				$Date =$data[$i]["Date"];
				$Time = $data[$i]["Time"];
				if ($Name != null && $Date != null && $Time != null) {
			
				echo '<TR id="'.$i.'"><td>'.$no.'</td><td id = "Tname">'.$Name.'</td><td id = "Tdate">'.$Date.'</td><td id = "Ttime">'.$Time.'</td></TR>';
				$no++;
				}
			}
	} 

?>
<!DOCTYPE html>
<html>
<head>
	<title>TODO App</title>
	<style type="text/css">
		Tr:hover{
			background-color: #ccc;
		}
	</style>
</head>
<body div ng-app="TODO">
	<DIV div ng-app="" id="main" style="background-color: #5555; width: 80%; margin: auto;">
		<div id="headerSection" style="background-color: #673AB7; width: 100%; margin: auto; height: 20%">
			<h3 style="text-align: center;">TODO List</h3>
		</div>
		<div id="FormContainer" style="margin: 10PX auto auto  10%; width: 100%;">
			<form action="" method="post">
				<label>Task Name: </label>
				<input type="text" ng-model="TaskName" name="Task" id="Task">
				<label>Date: </label>
				<input type="Date" ng-model="Date" name="Date" id="Date">
				<label>Time: </label>
				<input type="Time" ng-model="Time" name="Time" id="Time">
				<input type="Submit" name="sub" value="Save">
				<button type="submit" name="del" value="call">Delete</button>
				<input type="Reset" id="Reset" value="Cancel">
			</form>
		</div>
		<div id="Containt" style="width: 80%; background-color: white; margin: auto;">
			<table id="table" border="1" style="width: 100%; margin: 10px auto auto auto; border-collapse: collapse;">
				<tr>
					<th>Sr. No.</th>
					<th>Task Description</th>
					<th>Date</th>
					<th>Time</th>
				</TR>
				
			<?php 
			GetRows();
			?>
				
			</table>
			<script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("Task").value = this.cells[1].innerHTML;
                         document.getElementById("Date").value = this.cells[2].innerHTML;
                         document.getElementById("Time").value = this.cells[3].innerHTML;
                    };
                }
    
         </script>
		</div>
	</DIV>
</body>
</html>

<?php
function WriteData()
{

	$str_data = file_get_contents("data.json");
	$data = json_decode($str_data,true);
	

	$lmt = count($data);
	    $Temp1 = $_POST['Task'];
	    $Temp2 = $_POST['Date'];
	    $Temp3 = $_POST['Time'];
	    for ($i=0; $i < $lmt ; $i++) { 
	        
	        $Name = $data[$i]["Name"];
	        $Date = $data[$i]["Date"];
	        $Time = $data[$i]["Time"];
	    if ($Name == $Temp1 && $Date == $Temp2 && $Time == $Temp3) {
	       	$extra = array(
			'Name' => $_POST['Task'],
			'Date' => $_POST['Date'],
			'Time' => $_POST['Time']
		 );
			$data[$i] = $extra;
	    }
	    }
	        if ($Name != $Temp1 && $Date != $Temp2 && $Time != $Temp3) {
			$extra = array(
			'Name' => $_POST["Task"],
			'Date' => $_POST["Date"],
			'Time' => $_POST["Time"]
			 );
			$data[] = $extra;
	}
	

	$finalData = json_encode($data);
	if (file_put_contents('data.json', $finalData)) {
	}

}

if (isset($_POST['sub'])) {
	echo WriteData($_POST['sub']);
}
function DeleteData()
{

	    $str_data = file_get_contents("data.json");
	    $data = json_decode($str_data,true);
	    $lmt = count($data);
	    $Temp1 = $_POST['Task'];
	    $Temp2 = $_POST['Date'];
	    $Temp3 = $_POST['Time'];
	    for ($i=0; $i < $lmt ; $i++) { 
	        
	        $Name = $data[$i]["Name"];
	        $Date = $data[$i]["Date"];
	        $Time = $data[$i]["Time"];
	        if ($Name == $Temp1 && $Date == $Temp2 && $Time == $Temp3) {
	    	$extra = null;
		$data[$i] = $extra;
	        }
	    }
	$finalData = json_encode($data);
	if (file_put_contents('data.json', $finalData)) {
	}

    echo '<script language="javascript">';
        echo 'alert("Record Deleted")';
        echo '</script>';
}
if (isset($_POST['del'])) {
    echo DeleteData($_POST['del']);
}
?>