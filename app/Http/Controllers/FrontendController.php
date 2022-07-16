<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Speaker;
use App\Models\Register;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::where('status',true)->get();
        $data['concurrent'] = Banner::with('bannerItems')->where('banner_name','Concurrent Events')->get();
        $data['partners'] = Banner::with('bannerItems')->where('banner_name','Our Partners')->get();
        $data['sponsors'] = Banner::with('bannerItems')->where('banner_name','Our Sponsors')->get();
        $data['events'] = Event::where('status',true)->get();
        $data['speakers'] = Speaker::where('status',true)->take('8')->orderBy('sort_order', 'asc')->get();
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->orderBy('sort_order', 'asc')->get();
        $data['testimonials'] = Testimonial::where('status',true)->latest()->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.layout',$data);
    }


    public function singlePage($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $menus = Page::where('parent_id',0)->where('top',true)->orderBy('sort_order', 'asc')->get();
        $sidebars = Page::with('media')->where('parent_id',0)->orderBy('sort_order', 'asc')->get();
        $footers = Page::where('parent_id',0)->get();
        return view('frontend.page')->with(compact('page','menus','sidebars','footers'));
    }


    public function about()
    {
        $page = Page::where('slug', 'about-biid')->first();
        $menus = Page::where('parent_id',0)->where('top',true)->orderBy('sort_order', 'asc')->get();
        $footers = Page::where('parent_id',0)->get();
        $sidebars = Page::with('media')->where('parent_id',0)->orderBy('sort_order', 'asc')->get();
        return view('frontend.about')->with(compact('page','menus','sidebars','footers'));
    }

    public function event()
    {
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['events'] = Event::where('status',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.event',$data);
    }

    public function eventSlug($slug)
    {
        $data['event'] = Event::where('slug', $slug)->first();
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.eventSlug',$data);
    }

    public function speaker()
    {
        $data['speakers'] = Speaker::where('status',true)->orderBy('sort_order', 'asc')->get();
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.speaker',$data);
    }
    public function news()
    {
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['newses'] = News::where('status',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.news',$data);
    }

    public function newsSlug($slug)
    {
        $data['news'] = News::where('slug', $slug)->first();
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.newsSlug',$data);
    }

    public function registration(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'event' => 'required',
                'companyName' => 'required|string',
                'contactName' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'areaCode' => 'required|string',
                'country' => 'required|string',
                'telephone' => 'nullable|string',
                'mobile' => 'required|string',
                'email' => 'required|email',
                'website' => 'nullable|string'
            ]);

            $register = Register::create([
                'event_id' => $request->event,
                'companyName' => $request->companyName,
                'contactName' => $request->contactName,
                'address' => $request->address,
                'city' => $request->city,
                'areaCode' => $request->areaCode,
                'country' => $request->country,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'website' => $request->website,
            ]);
            return redirect()->back()->with('flash_message_success', 'Registration has been successfully completed');
        }
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->get();
        $data['events'] = Event::where('status',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.registration',$data);
    }

    public function contact(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'subject' => 'required|string',
                'enquiry' => 'required|string'
            ]);

            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'enquiry' => $request->enquiry,
            ]);
            return redirect()->back()->with('flash_message_success', 'Your enquiry Has been sent Successfully. We will contact you soon.');
        }
        $data['menus'] = Page::where('parent_id',0)->where('top',true)->orderBy('sort_order', 'asc')->get();
        $data['events'] = Event::where('status',true)->get();
        $data['footers'] = Page::where('parent_id',0)->get();
        return view('frontend.contact',$data);
    }
}
