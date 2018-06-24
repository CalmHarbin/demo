//自行实现jquery常用方法,大部分兼容性IE8以上,动画ie10及以上

function $(elements) {
    arguments.callee.ajax=new Function();
    //事件绑定
    function jqueryaddEvent(ele,event,callback){
        if(ele.addEventListener) {//所有主流浏览器，除了 IE 8 及更早 IE版本
            ele.addEventListener(event, callback);
        } else if (ele.attachEvent) {// IE 8 及更早 IE 版本
            ele.attachEvent("on"+event, callback);
        }
    }
    //事件移除
    function jqueryremoveEvent(ele,event,callback){

        if(ele.removeEventListener) {//所有主流浏览器，除了 IE 8 及更早 IE版本
            ele.removeEventListener(event, callback);
        } else if (ele.detachEvent) {// IE 8 及更早 IE 版本
            ele.detachEvent("on"+event, callback);
        }
    }
    //事件触发
    function jquerytrigger(ele,event){
        var e = document.createEvent("MouseEvents");
        e.initEvent(event, true, true);　//这里的click可以换成你想触发的行为
        ele.dispatchEvent(e);//这里的clickME可以换成你想触发行为的DOM结点
    }
    //选择器
    function jqueryquery(selector){
        //创建标签
        if(selector.charAt(0)==='<'){
            var div=document.createElement('div');//创建div标签
            div.innerHTML=selector;//将字符串转为dom节点
            var childrens=div.children;//获取到节点
            var arr=[];
            for(var i=0,len=childrens.length;i<len;i++){
                arr.push(childrens[i]);//存贮到数组中
            }
            return factory(arr);//返回jq对象
        }
        //获取元素
        var ele=document.querySelectorAll(selector);
        //如果找不到元素
        if(ele.length===0){
            return false;
        }
        //兼容ie,自行实现Array.from方法
        if (!Array.from) {
            Array.from=function(obj){
                var arr=[];
                for(var i=0;i<obj.length;i++){
                    arr.push(obj[i]);
                }

                return arr;
            }
        }
        //方法
        ele=factory(Array.from(ele))

        return ele;
    }
    //功能
    function factory(ele) {
        //构造函数  
        function jqFun(){  
            //这里就是写各种方法的地方 
            function next(ele){//获取下一个元素
                var nextArr=[];
                if(ele.nextElementSibling!==null){//如果有下一个兄弟
                    nextArr.push(ele.nextElementSibling);
                    nextArr=nextArr.concat(next(ele.nextElementSibling));
                }
                return nextArr;
            }
            function prev(ele){//获取上一个元素
                var prevArr=[];
                if(ele.previousElementSibling!==null){
                    prevArr.push(ele.previousElementSibling);
                    prevArr=prevArr.concat(prev(ele.previousElementSibling));
                }
                return prevArr;
            }
            //数组去重
            function distinct(arr){
                var setArr=[];
                arr.forEach(function(item){
                    if(setArr.indexOf(item)===-1){
                        setArr.push(item);
                    }
                })
                return setArr;
            }

            //ready函数,DOM文档加载完毕后 
            this.ready=function(callback){
                            jqueryaddEvent(this[0],'DOMContentLoaded',callback);
                        };

            //each方法,遍历
            this.each=function(callback){
                            if(typeof callback==='function'){
                                for(var i=0,len=this.length;i<len;i++){
                                    //执行回调函数
                                    callback.call(this[i],i,this);
                                }
                            }
                        }

            //html方法,//获取或者设置元素的内容         
            this.html=function(html){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                // 接受的参数
                                if(html===undefined){
                                    return this[0].innerHTML;//返回内容
                                }else if(typeof html==='string'){
                                    this[0].innerHTML=html;//设置内容
                                }else if(typeof html==='object'){//jq对象
                                    //dom对象转字符串
                                    var div=document.createElement('div');
                                    for(var i=0,len=html.length;i<len;i++){
                                        div.appendChild(html[i].cloneNode(true));
                                    }
                                    // console.log(div)
                                    this[0].innerHTML=div.innerHTML
                                }
                                
                                return this;//返回单个元素
                            }else{

                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    // 接受的参数
                                    if(html===undefined){
                                        return '请单个获取内容';//返回内容
                                    }else if(typeof html==='string'){
                                        this[n].innerHTML=html;//设置内容
                                    }else if(typeof html==='object'){

                                        //dom对象转字符串
                                        var div=document.createElement('div');
                                        for(var i=0,len=html.length;i<len;i++){
                                            div.appendChild(html[i]);
                                        }

                                        this[n].innerHTML=div.innerHTML
                                    }
                                    thiss.push(this[n]);
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }

            //val方法,设置或者获取元素的值
            this.val=function(str){
                        var length=this.length;//判断获取的是单个元素还是多个
                        if(length===1){
                            if(str===undefined){
                                return this[0].value;
                            }
                            this[0].value=str;
                            return this;//返回单个元素
                        }else{
                            var thiss=[];//储存多个元素
                            for(var n=0;n<length;n++){//遍历
                                if(str===undefined){
                                    return '请单个获取值';
                                }
                                this[n].value=str;
                                thiss.push(this[n]);
                            }
                            return factory(thiss);//返回多个元素
                        }
                    }

            //attr方法,获取或者设置元素的属性
            this.attr=function(key,val){
                            function attr(thisZ){
                                if(key===undefined){//获取属性
                                    return thisZ.attributes;
                                }else if(typeof key==='string'){//设置单个属性
                                    if(val===undefined){//获取单个属性
                                        return thisZ.getAttribute(key);//返回属性值
                                    }
                                    thisZ.setAttribute(key,val);
                                }else if(typeof key==='object'){//设置单个或者多个属性
                                    for(var idx in key){//遍历json,设置属性
                                        thisZ.setAttribute(idx,key[idx]);
                                    }
                                }
                                return thisZ;
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                return attr(this[0]);//返回单个元素
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    thiss.push(attr(this[n]));
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }

            //removeAttr方法,删除属性
            this.removeAttr=function(key){
                                var length=this.length;//判断获取的是单个元素还是多个
                                if(length===1){
                                    this[0].removeAttribute(key);//删除该属性
                                    return this;//返回单个元素
                                }else{
                                    var thiss=[];//储存多个元素
                                    factory(thiss);
                                    for(var n=0;n<length;n++){//遍历
                                        this[n].removeAttribute(key);//删除该属性
                                        thiss.push(this[n]);
                                    }
                                    return thiss;//返回多个元素
                                }
                            }

            //addClass方法,添加类
            this.addClass=function(str){//为了体积最小化,并没有考虑去掉重复的类
                                function addClass(thisZ){
                                    var oldClass=thisZ.getAttribute('class');//获取本身的class
                                    //判断自身有没有类
                                    if(oldClass===null){
                                        thisZ.setAttribute('class',str);//设置新的类
                                    }else{
                                        thisZ.setAttribute('class',oldClass+' '+str);//设置新的类
                                    }
                                }
                                var length=this.length;//判断获取的是单个元素还是多个
                                if(length===1){
                                    addClass(this[0]);
                                    return this;//返回单个元素
                                }else{
                                    var thiss=[];//储存多个元素
                                    for(var n=0;n<length;n++){//遍历
                                        addClass(this[n]);
                                        thiss.push(this[n]);
                                    }
                                    return factory(thiss);//返回多个元素
                                }
                            }
            //removeClass方法,删除类
            this.removeClass=function(str){
                                var length=this.length;//判断获取的是单个元素还是多个
                                
                                function removeClass(thisZ){
                                    var oldClass=thisZ.getAttribute('class');//获取本身的class
                                    //判断自身有没有类
                                    if(oldClass!==null){
                                        //将类分割为一个数组,
                                        var oldArr=oldClass.split(' ');
                                        var newArr=str.split(' ');
                                        // var len=arr.length;
                                        var len2=newArr.length;
                                        oldArr=oldArr.filter(function(item,idx){
                                                for(var j=0;j<len2;j++){
                                                    if(item!==newArr[j]){
                                                        return true;
                                                    }
                                                    return false;
                                                }
                                            })
                                        thisZ.setAttribute('class',oldArr.join(' '));//设置新的类
                                    }else{
                                        thisZ.setAttribute('class','');//设置新的类
                                    }
                                }
                                if(length===1){
                                    removeClass(this[0]);
                                    return this;//返回单个元素
                                }else{
                                    var thiss=[];//储存多个元素
                                    for(var n=0;n<length;n++){//遍历
                                        removeClass(this[n]);
                                        thiss.push(this[n]);
                                    }
                                    return factory(thiss);//返回多个元素
                                }
                            }
            //hasClass方法,判断类
            this.hasClass=function(str){
                            if(this.length!==1){
                                return '请单个判断';
                            }
                            var oldClass=this[0].getAttribute('class');//获取本身的class
                            //判断自己有没有类
                            if(oldClass===null){
                                return false;
                            }
                            //将类分割为一个数组,
                            var oldArr=oldClass.split(' ');
                            var newArr=str.split(' ');

                            var len2=newArr.length;
                            var isClass=null;//记录是否存在该类

                            oldArr.forEach(function(item,idx){
                                for(var j=0;j<len2;j++){
                                    if(item===newArr[j]){//如果相等则存在,不相等则不存在
                                        isClass=true;
                                    }else{
                                        isClass=false;
                                    }
                                }
                            })

                            return isClass;
                        }
            //css方法,添加或者修改样式
            this.css=function(key,val){  
                        var length=this.length;//判断获取的是单个元素还是多个
                        function css(thisZ){
                            if(typeof key==='string'){//设置单个样式
                                if(val===undefined){//获取单个属性
                                    var styles=null;

                                    //兼容性获取元素最终样式
                                    if(window.getComputedStyle) {
                                        styles = window.getComputedStyle(thisZ, null);
                                    }else{
                                        styles = thisZ.currentStyle;
                                    }

                                    return styles[key];
                                }
                                thisZ.style[key]=val;//设置单个样式
                            }else if(typeof key==='object'){//设置单个或者多个属性
                                for(var idx in key){//遍历json,设置属性
                                    thisZ.style[idx]=key[idx];
                                }
                            }
                            return thisZ;
                        }
                        if(length===1){
                            return css(this[0]);//返回单个元素
                        }else{
                            var thiss=[];//储存多个元素
                            factory(thiss);
                            for(var n=0;n<length;n++){//遍历
                                thiss.push(css(this[n]));
                            }
                            return thiss;//返回多个元素
                        }
                    }
            //append方法,元素内部后面添加元素
            this.append=function(ele){
                            function append(thisZ){
                                if(ele.constructor===HTMLDivElement){//js对象
                                    var ele2=ele.cloneNode(true);
                                    thisZ.appendChild(ele2);
                                }else if(typeof ele==='object'){//jq对象
                                    for(var i=0,len=ele.length;i<len;i++){
                                        var ele2=ele[i].cloneNode(true);
                                        thisZ.appendChild(ele2);
                                    }
                                }
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                append(this[0]);
                                return this;//返回单个元素
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    append(this[n]);
                                    thiss.push(this[n]);
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //prepend方法,元素内部前面添加
            this.prepend=function(ele){
                            function prepend(thisZ){
                                if(ele.constructor===HTMLDivElement){//js对象
                                    var ele2=ele.cloneNode(true);
                                    thisZ.insertBefore(ele2,thisZ.firstElementChild);
                                }else if(typeof ele==='object'){//jq对象
                                    for(var i=0,len=ele.length;i<len;i++){
                                        var ele2=ele[i].cloneNode(true);
                                        thisZ.insertBefore(ele2,thisZ.firstElementChild);  //在指定位置之前添加
                                    }
                                }
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                prepend(this[0]);
                                return this;//返回单个元素
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                     prepend(this[n]);
                                    thiss.push(this[n]);
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //after方法,在元素之后插入
            this.after=function(ele){
                            function after(thisZ){

                                if(ele.constructor===HTMLDivElement){//js对象
                                    var ele2=ele.cloneNode(true);
                                    thisZ.parentNode.insertBefore(ele,thisZ.nextElementSibling);
                                }else if(typeof ele==='object'){//jq对象
                                    for(var i=0,len=ele.length;i<len;i++){

                                        var ele2=ele[i].cloneNode(true);
                                        thisZ.parentNode.insertBefore(ele2,thisZ.nextElementSibling);
                                    }
                                }
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                after(this[0]);
                                return this;//返回单个元素
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){
                                    after(this[n]);
                                    thiss.push(this[n]);
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //before,在元素之前插入
            this.before=function(ele){
                            function before(thisZ){
                                if(ele.constructor===HTMLDivElement){//js对象
                                    var ele2=ele.cloneNode(true);
                                    thisZ.parentNode.insertBefore(ele2,thisZ);
                                }else if(typeof ele==='object'){//jq对象
                                    for(var i=0,len=ele.length;i<len;i++){
                                        var ele2=ele[i].cloneNode(true);
                                        thisZ.parentNode.insertBefore(ele2,thisZ);
                                    }
                                }
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                before(this[0]);
                                return this;//返回单个元素
                            }else{
                                var thiss=[];//储存多个元素
                                factory(thiss);
                                for(var n=0;n<length;n++){//遍历
                                    before(this[n]);
                                    thiss.push(this[n]);//把当前元素存在数组中
                                }
                                return thiss;//返回多个元素
                            }
                        }
            //remove,删除元素
            this.remove=function(){
                            var length=this.length;
                            if(length===1){
                                this[0].parentNode.removeChild(this[0]);
                            }else{
                                for(var n=0;n<length;n++){
                                    this[n].parentNode.removeChild(this[n]);
                                }
                            }
                        }
            //empty,清空元素
            this.empty=function(){
                            var length=this.length;
                            if(length===1){
                                this[0].innerHTML='';
                            }else{
                                for(var n=0;n<length;n++){
                                    this[n].innerHTML='';
                                }
                            }
                        }
            //replaceWith,替换换元素
            this.replaceWith=function(ele){
                                function replaceWith(thisZ){
                                    // console.log(ele)
                                    thisZ=$(thisZ);
                                    if(ele.constructor===HTMLDivElement){//js对象
                                        var ele2=ele.cloneNode(true);//复制当前元素
                                        thisZ.remove();//删除自己
                                    }else if(typeof ele==='object'){//jq对象
                                        for(var i=0,len=ele.length;i<len;i++){
                                            var ele2=ele[i].cloneNode(true);//复制当前元素
                                            thisZ.after(ele2);//先在自己后面添加元素
                                        }
                                        thisZ.remove();//删除自己
                                    }
                                }

                                if(typeof ele==='string'){//如果传来的是字符串
                                    ele=$(ele);//转为创建的节点
                                }

                                var length=this.length;
                                if(length===1){
                                    replaceWith(this[0]);
                                    return ele;//返回替换后的元素
                                }else{
                                    var eles=[];
                                    for(var n=0;n<length;n++){
                                        replaceWith(this[n]);
                                        eles.push(ele);
                                    }
                                    return factory(eles);
                                }
                            }
            //wrap方法,将元素包裹在指定元素中
            this.wrap=function(str){
                //创建出元素
                var ele=$(str).html(this);
                //拼接上原有的内容
                ele.html($(str).html()+ele.html());
                //替换
                this.replaceWith(ele);
                return ele;
            }
            //parent方法,返回直接父元素
            this.parent=function(ele){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                return factory(this[0].parentNode);
                            }else{
                                var thiss=[];//储存多个元素
                                var CurrentParent=null;//储存当前的父元素
                                for(var n=0;n<length;n++){//遍历
                                    if(CurrentParent!==this[n].parentNode){//如果同一个父元素不重复
                                        thiss.push(this[n].parentNode);//把当前元素存在数组中
                                    }
                                    CurrentParent=this[n].parentNode;
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //parents方法,返回所有父元素
            this.parents=function(){
                            //递归查找父元素
                            var arr=[];//储存父元素
                            function search(son){
                                if(son.parentNode.nodeType===1){//如果父元素存在,节点类型是1
                                    arr.push(son.parentNode);//存到数组中
                                    search(son.parentNode)//递归调用
                                }
                                return son.parentNode;//返回父元素
                            }

                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                search(this[0]);
                                return factory(arr);
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    //遍历去掉重复项
                                    //获取每个元素的所有父元素,再转为数组来遍历,过滤掉重复项
                                    Array.from($(this[n]).parents()).forEach(function(item){
                                        if(thiss.indexOf(item)==-1){
                                            thiss.push(item);
                                        }
                                    })
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //children方法,返回直接子元素
            this.children=function(){
                                
                                function children(thisZ){
                                    var childrens=thisZ.children;//当前元素的所有直接子元素
                                    
                                    for(var i=0,len=childrens.length;i<len;i++){
                                        arr.push(childrens[i]);
                                    }
                                }
                                var length=this.length;//判断获取的是单个元素还是多个

                                if(length===1){
                                    var arr=[];//储存jquery对象的孩子
                                    children(this[0]);
                                    return factory(arr);
                                }else{
                                    var thiss=[];//储存多个元素
                                    for(var n=0;n<length;n++){//遍历
                                        var arr=[];
                                        children(this[n]);
                                        //将所有的孩子合并到一个数组中
                                        thiss=thiss.concat(arr);
                                    }
                                    return factory(thiss);//返回多个元素
                                }
                            }
            //find方法,返回所有子元素,可指定返回子元素
            this.find=function(selector){
                            var arr=[];//存放所有的子元素
                            function searchChilds(parentEle){
                                var childrens=parentEle.children;
                                if(childrens[0]!==undefined){//表示还有子元素
                                    for(var i=0,len=childrens.length;i<len;i++){
                                        arr.push(searchChilds(childrens[i]));
                                    }
                                }
                                return parentEle;
                            }

                            function find(){
                                if(selector===undefined){//表示返回所有后代元素
                                    return factory(arr);
                                }else{//返回指定的元素
                                    var arr2=[];
                                    //如果找不到元素
                                    if($(selector)===false){
                                        return new Error('The element does not exist');//不存在该元素
                                    }
                                    //如果指定的是唯一元素
                                    if($(selector).length===1){
                                        for(var j=0,len2=arr.length;j<len2;j++){//遍历
                                            if($(selector)[0]===arr[j]){//如果含有该元素
                                                return $(selector);
                                            }
                                        }
                                        return new Error('Not Found');//不存在该元素
                                    }else{//不是唯一元素
                                        Array.from($(selector)).forEach(function(item){
                                            for(var j=0,len2=arr.length;j<len2;j++){
                                                if(item===arr[j]){//如何相等说明查找的是该元素
                                                    arr2.push(arr[j]);
                                                }
                                            }
                                        });
                                        return factory(arr2);
                                    }
                                }
                            }

                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                searchChilds(this[0]);
                                return find();//查找
                            }else{
                                var thiss=[];//储存多个元素

                                for(var n=0;n<length;n++){//遍历得到所有的子元素
                                    searchChilds(this[n]);
                                }
                                return find();//查找
                                
                            }
                        }
            //siblings方法,返回所有的同胞元素,可以指定的同胞
            this.siblings=function(selector){
                                function siblings(thisZ){
                                    var siblings=nextArr.concat(prevArr);//所有的兄弟
                                        //去掉重复项
                                        siblings=distinct(siblings)
                                    if(selector!==undefined){//如果指定兄弟

                                        if($(selector).length===1){//指定一个
                                            for(var i=0,len=siblings.length;i<len;i++){
                                                if(siblings[i]===$(selector)[0]){
                                                    return $(selector);
                                                }
                                            }
                                        }

                                        var selectSiblings=[];//储存选中的兄弟
                                        Array.from($(selector)).forEach(function(item){//指定多个
                                            for(var i=0,len=siblings.length;i<len;i++){
                                                if(siblings[i]===item){
                                                    selectSiblings.push(item);
                                                }
                                            }
                                        })
                                        return factory(selectSiblings);
                                    }
                                    //没有指定全部返回
                                    return factory(siblings)
                                }

                                var length=this.length;//判断获取的是单个元素还是多个
                                if(length===1){

                                    //先获取所有的兄弟元素
                                    var nextArr=next(this[0]);
                                    var prevArr=prev(this[0]);
                                    
                                    return siblings();
                                }else{
                                    var thiss=[];//储存多个元素
                                    var nextArr=[];//储存所有后面的兄弟
                                    var prevArr=[];//储存所有前面的兄弟
                                    for(var n=0;n<length;n++){//遍历
                                        //先获取所有的兄弟元素
                                        nextArr=nextArr.concat(next(this[n]));
                                        prevArr=prevArr.concat(prev(this[n]));
                                    }
                                    return siblings();
                                }
                            }
            //next方法,返回下一个兄弟
            this.next=function(){
                        var length=this.length;//判断获取的是单个元素还是多个
                        if(length===1){
                            return factory(this[0].nextElementSibling);
                        }else{
                            var thiss=[];//储存多个元素
                            for(var n=0;n<length;n++){//遍历
                                if(this[n].nextElementSibling!==null){//如果存在下一个
                                    thiss.push(this[n].nextElementSibling);
                                }
                            }
                            return factory(thiss);//返回多个元素
                        }
                    }
            //nextAll方法,后面所有的兄弟,可指定元素
            this.nextAll=function(selector){
                            function nextAll(){
                                var siblings=factory(nextArr);//所有的兄弟

                                if(selector!==undefined){//如果指定兄弟

                                    if($(selector).length===1){//指定一个
                                        for(var i=0,len=siblings.length;i<len;i++){
                                            if(siblings[i]===$(selector)[0]){
                                                return $(selector);
                                            }
                                        }
                                    }

                                    var selectSiblings=[];//储存选中的兄弟
                                    Array.from($(selector)).forEach(function(item){//指定多个
                                        for(var i=0,len=siblings.length;i<len;i++){
                                            if(siblings[i]===item){
                                                selectSiblings.push(item);
                                            }
                                        }
                                    })
                                    return factory(selectSiblings);
                                }
                                
                                return siblings;//没有指定全部返回
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===undefined){
                                //先获取所有的兄弟元素
                                var nextArr=next(this[0]);
                            }else{
                                var thiss=[];//储存多个元素
                                var nextArr=[];
                                for(var n=0;n<length;n++){//遍历
                                    //先获取所有的兄弟元素
                                    nextArr=nextArr.concat(next(this[n]));
                                }
                            }
                            //去重
                            nextArr=distinct(nextArr);
                            return nextAll();
                        }
            //prev方法,返回上一个兄弟
            this.prev=function(){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                return factory(this[0].previousElementSibling);
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    if(this[n].previousElementSibling!==null){//如果存在下一个
                                        thiss.push(this[n].previousElementSibling);
                                    }
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //prevAll方法,放前面所有的兄弟,可指定元素
            this.prevAll=function(selector){
                            function prevAll(){
                                var siblings=factory(prevArr);//所有的兄弟
                                if(selector!==undefined){//如果指定兄弟

                                    if($(selector).length===1){//指定一个
                                        for(var i=0,len=siblings.length;i<len;i++){
                                            if(siblings[i]===$(selector)[0]){
                                                return $(selector);
                                            }
                                        }
                                    }

                                    var selectSiblings=[];//储存选中的兄弟
                                    Array.from($(selector)).forEach(function(item){//指定多个
                                        for(var i=0,len=siblings.length;i<len;i++){
                                            if(siblings[i]===item){
                                                selectSiblings.push(item);
                                            }
                                        }
                                    })
                                    return factory(selectSiblings);
                                }
                                return siblings;//没有指定全部返回
                            }

                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===undefined){
                                //先获取所有的兄弟元素
                                var prevArr=prev(this);
                            }else{
                                var thiss=[];//储存多个元素
                                var prevArr=[];
                                for(var n=0;n<length;n++){//遍历
                                    //先获取所有的兄弟元素
                                    prevArr=prevArr.concat(prev(this[n]));
                                }
                            }
                            //去重
                            prevArr=distinct(prevArr);
                            return prevAll();
                        }
            //first方法,返回所匹配元素的第一个
            this.first=function(){
                            return factory(this[0]);
                        }
            //last方法,返回所匹配元素的最后一个
            this.last=function(){
                            return factory(this[this.length-1]);
                        }
            //eq方法,返回所匹配元素的指定索引个
            this.eq=function(idx){
                            return factory(this[idx]);
                        }
            //not方法,返回所匹配元素中除了这个元素
            this.not=function(ele){//接受该元素,或者该元素选择器,或者索引
                            function removeItem(arr,item){//从arr数组中删除item
                                [].forEach.call(arr,function(item1,idx){
                                    if(item1===item){
                                        arr.splice(idx,1);
                                    }
                                })
                            }
                            if(ele!==undefined){
                                if(typeof ele==='string'){//传来的是选择器
                                    var ele=$(ele);
                                    if(ele.length===1){//如果是单个元素
                                        var arr=[];
                                        for(var i=0,len=this.length;i<len;i++){
                                            if(this[i]!==ele[0]){
                                                arr.push(this[i])
                                            }
                                        }
                                        return factory(arr);
                                    }else{//多个元素
                                        for(var j=0,len2=ele.length;j<len2;j++){
                                            removeItem(this,ele[j]);//删除掉指定的元素
                                        }
                                        return this;
                                    }
                                        
                                }else if(typeof ele==='number'){//传来的是索引
                                    [].splice.call(this,ele,1)//删除该元素
                                    return this;
                                }else{//传来的是元素
                                    var arr=[];
                                    if(ele.length===1){//如果是单个元素
                                        for(var i=0,len=this.length;i<len;i++){
                                            if(this[i]!==ele[0]){
                                                arr.push(this[i])
                                            }
                                        }
                                        return factory(arr);
                                    }else{//多个元素

                                        for(var j=0,len2=ele.length;j<len2;j++){
                                            removeItem(this,ele[j]);//删除掉指定的元素
                                        }
                                        return this;
                                    }
                                        
                                }   
                            }else{
                                return this;
                            }
                        }
            this.clone=function(){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                return factory(this[0].cloneNode(true));
                            }else{
                                var thiss=[];//储存多个元素
                                for(var n=0;n<length;n++){//遍历
                                    thiss.push(this[n].cloneNode(true));
                                }
                                return factory(thiss);//返回多个元素
                            }
                        }
            //animate方法,动画,兼容性ie10以上
            var arr=[];//存贮执行过动画的元素
            this.animate=function(json,time,speed,callback){//样式,时间,速度,回调

                            // console.log(typeof speed==='function');
                            if(typeof speed==='function'||speed===undefined){//表示没有传速度,或者速度和回调都没传
                                var callback=speed;
                                speed='ease';//规定慢速开始，然后变快，然后慢速结束的过渡效果（cubic-bezier(0.25,0.1,0.25,1)）
                            }

                            //总计时间
                            function addTime(arr){
                                var time=0;
                                for(var i=1,len=arr.length;i<len;i++){
                                    time+=arr[i];
                                }
                                return time;
                            }

                            //返回当前的元素所在的数组
                            function current(item){
                                for(var i=0,len=arr.length;i<len;i++){
                                    if(arr[i][0]===item){
                                        return arr[i];
                                    }
                                }
                            }

                            function animate(thisZ){
                                var that=thisZ;
                                
                                
                                if(thisZ.style.transition===''||current(thisZ).isComplete){//一个新的元素或者没有未完成的动画

                                    //判断是不是一个新的元素
                                    var isNew=true;
                                    arr.forEach(function(item){
                                        if(item[0]===thisZ){//表示已经注册过动画
                                            isNew=false;
                                        }
                                    })

                                    if(isNew){//是一个新的元素
                                        var thisarr=[thisZ];//创建自己的数组,第一项为自己
                                        thisarr.isComplete=false;//记录了该元素的动画是否执行完成了
                                        thisarr.push(time);//储存时间
                                        arr.push(thisarr);//储存数组
                                    }

                                    //执行动画
                                    factory(thisZ).css('transition','all '+time/1000+'s '+speed+'');
                                    
                                    //延时一下,防止过渡还未加上,二样式已经加上了
                                    setTimeout(function(){
                                        factory(thisZ).css(json);
                                    },20);
                                    
                                    current(thisZ).isComplete=false;//动画未完成
                                    
                                    //闭包,防止异步造成that错误
                                    (function(that){
                                        //动画完成的回调函数
                                        setTimeout(function(){
                                            // //清除过渡
                                            // that.css({
                                            //  transition:'all 0s ease 0s'
                                            // });
                                            that.style.transition="";
                                            //动画已完成
                                            current(that).isComplete=true;
                                            //动画完成之后删除自己的储存时间
                                            current(that).splice(1,1);
                                            //执行回调
                                            if(typeof callback==='function'){
                                                callback.call(that);//执行回调函数
                                            }
                                        },time);
                                    }(that))
                                        
                                }else{//前面有未完成的动画,需要等待
                                    
                                    for(var i=0,len=arr.length;i<len;i++){
                                        
                                        if(arr[i][0]===thisZ){

                                            //储存时间
                                            arr[i].push(time);

                                            //闭包,防止异步造成that错误
                                            (function(that){
                                                //时间为需要等待的时间,数组中的总时间-自己的时间
                                                setTimeout(function(){
                                                    //执行动画
                                                    factory(that).css('transition','all '+time/1000+'s '+speed+'');
                                                    factory(that).css(json);
                                                    current(that).isComplete=false;//动画未完成
                                                },addTime(arr[i])-time);

                                                //动画完成的回调函数
                                                setTimeout(function(){
                                                    //清除过渡
                                                    that.style.transition="";
                                                    //动画完成之后删除自己的储存时间
                                                    current(that).splice(1,1);
                                                    //动画已完成
                                                    current(that).isComplete=true;
                                                    //执行回调
                                                    if(typeof callback==='function'){
                                                        callback.call(that);//执行回调函数
                                                    }
                                                },addTime(arr[i]));
                                            }(that))    
                                        }
                                    }       
                                }
                            }

                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                animate(this[0]);
                            }else{//多个元素动画
                                for(var n=0;n<length;n++){//遍历
                                    animate(this[n]);
                                }
                            }
                            return this;//返回自己
                        }
            //show方法,显示,时间毫秒,数字
            this.show=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=0;
                            }
                            function show(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')!=='none'){
                                    return;
                                }
                                //记录宽度,高度,透明度
                                var opacity=thisZ.css('opacity');
                                var height=thisZ.css('height');
                                var width=thisZ.css('width');
                                that.style.overflow='hidden';
                                //去除内联的display:none
                                for(var i=0,len=that.style.length;i<len;i++){
                                    if(that.style[i]==='display'){
                                        that.style.display="";
                                    }
                                }
                                //如何样式为none则改为block
                                if(thisZ.css('display')==='none'){
                                    thisZ.css('display','block');
                                }
                                thisZ.animate({//先初始化
                                    opacity:0,
                                    width:0,
                                    height:0
                                },0).animate({//执行动画
                                    opacity:opacity,
                                    width:width,
                                    height:height
                                },time,function(){
                                    that.style.opacity="";
                                    that.style.width="";
                                    that.style.height="";
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                })
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                show(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    show(this[n]);
                                }
                            }
                            return this;
                        }
            //hide方法,隐藏,时间毫秒,数字
            this.hide=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=0;
                            }
                            
                            function hide(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')==='none'){
                                    return;
                                }
                                //先记录宽度高度透明度
                                var opacity=thisZ.css('opacity');
                                var height=thisZ.css('height');
                                var width=thisZ.css('width');
                                var display=thisZ.css('display');
                                that.style.overflow='hidden';
                                //执行动画隐藏
                                thisZ.animate({
                                    display:display,
                                    opacity:opacity,
                                    height:height,
                                    width:width
                                },0).animate({
                                    opacity:0,
                                    height:0,
                                    width:0
                                },time,function(){
                                    //隐藏完成后将元素去掉,并且还原宽度高度和透明度
                                    // that.css({
                                    //  display:'none',
                                    //  opacity:opacity,
                                    //  height:height,
                                    //  width:width
                                    // })
                                    that.style.display='none';
                                    that.style.opacity='';
                                    that.style.height='';
                                    that.style.width='';
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                })
                            }
                            
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                hide(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    hide(this[n]);
                                }
                            }
                            return this;
                        }
            //fadeIn方法,淡入,默认300毫秒
            this.fadeIn=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=300;
                            }
                            
                            function fadeIn(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')!=='none'){
                                    return;
                                }
                                //去除内联的display:none
                                for(var i=0,len=that.style.length;i<len;i++){
                                    if(that.style[i]==='display'){
                                        that.style.display="";
                                    }
                                }
                                //如何样式为none则改为block
                                if(thisZ.css('display')==='none'){
                                    thisZ.css('display','block');
                                }
                                that.style.overflow='hidden';
                                //先记录宽度高度透明度
                                // console.log('淡入')
                                var opacity=thisZ.css('opacity');
                                //执行动画隐藏
                                thisZ.animate({
                                    opacity:0
                                },0).animate({
                                    opacity:opacity
                                },time,function(){
                                    that.style.opacity='';
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                })
                            }
                            
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===1){
                                fadeIn(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    fadeIn(this[n]);
                                }
                            }
                            return this;
                        }
            //fadeOut方法,淡出,默认300毫秒
            this.fadeOut=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=300;
                            }
                            
                            function fadeOut(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')==='none'){
                                    return;
                                }
                                //先记录宽度高度透明度
                                var opacity=thisZ.css('opacity');
                                var height=thisZ.css('height');
                                var width=thisZ.css('width');
                                var display=thisZ.css('display');
                                that.style.overflow='hidden';

                                //执行动画隐藏
                                thisZ.animate({
                                    display:display,
                                    opacity:opacity
                                },0).animate({
                                    opacity:0
                                },time,function(){
                                    //隐藏完成后将元素去掉,并且还原宽度高度和透明度
                                    that.style.display='none';
                                    that.style.opacity='';
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                })
                            }
                            
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===undefined){
                                fadeOut(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    fadeOut(this[n]);
                                }
                            }
                            return this;
                        }
            //slideDown方法,向下滑展开,时间毫秒,默认300毫秒
            this.slideDown=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=300;
                            }
                            function slideDown(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')!=='none'){
                                    return;
                                }
                                //去除内联的display:none
                                for(var i=0,len=that.style.length;i<len;i++){
                                    if(that.style[i]==='display'){
                                        that.style.display="";
                                    }
                                }
                                //如何样式为none则改为block
                                if(thisZ.css('display')==='none'){
                                    thisZ.css('display','block');
                                }
                                that.style.overflow='hidden';
                                
                                //记录初始高度
                                var height=thisZ.css('height');

                                //开始动画
                                thisZ.animate({
                                    height:0
                                },0).animate({
                                    height:height
                                },time,function(){
                                    that.style.height='';
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                });
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===undefined){
                                slideDown(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    slideDown(this[n]);
                                }
                            }
                            return this;
                        }
            //slideUp方法,向上滑收缩,时间毫秒,默认300毫秒
            this.slideUp=function(time,callback){
                            if(typeof time==='function'||time===undefined){
                                if(typeof time==='function'){
                                    callback=time
                                }
                                time=300;
                            }
                            function slideUp(thisZ){
                                var that=thisZ;//js对象
                                thisZ=factory(thisZ)//jq对象
                                if(thisZ.css('display')==='none'){
                                    return;
                                }
                                //记录初始高度
                                var height=thisZ.css('height');
                                var display=thisZ.css('display');
                                that.style.overflow='hidden';
                                //初始化
                                thisZ.animate({
                                    display:display,
                                    height:height
                                },0).animate({//动画开始
                                    height:0
                                },time,function(){
                                    that.style.display='none';
                                    that.style.height='';
                                    that.style.overflow='';
                                    //执行回调函数
                                    if(typeof callback==='function'){
                                        callback.call(that);//执行回调函数
                                    }
                                });
                            }
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(length===undefined){
                                slideUp(this[0]);
                            }else{
                                for(var n=0;n<length;n++){//遍历
                                    slideUp(this[n]);
                                }
                            }
                            return this;
                        }
            //click方法,点击事件
            this.click=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'click');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'click',callback);
                            }
                        }

            this.dblclick=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'dblclick');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'dblclick',callback);
                            }
                        }
            this.mousedown=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mousedown');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mousedown',callback);
                            }
                        }
            this.mouseup=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mouseup');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseup',callback);
                            }
                        }
            this.mousemove=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mousemove');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mousemove',callback);
                            }
                        }
            this.mouseover=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mouseover');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseover',callback);
                            }
                        }
            this.mouseenter=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mouseenter');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseenter',callback);
                            }
                        }
            this.mouseleave=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mouseleave');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseleave',callback);
                            }
                        }
            this.mouseout=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'mouseout');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseout',callback);
                            }
                        }
            this.focus=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'focus');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'focus',callback);
                            }
                        }
            this.blur=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'blur');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'blur',callback);
                            }
                        }
            this.change=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'change');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'change',callback);
                            }
                        }
            this.select=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'select');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'select',callback);
                            }
                        }
            this.submit=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'submit');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'submit',callback);
                            }
                        }
            this.keydown=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'keydown');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'keydown',callback);
                            }
                        }
            this.keyup=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'keyup');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'keyup',callback);
                            }
                        }
            this.hover=function(mouseoverCallback,mouseoutCallback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'mouseenter',mouseoverCallback);
                                jqueryaddEvent(this[n],'mouseleave',mouseoutCallback);
                            }
                        }
            this.scroll=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'scroll');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'scroll',callback);
                            }
                        }
            this.resize=function(callback){
                            var length=this.length;//判断获取的是单个元素还是多个
                            if(callback===undefined){//表示执行事件
                                for(var n=0;n<length;n++){//遍历
                                    jquerytrigger(this[n],'resize');
                                }
                                return;
                            }
                            for(var n=0;n<length;n++){//遍历
                                jqueryaddEvent(this[n],'resize',callback);
                            }
                        }
            //事件绑定多个事件用空格隔开,也可以传递数组
            this.on=function(events,callback){//事件,回调
                        var length=this.length;//判断获取的是单个元素还是多个
                        var that=this;
                        for(var n=0;n<length;n++){//遍历
                            if(typeof events==='string'){
                                var arr=events.split(' ');
                                arr.forEach(function(item){
                                    jqueryaddEvent(that[n],item,callback);
                                })
                            }else if(typeof events==='array'){
                                events.forEach(function(item){
                                    jqueryaddEvent(that[n],item,callback);
                                })
                            }
                        }
                    }
            this.off=function(events,callback){//事件,回调
                        var length=this.length;//判断获取的是单个元素还是多个
                        var that=this;
                        for(var n=0;n<length;n++){//遍历
                            if(typeof events==='string'){
                                var arr=events.split(' ');
                                arr.forEach(function(item){
                                    jqueryremoveEvent(that[n],item,callback);
                                })
                            }else if(typeof events==='array'){
                                events.forEach(function(item){
                                    jqueryremoveEvent(that[n],item,callback);
                                })
                            }
                        }
                    }
            //width方法,获取元素的宽度
            this.width=function(){
                            if(this.css('boxSizing')==='content-box'){
                                return parseFloat(this.css('width'));
                            }else if(this.css('boxSizing')==='border-box'){
                                return parseFloat(this.css('width'))-parseFloat(this.css('paddingLeft'))-parseFloat(this.css('paddingRight'))-parseFloat(this.css('borderLeftWidth'))-parseFloat(this.css('borderRightWidth'));
                            }
                        }
            //height方法,获取元素的高度
            this.height=function(){
                            if(this.css('boxSizing')==='content-box'){
                                return parseFloat(this.css('height'));
                            }else if(this.css('boxSizing')==='border-box'){
                                return parseFloat(this.css('height'))-parseFloat(this.css('paddingTop'))-parseFloat(this.css('paddingBottom'))-parseFloat(this.css('borderTopWidth'))-parseFloat(this.css('borderBottomWidth'));
                            }
                        }
            //innerWidth方法,获取元素的宽度,含paddding
            this.innerWidth=function(){

                                return this[0].clientWidth;
                            }
            //innerHeight方法,获取元素的高度,含padding
            this.innerHeight=function(){
                               
                                return this[0].clientHeight;
                            }
            //outerWidth方法,获取元素的宽度,含border+padding
            this.outerWidth=function(isTrue){//接受一个布尔值
                                if(isTrue===false||isTrue===undefined){
                                    return this[0].offsetWidth;
                                }else if(isTrue===true){
                                    return this[0].offsetWidth+parseFloat(this.css('marginLeft'))+parseFloat(this.css('marginRight'));
                                }else{
                                    return this;
                                }
                            }
            //outerHeigth方法,获取元素的高度,含border+padding
            this.outerHeight=function(isTrue){
                                if(isTrue===false||isTrue===undefined){
                                    return this[0].offsetHeight;
                                }else if(isTrue===true){
                                    return this[0].offsetHeight+parseFloat(this.css('marginTop'))+parseFloat(this.css('marginBottom'));
                                }else{
                                    return this;
                                }
                            }
            //offsetParent方法,获取最近具有定位属性的元素
            this.offsetParent=function(){

                                return factory(this[0].offsetParent);
                            }
            //offset方法,获取元素相对于文档的位置
            this.offset=function(){
                            var json={};
                            var left=0,
                                top=0;
                            //判断是不是文档
                            function isDocument(obj){
                                if(obj.offsetParent!==null){//如果自己不是body
                                    left+=obj.offsetLeft;//获取自己到具有定位属性的父元素的left
                                    top+=obj.offsetTop;//获取自己到具有定位属性的父元素的top
                                    isDocument(obj.offsetParent);
                                }
                                return;
                            }
                            //执行函数
                            isDocument(this[0]);

                            json.left=left;
                            json.top=top;
                            return json;
                        }
            //offsetParent方法,获取元素相对于具有定位属性的父元素或直接父元素的位置
            this.position=function(isTrue){
                            if(isTrue===true){//返回相对于父元素的位置
                                var json={};
                                json.left=this.offset().left-this.parent().offset().left-parseFloat(this.parent().css('borderLeftWidth'));
                                json.top=this.offset().top-this.parent().offset().top-parseFloat(this.parent().css('borderTopWidth'));
                                return json;
                            }else if(isTrue===undefined){//返回相对于具有定位属性的父元素的位置
                                var json={};
                                json.left=this[0].offsetLeft;
                                json.top=this[0].offsetTop;
                                return json;
                            }else{
                                return this;
                            }
                        }
            //scrollLeft方法,获取或设置水平滚动条
            this.scrollLeft=function(number,isSlide){
                                //带动画的设置
                                if(typeof number==='number'&&typeof isSlide!==undefined&&isSlide===true){
                                    //滚动到指定位置的函数
                                    function positionScroll(Y){//滚动到的位置
                                        if(Y>$(window).scrollLeft()){
                                            var timer=setInterval(function(){
                                                var scrollLeft=$(window).scrollLeft()+30;
                                                if($(window).scrollLeft()>Y){
                                                    clearInterval(timer);
                                                }
                                                $(window).scrollLeft(scrollLeft);
                                            },1000/60);
                                        }else{
                                            var timer=setInterval(function(){
                                                var scrollLeft=$(window).scrollLeft()-30;
                                                if($(window).scrollLeft()<Y){
                                                    clearInterval(timer);
                                                }
                                                $(window).scrollLeft(scrollLeft);
                                            },1000/60);
                                        }
                                    }
                                    positionScroll(number);
                                    return this;
                                }
                                //不带动画的设置
                                if(typeof number==='number'){
                                    if (document.documentElement && document.documentElement.scrollLeft){
                                        document.documentElement.scrollLeft=number;
                                    } else if (document.body) {
                                        document.body.scrollLeft=number;
                                    }
                                    return this;
                                }
                                //获取滚动条位置
                                var left=null;
                                if (document.documentElement && document.documentElement.scrollLeft){
                                    left = document.documentElement.scrollLeft;
                                } else if (document.body) {
                                    left = document.body.scrollLeft;
                                }
                                return left;
                            }
            //scrollTop方法,获取或设置垂直滚动条
            this.scrollTop=function(number,isSlide){
                                if(typeof number==='number'&&typeof isSlide!==undefined&&isSlide===true){
                                    //滚动到指定位置的函数
                                    function positionScroll(Y){//滚动到的位置
                                        if(Y>$(window).scrollTop()){
                                            var timer=setInterval(function(){
                                                var ScrollTop=$(window).scrollTop()+30;
                                                if($(window).scrollTop()>Y){
                                                    clearInterval(timer);
                                                }
                                                $(window).scrollTop(ScrollTop);
                                            },1000/60);
                                        }else{
                                            var timer=setInterval(function(){
                                                var ScrollTop=$(window).scrollTop()-30;
                                                if($(window).scrollTop()<Y){
                                                    clearInterval(timer);
                                                }
                                                $(window).scrollTop(ScrollTop);
                                            },1000/60);
                                        }
                                    }
                                    positionScroll(number);
                                    return this;
                                }
                                if(typeof number==='number'){
                                    if (document.documentElement && document.documentElement.scrollTop){
                                        document.documentElement.scrollTop=number;
                                    } else if (document.body) {
                                        document.body.scrollTop=number;
                                    }
                                    return this;
                                }
                                var top=null;
                                if (document.documentElement && document.documentElement.scrollTop){
                                    top = document.documentElement.scrollTop;
                                } else if (document.body) {
                                    top = document.body.scrollTop;
                                }
                                return top;
                            }

            

        }
        var obj = new jqFun();        //实例化一个对象
        if(ele instanceof Array){
            [].push.apply(obj,ele); //将对象压入数组，并改变数组的指向 
        }else{
            [].push.call(obj,ele); //将对象压入数组，并改变数组的指向 
        }
        // console.log(obj)
        return obj;     //将类数组对象返回  
    }

    if(typeof elements==='function'){//加载事件
        jqueryaddEvent(window,'load',elements)
    }else if(typeof elements==='string'){//选择器或者创建元素
        return jqueryquery(elements)
    }else if(typeof elements==='object'){//this
        return factory(elements);
    }
}
//ajax方法,http请求
/* url请求地址,
 * type请求类型为get,post,jsonp
 * data为携带的参数,json格式
 * dataType为jsonp时执行jsonp请求
 * success成功回调,参数为返回的数据
 * error失败回调,参数为http状态码
*/
$.success=null;//储存jsonp的成功回调
//jsonp回调函数
function jsonpCallback(res){//执行的回调函数
    $.success(res)//执行请求成功回调
}
$.ajax=function(json){
    json.type=json.type===undefined?'get':json.type.toLowerCase();//默认请求方式
    json.async=json.async&&true;//默认异步请求

    //jsonp跨域
    if(json.dataType==='jsonp'||json.type==='jsonp'){
        //动态创建script标签
        var script = document.createElement("script");
        //请求地址
        if(json.url.match(/\?/)===null){//不带参数的请求
            json.url=json.url+'?';
        }else{//带参数的请求
            json.url=json.url+'&';
        }

        script.src =json.url+'callback=jsonpCallback';//带上回调函数
        document.body.insertBefore(script, document.body.firstChild);
        //执行回调函数
        $.success=json.success;
    }else{
        //get请求,或者post请求
        var xhr=new XMLHttpRequest();//获取xhr对象
        if(typeof json.data==='object'){//带参数的请求
            var parameter='';
            for(var key in json.data){
                parameter+=key+'='+json.data[key]+'&';
            }
            parameter=parameter.slice(0,parameter.length-1);
            if(json.type==='get'){
                xhr.open('get',json.url+'?'+parameter,json.async);//请求  true表示异步请求
                xhr.send();//发送请求
                
            }
            if(json.type==='post'){
                xhr.open('post',json.url,json.async);//请求  true表示异步请求
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");

                xhr.send(parameter);//发送请求
            }
        }else{//不带参数的请求
            xhr.open(json.type,json.url,json.async);//请求  true表示异步请求
            if(json.type==='post'){
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
            }
            xhr.send();//发送请求
        }

        xhr.onreadystatechange=function(){//监听请求状态
            if(xhr.readyState==4){ //4表示请求已完成
                if(xhr.status===200){//请求成功
                    var data=xhr.responseText;//获取字符串形式的响应数据
                    json.success(data);
                }else{//请求失败
                    json.error(xhr.status);
                }
            }
        }
    }
}
//get请求
$.get=function(url,data,successCallback,errorCallback){//请求地址,参数,成功回调,失败回调
    if(typeof data==='function'){//无参数
        var xhr=new XMLHttpRequest();//获取xhr对象
        xhr.open('get',url,true);//请求  true表示异步请求
        xhr.send();//发送请求
        xhr.onreadystatechange=function(){//监听请求状态
            if(xhr.readyState==4){ //4表示请求已完成
                if(xhr.status===200){//请求成功
                    var res=xhr.responseText;//获取字符串形式的响应数据
                    data(res);//成功回调
                }else{//请求失败
                    successCallback(xhr.status);//失败回调
                }
            }
        }
    }else{//有参数
        var parameter='';
        for(var key in data){
            parameter+=key+'='+data[key]+'&';
        }
        parameter=parameter.slice(0,parameter.length-1);

        var xhr=new XMLHttpRequest();//获取xhr对象
        xhr.open('get',url+'?'+parameter,true);//请求  true表示异步请求
        xhr.send();//发送请求
        xhr.onreadystatechange=function(){//监听请求状态
            if(xhr.readyState==4){ //4表示请求已完成
                if(xhr.status===200){//请求成功
                    var res=xhr.responseText;//获取字符串形式的响应数据
                    successCallback(res);//成功回调
                }else{//请求失败
                    errorCallback(xhr.status);//失败回调
                }
            }
        }
    }
}

