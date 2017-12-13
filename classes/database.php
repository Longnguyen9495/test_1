<?
$arrayListQueryOnPage	= array(); // Array lưu các query trong 1 page
class db_init
{
	var $server;
	var $username;
	var $password;
	var $database;

	// File error mà lớn hơn 3k (~ 120 kết nối lỗi) -> loại khỏi node
	var $max_error_slave_size = 3000;

	/**
	 * db_init::db_init()
	 * $iDatabaseSelect :   0 -> chon database 0
	 * 							1 -> chon database 1
	 * @param integer $iDatabaseSelect
	 * @return void
	 */
	function db_init($iDatabaseSelect = 0)
	{
		switch($iDatabaseSelect){
			default:
				$this->server	= "localhost";
				$this->username	= "root";
				$this->password	= "";
				$this->database	= "db_video";
				break;
		}

	}

	function __destruct()
	{
		unset($this->server);
		unset($this->username);
		unset($this->password);
		unset($this->database);
	}

	/**
	 * Hàm ghi log
	 */
	function log($filename, $content){

		$log_path	= $_SERVER["DOCUMENT_ROOT"] . "/log/";
		$handle		= @fopen($log_path . $filename . ".cfn", "a");
		//N?u handle chua có m? thêm ../
		if (!$handle) $handle = @fopen($log_path . $filename . ".cfn", "a");
		//N?u ko m? dc l?n 2 th exit luôn
		if (!$handle) exit();

		fwrite($handle, date("d/m/Y h:i:s A") . " " . @$_SERVER["REQUEST_URI"] . "\n" . $content . "\n");
		fclose($handle);

	}
}
?>
<?
class db_query
{
	var $result;
	var $links;
	var $time_slow_log = 0.5;
	protected $use_slave;

