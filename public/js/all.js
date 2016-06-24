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
                '<td>' + qso.section + '</td>' +
                '<td>' + qso.operator + '</td>' +
                '<td>' + qso.created_at + '</td>' +
                '</tr>'
            )
            .delay(1000)
            .removeClass('loading')
            .find('.inactive')
            .removeClass('inactive')
            .find('tr:last-child')
            .remove();

          console.log(data);
    });

    // Initialize the graph
    var
        chart = new SmoothieChart({
            millisPerPixel: 400, // Chart scroll speed
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
        total = new TimeSeries(),
        m20 = new TimeSeries(),
        m40 = new TimeSeries(),
        m80 = new TimeSeries();

    chart.addTimeSeries(total, { strokeStyle: '#00ff00' });
    chart.addTimeSeries(m20,   { strokeStyle: '#00ff00' });
    chart.addTimeSeries(m40,   { strokeStyle: '#00ff00' });
    chart.addTimeSeries(m80,   { strokeStyle: '#00ff00' });

    chart.streamTo(canvas, 10);


    // Update Statistics
    socket.on('qso:App\\Events\\UpdateStats', function (data) {
        total.append(new Date().getTime(), data.stats.total);
        m20.append(new Date().getTime(), data.stats['14']);
        m40.append(new Date().getTime(), data.stats['7']);
        m80.append(new Date().getTime(), data.stats['4']);

        console.log(data);
    });

})(window.jQuery);

//# sourceMappingURL=all.js.map
