<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use App\Models\Content;
use App\Models\CustomerContents;
use App\Models\ContentType;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Services\attribute\Attribute;
use App\Services\wpService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;




class CustomerController extends Controller
{

    public $breadcrumb;


    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('customer');
        }
        return view('auth.customer.login');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('customer');
        }
        return view('auth.customer.register');
    }
    public function showPasswordForgotForm()
    {
        if (Auth::check()) {
            return redirect()->route('customer');
        }
        return view('auth.customer.forgot');
    }


    public function cartList()
    {

        $userID = Auth()->user()->id;
        $cart = \Cart::session($userID)->getContent()->toArray();

        return view('auth.customer.cartList', compact('cart'));
    }
    public function cartStore(Request $request)
    {
        if (!isset($request->id) || !is_numeric($request->id)) {
            redirect()->back();
        }

        $Product = (new Content)->where('id', '=',  $request->id)->where('type', '=', 2)->first();

        $userID = Auth()->user()->id; // the user ID to bind the cart contents

        \Cart::session($userID)->add(array(
            'id' => $Product->id,
            'name' => $Product->title,
            'price' => $Product->GoldPrice()['totalPrice'],
            'quantity' => $request?->count ?? 1,
            'attributes' => array(
                'userId' => $userID,
                'product_id' => $Product->id,
                'slug' => $Product->slug,
                'image' => $Product->images['images']['small'],
            ),
            'associatedModel' => $Product
        ));


        return redirect()->route('customer.cart.list')->with('message', 'به سبد اضافه شد');
    }
    public function cartDestroy(Content $product)
    {
        $userID = Auth()->user()->id;
        $res = \Cart::session($userID)->remove($product->id);
        return redirect()->route('customer.cart.list')->with('message', 'آپدیت شد');
    }
    public function cartUpdate(Request $request, Content $product)
    {
        $userID = Auth()->user()->id;

        $cart = \Cart::session($userID)->getContent()->toArray()[$product->id] ?? False;
        if (!$cart)
            return redirect()->route('customer.cart.list')->with('message', 'پیدا نشد');


        \Cart::session($userID)->update($product->id, ['quantity' => (int) $request->count]);
        if ($cart['quantity'] == 1 && (int) $request->count < 0)
            \Cart::session($userID)->remove($product->id);

        return redirect()->route('customer.cart.list')->with('message', 'آپدیت شد');
    }





    public function orderStore()
    {
        // dd(env('SMS_SENDER'));

        $user = Auth()->user();
        $cart = \Cart::session($user->id)->getContent()->toArray();
        $totalPrice = \Cart::session($user->id)->getTotal();

        try {
            $order = $user->orders()->create([
                'total_price' => $totalPrice,
                'status' => 0
            ]);
            $order->orderDetail()->delete();
            $pN = '';
            foreach ($cart as $v) {

                $order->orderDetail()->firstOrCreate([
                    'title' => $v['name'],
                    'price' => $v['price'],
                    'count' => $v['quantity'],
                    'attributes' => $v['attributes']
                ]);
                \Cart::session($user->id)->remove($v['id']);

                $pN .= $v['name'];
            }
        } catch (Exception $e) {
            dd($e);
        }

        $message = "{$user->mobile}\nنام : {$pN}\nمبلغ : {$order->total_price}";

        if(url('/') == 'https://edengoldgallery.ir'){
            $sms = @sendSms(array('09331181877'), $message);
        }


        return redirect()->route('customer.order.list');
    }
    public function orderList()
    {
        $user = Auth()->user();
        $orders = $user->orders()->orderBy('id', 'desc')->get();

        return view('auth.customer.orderList', compact('orders'));
    }
    public function orderDetail(Order $order)
    {
        $user = Auth()->user();
        $orderDetail = $user->orders($order->id)->orderDetail;
        return view('auth.customer.orderDetailList', compact('order', 'orderDetail'));
    }
    public function orderDestroy(Order $order)
    {
        $user = Auth()->user();
        $user->orders($order->id)->delete();

        return redirect()->route('customer.order.list')->with('message', __('messages.deleted'));
    }


    public function dashboard()
    {
        $user = Auth::user();

        return view('auth.customer.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();


        return view('auth.customer.profile', compact('user'));
    }
    public function profileChangeLogo(Request $request)
    {
        $user = Auth::user();

        $imagesUrl = $this->uploadImages($request->image, $user->customer->id, 'customer');

        $user->customer->logo = $imagesUrl['images'];
        $user->customer->save();

        return response(array('status' => true, 'url' => $imagesUrl), 200);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $name = $request->all()['data'][0]['name'];
        $value = $request->all()['data'][0]['value'];
        if ($user->customer == null) {
            // $user->customer = new Customer();
            return response(array('status' => false, 'data' => ['name' => $name, 'value' => $value], 'msg' => 'Customer not found'), 200);
        }
        // dd($user->customer);
        $user->customer->$name = $value;
        $user->customer->save();

        return response(array('status' => true, 'data' => ['name' => $name, 'value' => $value]), 200);
    }


    public function products()
    {
        $user = Auth::user();

        $attributes = ContentType::all();
        // dd($user->customer);

        return view('auth.customer.products', compact('user', 'attributes'));
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
        return view('auth.customer.productsCreateOrUpdate', compact('user', 'category', 'attr_type', 'attribute'));
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
        // $data['attr'] = ["brand" => $user->customer->name, "price" => 0];

        $data['images'] = $imagesUrl;

        $data['slug'] = uniqueSlug(Content::class, ($request->slug != '') ? $request->slug : $request->title);


        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        // $data['status'] = '1';

        $content = Content::create($data);
        if (isset($data['content_type_id'])) {
            $attrObject = Attribute::upsert($data, $content->id, $data['content_type_id']);
        }

        // dd(new CustomerContent(['customer_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CustomerContent(['customer_id' => $user->id, 'content_id' => $content->id]));

        $content->categories()->attach($data['parent_id_hide']);


        CustomerContents::create(['customer_id' => $user->customer->id, 'content_id' => $content->id]);

        // dd($content->companies);




        return redirect()->route('customer.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }



    public function productsUpdate(Content $content)
    {
        $post = $content;

        //todo check user id and content id correctly

        $user = Auth::user();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        $attribute = Attribute::getFormValue($post->id);


        return view('auth.customer.productsCreateOrUpdate', compact('user', 'category', 'post', 'attribute'));
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
        $data['attr'] = ["brand" => $user->customer->name, "price" => 0];

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
        // dd(new CustomerContent(['customer_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CustomerContent(['customer_id' => $user->id, 'content_id' => $content->id]));
        //CustomerContents::create(['customer_id' => $user->customer->id, 'content_id' => $content->id]);
        // dd($content->companies);


        return redirect()->route('customer.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }

    protected function uploadImages($file, $fileName, $type = 'product')
    {
        // $fileJson = $request->imageJson;
        // $file = $request->image;
        // $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        if ($type == 'customer')
            $imagePath = "/upload/images/customer/";
        else
            $imagePath = "/upload/images/{$year}/";
        // $filenameOrg = $fileOrg->getClientOriginalName();
        // dd($filenameOrg);


        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // $fileName = $user->customer->id;
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

        return view('auth.customer.powerUp', compact('user', 'content'));
    }

    public function invoiceList()
    {
        $user = Auth::user();
        $transactions = $user->transactions;

        return view('auth.customer.invoiceList', compact('transactions'));
    }

    public function invoice(Transaction $transaction)
    {
        // dd($transaction->transactionable);
        $parentModel = $transaction->transactionable;

        return view('auth.customer.invoice', compact('transaction', 'parentModel'));
    }
    public function invoiceStore(Request $request, Content $content)
    {
        // dd($request->all());
        $user = Auth()->user();

        $totalPrice = \Cart::session($user->id)->getTotal();

        $count = $request->count;



        $user->transactions()->where('transactionable_id', '=', $content->id)->where('transactionable_type', '=', Content::class)->delete();

        $transaction = $user->transactions()->firstOrCreate([
            'title' => $content->title,
            'count' => $count,
            'price' => $totalPrice,
            'description' =>  '',
            'transactionable_type' => Content::class,
            'transactionable_id' => $content->id,
            'message' => Lang::get('messages.invoice created'),
            'status' => 0
        ]);

        // dd($transaction);

        return redirect()->route('customer.invoice', $transaction->id)->with('success', Lang::get('messages.invoice created'));
    }

    public function uploadBill(Request $request, Order $order)
    {
        $user = Auth()->user();

        // check order and user
        if (!$user->orders()->where('id', '=', $order->id)->select('id')->exists()) {
            return redirect()->back()->with('error', 'Ooops!');
        }


        // get bill
        $bill = $request->file('bill');


        // check file
        if (!$bill) return redirect()->back()->with('error', 'لطفا فایل را آپلود نمایید');


        // upload file on server
        $imagePath = '/upload/images/customer/bill/';
        $fileName = $user->id . '(' . $user->mobile . ')-' . $order->id . '-' . Carbon::now() . '.' . $bill->extension();
        $bill->move(public_path($imagePath), $fileName);


        // transaction
        $user->transactions()->firstOrCreate([
            'title' => 'آپلود فیش',
            'price' => $order->total_price,
            'count' => 1,
            'discount_code' => '',
            'status' => 3,
            'message' => "آپلود فیش {$order->price} " . convertGToJ(Carbon::now()),
            'description' => "{$imagePath}{$fileName}",
            'transactionable_type' => Order::class,
            'transactionable_id' => $order->id,
        ]);


        // update order status
        $order->status = 2;
        $order->save();


        return redirect()->route('customer.transaction')->with('success', 'فیش آپلود شد. منتظر تماس از بخش ارسال بمانید.');
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
            return redirect(route('customer.products'))->with('error', 'Error:334');

        $transactionId = $clientrefid->transactionId;
        $transaction = Transaction::find($transactionId);
        // dd($transaction);

        $content = $transaction->transactionable_type::find($transaction->transactionable_id);
        $customer = $content->companies->first();
        $user = $customer->user;
        // dd($customer->user->id);
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
                return redirect(route('customer.products.powerUp', ['content' => $content->id]))->with('error', array_values($response->json())[0]);
            }

            $transaction->update(['status' => -1, 'message' => $response->body()]);
            return redirect(route('customer.products.powerUp', ['content' => $content->id]))->with('error', $response->body());
        }


        $transaction->update(['status' => 2, 'message' => __('messages.pay success')]);

        $content->power = $transaction->count;
        $content->save();


        return redirect(route('customer.products.powerUp', ['content' => $content->id]))->with('success', __('messages.pay success'));
    }

    function profileShow(Request $request, $id)
    {

        $customer = Customer::find($id);

        if ($customer == null || $customer->status == 0) {
            return redirect('/', 301);
        }
        $customer->increment('viewCount');

        $customer->instagram = $this->clearInstagramUrl($customer->instagram);
        // dd($customer  );

        // $produsct = Content::where('publish_date', '<=', DB::raw('now()'));
        // $produsct = $produsct->where('customer_id', '=', $customer->id);
        // $produsct = $produsct->where('type', '=', '2');
        // $produsct = $produsct->where('attr_type', '=', 'product');
        // $produsct = $produsct->orderby('id', 'desc');
        // $produsct = $produsct->get();


        $breadcrumb = $this->get_parent($customer->category->parent_id ?? 0);

        if (is_array($breadcrumb)) {
            krsort($breadcrumb);
        } else {
            $breadcrumb = array();
        }
        if ($customer->category)
            $breadcrumb[1] = $customer->category?->toArray();

        $seo['meta_title'] = $customer->name ?? 'Customer';
        $seo['meta_description'] = $customer->description ?? '';
        // dd($breadcrumb);
        return view('auth.profileShow', compact('customer', 'breadcrumb', 'seo'));
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

        return redirect()->route('customer.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
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
        // dd($user->customer->contents()->where('attr_type','=','product')->paginate(10));

        $transactions = $user->transactions()->orderBy('id','desc')->paginate(10);

        return view('auth.customer.transactions', compact('user', 'transactions'));
    }










    public function customerList()
    {
        $companies = Customer::orderBy('id', 'desc')->get();

        return view('admin.customer.index', compact('companies'));
    }

    public function customerCreateOrUpdate(Request $request, Customer $customer)
    {
        $categoryImplode = $cropperPreview = '';
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        // dd($customer->exists());

        if ($customer->exists) {
            $categoryImplode = "'" . implode("','", $customer->categories->pluck('id')->toArray()) . "'";
            $cropperPreview = $customer->logo['large'] ?? '';
        }


        return view('admin.customer.createOrUpdate', compact(
            'customer',
            'cropperPreview',
            'category',
            'categoryImplode'
        ));
    }

    public function customerStore(Request $request)
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


        $user = $this->customerStoreService($data, new Customer);

        return redirect()->route('admin.customer.index')->with('success', Lang::get('messages.Greate! Customer created successfully.'));
    }

    public function customerEdit(Request $request, Customer $customer)
    {
        $this->validate($request, array(
            // 'name' => 'required',
            // 'manager' => 'required',
            'mobile' => 'required',
            'parent_id_hide' => 'required'

        ));

        $data = $request->all();

        $this->customerStoreService($data, $customer);

        return redirect()->route('admin.customer.index')->with('success', Lang::get('messages.Greate! Customer edited successfully.'));
    }



    public function customerStoreService($data, $customer)
    {

        $parent_id_hide = $data['parent_id_hide'];
        $data['parent_id_hide'] = $data['parent_id'];
        $data['pass'] = 123456;
        $data['password'] = Hash::make(123456);
        $data['parent_id'] = $parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        if ($customer->exists) {
            $customer->update($data);
            $user = User::where('id', '=', $customer->user_id)->first();

            $customer->categories()->detach();
        } else {
            $user = User::create($data);
            $data['user_id'] = $user->id;
            $customer = Customer::create($data);

            $user->customer()->save($customer);
        }

        if ($user == null) {
            dd('User not exist!!');
        }

        $user->assignRole('customer');

        $customer->categories()->attach($data['parent_id_hide']);


        if ($data['imageJson']) {
            $imagesUrl = $this->uploadImages($data['imageJson'], $user->customer->id, 'customer');
            $user->customer->logo = $imagesUrl['images'];
            $user->customer->save();
        }


        return $user;
    }
    public function customerDestroy(Customer $customer)
    {

        $customer->contents()->delete();

        $customer->categories()->detach();

        $customer->user()->delete();

        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success', Lang::get('messages.deleted'));
    }
    public function wpGetproduct()
    {
        $wp = new wpService();
        $wp->getproduct();
        // $customer->delete();
        // $companu->dettach();
        // $compnay->contents;
        // unllink
        dd(1);
        return redirect()->route('admin.customer.index')->with('success', Lang::get('messages.deleted'));
    }
}
