@extends('layouts.app')
@section('content')
    <div class="mt-32 flex flex-wrap items-baseline">
        <category-form class="self-start"></category-form>
        <div class="ml-6 w-2/4">
            <category-list></category-list>
        </div>
       
    </div>
@endsection