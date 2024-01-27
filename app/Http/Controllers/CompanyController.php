<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use App\Models\Content;
use App\Models\CompanyContents;
use App\Models\ContentType;
use App\Models\Transaction;
use App\Models\User;
use App\Services\attribute\Attribute;
use App\Services\wpService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;




class CompanyController extends Controller
{

    public $breadcrumb;

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('company');
        }

        return view('auth.company.login');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('company');
        }
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);


        return view('auth.company.register', compact('category'));
    }
    public function showPasswordForgotForm()
    {
        if (Auth::check()) {
            return redirect()->route('company');
        }
        return view('auth.company.forgotMobile');
    }


    public function dashboard()
    {
        $user = Auth::user();

        return view('auth.company.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();


        return view('auth.company.companyProfile', compact('user'));
    }
    public function profileChangeLogo(Request $request)
    {
        $user = Auth::user();

        $imagesUrl = $this->uploadImages($request->image, $user->company->id, 'company');

        $user->company->logo = $imagesUrl['images'];
        $user->company->save();

        return response(array('status' => true, 'url' => $imagesUrl), 200);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $name = $request->all()['data'][0]['name'];
        $value = $request->all()['data'][0]['value'];
        if ($user->company == null) {
            // $user->company = new Company();
            return response(array('status' => false, 'data' => ['name' => $name, 'value' => $value], 'msg' => 'Company not found'), 200);
        }
        // dd($user->company);
        $user->company->$name = $value;
        $user->company->save();

        return response(array('status' => true, 'data' => ['name' => $name, 'value' => $value]), 200);
    }


    public function products()
    {
        $user = Auth::user();

        $attributes = ContentType::all();
        // dd($user->company);

        return view('auth.company.products', compact('user', 'attributes'));
    }

    public function productsCreate(Request $request)
    {
        $user = Auth::user();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);

        // dd($category);


        $attr_type = 'product';
        $attribute = array();
        if (isset($request->attr)) {
            $attribute = Attribute::getFormFieldsByContentTypeId($request->attr);
        }
        return view('auth.company.productsCreateOrUpdate', compact('user', 'category', 'attr_type', 'attribute'));
    }

    public function productsStore(Request $request)
    {
        $user = Auth::user();

        //dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            'title' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ), array('parent_id.required' => 'دسته بندی را انتخاب نمایید'));

        $imagesUrl = '';

        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request->imageJson, $request->title);
        }

        $data = $request->all();
        // $date = $data['publish_date'];
        $date = date("Y-m-d");
        // $data['publish_date'] = convertJToG($date);
        $data['publish_date'] = ($date);
        // dd($data['publish_date']);

        $data['parent_id_hide'] = $request->parent_id;
        $data['parent_id'] = $request->parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        // $data['parent_id'] = $request->parent_id[0];
        $data['type'] = '2';
        $data['attr_type'] = 'product';
        $data['meta_title'] = $data['title'];
        $data['brief_description'] = $data['title'];
        $data['meta_description'] = $data['title'];
        $data['meta_keywords'] = $data['title'];
        // $data['attr'] = ["brand" => $user->company->name, "price" => 0];

        $data['images'] = $imagesUrl;

        $data['slug'] = uniqueSlug(Content::class, ($request->slug != '') ? $request->slug : $request->title);


        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        // $data['status'] = '1';

        $content = Content::create($data);
        if (isset($data['content_type_id'])) {
            $attrObject = Attribute::upsert($data, $content->id, $data['content_type_id']);
        }

        // dd(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));

        $content->categories()->attach($data['parent_id_hide']);


        CompanyContents::create(['company_id' => $user->company->id, 'content_id' => $content->id]);

        // dd($content->companies);




        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }



    public function productsUpdate(Content $content)
    {
        $post = $content;

        //todo check user id and content id correctly

        $user = Auth::user();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        $attribute = Attribute::getFormValue($post->id);


        return view('auth.company.productsCreateOrUpdate', compact('user', 'category', 'post', 'attribute'));
    }

    public function productsEdit(Request $request, Content $content)
    {
        $user = Auth::user();

        //dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ), array('parent_id.required' => 'دسته بندی را انتخاب نمایید'));

        $imagesUrl = '';
        // dd($request->images);
        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request->imageJson, $content->slug);
        }

        $data = $request->all();
        $date = date("Y-m-d");
        // $date = $data['publish_date'];
        // $data['publish_date'] = convertJToG($date);
        $data['publish_date'] = ($date);

        $data['parent_id_hide'] = $request->parent_id;
        $data['brief_description'] = $data['title'];
        $data['parent_id'] = $request->parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        // $data['parent_id'] = $request->parent_id[0];
        // $data['type'] = '2';
        $data['attr_type'] = 'product';
        $data['attr'] = ["brand" => $user->company->name, "price" => 0];

        $data['images'] = $imagesUrl;

        // $data['slug'] = $request->title;

        $data['slug'] = uniqueSlug(Content::class, $content, (isset($data['slug']) && $data['slug'] != '') ? $data['slug'] : $data['title']);

        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        $data['status'] = '1';

        $content->update($data);
        $content_type_id = 0;
        $attrObject = Attribute::upsert($data, $content->id, $content_type_id);
        $content->categories()->detach();
        $content->categories()->attach($data['parent_id_hide']);


        // $content = Content::create($data);
        // dd(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        //CompanyContents::create(['company_id' => $user->company->id, 'content_id' => $content->id]);
        // dd($content->companies);


        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }

    protected function uploadImages($file, $fileName, $type = 'product')
    {
        // $fileJson = $request->imageJson;
        // $file = $request->image;
        // $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        if ($type == 'company')
            $imagePath = "/upload/images/company/";
        else
            $imagePath = "/upload/images/{$year}/";
        // $filenameOrg = $fileOrg->getClientOriginalName();
        // dd($filenameOrg);


        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // $fileName = $user->company->id;
        $fileName = str_replace(' ', '-', $fileName);
        $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
        $fileNameAndType = $fileName . '.' . $fileType;


        // dd(public_path() . $imagePath . $fileNameAndType);
        // $file = $fileOrg->move(public_path($imagePath), $fileName.'-org.'.$fileType); // original
        // dd(public_path($imagePath));
        // $sizes = ["300", "600", "900"];
        file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped

        // dd($file->getRealPath());
        // $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);
        $url['images'] = $this->resize($imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
        // $url['thumb'] = $url['images']['small'];
        // $url = $imagePath . $fileNameAndType;
        // dd($url);
        return $url;
    }

    private function resize($path, $type, $imagePath, $fileNameAndType, $fileName, $fileType)
    {

        $sizes = array(
            "small" => @env(Str::upper($type) . '_SMALL_W'),
            'medium' => @env(Str::upper($type) . '_MEDIUM_W'),
            'large' => @env(Str::upper($type) . '_LARGE_W')
        );

        $images['crop'] = $imagePath . $fileNameAndType;
        foreach ($sizes as $name => $size) {
            $images[$name] = $imagePath  . $fileName . "-{$name}." . $fileType;

            // dd($path);
            $img = Image::make(public_path($path));
            // dd($path);
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($images[$name]), 75);
        }


        return $images;
    }

    public function productPowerUp(Request $request, Content $content)
    {
        $user = Auth::user();

        return view('auth.company.powerUp', compact('user', 'content'));
    }

    public function invoiceList()
    {
        $user = Auth::user();
        $transactions = $user->transactions;

        return view('auth.company.invoiceList', compact('transactions'));
    }

    public function invoice(Transaction $transaction)
    {
        // dd($transaction->transactionable);
        $parentModel = $transaction->transactionable;

        return view('auth.company.invoice', compact('transaction', 'parentModel'));
    }
    public function invoiceStore(Request $request, Content $content)
    {
        // dd($request->all());
        $user = Auth::user();


        $count = $request->count;
        $price = 30000 * $count;

        // dd(Lang::get('messages.power up for',['count'=>$count,'content'=>$content->title]));

        $user->transactions()->where('transactionable_id', '=', $content->id)->where('transactionable_type', '=', Content::class)->delete();

        $transaction = $user->transactions()->firstOrCreate([
            'title' => $content->title,
            'count' => $count,
            'price' => $price,
            'description' =>  Lang::get('messages.power up for', ['count' => $count, 'content' => $content->title]),
            'transactionable_type' => Content::class,
            'transactionable_id' => $content->id,
            'message' => Lang::get('messages.invoice created'),
            'status' => 0
        ]);

        // dd($transaction);

        return redirect()->route('company.invoice', $transaction->id)->with('success', Lang::get('messages.invoice created'));
    }


    public function sendToBand(Request $request, Transaction $transaction)
    {
        $user = Auth::user();



        // dd($user->transaction());


        // dd($transaction);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'bearer ' . env('PAYPING'),
        ])
            ->post('https://api.payping.ir/v2/pay', [
                'amount' => $transaction->price,
                'returnUrl' => url('/') . '/returnBank',
                'payerIdentity' => $user->mobile,
                'payerName' => $user->name,
                'description' => Lang::get('messages.buy') . $request->count . ' power',
                'clientRefId' => json_encode(['transactionId' => $transaction->id]),
            ]);



        if ($response->status() != 200) {
            if ($response->status() == 400) {
                $transaction->update(['status' => -1, 'message' => $response->json()['Error']]);
                return redirect()->back()->with('error', $response->json()['Error']);
            }

            $transaction->update(['status' => -1, 'message' => $response->body()]);
            return redirect()->back()->with('error', $response->body());
        }


        $transaction->update(['status' => 1, 'message' => '']);
        return redirect('https://api.payping.ir/v2/pay/gotoipg/' . $response->json()['code']);
    }

    public function returnBank(Request $request)
    {

        $clientrefid = json_decode($request->clientrefid);
        // dd($clientrefid);
        if (!isset($clientrefid->transactionId))
            return redirect(route('company.products'))->with('error', 'Error:334');

        $transactionId = $clientrefid->transactionId;
        $transaction = Transaction::find($transactionId);
        // dd($transaction);

        $content = $transaction->transactionable_type::find($transaction->transactionable_id);
        $company = $content->companies->first();
        $user = $company->user;
        // dd($company->user->id);
        Auth::loginUsingId($user->id);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'bearer ' . env('PAYPING'),
        ])
            ->post('https://api.payping.ir/v2/pay/verify', [
                'amount' => $transaction->price,
                'refId' => "$request->refid"
            ]);

        // dd($response->status());
        if ($response->status() != 200) {
            if ($response->status() == 400) {
                $transaction->update(['status' => -1, 'message' => array_values($response->json())[0]]);
                return redirect(route('company.products.powerUp', ['content' => $content->id]))->with('error', array_values($response->json())[0]);
            }

            $transaction->update(['status' => -1, 'message' => $response->body()]);
            return redirect(route('company.products.powerUp', ['content' => $content->id]))->with('error', $response->body());
        }


        $transaction->update(['status' => 2, 'message' => __('messages.pay success')]);

        $content->power = $transaction->count;
        $content->save();


        return redirect(route('company.products.powerUp', ['content' => $content->id]))->with('success', __('messages.pay success'));
    }

    function profileShow(Request $request, $id)
    {

        $company = Company::find($id);

        if ($company == null || $company->status == 0) {
            return redirect('/', 301);
        }
        $company->increment('viewCount');

        $company->instagram = $this->clearInstagramUrl($company->instagram);
        // dd($company  );

        // $produsct = Content::where('publish_date', '<=', DB::raw('now()'));
        // $produsct = $produsct->where('company_id', '=', $company->id);
        // $produsct = $produsct->where('type', '=', '2');
        // $produsct = $produsct->where('attr_type', '=', 'product');
        // $produsct = $produsct->orderby('id', 'desc');
        // $produsct = $produsct->get();


        $breadcrumb = $this->get_parent($company->category->parent_id ?? 0);

        if (is_array($breadcrumb)) {
            krsort($breadcrumb);
        } else {
            $breadcrumb = array();
        }
        if ($company->category)
            $breadcrumb[1] = $company->category?->toArray();

        $seo['meta_title'] = $company->name ?? 'Company';
        $seo['meta_description'] = $company->description ?? '';
        // dd($breadcrumb);
        return view('auth.profileShow', compact('company', 'breadcrumb', 'seo'));
    }
    public function clearInstagramUrl(String $var = null)
    {
        // $var = 'https://instagram.com/ads/f#adsf@instagram';
        if (str_contains($var, 'instagram.com')) {
            // ['https://instagram.com','https://www.instagram.com','instagram.com','instagram']
            $arr = explode('/', $var);
            $var = end($arr);
        }

        $var = trim($var);
        $var = str_replace('@', '', $var);

        return $var;
    }

    public function productsDestroy(Content $content)
    {
        $content->delete();

        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }



    public function get_parent($id)
    {
        global $conn;
        $tree_rs = Content::where('id', '=', $id)->first();
        if (!is_object($tree_rs)) {
            return $this->breadcrumb;
        }
        $this->breadcrumb[] = $tree_rs->getAttributes();
        if ($tree_rs->parent_id != 0) {
            $this->get_parent($tree_rs->parent_id);
        }
        return $this->breadcrumb;
    }

    public function transaction()
    {
        $user = Auth::user();

        // dd($user->transactions);
        // dd($user->company->contents()->where('attr_type','=','product')->paginate(10));

        $transactions = $user->transactions()->paginate(10);

        return view('auth.company.transactions', compact('user', 'transactions'));
    }










    public function companyList()
    {
        $companies = Company::orderBy('id', 'desc')->get();

        return view('admin.company.index', compact('companies'));
    }

    public function companyCreateOrUpdate(Request $request, Company $company)
    {
        $categoryImplode = $cropperPreview = '';
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        // dd($company->exists());

        if ($company->exists) {
            $categoryImplode = "'" . implode("','", $company->categories->pluck('id')->toArray()) . "'";
            $cropperPreview = $company->logo['large'] ?? '';
        }


        return view('admin.company.createOrUpdate', compact(
            'company',
            'cropperPreview',
            'category',
            'categoryImplode'
        ));
    }

    public function companyStore(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            // 'manager' => 'required',
            'mobile' => 'required|unique:users,mobile',
            // 'email' => 'required|unique:users,email'
            'parent_id_hide' => 'required'
        ));
        $data = $request->all();
        $data['password'] = Hash::make(123456);


        $user = $this->companyStoreService($data, new Company);

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.Greate! Company created successfully.'));
    }

    public function companyEdit(Request $request, Company $company)
    {
        $this->validate($request, array(
            // 'name' => 'required',
            // 'manager' => 'required',
            'mobile' => 'required',
            'parent_id_hide' => 'required'

        ));

        $data = $request->all();

        $this->companyStoreService($data, $company);

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.Greate! Company edited successfully.'));
    }



    public function companyStoreService($data, $company)
    {

        $parent_id_hide = $data['parent_id_hide'];
        $data['parent_id_hide'] = $data['parent_id'];
        $data['pass'] = 123456;
        $data['password'] = Hash::make(123456);
        $data['parent_id'] = $parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        if ($company->exists) {
            $company->update($data);
            $user = User::where('id', '=', $company->user_id)->first();

            $company->categories()->detach();
        } else {
            $user = User::create($data);
            $data['user_id'] = $user->id;
            $company = Company::create($data);

            $user->company()->save($company);
        }

        if ($user == null) {
            dd('User not exist!!');
        }

        $user->assignRole('company');

        $company->categories()->attach($data['parent_id_hide']);


        if ($data['imageJson']) {
            $imagesUrl = $this->uploadImages($data['imageJson'], $user->company->id, 'company');
            $user->company->logo = $imagesUrl['images'];
            $user->company->save();
        }


        return $user;
    }
    public function companyDestroy(Company $company)
    {

        $company->contents()->delete();

        $company->categories()->detach();

        $company->user()->delete();

        $company->delete();

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.deleted'));
    }







    public function orderList()
    {
        $list = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index', compact('list'));
    }
    public function orderDetail(Order $order)
    {
        $list = $order->orderDetail;
        $transactions = $order->transactions;
        return view('admin.order.detail', compact('list', 'order', 'transactions'));
    }
    public function orderEdit(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        $orderDetail = $order->orderDetail;
        foreach ($orderDetail as $detail) {
            $product = (new Content)->find((int) $detail->attributes['product_id']);
            if ($product instanceof Content && $request->status == 1) {
                $attr = $product->attr;
                $attr['in-stock'] = '0';
                $product->update(['attr' => $attr]);
            }
        }
        return redirect()->back()->with('success', Lang::get('messages.updated'));
    }
    public function orderDestroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', Lang::get('messages.deleted'));
    }







    public function wpGetproduct()
    {
        $wp = new wpService();
        $wp->getproduct();
        // $company->delete();
        // $companu->dettach();
        // $compnay->contents;
        // unllink
        dd(1);
        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.deleted'));
    }
}
