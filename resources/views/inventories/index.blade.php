@extends('layouts.app')
@section('content')
    <inventory-list :inventories="{{json_encode($inventories)}}"></inventory-list>
@endsection