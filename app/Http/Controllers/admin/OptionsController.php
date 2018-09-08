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
            'custom_banner_left'   => [
                'type' => 'text',
            ],
            'custom_banner_right'  => [
                'type' => 'text',
            ],
            'custom_banner_main'   => [
                'type' => 'text',
            ],
            'max_size_img'         => [
                'type' => 'text',
            ],
            'size-video'           => [
                'type' => 'text',
            ],
            'theme_name'           => [
                'type' => 'text',
            ],
            'typing_homepage'      => [
                'type'    => 'text',
                'default' => '"Xin chào, Bố Sơn đây", "Kem phải ăn ngoan ngủ ngoan nhé","Thương con và mẹ nhiều lắm","Một ngày bắt đầu bố thấy rất vui và hạnh phúc","Khi nhìn thấy con cười","Mỗi ngày bố chở Kem đi học đều chụp hình cho con để thấy được con lớn từng ngày như thế nào"',
            ],
        ];
        foreach ($array_options as $k => &$v) {
            $option = Options::where('option_key', $k);
            if ($option->count() > 0) {
                $v['value'] = $option->get()
                                     ->first()->option_content;
            } else {
                $v['value'] = isset($v['default'])?$v['default']:"";
            }

        }
        unset($v);
        View::share('array_options', $array_options);

        return view('admin.options');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author hoang_son
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        foreach ($input as $k => $v) {
            $m                 = Options::firstOrNew(['option_key' => $k]);
            $m->option_content = $v;
            $m->save();
        }

        return redirect(route('admin_options'));
    }

}