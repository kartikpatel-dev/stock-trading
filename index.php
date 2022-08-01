<?php
require_once('header.php');

if(isset($_POST["Import"]))
{    
    $filename=$_FILES["file"]["tmp_name"];
    // echo $filename; exit;

    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");

        while( ($getData = fgetcsv($file, 10000, ",")) !== FALSE )
        {
        	if( is_numeric($getData[0]) )
        	{
        		$InsertValues = array(
	            	'stock_date' => date('Y-m-d', strtotime($getData[1])),
	            	'stock_name' => $getData[2],
	            	'stock_price' => $getData[3],
	            );

	            $response = $objRows->insertArray( 'stock_list', $InsertValues );

		        if( !empty($response) )
		        {
		          echo "<script type=\"text/javascript\">
		              alert(\"Invalid File:Please Upload CSV File.\");
		              window.location = \"index.php\"
		              </script>";    
		        }
		        else
		        {
		            echo "<script type=\"text/javascript\">
		            alert(\"CSV File has been successfully Imported.\");
		            window.location = \"index.php\"
		          </script>";
		        }
        	}
        }
      
        fclose($file);  
    }
}

$RS_Results = $objRows->getAllRecords( 'stock_list' );
?>

<div class="container">
    <div class="row pt-3">
    	<div class="col-md-12">
	        <form class="form-horizontal" action="" method="post" name="upload_excel" enctype="multipart/form-data">
	            <fieldset>
	                <!-- Form Name -->
	                <legend>Import Stock Data</legend>
	                <!-- File Button -->
	                <div class="form-group row">
	                    <div class="col-md-12">
	                    	<label class="control-label mr-3" for="filebutton">Select File</label>
	                        <input type="file" name="file" id="file" class="input-large">
	                    </div>
	                </div>
	                <!-- Button -->
	                <div class="form-group row">
	                    <div class="col-md-12">
	                    	<label class="control-label mr-3" for="singlebutton">Import data</label>
	                        <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
	                    </div>
	                </div>
	            </fieldset>
	        </form>
        </div>
    </div>

    
    <div class="row mt-5">
    	<div class="col-md-12">
    		<h3>Stock List</h3>
    	</div>

    	<div class="col-md-12">
    		<table class="table">
    			<thead class="thead-dark">
    				<tr>
    					<th scope="col">Date</th>
    					<th scope="col">Stock Name</th>
    					<th scope="col">Price</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
    				if( !empty($RS_Results) )
    				{
    					foreach( $RS_Results as $RS_Row)
    					{
    				?>
		    				<tr>
		    					<td><?php echo $RS_Row['stock_date']; ?></td>
		    					<td><?php echo $RS_Row['stock_name']; ?></td>
		    					<td><?php echo $RS_Row['stock_price']; ?></td>
		    				</tr>
    				<?php
	    				}
	    			}
    				else
    				{
    				?>
	    				<tr>
	    					<td colspan="3">No not found</td>
	    				</tr>
	    			<?php
	    			}
	    			?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>

<?php
require_once('footer.php');
?>

    

 

