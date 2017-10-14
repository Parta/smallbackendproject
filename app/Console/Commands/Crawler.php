<?php

namespace App\Console\Commands;

use App\Models\FansLike;
use App\Services\FacebookApplication;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:hour {page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to crawl Facebook pages and get fans evolution';

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
        $startTime = Carbon::now();
        \Log::info("Crawler started @ {$startTime}");

        $page = $this->argument('page') ?? 'cocacola';

        $fb = new FacebookApplication();
        $results = $fb->getPageFansCount($page);

        if ($results['page_id']) {
            $results = array_merge(
                $results,
                [
                    'page'          => $page,
                    'request_time'  => $startTime
                ]
            );

            \Log::info("Page: {$page}; Fans Count: {$results['count']}");
            $fansLike = new FansLike($results);
            $fansLike->save();
        } else {
            \Log::info("No results from API");
        }


        \Log::info("Crawler finished");

    }
}
