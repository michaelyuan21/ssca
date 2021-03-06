<?php
set_error_handler("_err_handle");
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
define('INCL_DIR', APP_DIR.DS.'protected'.DS.'include');
$GLOBALS = require(APP_DIR.DS.'protected'.DS.'config.php');
require(INCL_DIR.DS.'functions.php');

if($GLOBALS['debug']){
	error_reporting(-1);
	ini_set("display_errors", "On");
}else{
	error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
	ini_set("display_errors", "Off");
	ini_set("log_errors", "On");
}

if(!empty($GLOBALS['rewrite'])){
	if( ($pos = strpos( $_SERVER['REQUEST_URI'], '?' )) !== false )
		parse_str( substr( $_SERVER['REQUEST_URI'], $pos + 1 ), $_GET );
	foreach($GLOBALS['rewrite'] as $rule => $mapper){
		if('/' == $rule)$rule = '';
		if(0!==stripos($rule, 'http://'))
			$rule = 'http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/\\') .'/'.$rule; 
		$rule = '/'.str_ireplace(array('\\\\', 'http://', '/', '<', '>',  '.'), 
			array('', '', '\/', '(?P<', '>\w+)', '\.'), $rule).'/i';                                           
		if(preg_match($rule, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $matchs)){
			$route = explode("/", $mapper); 
			
			if(isset($route[2])){
				list($_GET['m'], $_GET['c'], $_GET['a']) = $route;
			}else{
				list($_GET['c'], $_GET['a']) = $route;
			}
			foreach($matchs as $matchkey => $matchval){
				if(!is_int($matchkey))$_GET[$matchkey] = $matchval;
			}
			break;
		} 
	} 
}

$_REQUEST = array_merge($_POST, $_GET);
$__module     = isset($_REQUEST['m']) ? strtolower($_REQUEST['m']) : '';
$__controller = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : 'main';
$__action     = isset($_REQUEST['a']) ? strtolower($_REQUEST['a']) : 'index';

spl_autoload_register('inner_autoload');
function inner_autoload($class){
	GLOBAL $__module;
	$class = str_replace("\\","/",$class);
	foreach(array('model', 'include', 'controller'.(empty($__module)?'':DS.$__module)) as $dir){
		$file = APP_DIR.DS.'protected'.DS.$dir.DS.$class.'.php';
		if(file_exists($file)){
			include $file;
			return;
		}
		$phpfiles = glob(APP_DIR.DS.'protected'.DS.$dir.DS.'*.php');
		if(is_array($phpfiles)){
			$lowerfile = strtolower($file);
			foreach($phpfiles as $file){
				if(strtolower($file) === $lowerfile){
					include $file;
					return;
				}
			}
		}
	}
}

$controller_name = $__controller.'Controller'; 
$action_name = 'action'.$__action; 

session_name('CARINOFOOD');
session_start();

if(!empty($__module)){
	if(!is_available_classname($__module))_err_router("Err: Module '$__module' is not correct!");
	if(!is_dir(APP_DIR.DS.'protected'.DS.'controller'.DS.$__module))_err_router("Err: Module '$__module' is not exists!");
}
if(!is_available_classname($__controller))_err_router("Err: Controller '$controller_name' is not correct!");
if(!class_exists($controller_name, true))_err_router("Err: Controller '$controller_name' is not exists!");
if(!method_exists($controller_name, $action_name))_err_router("Err: Method '$action_name' of '$controller_name' is not exists!");

$controller_obj = new $controller_name();
$controller_obj->$action_name();

if($controller_obj->_auto_display){
	$auto_tpl_name = (empty($__module) ? '' : $__module.DS).$__controller.'_'.$__action.'.html';
	if(file_exists(APP_DIR.DS.'protected'.DS.'view'.DS.$auto_tpl_name))$controller_obj->display($auto_tpl_name);
}

function url($c = 'main', $a = 'index', $param = array()){
	if(is_array($c)){
		$param = $c;
		$c = $param['c']; unset($param['c']);
		$a = $param['a']; unset($param['a']);
	}
	$params = empty($param) ? '' : '&'.http_build_query($param);
	if(strpos($c, '/') !== false){
		list($m, $c) = explode('/', $c);
		$route = "$m/$c/$a";
		$url = $_SERVER["SCRIPT_NAME"]."?m=$m&c=$c&a=$a$params";
	}else{
		$m = '';
		$route = "$c/$a";
		$url = $_SERVER["SCRIPT_NAME"]."?c=$c&a=$a$params";
	}

	if(!empty($GLOBALS['rewrite'])){
		static $urlArray=array();
		if(!isset($urlArray[$url])){
			foreach($GLOBALS['rewrite'] as $rule => $mapper){
				$mapper = '/'.str_ireplace(array('/', '<a>', '<c>', '<m>'), 
					array('\/', '(?P<a>\w+)', '(?P<c>\w+)', '(?P<m>\w+)'), $mapper).'/i';
				
				if(preg_match($mapper, $route, $matchs)){
					$urlArray[$url] = str_ireplace(array('<a>', '<c>', '<m>'), array($a, $c, $m), $rule);
					if(!empty($param)){
						$_args = array();
						foreach($param as $argkey => $arg){
							$count = 0;
							$urlArray[$url] = str_ireplace('<'.$argkey.'>', $arg, $urlArray[$url], $count);
							if(!$count)$_args[$argkey] = $arg;
						}
						$urlArray[$url] = preg_replace('/<\w+>/', '', $urlArray[$url]).
							(!empty($_args) ? '?'.http_build_query($_args) : '');
					}
					
					if(0!==stripos($urlArray[$url], 'http://')) 
						$urlArray[$url] = 'http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/\\') .'/'.$urlArray[$url];
					$rule = str_ireplace(array('<m>', '<c>', '<a>'), '', $rule);
					if(count($param) == preg_match_all('/<\w+>/is', $rule, $_match)){
						return $urlArray[$url];
					}
					break;
				}
			}
			return isset($urlArray[$url]) ? $urlArray[$url] : $url;
		}
		return $urlArray[$url];
	}
	return $url;
}

function dump($var, $exit = false){
	$output = print_r($var, true);
	if(!$GLOBALS['debug'])return error_log(str_replace("\n", '', $output));
	echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head><body><div align=left><pre>" .htmlspecialchars($output). "</pre></div></body></html>";
	if($exit) exit();
}

function is_available_classname($name){
	return preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $name);
}

function arg($name = null, $default = null, $trim = false) {
	if($name){
		if(!isset($_REQUEST[$name]))return $default;
		$arg = $_REQUEST[$name];
		if($trim)$arg = trim($arg);
	}else{
		$arg = $_REQUEST;
	}
	return $arg;
}

class Controller{
	public $layout;
	public $_auto_display = true;
	private $_v;
	private $_data = array();

	public function init(){}
	public function __construct(){$this->init();}
	public function __get($name){return $this->_data[$name];}
	public function __set($name, $value){$this->_data[$name] = $value;}
	
	public function display($tpl_name, $return = false){
		if(!$this->_v){
			$compile_dir = isset($GLOBALS['view']['compile_dir']) ? $GLOBALS['view']['compile_dir'] : APP_DIR.DS.'protected'.DS.'tmp';
			$this->_v = new View(APP_DIR.DS.'protected'.DS.'view', $compile_dir);
		}
		$this->_v->assign(get_object_vars($this));
		$this->_v->assign($this->_data);
		if($this->layout){ 
			$this->_v->assign('__template_file', $tpl_name);
			$tpl_name = $this->layout; 
		}
		$this->_auto_display = false; 
		
		if($return){
			return $this->_v->render($tpl_name);
		}else{
			echo $this->_v->render($tpl_name);
		}
	}
}

class Model{
	public $page;
	public $table_name;
	
	private $sql = array();
	
	public function __construct($table_name = null){if($table_name)$this->table_name = $table_name;}
	public function findAll($conditions = array(), $sort = null, $fields = '*', $limit = null){
		$sort = !empty($sort) ? ' ORDER BY '.$sort : '';
		$conditions = $this->_where($conditions);

		$sql = ' FROM '.$this->table_name.$conditions["_where"];
		if(is_array($limit)){
			$total = $this->query('SELECT COUNT(*) as M_COUNTER '.$sql, $conditions["_bindParams"]);
			if(!isset($total[0]['M_COUNTER']) || $total[0]['M_COUNTER'] == 0)return false;
			
			$limit = $limit + array(1, 10, 10);
			$limit = $this->pager($limit[0], $limit[1], $limit[2], $total[0]['M_COUNTER']);
			$limit = empty($limit) ? '' : ' LIMIT '.$limit['offset'].','.$limit['limit'];			
		}else{
			$limit = !empty($limit) ? ' LIMIT '.$limit : '';
		}
		return $this->query('SELECT '. $fields . $sql . $sort . $limit, $conditions["_bindParams"]);
	}
	
