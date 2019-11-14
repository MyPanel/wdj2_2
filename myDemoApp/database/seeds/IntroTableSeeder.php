<?php

use Illuminate\Database\Seeder;

class IntroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Intro::create([
            'name'=>'조영준',
            'comment'=>'현지학기제를 통해 일본생활에 대해 좀더 알게 되었고 일본 취업에 대한 생각을 더욱 가지게 되었고
            일본어에 대해 부족한 부분을 한번 더 확인할 수 있어서 좋은 경험이었습니다.',
            'imgUrl'=>'/image/조영준.jpg'
        ]);
        App\Intro::create([
            'name'=>'장재일',
            'comment'=>'좋은 경험이었습니다.',
            'imgUrl'=>'/image/장재일.jpg'
        ]);
    }
}
