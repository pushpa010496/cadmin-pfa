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



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    
Route::get('/', 'HomeController@main');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('role','RoleController');
Route::resource('users','NewuserController');
Route::resource('permit','PermissionController');

Route::group(['middleware' => ['permission:settings']], function() {
 Route::resource("/permissions", "PermissionController"); 
});
Route::group(['middleware' => ['permission:settings']], function() {
 Route::resource("/roles", "RoleController"); 
});

 
/* Category section Routes */
/* Route occ */
Route::group(['middleware' => ['permission:industrialupdates']], function() {
Route::resource('editorialcategory','CategoryController');
Route::get('editorialcategory/reactivate/{editorialcategory}','CategoryController@reactivate');

Route::resource('editorialarticle','EditorialarticleController');
Route::get('editorialarticle/reactivate/{editorialarticle}','EditorialarticleController@reactivate');
Route::post('editorialarticle/metatag/{editorialarticle}','EditorialarticleController@metatag')->name('editorialarticle.meta');

Route::resource('seriesarticle','SeriesarticleController');

Route::resource('issues','IssueController');
Route::get('issue/reactivate/{issue}','IssueController@reactivate');

Route::resource('ebooks','EbookController');
Route::get('ebook/reactivate/{ebook}','EbookController@reactivate');
Route::post('ebook/metatag/{ebook}','EbookController@metatag')->name('ebook.meta');


Route::resource('clientadverts','ClientAdvertsController');
Route::get('clientadverts/reactivate/{clientadvert}','ClientAdvertsController@reactivate');
Route::post('clientadverts/metatag/{clientadvert}','ClientAdvertsController@metatag')->name('clientadverts.meta');


Route::resource('authorguideline','AuthorguidelineController');
Route::get('authorguideline/reactivate/{authorguideline}','AuthorguidelineController@reactivate');
Route::post('authorguideline/metatag/{authorguideline}','AuthorguidelineController@metatag')->name('authorguideline.meta');

Route::resource('advisorboard','AdvaisoryBoardController');
Route::get('advisorboard/reactivate/{advisorboard}','AdvaisoryBoardController@reactivate');
Route::post('advisorboard/metatag/{advisorboard}','AdvaisoryBoardController@metatag')->name('advisorboard.meta');

Route::resource('testimonials','TestimonialController');
Route::get('testimonial/reactivate/{testimonial}','TestimonialController@reactivate');
Route::post('testimonials/metatag/{testimonials}','TestimonialController@metatag')->name('testimonials.meta');

Route::resource('cmspages','CmsPageController');
Route::get('cmspages/reactivate/{cmspage}','CmsPageController@reactivate');
Route::post('cmspages/metatag/{cmspage}','CmsPageController@metatag')->name('cmspages.meta');




Route::resource('callender','CallenderController');
Route::get('callender/reactivate/{callender}','CallenderController@reactivate');

Route::resource('mediapack','MediaPackController');
Route::get('mediapack/reactivate/{mediapack}','MediaPackController@reactivate');

Route::resource('contributors','ContributorsController');
Route::get('contributors/reactivate/{contributors}','ContributorsController@reactivate');

});
// Route::resource('banners','NewBannerController');

/* Route occ End */
/* Industrial Updates */
Route::group(['middleware' => ['permission:industrialupdates']], function() {
	Route::resource('news','NewsController');
	Route::post('news/metatag/{id}','NewsController@metatag')->name('news.meta');
	Route::get('news/reactivate/{id}','NewsController@reactivate');

	Route::resource('pressrelease', 'PressreleaseController');
	Route::post('pressrelease/metatag/{id}','PressreleaseController@metatag')->name('pressrelease.meta');
	Route::get('pressrelease/reactivate/{id}','PressreleaseController@reactivate');

	Route::resource('events', 'EventController');
	Route::post('events/metatag/{id}','EventController@metatag')->name('events.meta');
	Route::get('events/reactivate/{id}','EventController@reactivate');

	Route::resource('reportcategories', 'ReportCategoryController');
	Route::post('reportcategory/metatag/{id}','ReportCategoryController@metatag')->name('reportcategy.meta');
	Route::get('reportcategory/reactivate/{id}','ReportCategoryController@reactivate');	
	
	Route::resource('technotrends','TechnoTrendController');
Route::get('technotrends/reactivate/{technotrend}','TechnoTrendController@reactivate');
Route::post('technotrends/metatag/{id}','TechnoTrendController@metatag')->name('technotrends.meta');
});
/* Industrial Updates End*/
Route::group(['middleware' => ['permission:sliders']], function() { 
	Route::resource("/pages", "PageController");
	Route::get('pages/reactivate/{id}','PageController@reactivate');
});

