<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleApiController extends Controller
{
        public function index()
    {
        $articles = Article::select('id', 'title', 'description', 'image', 'content', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->get();

        // تعديل مسار الصورة ليكون كاملاً
        $articles->transform(function ($article) {
            $article->image = $article->image 
            ? asset($article->image) 
                : null;
            return $article;
        });

        return response()->json([
            'status' => true,
            'articles' => $articles
        ],200, [], JSON_UNESCAPED_UNICODE);

    }
}
