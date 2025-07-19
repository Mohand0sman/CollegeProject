<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index() {
        if (auth()->user()->role === 'admin') {
            $articles = Article::all();
        } else {
            $articles = Article::where('user_id', auth()->id())->get();
        }

        return view('admin.articles', compact('articles'));
    }


    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image_upload' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        // اختر بين رابط أو رفع
        $imagePath = null;
        if ($request->hasFile('image_upload')) {
            $imageName = time() . '_' . $request->file('image_upload')->getClientOriginalName();
            $request->file('image_upload')->move(public_path('articles'), $imageName);
            $imagePath = 'articles/' . $imageName;
        } elseif ($request->image_url) {
            $imagePath = $request->image_url;
        }

        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المقالة');
    }

    public function update(Request $request, $id) {
    $article = Article::findOrFail($id);

    if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
        abort(403, 'غير مصرح لك بتعديل هذه المقالة');
    }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image_upload' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image_upload')) {
            if ($article->image && File::exists(public_path($article->image))) {
                File::delete(public_path($article->image));
            }
            $imageName = time() . '_' . $request->file('image_upload')->getClientOriginalName();
            $request->file('image_upload')->move(public_path('articles'), $imageName);
            $article->image = 'articles/' . $imageName;
        } elseif ($request->image_url) {
            $article->image = $request->image_url;
        }

        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'تم تعديل المقالة');
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بحذف هذه المقالة');
        }
        if ($article->image && !str_starts_with($article->image, 'http')) {
            File::delete(public_path($article->image));
        }
        $article->delete();
        return redirect()->back()->with('success', 'تم حذف المقالة');
    }
}

