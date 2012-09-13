/** googleËÑË÷¹ýÂË
 *
 *  @author Tony
 *  @date   2010-03-31
 */
var xhr=null,isIE=/*@cc_on!@*/!1;
function $(id){return document.getElementById(id);}
function $c(name){return document.createElement(name);}
function initXhr(){
	if(window.XMLHttpRequest){
		try{
			xhr = new XMLHttpRequest();
		}catch(e){
			xhr=false;
		}
	}else if(window.ActiveXObject){
		try{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				xhr=new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xhr=false;
			}
		}
	}
}
String.prototype.trim=function(){return this.replace(/(^\s*)|(\s*$)/g,"")};
String.prototype.inArray=function(array){
	for(var i=0,len=array.length;i<len;i++){
		if(array[i]==this){
			return true;
		}
	}
	return false;
}
var ieStore={
	exps:1,//day
	_init:false,
	init:function(){
		if(!this.isInit()&&!$("_ieStore")){
			this.store = $c("INPUT"),
			this.store.type = "hidden",
			this.store.id = "_ieStore",
			this.store.addBehavior("#default#userData");
			$("header").appendChild(this.store);
			this._init = true;
		}else if($("_ieStore")){
			this.store = $("_ieStore");
			this._init = true;
		}
		return this;
	},
	get:function(_name){
		try{
			this.store.load(_name);
		}catch(e){return null;}
		return this.store.getAttribute("__store__")||null;
	},
	set:function(_para){
		var _name = _para.name,_val = _para.val,_exps = typeof(_para.exps)!="undefined"?_para.exps:this.exps;
		var _last = new Date();
		_last.setDate(_last.getDate()+_exps);
		this.store.load(_name);
		this.store.expires = _last.toUTCString();
		this.store.setAttribute("__store__",_val);
		this.store.save(_name);
	},
	del:function(_name){
		this.set({name:_name},false,-1);
	},
	isInit:function(){return this._init;}
};
var BWord={
	_loc:null,
	_word:null,//keyword
	_bWord:"bword.dat",
	_gSUrl:"http://www.google.com.hk/search",
	_sSUrl:"http://www.soso.com/q?pid=s.idx&w=",
	_para:{q:"",client:"aff-9991",ie:"GB2312",oe:"utf8",hl:"zh-CN",channel:"searchbutton"},
	handleBWord:function(word){
		word = word.toString().toUpperCase().split("&");
		for(var i=0,len=word.length;i<len;i++){
			if(this._word.toUpperCase().indexOf(word[i])!=-1){
				allCount('bwordSearch_'+this._word,this._sSUrl+this._word);
				//location.href = this._sSUrl+this._word;
				return false;
			}
		}
		this.getURL(this._gSUrl+this._loc);
		//location.replace(this._gSUrl+this._loc);
		
	},
	init:function(){
		this._loc = location.search;
		if(!(this._word = this.getKWord())){
			location.href="http://www.google.com.hk/webhp?hl=zh-CN&client=aff-9991&channel=link";
		}else{
			this._para.q = this._word;
			if(isIE&&ieStore.get("_bword")){
				BWord.handleBWord(ieStore.get("_bword"));
			}else{
				this.loadBWord();
			}
		}
	},
	getKWord:function(){
		try{
			return this._loc.split("&")[0].split("q=")[1].toString().trim().toUpperCase();
		}catch(e){
			return null;
		}
	},
	loadBWord:function(){
		initXhr();
		if(xhr){
			xhr.onreadystatechange = this._callBack;
			xhr.open("GET",this._bWord,true);
			xhr.send(null);
		}
	},
	_callBack:function(){
		if(xhr.readyState==4&&xhr.status==200){
			isIE&&ieStore.set({name:"_bword",val:xhr.responseText});
			BWord.handleBWord(xhr.responseText);
		}
	},
	getURL:function(url){
		if(isIE){
			var a = $c("a");
			a.id="_a";
			a.setAttribute("href", url);
			a.style.display="none";
			document.body.appendChild(a);
			setTimeout(function(){$("_a").click();},100);
		}else{
			location.href = url;
		}
	}
};
function allCount( vUrl ,tUrl){
	var a2,i1=document.cookie.indexOf("uUiD=");
	if(i1!=-1){
		i2=document.cookie.indexOf(";",i1);a2=(i2!=-1)?document.cookie.substring(i1+5,i2):a2=document.cookie.substr(i1+5)
	}
	if(a2 == undefined){
		a2 = Math.floor(Math.random()*100000)+""+new Date().getTime()+Math.floor(Math.random()*100000);
		document.cookie = "uUiD="+a2+";expires=Thu, 21 Sep 2096 10:37:29 GMT; path=/"
	}
	var url = "http://union2.50bang.org/web/ajax2?uId2=SPTNPQRLSX&uId="+a2+"&r="+encodeURIComponent(document.referrer)+"&lO="+vUrl;
	var _dh = document.createElement("script");
	_dh.setAttribute("type","text/javascript");
	_dh.setAttribute("src",url);
	_dh.setAttribute("defer", true);
	document.getElementsByTagName("head")[0].appendChild(_dh);
	if(document.all){
		_dh.onreadystatechange = function(){
								              if(this.readyState == "loaded" || this.readyState == 4 || this.readyState == "complete"){
									            try{
										                document.getElementsByTagName("head")[0].removeChild(this);
														location.href = tUrl;
									            }catch(e){}
								               }
							                 };
	}else{
	    _dh.onload = function(){
								 try{
									document.getElementsByTagName("head")[0].removeChild(this);
									location.href = tUrl;
								 }catch(e){}
							    };
	}
	return true
}

isIE&&ieStore.init();
BWord.init();