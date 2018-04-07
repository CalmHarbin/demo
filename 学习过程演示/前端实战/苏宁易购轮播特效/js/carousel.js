//轮播图插件,
//盒子类名,自动切换间隔时间,按钮颜色,是否有左右按钮(true有);
function carousel(box,time,color,cut){
	//替换多余空格
	color=color.replace(/(^rgb\()\s*(\d*,)\s*(\d*,)\s*(\d*\))/g,"$1$2 $3 $4");

	var wrap=document.getElementsByClassName(box)[0];
	var ul=wrap.children[0];
	var Uli=ul.children;
	var num=Uli.length;//有多少张图片
	var timer=null;//存储定时器返回值
	var times=null;//存储定时器返回值
	
	//复制第一张图片并添加ul中
	var li=Uli[0].cloneNode(true);
	var li1=Uli[num-1].cloneNode(true);
	ul.appendChild(li);//添加到最后
	ul.insertBefore(li1,Uli[0]);//添加到最前

	
	var width=Uli[0].offsetWidth;//一张图片的宽度
	ul.style.width=(num+2)*width+"px";
	ul.style.left=-width+"px";

	//创建按钮
	var ol=document.createElement("ol");
	for(var i=0;i<num;i++){
		var Oli=document.createElement("li");
		Oli.innerHTML=i+1;
		ol.appendChild(Oli);
	}
	wrap.appendChild(ol);

	HTMLElement.prototype.__defineGetter__("currentStyle", function () { //获取样式使用
	    return this.ownerDocument.defaultView.getComputedStyle(this, null); 
	});

	var Oli=wrap.children[1].children;//按钮
	//初始化按钮
	Oli[0].style.backgroundColor=color;
	var old=Oli[1].currentStyle.backgroundColor

	//运动函数,运动的对象和运动的位置
	function move(obj,site){
		if(Math.abs(obj.offsetLeft)<ul.offsetWidth){//防止错误
			var speed=50;//每次移动的距离
			//判断向左运动还是向右运动
			speed=Math.abs(obj.offsetLeft)<site?-speed:speed;

			clearInterval(times);
			times=setInterval(function(){//这个定时器和外面定时器不干扰
				//console.log("定时器"+times);
				var distance=site-Math.abs(obj.offsetLeft);//现在的位置距离目标位置的距离
				//console.log("差"+distance);
				obj.style.left=obj.offsetLeft+speed+"px";
				if(Math.abs(distance)<=Math.abs(speed)){
					//alert(1)
					//console.log("清除定时器"+times);
					clearInterval(times);//清除定时器,使之停止运动
					//alert(site);
					obj.style.left=-site+"px";//运动到目标位置
					//timer=setInterval(autoplay,time);
					//console.log(timer);
					//return;
				}

				if(Math.abs(obj.offsetLeft)==(num+1)*width){
					obj.style.left=-width+"px";//显示第一张
				}
				if(Math.abs(obj.offsetLeft)==0){
					obj.style.left=-width*num+"px";//显示第一张
				}
			},30);
		}else{
			clearInterval(times);
			obj.style.left=-width+"px";
		}
	}
	//自动轮播
	timer=setInterval(autoplay,time);
	function autoplay(){
		//判断当前是第几张
		//console.log(Math.abs(ul.offsetLeft)/width);
		var key=Math.ceil(Math.abs(ul.offsetLeft)/width);
		//使之运动
		//alert(width);
		//console.log(key);
		move(ul,(key+1)*width);
		//初始化按钮
		for(var i=0;i<num;i++){
			Oli[i].style.backgroundColor=old;
		}
		console.log(key);
		if(key==num){
			Oli[0].style.backgroundColor=color;
		}else{
			Oli[key].style.backgroundColor=color;
		}
	}
	//滑入滑出
	(function(){
		for(var i=0;i<num;i++){
			Uli[i].onmouseover=function(){
				clearInterval(timer);
			}
			Uli[i].onmouseout=function(){
				timer=setInterval(autoplay,time);
			}
			Oli[i].onmouseover=function(){
				clearInterval(timer);
			}
			Oli[i].onmouseout=function(){
				timer=setInterval(autoplay,time);
			}
		}
	})();
	//点击按钮
	(function(){
		for(var i=0;i<num;i++){
			Oli[i].onclick=function(){
				//判断当前点击的是第几个
				len=num;
				while(len){
					len-=1
					if(Oli[len]==this){
						idx=len;
					}
				}
				move(ul,(idx+1)*width);
				//初始化按钮
				for(var k=0;k<num;k++){
					Oli[k].style.backgroundColor=old;
				}
				Oli[idx].style.backgroundColor=color;
			}
		}
	})();

	//左右切换按钮
	if(cut==true){
		//创建按钮
		var btn1=document.createElement("button");
		var btn2=document.createElement("button");
		btn1.innerHTML="<";
		btn2.innerHTML=">";
		btn1.style.cssText="position:absolute;left:5px;top:50%;width:50px;height:100px;margin-top:-50px;background:"+old+";opacity:0.4;font-size:60px;text-align:center;line-height:100px;cursor:pointer";
		btn2.style.cssText="position:absolute;right:5px;top:50%;width:50px;height:100px;margin-top:-50px;background:"+old+";opacity:0.4;font-size:60px;text-align:center;line-height:100px;cursor:pointer";
		wrap.appendChild(btn1);
		wrap.appendChild(btn2);
		//点击切换函数
		var btn1=wrap.children[2];
		var btn2=wrap.children[3];
		btn1.onmouseover=function(){
			clearInterval(timer);
		}
		btn1.onmouseout=function(){
			timer=setInterval(autoplay,time);
		}
		btn2.onmouseover=function(){
			clearInterval(timer);
		}
		btn2.onmouseout=function(){
			timer=setInterval(autoplay,time);
		}
		btn1.onclick=function(){
			this.disabled="disabled";
			setTimeout(function(){btn1.disabled=""},1000);
			var len2=num;
			//判断当前的按钮
			while(len2){
				len2--;
				if(Oli[len2].currentStyle.backgroundColor==color){
					var idx2=len2;
				}
			}
			//初始化按钮
			for(var k=0;k<num;k++){
					Oli[k].style.backgroundColor=old;
				}

			if(idx2==0){
				move(ul,0);
				Oli[num-1].style.backgroundColor=color;
			}else{
				move(ul,idx2*width);
				Oli[idx2-1].style.backgroundColor=color;
			}
		}
		btn2.onclick=function(){
			this.disabled="disabled";//禁止连击
			setTimeout(function(){btn2.disabled=""},1000);
			var len2=num;
			while(len2){
				len2--;
				if(Oli[len2].currentStyle.backgroundColor==color){
					var idx2=len2;
				}
			}
			for(var k=0;k<num;k++){
					Oli[k].style.backgroundColor=old;
				}
			if(idx2==num-1){
				Oli[0].style.backgroundColor=color;
			}else{
				Oli[idx2+1].style.backgroundColor=color;
			}
			move(ul,(idx2+2)*width);
		}
	}
	var hiddenProperty = 'hidden' in document ? 'hidden' :    
        'webkitHidden' in document ? 'webkitHidden' :    
        'mozHidden' in document ? 'mozHidden' :    
        null;
    var visibilityChangeEvent = hiddenProperty.replace(/hidden/i, 'visibilitychange');
    var onVisibilityChange = function(){
        if (!document[hiddenProperty]) {
            timer=setInterval(autoplay,time);
        }else{
            clearInterval(timer);
            clearInterval(times);
        }
    }
    document.addEventListener(visibilityChangeEvent, onVisibilityChange);
}