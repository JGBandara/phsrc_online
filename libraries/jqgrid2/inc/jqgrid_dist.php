<?php
/**
 * JqGrid PHP Component
 *
 * @author Afnan Zari <azghanvi@gmail.com> - http://azgtech.wordpress.com
 * @version 1.4
 * @todo: footer summary, bulk upload, custom JS validation
 * @todo: gdocs (auto refresh, row/cell lock)
 * @license: see license.txt included in package
 */
 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

class jqgrid
{
	// grid parameters
	var $options = array();
	
	// select query to show data
	var $select_command;
	
	// db table name used in add,update,delete
	var $table;
	
	// allowed operation on grid
	var $actions;
	
	// db connection identifier - not used now, @todo: need to integrate adodb lib
	var $con;
	var $db_driver;
		
	// callback events
	var $events;
	
	/**
	 * Contructor to set default params
	 */
	function jqgrid($db_conf = null)
	{
		if (!isset($_SESSION) || !is_array($_SESSION))
			session_start();
		
		/*
		ADD BY ROSHAN PERERA
		2012 NOVEMBER 06
		*/
		$db_conf = array();
		$db_conf["type"] 		= "mysql"; // mysql,oci8(for oracle),mssql,postgres,sybase
		$db_conf["server"] 		= $_SESSION["Server"];
		$db_conf["user"] 		= $_SESSION["UserName"];
		$db_conf["password"] 	= $_SESSION["Password"];
		$db_conf["database"] 	= $_SESSION["Database"];
		/*
		END LINE
		*/
		$this->db_driver = "mysql";
		
		// use adodb layer to support non-mysql dbs
		if ($db_conf)
		{
			// set up DB
			include($_SESSION['ROOT_PATH']."/libraries/jqgrid2/inc/adodb/adodb.inc.php");
			$driver = $db_conf["type"];
			$this->con = ADONewConnection($driver); # eg. 'mysql,oci8(for oracle),mssql,postgres,sybase' 
			$this->con->SetFetchMode(ADODB_FETCH_ASSOC);
			$this->con->debug = 0;
	
			$this->con->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]);
	
			// set your db encoding -- for ascent chars (if required)	
			if ($db_conf["type"] == "mysql")
				$this->con->Execute("SET NAMES 'utf8'");
		
