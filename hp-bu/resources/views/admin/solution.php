<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firebase - List</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <br>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php route('home') ?>">Home</a>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo url('admin') ?>">Solution</a></li>
                        <li><a href="create.html">New Entry</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <h1>Firebase - List</h1>

        <div id="entries" class="row">

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
    <script>
        // firebase config
        var config = {
            apiKey: "AIzaSyDiaUDP4dhP_FUbTXOFa-g7ugATxi9lmdI",
            authDomain: "hdpj-632ed.firebaseapp.com",
            databaseURL: "https://hdpj-632ed.firebaseio.com",
            projectId: "hdpj-632ed",
            //storageBucket: "hdpj-632ed.appspot.com",
            messagingSenderId: "120261714092"
            };
            firebase.initializeApp(config);
    var database = firebase.database();
        /////////////////////////////////////
        var Blog = firebase.database().ref('solution/')//.orderByChild('updatedAt');
        Blog.on('value', function (r) {
            $('#entries').html('Loading...');
            var html = '';
            r.forEach(function (item) {
                entry = item.val()
                html = 
                    //'<tr>'+
                    '<div class="col-md-4">' +
                    '<span href="entry.html?id=' + item.getKey() + '" style="text-decoration:none!important;">' +
                    '<div class="panel panel-info">' +
                    '<div class="panel-heading">' +
                    '<h3 class="panel-title">' + excerpt(entry.title, 140) + '</h3>' +
                    '</div>' +
                    '<div class="panel-body">' +
                    '<small>By ' + entry.program + ' | ' + datetimeFormat(entry.updatedAt) + ' | ' + entry.views + ' views</small>' +
                    '<hr><p>' + excerpt(entry.des, 250) + '</p>' +
                    '</div>' +
                    '<button data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+item.getKey()+'">รายละเอียด</button>'+
                    '</div>' +
                    
                    '</span>' +
                    '</div>' + html; // prepend the entry because we need to display it in reverse order
            });
            $('#entries').html(html);
            
        });
        
        var updateID = 0;
$(document).ready(function(){
$('body').on('click', '.updateData', function() {
    console.log(updateID);
   // var entry_id = $_GET('data-id');
	updateID = $(this).attr('data-id');
    /*var values = firebase.database().ref('/solution/1/')//.child('/1/');
            values.on('value', function (r) {*/
	firebase.database().ref('/solution/'+ updateID )/*.child('/1/')*/.on('value', function(snapshot) {
		var values = snapshot.val();
		var updateData = '<div class="form-group">\
		        <label for="title" class="col-md-12 col-form-label">Title</label>\
		        <div class="col-md-12">\
		            <p>'+values.title+'</p>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="des" class="col-md-12 col-form-label">Description</label>\
		        <div class="col-md-12">\
		            <h1>'+values.des+' </h1>\
		        </div>\
		    </div>\
            <div class="form-group">\
		        <label for="program" class="col-md-12 col-form-label">Program</label>\
		        <div class="col-md-12">\
		            <p>'+values.program+' </p>\
		        </div>\
		    </div>';
            $('#updateBody').html(updateData);
		    
	});
});
});

        /*************\
         * Utilities *
        \*************/
        function strip(html) {
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }
        function excerpt(text, length) {
            text = strip(text);
            text = $.trim(text); //trim whitespace
            if (text.length > length) {
                text = text.substring(0, length - 3) + '...';
            }
            return text;
        }
        function pad2Digit(num) {
            return ('0' + num.toString()).slice(-2);
        }
        function datetimeFormat(timestamp) {
            var dateObj = new Date(timestamp);
            var en_month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return dateObj.getDate() + ' ' + en_month[dateObj.getMonth()] + ' ' + pad2Digit(dateObj.getFullYear()) + ' ' + pad2Digit(dateObj.getHours()) + ':' + pad2Digit(dateObj.getMinutes());
        }
    </script>
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Detail</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                
                </div>
            </div>
        </div>
    </div>
</form>

</body>

</html>