Route::group(['middleware' => ['permission:sliders']], function() { 
	Route::resource("/sliders", "SliderController");
	Route::get('sliders/reactivate/{id}','SliderController@reactivate');
	Route::get('slidersactive','SliderController@slidersactive');
});
Route::group(['middleware' => ['permission:banners']], function() { 
	Route::resource("/banners", "NewBannerController");
Route::get('banners/reactivate/{id}','NewBannerController@reactivate');
Route::resource("/positions", "PositionController");
Route::get('positions/reactivate/{id}','PositionController@reactivate');
Route::get('bannersactive','NewBannerController@bannersactive');
});

/*Advertise Starts */
Route::resource('print','PrintController');
Route::get('print/reactivate/{id}','PrintController@reactivate');
Route::resource('online','OnlineController');
Route::get('online/reactivate/{id}','OnlineController@reactivate');
Route::resource('targetmarket','TargetMarketController');
Route::get('targetmarket/reactivate/{id}','TargetMarketController@reactivate');
Route::resource('targetaudience','TargetAudienceController');
Route::get('targetaudience/reactivate/{id}','TargetAudienceController@reactivate');
Route::resource('terms','TermController');
Route::get('terms/reactivate/{id}','TermController@reactivate');
Route::resource('techspec','TechSpaceController');
Route::get('techspec/reactivate/{id}','TechSpaceController@reactivate');
Route::resource('advertisers','AdvertiserController');
Route::get('advertisers/reactivate/{id}','AdvertiserController@reactivate');

Route::resource('advertorials','AdvetorialsController');
Route::get('advertorials/reactivate/{id}','AdvetorialsController@reactivate');



/*Advertise Ends */

/*Knowledgebank start*/

Route::resource('article','ArticleController');
Route::get('article/reactivate/{id}','ArticleController@reactivate');
Route::post('article/metatag/{id}','ArticleController@metatag')->name('article.meta');
Route::resource('interview','InterviewController');
Route::get('interview/reactivate/{id}','InterviewController@reactivate');
Route::post('interview/metatag/{id}','InterviewController@metatag')->name('interview.meta');
Route::resource('project','ProjectController');
Route::get('project/reactivate/{project}','ProjectController@reactivate');
Route::post('project/metatag/{id}','ProjectController@metatag')->name('project.meta');

Route::resource('industryreport','IndustryReportController');
Route::get('industryreport/reactivate/{industryreport}','IndustryReportController@reactivate');
Route::post('industryreport/metatag/{id}','IndustryReportController@metatag')->name('industryreport.meta');

Route::resource('bookshelf','BookShelfController');
Route::get('bookshelf/reactivate/{bookshelf}','BookShelfController@reactivate');
Route::post('bookshelf/metatag/{id}','BookShelfController@metatag')->name('bookshelf.meta');
Route::resource('casestudies','CaseStudyController');
Route::get('casestudies/reactivate/{id}','CaseStudyController@reactivate');
Route::post('casestudies/metatag/{id}','CaseStudyController@metatag')->name('casestudies.meta');
Route::post('casestudiesform/csfmetatag/{id}','CaseStudyController@csfmetatag')->name('casestudiesform.meta');

 
Route::resource('whitepaper','WhitePaperController');
Route::get('whitepaper/reactivate/{whitepaper}','WhitePaperController@reactivate');
Route::post('whitepaper/metatag/{id}','WhitePaperController@metatag')->name('whitepaper.meta');
Route::post('whitepaperform/wpfmetatag/{id}','WhitePaperController@wpfmetatag')->name('whitepaperform.meta');



Route::resource('reaserchinsites','ReaserchInsitesController');
Route::get('reaserchinsites/reactivate/{reaserchinsite}','ReaserchInsitesController@reactivate');
Route::post('reaserchinsites/metatag/{id}','ReaserchInsitesController@metatag')->name('reaserchinsites.meta');

Route::group(['middleware' => ['permission:reports']], function() { 
Route::resource('reports','GlobalReportsController');
});

/*Knowledgebank End*/


/*eNewsletters section*/
	Route::resource("e-newsletters", "NewsletterController");
Route::group(['middleware' => ['permission:enewsletters']], function() { 

	 });
Route::get('e-newsletters/reactivate/{id}','NewsletterController@reactivate');

Route::group(['middleware' => ['permission:enewsletters']], function() { 
	Route::resource("clientemailblast", "ClientemailblastController");
	Route::get('clientemailblast/reactivate/{id}','ClientemailblastController@reactivate');
});

/*webinars section*/
Route::group(['middleware' => ['permission:webinars']], function() {
	Route::resource('webinars','WebinarController');	
	Route::get('webinars/reactivate/{webinar}','WebinarController@reactivate');
});

//seopage

