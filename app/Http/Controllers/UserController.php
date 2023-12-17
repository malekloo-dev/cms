<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //Auth::loginUsingId(1);

        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* if ($request->ajax()) {
            $data = User::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }*/
        $users = User::orderBy('id', 'desc')->get();


        return view('admin.users.index', compact('users'));
    }

    public function index1(Request $request)
    {

        return json_encode(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'password' => 'required|min:3|confirmed'
        ]);

        $obj = User::where('mobile', '=', $request->mobile)->get();

        if (count($obj)) return redirect()->back()->with('error', Lang::get('messages.mobile exist'));
        $requestArray = $request->all();
        $requestArray['password'] = Hash::make($requestArray['password']);
        $user = User::create($requestArray);

        $customer = Customer::create(['user_id' => $user->id, 'name' => $request->name, 'mobile' => $request->mobile, 'status' => 1]);
        $user->assignRole('customer');
        

        return redirect()->back()->with('success', Lang::get('messages.added'));
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

        $users = User::find($id);

        return view('admin.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'sometimes|required|min:3|confirmed'
        ]);
        // $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if (strlen($user->password) > 0) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return redirect()->back()->with('success', Lang::get('messages.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->back()->with('success', 'users deleted!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function filter(Request $request)
    {
        $properties = array('id', 'name', 'email');
        $data = User::query()->filter($request->all(), $properties);

        return response()->json($data);
    }
}