	/**
	 * db_query::db_query()
	 * $iDatabaseSelect
	 * @param mixed $query
	 * @param string $file_include_name
	 * @param string $use_slave
	 * @return void
	 */
	function db_query($query, $file_include_name = "", $iDatabaseSelect = 0){

		global $arrayListQueryOnPage;
		if(!isset($arrayListQueryOnPage)){
			$arrayListQueryOnPage 	= array();
		}

		$dbinit				= new db_init($iDatabaseSelect);
		$error_filename	= $_SERVER['DOCUMENT_ROOT'] . "/log/error/errorconect.cfn";

		//Khai bao connect
		//if (!$this->links = @mysql_connect($dbinit->server, $dbinit->username, $dbinit->password)){
		if (!$this->links = @mysql_pconnect($dbinit->server, $dbinit->username, $dbinit->password)){
			/*
			Thông báo lỗi khi không connect được database
			*/
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			echo '<meta name="revisit-after" content="1 days">';
			echo "<center>";
			echo "Chào bạn, trang web bạn yêu cầu hiện chưa thể thực hiện được. <br>";
			echo "Xin bạn vui lòng đợi vài giây rồi ấn <b>F5 để Refresh</b> lại trang web <br>";
			echo "Chúng tôi xin trân trọng cảm ơn";
			echo "</center>";

			$handle = @fopen($error_filename, 'a');
			//Nếu ko mở đc thì exit luôn
			if (!$handle) exit();

			@fwrite($handle, date("d/m/Y h:i:s") . @mysql_error() . " " . @$_SERVER['REMOTE_ADDR'] . " " . @$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
			@fclose($handle);

			exit();
		}

		if (!$db_select = @mysql_select_db($dbinit->database, $this->links)){
			echo ("Cannot select database !");
			exit();
		}

		$time_start = $this->microtime_float();

		@mysql_query("SET NAMES 'utf8'");
		$this->result = mysql_query($query,$this->links);

		$time_end	= $this->microtime_float();
		$time			= $time_end - $time_start;

		// Lưu vào list query trên Page
		$arrayListQueryOnPage[] 	= array("type" => "query", "query" => $query, "time" => $time, "file" => $file_include_name);
		if ($time >= $this->time_slow_log){

			 //Ghi log o file
				$filename	= $_SERVER['DOCUMENT_ROOT'] . "/log/slow/" . date("Y_m_d_H") . "h.txt";
				$handle		= @fopen($filename, "a");
			 //Nếu ko mở đc thì exit luôn
			 if (!$handle) exit();

			 @fwrite($handle, date("d/m/Y h:i:s") . " " . @$_SERVER['REMOTE_ADDR'] . " " . @$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
			 @fwrite($handle, $file_include_name . "\n -----***---- \n");
			 @fwrite($handle, number_format($time,10,".",",") . " :  " . $query . "\n -----***---- \n");
			 @fclose($handle);

		}

		unset($dbinit);
		if (!$this->result)
		{
			//Ghi log o file
			$path			= $_SERVER['DOCUMENT_ROOT'] . "/log/error/";
			$filename	= date("Y_m_d_H") . "h.txt";

			$handle		= @fopen($path . $filename, "a");
			//Nếu handle chưa có mở thêm ../
			if (!$handle) $handle	= @fopen($path . $filename, "a");
			//Nếu ko mở đc lần 2 thì exit luôn
			if (!$handle) exit();

			//fwrite($handle, date("d/m/Y h:i:S A") . "\n");
			$url		= $file_include_name;
			$error	= mysql_error($this->links);
			mysql_close($this->links);

			@fwrite($handle, date("d/m/Y h:i:s") . " " . @$_SERVER['REMOTE_ADDR'] . " " . @$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
			@fwrite($handle, $url . "\n -----***---- \n");
			@fwrite($handle, $error . " :  \n" . $query . "\n -----***---- \n");
			@fclose($handle);

			die("Error in query string");
		}

	}

	//trả về array
	function resultArray(){

		$arrayReturn = array();
		while($row = mysql_fetch_assoc($this->result)){
			$arrayReturn[] = $row;
		}

		return $arrayReturn;
	}
	function close()
	{
		mysql_free_result($this->result);
		if ($this->links)
		{
			mysql_close($this->links);
		}
	}
	//Hàm tính time
	function microtime_float()
	{
	   list($usec, $sec) = explode(" ", microtime());
	   return ((float)$usec + (float)$sec);
	}
}
?>
<?
class db_execute
{
	var $links;
	var $msgbox = 0;
	function db_execute($query, $iDatabaseSelect = 0, $file_include_name = ""){

		global $arrayListQueryOnPage;
		if(!isset($arrayListQueryOnPage)){
			$arrayListQueryOnPage 	= array();
		}

		$dbinit = new db_init($iDatabaseSelect);

		//$this->links = @mysql_connect($dbinit->server, $dbinit->username, $dbinit->password);
		$this->links = @mysql_pconnect($dbinit->server, $dbinit->username, $dbinit->password);
		@mysql_select_db($dbinit->database);

		unset($dbinit);

		$time_start 	= $this->microtime_float();

		@mysql_query("SET NAMES 'utf8'");
		@mysql_query($query);
		$this->msgbox	= @mysql_affected_rows();

		$time_end		= $this->microtime_float();
		$time				= $time_end - $time_start;

		@mysql_close($this->links);

		// Lưu vào list query trên Page
		$arrayListQueryOnPage[] 	= array("type" => "execute", "query" => $query, "time" => $time, "file" => $file_include_name);

		// Log lại lệnh DELETE
		if(strpos($query, "DELETE") !== false){
			//Log lai cap nhat truong bua_default
			$path			= $_SERVER['DOCUMENT_ROOT'] . "/log/execute/";
			$filename	= date("Y_m_d_H") . "h.txt";

			$handle		= @fopen($path . $filename, "a");
			//Nếu handle chưa có mở thêm ../
			if (!$handle) $handle = @fopen($path . $filename, "a");
			//Nếu ko mở đc lần 2 thì exit luôn
			if (!$handle) exit();

			//fwrite($handle, date("d/m/Y h:i:S A") . "\n");
         @fwrite($handle, @$_SESSION["user_id"] . "|" . @$_SESSION["userlogin"] . "|");
			@fwrite($handle, date("d/m/Y h:i:s") . " " . @$_SERVER['REMOTE_ADDR'] . " " . @$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
			@fwrite($handle, $query . "\n -----***---- \n");
			@fclose($handle);
		}
	}

	//Hàm tính time
	function microtime_float(){
	   list($usec, $sec) = explode(" ", microtime());
	   return ((float)$usec + (float)$sec);
	}
}
class db_count{
	var $total;
	function db_count($sql, $file_include_name = "", $use_slave = "", $iDatabaseSelect = 0){
		$db_ex = new db_query($sql, $file_include_name, $use_slave, $iDatabaseSelect);
		if($row = mysql_fetch_assoc($db_ex->result)){
			$this->total = intval($row["count"]);
		}else{
			$this->total = 0;
		}
		$db_ex->close();
		unset($db_ex);
		return $this->total;
	}
}
?>
<?
class db_execute_return
{
	var $links;
	var $result;

	function db_execute($query, $iDatabaseSelect = 0, $file_include_name = ""){

		global $arrayListQueryOnPage;
		if(!isset($arrayListQueryOnPage)){
			$arrayListQueryOnPage 	= array();
		}

		$dbinit			= new db_init($iDatabaseSelect);

		//$this->links	= @mysql_connect($dbinit->server, $dbinit->username, $dbinit->password);
		$this->links	= @mysql_pconnect($dbinit->server, $dbinit->username, $dbinit->password);
		@mysql_select_db($dbinit->database);
		unset($dbinit);

		$time_start = $this->microtime_float();

		@mysql_query("SET NAMES 'utf8'");
		@mysql_query($query);

		$last_id			= 0;
		$this->result	= @mysql_query("SELECT LAST_INSERT_ID() AS last_id",$this->links);
		if ($row = @mysql_fetch_array($this->result)){
			$last_id 	= $row["last_id"];
		}

		$time_end	= $this->microtime_float();
		$time			= $time_end - $time_start;
		// Lưu vào list query trên Page
		$arrayListQueryOnPage[] 	= array("type" => "execute", "query" => $query, "time" => $time, "file" => $file_include_name);

		@mysql_close($this->links);
		return $last_id;
	}

	//Hàm tính time
	function microtime_float(){
	   list($usec, $sec) = explode(" ", microtime());
	   return ((float)$usec + (float)$sec);
	}
}
?>