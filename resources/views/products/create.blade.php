@extends('layouts.app')
@section('content')
    <div class="flex justify-center md:mt-20 mt-10 items-baseline flex-wrap">
        <category-search class="mr-4 mb-0"></category-search>
        <category-form class="mr-4 mb-0"></category-form>
        <product-form method="post"></product-form>   
    </div>
@endsection