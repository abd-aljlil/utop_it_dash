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
Route::get('/', 'AppController@index');
Route::get('/welcome', function () {
    return view('welcome');
});
//Auth::routes();
Auth::routes(['verify' => true]);

Route::resource('Join_Group' , 'GroupController');
// to disable here
Route::resource('Exam' , 'ExamController');
Route::resource('ExamPage' , 'ExamController');
Route::resource('User' , 'UserController');
Route::get('Contact_us','AppController@contact');
Route::post('Contact_us','AppController@sendmail');
Route::resource('My_Group' , 'GroupController');
//to activate joining groups go to the group controoler and update Join_Groupp to Join_Group
Route::post('join_group' , 'GroupController@Join_Group')->name('join_group');
// to disable here
Route::get('student_register', 'Auth\RegisterController@showStudentForm');

Route::resource('Student_Info' , 'StudentInfoController');
Route::get('search','StudentInfoController@search');
Route::resource('Group' , 'GroupController');
Route::resource('Exam_Name' , 'Exam_NameController');
Route::resource('Group_User' , 'Group_UserController');
Route::resource('Group_Timing' , 'Group_TimingController');
Route::resource('Lessons_Index' , 'Lessons_IndexController');
Route::resource('Question_Types' , 'Question_TypesController');
Route::resource('Exam_Name_Index' , 'Exam_Name_IndexController');
Route::resource('Lessons_Archive' , 'Lessons_ArchiveController');
Route::resource('Exam_Name_Index_Users' , 'Exam_Name_Index_UsersContoller');
Route::resource('Lessons_Archive_Files' , 'Lessons_Archive_FilesController');
Route::resource('Exam_Name_Index_Questions' , 'Exam_Name_Index_QuestionsController');
Route::resource('Exam_Name_Index_Questions_Users' , 'Exam_Name_Index_Questions_UsersController');
Route::resource('Role_User' , 'Role_UserController');
Route::post('Upload_Exam_Name_Index_Questions_Users_File' , 'Exam_Name_Index_Questions_UsersController@UploadFile');
Route::post('Exam_Name_Index_Questions_Percent', 'Exam_Name_Index_QuestionsController@updatePercent');
Route::resource('Group_Timing_Attendee' , 'Group_Timing_AttendeeController');
Route::resource('level_setting_exam_percent' , 'level_setting_exam_percentController');
Route::post('Update_Exam_Name_Index_Users_Counter', 'Exam_Name_Index_UsersContoller@updateCounter');
Route::get('profile', 'Role_UserController@showProfile');
Route::post('profile', 'Role_UserController@updateProfile');

Route::get('User_Marks.fetch', 'User_MarksController@fetch');

Route::get('Lessons_Index_Student_View' , 'Lessons_IndexController@Lessons_Index_Student_View');
Route::get('Lessons_Index_Fetch_Student' , 'Lessons_IndexController@Lessons_Index_Fetch_Student');

Route::get('New_Lesson','Lessons_IndexController@notify');


Route::get('markRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
	return redirect()->back();
});

Route::get('EndOfCourse','AppController@notify');

Route::get('getMarks/{id}','Group_Timing_AttendeeController@getMarks');
Route::post('updateStudentGroup/{id}','Group_Timing_AttendeeController@updateStudentGroup');
Route::post('updateMarks/{id}','Group_Timing_AttendeeController@updateMarks');
Route::post('Interview_Date/{date}','AppController@NotifInterview');
//
Route::resource('User_Marks' , 'User_MarksController');
Route::resource('Role_User' , 'Role_UserController');

Route::get('My_Lessons','Lessons_IndexController@Student_Lessons');
Route::get('Previous_Lesson','Lessons_IndexController@previous_lesson');
Route::get('Latest_Lesson','Lessons_IndexController@latest_lesson');
