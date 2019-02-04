<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 25/01/2019, 3:26 PM
 */

namespace DevProject\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class Sandbox
 *
 * @package DevProject\Console\Commands
 */
class Sandbox extends Command
{
    protected $name = 'sandbox';
    protected $signature = 'sandbox';
    protected $description = 'For testing new app Features';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Sandbox Works.... Write test code here');
    }
}
