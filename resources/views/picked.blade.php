@extends('index')

@section('content')
<div class="card mt-4 w-50">
    <div class="card-header">
        <h5 class="m-0">You have drawn! (Remember this!)</h5>
    </div>
    <div class="card-body">
        <h5 class="text-center">You <strong class="text-danger">({{ $user->name }})</strong> have picked,
            <strong class="text-success">({{ $user->picked->receiver->name }})<strong class="text-red">!</h5>
    </div>
</div>
@endsection