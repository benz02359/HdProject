@extends('user.master')
@section('title','Edit Form')
@section('content')
<div class="ro">
  <div class="col-md-12"><br />
  <h3 align="center">แก้ไขข้อมูลผู้ใช้ระบบ</h3><br />
  @if(count($errors) > 0)
    <div class="alert alert-danger">
    <ul> @foreach($errors->all() as $errors)
    <li>{{$errors}}</li>
    @endforeach
    </ul>
    </div>
    @endif
  <form method="post" action="{{action('UserController@update', $id)}}">
    {{csrf_field()}}
    <div class="form=group">
      <input type="text" name="fname" class="form-control" placeholder="ป้อนชื่อ" value="{{$user->fname}}"  />
    </div>
    <div class="form-group">
      <input type="text" name="lname" class="form-control" placeholder="ป้อนนามสกุล" value="{{$user->lname}}"  />
    </div>
    <div class="form=group">
      <input type="submit" class="btn btn-primary" value="อัพเดท"  />
    </div>
      <input type="hidden" name="_method" value="PATCH" />
  </form>
  </div>
</div>


@endsection
