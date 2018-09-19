<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script type="text/javascript" src="{{ asset('/js/cus.js') }}"></script>

    
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase-storage.js"></script>
    <script>
	
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDiaUDP4dhP_FUbTXOFa-g7ugATxi9lmdI",
    authDomain: "hdpj-632ed.firebaseapp.com",
    databaseURL: "https://hdpj-632ed.firebaseio.com",
    projectId: "hdpj-632ed",
    storageBucket: "hdpj-632ed.appspot.com",
    messagingSenderId: "120261714092"
  };
  firebase.initializeApp(config);
  var database = firebase.database();

var lastIndex = 0;

// Get Data
firebase.database().ref('solution/').on('value', function(snapshot) {
    var value = snapshot.val();
    var htmls = [];
    $.each(value, function(index, value){
    	if(value) {
    		htmls.push('<tr>\
        		<td>'+ value.title +'</td>\
        		<td>'+ value.des +'</td>\
                <td>'+ value.program +'</td>\
        		<td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+index+'">Update</a>\
        		<a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="'+index+'">Delete</a></td>\
        	</tr>');
    	}    	
    	lastIndex = index;
    });
    $('#tbody').html(htmls);
    $("#submitUser").removeClass('desabled');
});


// Add Data
$(document).ready(function(){
$("#submitUser").on('click', function(){
    alert("The paragraph was clicked.");
	var values = $("#addUser").serializeArray();
	var title = values[0].value;
	var des = values[1].value;
    var program = values[2].value;
	var userID = lastIndex+1;

    firebase.database().ref('/solution/' + userID).set({
        title: title,
        des: des,
        program: program,
    });

    // Reassign lastID value
    lastIndex = userID;
	$("#addUser input").val("");
});
});
// Update Data
var updateID = 0;
$(document).ready(function(){
$('body').on('click', '.updateData', function() {
	updateID = $(this).attr('data-id');
	firebase.database().ref('/solution/' + updateID).on('value', function(snapshot) {
		var values = snapshot.val();
		var updateData = '<div class="form-group">\
		        <label for="title" class="col-md-12 col-form-label">Title</label>\
		        <div class="col-md-12">\
		            <input id="title" type="text" class="form-control" name="title" value="'+values.title+'" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="des" class="col-md-12 col-form-label">Description</label>\
		        <div class="col-md-12">\
		            <input id="des" type="text" class="form-control" name="des" value="'+values.des+'" required autofocus>\
		        </div>\
		    </div>\
            <div class="form-group">\
		        <label for="program" class="col-md-12 col-form-label">Program</label>\
		        <div class="col-md-12">\
		            <input id="program" type="text" class="form-control" name="program" value="'+values.program+'" required autofocus>\
		        </div>\
		    </div>';

		    $('#updateBody').html(updateData);
	});
});

$('.updateUserRecord').on('click', function() {
	var values = $(".users-update-record-model").serializeArray();
	var postData = {
	    first_name : values[0].value,
	    last_name : values[1].value,
	};

	var updates = {};
	updates['/users/' + updateID] = postData;

	firebase.database().ref().update(updates);

	$("#update-modal").modal('hide');
});


// Remove Data
$("body").on('click', '.removeData', function() {
	var id = $(this).attr('data-id');
	$('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
});

$('.deleteMatchRecord').on('click', function(){
	var values = $(".users-remove-record-model").serializeArray();
	var id = values[0].value;
	firebase.database().ref('solution/' + id).remove();
    $('body').find('.users-remove-record-model').find( "input" ).remove();
	$("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function() {
	$('body').find('.users-remove-record-model').find( "input" ).remove();
});
});
</script>	
</head>
<body>
    @yield('content')
</body>
<footer>@yield('footer')</footer>
</html>
