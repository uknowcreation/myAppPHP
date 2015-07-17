<?php namespace App\Http\Controllers;

use DB;
use Carbon;


class AdminController extends Controller {

	public function getIndex() {

		$today = Carbon\Carbon::toDay()->toDateTimeString();

		$count_users_registered_today = DB::table('users')->where('created_at', $today)->count();

		$count_videos_uploaded_today = DB::table('videos')->where('created_at', $today)->count();

		$count_comments_posted_today = DB::table('comments')->where('created_at', $today)->count();

		return view('dashboards.admin.index', compact('count_users_registered_today', 'count_videos_uploaded_today', 'count_comments_posted_today'));
	}

	public function getVideosToValidate() {
		return view('dashboards.admin.videos_to_validate');
	}

	public function postValidate($id) {

	}

	public function getFastDelete($elements) {

	}

	public function postFastDelete($elements) {

	}

	public function getListUsers() {

	}

	public function getListVideos() {
		
	}
}