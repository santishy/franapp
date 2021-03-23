@extends('layouts.app')
@section('content')
    <div class="flex flex-wrap items-baseline flex-initial">
        <create-new-role></create-new-role>
        <permission-list 
            class=""
            :permissions="{{json_encode($permissions)}}"
        >
        <permission-list>
    </div>

@endsection