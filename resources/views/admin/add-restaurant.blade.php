@extends('admin.layout')
@section('content')
<section class="content content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Restaurant</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="/admin/restaurant/store" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Restaurant name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="phone" name="phone" class="form-control" id="exampleInputPassword1" placeholder="phone">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="confirm-password" name="confirm-password" class="form-control" id="exampleInputPassword1" placeholder="confirm-password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload logo</label>
                  <div class="input-group">
                    <div class="">
                      <input type="file" accept="image/jpeg,image/gif,image/png" name="image" class="" id="">
                      {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                @if (session('message'))
                    <div style="color: green">
                      <ul>
                        <li>{{session('message')}}</li>
                      </ul>
                    </div>
                @endif

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->




        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('js')

<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
