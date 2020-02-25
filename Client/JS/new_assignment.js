 $(function () {
 	//populate courses
 	course_list = get_courses();

 	//add new assignment
 	$('form').on('submit', function(e){
 		e.preventDefault();
 		//serialize form inputs
 		var assignment_info = $('form').serializeArray().reduce(function(obj, item) {
 			obj[item.name] = item.value;
 			return obj;
 		}, {});

 		//get file
 		var classlist_csv = $('#uploadClassList').prop('files')[0];
 		var form_data = new FormData();                  
    	form_data.append('file', classlist_csv);

 		add_assignment(assignment_info);
 		add_classlist(form_data);
 		
 		// empty form
		$(this)[0].reset();
	})

 	// Generate links and emails

 })

 function add_classlist(file){
 	$.ajax({
 		url: './instructor_php/add_classlist.php',
 		type: 'POST',
 		contentType: false,
 		processData: false,
 		cache: false,
 		data: file,
 		success: function(data){
 		},
 		error: function(data){
 		}
 	});
 }

 function get_courses(){
 	$.ajax({
 		url: './instructor_php/get_courses.php',
 		type: 'GET',
 		dataType: 'json',
 		data: {},
 		success: function(data){
 			var html = '';

 			$.each(data,function(i, course){
 				html += '<option data-cid='+course+'>'+course+'</option>'
 			});
 			$('#select-courses').append(html);
 		},
 		error: function(data){
 			console.log("error get_courses()")
 		}
 	});
 }

 function add_assignment(assignment_info){
 	$.ajax({
 		url: './instructor_php/add_new_assignment.php',
 		type: 'POST',
 		data: assignment_info,
 		success: function(res){
 			$('#confirmation-msg').empty();
 			if (res=="Success"){
 				console.log("success add_assignment()");
 				var html = '<div class="offset-md-2 col-md-8 alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Your new peer review session has been created.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
 				$('#confirmation-msg').append(html);
 			}else{
 				console.log("failure add_new_assignment.php");
 				var html = '<div class="offset-md-2 col-md-8 alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> An error occured, please try again later.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
 				$('#confirmation-msg').append(html);
 			};
 		},
 		error: function(res){
 			console.log("failure add_assignment()");
 		}
 	});
 }