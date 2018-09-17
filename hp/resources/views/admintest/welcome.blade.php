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
    <div class="row">
    	<div class="col-md-4">
    		<div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Login</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="addUser" class="" method="POST" action="">
                    	<div class="form-group">
                            <label for="name" class="col-md-12 col-form-label">Username</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="text" class="form-control" name="password" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-3">
                                <button type="button" class="btn btn-primary btn-block desabled" id="submitUser">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    	</div>
    </div>
</div>


@endsection