<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Businesstype;
use App\Vendor;
use App\Post;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Database\Eloquent\Builder;

class VendorController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $businessData = Businesstype::withCount(['vendors' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('active', 1)
            ->orderBy('vendors_count', 'desc')->get();
        $q = $request->input('vendor-search');

        $vendors = Vendor::where('status', 1)
            ->whereHas('businesstype', function ($query) {
                $query->where('active', 1);
            })
            ->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('description', 'LIKE', '%' . $q . '%')
                    ->orWhere('sub_district', 'LIKE', '%' . $q . '%')
                    ->orWhere('district', 'LIKE', '%' . $q . '%')
                    ->orWhere('province', 'LIKE', '%' . $q . '%')
                    ->orWhere('postal_code', 'LIKE', '%' . $q . '%')
                    ->orWhereHas('products', function ($query) use ($q) {
                        $query->where('name', 'like', '%' . $q . '%')
                            ->where('status', 1)
                            ->orWhere('description', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('posts', function ($query) use ($q) {
                        $query->where('title', 'like', '%' . $q . '%')
                            ->where('published', 1)
                            ->orWhere('content', 'like', '%' . $q . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        if (count($vendors) > 0)
            return view('vendors.index', compact('businessData', 'vendors'))->withQuery($q);
        else return view('vendors.index', compact('businessData'))->withMessage('ไม่พบข้อมูลที่ต้องการ ลองค้นหาใหม่!')->withQuery($q);
    }
    public function list(Request $request, $id)
    {
        $businessData = Businesstype::withCount(['vendors' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('active', 1)
            ->orderBy('vendors_count', 'desc')->get();
        $btype = Businesstype::find($id);
        $q = $request->input('vendor-search');

        $vendors = Vendor::where('businesstype_id', $id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        if (count($vendors) > 0)
            return view('vendors.list', compact('businessData', 'btype', 'vendors'))->withQuery($q);
        else
            return view('vendors.list', compact('businessData', 'btype'))->withMessage('ไม่พบข้อมูลที่ต้องการ ลองค้นหาใหม่!');
    }
    public function show($id)
    {
        $vendor = Vendor::where('id', $id)->firstOrFail();
        $vendor->visits()->seconds(30)->increment(1, false, ['country', 'language']);

        $products = Product::where('vendor_id', $id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $posts = Post::where('vendor_id', $id)
            ->where('published', 1)
            ->orderBy('published_at', 'desc')
            ->paginate(4);
        return view('vendors.show', [
            'vendor' => $vendor,
            'products' => $products,
            'posts' => $posts,
            'open_graph' => [
                'title' => $vendor->name,
                'image' => url(Storage::url($vendor->imagefile)),
                'url' => $this->request->url(),
                'description' => Str::of($vendor->description)->limit(150)
            ]
        ]);
    }
}
