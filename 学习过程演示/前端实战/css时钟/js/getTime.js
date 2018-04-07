
function GetTime(h,m,s){
	this.hPointer = h;
	this.mPointer = m;
	this.sPointer = s;
	this.pointerRotate();
}

GetTime.prototype = {
	currentTime: function(){
		this.date = new Date();
		this.hour = this.date.getHours();
		this.minute = this.date.getMinutes();
		this.second = this.date.getSeconds();
	},
	pointerRotate: function(){
		this.timer = setInterval(function(){
			this.currentTime();
			var sDeg = 360/60*this.second%360;
			var mDeg = (360/60*this.minute+sDeg/60)%360;
			var hDeg = (360/12*(this.hour%12)+mDeg/12)%360;
			this.hPointer.style.transform = "rotate(" + hDeg + "deg)";
			this.mPointer.style.transform = "rotate(" + mDeg + "deg)";
			this.sPointer.style.transform = "rotate(" + sDeg + "deg)";
		}.bind(this),1000);
	}
}