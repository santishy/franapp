@extends('layouts.app')
@section('content')
    <div class="p-4">
        <client-form 
        :client="{{$client}}" 
        method="put"  
        />
    </div>
    
@endsection