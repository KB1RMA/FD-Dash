;(function ($) {


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

})(window.jQuery);

//# sourceMappingURL=all.js.map