			$this->db_driver = $db_conf["type"];
		}
		
		$grid["datatype"] = "json";
		$grid["rowNum"] = 20;
		$grid["width"] = 900;
		$grid["height"] = 420;
		$grid["rowList"] = array(10,20,30);
		$grid["viewrecords"] = true;
		$grid["scrollrows"] = true;
		
		$protocol = ( ($_SERVER['HTTPS'] == "on" || $_SERVER["SERVER_PORT"] == "443" ) ? "https" : "http");
		$grid["url"] = "$protocol://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		
		// pass subgrid params if exist
		$s = (strstr($grid["url"], "?")) ? "&":"?";
		if (isset($_REQUEST["rowid"]) && isset($_REQUEST["subgrid"]))
			$grid["url"] .= $s."rowid=".$_REQUEST["rowid"]."&subgrid=".$_REQUEST["subgrid"];

		$grid["editurl"] = $grid["url"];
		$grid["cellurl"] = $grid["url"];
		
		// virtual scrolling, for big datasets
		$grid["scroll"] = 0;
		$grid["sortable"] = true;
		$grid["cellEdit"] = false;

		// if specific export is requested
		if (isset($_GET["export_type"]) && ($_GET["export_type"] == "xlsx" || $_GET["export_type"] == "excel"))
			$grid["export"]["format"] = "excel";
		else if (isset($_GET["export_type"]) && $_GET["export_type"] == "pdf")
			$grid["export"]["format"] = "pdf";

		// default pdf export options
		$grid["export"]["paper"] = "a4";
		$grid["export"]["orientation"] = "landscape";
		
		$grid["add_options"] = array("closeAfterAdd"=>true);
		$grid["edit_options"] = array("closeAfterEdit"=>true);
		
		$this->options = $grid;	
		
		$this->actions["showhidecolumns"] = true;
		$this->actions["inlineadd"] = false;
		$this->actions["search"] = "";
		$this->actions["export"] = false;
	}

	/**
	 * Helping function to parse array
	 */
	private function strip($value)
	{
		if(get_magic_quotes_gpc() != 0)
		{
			if(is_array($value))  
				if ( array_is_associative($value) )
				{
					foreach( $value as $k=>$v)
						$tmp_val[$k] = stripslashes($v);
					$value = $tmp_val; 
				}				
				else  
					for($j = 0; $j < sizeof($value); $j++)
						$value[$j] = stripslashes($value[$j]);
			else
				$value = stripslashes($value);
		}
		return $value;
	}	
	
	/**
	 * Advance search where clause maker
	 */
	private function construct_where($s)
	{
		$qwery = "";
		//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
		$qopers = array(
					  'eq'=>" = ",
					  'ne'=>" <> ",
					  'lt'=>" < ",
					  'le'=>" <= ",
					  'gt'=>" > ",
					  'ge'=>" >= ",
					  'bw'=>" LIKE ",
					  'bn'=>" NOT LIKE ",
					  'in'=>" IN ",
					  'ni'=>" NOT IN ",
					  'ew'=>" LIKE ",
					  'en'=>" NOT LIKE ",
					  'cn'=>" LIKE " ,
					  'nc'=>" NOT LIKE " );
		if ($s) {
			$jsona = json_decode($s,true);
			if(is_array($jsona))
			{
				$gopr = $jsona['groupOp'];
				$rules = $jsona['rules'];
				$i =0;
				foreach($rules as $key=>$val) 
				{
					# fix for conflicting table name fields (used alias from page, in property dbname)
					foreach($this->options["colModel"] as $link_c)
					{
						if ($val['field'] == $link_c["name"] && !empty($link_c["dbname"]))
						{
							$val['field'] = $link_c["dbname"];
							break;
						}
					}
					$field = $val['field'];
					$op = $val['op'];
					$v = $val['data'];
					if(isset($v) && isset($op))
					{
						$i++;
						// ToSql in this case is absolutley needed
						$v = $this->to_sql($field,$op,$v);
			
						if ($i == 1) $qwery = " AND ";
						else $qwery .= " " .$gopr." ";
						switch ($op) {
							// in need other thing
							case 'in' :
							case 'ni' :
								$qwery .= $field.$qopers[$op]." (".$v.")";
								break;
							default:
								$qwery .= $field.$qopers[$op].$v;
						}
					}
				}
			}
		}
		return $qwery;
		
	}	

	/**
	 * Advance search, make search operator sql compatible
	 */
	private function to_sql($field, $oper, $val) 
	{
		//mysql_real_escape_string is better
		if($oper=='bw' || $oper=='bn') return "'%" . addslashes($val) . "%'";
		else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
		else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
		else return "'" . addslashes($val) . "'";
	}
	
	/**
	 * Setter for event handler
	 */
	function set_events($arr)
	{
		$this->events = $arr;
	}

	/**
	 * Get dropdown values for select dropdowns
	 */	
	function get_dropdown_values($sql)
	{
		$str = array();

		if ($this->con)
			$result = $this->con->Execute( $sql ) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql");
		else		
			$result = mysql_query($sql);

		if ($this->con)
		{
			$arr = $result->GetRows();
			
			foreach($arr as $rs)
				$str[] = $rs["k"].":".$rs["v"];
		}
		else
		{
			while($rs = mysqli_fetch_array($result,MYSQL_ASSOC))
			{
				$str[] = $rs["k"].":".$rs["v"];
			}
		}
				
		$str = implode($str,";");
		return $str;
	}
	
	/**
	 * Setter for allowed actions (add/edit/del/autofilter etc)
	 */
	function set_actions($arr)
	{
		if (empty($arr))
			$arr = array();		
			
		if (empty($this->actions))
			$this->actions = array();
			
		// for add_option array
		foreach($arr as $k=>$v)
			if (is_array($v))
			{
				if (!isset($this->actions[$k]))
					$this->actions[$k] = array();
					
				$arr[$k] = array_merge($arr[$k],$this->actions[$k]);
			}		
			
		$this->actions = array_merge($this->actions,$arr);
	}
	
	/**
	 * Setter for grid customization options
	 */
	function set_options($options)
	{
		if (empty($arr))
			$arr = array();

		if (empty($this->options))
			$this->options = array();

		// for export like array merge
		foreach($options as $k=>$v)
			if (is_array($v))
			{
				if (!isset($this->options[$k]))
					$this->options[$k] = array();
					
				$options[$k] = array_merge($options[$k],$this->options[$k]);
			}
			
		$this->options = array_merge($this->options,$options);
	}
	
	/**
	 * Auto generate columns for grid based on SQL / table
	 */
	function set_columns($cols = null)
	{
		if (!$this->table && !$this->select_command) die("Please specify tablename or select command");
		
		// if only table is defined, make select sql for it
		if (!$this->select_command && $this->table)
			$this->select_command = "SELECT * FROM ".$this->table;

		// add where clause if not present -- fix for search feature
		if (stristr($this->select_command,"WHERE") === false)
		{
			// place group by at proper position in sql
			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$start = substr($this->select_command,0,$p);
				$end = substr($this->select_command,$p);
				$this->select_command = $start." WHERE 1=1 ".$end;
			}
			else
				$this->select_command .= " WHERE 1=1";
		}

		// make sql on single line, with no extra spaces
		$this->select_command = preg_replace("/(\r|\n)/"," ",$this->select_command);
		$this->select_command = preg_replace("/[ ]+/"," ",$this->select_command);

		// get sql column names by running nulled sql
		$sql = $this->select_command . " LIMIT 1 OFFSET 0";
		
		$sql = $this->prepare_sql($sql,$this->db_driver);
		
		if ($this->con)
		{
			$result = $this->con->Execute( $sql ) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql");
			$arr = $result->FetchRow();
			foreach($arr as $k=>$rs)
				$f[] = $k;
		}
		else
		{		
			$result = mysql_query($sql) or die("Couldn't execute query. ".mysql_error()." - $sql");
			$numfields = mysql_num_fields($result);
			for ($i=0; $i < $numfields; $i++) // Header
			{
				$f[] = mysql_field_name($result, $i);
			}
		}

		// if grid columns not defined, make from sql
		if (!$cols)
		{
			foreach($f as $c)
			{
				$col["title"] = ucwords(str_replace("_"," ",$c));
				$col["name"] = $c;
				$col["index"] = $c;
				$col["editable"] = true;
				$col["editoptions"] = array("size"=>20);
				$g_cols[] = $col;
			}
		}
		
		if (!$cols)
			$cols = $g_cols;
			
		// index attr is must for jqgrid, so add it in array
		for($i=0;$i<count($cols);$i++)
		{
			$cols[$i]["name"] = str_replace(".","::",$cols[$i]["name"]);
			$cols[$i]["index"] = $cols[$i]["name"];
			
			if (isset($cols[$i]["formatter"]) && $cols[$i]["formatter"] == "date" && empty($cols[$i]["formatoptions"]))
				$cols[$i]["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'Y-m-d');
			
			if (isset($cols[$i]["formatter"]) && $cols[$i]["formatter"] == "date")
				$cols[$i]["editoptions"]["dataInit"] = "function(o){link_dtpicker(o);}";
		}
			
		//pr($cols);
		$this->options["colModel"] = $cols;
		foreach($cols as $c)
		{
			$this->options["colNames"][] = $c["title"];		
		}
	}
	
	/**
	 * Generate JSON array for grid rendering
	 * @param $grid_id Unique ID for grid
	 */
	function render($grid_id)
	{
		if (isset($_REQUEST["subgrid"]))
			$grid_id .= "_".$_REQUEST["subgrid"];
			
		// generate column names, if not defined
		if (!$this->options["colNames"])
			$this->set_columns();
		
		if (isset($_POST['oper']))
		{
			$op = $_POST['oper'];
			$data = $_POST;
			$id = $data['id'];
			$pk_field = $this->options["colModel"][0]["index"];
			
			// handle grid operations of CRUD
			switch($op)
			{
				case "add":
					unset($data['id']);
					unset($data['oper']);
					
					$update_str = array();

					// custom onupdate event execution
					if (!empty($this->events["on_insert"]))
					{
						$func = $this->events["on_insert"][0];
						$obj = $this->events["on_insert"][1];
						$continue = $this->events["on_insert"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $id, "params" => &$data));
						
						if (!$continue)
							break;
					}
					
					foreach($data as $k=>$v)
					{
						// remove any table alias from query - obseleted
						if (strstr($k,"::") !== false)
							list($tmp,$k) = explode("::",$k);
						$k = addslashes($k);
						$v = addslashes($v);
						$fields_str[] = "$k";
						$values_str[] = "'$v'";
					}
					
					$insert_str = "(".implode(",",$fields_str).") VALUES (".implode(",",$values_str).")";
					
					$sql = "INSERT INTO {$this->table} $insert_str";
					if ($this->con)
					{
						$this->con->Execute($sql) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql");
						$insert_id = $this->con->Insert_ID();
					}
					else
					{
						mysql_query($sql) or die("Couldn't execute query. ".mysql_error()." - $sql");
						$insert_id = mysql_insert_id();
					}

					// custom onupdate event execution
					if (!empty($this->events["on_after_insert"]))
					{
						$func = $this->events["on_after_insert"][0];
						$obj = $this->events["on_after_insert"][1];
						$continue = $this->events["on_after_insert"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $insert_id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $insert_id, "params" => &$data));
						
						if (!$continue)
							break;
					}
					
					// for inline row addition, return insert id to update PK of grid (e.g. order_id#33)
					if ($id == "new_row")
						die($pk_field."#".$insert_id);
					break;
					
				case "edit":
					//pr($_POST);
					unset($data['id']);
					unset($data['oper']);
					
					$update_str = array();

					// custom onupdate event execution
					if (!empty($this->events["on_update"]))
					{
						$func = $this->events["on_update"][0];
						$obj = $this->events["on_update"][1];
						$continue = $this->events["on_update"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $id, "params" => &$data));
						
						if (!$continue)
							break;
					}

					foreach($data as $k=>$v)
					{
						// remove any table alias from query - obseleted
						if (strstr($k,"::") !== false)
							list($tmp,$k) = explode("::",$k);
							
						$k = addslashes($k);
						$v = addslashes($v);
						$update_str[] = "$k='$v'";
					}
					
					$update_str = "SET ".implode(",",$update_str);
					
					if (strstr($pk_field,"::") !== false)
					{
						$pk_field = explode("::",$pk_field);
						$pk_field = $pk_field[1];
					}

					$sql = "UPDATE {$this->table} $update_str WHERE $pk_field = '$id'";
					// pr($sql);
					if ($this->con)
						$this->con->Execute($sql) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql");
					else
						mysql_query($sql) or die("Couldn't execute query. ".mysql_error()." - $sql");
				break;			
				
				case "del":
					
					// obseleted
					if (strstr($pk_field,"::") !== false)
					{
						$pk_field = explode("::",$pk_field);
						$pk_field = $pk_field[1];
					}
					
					// custom onupdate event execution
					if (!empty($this->events["on_delete"]))
					{
						$func = $this->events["on_delete"][0];
						$obj = $this->events["on_delete"][1];
						$continue = $this->events["on_delete"][2];
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id));
						else
							call_user_func($func,array($pk_field => $id));
						
						if (!$continue)
							break;
					}
					
					$id = "'".implode("','",explode(",",$id))."'";
					$sql = "DELETE FROM {$this->table} WHERE $pk_field IN ($id)";
					if ($this->con)
						$this->con->Execute($sql) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql");
					else
						mysql_query($sql) or die("Couldn't execute query. ".mysql_error()." - $sql");
				break;
			}
			
			die;
		}
		
		// apply search conditions (where clause)
		$wh = "";
		
		if (!isset($_REQUEST['_search']))
			$_REQUEST['_search'] = "";
		
		$searchOn = $this->strip($_REQUEST['_search']);
		if($searchOn=='true') 
		{
			$fld = $this->strip($_REQUEST['searchField']);
			
			$cols = array();
			foreach($this->options["colModel"] as $col)
				$cols[] = $col["index"];

			// quick search bar
			if (!$fld)
			{
				$searchstr = $this->strip($_REQUEST['filters']);
				$wh = $this->construct_where($searchstr);
			}
			// search popup form, simple one -- not used anymore
			else
			{
				if(in_array($fld,$cols)) 
				{	
					$fldata = $this->strip($_REQUEST['searchString']);
					$foper = $this->strip($_REQUEST['searchOper']);
					// costruct where
					$wh .= " AND ".$fld;
					switch ($foper) {					
						case "eq":
							if(is_numeric($fldata)) {
								$wh .= " = ".$fldata;
							} else {
								$wh .= " = '".$fldata."'";
							}
							break;
						case "ne":
							if(is_numeric($fldata)) {
								$wh .= " <> ".$fldata;
							} else {
								$wh .= " <> '".$fldata."'";
							}
							break;
						case "lt":
							if(is_numeric($fldata)) {
								$wh .= " < ".$fldata;
							} else {
								$wh .= " < '".$fldata."'";
							}
							break;
						case "le":
							if(is_numeric($fldata)) {
								$wh .= " <= ".$fldata;
							} else {
								$wh .= " <= '".$fldata."'";
							}
							break;
						case "gt":
							if(is_numeric($fldata)) {
								$wh .= " > ".$fldata;
							} else {
								$wh .= " > '".$fldata."'";
							}
							break;
						case "ge":
							if(is_numeric($fldata)) {
								$wh .= " >= ".$fldata;
							} else {
								$wh .= " >= '".$fldata."'";
							}
							break;
						case "ew":
							$wh .= " LIKE '%".$fldata."'";
							break;
						case "en":
							$wh .= " NOT LIKE '%".$fldata."'";
							break;
						case "cn":
							$wh .= " LIKE '%".$fldata."%'";
							break;
						case "nc":
							$wh .= " NOT LIKE '%".$fldata."%'";
							break;
						case "in":
							$wh .= " IN (".$fldata.")";
							break;
						case "ni":
							$wh .= " NOT IN (".$fldata.")";
							break;
						case "bw":
							$wh .= " LIKE '%".$fldata."%'";
							break;
						default:
							$fldata .= "%";
							$wh .= " LIKE '".$fldata."'";
							break;
					}
				}
			}
			// setting to persist where clause in export option
			$_SESSION["jqgrid_filter"] = $wh;
		}
		elseif($searchOn=='false') 
		{
			$_SESSION["jqgrid_filter"] = '';
		}
		
		// generate main json
		if (isset($_GET['page']))
		{
			$page = $_GET['page']; // get the requested page
			$limit = $_GET['rows']; // get how many rows we want to have into the grid
			$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
			$sord = $_GET['sord']; // get the direction
			
			if(!$sidx) $sidx = 1;
			if(!$limit) $limit = 20;

			$sidx = str_replace("::",".",$sidx);
			
			// if export option is requested
			if (isset($_GET["export"]))
			{
				$arr = array();

				// by default export all
				$export_where = "";
				if ($this->options["export"]["range"] == "filtered")
					$export_where = $_SESSION["jqgrid_filter"];

				if (($p = stripos($this->select_command,"GROUP BY")) !== false)
				{
					$start = substr($this->select_command,0,$p);
					$end = substr($this->select_command,$p);
					$SQL = $start.$export_where.$end." ORDER BY $sidx $sord";
				}
				else
					$SQL = $this->select_command.$export_where." ORDER BY $sidx $sord";

				if ($this->con)
					$result = $this->con->Execute( $SQL ) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $SQL");
				else
					$result = mysql_query( $SQL ) or die("Couldn't execute query. ".mysql_error()." - $SQL");	

				// export only selected columns
				$cols_not_to_export = array();
				if ($this->options["colModel"])
				{
					foreach ($this->options["colModel"] as $c)
						if ($c["export"] === false)
							$cols_not_to_export[] = $c["name"];
				}
				
				foreach ($this->options["colModel"] as $c)
					$header[$c["name"]] = $c["title"];
				$arr[] = $header;
				
				if ($this->con)
					$arr = $result->GetRows();
				else
				{
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
					{
						$arr[] = $row;
					}
				}

				//  export only selected data as in header
				foreach($arr as &$v)
				{
					foreach ($v as $k=>$c)
						if (array_key_exists($k,$header) !== true)
							unset($v[$k]);
				}

				if (!empty($cols_not_to_export))
				{
					$export_arr = array();
					foreach($arr as $arr_item)
					{
						foreach($arr_item as $k=>$i)
						{						
							if (in_array($k, $cols_not_to_export))
							{
								unset($arr_item[$k]);
							}
						}
						$export_arr[] = $arr_item;
					}	
					$arr = $export_arr;
				}
				
				if (!$this->options["export"]["filename"])
					$this->options["export"]["filename"] = $grid_id;
					
				if (!$this->options["export"]["sheetname"])
					$this->options["export"]["sheetname"] = ucwords($grid_id). " Sheet";
					
				if ($this->options["export"]["format"] == "pdf")
				{
					// PDF export customization can be checked from URL: http://digitaljunkies.ca/dompdf/
					/**
					 * The pdf standard "Base 14 fonts" are:
					 * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
					 * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
					 * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
					 */
					require_once("dompdf/dompdf_config.inc.php");
					$html = "";
					
					// if customized pdf render is defined, use that
					if (!empty($this->events["on_render_pdf"]))
					{
						$func = $this->events["on_render_pdf"][0];
						$obj = $this->events["on_render_pdf"][1];
						if ($obj)
							$html = call_user_method($func,$obj,array("grid" => $this, "data" => $arr));
						else
							$html = call_user_func($func,array("grid" => $this, "data" => $arr));
					}
					else
					{
						$html .= "<style>td{font-size:11px; font-family:Courier}</style>";
						$html .= "<h1 style='border-bottom:1px solid black'>".$this->options["export"]["heading"]."</h1>";
						$html .= "<table border='0' cellpadding='2' cellspacing='2'>";
						
						$i = 0;
						foreach($arr as $v)
						{
							$shade = ($i++ % 2) ? "bgcolor='#efefef'" : "";
							$html .= "<tr>";
							foreach($v as $d)
								$html .= "<td $shade>$d</td>";
							$html .= "</tr>";
						}
						$html .= "<table>";
					}

					#$old_limit = ini_set("memory_limit", "16M");
					$dompdf = new DOMPDF();
					$dompdf->load_html($html);
					$dompdf->set_paper($this->options["export"]["paper"], $this->options["export"]["orientation"]);
					$dompdf->render();
					$dompdf->stream($this->options["export"]["filename"].".pdf");				
				}
				else
				{
					require('export-xls.class.php');
					$xls = new ExportXLS($this->options["export"]["filename"].".xls");
					// if customized pdf render is defined, use that
					if (!empty($this->events["on_render_excel"]))
					{
						$func = $this->events["on_render_excel"][0];
						$obj = $this->events["on_render_excel"][1];
						if ($obj)
							$xls = call_user_method($func,$obj,array("grid" => $this, "xls" => $xls, "data" => $arr));
						else
							$xls = call_user_func($func,array("grid" => $this, "xls" => $xls, "data" => $arr));
					}
					else
					{					
						$xls->addHeader(array($this->options["export"]["sheetname"]));
						$xls->addHeader(array());
						$xls->addHeader($arr[0]);
						for($i=1;$i<count($arr);$i++)
							$xls->addRow($arr[$i]);
					}
					$xls->sendFile();
				}
				die;
			}
			
			// make count query
			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$sql_count = preg_replace("/SELECT (.*) FROM/i","SELECT 1 as c FROM",$this->select_command);
				$p = stripos($sql_count,"GROUP BY");
				$start_q = substr($sql_count,0,$p);
				$end_1 = substr($sql_count,$p);
				$sql_count = "SELECT count(*) as c FROM ($start_q $wh $end_q) as o";
			}
			else
			{
				$sql_count = $this->select_command.$wh;
				$sql_count = "SELECT count(*) as c FROM (".$sql_count.") as table_count";
			}
			# print_r($sql_count);
			
			if ($this->con)
			{
				$result = $this->con->Execute($sql_count) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $sql_count");
				$row = $result->FetchRow();
			}
			else
			{
				$result = mysql_query($sql_count) or die("Couldn't execute query. ".mysql_error()." - $sql_count");
				$row = mysqli_fetch_array($result,MYSQL_ASSOC);
			}

			$count = $row['c'];

			if( $count > 0 ) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0;
			}

			if ($page > $total_pages) $page=$total_pages;
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			if ($start<0) $start = 0;
	
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;

			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$start_q = substr($this->select_command,0,$p);
				$end_q = substr($this->select_command,$p);
				$SQL = "$start_q $wh $end_q ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
			}
			else
			{
				$SQL = $this->select_command.$wh." ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
			}

			$SQL = $this->prepare_sql($SQL,$this->db_driver);
			
			if ($this->con)
			{
				$result = $this->con->Execute( $SQL ) or die("Couldn't execute query. ".$this->con->ErrorMsg()." - $SQL");
				$rows = $result->GetRows();
				
				// simulate artificial paging for mssql
				if (count($rows) > $limit)
					$rows = array_slice($rows,count($rows) - $limit);
			}
			else
			{
				$rows = array();
				$result = mysql_query( $SQL ) or die("Couldn't execute query. ".mysql_error()." - $SQL");	
				while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
					$rows[] = $row;
			}

			// custom on_data_display event execution
			if (!empty($this->events["on_data_display"]))
			{
				$func = $this->events["on_data_display"][0];
				$obj = $this->events["on_data_display"][1];
				$continue = $this->events["on_data_display"][2];
				
				if ($obj)
					call_user_method($func,$obj,array("params" => &$rows));
				else
					call_user_func($func,array("params" => &$rows));
				
				if (!$continue)
					break;
			}
			
			foreach ($rows as $row)	
			{
				// apply php level formatter for image url 30.12.10
				foreach($this->options["colModel"] as $c)
				{
					$col_name = str_replace(".","::",$c["name"]);
					
					if (isset($c["default"]) && !isset($row[$col_name]))
						$row[$col_name] = $c["default"];

					// link data in grid to any given url
					if (!empty($c["default"]))
					{
						// replace any param in link e.g. http://domain.com?id={id} given that, there is a $col["name"] = "id" exist
						foreach($this->options["colModel"] as $link_c)
						{
							$link_col_key = str_replace(".","::",$link_c["name"]);
							$link_row_data = urlencode($row[$link_col_key]);
							$c["default"] = str_replace("{".$link_c["name"]."}", $link_row_data, $c["default"]);
						}

						$r = true;
						if (!empty($c["condition"]))
							eval("\$r = ".$c["condition"].";");

						$row[$col_name] = ( $r ? $c["default"] : '');						
					}
					
					// link data in grid to any given url
					if (!empty($c["link"]))
					{
						// replace any param in link e.g. http://domain.com?id={id} given that, there is a $col["name"] = "id" exist
						foreach($this->options["colModel"] as $link_c)
						{
							$link_col_key = str_replace(".","::",$link_c["name"]);
							$link_row_data = $row[$link_col_key];
//							$link_row_data = urlencode($row[$link_col_key]);
							$c["link"] = str_replace("{".$link_c["name"]."}", $link_row_data, $c["link"]);
						}
						
						if (!empty($c["linkoptions"]))
							$attr = $c["linkoptions"];
						
						//$row1[$col_name] = "<a $attr href='{$c["link"]}'>{$row[$col_name]}</a>";
						
						//add by roshan
						if(empty( $c["linkName"]))
                            $row1[$col_name] = "<a $attr $V815be97d href='{$c["link"]}'>{$row[$col_name]}</a>";
						else 
							{
								if(	$row[$col_name]==$c["linkName"])
									$row1[$col_name] = "<a $attr $V815be97d href='{$c["link"]}'>{$row[$col_name]}</a>";	
								else
									$row1[$col_name] = $row[$col_name];
							}
                    }
						// end line of newly added
						
						
					// render row data as "src" value of <img> tag
					if (isset($c["formatter"]) && $c["formatter"] == "image")
					{
						$attr = array();
						foreach($c["formatoptions"] as $k=>$v)
							$attr[] = "$k='$v'";
						
						$attr = implode(" ",$attr);
						$row[$col_name] = "<img $attr src='".$row[$col_name] ."'>";
					}
						
					// show masked data in password
					if (isset($c["formatter"]) && $c["formatter"] == "password")
						$row[$col_name] = "*****";
										
				}
				
				foreach($this->options["colModel"] as $col) { 
									if (!empty($col["link"])) {  
										$row[$col['name']] = $row1[$col['name']];
									}
				}
							
				foreach($row as $k=>$r)
					$row[$k] = stripslashes($row[$k]);
				
				$responce->rows[] = $row;
			}
			
			echo json_encode($responce);
			die;
		}		
		
		// few overides - pagination fixes
		$this->options["pager"] = '#'.$grid_id."_pager";
		$this->options["jsonReader"] = array("repeatitems" => false, "id" => "0");

		// allow/disallow edit,del operations
		if ($this->actions["edit"] === false || $this->actions["delete"] === false || $this->options["cellEdit"] === true)
			$this->actions["rowactions"] = false;
			
		if ($this->actions["rowactions"] !== false)
		{
			// CRUD operation column
			$f = false;
			$defined = false;
			foreach($this->options["colModel"] as &$c)
			{
				if ($c["name"] == "act")
				{
					$defined = &$c;
				}
					
				if (!empty($c["width"]))
				{
					$f = true;
				}
			}
			
			// width adjustment for row actions column
			if ($f)
				$action_column = array("name"=>"act", "align"=>"center", "index"=>"act", "width"=>"30", "sortable"=>false, "search"=>false);
			else
				$action_column = array("name"=>"act", "align"=>"center", "index"=>"act", "sortable"=>false, "search"=>false);

			if (!$defined)
			{
				$this->options["colNames"][] = "Actions";
				$this->options["colModel"][] = $action_column;
			}
			else
				$defined = array_merge($action_column,$defined);
		}		

		$out = json_encode_jsfunc($this->options);
		$out = substr($out,0,strlen($out)-1);

		// create Edit/Delete - Save/Cancel column in grid
		if ($this->actions["rowactions"] !== false)
		{
			$out .= ",'gridComplete': function(){
						var ids = jQuery('#$grid_id').jqGrid('getDataIDs');
						for(var i=0;i < ids.length;i++){
							var cl = ids[i];
							
							be = ' <a title=\"Edit this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').editRow(\''+cl+'\',true); jQuery(this).parent().hide(); jQuery(this).parent().next().show(); \">Edit</a>'; 
							de = ' | <a title=\"Delete this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').delGridRow(\''+cl+'\'); \">Delete</a>';
							
							se = ' <a title=\"Save this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').saveRow(\''+cl+'\'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Save</a>'; 
							ce = ' | <a title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').restoreRow(\''+cl+'\'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancel</a>'; 
							
							if (ids[i] == 'new_row')
							{
								se = ' <a title=\"Save this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#{$grid_id}_ilsave\').click(); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Save</a>'; 
								ce = ' | <a title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#{$grid_id}_ilcancel\').click(); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancel</a>'; 
								jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<span style=display:none id=\"edit_row_'+cl+'\">'+be+de+'</span>'+'<span id=\"save_row_'+cl+'\">'+se+ce+'</span>'});
							}
							else
							jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<span id=\"edit_row_'+cl+'\">'+be+de+'</span>'+'<span style=display:none id=\"save_row_'+cl+'\">'+se+ce+'</span>'});
						}	
					}";
					
			/*
			// theme buttons -- not looking good
			$out .= ",'gridComplete': function(){
						var ids = jQuery('#$grid_id').jqGrid('getDataIDs');
						for(var i=0;i < ids.length;i++){
							var cl = ids[i];
							be = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Edit this row\" onclick=\"jQuery(\'#$grid_id\').editRow('+cl+',true); jQuery(this).parent().hide(); jQuery(this).parent().next().show(); \">Edit <span class=\"ui-icon ui-icon-pencil\"></span></a>'; 
							de = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Delete this row\" onclick=\"jQuery(\'#$grid_id\').delRowData('+cl+'); \">Delete <span class=\"ui-icon ui-icon-close\"></span></a>';

							se = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Save this row\" onclick=\"jQuery(\'#$grid_id\').saveRow('+cl+'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Save <span class=\"ui-icon ui-icon-disk\"></span></a>'; 
							ce = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').restoreRow('+cl+'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancel <span class=\"ui-icon ui-icon-cancel\"></span></a>'; 
							
							jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<div style=\"white-space:nowrap;float:left\" id=\"edit_row_'+cl+'\">'+be+de+'</div>'+'<div style=\"white-space:nowrap;float:left;display:none;\" id=\"save_row_'+cl+'\">'+se+ce+'</div>'});
						}	
					}";
			*/
		}					
		
		// double click editing option
		if ($this->actions["edit"] !== false && $this->options["cellEdit"] !== true)
		{
			$out .= ",'ondblClickRow':function(id)
						{
							if(id && id!==lastSel){ 
								jQuery('#$grid_id').restoreRow(lastSel); 
								
								// disabled previously edit icons
								jQuery('#edit_row_'+lastSel).show();
								jQuery('#save_row_'+lastSel).hide();								
								
								lastSel=id; 								
							}
							
							jQuery('#$grid_id').editRow(id, true, function(){}, function(){
																					jQuery('#edit_row_'+id).show();
																					jQuery('#save_row_'+id).hide();
																					return true;
																				},null,null,null,null,
																				function(){
																					jQuery('#edit_row_'+id).show();
																					jQuery('#save_row_'+id).hide();
																					return true;
																				}
														); 
							
							jQuery('#edit_row_'+id).hide();
							jQuery('#save_row_'+id).show();
						}";
		}
		
		// if subgrid is there, enable subgrid feature
		if (isset($this->options["subgridurl"]) && $this->options["subgridurl"] != '') 
		{
			// we pass two parameters
			// subgrid_id is a id of the div tag created within a table
			// the row_id is the id of the row
			// If we want to pass additional parameters to the url we can use
			// the method getRowData(row_id) - which returns associative array in type name-value
			// here we can easy construct the following
			
			$pass_params = "false";
			if (!empty($this->options["subgridparams"]))
				$pass_params = "true";
				
			$out .= ",'subGridRowExpanded': function(subgridid, id) 
											{ 
												var data = {subgrid:subgridid, rowid:id};
												
												if('$pass_params' == 'true') {
													var anm= '".$this->options["subgridparams"]."';
													anm = anm.split(',');
													var rd = jQuery('#".$grid_id."').jqGrid('getRowData', id);
													if(rd) {
														for(var i=0; i<anm.length; i++) {
															if(rd[anm[i]]) {
																data[anm[i]] = rd[anm[i]];
															}
														}
													}
												}
												jQuery('#'+jQuery.jgrid.jqID(subgridid)).load('".$this->options["subgridurl"]."',data);
											}";				
		}
		
		$out .= ",'onSelectRow': function(id) 
										{ 
											// on row selection operation
										}";		
		$out .= "}";

		// Geneate HTML/JS code
		ob_start();
		?>
			<table id="<?php echo $grid_id?>"></table> 
			<div id="<?php echo $grid_id."_pager"?>"></div> 
			<script>
			jQuery(document).ready(function(){
				<?php echo $this->render_js($grid_id,$out);?>
			});	
			</script>	
		<?php
		return ob_get_clean();
	}
	
	/**
	 * JS code related to grid rendering
	 */
	function render_js($grid_id,$out)
	{
	?>
		var lastSel;
		var grid_<?php echo $grid_id?> = jQuery("#<?php echo $grid_id?>").jqGrid(<?php echo $out?>);
		
		jQuery("#<?php echo $grid_id?>").jqGrid('navGrid','#<?php echo $grid_id."_pager"?>',
				{
					edit: <?php echo ($this->actions["edit"] === false)?"false":"true"?>,
					add: <?php echo ($this->actions["add"] === false)?"false":"true"?>,
					del: <?php echo ($this->actions["delete"] === false)?"false":"true"?>
				},
				<?php echo json_encode_jsfunc($this->options["edit_options"])?>,
				<?php echo json_encode_jsfunc($this->options["add_options"])?>,
				{},
				{multipleSearch:<?php echo ($this->actions["search"] == "advance")?"true":"false"?>, sopt:['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc','nu','nn']}
				);
		
				
		<?php if ($this->actions["inlineadd"] !== false) { ?>
		jQuery('#<?php echo $grid_id?>').jqGrid('inlineNav','#<?php echo $grid_id."_pager"?>',{"addtext":"Inline","edit":false,"save":true,"cancel":true,
		"addParams":{"aftersavefunc":function (id, res)
		{
			// set returned pk in new row of grid
			res = res.responseText.split("#");
			try {
				$(this).jqGrid('setCell', id, res[0], res[1]);
				$("#"+id, "#"+this.p.id).removeClass("jqgrid-new-row").attr("id",res[1] );
			} catch (asr) {}
			
			// but reload grid, to work properly
			jQuery('#<?php echo $grid_id?>').trigger("reloadGrid",[{page:1}]);
		}},"editParams":{"aftersavefunc":function (id, res)
		{
			// set returned pk in new row of grid
			res = res.responseText.split("#");
			try {
				$(this).jqGrid('setCell', id, res[0], res[1]);
				$("#"+id, "#"+this.p.id).removeClass("jqgrid-new-row").attr("id",res[1] );
			} catch (asr) {}

			// but reload grid, to work properly			
			jQuery('#<?php echo $grid_id?>').trigger("reloadGrid",[{page:1}]);
		}}});
		<?php } ?>
			
		<?php if ($this->actions["autofilter"] !== false) { ?>
		// auto filter
		jQuery("#<?php echo $grid_id?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 
		<?php } ?>

		<?php if ($this->actions["showhidecolumns"] !== false) { ?>
		// show/hide columns
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Columns",title:"Hide/Show Columns", buttonicon :'ui-icon-note',
			onClickButton:function(){
				jQuery("#<?php echo $grid_id?>").jqGrid('setColumns'); 
			} 
		});
		<?php } ?>
		
		<?php if ($this->actions["export"] === true) { ?>
		// Export to what is defined in file
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Export",title:"Export to Excel", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1";
			} 
		});
		<?php } ?>
			
		<?php if (isset($this->actions["export_excel"]) && $this->actions["export_excel"] === true) { ?>
		// Export to excel
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Excel",title:"Export to Excel", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1&export_type=excel";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1&export_type=excel";
			} 
		});
		<?php } ?>
			
		<?php if (isset($this->actions["export_pdf"]) && $this->actions["export_pdf"] === true) { ?>
		// Export to pdf
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"PDF",title:"Export to PDF", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1&export_type=pdf";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1&export_type=pdf";
			} 
		});		
		<?php } ?>
				
		function link_dtpicker(el)
		{
				setTimeout(function(){
					if(jQuery.ui) 
					{ 
						if(jQuery.ui.datepicker) 
						{ 
							jQuery(el).after('<button>Calendar</button>').next().button({icons:{primary: 'ui-icon-calendar'}, text:false}).css({'font-size':'69%'}).click(function(e){jQuery(el).datepicker('show');return false;});
							jQuery(el).datepicker({"disabled":false,"dateFormat":"yy-mm-dd"});
							jQuery('.ui-datepicker').css({'font-size':'69%'});
						} 
					}
				},100);
		}
		jQuery("#<?php echo $grid_id?>").jqGrid('gridResize',{});
	<?php
	}

	function prepare_sql($sql,$db)
	{
		if (strpos($db,"mssql") !== false)
		{
			$sql = preg_replace("/SELECT (.*) LIMIT ([0-9]+) OFFSET ([0-9]+)/i","select top ($2+$3) $1",$sql);
			#pr($sql,1);
		}
		return $sql;
	}
}

