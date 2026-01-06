@extends('layouts.form')

@section('title', 'WhoTouchedIt - Analytique machines')

@section('content')
    <p class="text-xs px-2 py-1 bg-green-500/10 text-green-400 rounded-full">Nb inter par machine : </p>
    @foreach($nbInterPerMachines as $machine => $nbInter)
        <p class="text-xs px-2 py-1 bg-green-500/10 text-green-400 rounded-full">{{ $machine }} : {{$nbInter}}</p>
    @endforeach
@endsection
