@extends('layouts/template2/layout')
@section('title_page','Family tree')
@section('body')

@include('layouts/includes/carousel')
    <hr>

    <div id="family-tree">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#branchdad" aria-controls="branchdad" role="tab" data-toggle="tab">Nhánh bên bố</a></li>
            <li role="presentation">
                <a href="#branchmom" aria-controls="branchmom" role="tab" data-toggle="tab">Nhánh bên mẹ</a></li>
            <li role="presentation">
                <a href="#myfamily" aria-controls="myfamily" role="tab" data-toggle="tab">Messages</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="branchdad">
                <div class="tree">
                    <ul>
                        <li><a>Ông Nội<br>Bà Nội</a>
                            <ul>
                                <li><a>Bác Tro</a></li>
                                <li><a>Vi Văn Thắng</a></li>
                                <li><a>Cô Bình</a></li>
                                <li><a>Cô Vui</a></li>
                                <li><a>Chú Vẻ</a></li>
                                <li><a>Cô Đoàn</a></li>
                                <li><a>Chú Liên<br>Cô Tuyết</a>
                                    <ul>
                                        <li><a><strong>Nhung</strong><br>Chồng Nhung</a>
                                            <ul>
                                                <li><a>1</a></li>
                                                <li><a>2</a></li>
                                            </ul>
                                        </li>
                                        <li><a>Long</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="tree">
                    <ul>
                        <li><a>Phạm Kim Lời<br>Nguyễn Thị Lâm</a>
                            <ul>
                                <li><a href="#">Phạm Thanh Hà</a></li>
                                <li><a href="#">Phạm Mỹ Hạnh</a></li>
                                <li><a href="#">Phạm Mỹ Hường</a></li>
                                <li><a href="#">Phạm Thị Huệ</a></li>
                                <li><a href="#">Phạm Khải Hoàng</a></li>
                                <li><a href="#">Phạm Trung Hiếu</a></li>
                            </ul>

                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="branchmom">
                <div class="tree">
                </div>
                <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="myfamily">
                <div class="tree">
                    <ul>
                        <li>
                            <a href="#">Bố Sơn<br>Mẹ Su</a>
                            <ul>
                                <li>
                                    <a href="#">Kem</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>

    </script>
@endsection

@section('custom_css')
    <style>

        /*Now the CSS*/
        * {
            margin: 0;
            padding: 0;
        }

        .tree ul {
            padding-top: 20px;
            position: relative;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        .tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before, .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 20px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without
        any siblings*/
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child {
            padding-top: 0;
        }

        /*Remove left connector from first child and
        right connector from last child*/
        .tree li:first-child::before, .tree li:last-child::after {
            border: 0 none;
        }

        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;

            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover, .tree li a:hover + ul li a {
            background: #c8e4f8;
            color: #000;
            border: 1px solid #94a0b4;
        }

        /*Connector styles on hover*/
        .tree li a:hover + ul li::after,
        .tree li a:hover + ul li::before,
        .tree li a:hover + ul::before,
        .tree li a:hover + ul ul::before {
            border-color: #94a0b4;
        }

    </style>
@endsection
