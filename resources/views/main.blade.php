<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
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
        </div>

      <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
      <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
      <script>


        var pusher = new Pusher('8290855d55df4ff7faf2', {
          encrypted: true
        });

        var channel = pusher.subscribe('qso');
        channel.bind('App\\Events\\NewQso', function(data) {
            var
                $table = $('#last-qso-table'),
                qso = data.qso;

            $table.prepend(
                '<tr>' +
                '<td>' + qso.call + '</td>' +
                '<td>' + qso.band + '</td>' +
                '<td>' + qso.rxfreq + '</td>' +
                '<td>' + qso.section + '</td>' +
                '<td>' + qso.operator + '</td>' +
                '<td>' + qso.timestamp + '</td>' +
                '</tr>');

              console.log(data);
        });
      </script>
    </body>
</html>