
var chatManager = new function(){

	var idle 		= true;
	var interval	= 500;
	var xmlHttp		= new XMLHttpRequest();  //서버와 상호작용하기 위함
	var finalDate	= '';
	var chat_group_ID         = -1;
	var user_ID          = -1;

	var mine = false;//자신인지 아닌지 구분
	var first= true;

	this.setId= function(chat_group_id,user_id){
		chat_group_ID=chat_group_id;
		user_ID=user_id;

		//alert(chat_group_id);
	}
	// Ajax Setting
	//서버 응답에 따른 로직 작성
	xmlHttp.onreadystatechange = function()
	{
		if (xmlHttp.readyState == XMLHttpRequest.DONE && xmlHttp.status == 200)
		{
			//debugger;
			// JSON 포맷으로 Parsing
			// 인자로 전달된 문자열을 자바스크립트의 데이터로 변환
			// console.log("xmlHttp.responseText : "+xmlHttp.responseText); 
			//console.log(JSON.parse(xmlHttp.responseText));
			
			res = JSON.parse(xmlHttp.responseText);
			finalDate = res.date;

			// 채팅내용 보여주기
			chatManager.show(res.data);
			console.log("date = " + res.date);
			//console.log("date" + res.data[i].name);
			//console.log("date" + res.data[i].msg);
			// 중복실행 방지 플래그 OFF
			idle = true;
		}
	}

	// 채팅내용 가져오기
	this.proc = function()
	{
		//alert(chat_group_id);
		// 중복실행 방지 플래그가 ON이면 실행하지 않음
		if(!idle)
		{
			return false;
		}

		// 중복실행 방지 플래그 ON
		idle = false;
		// console.log(chat_group_id);
		
		// Ajax 통신
		//if(first){
			// console.log("처음");
			// xmlHttp.open("GET", "chatting_proc.php?id="+chat_group_ID, true);
			xmlHttp.open("GET", "chatting_proc.php?id="+chat_group_ID+"&date=" + encodeURIComponent(finalDate)+"&first="+first, true);
			first=false;
		// }else{
		// 	console.log("처음X");

		// 	xmlHttp.open("GET", "chatting_proc.php?id="+chat_group_ID+"&date=" + encodeURIComponent(finalDate)+"&first=false", true);
		// }
		xmlHttp.send();
	}

	// 채팅내용 보여주기
	this.show = function(data)
	{
		// console.log("Show 함수 들어옴");
		var textCnt=0;
		var chattingContainer = document.getElementById('main');
		var chatWrap = document.getElementsByClassName('chat-wrap')[0];
		var wrap = document.getElementsByClassName('wrap')[0];

		var div;
		// chat-wrap
		var dt, chatting;//이름,메세지
		console.log("date[].name : "+data.length);
		// 채팅내용 추가
		for(var i=0; i<data.length; i++)
		{
			div=chatWrap.appendChild(document.createElement('div'));
			chatting=div.appendChild(document.createElement('div'));
			if(user_ID!=data[i].user_id){
				// var profile=wrap.appendChild(document.createElement('div'));
				// profile.className="profile";
				// var img=profile.appendChild(document.createElement('img'));
				// img.src="images/profile.jpg";
				// var name= wrap.appendChild(document.createElement('div'));
				// name.className="name";
				// name.innerText=data[i].name;
				chatting.className="chatting";
			}else{
				chatting.className="mine-chatting";
			}
			
			chatting.innerText=data[i].msg;
			// console.log("for문 들어옴");

			// dt = document.createElement('dt');
			// dt.appendChild(document.createTextNode(data[i].name));
			// chattingContainer.appendChild(dt);
			// console.log("date[].name : "+data[i].user_id);
			// console.log("date[].msg : "+data[i].msg);

		}

		// 가장 아래로 스크롤
		if(data.length!=textCnt){
			chattingContainer.scrollTop = chattingContainer.scrollHeight;
		}
		textCnt=data.length;
	}

	// 채팅내용 작성하기
	this.write = function(frm)
	{

		var xmlHttpWrite	= new XMLHttpRequest();
		var user_id			= frm.user_id.value;
		var msg				= frm.msg.value;
		var chat_group_id	= frm.chat_group_id.value;
		var param			= [];
		
		this.mine=true;
		// 이름이나 내용이 입력되지 않았다면 실행하지 않음
		if(user_id.length == 0 || msg.length == 0)
		{
			return false;
		}
		// POST Parameter 구축
		param.push("user_id=" + encodeURIComponent(user_id));
		param.push("msg=" + encodeURIComponent(msg));
		param.push("chat_group_id=" + encodeURIComponent(chat_group_id));
				
		// Ajax 통신
		xmlHttpWrite.open("POST", "chatting_write.php", true);
		xmlHttpWrite.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //body 인코딩이 해당 framework 혹은 library에서 자동으로 되는지 확인 후 안되면 해줘야한다.
		xmlHttpWrite.send(param.join('&'));
		
		// 내용 입력란 비우기
		frm.msg.value = '';
		
		// 채팅내용 갱신
		chatManager.proc();
	}

	// interval에서 지정한 시간 후에 실행
	setInterval(this.proc, interval);
}