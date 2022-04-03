<?php

namespace App\Http\Controllers;

use App\Models\Bboard;
use Illuminate\Http\Request;

class BboardController extends Controller
{   
    private const BB_VALIDATOR = [
        'title' => 'required|max:200',
        'description' => 'required|max:1000',
        'price' => 'required|integer',
        'photo1' => 'required|url',
        'photo2' => 'url',
        'photo3' => 'url'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request['orderBy'])) {
            $order = explode(",",$request['orderBy']);
            return Bboard::orderBy($order[0], $order[1])->paginate(10);
        }
        return Bboard::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate(self::BB_VALIDATOR);
        $bboard = Bboard::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'photo1' => $validated['photo1'],
            'photo2' => @$validated['photo2'] ?? "",
            'photo3' => @$validated['photo3'] ?? "",
            'price' => $validated['price']
    ]);
        return response()->json($bboard, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bboard $bboard)
    {
        if (isset($request['fields'])) {
            $attr = explode(",", $request['fields']);
            return $bboard->makeVisible($attr);
        }
        return $bboard;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bboard $bboard)
    {
        $validated = $request->validate(self::BB_VALIDATOR);
        dd();
        $bboard->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'photo1' => $validated['photo1'],
            'photo2' => @$validated['photo2'] ?? "",
            'photo3' => @$validated['photo3'] ?? "",
            'price' => $validated['price']]);
        return response()->json($bboard, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bboard $bboard)
    {
        $bboard->delete();
        return response()->json(null, 204);
    }
}
