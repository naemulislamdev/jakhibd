<?php

use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CommitteeTypeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\WebmasterSettingsController;
use App\Http\Controllers\Dashboard\WebmasterBannersController;
use App\Http\Controllers\Dashboard\WebmasterSectionsController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\BannersController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\TopicsController;
use App\Http\Controllers\Dashboard\ContactsController;
use App\Http\Controllers\Dashboard\WebmailsController;
use App\Http\Controllers\Dashboard\EventsController;
use App\Http\Controllers\Dashboard\AnalyticsController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\MenusController;
use App\Http\Controllers\Dashboard\FileManagerController;
use App\Http\Controllers\Dashboard\LifeMemberController;
use App\Http\Controllers\Dashboard\ResultController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\SubDepartmentController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeacherController;
use Illuminate\Support\Facades\Route;

// Admin Home
Route::get('/', [DashboardController::class, 'index'])->name('adminHome');
//Search
Route::get('/search', [DashboardController::class, 'search'])->name('adminSearch');
Route::post('/find', [DashboardController::class, 'find'])->name('adminFind');

// Webmaster
Route::get('/webmaster', [WebmasterSettingsController::class, 'edit'])->name('webmasterSettings');
Route::post('/webmaster', [WebmasterSettingsController::class, 'update'])->name('webmasterSettingsUpdate');
Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
Route::post('/webmaster/languages/update', [WebmasterSettingsController::class, 'language_update'])->name('webmasterLanguageUpdate');
Route::get('/webmaster/languages/destroy/{id}', [WebmasterSettingsController::class, 'language_destroy'])->name('webmasterLanguageDestroy');
Route::get('/webmaster/seo/repair', [WebmasterSettingsController::class, 'seo_repair'])->name('webmasterSEORepair');

Route::post('/webmaster/mail/smtp', [WebmasterSettingsController::class, 'mail_smtp_check'])->name('mailSMTPCheck');
Route::post('/webmaster/mail/test', [WebmasterSettingsController::class, 'mail_test'])->name('mailTest');

// Webmaster Banners
Route::get('/webmaster/banners', [WebmasterBannersController::class, 'index'])->name('WebmasterBanners');
Route::get('/webmaster/banners/create', [WebmasterBannersController::class, 'create'])->name('WebmasterBannersCreate');
Route::post('/webmaster/banners/store', [WebmasterBannersController::class, 'store'])->name('WebmasterBannersStore');
Route::get('/webmaster/banners/{id}/edit', [WebmasterBannersController::class, 'edit'])->name('WebmasterBannersEdit');
Route::post('/webmaster/banners/{id}/update', [WebmasterBannersController::class, 'update'])->name('WebmasterBannersUpdate');
Route::get('/webmaster/banners/destroy/{id}',
    [WebmasterBannersController::class, 'destroy'])->name('WebmasterBannersDestroy');
Route::post('/webmaster/banners/updateAll',
    [WebmasterBannersController::class, 'updateAll'])->name('WebmasterBannersUpdateAll');

// Webmaster Sections
Route::get('/webmaster/sections', [WebmasterSectionsController::class, 'index'])->name('WebmasterSections');
Route::get('/webmaster/sections/create', [WebmasterSectionsController::class, 'create'])->name('WebmasterSectionsCreate');
Route::post('/webmaster/sections/store', [WebmasterSectionsController::class, 'store'])->name('WebmasterSectionsStore');
Route::get('/webmaster/sections/{id}/edit', [WebmasterSectionsController::class, 'edit'])->name('WebmasterSectionsEdit');
Route::post('/webmaster/sections/{id}/update',
    [WebmasterSectionsController::class, 'update'])->name('WebmasterSectionsUpdate');

Route::post('/webmaster/sections/{id}/seo', [WebmasterSectionsController::class, 'seo'])->name('WebmasterSectionsSEOUpdate');

Route::get('/webmaster/sections/destroy/{id}',
    [WebmasterSectionsController::class, 'destroy'])->name('WebmasterSectionsDestroy');
Route::post('/webmaster/sections/updateAll',
    [WebmasterSectionsController::class, 'updateAll'])->name('WebmasterSectionsUpdateAll');

