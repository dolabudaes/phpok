<?php
/**
 * 分享插件<后台应用>
 * @作者 phpok.com
 * @版本 6.0.007
 * @授权 http://www.phpok.com/lgpl.html PHPOK开源授权协议：GNU Lesser General Public License
 * @时间 2021年05月19日 09时47分
**/
class admin_shareto extends phpok_plugin
{
	public $me;
	public function __construct()
	{
		parent::plugin();
		$this->me = $this->_info();
	}
	
	/**
	 * 全局运行插件，在执行当前方法运行前，调整参数，如果不使用，请删除这个方法
	**/
	public function phpok_before()
	{
		//PHP代码;
	}
	
	/**
	 * 全局运行插件，在执行当前方法运行后，数据未输出前，如果不使用，请删除这个方法
	**/
	public function phpok_after()
	{
		//PHP代码;
	}
	
	/**
	 * 系统内置在</head>节点前输出HTML内容，如果不使用，请删除这个方法
	**/
	public function html_phpokhead()
	{
		//$this->_show("phpokhead.html");
	}
	
	/**
	 * 系统内置在</body>节点前输出HTML内容，如果不使用，请删除这个方法
	**/
	public function html_phpokbody()
	{
		//$this->_show("phpokbody.html");
	}
	
	/**
	 * 更新或添加保存完主题后触发动作，如果不使用，请删除这个方法
	 * @参数 $id 主题ID
	 * @参数 $project 项目信息，数组
	 * @返回 true 
	**/
	public function system_admin_title_success($id,$project)
	{
		//PHP代码;
	}
	
	
}