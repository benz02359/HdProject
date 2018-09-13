@extends('firetest.master')

@section('title','Firebase Test')
@section('content')
    <div class="container">
        <div>
            <h1>Firebase Test</h1>
            <br/>
            <div class="form-group">
            <label for="usr">Username:</label>
            <input type="text" placeholder="Enter your username" class="form-control" id="uname"> 
            </div>
            <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" placeholder="Enter your password" class="form-control" id="pass"> 
            </div>
            <br/>
            <label for="detail">Detail:</label>
            <textarea name="detail" row="8" id="detail" class="form-control" id="uname"></textarea> 
            </div>
            <button id="btnsubmit" name="save" class="btn btn-primary" >Submit</button>
            <button id="btndel" class="btn btn-danger" >Delete</button>
            <button id="btnubdate" class="btn btn-success" >Update</button>
        </div>
    </div>
    
@stop