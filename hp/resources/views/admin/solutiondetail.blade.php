@extends('admintest.test')

@section('style')
<style type="text/css">
.desabled {
	pointer-events: none;
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

        <article>
            <h1 data-bind="title">Loading...</h1>

            <small>
                By <span data-bind="author"></span> | 
                Updated at <span data-bind="updatedAt-formatted"></span> | 
                <span data-bind="views">0</span> Views
            </small>

            <hr>

            <div data-bind="content"></div>
            
            <hr>
            <div class="text-right">
                <button id="delete" class="btn btn-lg btn-danger">Delete</button>
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                <a href="" id="update" class="btn btn-lg btn-primary">Update</a>
            </div>

        </article>

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
        var entry_id =  {{$sid}} ;
        if (entry_id) {
            var added_views = false;
            var Entry = firebase.database().ref('/solution/').child(entry_id);
            Entry.on('value', function (r) {
                var entry = r.val();
                if (entry) {
                    entry['updatedAt-formatted'] = datetimeFormat(entry.updatedAt);
                    $('[data-bind]').each(function () {
                        $(this).html(entry[$(this).data('bind')]);
                    });
                    
                    // update title
                    document.title = 'Firebase - ' + entry.title;
                    
                    // increase views count. once.
                    if (!added_views) {
                        added_views = true;
                        Entry.child('views').transaction(function (views) {
                            return (views || 0) + 1;
                        });
                    }
                    
                } else { // content not found
                    window.location.href = '{{ route('solution') }}';
                }
            });
            
            // update button
            $('#update').attr('href','update.html?id='+entry_id);
            
            // delete button
            $('#delete').click(function(){
                if(confirm('This entry will be permanently delete. Are you sure?')){
                    Entry.remove(); // this will trigger Entry.on('value') immediatly
                }
            });
        } else {
            alert('This entry id does not exist');
            window.location.href = '{{ route('solution') }}';
        }
        /*************\
         * Utilities *
        \*************/
        function $_GET(key) {
            var queries = window.location.href.split('?').pop().split('&');
            var params = {};
            queries.map(function (query) {
                var set = query.split('=');
                params[set[0]] = set[1];
            });
            if (key) {
                return params[key] || null;
            } else {
                return params;
            }
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



@endsection