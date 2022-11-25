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
              <h3 class="card-title">Add Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="/admin/category/add" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload image</label>
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
