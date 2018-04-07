	function drag(obj){
		obj.mousedown(function(e){//绑定鼠标按下事件
			var x=e.pageX-this.offsetLeft;//获取鼠标相对于对象的坐标
			var y=e.pageY-this.offsetTop;
			$(document).bind('mousemove',function(e){//鼠标移动事件
				obj.css({//更改left,top值
					'left':e.pageX-x+'px',//对象左上角坐标=现在鼠标坐标-鼠标相对于对象的坐标
					'top':e.pageY-y+'px'
					});
				return false;//阻止默认行为
			});
			$(document).bind('mouseup',function(){//鼠标弹起事件
				$(document).unbind();//取消绑定鼠标移动事件
			});
		})
	}	