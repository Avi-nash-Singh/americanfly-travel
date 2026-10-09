<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../frontend/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Upload Data</h2>


  <?php
include_once ("config.php");

if(isset($_POST["Import"]))
{
    
    if($_POST['delete_data'] != ''){
        mysqli_query($conn,"DELETE FROM flights" );
    }

	if($_FILES['file']['name'])
	{
	    
		$arrFileName = explode('.',$_FILES['file']['name']);
		if($arrFileName[1] == 'csv')
		{
		    
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			
			$i=0;
			while (($data = fgetcsv($handle, 1000000, ",")) !== FALSE)
			{
        if($i==1){
          continue;
        }
				$item1 = mysqli_real_escape_string($conn,$data[0]);
				$item2 = mysqli_real_escape_string($conn,$data[1]);
				$item3 = mysqli_real_escape_string($conn,$data[2]);
				$item4 = mysqli_real_escape_string($conn,$data[3]);
				$item5 = mysqli_real_escape_string($conn,$data[4]);
				$item6 = mysqli_real_escape_string($conn,$data[5]);
				$item7 = mysqli_real_escape_string($conn,$data[6]);
				$item8 = mysqli_real_escape_string($conn,$data[7]);
        $item9 = mysqli_real_escape_string($conn,$data[8]);
        $item10 = mysqli_real_escape_string($conn,$data[9]);
        $item11 = mysqli_real_escape_string($conn,$data[10]);
        $item12 = mysqli_real_escape_string($conn,$data[11]);
        $item13 = mysqli_real_escape_string($conn,$data[12]);
        $item14 = mysqli_real_escape_string($conn,$data[13]);
        $item15 = mysqli_real_escape_string($conn,$data[14]);
        $item16 = mysqli_real_escape_string($conn,$data[15]);
        $item17 = mysqli_real_escape_string($conn,$data[16]);
        $item18 = mysqli_real_escape_string($conn,$data[17]);
        $item19 = mysqli_real_escape_string($conn,$data[18]);
        $item20 = mysqli_real_escape_string($conn,$data[19]);
        $item21 = mysqli_real_escape_string($conn,$data[20]);
        
        $item3 = date("Y-m-d",strtotime($item3));
        $item4 = date("Y-m-d",strtotime($item4));
   

				$import = "INSERT into flights(source,destination,start_date,end_date,airline,logo,route,route2,route3,adult_fare,status,from_departure,from_arrival,from_duration,to_departure,to_arrival,to_duration,class,refundable,meal,weight) values('$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16','$item17','$item18','$item19','$item20','$item21')";

        // print_r($import);die;
				$insert = mysqli_query($conn,$import);
				
			}
			fclose($handle);
            
            
            if($insert){ 
			?>
            <div class="notice notice-success"><p>Data Import Complete</p><a href="flightslist.php" class="btn btn-info ewButton">View Flights</a></div>
            <?php
            }
            else{
            ?>
            <div class="notice notice-danger"><p>Error occured. </p><a href="upload_flights.php" class="btn btn-info ewButton">Try Again</a></div>
            <?php
            }
		}
	}
}

else {
?>

  <form class="form-horizontal" action="upload_flights.php" method="post" name="upload_excel" enctype="multipart/form-data">
    <div class="form-group pull-right">
            <div class="col-md-4">
                <button type="submit" id="submit" name="Import" class="btn btn-primary ewButton" data-loading-text="Loading..."><i class="icon-file-upload position-left"></i>Start Import</button>
            </div>
        </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="select file">Select File:</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="file" name="file">
      </div>
    </div>
    <div class="form-group">      
        <label class="control-label col-sm-2" for="select file">Delete Data:</label>  
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
            <label><input type="checkbox" name="delete_data">    If you select this all previous data will be deletd.</label>
            </div>
        </div>
    </div>
  </form>

  <?php
}
?>

</div>

</body>
</html>
