<?php

namespace App\Http\Controllers;

use App\Models\CategoryUser;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:category-list', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'store', 'destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryUsers = CategoryUser::join('users', 'category_users.user_id', '=', 'users.id')
            ->join('categories', 'category_users.category_id', '=', 'categories.id')
            ->select('users.name as user', 'categories.name as category')
            ->get();

        return response()->json($categoryUsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $categoryId = $request->input('categoryId');
        $userId = $request->input('userId');

        $category = Category::findOrFail($categoryId);
        $user = User::findOrFail($userId);

        if ($category->users->contains($user)) {
            return response()->json(['message' => 'User is already in this category.'], 200);
        }

        $category->users()->attach($user);

        return response()->json(['message' => 'User added to category successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryUser  $categoryUser
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryUser $categoryUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryUser  $categoryUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryUser $categoryUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryUser  $categoryUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryUser $categoryUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryUser  $categoryUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryUser $categoryUser)
    {
        //
    }
}
