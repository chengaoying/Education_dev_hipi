/**
 * 通用js基础库
 * 修改说明(在修改处标注修改说明)：
 *   格式：操作类型，时间，内容
 *   如：update/add，20141211，修改某某bug/增加某某功能
 */
var debug_mode = true;//调试模式，上线后必须把此参数改为false！

var	KEY_BACK 		 = 0x0008; 	// 返回/删除
var KEY_ENTER 		 = 0x000D; 	// 确定
var KEY_PAGE_UP		 = 0x0021;	// 上页
var KEY_PAGE_DOWN    = 0x0022;  // 下页
var KEY_LEFT		 = 0x0025;   // 左 
var	KEY_UP			 = 0x0026;   // 上
var KEY_RIGHT 		 = 0x0027;	// 右
var	KEY_DOWN 		 = 0x0028;	// 下
var KEY_0 			 = 0x0030;  // 0       
var KEY_1 			 = 0x0031;  // 1
var KEY_2 			 = 0x0032;  // 2
var KEY_3 			 = 0x0033;  // 3
var KEY_4 			 = 0x0034;  // 4
var KEY_5			 = 0x0035;  // 5
var KEY_6 			 = 0x0036;  // 6 
var KEY_7 			 = 0x0037;  // 7
var KEY_8 			 = 0x0038;  // 8
var KEY_9 			 = 0x0039;  // 9
var KEY_VOL_UP 		 = 0x0103; 	// Vol+，音量加
var KEY_VOL_DOWN 	 = 0x0104;	// Vol-，音量减
var	KEY_MUTE 		 = 0x0105;	// Mute，静音
var	KEY_TRACK 		 = 0x0106;	// Audio Track，切换音轨
var KEY_PLAY_PAUSE   = 0x0107;	// >||，播放，暂停
var KEY_FAST_FORWARD = 0x0108;	// >> ，快进
var	KEY_FAST_REWIND  = 0x0109;	// << ，快退
var KEY_IPTV_EVENT   = 0x0300;	// 虚拟事件按键

// 天津广电
var KEY_BACK_TJ      = 640;   //天津广电返回键
var KEY_PLAY_PAUSE_TJ = 0x0F18;
var KEY_DINGWEI = 271;

//新疆广电
var KEY_LEFT_XJ		 	= 3;   // 左 
var	KEY_UP_XJ			= 1;   // 上
var KEY_RIGHT_XJ 		= 4;	// 右
var	KEY_DOWN_XJ 		= 2;	// 下
var KEY_ENTER_XJ 		= 13; 	// 确定
var KEY_BACK_XJ      	= 340;   //新疆广电返回键

// PC
var KEY_W = 119;
var KEY_S = 115;
var KEY_A = 97;
var KEY_D = 100;

/**
 * 根据ID获取某个元素
 * @param id
 * @returns
 */
function G(id){return document.getElementById(id);}
/**
 * 显示一个元素
 * @param id
 */
function S(id)
{
	var temp = G(id);
	if(temp)
		temp.style.visibility = 'visible';
}
/**
 * 隐藏一个元素
 * @param id
 */
function H(id)
{
	var temp = G(id);
	if(temp)
		temp.style.visibility = 'hidden';
}

// 命名空间
var Epg = 
{
	/** 调用函数 */
	call: function(fn, args)
	{
		if(typeof fn == "string" && fn !== '')
		{
			return eval("("+fn+")");
		}
		else if(typeof fn == "function")
		{
			if(!this.isArray(args))
			{
				//首页，arguments不是标准的数组（是一个伪数组），所以直接arguments.slice(1)在电脑上都会报错
				//其次，标清机顶盒不支持Array.prototype.slice.call(arguments,1)的写法
				var temp=[];//注意，这里千万不要直接：args=[];然后对args操作，因为arguments存放的是args的引用，否则args会无限循环
				for(var i=1;i<arguments.length;i++)
					temp.push(arguments[i]);
				args=temp;
			}
			return fn.apply(window, args);
		}
	},
	
	getContextPath: function()
	{
		var contextPath = '/' + location.href.split('/')[3] + '/';
		return contextPath;
	},
	getParent: function()
	{
		return window==window.parent?window.top:window.parent;
	},
	isArray: function(o)
	{
		return ( (o instanceof Array) || (!this.isEmpty(o) && (typeof o!='string') && (typeof o.length==='number')) ); 
	},
	isEmpty: function(o)
	{
		if(undefined != o && o != null && o != "")
			return false;
		return true;
	},
};