	public function find($conditions = array(), $sort = null, $fields = '*'){
		$res = $this->findAll($conditions, $sort, $fields, 1);
		return !empty($res) ? array_pop($res) : false;
	}
	
	public function update($conditions, $row){
		$values = array();
		foreach ($row as $k=>$v){
			$values[":M_UPDATE_".$k] = $v;
			$setstr[] = "`{$k}` = ".":M_UPDATE_".$k;
		}
		$conditions = $this->_where( $conditions );
		return $this->execute("UPDATE ".$this->table_name." SET ".implode(', ', $setstr).$conditions["_where"], $conditions["_bindParams"] + $values);
	}

	public function incr($conditions, $field, $optval = 1){
		$conditions = $this->_where( $conditions );
		return $this->execute("UPDATE ".$this->table_name." SET `{$field}` = `{$field}` + :M_INCR_VAL ".$conditions["_where"], $conditions["_bindParams"] + array(":M_INCR_VAL" => $optval));
	}
	public function decr($conditions, $field, $optval = 1){return $this->incr($conditions, $field, - $optval);}
	
	public function delete($conditions){
		$conditions = $this->_where( $conditions );
		return $this->execute("DELETE FROM ".$this->table_name.$conditions["_where"], $conditions["_bindParams"]);
	}
	
	public function create($row){
		$values = array();
		foreach($row as $k=>$v){
			$keys[] = "`{$k}`"; $values[":".$k] = $v; $marks[] = ":".$k;
		}
		$this->execute("INSERT INTO ".$this->table_name." (".implode(', ', $keys).") VALUES (".implode(', ', $marks).")", $values);
		return $this->dbInstance($GLOBALS['mysql'], 'master')->lastInsertId();
	}
	
	public function findCount($conditions){
		$conditions = $this->_where( $conditions );
		$count = $this->query("SELECT COUNT(*) AS M_COUNTER FROM ".$this->table_name.$conditions["_where"], $conditions["_bindParams"]);
		return isset($count[0]['M_COUNTER']) && $count[0]['M_COUNTER'] ? $count[0]['M_COUNTER'] : 0;
	}
	
	public function dumpSql(){return $this->sql;}
	
	public function pager($page, $pageSize = 10, $scope = 10, $total){
		$this->page = null;
		if($total > $pageSize){
			$total_page = ceil($total / $pageSize);
			$page = min(intval(max($page, 1)), $total);
			$this->page = array(
				'total_count' => $total, 
				'page_size'   => $pageSize,
				'total_page'  => $total_page,
				'first_page'  => 1,
				'prev_page'   => ( ( 1 == $page ) ? 1 : ($page - 1) ),
				'next_page'   => ( ( $page == $total_page ) ? $total_page : ($page + 1)),
				'last_page'   => $total_page,
				'current_page'=> $page,
				'all_pages'   => array(),
				'offset'      => ($page - 1) * $pageSize,
				'limit'       => $pageSize,
			);
			$scope = (int)$scope;
			if($total_page <= $scope ){
				$this->page['all_pages'] = range(1, $total_page);
			}elseif( $page <= $scope/2) {
				$this->page['all_pages'] = range(1, $scope);
			}elseif( $page <= $total_page - $scope/2 ){
				$right = $page + (int)($scope/2);
				$this->page['all_pages'] = range($right-$scope+1, $right);
			}else{
				$this->page['all_pages'] = range($total_page-$scope+1, $total_page);
			}
		}
		return $this->page;
	}
	