Route::group(['middleware' => ['permission:seopage']], function() { 
	Route::resource("seopage", "SeopageController");
	 });
Route::post('seopage/metatag/{id}','SeopageController@metatag')->name('seopage.meta');

/*Event organiser*/

	Route::resource("eventorganisers", "EventOrgController");
Route::get('eventorganisers/reactivate/{id}','EventOrgController@reactivate');
Route::post('eventorganisers/metatag/{id}','EventOrgController@metatag')->name('eventorg.meta');


Route::group(['middleware' => ['permission:dataexport']], function() { 

Route::resource("dataexport", "DataexportController");

Route::post('/exportdata', 'DataexportController@exportdata')->name('exportdata');

});

Route::group(['middleware' => ['permission:fileupload']], function() { 
Route::resource("fileupload","FileuploadController");

});
/* Parsing */
 // Route::resource('newswire','NewswireController');
  Route::get('prnews','XmlpharseController@prnews');
  Route::get('businesswire','XmlpharseController@businesswire');
  Route::get('globalnews','XmlpharseController@globalnews');
  Route::get('indbwwires','XmlpharseController@indbwwires');
  Route::get('prnewsreport','XmlpharseController@prnewsreport');
  Route::get('businessreport','XmlpharseController@businesreport');
  Route::get('globalreport','XmlpharseController@globalreport');

  
/* End Parsing */

/* Client Token */

 // Route::get('passwordgen','UserController@passwordgen');
 Route::get("/usersinfo","UserController@usertoken")->name('usersinfo');

// Route::get('articleupdate','ArticleController@test');

Route::get('seoupdate','SeopageController@seoupdate');
Route::group(['middleware' => ['permission:leads']], function() { 
	Route::get('/promotionleads','DataexportController@promotionLeads');
	Route::get('/leads/{promotion}','DataexportController@promotionleadslist');
	Route::get('/leads/forms/{promotion}','DataexportController@promotionformleadslist');
	Route::get('/leads/download/{promotion}','DataexportController@promotiondownloadleadslist');
	Route::get('/leads/subscribe/{promotion}','DataexportController@promotionsubscribe');
	Route::get('/leads/webinars/{webinar}','DataexportController@promotionwebinars');
	Route::get('/cpcleads/{cpc}','DataexportController@cpcleads');
});
Route::get('banenrnotify','BannerNotifyController@index');
Route::get('slidernotify','BannerNotifyController@slider');

/*Google analytics for banners,edm,enewsletters*/


 Route::get('/trackbanner', 'GoogletrackreportsController@trackreport')->name('trackbanner');
Route::resource('analyticaltrackreports','GoogletrackreportsController');

Route::get('/trackedm', 'GoogleEdmreportsController@edmTrackreport')->name('edm');
Route::resource('analyticaledmreports','GoogleEdmreportsController');
Route::get("/ajax-edm/{titleid}",'GoogleEdmreportsController@ajaxedm');

Route::get('/trackenewsletter', 'GoogleEnewsletterreportsController@enewsTrackreport')->name('enewsletters');
Route::resource('analyticalenewsreports','GoogleEnewsletterreportsController');
//Route::get("/ajax-edm/{titleid}",'GoogleEnewsletterreportsController@ajaxedm');

/*Track link generation*/

Route::get('newlinkviews/{ttid}','TracklinkController@getview')->name('newlinkview');

Route::post('newlink','TracklinkController@Addnewlink')->name('newlinkss');

Route::resource('/tracklinkgen', 'TracklinkController');

// Route::get('/companytracker', 'TracklinkController@companyUrl');
// Route::get('/companytrackerupdate', 'TracklinkController@companyUrlUpdate');


Route::get('/trackreport', 'TracklinkController@trackreport');


//Route::get('/gettitleinfo', 'TracklinkController@gettitleinfo');

Route::get('excel', 'TrackreportExportController@downloadExcel',function(){

});
Route::get('excel/{short_urlid}','TrackreportExportController@reportbyip',function ($short_urlid) {
 
});
Route::get('excelclientip/{short_urlid}','TrackreportExportController@reportbyclientip',function ($short_urlid) {
 
});
Route::get('title/{title_id}','TrackreportExportController@titlereport',function ($title_id) {
 
});

Route::get('excelbytitle/{titleid}','TrackreportExportController@reportbytitle',function ($titleid) {
 
});
Route::get('{short_urlid}','TracklinkController@geturlinfo',function ($short_urlid) {
 
});
Route::get('titlesinfo/{ttid}','TracklinkController@gettitleinfo');

Route::post('sub-regions','GoogletrackreportsController@getSubRegions')->name('get.sub-regions');

Route::post('region-country','GoogletrackreportsController@getRegionCountry')->name('get.region-country');

});

