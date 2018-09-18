@extends('admintest.test')

@section('style')
<style type="text/css">
.desabled {
	pointer-events: none;
}
.modal::after {
  content: "";
  background: black;
  opacity: 0.5;
  top: 0;
  left: 0;
  bottom: -300px;
  right: 0;
  position: absolute;
  z-index: -1;   
}
</style>
@endsection

@section('content')
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
                    <a class="navbar-brand" href="{{ route('solution') }}">Home</a>
                </div>
            </div>
        </nav>

        <h1>ปัญหาต่างๆ</h1>

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
        /////////////////////////////////////
        var Blog = firebase.database().ref('solution/')//.orderByChild('updatedAt');
        Blog.on('value', function (r) {
            $('#entries').html('Loading...');
            var html = '';
            r.forEach(function (item) {
                entry = item.val()
                sid = item.getKey()
    
                html = 
                    '<div class="col-md-4">' +
                    '<a href="{{ route('detail',[$sid=>sid])}}" style="text-decoration:none!important;">' +
                    '<div class="panel panel-info">' +
                    '<div class="panel-heading">' + 
                    '<h3 class="panel-title">' + excerpt(entry.title, 140) + '</h3>' +
                    '</div>' +
                    '<div class="panel-body">' +
                    '<small>Programe'+ entry.program + ' | ' + datetimeFormat(entry.updatedAt) + ' | ' + entry.views + ' views</small>' +
                    '<hr><p>' + excerpt(entry.des, 250) + '</p>' +
                    '</div>' + 
                    '</div>' +
                    '</a>' +
                    '</div>' + html; // prepend the entry because we need to display it in reverse order
            });
            $('#entries').html(html);
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

<!--   
<div> 
    <form action="" method="POST" class="users-update-record-model form-horizontal">
        <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content" style="overflow: hidden;">
                    <div class="modal-header">
                        <h4 class="modal-title" id="custom-width-modalLabel">Solution</h4>
                        <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="entries">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
    $(document).ready(function(){
    var updateID = 0;

    $('body').on('click', '.entries', function() {
        Id = $(this).data('id');
        console.log(Id);
        firebase.database().ref('solution/' + Id).on('value', function(snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
                    <label for="title" class="col-md-12 col-form-label">ปัญหา</label>\
                    <div class="col-md-12">\
                        <input id="title" type="text" class="form-control" name="title" value="'+values.title+'" required autofocus>\
                    </div>\
                </div>\
                <div class="form-group">\
                    <label for="des" class="col-md-12 col-form-label">วิธีแก้</label>\
                    <div class="col-md-12">\
                        <input id="des" type="text" class="form-control" name="des" value="'+values.des+'" required autofocus>\
                    </div>\
                </div>';

                $('#updateBody').html(updateData);
                
        });
    });
    });

    </script>
</div>
-->
@endsection