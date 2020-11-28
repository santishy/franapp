@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <category-search class="mt-20 mr-4 h-56"></category-search>
        <category-form class="mt-20 mr-4 h-56"></category-form>
        <product-form class="mt-20" method="post"></product-form>   
    </div>
@endsection