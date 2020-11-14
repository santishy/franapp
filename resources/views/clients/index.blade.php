@extends('layouts.app')
@section('content')
    
    <client-list :clients="{{json_encode($clients)}}"/>
    
@endsection