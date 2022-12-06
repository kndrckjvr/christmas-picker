@extends('index')

@section('content')
<div class="card mt-4 w-50">
    <div class="card-header">
        <h5 class="m-0">Draw your picks:</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('draw.save') }}" method="post">
            @csrf
            <p>Hello {{ $user->name }}, draw your pick!</p>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Draw</button>
            </div>
        </form>
    </div>
</div>
@endsection