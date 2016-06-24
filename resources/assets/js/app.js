;(function ($) {


    var socket = io('http://hamdash.app:3002');

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

})(window.jQuery);
