@extends('layouts.app')
@section('content')
    <transaction-report 
        uri="{{$uri}}"
        name="{{$name}}"
        inventories="{{json_encode($inventories)}}"
    >
    </transaction-report>
  
@endsection