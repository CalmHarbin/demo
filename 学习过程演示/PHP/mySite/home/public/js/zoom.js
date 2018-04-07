//容器id,放大的倍数
function zoom(box,n){
	//获取样式所用
	HTMLElement.prototype.__defineGetter__("currentStyle", function () { //获取样式使用
	    return this.ownerDocument.defaultView.getComputedStyle(this, null); 
	});
	var boxVar=box;
	//获取容器
	 var box=document.getElementById(boxVar);
	 box.style.position="relative";
	 var img=box.firstElementChild;
	 var src=img.src;
	 var W=img.offsetWidth;
	 var H=img.offsetHeight;
	 var positionLeft=W+10;
	 var ImgW=n*W;
	 var ImgH=n*H;
	 //console.log(W);
	 //创建元素
	 var look=document.createElement("div");
	 look.class="look";
	look.style.cssText="position: absolute;left: 0;top: 0;width:150px;height:150px;background-color: rgba(255,255,255,.1);border: 5px solid #ddd;cursor: move;opacity: 0.5;z-index: 10;display:none;";
	// 
	var wrap=document.createElement("div");
	wrap.class="wrap";
	wrap.style.cssText="position: absolute;left: "+positionLeft+"px;top: 0px;width: "+W+"px;height: "+H+"px;overflow: hidden;display: none;z-index:1000;";
	var img=document.createElement("img");
	img.src=src;
	img.style.cssText="position: absolute;left: 0;top: 0;width:"+ImgW+"px;height:"+ImgH+"px;";
	//添加元素到容器中
	wrap.appendChild(img);
	box.appendChild(look);
	box.appendChild(wrap);

	var box=document.getElementById(boxVar);
	var look=box.lastChild.previousElementSibling;
	var wrap=box.lastChild;
	var wrapImg=wrap.firstElementChild;
	//console.log(wrap)
	
	//获取元素到文档的位置
	function offset(ele){
		if(ele.offsetParent.nodeName.toLowerCase()!=="body"){
			var obj=new Object();
			var eleParent=ele.offsetParent;
			obj.left=ele.offsetLeft+offset(eleParent).left;
			obj.top=ele.offsetTop+offset(eleParent).top;
			return obj;
		}else{
			var obj=new Object();
			obj.left=ele.offsetLeft;
			obj.top=ele.offsetTop;
			return obj;
		}
	}

	//跟随
	//document.body.onmousemove
	document.body.onmousemove=function(event){
		var e=e||event;
		var X=e.pageX;
		var Y=e.pageY;
		var left=offset(box).left;
		var top=offset(box).top;
		//box的大小
		var BW=box.clientWidth;
		var BH=box.clientHeight;
		var lookWidth=look.clientWidth;
		var lookHeight=look.clientHeight;

		if(0<X-left-lookWidth/2&&X-left-lookWidth/2<BW-160){
			//获取look距离容器的距离
			var Lx=look.offsetLeft;
			var Ly=look.offsetTop;
			wrap.firstElementChild.style.left=-(ImgW-W)*Lx/(BW-lookWidth)+"px";
			wrap.firstElementChild.style.top=-(ImgH-H)*Ly/(BH-lookHeight)+"px";

			look.style.left=X-left-lookWidth/2+"px";
		}else if(X<left||X>BW+left||Y<top||Y>BH+top){
			look.style.display="none";
			wrap.style.display="none";
		}
		if(0<Y-top-lookHeight/2&&Y-top-lookHeight/2<BH-160){
			var Lx=look.offsetLeft;
			var Ly=look.offsetTop;
			wrap.firstElementChild.style.left=-(ImgW-W)*Lx/(BW-lookWidth)+"px";
			wrap.firstElementChild.style.top=-(ImgH-H)*Ly/(BH-lookHeight)+"px";

			look.style.top=Y-top-lookHeight/2+"px";
		}else if(X<left||X>BW+left||Y<top||Y>BH+top){
			look.style.display="none";
			wrap.style.display="none";
		}
		return false;
	}
	box.onmousemove=function(event){
		if(look.currentStyle.display==="none"){
			var box=document.getElementById(boxVar);
			var img=box.firstElementChild;
			var wrap=box.lastChild;
			wrap.firstElementChild.src=img.src
			var e=e||event;
			
			wrap.src=
			look.style.display="block";
			wrap.style.display="block";
			var X=e.offsetX;
			var Y=e.offsetY;
			var BoxWidth=box.clientWidth;
			var BoxHeight=box.clientHeight;
			var left=X;
			var top=Y;
			var right=BoxWidth-X;
			var bottom=BoxHeight-Y;
			var min=Math.min(left,top,right,bottom);
			switch (min){
				case left: 	look.style.left="0px";
							look.style.top=place(BoxHeight,Y)+"px";
					break;
				case top: 	look.style.left=place(BoxWidth,X)+"px";
							look.style.top="0px";
					break;

				case right: look.style.left=BoxWidth-160+"px";
							look.style.top=place(BoxHeight,Y)+"px";
					break;

				case bottom:look.style.left=place(BoxWidth,X)+"px";
							look.style.top=BoxHeight-160+"px";
					break;
			}
		}
		return false;
	};
	//方向,该方向的长度,该方向的坐标
	function place(length,coor){
		if(coor>0&&coor<75){
			return 0;
		}else if(coor>=75&&coor<=length-75){
			return coor-75;
		}else{
			return length-160;
		}
	}
}