// Webmaster Sections :Custom Fields
Route::get('/webmaster/{webmasterId}/fields', [WebmasterSectionsController::class, 'webmasterFields'])->name('webmasterFields');
Route::get('/{webmasterId}/fields/create', [WebmasterSectionsController::class, 'fieldsCreate'])->name('webmasterFieldsCreate');
Route::post('/webmaster/{webmasterId}/fields/store', [WebmasterSectionsController::class, 'fieldsStore'])->name('webmasterFieldsStore');
Route::get('/webmaster/{webmasterId}/fields/{field_id}/edit', [WebmasterSectionsController::class, 'fieldsEdit'])->name('webmasterFieldsEdit');
Route::post('/webmaster/{webmasterId}/fields/{field_id}/update', [WebmasterSectionsController::class, 'fieldsUpdate'])->name('webmasterFieldsUpdate');
Route::get('/webmaster/{webmasterId}/fields/destroy/{field_id}', [WebmasterSectionsController::class, 'fieldsDestroy'])->name('webmasterFieldsDestroy');
Route::post('/webmaster/{webmasterId}/fields/updateAll', [WebmasterSectionsController::class, 'fieldsUpdateAll'])->name('webmasterFieldsUpdateAll');

// Settings
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
Route::post('/settings', [SettingsController::class, 'updateSiteInfo'])->name('settingsUpdateSiteInfo');

// Ad. Banners
Route::get('/banners', [BannersController::class, 'index'])->name('Banners');
Route::get('/banners/create/{sectionId}', [BannersController::class, 'create'])->name('BannersCreate');
Route::post('/banners/store', [BannersController::class, 'store'])->name('BannersStore');
Route::get('/banners/{id}/edit', [BannersController::class, 'edit'])->name('BannersEdit');
Route::post('/banners/{id}/update', [BannersController::class, 'update'])->name('BannersUpdate');
Route::get('/banners/destroy/{id}', [BannersController::class, 'destroy'])->name('BannersDestroy');
Route::post('/banners/updateAll', [BannersController::class, 'updateAll'])->name('BannersUpdateAll');

// Sections
Route::get('/{webmasterId}/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/{webmasterId}/categories/create', [CategoriesController::class, 'create'])->name('categoriesCreate');
Route::post('/{webmasterId}/categories/store', [CategoriesController::class, 'store'])->name('categoriesStore');
Route::get('/{webmasterId}/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categoriesEdit');
Route::post('/{webmasterId}/categories/{id}/update', [CategoriesController::class, 'update'])->name('categoriesUpdate');
Route::post('/{webmasterId}/categories/{id}/seo', [CategoriesController::class, 'seo'])->name('categoriesSEOUpdate');
Route::get('/{webmasterId}/categories/destroy/{id?}', [CategoriesController::class, 'destroy'])->name('categoriesDestroy');
Route::post('/{webmasterId}/categories/updateAll', [CategoriesController::class, 'updateAll'])->name('categoriesUpdateAll');

// Topics
Route::get('/{webmasterId}/topics', [TopicsController::class, 'index'])->name('topics');
Route::post('/topics-list', [TopicsController::class, 'list'])->name('topicsList');
Route::get('/{webmasterId}/view/{id}', [TopicsController::class, 'view'])->name('topicView');
Route::get('/{webmasterId}/topics/create', [TopicsController::class, 'create'])->name('topicsCreate');
Route::post('/{webmasterId}/topics/store', [TopicsController::class, 'store'])->name('topicsStore');
Route::get('/{webmasterId}/topics/{id}/edit', [TopicsController::class, 'edit'])->name('topicsEdit');
Route::post('/{webmasterId}/topics/{id}/update', [TopicsController::class, 'update'])->name('topicsUpdate');
Route::get('/{webmasterId}/topics/destroy/{id?}', [TopicsController::class, 'destroy'])->name('topicsDestroy');
Route::post('/{webmasterId}/topics/updateAll', [TopicsController::class, 'updateAll'])->name('topicsUpdateAll');
// Topics :SEO
Route::post('/{webmasterId}/topics/{id}/seo', [TopicsController::class, 'seo'])->name('topicsSEOUpdate');
// Topics :Photos
Route::post('/topics/upload', [TopicsController::class, 'upload'])->name('topicsPhotosUpload');
Route::post('/{webmasterId}/topics/{id}/photos', [TopicsController::class, 'photos'])->name('topicsPhotosEdit');
Route::get('/{webmasterId}/topics/{id}/photos/{photo_id}/destroy',
    [TopicsController::class, 'photosDestroy'])->name('topicsPhotosDestroy');
