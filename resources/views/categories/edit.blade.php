@extends('layouts.app')
@section('content')
    <edit-category :category="{{json_encode($category)}}"></edit-category>
@endsection