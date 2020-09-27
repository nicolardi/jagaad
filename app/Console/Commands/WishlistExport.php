<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WishlistExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wishlist:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports the wishlist in CSV format';

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
     * Export the wishlists data as CSV
     *
     * @return int
     */
    public function handle()
    {
        $data = DB::table('wishlists_contents','c')
                ->select(DB::raw('wishlists.user_id, wishlists.name as title, count(*) as count'))
                ->join('wishlists', 'c.wishlist_id', '=','wishlists.id')
                ->groupBy(['wishlists.user_id','wishlists.name'])
                ->get();

        $f = fopen('php://stdout', 'w');
        foreach ($data as $d) {
            fputcsv($f, [
                $d->user_id,
                $d->title,
                $d->count
            ]);
        }

        fclose($f);
        return 0;
    }
}
