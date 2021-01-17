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
                            {{-- Form Starts Here --}}
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
                                {{-- Tags Not Implemented--}}
                                {{-- <div class="form-group">
                                    <label for="">Image Tags</label>
                                    <select name="tags[]" class="form-control rounded-0" multiple>
                                        <option value="">--Select Tags --</option>
                                        <option value="0">Public</option>
                                    </select>
                                </div> --}}
                                <button class="btn btn-dark btn-block rounded-0">Upload Image</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            {{-- Delete All button --}}
                            <form action="{{ Route('delete_all') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger bulk d-flex justify-content-right">Empty the Tank</button>
                            </form>
                            {{-- Multiple Checkbox Delete Button --}}
                            <form action="{{ Route('delete_multiple') }}" method="post" id="form_checkbox">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger bulk">Delete Bulk (* Select Checkbox)</button>
                    
                        {{-- Table Starts Here --}}
                            <table class="table wrap" width="100%">
                                {{-- Display Success Mesaage --}}
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                {{-- End Succeess Message --}}
                                <thead>
                                    <tr>
                                        <th>Selection</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($images->count())
                                   @foreach ($images as $images)
                                    <tr>
                                        <td>
                                            {{-- Array Checkbox --}}
                                                <input type="checkbox" name="image_id[]" id="" value="{{ $images->id }}"></td>
                                            </form>
                                        <td>{{ $images->title }}</td>
                                        <td><img src="{{ asset('storage/'.$images->image_file) }}" alt="{{ $images->title }}" height="50px" width="50px"></td>
                                        <td><a href="{{ route('user_images.edit', $images->id) }}" class="btn btn-danger">Edit</a>

                                            <form action="{{ Route('user_images.destroy', $images->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Del</button>
                                            
                                        </td>
                                    </tr>
                                   @endforeach
                                     
                                   @else
                                        <tr><td colspan="3"><h4 class="text-center">Nothing to Show..</h4></td></tr> 
                                   @endif
                                </form>
                                </tbody>
                            </table>
                            {{-- Table ends here --}}
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
