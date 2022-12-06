@extends('index')

@section('content')
<div class="card mt-4 w-50">
    <div class="card-header">
        <h5 class="m-0">Christmas Party Draw-Lots</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('check_name') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="user_code_name" class="form-label">Enter your code name here:</label>
                <input type="text" name="user_code_name" id="user_code_name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection