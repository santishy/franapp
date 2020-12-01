@extends('layouts.app')
@section('content')
    <div class="flex justify-center mt-20 items-baseline">
        <category-search class="mr-4"></category-search>
        <category-form class="mr-4"></category-form>
        <product-form method="post"></product-form>   
    </div>
@endsection