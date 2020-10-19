@extends('layouts.app')
@section('content')
    <product-form 
        :product="{{$product}}" 
        method="put"
    />
@endsection