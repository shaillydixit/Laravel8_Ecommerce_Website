@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">

                            <form method="post" action="{{route('brand.update', $brand->id)}}" enctype="multipart/form-data">
                                @csrf
                                <!--bcoz of below input we dont need to mention id in route  -->
                                <input type="hidden" name="id" value="{{$brand->id}}">
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}">
                                <div class="form-group">
                                    <h5>Brand Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_en" class="form-control" value="{{$brand->brand_name_en}}">
                                    </div>
                                    @error('brand_name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="form-group">
                                        <h5>Brand Name Hindi <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_hin" class="form-control" value="{{$brand->brand_name_hin}}">
                                        </div>
                                        @error('brand_name_hin')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="form-group">
                                            <h5>Brand Image<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="brand_image" class="form-control">
                                            </div>
                                        </div>
                                        @error('brand_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Brand">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
    </section>
</div>
@endsection