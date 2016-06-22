<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Qso;

class ReceiveQsos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qso:receive {port=12060}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the listener';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Set port from argument
        $port = $this->argument('port');

        $this->info("Opening a socket on port $port");

        // Open a socket to listen for UDP packets
        $socket = stream_socket_server("udp://0.0.0.0:$port", $errno, $errstr, STREAM_SERVER_BIND);
        if (!$socket) {
            $this->error('Failed to open socket');
            die("$errstr ($errno)");
        }

        // Listen
        $this->info('Listening...'. stream_socket_get_name($socket, false));

        do {
            $packet = stream_socket_recvfrom($socket, 1500, STREAM_OOB, $peer);
            $this->info("Received Q from: $peer");

            // Parse QSO into an array
            $qso = json_decode(json_encode((array) simplexml_load_string($packet)), 1);

            // Quick fix on formatting for the model
            $qso['section'] = !empty($qso['section'][0]) ? $qso['section'][0] : null;
            $qso['exchange1'] = !empty($qso['exchange1'][0]) ? $qso['exchange1'][0] : null;

            try {
                $contact = Qso::create($qso);
            } catch (\Exception $e) {
                $this->error('Failed to save contact '. $e->getMessage());
            }

            if ($contact->save())
                $this->info('Contact sucessfully saved with -> '. $contact->call);


        } while ($packet !== false);

    }
}