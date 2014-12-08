
//各页面的按键数组,格式keyCodes[健值代码]= 'js代码';
var keyCodes = new Array(); 
var focusList = new Array('#focus','#a_back');


//执行按键操作
document.onkeydown =document.onkeypress = function (evt) {
	evt = evt ? evt : window.event;	
	var keyCode = evt.which ? evt.which : evt.keyCode;
	if(empty(keyCodes[keyCode])) return;  //未定义	
	eval(keyCodes[keyCode]);
    return false;
}



//获取某个页面元素
var $ = function(selector){
	if(!selector) return this;
	if(typeof selector === "string"){
		if(selector.charAt(0)=='#'){
			selector = selector.substr(1);
			return document.getElementById(selector);
		}else{
			return document.getElementsByTagName(selector);
		}
	}else{
		return selector;
	}
}

//添加window的onload事件
var addLoadEvent = function(func){
	var oldLoad = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldLoad();
			func();
		}
	}
}

//判断对象是否为空
var empty = function(obj){
	if(obj==undefined || obj==null || obj=="") return true;
	return false;
}

//更改图片
var changeImage = function(id,src){	
	$(id).src=src;
}

// 设置页面默认焦点 
var setDefFocus = function(){
	for(i=0; i<focusList.length; i++){
		obj = $(focusList[i]);
		if(obj!=undefined){
			addLoadEvent(obj.focus());
			return;
		}
	}
}

//设置页面固定焦点
var setFocus = function(name){
	var obj = $(name);
	obj.focus();
}

var setConn = function(url){
	$("#connfreame").src = url + "?t="  + (new Date().getTime());
}