// 自定义按钮
Epg.Button = Epg.btn =
{
	/** 初始化按钮 */
	init: function(defaultBtnId,buttons,initKeys)
	{
		var config = {defaultBtnId:defaultBtnId,buttons:buttons,initKeys:initKeys};
		if(config.initKeys)
		{
			Epg.key.init();
			Epg.key.set(
			{
				KEY_ENTER:'Epg.Button.click()',			//确定键
				KEY_LEFT:'Epg.Button.move("left")',		//左键
				KEY_RIGHT:'Epg.Button.move("right")',	//右键
				KEY_UP:'Epg.Button.move("up")',			//上键
				KEY_DOWN:'Epg.Button.move("down")',		//下键
				KEY_BACK:'Epg.Button.defBack()',		//返回键
				KEY_BACK_TJ:'Epg.Button.defBack()',		//返回键
				KEY_BACK_XJ:'Epg.Button.defBack()',		//返回键
				KEY_0:'Epg.Button.defBack()',			//按0返回
				KEY_A:'Epg.Button.move("left")',		//A
				KEY_D:'Epg.Button.move("right")',		//D
				KEY_W:'Epg.Button.move("up")',			//W
				KEY_S:'Epg.Button.move("down")',		//S
				KEY_LEFT_XJ:'Epg.Button.move("left")',		//左键
				KEY_RIGHT_XJ:'Epg.Button.move("right")',	//右键
				KEY_UP_XJ:'Epg.Button.move("up")',			//上键
				KEY_DOWN_XJ:'Epg.Button.move("down")',		//下键
				//KEY_ENTER_XJ:'Epg.Button.click()',			//确定键
			});
		}
		//alert('lala');
		this.previous = null,
		this._buttonStore = {};
		for(var i=0; i<config.buttons.length; i++)
		{
			var button = config.buttons[i];
			if(!button)//主要是为了适配IE7莫名其妙的问题
				continue;
			
			this._buttonStore[button.id] = button;
		}
		
		// 设置默认获得焦点的按钮
		if(typeof config.defaultBtnId=="string")
			this.current = this.get(config.defaultBtnId);
		else if(Epg.isArray(config.defaultBtnId))
		{
			for(var i=0,max=config.defaultBtnId.length; i<max; ++i)
			{
				var button = this.get(config.defaultBtnId[i]);
				if(button)
				{
					this.current = button;
					break;
				}
			}
		}
		
		this.update();
	},
	
	/** 获取按钮 */
	get: function(id)
	{
		if(id===undefined) //id如果不传，默认返回当前按钮
			id=this.current.id;
		if(G(id))
			return this._buttonStore[id];
	},
	
	/** 移动 */
	move: function(dir)
	{
		if(undefined == this.current[dir]) return; //update 20141213   修改bug:如果移动方向的值没设置，则不进行移动操作
		
		//add 20150117  添加方向键的翻页功能
		if(this.current[dir] == 'pageUp()' || this.current[dir] == 'pageDown()')
			Epg.call(this.current[dir], [this.current]);
		
		var button;
		var nextButtonId = this.current[dir];
		if(typeof nextButtonId == "string")//如果是字符串，强制改为数组，简化代码
			nextButtonId = [nextButtonId];
		if(Epg.isArray(nextButtonId))
		{
			for(var i=0; i<nextButtonId.length; i++)
			{
				button = this.get(nextButtonId[i]);
				if(button)
					break;
			}
			this.previous = this.current;
			if(button)
				this.current = button;
		}
		this.update();
	},
	
	/** 显示设置初始获得焦点的按钮 */
	set: function(buttonId)
	{
		this.previous = this.current;
		this.current = this.get(buttonId);
		this.update();
	},
	
	/** 点击确定按钮 */
	click: function(interceptor)
	{
		if(Epg.isEmpty(this.current.action)) //add 20141216  添加页面按钮默认的action函数
			this.current.action = "Epg.btn.defAction()";
		Epg.call(this.current.action, [this.current]);
	},
	
	
	/**
	 * add 20141216  添加页面默认的action操作
	 * 页面默认action操作（页面跳转），流程：
	 * 1.先获取按钮img标签的title属性（存放跳转地址）
	 * 2.如果img标签的title属性为空，则获取上层div的title属性值
	 */
	defAction: function(){
		var url = G(Epg.btn.current.id).title;
		if(Epg.isEmpty(url)) url = G('div_' + Epg.btn.current.id).title; 
		if(Epg.isEmpty(url)) return;
		Epg.jump(url);
	},
	
	/**
	 * add 20141218  添加页面默认的返回操作
	 * 方式一：页面添加一个隐藏的a标签，id="a_back",href="{$url}"
	 * 方式二：直接在页面重写Epg.key.set({KEY_BACK:"back()"})，js函数back中实现跳转
	 */
	defBack: function(){
		var url = G('a_back').href;
		if(Epg.isEmpty(url)) return;
		Epg.jump(url);
	},
	
	/** 更新 */
	update: function()
	{
		var prev = this.previous;
		var current = this.current;
		var size = 5;
		
		if(prev)
		{   
			if(prev.linkImage){
				G(prev.id).src = prev.linkImage;
			}else{
				//add 20141224 增加按钮放大缩小控制(按钮buttons中resize属性为-1则不进行放大缩小效果)
				if(Epg.isEmpty(prev.resize) || prev.resize != -1){ 
					G(prev.id).width  -= size;
					G(prev.id).height -= size;
				}
			}
			if(prev.selectBox){ //add 20141213    失去焦点后隐藏光标，并把光标的尺寸恢复到原始大小
				var selectBoxId = prev.id + '_focus';
				if(Epg.isEmpty(prev.resize) || prev.resize != -1){
					G(selectBoxId).width  -= size;
					G(selectBoxId).height -= size;
				}
				var divId = 'div_' + prev.id + '_focus';
				H(divId);
			}
			Epg.call(prev.blurHandler, [prev]); //add 20150112 增加按钮失去焦点处理功能
		}
		if(this.current)
		{
			if(current.focusImage){
				G(current.id).src = current.focusImage;
			}else{
				//add 20141224 增加按钮放大缩小控制(按钮buttons中resize属性为-1则不进行放大缩小效果)
				if(Epg.isEmpty(current.resize) || current.resize != -1){
					G(current.id).width  = parseInt(G(current.id).width) + size;
					G(current.id).height = parseInt(G(current.id).height) + size;
				}
			}
			if(current.selectBox){ //add 20141213    增加焦点框选中效果
				var selectBoxId = current.id + '_focus';
				G(selectBoxId).src = current.selectBox;
				if(Epg.isEmpty(current.resize) || current.resize != -1){
					G(selectBoxId).width  = parseInt(G(selectBoxId).width) + size;
					G(selectBoxId).height = parseInt(G(selectBoxId).height) + size;
				}
				var divId = 'div_' + current.id + '_focus';
				S(divId);
			}
			
			Epg.call(current.focusHandler, [current]); //add 20150112 增加按钮获取焦点处理功能
		}
	}
};

