@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-8 gap-4 grid-flow-col auto-cols-auto auto-rows-auto">
        <create-new-role 
            class="col-span-3"
            :roles="{{json_encode($roles)}}"
        >
        </create-new-role>
        <permission-list 
            class="col-span-5"
            :permissions="{{json_encode($permissions)}}"
        >
        <permission-list>
    </div>

@endsection