//轮播图脚本  图片容器calss 图片li 按钮容器class  按钮标签
function lunbo(a,b,c,d){
	 //console.log(a)
	 var aSlide=document.getElementsByClassName(a)[0];      //获取slide
	 var aBtn=document.getElementsByClassName(c)[0];     //获取按钮
	 var aLi=aSlide.getElementsByTagName(b);       //获取li标签
	 var aSpan=aBtn.getElementsByTagName(d);  //获取span
	// console.log(aSlide)
	 aLi[0].style.opacity=1;          //初始化,让第一个li显示
     aSpan[0].style.background='#17210d';       //初始化,让第一个按钮span变色
	 var aSlength=aSpan.length;              //获取按钮个数
	 for(var i=0;i<aSlength;i++){         //遍历按钮
		  aSpan[i].I=i;                    //把i存贮到自定义属性I中
	      aSpan[i].onclick=function(){        //给按钮绑定点击事件
			  for(var j=0;j<aSlength;j++){       //遍历,初始化
				aLi[j].style.opacity=0;       //初始化li
		        aSpan[j].style.background='white';     //初始化按钮颜色
			  }
			 i=this.I;              //this指向aSpan[i],将它的自定义I属性的值  赋给i,即此时i等于上面的i
			 aLi[i].style.opacity=1;      //显示当前点击的li
		     aSpan[i].style.background='#17210d';    //改变当前点击的按钮颜色
		     }
	    
		 }
	 }