//post请求
$.post=function(url,data,successCallback,errorCallback){//请求地址,参数,成功回调,失败回调
    if(typeof data==='function'){//无参数
        var xhr=new XMLHttpRequest();//获取xhr对象
        xhr.open('post',url,true);//请求  true表示异步请求
        xhr.send();//发送请求
        xhr.onreadystatechange=function(){//监听请求状态
            if(xhr.readyState==4){ //4表示请求已完成
                if(xhr.status===200){//请求成功
                    var res=xhr.responseText;//获取字符串形式的响应数据
                    data(res);//成功回调
                }else{//请求失败
                    successCallback(xhr.status);//失败回调
                }
            }
        }
    }else{//有参数
        var parameter='';
        for(var key in data){
            parameter+=key+'='+data[key]+'&';
        }
        parameter=parameter.slice(0,parameter.length-1);

        var xhr=new XMLHttpRequest();//获取xhr对象
        xhr.open('post',url,true);//请求  true表示异步请求

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
        xhr.send(parameter);//发送请求
        xhr.onreadystatechange=function(){//监听请求状态
            if(xhr.readyState==4){ //4表示请求已完成
                if(xhr.status===200){//请求成功
                    var res=xhr.responseText;//获取字符串形式的响应数据
                    successCallback(res);//成功回调
                }else{//请求失败
                    errorCallback(xhr.status);//失败回调
                }
            }
        }
    }
}

//jsonp请求
$.jsonp=function(url,data,successCallback){//请求地址,参数,成功回调
    if(typeof data==='function'){//无参数
        //动态创建script标签
        var script = document.createElement("script");

        script.src =url+'?callback=jsonpCallback';//带上回调函数
        document.body.insertBefore(script, document.body.firstChild);
        $.success=data;//成功回调
    }else{//有参数
        var parameter='';
        for(var key in data){
            parameter+=key+'='+data[key]+'&';
        }

        //动态创建script标签
        var script = document.createElement("script");

        parameter=parameter.slice(0,parameter.length-1);
        script.src =url+'?'+parameter+'callback=jsonpCallback';//带上回调函数
        document.body.insertBefore(script, document.body.firstChild);
        $.success=successCallback;//成功回调
    }
}