<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', array('as' => 'index', 'uses'   =>  'HomeController@index'));

Route::get('/login', array('as' => 'login', function(){
   return view('login');
}));

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', 'LoginController@login');
    Route::resource('user', 'UserController');
    Route::get('/userDataTables', array('as' => 'userDataTables', 'uses' => 'UserController@userDataTables'));
    Route::get('/allgroupuser', array('as' => 'allGroupUser', 'uses' => 'UserController@getAllGroupUser'));

    Route::resource('/parent', 'ParentController');
    Route::get('/parentDataTables', array('as' => 'parentDataTables', 'uses' => 'ParentController@parentDataTables'));

    Route::resource('/timetable', 'TimeTableController');
    Route::post('/timetable/reset', array('as'=>'timetable.reset', 'uses'=>'TimeTableController@reset'));
    Route::get('/timetableDataTables', array('as' => 'timetableDataTables', 'uses' => 'TimeTableController@timetableDataTables'));

    Route::resource('class', 'ClassController');
    Route::get('/weeksOfYear', array('as'=>'weeksOfYear', 'uses'=> 'TimeTableController@weeksOfYear'));

    Route::resource('/student', 'StudentController');
    Route::get('/studentDataTables', array('as' => 'studentDataTables', 'uses' => 'StudentController@studentDataTables'));
    Route::get('/objectsRelativeToStudent', array('as' => 'objectsRelativeToStudent', 'uses' => 'StudentController@objectsRelativeToStudent'));
    Route::get('/studentByClass/{classID}', array('as' => 'studentByClass', 'uses' => 'StudentController@studentByClass'));

    Route::resource('teacher', 'TeacherController');
    Route::get('/teacherDataTables', array('as' => 'teacherDataTables', 'uses' => 'TeacherController@teacherDataTables'));

    Route::resource('result', 'ResultController');
    Route::get('/resultDataTables', array('as' => 'resultDataTables', 'uses' =>'ResultController@resultDataTables'));
    Route::get('/getDataResultCreate', array('as' => 'getDataResultCreate', 'uses' =>'ResultController@getDataResultCreate'));


    /**
     * @author: Lorence
     * @description: About announcement
     */
    Route::resource('/announcement', 'AnnouncementController');
    /// Using function parentDataTables to get data from database
    Route::get('/announcementDataTables', array('as' => 'announcementDataTables', 'uses' => 'AnnouncementController@AnnouncementDataTables'));
    // Using function get Objective Relative with current object
    Route::get('/objectsRelativeToAnnouncement',array('as' => 'objectsRelativeToAnnouncement', 'uses' => 'AnnouncementController@objectsRelativeToAnnouncement'));
    // Get list of subjects
    Route::resource('/subject', 'SubjectController');
    // Get list of teachers
    Route::resource('/teacher', 'TeacherController');
    Route::get('/comboboxteacher', array('as' => 'comboboxteacher', 'uses' => 'TeacherController@comboboxteacher'));

});
