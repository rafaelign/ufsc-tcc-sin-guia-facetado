<?php

use Illuminate\Database\Seeder;

class RETechniqueCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create([
            'title' => 'Técnias de Elicitação de Requisitos',
            'slug'  => str_slug('Técnias de Elicitação de Requisitos'),
        ]);
    }

    private function create(array $collection)
    {
        DB::table('collections')->insert($collection);
        $this->command->info("Collection {$collection['titkle']} created");
    }
}
