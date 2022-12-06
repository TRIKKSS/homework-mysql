function log_success(data) {
	var a = document.getElementById("success");
	a.innerHTML='<p>'+data+'</p>';
	a.style.display = "block";
	setTimeout(function(){
		document.getElementById("success").style.display = "none";
	},5000);
}

function log_error(data) {
	var a = document.getElementById("error");
	a.innerHTML='<p>'+data+'</p>';
	a.style.display = "block";
	setTimeout(function(){
		document.getElementById("error").style.display = "none";
	},5000);
}

function book_a_film(id) {

	$.ajax({
		url : '/book_film.php?id=' + id,
		type : 'GET',
		success: function(data){
			var json = $.parseJSON(data);
			if (json["error"]){
				log_error(json["message"]);
			} else {
				log_success(json["message"]);
			}
		},
		error: log_error
	});
}

function return_a_film(id) {

	$.ajax({
		url : '/return_film.php?id=' + id,
		type : 'GET',
		success: function(data){
			var json = $.parseJSON(data);
			if (json["error"]){
				log_error(json["message"]);
			} else {
				window.location.reload();
			}
		},
		error: log_error
	});
}