# In PHP 5.2 or higher we don't need to bring this in
if (!function_exists('json_encode')) 
{
	require_once 'JSON.php';
	function json_encode($arg)
	{
		global $services_json;
		if (!isset($services_json)) {
			$services_json = new Services_JSON();
		}
		return $services_json->encode($arg);
	}

	function json_decode($arg)
	{
		global $services_json;
		if (!isset($services_json)) {
			$services_json = new Services_JSON();
		}
		return $services_json->decode($arg);
	}
}

function pr($arr, $exit=0)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	
	if ($exit)
		die;
}

/**
 * Function to encode JS function reference from PHP array
 * http://www.php.net/manual/en/function.json-encode.php#105749
 */
function json_encode_jsfunc($input=array(), $funcs=array(), $level=0)
{
	foreach($input as $key=>$value)
	{
		if (is_array($value))
		{
			$ret = json_encode_jsfunc($value, $funcs, 1);
			$input[$key]=$ret[0];
			$funcs=$ret[1];
		}
		else
		{
			if (substr($value,0,8)=='function')
			{
				$func_key="#".uniqid()."#";
				$funcs[$func_key]=$value;
				$input[$key]=$func_key;
			}
		}
	}
  	if ($level==1)
	{
		return array($input, $funcs);
	}
  	else
	{
		$input_json = json_encode($input);
	  	foreach($funcs as $key=>$value)
		{
			$input_json = str_replace('"'.$key.'"', $value, $input_json);
		}
	  	return $input_json;
	}
}