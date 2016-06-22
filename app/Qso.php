<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Event;
use App\Events\NewQso;

class Qso extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['band', 'rxfreq', 'txfreq', 'operator', 'mode', 'call', 'exchange1', 'section'];


}