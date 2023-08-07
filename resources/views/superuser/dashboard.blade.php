@extends('superuser.layouts.master')

@section('title', 'dashboard')

@section('myContent')
    <div class="container p-3">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Registeration Date</th>
                        <th scope="col" class="text-center">User Count</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($persons) != 0)
                    @foreach ($persons as $person)
                    <tr>
                        <td class="text-center">{{ $person->date }}</td>
                        <td class="text-center">{{ $person->count }}</td>
                    </tr>
                @endforeach
                    @else
                        <td class="text-secondary mt-5 text-center">There is no Admin user Lists here</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
