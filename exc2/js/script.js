function getUsers(){
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiviXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(this.readyState==4 && this.status==200){
			document.getElementById("allUsers").innerHTML=this.responseText;
		}
	};
	xmlhttp.open("GET", "getUsers.php",true);
	xmlhttp.send();
}