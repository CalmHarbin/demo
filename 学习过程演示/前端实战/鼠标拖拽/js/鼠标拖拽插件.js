	function drag(obj){
		obj.mousedown(function(e){//����갴���¼�
			var x=e.pageX-this.offsetLeft;//��ȡ�������ڶ��������
			var y=e.pageY-this.offsetTop;
			$(document).bind('mousemove',function(e){//����ƶ��¼�
				obj.css({//����left,topֵ
					'left':e.pageX-x+'px',//�������Ͻ�����=�����������-�������ڶ��������
					'top':e.pageY-y+'px'
					});
				return false;//��ֹĬ����Ϊ
			});
			$(document).bind('mouseup',function(){//��굯���¼�
				$(document).unbind();//ȡ��������ƶ��¼�
			});
		})
	}	