Route::post('/{webmasterId}/topics/{id}/photos/updateAll',
    [TopicsController::class, 'photosUpdateAll'])->name('topicsPhotosUpdateAll');

// Topics :Files
Route::get('/{webmasterId}/topics/{id}/files', [TopicsController::class, 'topicsFiles'])->name('topicsFiles');
Route::get('/{webmasterId}/topics/{id}/files/create',
    [TopicsController::class, 'filesCreate'])->name('topicsFilesCreate');
Route::post('/{webmasterId}/topics/{id}/files/store',
    [TopicsController::class, 'filesStore'])->name('topicsFilesStore');
Route::get('/{webmasterId}/topics/{id}/files/{file_id}/edit',
    [TopicsController::class, 'filesEdit'])->name('topicsFilesEdit');
Route::post('/{webmasterId}/topics/{id}/files/{file_id}/update',
    [TopicsController::class, 'filesUpdate'])->name('topicsFilesUpdate');
Route::get('/{webmasterId}/topics/{id}/files/destroy/{file_id}',
    [TopicsController::class, 'filesDestroy'])->name('topicsFilesDestroy');
Route::post('/{webmasterId}/topics/{id}/files/updateAll',
    [TopicsController::class, 'filesUpdateAll'])->name('topicsFilesUpdateAll');


// Topics :Related
Route::get('/{webmasterId}/topics/{id}/related', [TopicsController::class, 'topicsRelated'])->name('topicsRelated');
Route::get('/relatedLoad/{id}', [TopicsController::class, 'topicsRelatedLoad'])->name('topicsRelatedLoad');
Route::get('/{webmasterId}/topics/{id}/related/create',
    [TopicsController::class, 'relatedCreate'])->name('topicsRelatedCreate');
Route::post('/{webmasterId}/topics/{id}/related/store',
    [TopicsController::class, 'relatedStore'])->name('topicsRelatedStore');
Route::get('/{webmasterId}/topics/{id}/related/destroy/{related_id}',
    [TopicsController::class, 'relatedDestroy'])->name('topicsRelatedDestroy');
Route::post('/{webmasterId}/topics/{id}/related/updateAll',
    [TopicsController::class, 'relatedUpdateAll'])->name('topicsRelatedUpdateAll');
// Topics :Comments
Route::get('/{webmasterId}/topics/{id}/comments', [TopicsController::class, 'topicsComments'])->name('topicsComments');
Route::get('/{webmasterId}/topics/{id}/comments/create',
    [TopicsController::class, 'commentsCreate'])->name('topicsCommentsCreate');
Route::post('/{webmasterId}/topics/{id}/comments/store',
    [TopicsController::class, 'commentsStore'])->name('topicsCommentsStore');
Route::get('/{webmasterId}/topics/{id}/comments/{comment_id}/edit',
    [TopicsController::class, 'commentsEdit'])->name('topicsCommentsEdit');
Route::post('/{webmasterId}/topics/{id}/comments/{comment_id}/update',
    [TopicsController::class, 'commentsUpdate'])->name('topicsCommentsUpdate');
Route::get('/{webmasterId}/topics/{id}/comments/destroy/{comment_id}',
    [TopicsController::class, 'commentsDestroy'])->name('topicsCommentsDestroy');
Route::post('/{webmasterId}/topics/{id}/comments/updateAll',
    [TopicsController::class, 'commentsUpdateAll'])->name('topicsCommentsUpdateAll');
// Topics :Maps
Route::get('/{webmasterId}/topics/{id}/maps', [TopicsController::class, 'topicsMaps'])->name('topicsMaps');
Route::get('/{webmasterId}/topics/{id}/maps/create', [TopicsController::class, 'mapsCreate'])->name('topicsMapsCreate');
Route::post('/{webmasterId}/topics/{id}/maps/store', [TopicsController::class, 'mapsStore'])->name('topicsMapsStore');
Route::get('/{webmasterId}/topics/{id}/maps/{map_id}/edit', [TopicsController::class, 'mapsEdit'])->name('topicsMapsEdit');
Route::post('/{webmasterId}/topics/{id}/maps/{map_id}/update',
    [TopicsController::class, 'mapsUpdate'])->name('topicsMapsUpdate');
Route::get('/{webmasterId}/topics/{id}/maps/destroy/{map_id}',
    [TopicsController::class, 'mapsDestroy'])->name('topicsMapsDestroy');
Route::post('/{webmasterId}/topics/{id}/maps/updateAll',
    [TopicsController::class, 'mapsUpdateAll'])->name('topicsMapsUpdateAll');

// Contacts Groups
Route::post('/contacts/storeGroup', [ContactsController::class, 'storeGroup'])->name('contactsStoreGroup');
Route::get('/contacts/{id}/editGroup', [ContactsController::class, 'editGroup'])->name('contactsEditGroup');
Route::post('/contacts/{id}/updateGroup', [ContactsController::class, 'updateGroup'])->name('contactsUpdateGroup');
Route::get('/contacts/destroyGroup/{id}', [ContactsController::class, 'destroyGroup'])->name('contactsDestroyGroup');
// Contacts
Route::get('/contacts/{group_id?}', [ContactsController::class, 'index'])->name('contacts');
Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contactsStore');
Route::post('/contacts/search', [ContactsController::class, 'search'])->name('contactsSearch');
Route::get('/contacts/{id}/edit', [ContactsController::class, 'edit'])->name('contactsEdit');
Route::post('/contacts/{id}/update', [ContactsController::class, 'update'])->name('contactsUpdate');
Route::get('/contacts/destroy/{id}', [ContactsController::class, 'destroy'])->name('contactsDestroy');
Route::post('/contacts/updateAll', [ContactsController::class, 'updateAll'])->name('contactsUpdateAll');

// WebMails Groups
Route::post('/webmails/storeGroup', [WebmailsController::class, 'storeGroup'])->name('webmailsStoreGroup');
Route::get('/webmails/{id}/editGroup', [WebmailsController::class, 'editGroup'])->name('webmailsEditGroup');
Route::post('/webmails/{id}/updateGroup', [WebmailsController::class, 'updateGroup'])->name('webmailsUpdateGroup');
Route::get('/webmails/destroyGroup/{id}', [WebmailsController::class, 'destroyGroup'])->name('webmailsDestroyGroup');
// WebMails
Route::post('/webmails/store', [WebmailsController::class, 'store'])->name('webmailsStore');
Route::post('/webmails/search', [WebmailsController::class, 'search'])->name('webmailsSearch');
Route::get('/webmails/{id}/edit', [WebmailsController::class, 'edit'])->name('webmailsEdit');
Route::get('/webmails/{group_id?}/{wid?}/{stat?}/{contact_email?}', [WebmailsController::class, 'index'])->name('webmails');
Route::post('/webmails/{id}/update', [WebmailsController::class, 'update'])->name('webmailsUpdate');
Route::get('/webmails/destroy/{id}', [WebmailsController::class, 'destroy'])->name('webmailsDestroy');
Route::post('/webmails/updateAll', [WebmailsController::class, 'updateAll'])->name('webmailsUpdateAll');

// Calendar
Route::get('/calendar', [EventsController::class, 'index'])->name('calendar');
Route::get('/calendar/create', [EventsController::class, 'create'])->name('calendarCreate');
Route::post('/calendar/store', [EventsController::class, 'store'])->name('calendarStore');
Route::get('/calendar/{id}/edit', [EventsController::class, 'edit'])->name('calendarEdit');
Route::post('/calendar/{id}/update', [EventsController::class, 'update'])->name('calendarUpdate');
Route::get('/calendar/destroy/{id}', [EventsController::class, 'destroy'])->name('calendarDestroy');
Route::get('/calendar/updateAll', [EventsController::class, 'updateAll'])->name('calendarUpdateAll');
Route::post('/calendar/{id}/extend', [EventsController::class, 'extend'])->name('calendarExtend');

