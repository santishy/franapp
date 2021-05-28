@extends('layouts.app')
@section('content')
<div class="flex flex-wrap items-baseline">
    <register-component 
        class="mr-4"
        :inventories="{{json_encode($inventories)}}"
        method="post"
        uri="/register"
    >
    </register-component>
    <assign-role 
        :roles="{{json_encode($roles)}}"
        class="self-start"
    ></assign-role>
</div>
        
@endsection