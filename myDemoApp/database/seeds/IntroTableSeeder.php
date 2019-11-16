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
        App\Intro::create([
            'name'=>'권수정',
            'comment'=>'이때까지 배운 일본어를 최대한 많이 활용하기!’ 라는 목표를 이루기 위해 일본인 친구들에게 먼저 말을 걸거나 메세지를 보내며 친구를 만들었습니다. 일본인 친구들과 대화를 하며 일본어로 의사소통이 가능하단 것에 기뻤던 순간도 있었지만 생각한 것을 일본어로 표현할 수 없어서 답답한 순간도 많았습니다. 할 수 있다는 자신감도 생긴 반면 부족한 점들도 많이 느껴 열심히 일본어공부를 해서 일본어를 더 잘하고 싶다는 확실한 동기부여를 받았습니다.',
            'imgUrl'=>'/image/권수정.jpg'
        ]);
    }
}
