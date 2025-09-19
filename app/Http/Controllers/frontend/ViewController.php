<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AppBasics;
use App\Models\Banner;
use App\Models\BannerCarrousel;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Machine;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Service;
use App\Models\Value;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home()
    {
        $banner = Banner::first();
        $about = About::first();
        $services = Service::where('status', true)->get();
        $categories = Category::latest()->get();
        $machines = Machine::limit(4)->get();
        $partners = Partner::where('status', true)->get();
        $bannerCarrousel = BannerCarrousel::all();

        return view('apps.pages.frontend.index', compact('banner', 'about', 'services', 'categories', 'machines', 'partners', 'bannerCarrousel'));
    }

    public function about()
    {
        $about = About::first();
        $values = Value::where('status', true)->latest()->get();

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'À propos', 'url' => null]
        ];

        return view('apps.pages.frontend.about', compact('about', 'values', 'breadcrumbs'));
    }

    public function catalog(Request $request)
    {
        $query = Machine::query();

        // Recherche par nom
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtrage par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $machines = $query->latest()->paginate(12);
        $categories = Category::all(); // Pour le filtre dans la vue

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Catalogue', 'url' => route('view.catalog')],
        ];

        if ($request->filled('search')) {
            $breadcrumbs[] = ['label' => e($request->search), 'url' => null];
        } elseif ($request->filled('category')) {
            $categoryName = Category::find($request->category)?->name ?? 'Inconnue';
            $breadcrumbs[] = ['label' => $categoryName, 'url' => null];
        }

        return view('apps.pages.frontend.catalog', compact('machines', 'categories', 'breadcrumbs'));
    }

    public function posts()
    {
        $posts = Post::where('status', 'publish')->latest()->get();

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Actualités', 'url' => null]
        ];

        return view('apps.pages.frontend.posts', compact('posts', 'breadcrumbs'));
    }

    public function post(string $id)
    {
        $post = Post::find($id);

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Actualité', 'url' => route('view.posts')],
            ['label' => $post->title, 'url' => null],
        ];

        return view('apps.pages.frontend.post', compact('post', 'breadcrumbs'));
    }

    public function contact()
    {
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Contacts', 'url' => null]
        ];

        $appBasics = AppBasics::first();

        return view('apps.pages.frontend.contact', compact('breadcrumbs', 'appBasics'));
    }

    public function dashboard()
    {
        $machines = Machine::all();
        $posts = Post::all();
        $messages = Contact::all();
        $partners = Partner::all();

        return view('apps.pages.backend.dashboard', compact('machines', 'posts', 'messages', 'partners'));
    }

    public function detail(string $id)
    {
        $machine = Machine::find($id);

        $categoryName = Category::find($machine->category_id)?->name ?? 'Inconnue';

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Catalogue', 'url' => route('view.catalog')],
            //['label' => $categoryName->name, 'url' => route('view.catalog', ['query' => $categoryName->id])],
            ['label' => $machine->name, 'url' => null],
        ];

        return view('apps.pages.frontend.detail', compact('machine', 'breadcrumbs'));
    }

    public function devis()
    {
        $cart = session()->get('cart', []);

        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Demander un devis', 'url' => null],
        ];

        return view('apps.pages.frontend.devis', compact('cart', 'breadcrumbs'));
    }

    public function congrats()
    {
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('view.home')],
            ['label' => 'Félicitations', 'url' => null],
        ];

        return view('apps.pages.frontend.congrats', compact('breadcrumbs'));
    }

    public function searchStore(Request $request)
    {
        $machines = Machine::all();

        if ($request->has('query') && $request->input('query') != '') {
            $query = $request->input('query');

            $machines = Machine::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
                ->paginate(9);
        } else {
            $machines = Machine::latest()->paginate(9);
        }

        return view('apps.pages.frontend.catalog', compact('machines'));
    }

    public function privacy()
    {
        $appBasics = AppBasics::first();

        return view('apps.pages.frontend.privacy', compact('appBasics'));
    }

    public function login()
    {
        return view('apps.auths.login');
    }
}
