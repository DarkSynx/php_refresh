$( document ).ready(function() {
    console.log( "ready!" );
	
	

	
	let vartimerefresh = + new Date();
	setInterval(function(){ 
			let timestamp = + new Date();
			$.getJSON("../phprefresh.json?" + timestamp, function(json) {
				//console.log( $.now() + '->' +  json.time);
				if(vartimerefresh < json.time) {
					location.reload(); 
					console.log( json.time );
					console.log( 'refresh!' );
					vartimerefresh = json.time;
				}
			});

	}, 1000);

	
	
});