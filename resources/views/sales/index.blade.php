@extends('layouts.app')
@section('content')
    <transaction-report 
        uri="/sales"
        :today="{{json_encode($now)}}"
    >
    </transaction-report>
@endsection