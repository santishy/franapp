@extends('layouts.app')
@section('content')
    <div class="p-4 md:mt-32 mt-24">
        <client-form 
        :client="{{$client}}" 
        method="put"  
        />
    </div>
    
@endsection