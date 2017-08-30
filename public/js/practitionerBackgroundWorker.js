onmessage = function(e) {
  var date =e.data;
  var host = location.protocol;
	var site = location.hostname;
	var additionlink = '/dev'
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		   postMessage(xhttp.responseText);
		}
	};
	xhttp.open("GET", host+'//'+site+additionlink+'/practitioner/message-notification?datee='+date, true);
	xhttp.send();
}
