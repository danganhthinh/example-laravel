<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelDataUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('label_data_user')->truncate();
        $string = "型番	会員ID	ステータス	測定日	測定時刻	体型	性別	年令	身長	着衣量	体重	体脂肪率	脂肪量	除脂肪量	筋肉量	全身筋肉スコア	推定骨量	体水分量	細胞内液	細胞外液	BMI	標準体重	肥満度	内臓脂肪レベル	脚点	基礎代謝量	基礎代謝判定	ローレル指数	出産(予定)日	体重増加量	胎児体重	妊娠前BMI	水分脂肪比	右足－体脂肪率	右足－脂肪量	右足－除脂肪量	右足－筋肉量	右足－体脂肪率スコア	右足－筋肉量スコア	左足－体脂肪率	左足－脂肪量	左足－除脂肪量	左足－筋肉量	左足－体脂肪率スコア	左足－筋肉量スコア	右腕－体脂肪率	右腕－脂肪量	右腕－除脂肪量	右腕－筋肉量	右腕－体脂肪率スコア	右腕－筋肉量スコア	左腕－体脂肪率	左腕－脂肪量	左腕－除脂肪量	左腕－筋肉量	左腕－体脂肪率スコア	左腕－筋肉量スコア	体幹部－体脂肪率	体幹部－脂肪量	体幹部－除脂肪量	体幹部－筋肉量	体幹部－体脂肪率スコア	体幹部－筋肉量スコア	左半身－R(5kHz)	左半身－X(5kHz)	左半身－R(50kHz)	左半身－X(50kHz)	左半身－R(250kHz)	左半身－X(250kHz)	左半身－R(500kHz)	左半身－X(500kHz)	右足－R(5kHz)	右足－X(5kHz)	右足－R(50kHz)	右足－X(50kHz)	右足－R(250kHz)	右足－X(250kHz)	右足－R(500kHz)	右足－X(500kHz)	左足－R(5kHz)	左足－X(5kHz)	左足－R(50kHz)	左足－X(50kHz)	左足－R(250kHz)	左足－X(250kHz)	左足－R(500kHz)	左足－X(500kHz)	右腕－R(5kHz)	右腕－X(5kHz)	右腕－R(50kHz)	右腕－X(50kHz)	右腕－R(250kHz)	右腕－X(250kHz)	右腕－R(500kHz)	右腕－X(500kHz)	左腕－R(5kHz)	左腕－X(5kHz)	左腕－R(50kHz)	左腕－X(50kHz)	左腕－R(250kHz)	左腕－X(250kHz)	左腕－R(500kHz)	左腕－X(500kHz)	両足－R(5kHz)	両足－X(5kHz)	両足－R(50kHz)	両足－X(50kHz)	両足－R(250kHz)	両足－X(250kHz)	両足－R(500kHz)	両足－X(500kHz)	チェックサム	最高血圧	最低血圧	脈拍数	ウェスト	ヒップ	Dummy1	Dummy2	Dummy3	Dummy4	Dummy5	Dummy6	Dummy7	Dummy8	体水分率	標準体脂肪率	標準筋肉量	左右バランス（手）	左右バランス（足）	アスリート指数	GS目標体脂肪率	GS予想体重	GS予想脂肪量	GS脂肪量増減量	左半身－R(1kHz)	左半身－X(1kHz)	左半身－R(1000kHz)	左半身－X(1000kHz)	右足－R(1kHz)	右足－X(1kHz)	右足－R(1000kHz)	右足－X(1000kHz)	左足－R(1kHz)	左足－X(1kHz)	左足－R(1000kHz)	左足－X(1000kHz)	右腕－R(1kHz)	右腕－X(1kHz)	右腕－R(1000kHz)	右腕－X(1000kHz)	左腕－R(1kHz)	左腕－X(1kHz)	左腕－R(1000kHz)	左腕－X(1000kHz)	両足－R(1kHz)	両足－X(1kHz)	両足－R(1000kHz)	両足－X(1000kHz)	位相差－左半身(50kHz)	位相差－右足(50kHz)	位相差－左足(50kHz)	位相差－右腕(50kHz)	位相差－左腕(50kHz)	位相差－両足(50kHz)	測定日（長い形式）	サルコペニア肥満－MM/H^2	サルコペニア肥満－MM/BW	サルコペニア肥満－ASM/H^2	サルコペニア肥満－ASM/BW	接触状態	両手-R(1kHz)	両手-X(1kHz)	両手-R(5kHz)	両手-X(5kHz)	両手-R(50kHz)	両手-X(50kHz)	両手-R(250kHz)	両手-X(250kHz)	両手-R(500kHz)	両手-X(500kHz)	両手-R(1000kHz)	両手-X(1000kHz)	右半身-R(1kHz)	右半身-X(1kHz)	右半身-R(5kHz)	右半身-X(5kHz)	右半身-R(50kHz)	右半身-X(50kHz)	右半身-R(250kHz)	右半身-X(250kHz)	右半身-R(500kHz)	右半身-X(500kHz)	右半身-R(1000kHz)	右半身-X(1000kHz)	位相差-両手(50kHz)	位相差-右半身(50kHz)	四肢骨格筋量	細胞外液比	タンパク質など	体型2";


        $array = (explode('	', $string));

        $orders = [
            '測定日', '身長', '体重', '体脂肪率', '筋肉量',
            '右足－筋肉量', '左足－筋肉量', '右腕－筋肉量', '左腕－筋肉量',
            '体幹部－筋肉量', '測定日（長い形式）'
        ];

        $data = [];

        foreach ($array as $key => $item) {
            if ($key < 8) continue;
            $data[] = [
                "key" => "column_$key",
                "value" => $item,
                "order" => in_array($item, $orders) ? 1 : 10
            ];
        }

        DB::table('label_data_user')->insert($data);
    }
}
