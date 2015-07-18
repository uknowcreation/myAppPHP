<?php namespace App\Http\Controllers;

use DB;
use Carbon;
use Log;
use Request;


class AdminController extends Controller {

	public function getIndex() {

		$today = Carbon\Carbon::toDay()->toDateTimeString();

		$count_users_registered_today = DB::table('users')->where('created_at', $today)->count();

		$count_videos_uploaded_today = DB::table('videos')->where('created_at', $today)->count();

		$count_comments_posted_today = DB::table('comments')->where('created_at', $today)->count();

		return view('dashboards.admin.index', compact('count_users_registered_today', 'count_videos_uploaded_today', 'count_comments_posted_today'));
	}

	public function getVideosToValidate() {

		$videos = DB::table('videos')->where('validated', false)->get();

		return view('dashboards.admin.videos_to_validate', compact('videos'));
	}

	public function getVideoToValidate($id) {

		$video = DB::table('videos')->where('id', $id)->first();

		return view('dashboards.admin.video_to_validate', compact('video'));
	}

	public function postVideoToValidate($id) {
		$validate = Request::input('validate');
		if ($validate == 'yes') {
			DB::table('videos')->where('id', $id)->update(['validated' => true]);
			return redirect('/admin/videos-to-validate')->with('message_success', 'the video has been validated');
		}
		else {
			echo "no";
		}
	}

	public function getVideosOnline() {
		return view('dashboards.admin.videos_online');
	}

	public function getUsers() {
		return view('dashboards.admin.users');
	}

	public function  getComments() {
		return view('dashboards.admin.comments');
	}

	public function postValidate($id) {

	}

	public function getFastDelete() {
		return view('dashboards.admin.fast_delete');

	}

	public function postFastDelete($elements) {
		switch ($elements) {
			case 'videos':
				$elements = Request::input('elements');
				$elements = explode(' ', $elements);
				foreach($elements as $element) {
					$elem = DB::table('videos')->where('id', $element)->first();
					if( !is_null($elem)) {
						$elem->delete();
					}
				}		
			break;

			case 'users':
				return 'users';
			break;	
			
			default:
				# code...
				break;
		}
	}

	public function getListUsers() {

	}

	public function getListVideos() {
		
	}

	public function getLogs() {

	}
}