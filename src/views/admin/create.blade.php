@extends('shoulderscms::AdminLTE.layouts.master')

@section('headercss')
    <!-- Summernote -->
    <link href="{{ asset('packages/shoulderscms/shoulderscms/css/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('main')
    @if (!empty($page))
	   {{ Form::model($page, array('url' => ['admin/pages', $page['id']], 'method' => 'put')) }}

    @else
        {{ Form::model($page, array('url' => 'admin/pages')) }}
    @endif

	 <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-8">
						<div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-file-o"></i> Page</a></li>
                                <li class=""><a href="#tab_2" data-toggle="tab"><i class="fa fa-share-alt"></i> Meta</a></li>
                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group">
                                        <label for="pageTitle">Title:</label>
                                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                                    </div>
                                    <div class="form-group">
                                    	<label for="pageContent">Content:</label>
                                        {{ Form::textarea('content', null, ['class' => 'form-control textarea summernote', 'rows' => 10, 'cols' => 30]) }}
                                    </div>
                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                    	<label for="meta_description">Meta Description: </label>
                                        {{ Form::text('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Meta Description']) }}
                                    </div>
                                    <div class="form-group">
                                    	<label for="meta_og_title">Meta Title: (Open Graph)</label>
                                        {{ Form::text('meta_og_title', null, ['class' => 'form-control', 'placeholder' => 'Meta Title']) }}
                                    </div>
                                    <div class="form-group">
                                    	<label for=""></label>
                                    </div>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-gears"></i>
                                <h3 class="box-title">Settings</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                            	<label for="meta_robots">Robots: </label>

                                {{ Form::select('meta_robots', array(
                                    'INDEX, FOLLOW' => 'Index and follow (Recomended)',
                                    'NOINDEX, FOLLOW' => 'No Index, follow',
                                    'INDEX, NOFOLLOW' => 'Index, No Follow',
                                    'NOINDEX, NOFOLLOW' => 'No Index, No Follow',
                                ), null, ['class' => 'form-control']) }}
                            </div><!-- /.box-body -->
                            <div class="box-body">
                                <label for="">Is Home Page?</label><br />
                                {{ Form::checkbox('home_page', true) }}
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{ Form::close() }}

            <script type="text/javascript">

            $(function() {
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });

            </script>
@stop

@section('footerjs')
    <!-- Summernote -->
    <script src="{{ asset('packages/shoulderscms/shoulderscms/js/plugins/summernote/summernote.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
              toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
              ]
            });
        });
    </script>
@stop
