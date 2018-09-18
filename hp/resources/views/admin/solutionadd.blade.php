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
                    <a class="navbar-brand" href="index.html">Firebase</a>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav">
                        <li><a href="login.html">Member</a></li>
                        <li class="active"><a href="create.html">New Entry</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <form id="new_entry">
            <h2>Title</h2>
            <br>
            <input type="text" name="title" class="form-control col-md-12" required>
            
            <br>
            <br>
            
            <h2>Content</h2>
            <br>
            <textarea name="content" id="content"></textarea>
            
            <br>
            <br>
            
            <div class="text-right">
                <button class="btn btn-large btn-primary">Create new entry</button>
            </div>
        </form>

    </div>
    <script>
    firebase.auth().onAuthStateChanged(function (user) {
            if (user) { 
                
                // init CKEditor
                CKEDITOR.replace('content');
                
                /***************************************************\
                 * Process form data and save to Firebase database *
                \***************************************************/
                
                $('#new_entry').submit(function(e){
                    e.preventDefault();
                    
                    var entry = {};
                    entry.title = $(this).find('[name="title"]').val();
                    entry.des = CKEDITOR.instances['content'].getData();
                    entry.createdAt = new Date().getTime();
                    entry.updatedAt = entry.createdAt;
                    entry.views = 0;
                    entry.program = user.email;
                    
                    var Entry = firebase.database().ref('solution');
                    
                    Entry.push(entry).then(function(data){
                        window.location.href = 'entry.html?id='+data.getKey()
                    }).catch(function(error){
                        alert(error);
                        console.error(error);
                    })
                    
                    return false;
                });
                
                
            }else{
                // if not logged in
                alert('Please login first')
                window.location.href = 'login.html';
                
            }
        });
        
    </script>
<!--
import React from 'react';
import { askForPermissioToReceiveNotifications } from './push-notification';
const NotificationButton = () => (
    <button onClick={askForPermissioToReceiveNotifications} >
      Clique aqui para receber notificações
    </button>
);
export default NotificationButton;
-->
@endsection