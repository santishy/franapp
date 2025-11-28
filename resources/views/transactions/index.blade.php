@extends('layouts.app')
@section('content')
<transaction-report
    uri="{{$uri}}"
    name="{{$name}}"
    :users="{{ json_encode($users) }}"
    :warehouses="{{json_encode($inventories)}}">
</transaction-report>
@endsection