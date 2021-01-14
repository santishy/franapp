@extends('layouts.app')
@section('content')
    <sale-component 
        :sale="{{json_encode($sale)}}">
    </sale-component>
@endsection