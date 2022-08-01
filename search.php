<?php
require_once('header.php');

$RS_Results = $objRows->getAllRecords( 'stock_list', '*', '', '', ' GROUP BY stock_name' );

if( isset($_POST["Search"]) )
{
	$qry = "SELECT * FROM `stock_list` WHERE 
				`stock_name`='".$_POST["stock_name"]."' 
				AND 
				`stock_date` BETWEEN 
					'".$_POST["start_date"]."' AND '".$_POST["end_date"]."'";

	$RS_Stocks = $objRows->getMultiRecordsSet($qry);

	$stockProfitLoss = stockBuySell($RS_Stocks);
}
?>

<div class="container">
    <div class="row pt-3">
    	<div class="col-md-12">
	        <form method="post">
			  <div class="form-row">
			    <div class="col">
			    	<label>Start Date</label>
			      	<input type="text" class="form-control datepicker start_date" name="start_date" id="start_date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" required value="<?php echo $_POST['start_date'] ?? ''; ?>">
			    </div>
			    <div class="col">
			    	<label>End Date</label>
			      	<input type="text" class="form-control datepicker end_date" name="end_date" id="end_date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" required value="<?php echo $_POST['end_date'] ?? ''; ?>">
			    </div>
			    <div class="col">
			    		<label>Stock List</label>
				      <select class="custom-select mr-sm-2" id="stock_name" name="stock_name" required>
				        <option value="">Choose Stock...</option>
				        <?php
	    				if( !empty($RS_Results) )
	    				{
	    					foreach( $RS_Results as $RS_Row)
	    					{
	    				?>
				        	<option value="<?php echo $RS_Row['stock_name']; ?>" <?php echo !empty($_POST['stock_name']) && $_POST['stock_name']===$RS_Row['stock_name'] ? 'selected' : ''; ?>><?php echo $RS_Row['stock_name']; ?></option>
				        <?php
		    				}
		    			}
	    				?>
				      </select>
			    </div>
			    <div class="col">
			    	<div><label>&nbsp;</label></div>
			    	<button type="submit" id="submit" name="Search" class="btn btn-primary button-loading" data-loading-text="Loading...">Search</button>
			    </div>
			  </div>
			</form>
        </div>
    </div>

    
    <div class="row mt-5">
    	<div class="col-md-12">
    		<?php echo $stockProfitLoss ?? ''; ?>
    	</div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $('.datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });

    // $('.start_date').datepicker("setDate", new Date());
    // $('.end_date').datepicker("setDate", new Date());
</script>

<?php
require_once('footer.php');
?>