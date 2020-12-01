@extends('layouts.app')
@section('content')
    <div class="flex justify-center mt-20 items-baseline">
        <category-search ></category-search>
        <category-form ></category-form>
        <product-form method="post"></product-form>   
    </div>
@endsection