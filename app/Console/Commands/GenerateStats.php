<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Event;
use App\Events\UpdateStats;
use Carbon\Carbon;
use App\Qso;
use DB;

class GenerateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qso:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QSO statistics';

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
        $bands = [
            '14', // 20M
            '7',  // 40M
            '4',  // 80M
        ];

        $stats = [];

        // Generate the QSO rate for the last hour of the total station
        $stats['total'] = Qso::where('created_at', '>=', Carbon::now()->subHour())->count();

        // Now by individual bands
        foreach ($bands as $band) {
            $rate = Qso::where('created_at', '>=', Carbon::now()->subHour())
                       ->where('band', $band)
                       ->count();

            $stats[$band] = $rate;
        }

        // Find top operators
        $stats['operators'] = Qso::select(DB::raw('operator,COUNT(*) as count'))
            ->groupBy('operator')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get();

        // Find top sections
        $stats['sections'] = Qso::select(DB::raw('section,COUNT(*) as count'))
            ->groupBy('section')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get();

        // Send it off into the world
        Event::fire(new UpdateStats($stats));
    }
}