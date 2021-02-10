@extends('layouts.app')
@section('content')
    <div class="w-full flex justify-center items-center">
        <h1>hola</h1>
        <category-form class="mr-4"></category-form>
        <product-form 
        :product="{{$product}}" 
        method="put"
        class="mt-4"
        />
    </div>
@endsection