	public function query($sql, $params = array()){return $this->execute($sql, $params, true);}
	public function execute($sql, $params = array(), $readonly = false){
		$this->sql[] = $sql;

		if($readonly && !empty($GLOBALS['mysql']['MYSQL_SLAVE'])){
			$slave_key = array_rand($GLOBALS['mysql']['MYSQL_SLAVE']);
			$sth = $this->dbInstance($GLOBALS['mysql']['MYSQL_SLAVE'][$slave_key], 'slave_'.$slave_key)->prepare($sql);
		}else{
			$sth = $this->dbInstance($GLOBALS['mysql'], 'master')->prepare($sql);
		}
		
		if(is_array($params) && !empty($params)){
			foreach($params as $k => &$v){
				if(is_int($v)){
					$data_type = PDO::PARAM_INT;
				}elseif(is_bool($v)){
					$data_type = PDO::PARAM_BOOL;
				}elseif(is_null($v)){
					$data_type = PDO::PARAM_NULL;
				}else{
					$data_type = PDO::PARAM_STR;
				}
				$sth->bindParam($k, $v, $data_type);
			}
		}

		if($sth->execute())return $readonly ? $sth->fetchAll(PDO::FETCH_ASSOC) : $sth->rowCount();
		$err = $sth->errorInfo();
		err('Database SQL: "' . $sql. '", ErrorInfo: '. $err[2], 1);
	}
	
	public function dbInstance($db_config, $db_config_key, $force_replace = false){
		if($force_replace || empty($GLOBALS['mysql_instances'][$db_config_key])){
			try {
				$GLOBALS['mysql_instances'][$db_config_key] = new PDO('mysql:dbname='.$db_config['MYSQL_DB'].';host='.$db_config['MYSQL_HOST'].';port='.$db_config['MYSQL_PORT'], $db_config['MYSQL_USER'], $db_config['MYSQL_PASS'], array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES \''.$db_config['MYSQL_CHARSET'].'\''));
			}catch(PDOException $e){err('Database Err: '.$e->getMessage());}
		}
		return $GLOBALS['mysql_instances'][$db_config_key];
	}
	
	private function _where($conditions){
		$result = array( "_where" => " ","_bindParams" => array());
		if(is_array($conditions) && !empty($conditions)){
			$fieldss = array(); $sql = null; $join = array();
			if(isset($conditions[0]) && $sql = $conditions[0]) unset($conditions[0]);
			foreach( $conditions as $key => $condition ){
				if(substr($key, 0, 1) != ":"){
					unset($conditions[$key]);
					$conditions[":".$key] = $condition;
				}
				$join[] = "`{$key}` = :{$key}";
			}
			if(!$sql) $sql = join(" AND ",$join);

			$result["_where"] = " WHERE ". $sql;
			$result["_bindParams"] = $conditions;
		}
		return $result;
	}
}

class View{
	private $left_delimiter, $right_delimiter, $template_dir, $compile_dir;
	private $template_vals = array();
	
	public function __construct($template_dir, $compile_dir, $left_delimiter = '<{', $right_delimiter = '}>'){
		$this->left_delimiter = $left_delimiter; 
		$this->right_delimiter = $right_delimiter;
		$this->template_dir = $template_dir;     
		$this->compile_dir  = $compile_dir;
	}
	
	public function render($tempalte_name){
		$complied_file = $this->compile($tempalte_name);
		
		@ob_start();
		extract($this->template_vals, EXTR_SKIP);
		$_view_obj = & $this;
		include $complied_file;
		
		return ob_get_clean();
	} 
	
	public function assign($mixed, $val = ''){
        if(is_array($mixed)){
            foreach($mixed as $k => $v){
                if($k != '')$this->template_vals[$k] = $v;
            }
        }else{
            if($mixed != '')$this->template_vals[$mixed] = $val;
        }
	}

	public function compile($tempalte_name){
		$file = $this->template_dir.DS.$tempalte_name;
		if(!file_exists($file)) err('Err: "'.$file.'" is not exists!');
		if(!is_writable($this->compile_dir) || !is_readable($this->compile_dir)) err('Err: Directory "'.$this->compile_dir.'" is not writable or readable');

		$complied_file = $this->compile_dir.DS.md5(realpath($file)).'.'.filemtime($file).'.'.basename($tempalte_name).'.php';
		if(file_exists($complied_file))return $complied_file;

		$template_data = file_get_contents($file); 
		$template_data = $this->_compile_struct($template_data);
		$template_data = $this->_compile_function($template_data);
		$template_data = '<?php if(!class_exists("View", false)) exit("no direct access allowed");?>'.$template_data;
		
		$this->_clear_compliedfile($tempalte_name);
		$tmp_file = $complied_file.uniqid('_tpl', true);
		if (!file_put_contents($tmp_file, $template_data)) err('Err: File "'.$tmp_file.'" can not be generated.');

		$success = @rename($tmp_file, $complied_file);
		if(!$success){
			if(is_file($complied_file)) @unlink($complied_file);
			$success = @rename($tmp_file, $complied_file);
		}
		if(!$success) err('Err: File "'.$complied_file.'" can not be generated.');
		return $complied_file;
	}

