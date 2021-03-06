<?php
/**
 * 专区配置信息
 */
return array (
		
	//专区适配设置	
	'DEFAULT_MODULE'	=> 'Hd90021',	//默认分组模块
	'AREA_CODE' 		=> '90021',		//地区编码
	'PARENT_MODULE'     => 'Hd',		//父类分组模块

	'DEBUG_MODE'		=> 1,			//debug模式，1-开启，0-关闭(正式上线请关闭)
	'PRO_KEY'			=> 'eduhipi',	//产品key
	
	//附件上传
	'UPFILE_ISREMOTE'	=> false,		//是否保存到远程文件服务器
	'UPFILE_FTP_SERVER'	=> '127.0.0.1',	//远程FTP服务器	
	'UPFILE_FTP_PROT'	=> '21',		//远程FTP端口
	'UPFILE_FTP_USER'	=> '',			//远程FTP帐号
	'UPFILE_FTP_PWD'	=> '',			//远程FTP密码
	'UPFILE_FTP_TIMEOUT'=> '90',		//远程FTP超时时间(默认90秒)	
	'UPFILE_LOCAL_PATH' => './upfiles',	//本地文件保存地址
	
    // 模版常量及常用资源访问路径设置
	'DEFAULT_THEME'     => 'v1',	//模板主题（此处一经修改，请同时修改TMPL_PARSE_STRING项下的各子项路径）	
	'TMPL_PARSE_STRING' => array (

		'__TITLE__' 	=> '掌世界嗨皮课堂', 		// 站点标题		
		'__COMMON__' 	=> '/static/v1/common',	//公共资源路径
		'__SD__'		=> '/static/v1/sd',	 	//标清公共资源路径
		'__HD__'		=> '/static/v1/hd',		//高清公共资源路径
		'__THEME__' 	=> '/static/v1', 		//分组模块资源路径
		'__UPFILE__'	=> 'http://localhost:8500/upfiles',	//附件访问地址,请使用绝对地址(正式环境不要使用localhost)
        '__CSSJS_VERSION__'=>'20140208173232',  //CSS和JS版本

	),
	
	//本地视频播放地址
	'RTSP_VIDEO_URL'	=> 'rtsp://192.168.0.5:8554/videos/',
	
	//首页成长指标配置参数(成长指标是针对早幼教龄段的用户)，0-关闭, 1-开启
	'OPEN_TARGET'	=>	0, 
	
	//与教育平台通讯参数
	'PLATFORM_URL'	=>	'http://localhost:8500',	//平台地址
	'CHECK_CODE'	=>	'2014edu!@#',					//校验码
	
	// pv地址 
	'PV_URL'		=>	'http://192.168.0.4:8231/remote/PvRemote/save_pv',
);
