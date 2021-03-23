@extends('layouts.app')
@section('content')
    <div class="flex flex-wrap ">
        <create-new-role></create-new-role>
        <permission-list 
            :permissions="{{json_encode($permissions)}}"
        >
        <permission-list>
    </div>

@endsection