@extends('layouts/admin/layout')
@section('body')

    <div class="container">
        <div class="row">
            <div><a class="btn btn-primary" href="{{route('list_file_db_backup')}}?refresh=true"><i class="fa fa-refresh"></i> Refresh db</a></div>

            <hr>

            <div class="col-md-12">
                <h4>Danh sách file raw trên cloud</h4>

                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                        <th>public_id</th>
                        <th>secure_url</th>
                        <th>folder</th>
                        <th>filename</th>
                        <th>format</th>
                        <th>version</th>
                        <th>resource_type</th>
                        <th>type</th>
                        <th>created_at</th>
                        <th>uploaded_at</th>
                        <th>bytes</th>
                        <th>backup_bytes</th>
                        <th>url</th>
                        <th>status</th>
                        <th>access_mode</th>
                        <th>access_control</th>
                        </thead>
                        <tbody>

                        @foreach($data as $key=>$value)
                            <tr>
                                <td>{{$value['public_id']}}</td>
                                {{--<td><a href="{{$value['secure_url']}}">{{$value['secure_url']}}</a></td>--}}
                                <td><a class="btn btn-default" href="{{$value['secure_url']}}"><i class="fa fa-cloud-download"></i> Download file</a></td>
                                <td>{{$value['folder']}}</td>
                                <td>{{$value['filename']}}</td>
                                <td>{{$value['format']}}</td>
                                <td>{{$value['version']}}</td>
                                <td>{{$value['resource_type']}}</td>
                                <td>{{$value['type']}}</td>
                                <td>{{$value['created_at']}}</td>
                                <td>{{$value['uploaded_at']}}</td>
                                <td>{{$value['bytes']}}</td>
                                <td>{{$value['backup_bytes']}}</td>
                                <td>{{$value['url']}}</td>
                                <td>{{$value['status']}}</td>
                                <td>{{$value['access_mode']}}</td>
                                <td>{{$value['access_control']}}</td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>

                    <div class="clearfix"></div>

                    <ul class="pagination pull-right hidden">
                        <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                    </ul>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " type="text" placeholder="Mohsin">
                    </div>
                    <div class="form-group">

                        <input class="form-control " type="text" placeholder="Irshad">
                    </div>
                    <div class="form-group">
                        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" style="width: 100%;">
                        <span class="glyphicon glyphicon-ok-sign"></span> Update
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?
                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> No
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection