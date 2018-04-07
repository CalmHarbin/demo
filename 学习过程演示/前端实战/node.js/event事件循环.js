const events=require("events");//const定义常量,不可更改
const eventEmitter=new events.EventEmitter();//创建eventEmitter对象
eventEmitter.on("eventName",eventHandler);//绑定eventName事件,以及事件处理函数eventHandler;
function eventHandler(){
	console.log("事件已处理");
}
eventEmitter.emit("eventName");//触发eventName事件