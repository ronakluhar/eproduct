    <div class="box_body_container">
        @{{#list}}
        <div class="collage_box post-modern">
            <div class="collage-logo"><img src="@{{image_path}}" alt=""></div>
            <hr class="hr hr-gradient">
            <div class="collage-name">
                <div class="inner">
                    <h6 class="text-info"><a href="{{url('school-detail')}}">@{{Institution_Name}}</a></h6>
                    <h6 class="text-muted">@{{Post_office_box}}</h6>
                </div>
            </div>
            <div class="button_collection clearfix">
                <button class="btn-default btn-sm btn btn-anis-effect pull-left" type="button">Compare</button>
                <button class="add-to-fav pull-right"><span class="text-middle icon"><i class="fa fa-heart"></i></span></button>
            </div>
        </div>
        @{{/list}}
    </div>