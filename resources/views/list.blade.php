@extends('index')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">All Code Names</h5>
            </div>
            <div class="card-body">
                <ul style="column-count: 2; column-gap: 20px;">
                    @foreach ($code_names as $item)
                    <li class="{{ $item->picked == null ? 'text-danger' : 'text-success' }}">
                        {{ $item->name }} {{ $item->giver == null ? "*" : "" }}
                    </li>
                    @endforeach
                </ul>
                <div class="text-center">
                    <ul style="list-style: none">
                        <li>Legends:</li>
                        <li class="text-success">Drawn</li>
                        <li class="text-danger">Not Yet Drawn</li>
                        <li>(*) Haven't been drawn</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col mx-2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h5 class="m-0">Pickings ({{ $code_name_rel->count() }} out of {{ $code_names->count() }})</h5>
                    <a class="btn btn-primary" href="{{ route('download', ['token' => 'BzDxSzS']) }}">Download</a>
                </div>
            </div>
            <div class="card-body">
                <ul style="column-count: 2; column-gap: 20px;">
                    @foreach ($code_name_rel as $item)
                    <li>
                        <div class="flex-column">
                            <p class="m-0">{{ $item->picker->name }} ➡ {{$item->receiver->name}}</p>
                            <span><strong>Drawn at:</strong> {{
                                Carbon\Carbon::parse($item->created_at)->timezone(8)->format('M j, Y h:i:s A') }}
                                (GMT+8)</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection