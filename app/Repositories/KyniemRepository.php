<?php

namespace App\Repositories;

use App\Models\Kyniem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class KyniemRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model() {
        return "App\\Models\\Kyniem";
    }

    /**
     * @param Kyniem $kyniem
     *
     * @return bool
     */
    public function save_kyniem(Kyniem &$kyniem) {
        try {
            $kyniem->save();

            // Xóa cache
            Cache::flush();

        } catch (ValidatorException $e) {
            echo $e->getMessage();
            die;
        }

        return true;
    }

    public function get_detail($id) {
        $maxContent = 8;
        $kyniem_before = Kyniem::where('id', '>', $id)->orderBy('id')
                               ->limit(round($maxContent/2))
                               ->get();

        $limit_after = $maxContent - $kyniem_before->count();

        $kyniem_after = Kyniem::where('id', '<', $id)->orderByDesc('id')
                              ->limit($limit_after)
                              ->get();
        foreach ($kyniem_after as $v) {
            if ($kyniem_after->count() > 0) {
                $kyniem_before->add($v);
            }
        }
        $kyniem_before = $kyniem_before->reverse();


        return [
            'data'  => Kyniem::find($id),
            'other' => $kyniem_before,
            'max'   => DB::table('kyniem')
                         ->max('id'),
        ];

    }

    /**
     * @param Kyniem $kyniem
     *
     * @return |null
     */
    public function getTagsInContent(Kyniem $kyniem) {
        //<editor-fold desc="Match tag in content">
        // Format: [#tag][#tag] [#tag] [#tag]
        preg_match_all(config('app.pattern_tag'),$kyniem->kyniem_content,$match);
        //</editor-fold>
        return ($match[1] ?? null);
    }
}
