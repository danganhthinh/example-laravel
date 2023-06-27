<?php

namespace App\Jobs;

use App\Models\DataUser;
use App\Models\LabelDataUser;
use App\Models\Ranks;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculatorRankJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $labelDataUser = LabelDataUser::get();
//        $dataMigrate = [];
//
//        foreach ($labelDataUser as $item) {
//            array_push($dataMigrate, '$table->float(' . "'$item->key" . "_rank_in_age" . "')->nullable();");
//            array_push($dataMigrate, '$table->float(' . "'$item->key" . "_rank_in_team" . "')->nullable();");
//            array_push($dataMigrate, '$table->float(' . "'$item->key" . "_avg_age" . "')->nullable();");
//        }
        
        $data = DataUser::with('user:id,code,team')
            ->whereHas('user')
            ->orderBy('measuring_date_time', 'desc')
            ->get()
            ->groupBy('code_user');

        if (count($data)) {
            $dataRankByAge = [];
            $dataRankByTeam = [];

            foreach ($data as $item) {
                if (@$dataRankByAge[$item[0]->age]) {
                    $dataRankByAge[$item[0]->age] = array_merge($dataRankByAge[$item[0]->age], [$item[0]]);
                } else {
                    $dataRankByAge[$item[0]->age] = [$item[0]];
                }

                if (@$item[0]->user->team) {
                    if (@$dataRankByTeam[$item[0]->user->team]) {
                        @$dataRankByTeam[$item[0]->user->team] = array_merge(@$dataRankByTeam[$item[0]->user->team], [$item[0]]);
                    } else {
                        @$dataRankByTeam[$item[0]->user->team] = [$item[0]];
                    }
                }
            }

            $dataUpdateByUser = [];
            $labelDataUser = LabelDataUser::get();

            if (count($dataRankByAge)) {
                foreach ($dataRankByAge as $keyRankByAge => $item) {
                    $itemCollect = collect($item);

                    foreach ($labelDataUser as $keyLabelDataUser => $itemLabelDataUser) {
                        $itemCollectSortByColumn = $itemCollect->sortBy(
                            [
                                ["$itemLabelDataUser->key", 'desc']
                            ]
                        );

                        $itemCollectSortByColumn = $itemCollectSortByColumn->values();
                        $avg = $itemCollect->avg("$itemLabelDataUser->key");
                        $itemCollectSortByColumnCount = count($itemCollectSortByColumn);

                        foreach ($itemCollectSortByColumn as $keyItemUpdate => $itemUpdate) {
                            $dataUpdateByUser[$itemUpdate->code_user]["$itemLabelDataUser->key" . "_rank_in_age"]
                                = ((float)$keyItemUpdate + 1) . "位/" . $itemCollectSortByColumnCount;

                            $dataUpdateByUser[$itemUpdate->code_user]["$itemLabelDataUser->key" . "_avg_age"]
                                = $avg;
                            $dataUpdateByUser[$itemUpdate->code_user]["code_user"]
                                = $itemUpdate->code_user;
                        }
                    }
                }
            }

            if (count($dataRankByTeam)) {
                foreach ($dataRankByTeam as $itemRankByTeam) {
                    $itemRankByTeamCollect = collect($itemRankByTeam);

                    foreach ($labelDataUser as $keyLabelDataUser => $itemLabelDataUser) {
                        $itemCollectSortByColumn = $itemRankByTeamCollect->sortBy(
                            [
                                ["$itemLabelDataUser->key", 'desc']
                            ]
                        );
                        $itemCollectSortByColumn = $itemCollectSortByColumn->values();
                        $itemCollectSortByColumnCount = count($itemCollectSortByColumn);

                        foreach ($itemCollectSortByColumn as $keyItemUpdate => $itemUpdate) {
                            $dataUpdateByUser[$itemUpdate->code_user]["$itemLabelDataUser->key" . "_rank_in_team"]
                                = ((float)$keyItemUpdate + 1) . "位/" . $itemCollectSortByColumnCount;
                        }
                    }
                }
            }

            $dataUpdateByUserValue = array_values($dataUpdateByUser);
            if (count($dataUpdateByUserValue)) {
                DB::table('ranks')->truncate();

                foreach ($dataUpdateByUserValue as $item) {
                    DB::table('ranks')->insert($item);
                }
            }
        }
    }
}
