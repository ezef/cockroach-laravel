<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdjustSchemaForDataDomiciling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cockroachdb:adjust-schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adjust CockroachDB Schema for data domiciling compliance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $database_name = config('database.name');

        // Set regions for our database
        DB::statement("ALTER DATABASE $database_name PRIMARY REGION \"us-east1\" ");
        DB::statement("ALTER DATABASE $database_name ADD REGION \"europe-west1\" ");
        DB::statement("ALTER DATABASE $database_name ADD REGION \"us-west1\" ");

        // Apply stricter replica placement settings to ensure Data locality on each restricted locality only.
        DB::statement("SET enable_multiregion_placement_policy=on");
        DB::statement("ALTER DATABASE $database_name PLACEMENT RESTRICTED");

        // Set locality as global for countries and hospitals
        DB::statement("ALTER TABLE $database_name.countries SET locality GLOBAL;");
        DB::statement("ALTER TABLE $database_name.hospitals SET locality GLOBAL;");

        // Patiens with EU country will stay on EU region. Others will stay on USA region
        $france_country_id = Country::where('name', 'France')->first()->id;
        $germany_country_id = Country::where('name', 'Germany')->first()->id;

        $sql = "ALTER TABLE $database_name.patients ADD COLUMN region crdb_internal_region AS (";
        $sql .= "  CASE WHEN country_id = $france_country_id THEN 'europe-west1'";
        $sql .= "       WHEN country_id = $germany_country_id THEN 'europe-west1'";
        $sql .= "  ELSE 'us-east1'";
        $sql .= '  END';
        $sql .= ') STORED;';
        DB::statement($sql);

        DB::statement("ALTER TABLE $database_name.patients ALTER COLUMN REGION SET NOT NULL");
        DB::statement("ALTER TABLE $database_name.patients SET LOCALITY REGIONAL BY ROW AS \"region\"");

        // medical practices will live only on us-west1 USA region
        DB::statement("ALTER TABLE $database_name.medical_practices SET LOCALITY REGIONAL BY TABLE IN \"us-west1\"");

        $this->info('Done');
    }
}
