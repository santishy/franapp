@extends('layouts.app')
@section('content')
    
        {{-- <category-search class="md:mr-4 mb-0"></category-search>
        <category-form class="md:mr-4 mb-0"></category-form> --}}
        <product-form method="post" :categories="{{json_encode($categories)}}"></product-form>   

@endsection