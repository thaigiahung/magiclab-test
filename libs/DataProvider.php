<?php
	class DataProvider
	{
		public static function ExecuteQuery($sql)
		{
			$connection = mysql_connect("host","username","password");
			
			mysql_select_db("db_name",$connection);
			
			mysql_query("set names 'utf8'");
			
			$result = mysql_query($sql,$connection);
			
			mysql_close($connection);
			
			return $result;
		}	
		
		public static function ChangeURL($url)
		{
			echo "<script type='text/javascript'>";
			echo "location='".$url."';";
			echo "</script>";	
		}
	}
?>