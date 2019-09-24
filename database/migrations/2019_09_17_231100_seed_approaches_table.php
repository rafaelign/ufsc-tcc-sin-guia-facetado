<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedApproachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $approach_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lacinia neque quis tellus dapibus, ut vulputate sem varius. Cras vehicula rutrum sapien sit amet consectetur. Sed molestie, ligula ac efficitur accumsan, mauris arcu placerat orci, a pulvinar velit metus nec ipsum. Sed pellentesque, lorem ac vulputate imperdiet, elit diam egestas nulla, sed aliquam leo velit ut leo. Etiam vehicula libero nisi, in fringilla massa sagittis vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus. In vitae eros sit amet libero malesuada maximus id in nunc. Curabitur in urna quis nibh tempus fermentum eget eu lacus. Etiam quis dui sed odio ultricies fermentum vitae at diam. Aenean malesuada felis non urna finibus, id imperdiet lorem sagittis. Praesent varius ac ante ac vehicula. Suspendisse ornare neque eu porta cursus. In finibus dolor enim, nec tristique velit accumsan sed. Phasellus tempor nulla risus, nec sodales ex convallis id. Donec luctus nibh eu risus ultricies, eget tempor lacus malesuada. Praesent id pharetra eros.';
        $context_description = 'Mauris placerat commodo diam vitae lacinia. Duis ac nibh euismod urna facilisis tincidunt quis vel nunc. Aenean felis diam, pulvinar at augue nec, pulvinar tincidunt turpis. Maecenas fermentum ex eros, non scelerisque odio ultrices id. Vestibulum fringilla felis urna, eu condimentum ligula lacinia nec. Curabitur pulvinar justo ac enim maximus consequat. Aenean porta dui diam, a ornare arcu gravida nec. Maecenas non odio aliquam, dictum velit sit amet, porttitor turpis. Phasellus convallis nunc id nibh laoreet faucibus. Praesent sollicitudin eros nisl, eget vulputate enim posuere tincidunt. Nullam gravida feugiat gravida. Duis feugiat neque eget vulputate lobortis.';

        DB::table('approaches')->insert([
            'approach_title'    => 'Nome da abordagem',
            'slug'              => 'abordagem-exemplo',
            'short_description' => 'Vestibulum mollis laoreet metus nec vestibulum. Suspendisse tempor odio mauris, ac mattis justo tristique in. Sed velit nulla, hendrerit at turpis eget, sagittis ultricies magna.',
            'approach_description' => $approach_description,
            'context_title' => 'Contexto de aplicação',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE * FROM approaches');
    }


}
