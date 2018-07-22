<?php

namespace App\Http\Controllers\admin;

use App\Libraries\Markdown;
use App\Models\Kyniem;

use App\Models\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;

class OptionsController extends Controller
{


    public function __construct() { parent::__construct(); }

    public function index()
    {
        $array_options = [
            'popup'                => [
                'type' => 'text',
            ],
            'popup_flag'           => [
                'type' => 'text',
            ],
            'popup_session'        => [
                'type' => 'text',
            ],
            'instant_img'          => [
                'type' => 'text',
            ],
            'custom_banner'        => [
                'type' => 'text',
            ],
            'custom_banner_top'    => [
                'type' => 'text',
            ],
            'custom_banner_bottom' => [
                'type' => 'text',
            ],
            'custom_banner_'       => [
                'type' => 'text',
            ],
            'max_size_img'         => [
                'type' => 'text',
            ],
            'size-video'           => [
                'type' => 'text',
            ],

            'theme_name' => [
                'type' => 'text',
            ],

            'typing_homepage' => [
                'type' => 'text',
            ],
        ];
        foreach ($array_options as $k => &$v) {
            $v['value'] = Options::where('option_key', $k)
                                 ->get()
                                 ->first()->option_content;
        }
        unset($v);
        View::share('array_options', $array_options);

        return view('admin.options');
    }


    public function draw_grid($data)
    {
        // $max_value = max($data);
        // var_dump(end(array_keys($data)));
        //        die;
        $m         = new \DateTime(end(array_keys($data)));
        $date_left = ($m->format("N") % 7) + 6;
        for ($i = 0; $i < $date_left; $i++) {
            $data[] = -1;
        }
        $data = array_reverse($data);
        $html = "";
        $i    = 0;
        if ($this->ci->kyniem->history_auth == null) {
            //$html .= '<h2>All page history wrote blog</h2>';
        } else {
            //$html .= '<h2>Your history wrote blog</h2>';
        }
        $html .= '
            
            <div id="gird_date">
            <div class="week">';
        foreach ($data as $key => $item) {

            if ($i % 7 == 0) {
                $html .= '</div><div class="week">';
            }

            // Nếu có bài viết
            if ($item > 0) {

                // Khởi tạo $name_class
                $name_class = "has";

                // Tính phần trăm của từng ngày
                $arrange = round(($item / $max_value) * 100);
                if ($arrange < 25) {
                    $name_class .= " has_1";
                } elseif ($arrange <= 25 && $arrange < 50) {
                    $name_class .= " has_2";
                } elseif ($arrange <= 50 && $arrange < 75) {
                    $name_class .= " has_3";
                } elseif ($arrange > 75) {
                    $name_class .= " has_4";
                }

                // Nếu có tình trạng đặc biết thì thêm class màu đỏ vào
                $status = $this->ci->kyniem->check_status($key);
                if ($status > 0) {
                    $name_class .= " ";
                }

            } // Phần này để không hiện ở những ngày đầu tiên
            elseif ($item == -1) {
                $name_class = "no_show";
            } // Những ngày không có bài viết
            else {
                $name_class = "no_has";
            }
            $html .= "<div data-date='" . $item . "' id='date-$key' class='date " . $name_class . "' title='" . $key . "'></div>";
            $i++;
        }
        $html .= '</div>
        </div>
        <div class="clearfix"></div>
        <hr>
        ';

        return $html;
    }
}