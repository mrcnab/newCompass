<?
	require_once("classes/DBAccess.php");
	$db = new DBAccess();
	
	function tableExists( $table )
	{
		global $db;
		$q = "show tables like '".$table."'";
		$r =  $db -> getSingleRecord( $q );
		return strcasecmp($r[0], $table) == 0;
	}
  	
	function create_pdfs_table()
	{
		global $db; $table = "title_dev_pdfs";
		if( !tableExists( $table ) )
		{
			$sql = "CREATE TABLE IF NOT EXISTS `".$table."` (
				  `pdf_id` int(11) NOT NULL auto_increment,
				  `pdf_name` varchar(255) NOT NULL,
				  `pdf_description` varchar(255) NOT NULL,
				  `pdf_file` varchar(255) NOT NULL,
				  `status` tinyint(1) NOT NULL,
				  `addeddate` datetime NOT NULL,
				  `modifieddate` datetime NOT NULL,
				  PRIMARY KEY  (`pdf_id`)
				) TYPE = MYISAM;";
			$db -> updateRecord( $sql );
			
		}	//	End of if( !tableExists( $table ) )
	}	//	End of function create_pdfs_table()
	
	function create_module_tables()
	{
		create_pdfs_table();
	}	//	End of function create_module_tables() 
?>