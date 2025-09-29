@extends('layouts.app')

@section('content')
    @php
        // dd($users);
    @endphp
    @livewire('users', ['users' => $users])
@endsection