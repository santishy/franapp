@extends('layouts.app')
@section('content')
    <transaction-report 
        uri="{{$uri}}"
        name="{{$name}}"
    >
    </transaction-report>
    <transaction-list uri="{{$uri}}">
    </transaction-list>
@endsection