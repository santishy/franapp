@extends('layouts.app')
@section('content')
    <div class="flex flex-wrap items-baseline">
        <create-new-role></create-new-role>
        <permission-list 
            class="ml-4"
            :permissions="{{json_encode($permissions)}}"
        >
        <permission-list>
    </div>

@endsection