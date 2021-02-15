@extends('layouts.app')
@section('content')
    <div class="w-full flex justify-center items-center">
        <category-search class="mr-4"></category-search>
        <category-form class="mr-4"></category-form>
        <product-form 
        :product="{{$product}}" 
        method="put"
        class="mt-4"
        />
    </div>
@endsection