	private function _compile_struct($template_data){
		$foreach_inner_before = '<?php $_foreach_$3_counter = 0; $_foreach_$3_total = count($1);?>';
		$foreach_inner_after  = '<?php $_foreach_$3_index = $_foreach_$3_counter;$_foreach_$3_iteration = $_foreach_$3_counter + 1;$_foreach_$3_first = ($_foreach_$3_counter == 0);$_foreach_$3_last = ($_foreach_$3_counter == $_foreach_$3_total - 1);$_foreach_$3_counter++;?>';
		$pattern_map = array(
			'<{\*([\s\S]+?)\*}>'      => '<?php /* $1*/?>',
			'(<{((?!}>).)*?)(\$[\w\_\"\'\[\]]+?)\.(\w+)(.*?}>)' => '$1$3[\'$4\']$5',
			'(<{.*?)(\$(\w+)@(index|iteration|first|last|total))+(.*?}>)' => '$1$_foreach_$3_$4$5',
			'<{(\$[\S]+?)\snofilter\s*}>'          => '<?php echo $1; ?>',
			'<{(\$[\w\_\"\'\[\]]+?)\s*=(.*?)\s*}>'           => '<?php $1 =$2; ?>',
			'<{(\$[\S]+?)\s*}>'          => '<?php echo htmlspecialchars($1, ENT_QUOTES, "UTF-8"); ?>',
			'<{if\s*(.+?)}>'          => '<?php if ($1) : ?>',
			'<{else\s*if\s*(.+?)}>'   => '<?php elseif ($1) : ?>',
			'<{else}>'                => '<?php else : ?>',
			'<{break}>'               => '<?php break; ?>',
			'<{continue}>'            => '<?php continue; ?>',
			'<{\/if}>'                => '<?php endif; ?>',
			'<{foreach\s*(\$[\w\.\_\"\'\[\]]+?)\s*as(\s*)\$([\w\_\"\'\[\]]+?)}>' => $foreach_inner_before.'<?php foreach( $1 as $$3 ) : ?>'.$foreach_inner_after,
			'<{foreach\s*(\$[\w\.\_\"\'\[\]]+?)\s*as\s*(\$[\w\_\"\'\[\]]+?)\s*=>\s*\$([\w\_\"\'\[\]]+?)}>'  => $foreach_inner_before.'<?php foreach( $1 as $2 => $$3 ) : ?>'.$foreach_inner_after,
			'<{\/foreach}>'           => '<?php endforeach; ?>',
			'<{include\s*file=(.+?)}>'=> '<?php include $_view_obj->compile($1); ?>',
		);
		$pattern = $replacement = array();
		foreach($pattern_map as $p => $r){
			$pattern = '/'.str_replace(array("<{", "}>"), array($this->left_delimiter.'\s*','\s*'.$this->right_delimiter), $p).'/i';
			$count = 1;
			while($count != 0){
				$template_data = preg_replace($pattern, $r, $template_data, -1, $count);
			}
		}
		return $template_data;
	}
	
	private function _compile_function($template_data){
		$pattern = '/'.$this->left_delimiter.'([\w_]+)\s*(.*?)'.$this->right_delimiter.'/';
		return preg_replace_callback($pattern, array($this, '_compile_function_callback'), $template_data);
	}
	
	private function _compile_function_callback( $matches ){
		if(empty($matches[2]))return '<?php echo '.$matches[1].'();?>';
		$sysfunc = preg_replace('/\((.*)\)\s*$/', '<?php echo '.$matches[1].'($1);?>', $matches[2], -1, $count);
		if($count)return $sysfunc;
		
		$pattern_inner = '/\b([\w_]+?)\s*=\s*(\$[\w"\'\]\[\-_>\$]+|"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"|\'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\')\s*?/'; 
		$params = "";
		if(preg_match_all($pattern_inner, $matches[2], $matches_inner, PREG_SET_ORDER)){
			$params = "array(";
			foreach($matches_inner as $m)$params .= '\''. $m[1]."'=>".$m[2].", ";
			$params .= ")";
		}else{
			err('Err: Parameters of \''.$matches[1].'\' is incorrect!');
		}
		return '<?php echo '.$matches[1].'('.$params.');?>';
	}

