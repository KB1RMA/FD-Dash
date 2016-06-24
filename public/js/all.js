;(function ($) {


    var pusher = new Pusher('8290855d55df4ff7faf2', {
      encrypted: true
    });

    var channel = pusher.subscribe('qso');
    channel.bind('App\\Events\\NewQso', function(data) {
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

//# sourceMappingURL=all.js.map