/**
 * 与遥控器按键相关的方法
 */
Epg.key=
{
	/**
	 * 所有与按键相关的方法都放在这里
	 */
	keys:
	{
		KEY_5:function(){if(debug_mode)location.reload();},	//如果是开发模式，按5刷新
		KEY_0:'Epg.Button.defBack()',
		KEY_BACK:'Epg.Button.defBack()',
	},
	
	
	/**
	 * 逐个添加获取批量添加按键配置
	 */
	set: function(obj)
	{
		if(typeof obj!=='object')
		{
			alert("添加批量按键配置的类型错误！");
			return;
		}
		for(var i in obj)
		{
			if(i.indexOf('KEY_')===0||i.indexOf('EVENT_')===0){//如果是“KEY_”或者“EVENT_”开头，视作按键
				this.keys[i]=obj[i];
			}	
		}
		return this;
	},
	
	/** 和set方法一个意思 */
	add: function(obj)
	{
		return this.set(obj);
	},
	
	/**
	 * 逐个删除或者批量删除按键配置
	 */
	del: function(obj)
	{
		if(typeof obj!=='object')
		{
			alert("删除批量按键配置的类型 错误！");
			return;
		}
		for(var i in obj)
		{
			if(this.keys[i])
				this.keys[i]='Epg.key.emptyFn()';
		}
		return this;
	},
	
	/** 空方法，用于删除时 */
	emptyFn: function(){},
	
	/**
	 * 初始化eventHandler，随便什么时候调用、调用一次即可
	 */
	init: function()
	{
		if(!Epg.eventHandler)//避免重复定义
		{	
			Epg.eventHandler = function(keycode)
			{
				for(var i in Epg.key.keys){
					if(keycode===window[i]){
						Epg.call(Epg.key.keys[i],keycode);
					}
				}
			};
		}
	}
};

/**
 * 通用弹窗：
 * @param info 提示信息
 * @param second 显示的秒数，默认3秒，如果为0那么永久显示
 * @param type 弹窗类型：1-无图片的提示信息，2-为有图片的提示信息，不设置则默认为1
 */
