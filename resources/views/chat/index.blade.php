@extends('layouts.app')

@section('content')
<div class="container">

                    <chat-component
                    v-bind:user="{{ Auth::id() }}"
                    v-bind:data="{{ json_encode($data) }}"></chat-component>

</div>
@endsection
