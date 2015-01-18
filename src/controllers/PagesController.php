<?php namespace Shoulderscms\Pages\Controllers;

use \Input;
use Shoulderscms\Pages\Models\Pages;
use Shoulderscms\Shoulderscms\Models\Meta as Meta;
use \Redirect;
use \Safeurl;
use \View;

class PagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = new Pages;
		$pages = $pages->all();
		return View::make('pages::admin.index', ['pages' => $pages]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$page = '';
		return View::make('pages::admin.create', ['page' => $page]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		$meta = new Meta;
		$meta->meta_robots = Input::get('meta_robots');
		$meta->meta_description = Input::get('meta_description');
		$meta->meta_og_title = Input::get('meta_og_title');
		$meta->save();

		$page = new Pages;
		$page->title = Input::get('title');
		$page->content = Input::get('content');
		$page->slug = Safeurl::make(Input::get('title'));
		$page->meta_id = $meta->id;
		$page->save();
		return Redirect::to('admin/pages');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = new Pages;
		$page = $page->findOrFail($id);
		$meta = new Meta;
		$meta = $meta->findOrFail($page->meta_id);
		$page = array_merge($page->toArray(), $meta->toArray());
		return View::make('pages::admin.create', ['page' => $page]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = new Pages;
		$page = $page->findOrFail($id);
		$page->title = Input::get('title');
		$page->content = Input::get('content');
		$page->slug = Safeurl::make(Input::get('title'));
		$page->save();

		$meta = new Meta;
		$meta = $meta->findOrFail($page->meta_id);
		$meta->meta_robots = Input::get('meta_robots');
		$meta->meta_description = Input::get('meta_description');
		$meta->meta_og_title = Input::get('meta_og_title');
		$meta->save();
		return Redirect::to('admin/pages');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