	private function _clear_compliedfile($tempalte_name){
		$dir = scandir($this->compile_dir);
		if($dir){
			$part = md5(realpath($this->template_dir.DS.$tempalte_name));
			foreach($dir as $d){
				if(substr($d, 0, strlen($part)) == $part){
					@unlink($this->compile_dir.DS.$d);
				}
			}
		}
	}
}
function _err_router($msg){
	Global $__module, $__controller, $__action;
	if(!method_exists('BaseController', 'err404')){
		err($msg);
	}else{
		BaseController::err404($__module, $__controller, $__action, $msg);
	}
}
function _err_handle($errno, $errstr, $errfile, $errline){
	if(0 === error_reporting())return false;
	$msg = "ERROR";
	if($errno == E_WARNING)$msg = "WARNING";
	if($errno == E_NOTICE)$msg = "NOTICE";
	if($errno == E_STRICT)$msg = "STRICT";
	if($errno == 8192)$msg = "DEPRECATED";
	err("$msg: $errstr in $errfile on line $errline");
}
function err($msg){
	$msg = htmlspecialchars($msg);
	$traces = debug_backtrace();
	if(!$GLOBALS['debug']){
		header('HTTP/1.1 500 Internal Server Error');
		if(!empty($GLOBALS['err_handler'])){
			call_user_func($GLOBALS['err_handler'], $msg, $traces);
		}else{
			error_log($msg);
		}
	}else{
		if (ob_get_contents()) ob_end_clean();
function _err_highlight_code($code){if(preg_match('/\<\?(php)?[^[:graph:]]/i', $code)){return highlight_string($code, TRUE);}else{return preg_replace('/(&lt;\?php&nbsp;)+/i', "", highlight_string("<?php ".$code, TRUE));}}
function _err_getsource($file, $line){if(!(file_exists($file) && is_file($file))) {return '';}$data = file($file);$count = count($data) - 1;$start = $line - 5;if ($start < 1) {$start = 1;}$end = $line + 5;if ($end > $count) {$end = $count + 1;}$returns = array();for($i = $start; $i <= $end; $i++) {if($i == $line){$returns[] = "<div id='current'>".$i.".&nbsp;"._err_highlight_code($data[$i - 1], TRUE)."</div>";}else{$returns[] = $i.".&nbsp;"._err_highlight_code($data[$i - 1], TRUE);}}return $returns;
}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="robots" content="noindex, nofollow, noarchive" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php echo $msg;?></title><style>body{padding:0;margin:0;word-wrap:break-word;word-break:break-all;font-family:Courier,Arial,sans-serif;background:#EBF8FF;color:#5E5E5E;}div,h2,p,span{margin:0; padding:0;}ul{margin:0; padding:0; list-style-type:none;font-size:0;line-height:0;}#body{width:918px;margin:0 auto;}#main{width:918px;margin:13px auto 0 auto;padding:0 0 35px 0;}#contents{width:918px;float:left;margin:13px auto 0 auto;background:#FFF;padding:8px 0 0 9px;}#contents h2{display:block;background:#CFF0F3;font:bold 20px;padding:12px 0 12px 30px;margin:0 10px 22px 1px;}#contents ul{padding:0 0 0 18px;font-size:0;line-height:0;}#contents ul li{display:block;padding:0;color:#8F8F8F;background-color:inherit;font:normal 14px Arial, Helvetica, sans-serif;margin:0;}#contents ul li span{display:block;color:#408BAA;background-color:inherit;font:bold 14px Arial, Helvetica, sans-serif;padding:0 0 10px 0;margin:0;}#oneborder{width:800px;font:normal 14px Arial, Helvetica, sans-serif;border:#EBF3F5 solid 4px;margin:0 30px 20px 30px;padding:10px 20px;line-height:23px;}#oneborder span{padding:0;margin:0;}#oneborder #current{background:#CFF0F3;}</style></head><body><div id="main"><div id="contents"><h2><?php echo $msg?></h2><?php foreach($traces as $trace){if(is_array($trace)&&!empty($trace["file"])){$souceline = _err_getsource($trace["file"], $trace["line"]);if($souceline){?><ul><li><span><?php echo $trace["file"];?> on line <?php echo $trace["line"];?> </span></li></ul><div id="oneborder"><?php foreach($souceline as $singleline)echo $singleline;?></div><?php }}}?></div></div><div style="clear:both;padding-bottom:50px;" /></body></html><?php }
	exit;
}
