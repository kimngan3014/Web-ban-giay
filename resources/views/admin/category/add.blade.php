@extends('layout/admin')
@section('body')
<div class="container-fluid mt-5">

    <div class="row justify-content-center">
        
        <div class="col-md-8">
            
            <h3 class="font-weight-bold text-center mb-4 text-primary">Upload New Category</h3>

            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label font-weight-bold">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name..." required>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label font-weight-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a short description..."></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection