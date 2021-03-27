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
Route::get('/home', 'AppController@home');
Route::get('/welcome', function () {
    return view('welcome');
});
Auth::routes();
//Auth::routes(['verify' => true]);
Route::resource('Announcement' , 'AnnouncementController');
Route::get('Announcement.fetch' , 'AnnouncementController@fetch');
Route::post('Announcement/{id}/trash','AnnouncementController@trash');
Route::post('Group_User/{id}/trash','Group_UserController@trash');
Route::resource('Join_Group' , 'GroupController');
// to disable here
Route::resource('Courses' , 'CourseController');
Route::post('Exam_Name_Index_Users/{id}/trash','Exam_Name_Index_UsersContoller@trash');
Route::post('Group_Timing/{id}/active','Group_TimingController@active');
Route::post('Lessons_Archive/{id}/active','Lessons_ArchiveController@active');
Route::post('Lessons_Archive/{id}/trash','Lessons_ArchiveController@trash');
Route::post('Lessons_Archive_Files/{id}/trash','Lessons_Archive_FilesController@trash');

//new
Route::get('Group.fetch' , 'GroupController@fetch');
Route::get('Group_User.fetch' , 'Group_UserController@fetch');
Route::get('Exam_Name_Index.fetch' , 'Exam_Name_IndexController@fetch');
Route::get('Question_Types.fetch' , 'Question_TypesController@fetch');
Route::get('Courses.fetch' , 'CourseController@fetch');
Route::get('Lessons_Index.fetch' , 'Lessons_IndexController@fetch');
Route::get('Vounteer_Requests_Management' , 'AppController@Volunteer_Requests');
Route::get('Volunteer_Requests_list' , 'AppController@Volunteer_Requests_list');
Route::post('calculate_students_totals/{level}/{course}' , 'CourseController@calculate_totals');
Route::get('calculate_success_percent/{id}' , 'CourseController@calculate_success_percent');
Route::post('Courses/{active}/active','CourseController@active');
Route::post('Group/{active}/active','GroupController@active');
Route::get('withdraw' , 'GroupController@withdraw');
Route::post('Exam_Name_Index_Questions/{id}/trash' , 'Exam_Name_Index_QuestionsController@trash');
Route::resource('ExamPage' , 'ExamController');
Route::resource('Exam' , 'ExamController');
Route::get('Contact_us','AppController@contact');
Route::get('Course_Register','AppController@course_register');
Route::post('Course_Join','AppController@course_join');
Route::post('Contact_us','AppController@sendmail');
Route::get('Student_Group_List','User_MarksController@fetchGroup');
Route::get('My_Group' , 'GroupController@index');//enter /indexes/Join_Group and show its join button
//to activate joining groups go to the group controller and update Join_Groupp to Join_Group
Route::post('join_group' , 'GroupController@Join_Groupp')->name('join_group');
// to disable here
Route::get('account_register', 'Auth\RegisterController@showStudentForm');
//to enable here
Route::resource('My_Exams_Mistakes' , 'Exam_Name_Index_Questions_UsersController');
Route::get('search_exam_mistakes' , 'Exam_Name_Index_Questions_UsersController@search');
//to enable mistakes search
//Route::get('search_exam_mistakes', function () { return 'You Can\'t do that now, Please try again later'; });
//to disable mistakes search
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
Route::get('User_Marks.fetchSimple', 'User_MarksController@fetchSimple');

/* // this replaced with User_ManagController (VueJS and Controllers and tables)
Route::resource('User' , 'UserController');
Route::get('User.fetch' , 'UserController@fetch');
Route::post('User/{active}/block','UserController@block');
*/
Route::resource('User_Manag' , 'User_ManagController');
Route::get('User_Manag.fetch', 'User_ManagController@fetch');
Route::post('User_Manag/{active}/block','User_ManagController@block');


Route::get('Lessons_Index_Student_View' , 'Lessons_IndexController@Lessons_Index_Student_View');
Route::get('Lessons_Index_Fetch_Student' , 'Lessons_IndexController@Lessons_Index_Fetch_Student');

Route::post('New_Lesson/{level}','Lessons_IndexController@notify');


Route::get('markRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
	return redirect()->back();
});

Route::get('EndOfCourse','AppController@notify');

Route::get('getMarks/{id}','Group_Timing_AttendeeController@getMarks');
Route::post('updateStudentGroup/{id}','Group_Timing_AttendeeController@updateStudentGroup');
Route::post('updateMarks/{id}','Group_Timing_AttendeeController@updateMarks');
Route::get('Course_Level_Students/{course}/{level}','CourseController@fetchLevelStudents');
Route::post('Interview_Date/{date}','AppController@NotifInterview');
Route::get('Course_Level_Students_Groups/{course}/{level}','CourseController@fetchLevelStudentsGroups');
Route::resource('User_Marks' , 'User_MarksController');
Route::resource('Role_User' , 'Role_UserController');
Route::get('Exam_Name_Index_Questions/{id}/editOrder' , 'Exam_Name_Index_QuestionsController@editOrder');
Route::post('Exam_Name_Index_Questions_Order', 'Exam_Name_Index_QuestionsController@updateorder');
Route::get('My_Lessons','Lessons_IndexController@Student_Lessons');
Route::get('Previous_Lesson','Lessons_IndexController@previous_lesson');
Route::get('Latest_Lesson','Lessons_IndexController@latest_lesson');
Route::get('Print_Cert','StudentInfoController@print_cert');
Route::post('Post_Cert','StudentInfoController@post_print');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
