<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\User;

class ArticleController extends Controller
{
    public function index(){
        $data = [
            'article' => Article::all(),
            'user' => User::all(),
        ];
        return compact('data');
    }
}
?>