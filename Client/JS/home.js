$(function(){
	// get sessions
	$.ajax({
		url: './instructor_php/get_sessions.php',
		type: 'GET',
		dataType: 'json',
		data: {},
		success: function(data){
			var html = '';

			$.each(data, function(index, value){
				html += '<a href="./student_status.html?sessionID='+value.sessionID+'" class="list-group-item list-group-item-action">'+value.courseID+' - '+value.assignmentName+'</a>';
			});

			$('#sessionlist').append(html);
		},
		error: function(data){
			console.log("error get_sessions.php")
		}
	});

})