Epg.popup=function(info,second,type)
{
	if(Epg.isEmpty(info))//info为空时不产生任何效果
		return;
	second = second == undefined ? 3 : second;
	type = Epg.isEmpty(type) ? 1 : type;
	
	var popupId = '';
	if(type == 1){
		popupId = 'popup_1';
		G(popupId).innerHTML = info;
	}else{
		popupId = 'popup_2';
		var width = info.length * 30;
		var left = 560 - width/2;
		G('popup_2_info').style.width = width + "px";
		G('popup_2_info').style.left = left + "px";
		G('popup_2_info').innerHTML = info;
	}
	S(popupId);
	
	if(second>0)
	{
		if(Epg._popup_timer)//如果上次执行过setTimeout，那么强行停止
			clearTimeout(Epg._popup_timer);
		Epg._popup_timer=setTimeout('H("'+popupId+'")',second*1000);
	}
};


/**
 * 用于开发时控制台输出信息
 * @param info 
 */
Epg.debug = function(info)
{
	if(debug_mode && typeof console !== undefined && console.log)
		console.log(info);
};

/**
 * 分页方法
 * @param url 要跳转的url，页码必须是最后一个参数，且“=”结尾
 * @param idx 要跳转的页码
 * @param pageCount 总页数，只有下一页时才用到
 */
Epg.page=function(url,idx,pageCount)
{
	idx=parseInt(idx);
	if(idx<1)
		Epg.popup('已经是第一页了！');
	else if(pageCount!==undefined && idx>parseInt(pageCount))
		Epg.popup('已经是最后一页了！');
	else
		Epg.jump(url+idx);
};

/**
 * 跳转
 * @param href 要跳转的url
 * @param f 焦点按钮，默认当前按钮ID
 */
Epg.jump = function(href,f)
{
	window.location.href = href;
};

/**
 * 机顶盒不支持trim方法，故手动写一个
 */
Epg.trim = function(str)
{
	if(str)
		return str.replace(/^\s*(.*?)\s*$/g,'$1');
};

/**
 * 滚动字幕方法
 * add 20150122
 */
Epg.marquee =
{
	/**
	 * 将div里面的某段静态文字变成滚动字幕，add 20150122
	 * @param id div的ID
	 * @param max_length 最长的文字个数，这里忽略英文、数字和中文之间的差别，统一按个数来算
	 * @param amount 时间
	 * @param delay 延时
	 * @param dir 方向，默认left
	 * @param behavior 滚动方式，alternate为左右来回滚动，scroll为循环滚动
	 */
	start: function(max_length,id,amount,delay,dir,behavior)
	{
		max_length = max_length || 16;
		id = id || Epg.Button.current.id;
		amount = amount || 2;
		delay = delay || 50;
		dir = dir || 'left';
		behavior = behavior || 'alternate';
		if(!this.rollId)
		{
			var html = Epg.trim(G(id).innerHTML);
			if(max_length!==undefined&&html.length>max_length)
			{
				this.rollId = id;
				this.innerHTML = html;
				G(id).innerHTML = '<marquee id="'+id+'_marquee'+'" behavior="'+behavior+'" direction="'+dir+'" scrollamount="'+amount+'" scrolldelay="'+delay+'">'+html+'</marquee>';
			}
		}
	},
	/**
	 * 停止滚动字幕
	 */
	stop: function()
	{
		if(this.rollId)
		{
			G(this.rollId).innerHTML = this.innerHTML;
			this.rollId = undefined;
		}
	}
};


/*用于调试
 * @param info string 要输出的信息
 */
Epg.trace = function(info)
{
	window.location.href = "/Test/Index/debug?info="+info;
	return;
}

/** 事件处理 */
var event_handler = function(e)
{
	e = e || window.event;
	var keyCode = e.which || e.keyCode;
	if(keyCode==KEY_IPTV_EVENT)
	{
		eval("oEvent = " + Utility.getEvent());
		Epg.eventHandler(oEvent.type,true);
	}
	else
	{
		Epg.eventHandler(keyCode);
		//屏蔽浏览器默认的“返回键后退”功能，注意不能所有键都return false，否则连F5等常见按键也失效
		//注意：如果返回方法内部出错，那么浏览器默认方法将不能被屏蔽（测试于360急速浏览器下）
		if(keyCode === KEY_BACK || keyCode === KEY_BACK_XJ || keyCode === KEY_BACK_TJ)
			return false;
	}
};


//按键处理
//document.onkeydown = event_handler;
document.onkeypress = document.onkeydown = event_handler;
//增加别名
window.EPG = window.epg = Epg;


