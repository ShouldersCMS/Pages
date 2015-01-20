@extends('shoulderscms::AdminLTE.layouts.master')

@section('main')
	{{ Form::open(array('url' => 'admin/pages/store')) }}
	 <!-- Main content -->
            <section class="content">

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-8">
						<div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Pages</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody><tr>
                                            <th style="width: 10px">ID</th>
                                            <th style="width: 40%">Page</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page->id }}</td>
                                            <td>{{ $page->title }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="/admin/pages/edit/{{ $page->id }}" class="btn btn-default btn-sm">
                                                        <i class="fa fa-fw fa-pencil"></i> Edit
                                                    </a>
                                                    <a href="/page/{{ $page->slug }}" class="btn btn-default btn-sm">
                                                        <i class="fa fa-fw fa-external-link"></i> View
                                                    </a>
                                                    <a href="/admin/pages/delete/{{ $page->id }}" class="btn btn-default btn-sm">
                                                        <i class="fa fa-fw fa-times-circle"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody></table>
                                </div><!-- /.box-body -->
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
                                <select name="meta_robots" id="" class="form-control">
                                	<option value="INDEX, FOLLOW">Index and follow (Recomended)</option>
                                	<option value="NOINDEX, FOLLOW">No Index, follow</option>
                                	<option value="INDEX, NOFOLLOW">Index, No Follow</option>
                                	<option value="NOINDEX, NOFOLLOW">No Index, No Follow</option>
                                </select>
                            </div><!-- /.box-body -->
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