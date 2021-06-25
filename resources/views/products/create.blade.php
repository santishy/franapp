@extends('layouts.app')
@section('content')
        <product-form 
                method="post" 
                :categories="{{json_encode($categories)}}"
        ></product-form>   
@endsection