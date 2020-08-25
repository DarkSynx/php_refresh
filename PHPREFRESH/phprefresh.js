$( document ).ready(function() {
    console.log( "ready!" );
	
	

	
	let vartimerefresh = 0;
	setInterval(function(){ 
			let timestamp = + new Date();
			$.getJSON("phprefresh.json?" + timestamp, function(json) {
				
				if(vartimerefresh != json.time) {
					//location.reload(); 
					console.log( json.time );
					console.log( 'refresh!' );
					vartimerefresh = json.time;
				}
			});

	}, 1000);

	
	
});