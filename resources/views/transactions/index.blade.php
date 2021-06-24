@extends('layouts.app')
@section('content')
    <transaction-report 
        uri="{{$uri}}"
        name="{{$name}}"
    >
    </transaction-report>
  
@endsection