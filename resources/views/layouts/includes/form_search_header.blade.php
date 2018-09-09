<form id="searchForm" action="{{route('kyniem_search')}}" method="get">
    <div class="input-group">
        <input type="text" class="form-control" name="keyword" id="q" placeholder="Search..." required value="{{\Request::get('keyword')}}">
        <span class="input-group-btn">
													<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
												</span>
    </div>
</form>