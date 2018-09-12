@extends('user.master')
@section('title','Management')
@section('content')
<div class="ro">
  <div class="col-md-12"><br />
  <h3 align="center">เพิ่มข้อมูลผู้ใช้ระบบ</h3><br />
  @if(count($errors) > 0)
    <div class="alert alert-danger">
    <ul> @foreach($errors->all() as $errors)
    <li>{{$errors}}</li>
    @endforeach
    </ul>
    </div>
    @endif

    @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{ \Session::get('success') }}</p>
    </div>
    @endif

  <form method="post" action="{{url('user')}}">
    {{csrf_field()}}
    <div class="form=group">
      <input type="text" name="fname" class="form-control" placeholder="ป้อนชื่อ"   />
    </div>
    <div class="form-group">
      <input type="text" name="lname" class="form-control" placeholder="ป้อนนามสกุล"   />
    </div>
    <div class="form=group">
      <input type="submit" class="btn btn-primary" value="บันทึก"/>
    </div>
  </form>
  </div>
</div>


@endsection
