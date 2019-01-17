<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/17/2019
 * Time: 9:16 PM
 */

namespace App\Services;

class OverviewService {

    /**
     * OverviewService constructor.
     */
    public function __construct() {
        $this->img_year = [
            2018=>[
                [
                    'title'=>'Buổi chiều tại Phan Rang',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_1.jpg',
                ],
                [
                    'title'=>'Buổi sáng tại bãi đá trứng',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_2.jpg',
                ],
                [
                    'title'=>'Du lịch tại Mũi Né 2018',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_3.jpg',
                ],
                [
                    'title'=>'Xinh tươi',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_4.jpg',
                ],
                [
                    'title'=>'Bố mẹ và Kem',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_5.jpg',
                ],
                [
                    'title'=>'Hai người yêu nhau',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_6.jpg',
                ],
                [
                    'title'=>'Bố và ông nội khi đi du lịch Nha Trang',
                    'desc'=>'',
                    'time'=>'',
                    'url'=>'http://family.vihoangson.com/storage/images/20190117_140144_overview_7.jpg',
                ],

            ],
        ];
    }

    public function getDataYear() {

        $data = ['img_year'=>$this->img_year];

        return $data;
    }
}