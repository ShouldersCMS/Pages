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
		$page->home_page = (Input::get('home_page')) ? Input::get('home_page') : 0;
		$page->save();

		$this->setHomePage($page);

		return Redirect::to('admin/pages');
	}


	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($slug)
	{
		$page = new Pages;
		$page = $page->where('slug', $slug)->first();
		return View::make('shoulderscms::clean.about', ['page' => $page]);
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
		$meta->toArray();
		unset($meta['id']);
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
		$page->home_page = Input::get('home_page');
		$page->save();

		$this->setHomePage($page);

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
		$page = new Pages;
		$page = $page->findOrFail($id);
		$page->delete();
		return Redirect::to('admin/pages');
	}

	public function settings()
	{
		$pages = Pages::all();
		// $pages= '';
		return View::make('pages::admin.settings', ['page' => $pages]);
	}

	public function home()
	{
		$page = new Pages;
		$page = $page->where('home_page', 1)->first();
		return View::make('shoulderscms::clean.about', ['page' => $page]);
	}


	public function setHomePage($page)
	{
		if($page->home_page == 1) {
			$remove = Pages::where('home_page', 1)->get();
			foreach ($remove as $p) {
				if($p->id != $page->id) {
					$p->home_page = 0;
					$p->save();
				}
			}
		}
	}
}
