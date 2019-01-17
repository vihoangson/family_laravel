<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/17/2019
 * Time: 9:16 PM
 */

namespace App\Services;

use App\Models\Files_model;
use Carbon\Carbon;

class OverviewService {

    /**
     * OverviewService constructor.
     */
    public function __construct() {
        $this->img_year = $this->getData();
    }

    public function getDataYear() {

        $data = ['img_year' => $this->img_year];

        return $data;
    }

    private function getData() {

        //<editor-fold desc="Chuan bi du lieu gia">
        if (true) {
            return [
                2019 => [
                    [
                        'title' => 'Em thích đi học trường mới',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190114_050145_2019-01-14__12_44_25.png',
                    ],

                ],
                2018 => [
                    [
                        'title' => 'Buổi chiều tại Phan Rang',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_1.jpg',
                    ],
                    [
                        'title' => 'Buổi sáng tại bãi đá trứng',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_2.jpg',
                    ],
                    [
                        'title' => 'Du lịch tại Mũi Né 2018',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_3.jpg',
                    ],
                    [
                        'title' => 'Xinh tươi',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_4.jpg',
                    ],
                    [
                        'title' => 'Bố mẹ và Kem',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_5.jpg',
                    ],
                    [
                        'title' => 'Hai người yêu nhau',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_6.jpg',
                    ],
                    [
                        'title' => 'Bố và ông nội khi đi du lịch Nha Trang',
                        'desc'  => '',
                        'time'  => '',
                        'url'   => 'http://family.vihoangson.com/storage/images/20190117_140144_overview_7.jpg',
                    ],

                ],
            ];
        }
        //</editor-fold>

        // todo: load data from database
        $db = Files_model::where('overview', 1)
                         ->where('created_at', '<>', 'null')
                         ->get();

        $data = [];
        foreach ($db as $v) {
            $file = $this->adapFormat($v);
            $data[$file['year']][] = $file['data'];
        }

        return $data;


    }

    private function adapFormat(Files_model $v) {
        $year = (Carbon::createFromTimestamp(strtotime($v->created_at))
                       ->format('Y'));
        // if(!in_array($year,$list_year)){
        //     $list_year[]= $year;
        // }
        $data = [
            'year' => $year,
            "data" => [
                'title' => '',
                'desc'  => '',
                'time'  => $v->created_at,
                'url'   => $v->files_path
            ]
        ];

        return $data;
    }
}