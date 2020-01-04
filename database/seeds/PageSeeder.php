<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkimizda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count = 0;

        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => str_slug($page),
                'image' => 'https://149349300.v2.pressablecdn.com/wp-content/uploads/2019/04/agenda-analysis-business-plan-990818.jpg',
                'content' => 'Irure nulla eiusmod occaecat duis mollit fugiat magna eiusmod elit. Adipisicing adipisicing velit ipsum irure culpa commodo consequat consectetur nulla in occaecat. Do mollit qui ea et commodo sint fugiat non ad sit veniam dolor eu culpa. Eiusmod anim excepteur sint voluptate ipsum quis reprehenderit incididunt sit laboris laboris ea quis aute. Fugiat quis occaecat nostrud enim enim. Duis incididunt sunt est quis laboris cillum enim enim.',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
        }
    }
}
