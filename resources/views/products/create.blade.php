@extends('layouts.app')
@section('content')
    <div class="flex justify-center md:mt-20 mt-10 items-baseline flex-wrap px-4">
        <category-search class="md:mr-4 mb-0"></category-search>
        <category-form class="md:mr-4 mb-0"></category-form>
        <product-form method="post"></product-form>   
    </div>
@endsection