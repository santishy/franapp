@extends('layouts.app')
@section('content')
    <returns-report  uri="{{$uri}}"
    :users="{{ json_encode($users) }}"
    :warehouses="{{json_encode($inventories)}}" >
    </returns-report>
@endsection
