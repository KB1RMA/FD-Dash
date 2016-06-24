@extends('layouts.master')

@section('content')
            <div class="content">
                <canvas id="smoothie-chart" width="712" height="275">
            </div>
            <div class="content">
                <h2 class="title">W1NY</h2>
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>CALL</th>
                            <th>BAND</th>
                            <th>FREQ</th>
                            <th>SEC</th>
                            <th>OP</th>
                            <th>TIME</th>
                        </tr>
                    </thead>
                    <tbody class="slide-on-load" id="last-qso-table">
                    @foreach ($lastten as $qso)
                        <tr data-qso-id="{{ $qso->id}}">
                            <td>{{ $qso->call }}</td>
                            <td>{{ $qso->band }}</td>
                            <td>{{ $qso->rxfreq }}</td>
                            <td>{{ $qso->section }}</td>
                            <td>{{ $qso->operator }}</td>
                            <td>{{ $qso->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection