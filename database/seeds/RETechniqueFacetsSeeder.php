<?php

use Illuminate\Database\Seeder;

class RETechniqueFacetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get collection

        $this->create([]);
    }

    private function create(array $facet)
    {
        DB::table('facets')->insert($facet);
        $this->command->info("Facet {$facet['title']} created");



//        $this->addValues())
    }

    private function addValues(array $values)
    {
        DB::table('values')->insert($values);
    }
}
