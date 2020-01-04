<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class Homepage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active == 0) {
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::whereStatus(1)->orderBy('order', 'ASC')->get());
        view()->share('categories', Category::whereStatus(1)->inRandomOrder()->get());
    }

    public function index()
    {
        $data['articles'] = Article::with('getCategory')->whereStatus(1)->whereHas('getCategory', function ($query) {
            $query->whereStatus(1);
        })->orderBy('created_at', 'DESC')->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereStatus(1)->whereSlug($category)->first() ?? abort(403, 'Boyle bir kategori bulunamadi.');
        $article = Article::whereStatus(1)->whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Boyle bir yazi bulunamadi.');
        $article->increment('hit');
        $data['article'] = $article;
        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::whereStatus(1)->whereSlug($slug)->first() ?? abort(403, 'Boyle bir kategori bulunamadi.');
        $data['category'] = $category;
        $data['articles'] = Article::whereStatus(1)->where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(10);
        $data['articleCount'] = Article::whereStatus(1)->where('category_id', $category->id)->orderBy('created_at', 'DESC')->count();
        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::whereStatus(1)->whereSlug($slug)->first() ?? abort(403, 'Boyle bir sayfa bulunamadi.');
        $data['page'] = $page;
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required | min:5',
            'email' => 'required | email',
            'topic' => 'required ',
            'message' => 'required | min:10'
        ];

        $validate = Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([], [], function ($message) use ($request) {
            $message->from('iletisim@blogsitesi.com', 'Blog Sitesi');
            $message->to('iletisim@blogsitesi.com');
            $message->setBody(' Mesaji Gonderen :' . $request->name . '<br>
                    Mesaji Gonderen Mail :' . $request->email . '<br>
                    Mesaj Konusu : ' . $request->topic . '<br>
                    Mesaj :' . $request->message . '<br><br>
                    Mesaj Gonderilme Tarihi : ' . now(), 'text/html');
            $message->subject($request->name . ' iletisimden mesaj gonderdi!');
        });

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesajiniz bize iletildi. Tesekkur ederiz!');
    }
}
