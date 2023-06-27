<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_user', function (Blueprint $table) {
            $table->id();
            $table->string('model_number')->nullable();
            $table->string('code_user');
            $table->string('status')->nullable();
            $table->date('measuring_date')->nullable();
            $table->time('measurement_time')->nullable();
            $table->dateTime('measuring_date_time')->nullable();
            $table->string('figure')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable()->comment('');
            $table->string('data_name')->nullable()->comment('');
            $table->float('column_8')->nullable()->comment('身長');
            $table->float('column_9')->nullable()->comment('着衣量');
            $table->float('column_10')->nullable()->comment('体重');
            $table->float('column_11')->nullable()->comment('体脂肪率');
            $table->float('column_12')->nullable()->comment('脂肪量');
            $table->float('column_13')->nullable()->comment('除脂肪量');
            $table->float('column_14')->nullable()->comment('筋肉量');
            $table->float('column_15')->nullable()->comment('全身筋肉スコア');
            $table->float('column_16')->nullable()->comment('推定骨量');
            $table->float('column_17')->nullable()->comment('体水分量');
            $table->float('column_18')->nullable()->comment('細胞内液');
            $table->float('column_19')->nullable()->comment('細胞外液');
            $table->float('column_20')->nullable()->comment('BMI');
            $table->float('column_21')->nullable()->comment('標準体重');
            $table->float('column_22')->nullable()->comment('肥満度');
            $table->float('column_23')->nullable()->comment('内臓脂肪レベル');
            $table->float('column_24')->nullable()->comment('脚点');
            $table->float('column_25')->nullable()->comment('基礎代謝量');
            $table->float('column_26')->nullable()->comment('基礎代謝判定');
            $table->float('column_27')->nullable()->comment('ローレル指数');
            $table->float('column_28')->nullable()->comment('出産(予定)日');
            $table->float('column_29')->nullable()->comment('体重増加量');
            $table->float('column_30')->nullable()->comment('胎児体重');
            $table->float('column_31')->nullable()->comment('妊娠前BMI');
            $table->float('column_32')->nullable()->comment('水分脂肪比');
            $table->float('column_33')->nullable()->comment('右足−体脂肪率');
            $table->float('column_34')->nullable()->comment('右足−脂肪量');
            $table->float('column_35')->nullable()->comment('右足−除脂肪量');
            $table->float('column_36')->nullable()->comment('右足−筋肉量');
            $table->float('column_37')->nullable()->comment('右足−体脂肪率スコア');
            $table->float('column_38')->nullable()->comment('右足−筋肉量スコア');
            $table->float('column_39')->nullable()->comment('左足−体脂肪率');
            $table->float('column_40')->nullable()->comment('左足−脂肪量');
            $table->float('column_41')->nullable()->comment('左足−除脂肪量');
            $table->float('column_42')->nullable()->comment('左足−筋肉量');
            $table->float('column_43')->nullable()->comment('左足−体脂肪率スコア');
            $table->float('column_44')->nullable()->comment('左足−筋肉量スコア');
            $table->float('column_45')->nullable()->comment('右腕−体脂肪率');
            $table->float('column_46')->nullable()->comment('右腕−脂肪量');
            $table->float('column_47')->nullable()->comment('右腕−除脂肪量');
            $table->float('column_48')->nullable()->comment('右腕−筋肉量');
            $table->float('column_49')->nullable()->comment('右腕−体脂肪率スコア');
            $table->float('column_50')->nullable()->comment('右腕−筋肉量スコア');
            $table->float('column_51')->nullable()->comment('左腕−体脂肪率');
            $table->float('column_52')->nullable()->comment('左腕−脂肪量');
            $table->float('column_53')->nullable()->comment('左腕−除脂肪量');
            $table->float('column_54')->nullable()->comment('左腕−筋肉量');
            $table->float('column_55')->nullable()->comment('左腕−体脂肪率スコア');
            $table->float('column_56')->nullable()->comment('左腕−筋肉量スコア');
            $table->float('column_57')->nullable()->comment('体幹部−体脂肪率');
            $table->float('column_58')->nullable()->comment('体幹部−脂肪量');
            $table->float('column_59')->nullable()->comment('体幹部−除脂肪量');
            $table->float('column_60')->nullable()->comment('体幹部−筋肉量');
            $table->float('column_61')->nullable()->comment('体幹部−体脂肪率スコア');
            $table->float('column_62')->nullable()->comment('体幹部−筋肉量スコア');
            $table->float('column_63')->nullable()->comment('左半身−R(5kHz)');
            $table->float('column_64')->nullable()->comment('左半身−X(5kHz)');
            $table->float('column_65')->nullable()->comment('左半身−R(50kHz)');
            $table->float('column_66')->nullable()->comment('左半身−X(50kHz)');
            $table->float('column_67')->nullable()->comment('左半身−R(250kHz)');
            $table->float('column_68')->nullable()->comment('左半身−X(250kHz)');
            $table->float('column_69')->nullable()->comment('左半身−R(500kHz)');
            $table->float('column_70')->nullable()->comment('左半身−X(500kHz)');
            $table->float('column_71')->nullable()->comment('右足−R(5kHz)');
            $table->float('column_72')->nullable()->comment('右足−X(5kHz)');
            $table->float('column_73')->nullable()->comment('右足−R(50kHz)');
            $table->float('column_74')->nullable()->comment('右足−X(50kHz)');
            $table->float('column_75')->nullable()->comment('右足−R(250kHz)');
            $table->float('column_76')->nullable()->comment('右足−X(250kHz)');
            $table->float('column_77')->nullable()->comment('右足−R(500kHz)');
            $table->float('column_78')->nullable()->comment('右足−X(500kHz)');
            $table->float('column_79')->nullable()->comment('左足−R(5kHz)');
            $table->float('column_80')->nullable()->comment('左足−X(5kHz)');
            $table->float('column_81')->nullable()->comment('左足−R(50kHz)');
            $table->float('column_82')->nullable()->comment('左足−X(50kHz)');
            $table->float('column_83')->nullable()->comment('左足−R(250kHz)');
            $table->float('column_84')->nullable()->comment('左足−X(250kHz)');
            $table->float('column_85')->nullable()->comment('左足−R(500kHz)');
            $table->float('column_86')->nullable()->comment('左足−X(500kHz)');
            $table->float('column_87')->nullable()->comment('右腕−R(5kHz)');
            $table->float('column_88')->nullable()->comment('右腕−X(5kHz)');
            $table->float('column_89')->nullable()->comment('右腕−R(50kHz)');
            $table->float('column_90')->nullable()->comment('右腕−X(50kHz)');
            $table->float('column_91')->nullable()->comment('右腕−R(250kHz)');
            $table->float('column_92')->nullable()->comment('右腕−X(250kHz)');
            $table->float('column_93')->nullable()->comment('右腕−R(500kHz)');
            $table->float('column_94')->nullable()->comment('右腕−X(500kHz)');
            $table->float('column_95')->nullable()->comment('左腕−R(5kHz)');
            $table->float('column_96')->nullable()->comment('左腕−X(5kHz)');
            $table->float('column_97')->nullable()->comment('左腕−R(50kHz)');
            $table->float('column_98')->nullable()->comment('左腕−X(50kHz)');
            $table->float('column_99')->nullable()->comment('左腕−R(250kHz)');
            $table->float('column_100')->nullable()->comment('左腕−X(250kHz)');
            $table->float('column_101')->nullable()->comment('左腕−R(500kHz)');
            $table->float('column_102')->nullable()->comment('左腕−X(500kHz)');
            $table->float('column_103')->nullable()->comment('両足−R(5kHz)');
            $table->float('column_104')->nullable()->comment('両足−X(5kHz)');
            $table->float('column_105')->nullable()->comment('両足−R(50kHz)');
            $table->float('column_106')->nullable()->comment('両足−X(50kHz)');
            $table->float('column_107')->nullable()->comment('両足−R(250kHz)');
            $table->float('column_108')->nullable()->comment('両足−X(250kHz)');
            $table->float('column_109')->nullable()->comment('両足−R(500kHz)');
            $table->float('column_110')->nullable()->comment('両足−X(500kHz)');
            $table->float('column_111')->nullable()->comment('チェックサム');
            $table->float('column_112')->nullable()->comment('最高血圧');
            $table->float('column_113')->nullable()->comment('最低血圧');
            $table->float('column_114')->nullable()->comment('脈拍数');
            $table->float('column_115')->nullable()->comment('ウェスト');
            $table->float('column_116')->nullable()->comment('ヒップ');
            $table->float('column_117')->nullable()->comment('Dummy1');
            $table->float('column_118')->nullable()->comment('Dummy2');
            $table->float('column_119')->nullable()->comment('Dummy3');
            $table->float('column_120')->nullable()->comment('Dummy4');
            $table->float('column_121')->nullable()->comment('Dummy5');
            $table->float('column_122')->nullable()->comment('Dummy6');
            $table->float('column_123')->nullable()->comment('Dummy7');
            $table->float('column_124')->nullable()->comment('Dummy8');
            $table->float('column_125')->nullable()->comment('体水分率');
            $table->float('column_126')->nullable()->comment('標準体脂肪率');
            $table->float('column_127')->nullable()->comment('標準筋肉量');
            $table->float('column_128')->nullable()->comment('左右バランス（手）');
            $table->float('column_129')->nullable()->comment('左右バランス（足）');
            $table->float('column_130')->nullable()->comment('アスリート指数');
            $table->float('column_131')->nullable()->comment('GS目標体脂肪率');
            $table->float('column_132')->nullable()->comment('GS予想体重');
            $table->float('column_133')->nullable()->comment('GS予想脂肪量');
            $table->float('column_134')->nullable()->comment('GS脂肪量増減量');
            $table->float('column_135')->nullable()->comment('左半身−R(1kHz)');
            $table->float('column_136')->nullable()->comment('左半身−X(1kHz)');
            $table->float('column_137')->nullable()->comment('左半身−R(1000kHz)');
            $table->float('column_138')->nullable()->comment('左半身−X(1000kHz)');
            $table->float('column_139')->nullable()->comment('右足−R(1kHz)');
            $table->float('column_140')->nullable()->comment('右足−X(1kHz)');
            $table->float('column_141')->nullable()->comment('右足−R(1000kHz)');
            $table->float('column_142')->nullable()->comment('右足−X(1000kHz)');
            $table->float('column_143')->nullable()->comment('左足−R(1kHz)');
            $table->float('column_144')->nullable()->comment('左足−X(1kHz)');
            $table->float('column_145')->nullable()->comment('左足−R(1000kHz)');
            $table->float('column_146')->nullable()->comment('左足−X(1000kHz)');
            $table->float('column_147')->nullable()->comment('右腕−R(1kHz)');
            $table->float('column_148')->nullable()->comment('右腕−X(1kHz)');
            $table->float('column_149')->nullable()->comment('右腕−R(1000kHz)');
            $table->float('column_150')->nullable()->comment('右腕−X(1000kHz)');
            $table->float('column_151')->nullable()->comment('左腕−R(1kHz)');
            $table->float('column_152')->nullable()->comment('左腕−X(1kHz)');
            $table->float('column_153')->nullable()->comment('左腕−R(1000kHz)');
            $table->float('column_154')->nullable()->comment('左腕−X(1000kHz)');
            $table->float('column_155')->nullable()->comment('両足−R(1kHz)');
            $table->float('column_156')->nullable()->comment('両足−X(1kHz)');
            $table->float('column_157')->nullable()->comment('両足−R(1000kHz)');
            $table->float('column_158')->nullable()->comment('両足−X(1000kHz)');
            $table->float('column_159')->nullable()->comment('位相差−左半身(50kHz)');
            $table->float('column_160')->nullable()->comment('位相差−右足(50kHz)');
            $table->float('column_161')->nullable()->comment('位相差−左足(50kHz)');
            $table->float('column_162')->nullable()->comment('位相差−右腕(50kHz)');
            $table->float('column_163')->nullable()->comment('位相差−左腕(50kHz)');
            $table->float('column_164')->nullable()->comment('位相差−両足(50kHz)');
            $table->float('column_165')->nullable()->comment('測定日（長い形式）');
            $table->float('column_166')->nullable()->comment('サルコペニア肥満−MM/H^2');
            $table->float('column_167')->nullable()->comment('サルコペニア肥満−MM/BW');
            $table->float('column_168')->nullable()->comment('サルコペニア肥満−ASM/H^2');
            $table->float('column_169')->nullable()->comment('サルコペニア肥満−ASM/BW');
            $table->float('column_170')->nullable()->comment('接触状態');
            $table->float('column_171')->nullable()->comment('両手-R(1kHz)');
            $table->float('column_172')->nullable()->comment('両手-X(1kHz)');
            $table->float('column_173')->nullable()->comment('両手-R(5kHz)');
            $table->float('column_174')->nullable()->comment('両手-X(5kHz)');
            $table->float('column_175')->nullable()->comment('両手-R(50kHz)');
            $table->float('column_176')->nullable()->comment('両手-X(50kHz)');
            $table->float('column_177')->nullable()->comment('両手-R(250kHz)');
            $table->float('column_178')->nullable()->comment('両手-X(250kHz)');
            $table->float('column_179')->nullable()->comment('両手-R(500kHz)');
            $table->float('column_180')->nullable()->comment('両手-X(500kHz)');
            $table->float('column_181')->nullable()->comment('両手-R(1000kHz)');
            $table->float('column_182')->nullable()->comment('両手-X(1000kHz)');
            $table->float('column_183')->nullable()->comment('右半身-R(1kHz)');
            $table->float('column_184')->nullable()->comment('右半身-X(1kHz)');
            $table->float('column_185')->nullable()->comment('右半身-R(5kHz)');
            $table->float('column_186')->nullable()->comment('右半身-X(5kHz)');
            $table->float('column_187')->nullable()->comment('右半身-R(50kHz)');
            $table->float('column_188')->nullable()->comment('右半身-X(50kHz)');
            $table->float('column_189')->nullable()->comment('右半身-R(250kHz)');
            $table->float('column_190')->nullable()->comment('右半身-X(250kHz)');
            $table->float('column_191')->nullable()->comment('右半身-R(500kHz)');
            $table->float('column_192')->nullable()->comment('右半身-X(500kHz)');
            $table->float('column_193')->nullable()->comment('右半身-R(1000kHz)');
            $table->float('column_194')->nullable()->comment('右半身-X(1000kHz)');
            $table->float('column_195')->nullable()->comment('位相差-両手(50kHz)');
            $table->float('column_196')->nullable()->comment('位相差-右半身(50kHz)');
            $table->float('column_197')->nullable()->comment('四肢骨格筋量');
            $table->float('column_198')->nullable()->comment('細胞外液比');
            $table->float('column_199')->nullable()->comment('タンパク質など');
            $table->float('column_200')->nullable()->comment('体型2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_user');
    }
};