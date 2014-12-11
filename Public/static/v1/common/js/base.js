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
var KEY_LEFT		 = 0x0025;  // 左
var	KEY_UP			 = 0x0026;  // 上
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
		return (o instanceof Array); 
	}
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
				KEY_BACK:'back()'						//返回键
			});
		}
		
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
		this.current = this.get(config.defaultBtnId);
		
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
		Epg.call(this.current.action, [this.current]);
	},
	
	/** 更新 */
	update: function()
	{
		var prev = this.previous;
		var current = this.current;
		if(prev)
		{
			if(prev.linkImage)
				G(prev.id).src = prev.linkImage;
		}
		if(current)
		{
			if(current.focusImage)
				G(current.id).src = current.focusImage;
		}
	}
};

/**
 * 用于开发时控制台输出信息
 * @param info 
 */
Epg.debug=function(info)
{
	if(debug_mode && typeof console !== 'undefined' && console.log)
		console.log(info);
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
		KEY_5:function(){if(debug_mode)location.reload();}//如果是开发模式，按5刷新
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
			alert("删除批量按键配置的类型错误！");
			return;
		}
		for(var i=0; i<obj.length; i++)
		{
			if(this.keys[obj[i]])
				this.keys[obj[i]]='Epg.key.emptyFn()';
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
				for(var i in Epg.key.keys)
					if(keycode===window[i])
						Epg.call(Epg.key.keys[i],keycode);
			};
		}
	}
};

/**
 * 机顶盒不支持trim方法，故手动写一个
 */
Epg.trim = function(str)
{
	if(str)
		return str.replace(/^\s*(.*?)\s*$/g,'$1');
};

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
		if(keyCode === KEY_BACK)
			return false;
	}
};

//按键处理
document.onkeypress = event_handler;

window.EPG = window.epg = Epg;//增加别名

