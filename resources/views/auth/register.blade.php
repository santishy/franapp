@extends('layouts.app')
@section('content')
<div class="flex flex-wrap items-baseline">
    <register-component class="mr-4"></register-component>
    <assign-role 
        :roles="{{json_encode($roles)}}"
        class="self-start"
    ></assign-role>
</div>
        
@endsection