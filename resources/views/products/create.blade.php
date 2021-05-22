@extends('layouts.app')
@section('content')
    <div class="flex justify-center  mt-24 md:mt-32 items-baseline flex-wrap px-4">
        {{-- <category-search class="md:mr-4 mb-0"></category-search>
        <category-form class="md:mr-4 mb-0"></category-form> --}}
        <product-form method="post" :categories="{{json_encode($categories)}}"></product-form>   
    </div>
@endsection