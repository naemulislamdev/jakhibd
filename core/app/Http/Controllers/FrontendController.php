<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Topic;
use App\Models\WebmasterSection;
use App\Models\WebmasterSetting;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // public function department(){

    //         $departments = DepartmentRepository::query()->where('is_active',true)->get();

    //         return view(
    //             "frontEnd.department",
    //             compact(
    //                 "departments"
    //             )
    //         );

    // }
    public function department($lang = "", $section = '', $id = '')
    {
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // get Webmaster section settings by name
        $Current_Slug = "seo_url_slug_" . @Helper::currentLanguage()->code;
        $Default_Slug = "seo_url_slug_" . env('DEFAULT_LANGUAGE');

            // count topics by Category

            // Get Latest News
            // $LatestNews = $this->latest_topics($WebmasterSettings->latest_news_section_id);

            // Page Title, Description, Keywords
            $seo_title_var = "seo_title_";
            $seo_description_var = "seo_description_";
            $seo_keywords_var = "seo_keywords_";
            $tpc_title_var = "title_";
            $site_desc_var = "site_desc_";
            $site_keywords_var = "site_keywords_";
                $PageTitle = "departmet";
                $PageDescription = "departmet";
                $PageKeywords = "departmet";
            // .. end of .. Page Title, Description, Keywords
            //Committee data
            $WebmasterSection = DepartmentRepository::query()->where('is_active',true)->get();

            return view(
                "frontEnd.department",
                compact(
                    "WebmasterSettings",
                    "WebmasterSection",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords"
                )
            );

    }
}
