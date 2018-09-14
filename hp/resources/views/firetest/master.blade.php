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
    
    
    <script type="text/javascript" src="{{ asset('/js/cus.js') }}"></script>

    
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase.js"></script>
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
firebase.database().ref('customers/').on('value', function(snapshot) {
    var value = snapshot.val();
    var htmls = [];
    $.each(value, function(index, value){
    	if(value) {
    		htmls.push('<tr>\
        		<td>'+ value.cus_name +'</td>\
        		<td>'+ value.pro_id +'</td>\
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
$('#submitUser').on('click', function(){
	var values = $("#addUser").serializeArray();
	var cus_name = values[0].value;
	var pro_id = values[1].value;
    var userID = lastIndex+1;
    
    console.log(cus_name.value());
    console.log('info!!');
    
    firebase.database().ref('customers/' + userID).set({
        cus_id: cus_id+1,
        cus_name: cus_name,
        pro_id: pro_id
        
    });
    
    // Reassign lastID value
    lastIndex = userID;
	    $("#addUser input").val("");
});

// Update Data
var updateID = 0;
$('body').on('click', '.updateData', function() {
	updateID = $(this).attr('data-id');
	firebase.database().ref('customers/' + updateID).on('value', function(snapshot) {
		var values = snapshot.val();
		var updateData = '<div class="form-group">\
		        <label for="cus_name" class="col-md-12 col-form-label">Name</label>\
		        <div class="col-md-12">\
		            <input id="cus_name" type="text" class="form-control" name="cus_name" value="'+values.cus_name+'" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="pro_id" class="col-md-12 col-form-label">Program</label>\
		        <div class="col-md-12">\
		            <input id="pro_id" type="text" class="form-control" name="pro_id" value="'+values.pro_id+'" required autofocus>\
		        </div>\
		    </div>';

		    $('#updateBody').html(updateData);
	});
});

$('.updateUserRecord').on('click', function() {
	var values = $(".users-update-record-model").serializeArray();
	var postData = {
	    cus_name : values[0].value,
	    pro_id : values[1].value,
	};

	var updates = {};
	updates['/customers/' + updateID] = postData;

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
	firebase.database().ref('users/' + id).remove();
    $('body').find('.users-remove-record-model').find( "input" ).remove();
	$("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function() {
	$('body').find('.users-remove-record-model').find( "input" ).remove();
});
    </script>
        
</head>
<body>
    @yield('content')
</body>
<footer>@yield('footer')</footer>
</html>
