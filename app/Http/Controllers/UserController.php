<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::paginate(8);
        return view('users.index',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'fname' => 'required|string|min:2',
            'lname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email|min:3',
            'password' => 'required|string|min:8',
            'type' => 'required|in:student,teacher,admin,secretary',
            'nationalid' => 'required|string',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->first_name = $request->input(key: 'fname');
            $user->last_name = $request->input(key: 'lname');
            $user->password = Hash::make($request->input(key: 'password'));
            $user->	email = $request->input(key: 'email');
            $user->type = $request->input(key: 'type');
            $user->national_id  = $request->input(key: 'nationalid');
            $isSaved = $user->save();
            if ($isSaved){
                History::create([
                    'description' => "New user registered:  $user->first_name $user->last_name  
                    - email: $user->email  - Account type: $user->type",
                    'user_id' => Auth::user()->id,
                    'type' => "create"
                ]);
            }
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('users.edit',
        [
            'user' => $user,
            ]
    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'fname' => 'required|string|min:2',
            'lname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' .$user->id,
            'type' => 'required|in:student,teacher,admin,secretary',
            'nationalid' => 'required|string',
            'ph_num' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:3',
            'address' => 'nullable|string'

            // name that the same name in axios not necessary like id 
        ]);
        if($request->password !== '123456'){
            $rules['password'] = 'required|string|min:8';
            $user->password = Hash::make($request->input(key: 'password'));
        }
        if (!$validator->fails()) {
            
            $user->first_name = $request->input(key: 'fname');
            $user->last_name = $request->input(key: 'lname');
            $user->email = $request->input(key: 'email');
            $user->national_id  = $request->input(key: 'nationalid');
            $user->phone_number  = $request->input(key: 'ph_num');
            $user->status  = $request->input(key: 'status');
            $user->type = $request->input(key: 'type');
            $user->age = $request->input(key: 'age');
            $user->address = $request->input(key: 'address');
            
            $isSaved = $user->save();
            if ($isSaved) {
                History::create([
                    'description' => "Update user :  $user->first_name $user->last_name  
                    - email: $user->email  - Account type: $user->type",
                    'user_id' => Auth::user()->id,
                    'type' => "Update"
                ]);
            }
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function editProfile(User $user)
    {
        if (Auth::id() !== $user->id) {
            abort(403);
        }
        return view('profile.edit', [
            'user' => $user,
        ]);
    }
    public function updateProfile(Request $request, User $user)
    {
        //
        if (Auth::id() !== $user->id) {
            abort(403);
        }
        $validator = Validator($request->all(), [
            'fname' => 'required|string|min:2',
            'lname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nationalid' => 'required|string',
            'ph_num' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:3',
            'address' => 'nullable|string'

            // name that the same name in axios not necessary like id 
        ]);
        if ($request->hasFile('attachment')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            // حفظ الصورة الجديدة
            $imagePath = $request->file('attachment')->store('users/images', 'public');
            $validated['image_path'] = $imagePath;
            $user->image = $imagePath;
        }
        if ($request->password !== '123456') {
            $rules['password'] = 'required|string|min:8';
            $user->password = Hash::make($request->input(key: 'password'));
        }
        if (!$validator->fails()) {

            $user->first_name = $request->input(key: 'fname');
            $user->last_name = $request->input(key: 'lname');
            $user->email = $request->input(key: 'email');
            $user->national_id  = $request->input(key: 'nationalid');
            $user->phone_number  = $request->input(key: 'ph_num');
            $user->age = $request->input(key: 'age');
            $user->address = $request->input(key: 'address');

            $isSaved = $user->save();
           
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //  
        // save data in variable before deleted
        $userName = $user->first_name . ' ' . $user->last_name;
        $userEmail = $user->email;
        $userType = $user->type;
        $deleted = $user->delete();
        if ($deleted) {
            History::create([
                'description' => "Delete user: $userName - email: $userEmail - Account type: $userType",
                'user_id' => Auth::user()->id,
                'type' => "Delete"
            ]);
        }
        return response()->json(
            ["message" => $deleted ? 'Deleted Successfully'  : 'Deleted Failed',
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            ]
        );

    }
}
