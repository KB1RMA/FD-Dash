;(function ($) {


    var socket = io('http://hamdash.app:3002');

    // Bind to the new Qso event
    socket.on('qso:App\\Events\\NewQso', function (data) {
        var
            $table = $('#last-qso-table'),
            qso = data.qso;

        $table
            .addClass('loading')
            .prepend(
                '<tr class="inactive" data-qso-id="'+ qso.id +'">' +
                '<td>' + qso.call + '</td>' +
                '<td>' + qso.band + '</td>' +
                '<td>' + qso.rxfreq + '</td>' +
                '<td>' + qso.section + '</td>' +
                '<td>' + qso.operator + '</td>' +
                '<td>' + qso.created_at + '</td>' +
                '</tr>'
            )
            .delay(1000)
            .removeClass('loading')
            .find('.inactive')
            .removeClass('inactive');

          console.log(data);
    });

    // Initialize the graph
    var
        chart = new SmoothieChart({
            millisPerPixel: 100,
            grid: {
                fillStyle: 'transparent',
                sharpLines: true,
                millisPerLine: 9000,
                verticalSections: 13,
                borderVisible:false
            },
            labels: {
                fillStyle:'#000000'
            }
        }),
        canvas = document.getElementById('smoothie-chart'),
        series = new TimeSeries();

    chart.addTimeSeries(series, {
        lineWidth: 2,
        strokeStyle: '#00ff00'
    });
    chart.streamTo(canvas, 868);

})(window.jQuery);

//# sourceMappingURL=all.js.map
