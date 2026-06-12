<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Farm;

class UpdateFarmDistrict extends Command
{
    protected $signature = 'farms:update-district';

    protected $description = 'Update district from address';

    public function handle()
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {

            preg_match(
                '/Kec\.\s*([^,]+)/',
                $farm->address,
                $matches
            );

            if (isset($matches[1])) {

                $farm->district =
                    trim($matches[1]);

                $farm->save();

                $this->info(
                    $farm->name .
                    ' => ' .
                    $farm->district
                );
            }
        }

        $this->info('Done!');
    }
}