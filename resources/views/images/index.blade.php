@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Images Manager') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                   <div class="row">
                        <div class="col-md-4">
                            <form action="{{ Route('user_images.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Size (e.g 1280px x 800px)</label>
                                    <input type="text" name="size" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Image Permission</label>
                                    <select name="permission" class="form-control rounded-0">
                                        <option selected disabled>--Select Permission --</option>
                                        <option value="0">Public</option>
                                        <option value="1">Private</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="price" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Discount (%)</label>
                                    <input type="text" name="discount" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Image Tags</label>
                                    <select name="tags[]" class="form-control rounded-0" multiple>
                                        <option value="">--Select Tags --</option>
                                        <option value="0">Public</option>
                                    </select>
                                </div>
                                <button class="btn btn-dark btn-block rounded-0">Upload Image</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <a href="" class="badge badge-danger">Upload Image</a>
                            <table class="table table-responsive table-fluid wrap">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($images as $images)
                                    <tr>
                                        <td>{{ $images->title }}</td>
                                        <td><img src="{{ asset('storage/'.$images->image_file) }}" alt="{{ $images->title }}" height="50px" width="50px"></td>
                                        <td><a href="{{ route('user_images.edit', $images->id) }}" class="btn btn-danger">Edit</a>

                                            <form action="{{ Route('user_images.destroy', $images->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Del</button>
                                            </form>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
