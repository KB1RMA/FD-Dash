@extends('layouts.master')

@section('content')
            <div class="content">
                <div class="title">W1NY</div>
                <table>
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
                    <tbody id="last-qso-table">
                    @foreach ($lastten as $qso)
                        <tr data-qso-id="{{ $qso->id}}">
                            <td>{{ $qso->call }}</td>
                            <td>{{ $qso->band }}</td>
                            <td>{{ $qso->rxfreq }}</td>
                            <td>{{ $qso->section }}</td>
                            <td>{{ $qso->operator }}</td>
                            <td>{{ $qso->timestamp }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection