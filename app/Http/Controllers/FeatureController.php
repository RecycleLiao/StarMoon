<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\FeatureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features= Feature::orderBy('created_at','desc')->get();        
        return view('admin.feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image_url')){
            $path = Storage::put('/feature',$request->image_url);
        }
        $feature = Feature::create([            
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_url' => $path,
            'description' => $request->description,
        ]);
        foreach($request->image_urls??[] as $image_url){
            $path = Storage::put('/feature',$image_url);

            FeatureImage::create([
                'feature_id' => $feature->id,
                'image_url' =>$path,
            ]);
        }
        return redirect()->route('features.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature =Feature::with('featureImages')->find($id);
        return view('admin.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $feature = Feature::find($id);
        if($request->hasFile('image_url')){
            Storage::delete($feature->image_url);
            $path=Storage::put('/feature',$request->image_url);            
        }else{
            $path =$feature->image_url;
        }
        $feature->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_url' => $path,
            'description' => $request->description,
    ]);

        // 判斷是否有上傳新的其他圖片
        if ($request->hasFile('image_urls')){
            foreach ($request->image_urls as $image_url){
                $path = Storage::put('/feature',$image_url);

                FeatureImage::create([
                    'feature_id' => $feature->id,
                    'image_url' => $path
                ]);
            }
        }
        return redirect()->route('features.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature =Feature::with('featureImages')->find($id);
        Storage::delete($feature->image_url);
        foreach($feature->featureImages as $featureImage){
            Storage::delete($featureImage->image_url);
            $featureImage->delete();
        }
        $feature->delete();
        return redirect()->route('features.index');
    }

    public function imageDelete(Request $request)
    {
        // 找出對應的其他圖片
        $featureImage =FeatureImage::find($request->id);
        // 將圖片檔案刪除
        Storage::delete($featureImage->image_url);
        // 將資料從資料庫移除
        $featureImage->delete();
        return 'success';
    }
}
