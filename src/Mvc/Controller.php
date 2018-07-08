<?php

namespace Webmis\Mvc;

class Controller{
	//模板变量
	private static $var = [];
	private static $getContent = '';

	/* 获取网址 */
	static function getUrl($url=''){
		$base_url = $_SERVER['SERVER_PORT']=='443'?'https://':'http://';
		$base_url .= $_SERVER['HTTP_HOST'].'/'.MODULE.'/'.$url;
		return $base_url;
	}

	/* 跳转页面 */
	static function redirect($url=''){
		header("Location: ".self::getUrl($url));
	}

	/* 设置参数 */
	static function setVar($name,$value=''){
		self::$var[$name] = $value;
	}

	/* 获取参数 */
	static function getVar($name){
		return self::$var[$name];
	}

	/*  视图 */
	static protected function view($file=''){
		$file = self::getPath().'View/'.$file.'.php';
		if(!is_file($file))die('视图：" '.$file.' "不存在！');
		// 参数
		foreach(self::$var as $key=>$val){$$key = $val;}
		// 加载视图
		ob_start();
		include $file;
		$ct=ob_get_contents();
		ob_end_clean();

		return $ct;
	}

	/* 加载模板视图 */
	static protected function setTemplate($template='',$file=''){
		$path = self::getPath();
		$template = $path.'View/layouts/'.$template.'.php';
		$file = $path.'View/'.$file.'.php';
		// 视图是否存在
		if(!is_file($template))die('模板视图：" '.$template.' "不存在！');
		if(!is_file($file))die('模板视图：" '.$file.' "不存在！');
		// 参数
		foreach(self::$var as $key=>$val){$$key = $val;}
		// 加载视图
		self::$getContent = $file;
		ob_start();
		include $template;
		$ct=ob_get_contents();
		ob_end_clean();

		return $ct;
	}

	/* 获取路径 */
	static private function getPath(){
		$arr=explode('\\',get_called_class());
		$arr[0]='';
		$arr[count($arr)-2]='';
		unset($arr[count($arr)-1]);
		return APP_PATH.implode('/',$arr);
	}
}