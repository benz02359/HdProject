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
                    <a class="navbar-brand" href="index.html">Firebase</a>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav">
                        <li><a href="login.html">Member</a></li>
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
            apiKey: "AIzaSyBqxEP00IKEgI163DnTRluzxIHwesx_QLQ",
            authDomain: "example-crud-blog-d4912.firebaseapp.com",
            databaseURL: "https://example-crud-blog-d4912.firebaseio.com",
            storageBucket: "",
        };
        firebase.initializeApp(config);
        /////////////////////////////////////
        var Blog = firebase.database().ref('Entry').orderByChild('updatedAt');
        Blog.on('value', function (r) {
            $('#entries').html('Loading...');
            var html = '';
            r.forEach(function (item) {
                entry = item.val()
                html = '<div class="col-md-4">' +
                    '<a href="entry.html?id=' + item.getKey() + '" style="text-decoration:none!important;">' +
                    '<div class="panel panel-info">' +
                    '<div class="panel-heading">' +
                    '<h3 class="panel-title">' + excerpt(entry.title, 140) + '</h3>' +
                    '</div>' +
                    '<div class="panel-body">' +
                    '<small>By ' + entry.author + ' | ' + datetimeFormat(entry.updatedAt) + ' | ' + entry.views + ' views</small>' +
                    '<hr><p>' + excerpt(entry.content, 250) + '</p>' +
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


</body>

</html>