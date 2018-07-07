<?php

namespace Webmis\Mvc;

class Application{

	/* 配置信息 */
	private static $config=[];

	/*
	* 构造函数
	*/
	function __construct($config=[]){
		// 配置文件
		self::$config=$config;
		// 编码
		header('Content-type: text/html; charset='.self::$config['charset']);
		// 时区
		date_default_timezone_set(self::$config['timeZone']);
	}

	/*
	* 启动框架
	 */
	static function getContent(){
		$url = self::getUrl();
		// 安全防范
		$m = ucwords($url['m']);
		$c = ucwords($url['c']).'Controller';
		$a = $url['a'].'Action';
		// 控制器
		$c =self::$config['modules'][$url['m']]['namespace'].'\\'.$c;
		// 是否存在类
		if(!class_exists($c))die('类：" '.$c.' "不存在！');
		$app = new $c();
		// 是否存在函数
		if(!method_exists($app,$a))die('函数：" '.$a.' "不存在！');

		return $app->$a($url['p1'],$url['p2'],$url['p3']);
	}

	/*
	* 处理URL
	*/
	private static function getUrl(){
		// 拆分参数
		if(isset($_GET[self::$config['url']])){
			$url = array_values(array_filter(explode('/',$_GET[self::$config['url']])));
			unset($_GET[self::$config['url']]);
		}
		// 模块、控制器、函数
		return [
			'm'=>isset($url[0])?$url[0]:self::$config['module'],
			'c'=>isset($url[1])?$url[1]:self::$config['controller'],
			'a'=>isset($url[2])?$url[2]:self::$config['action'],
			'p1'=>isset($url[3])?$url[3]:'',
			'p2'=>isset($url[4])?$url[4]:'',
			'p3'=>isset($url[5])?$url[5]:'',
		];
	}

}
