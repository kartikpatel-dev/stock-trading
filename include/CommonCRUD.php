<?php
require_once('dbconfig.php');

class CommonCRUD 
{
	private $oDB;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->oDB = $db;
    }
	
	private function qrySqlorDie( $sql ) 
	{
		$Return_RS = $this->oDB->prepare($sql);

		if( (!is_object($Return_RS) ) || (!$Return_RS) || ( $Return_RS == NULL ) ) 
		{
			echo 'MySql Query Unable to Execute' . '<br />';
			die('error: '. $sql);
		}
		else
		{
			return $Return_RS;
		}
	}
	
	
	/*
		function: getLastInsertId()
	*/ 
	public function getLastInsertId() 
	{
		$SQL = "SELECT LAST_INSERT_ID() AS id";
		$SEL = $this->qrySqlorDie($SQL); 
		$SEL->execute();
		$SEL->setFetchMode(PDO::FETCH_ASSOC);
		$RS_LastID = $SEL->fetch();
		
		return $RS_LastID["id"];
	}
	
	
	/**
	 *	Function to get Total Record count :: no matter what LIMIT values are passed (if any)
	 */
	public function getTotalRowCount()
	{
		$output = -1;

		$RS_Total = $this->qrySqlorDie("SELECT FOUND_ROWS() as rows");
		if( !empty($RS_Total) )
		{
			$RS_Total->execute();
			$output = $RS_Total->rowCount();
		}
				
		return $output;
	}

	
	/**
	 *	function getTotalRecordsCount()
	 */
	public function getTotalRecordsCount($sql_stmt)
	{
		$output = array();
		$RS_Total = $this->qrySqlorDie($sql_stmt);
		$RS_Total->execute();
		$output = $RS_Total->rowCount();
		
		return $output;
	}
	
	
	/*
		function: insertArray()
	*/
	public function insertArray( $TBL_NM, $InsertValues )
	{
		foreach( $InsertValues as $Key => $Val ) 
		{
			$QRY_FIELDS[] = "`".$Key."` = '".htmlentities($Val, ENT_QUOTES, 'UTF-8')."'";
		}
		$QRY_FIELDS = implode(', ', $QRY_FIELDS);

		$InsQry = "INSERT INTO " .$TBL_NM. " SET ".$QRY_FIELDS;
		$SqlQry = $this->qrySqlorDie($InsQry); 
		$SqlQry->execute();
	}
	
	
	/*
		function: updateArray()
	*/
	public function updateArray( $TBL_NM, $UpdateValues, $TBL_WH )
	{
		foreach( $UpdateValues as $Key => $Val ) 
		{
			$QRY_FIELDS[] = "`".$Key."` = '".htmlentities($Val, ENT_QUOTES, 'UTF-8')."'";
		}
		$QRY_FIELDS = implode(', ', $QRY_FIELDS);
		
		$QRY_WH = array();
		if( !empty($TBL_WH) ) :
			foreach( $TBL_WH as $Keys => $Vals )
			{
				$QRY_WH[] = "`".$Keys."` = '".$Vals."' ";
			}
			
			$QRY_WH = ' WHERE '.implode('AND ', $QRY_WH);
		endif;
		
		$UptQry = "UPDATE " .$TBL_NM. " SET ".$QRY_FIELDS. $QRY_WH;
		$SqlQry = $this->qrySqlorDie($UptQry); 
		$SqlQry->execute();
	}
	
	
	/*
		function: insertArray()
	*/
	public function deleteArray( $TBL_NM, $DeleteValues )
	{
		$QRY_WH = array();

		if( !empty($DeleteValues) ) :
			foreach( $DeleteValues as $Keys => $Vals )
			{
				$QRY_WH[] = "`".$Keys."` = '".$Vals."' ";
			}
			
			$QRY_WH = ' WHERE '.implode('AND ', $QRY_WH);
		endif;
		
		$DelQry = "DELETE FROM " .$TBL_NM. $QRY_WH;
		$SqlQry = $this->qrySqlorDie($DelQry); 
		$SqlQry->execute();
	}
	
	
	/*
		funciton: getAllRecords()
	*/
	public function getAllRecords( $TBL_NM, $TBL_Fields='*', $TBL_WH='', $TBL_Orders='', $Extra='' )
	{	
		// Where condition
		$QRY_WH = '';
		
		if( !empty($TBL_WH) ) :
			$QRY_WH = array();
			
			foreach( $TBL_WH as $Keys => $Vals )
			{
				$QRY_WH[] = "`".$Keys."` = '".$Vals."' ";
			}
			
			$QRY_WH = ' WHERE '.implode('AND ', $QRY_WH);
		endif;
		
		
		// Ordering
		$QRY_ORDER = '';
		
		if( !empty($TBL_Orders) ) :
			$QRY_ORDER = array();
			
			foreach( $TBL_Orders as $Keys => $Vals )
			{
				$QRY_ORDER[] = "`".$Keys."` ".$Vals." ";
			}
			
			$QRY_ORDER = ' ORDER BY  '.implode(', ', $QRY_ORDER);
		endif;
		
		$SEL 	= "SELECT ".$TBL_Fields." FROM `".$TBL_NM."` ".$QRY_WH. $QRY_ORDER. $Extra;
		$SEL_P 	= $this->qrySqlorDie($SEL); 
		$SEL_P->execute();
		
		$Results = array();
		if( $SEL_P->rowCount() > 0 )
		{
			$Result = $SEL_P->setFetchMode(PDO::FETCH_ASSOC);
			$Results = $SEL_P->fetchAll();
			
			return $Results;
		}
	}
	
	/*
		funciton: getMultiRecordsSet()
	*/
	public function getMultiRecordsSet( $QRY_SEL )
	{
		$SEL_P 	= $this->qrySqlorDie($QRY_SEL); 
		$SEL_P->execute();
		
		$Results = array();
		if( $SEL_P->rowCount() > 0 )
		{
			$Result = $SEL_P->setFetchMode(PDO::FETCH_ASSOC);
			$Results = $SEL_P->fetchAll();
			return $Results;
		}
	}
}
?>