// Analytics
Route::get('/ip/{ip_code?}', [AnalyticsController::class, 'ip'])->name('visitorsIP');
Route::post('/ip/search', [AnalyticsController::class, 'search'])->name('visitorsSearch');
Route::post('/analytics/{stat}', [AnalyticsController::class, 'filter'])->name('analyticsFilter');
Route::get('/analytics/{stat?}', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/visitors', [AnalyticsController::class, 'visitors'])->name('visitors');

// Users & Permissions
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/create/', [UsersController::class, 'create'])->name('usersCreate');
Route::post('/users/store', [UsersController::class, 'store'])->name('usersStore');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('usersEdit');
Route::post('/users/{id}/update', [UsersController::class, 'update'])->name('usersUpdate');
Route::get('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('usersDestroy');
Route::post('/users/updateAll', [UsersController::class, 'updateAll'])->name('usersUpdateAll');

Route::get('/users/permissions/create/', [UsersController::class, 'permissions_create'])->name('permissionsCreate');
Route::post('/users/permissions/store', [UsersController::class, 'permissions_store'])->name('permissionsStore');
Route::get('/users/permissions/{id}/edit', [UsersController::class, 'permissions_edit'])->name('permissionsEdit');
Route::post('/users/permissions/{id}/update', [UsersController::class, 'permissions_update'])->name('permissionsUpdate');
Route::post('/users/permissions/{id}/save', [UsersController::class, 'update_custom_home'])->name('permissionsHomePageUpdate');
Route::get('/users/permissions/destroy/{id}', [UsersController::class, 'permissions_destroy'])->name('permissionsDestroy');

Route::post('/permissions-links/store', [UsersController::class, 'links_store'])->name('customLinksStore');
Route::post('/permissions-links/update', [UsersController::class, 'links_update'])->name('customLinksUpdate');
Route::get('/permissions-links/edit/{id?}/{p_id?}', [UsersController::class, 'links_edit'])->name('customLinksEdit');
Route::get('/permissions-links/destroy/{id?}/{p_id?}', [UsersController::class, 'links_destroy'])->name('customLinksDestroy');
Route::get('/permissions-links/list/{p_id?}', [UsersController::class, 'links_list'])->name('customLinksList');


// Menus
Route::post('/menus/store/parent', [MenusController::class, 'storeMenu'])->name('parentMenusStore');
Route::get('/menus/parent/{id}/edit', [MenusController::class, 'editMenu'])->name('parentMenusEdit');
Route::post('/menus/{id}/update/{ParentMenuId}', [MenusController::class, 'updateMenu'])->name('parentMenusUpdate');
Route::get('/menus/parent/destroy/{id}', [MenusController::class, 'destroyMenu'])->name('parentMenusDestroy');

Route::get('/menus/{ParentMenuId?}', [MenusController::class, 'index'])->name('menus');
Route::get('/menus/create/{ParentMenuId?}', [MenusController::class, 'create'])->name('menusCreate');
Route::post('/menus/store/{ParentMenuId?}', [MenusController::class, 'store'])->name('menusStore');
Route::get('/menus/{id}/edit/{ParentMenuId?}', [MenusController::class, 'edit'])->name('menusEdit');
Route::post('/menus/{id}/update', [MenusController::class, 'update'])->name('menusUpdate');
Route::get('/menus/destroy/{id}', [MenusController::class, 'destroy'])->name('menusDestroy');
Route::post('/menus/updateAll', [MenusController::class, 'updateAll'])->name('menusUpdateAll');
// life member route
Route::get('/life-member/index', [LifeMemberController::class, 'lifeMemberIndex'])->name('lifeMember.index');
Route::get('/life-member/destory/{id}', [LifeMemberController::class, 'lifeMemberDestroy'])->name('lifeMember.destroy');
// Committee type route
Route::get('/committee-type/index', [CommitteeTypeController::class,'index'])->name('committeeType.index');
Route::post('/committee-type/store', [CommitteeTypeController::class,'store'])->name('committeeType.store');
Route::put('/committee-type/update/{id}', [CommitteeTypeController::class,'update'])->name('committeeType.update');
Route::get('/committee-type/destroy/{id}', [CommitteeTypeController::class,'destroy'])->name('committeeType.destroy');
// Committee route
Route::get('/committee/index/{id}', [CommitteeController::class,'index'])->name('committee.index');
Route::get('/committee/create', [CommitteeController::class,'create'])->name('committee.create');
Route::post('/committee/store', [CommitteeController::class,'store'])->name('committee.store');
Route::get('/committee/edit/{id}', [CommitteeController::class,'edit'])->name('committee.edit');
Route::put('/committee/update/{id}', [CommitteeController::class,'update'])->name('committee.update');
Route::get('/committee/destroy/{id}', [CommitteeController::class,'destroy'])->name('committee.destroy');
Route::put('/committee/status/{id}',[CommitteeController::class,'status'])->name('committee.status');
Route::get('/committee/generate-pdf/{id}', [CommitteeController::class, 'generatePDF'])->name('committee.pdf');
// Department route
Route::get('/department/index', [DepartmentController::class,'index'])->name('department.index');
Route::post('/department/store', [DepartmentController::class,'store'])->name('department.store');
Route::put('/department/update/{id}', [DepartmentController::class,'update'])->name('department.update');
Route::get('/department/destroy/{id}', [DepartmentController::class,'destroy'])->name('department.destroy');
// Sub Department route
Route::get('/sub-department/index', [SubDepartmentController::class,'index'])->name('sub.department.index');
Route::get('/sub-department/create', [SubDepartmentController::class,'create'])->name('sub.department.create');
Route::post('/sub-department/store', [SubDepartmentController::class,'store'])->name('sub.department.store');
Route::get('/sub-department/edit/{id}', [SubDepartmentController::class,'edit'])->name('sub.department.edit');
Route::put('/sub-department/update/{id}', [SubDepartmentController::class,'update'])->name('sub.department.update');
Route::get('/sub-department/destroy/{id}', [SubDepartmentController::class,'destroy'])->name('sub.department.destroy');
// Subject route
Route::get('/subject/index', [SubjectController::class,'index'])->name('subject.index');
Route::get('/subject/create', [SubjectController::class,'create'])->name('subject.create');
Route::post('/subject/store', [SubjectController::class,'store'])->name('subject.store');
Route::get('/subject/edit/{id}', [SubjectController::class,'edit'])->name('subject.edit');
Route::put('/subject/update/{id}', [SubjectController::class,'update'])->name('subject.update');
Route::get('/subject/destroy/{id}', [SubjectController::class,'destroy'])->name('subject.destroy');
// Student management route
Route::get('/student/index',[StudentController::class,'index'])->name('student.index');
Route::get('/student/create',[StudentController::class,'create'])->name('student.create');
Route::post('/student/store',[StudentController::class,'store'])->name('student.store');
Route::get('/student/show/{id}',[StudentController::class,'show'])->name('student.show');
Route::get('/student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('/student/update/{id}',[StudentController::class,'update'])->name('student.update');
Route::get('/student/destroy/{id}',[StudentController::class,'destroy'])->name('student.destroy');
Route::put('/student/status/{id}',[StudentController::class,'status'])->name('student.status');
// Result management route
Route::get('/student/result/index',[ResultController::class,'index'])->name('student.result.index');
Route::get('/student/result/create',[ResultController::class,'create'])->name('student.result.create');
Route::post('/student/result/store',[ResultController::class,'store'])->name('student.result.store');
Route::get('/student/result/show/{id}',[ResultController::class,'show'])->name('student.result.show');
Route::get('/student/result/edit/{id}',[ResultController::class,'edit'])->name('student.result.edit');
Route::put('/student/result/update/{id}',[ResultController::class,'update'])->name('student.result.update');
Route::get('/student/result/destroy/{id}',[ResultController::class,'destroy'])->name('student.result.destroy');
Route::put('/student/result/status/{id}',[ResultController::class,'status'])->name('student.result.status');
//get sub department form ajax
Route::get('/get/students/{id}',[ResultController::class,'getStudents']);
Route::get('/get/subjects/{id}',[ResultController::class,'getSubjects']);
// Student management route
Route::get('/teacher/index',[TeacherController::class,'index'])->name('dashboard.teacher.index');
Route::get('/teacher/create',[TeacherController::class,'create'])->name('teacher.create');
Route::post('/teacher/store',[TeacherController::class,'store'])->name('teacher.store');
Route::get('/teacher/show/{id}',[TeacherController::class,'show'])->name('teacher.show');
Route::get('/teacher/edit/{id}',[TeacherController::class,'edit'])->name('teacher.edit');
Route::put('/teacher/update/{id}',[TeacherController::class,'update'])->name('teacher.update');
Route::get('/teacher/destroy/{id}',[TeacherController::class,'destroy'])->name('teacher.destroy');
Route::put('/teacher/status/{id}',[TeacherController::class,'status'])->name('teacher.status');



Route::get('file-manager', [FileManagerController::class, 'index'])->name('FileManager');
Route::get('files-manager', [FileManagerController::class, 'manager'])->name('FilesManager');

// Clear Cache
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return redirect()->back()->with('doneMessage', __('backend.cashClearDone'));
})->name('cacheClear');
