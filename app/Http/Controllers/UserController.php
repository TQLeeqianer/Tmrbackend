<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    /**
     * Display user members of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $title = "User Members";
        $description = "Some description for the page";
        $users = User::all(); // Assuming you have a User model

        return view('pages.applications.user.member', compact('title', 'description', 'users'));
    }


    /**
     * Display user grid of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function grid(){
        $title = "User Grid";
        $description = "Some description for the page";
        return view('pages.applications.user.grid', compact('title', 'description'));
    }

    /**
     * Display user list of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function list(){
        $title = "User List";
        $description = "Some description for the page";
        return view('pages.applications.user.list', compact('title', 'description'));
    }

    /**
     * Display user grid style of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function gridStyle(){
        $title = "User Grid Style List";
        $description = "Some description for the page";
        return view('pages.applications.user.grid_style', compact('title', 'description'));
    }

    /**
     * Display user group of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function userGroup(){
        $title = "User Group List";
        $description = "Some description for the page";
        return view('pages.applications.user.user_group', compact('title', 'description'));
    }

    /**
     * Display user add of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function add(){
        $title = "User Add";
        $description = "Some description for the page";
        return view('pages.applications.user.add', compact('title', 'description'));
    }

    /**
     * Display user table of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function table(){
        $title = "User Data Table";
        $description = "Some description for the page";
        return view('pages.applications.user.data_table', compact('title', 'description'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->user()->profile_image == null) {
            $validate_image = Validator::make($request->all(), [
                'profile_image' => ['required', 'image', 'max:1000']
            ]);

            if ($validate_image->fails()) {
                return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
            }
        }

        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        $profile_image = auth()->user()->profile_image;

        if ($request->hasFile('profile_image')) {
            $imagePath = 'storage/'.$profile_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $profile_image = $request->profile_image->store('profile_images', 'public');
        }

        auth()->user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile_image' => $profile_image,
        ]);

        return response()->json(['code' => 200, 'msg' => 'Profile updated successfully.']);
    }

    public function store(Request $request)
    {

        //check user email
        $emailExists = User::where('email', $request->email)->first();


        if($emailExists) {
            return response()->json(['code' => 400, 'msg' => 'Email already exists.']);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->type = $request->type; // Set the type (Admin or Stall Owner)
            $user->save();
        }



        return 'success';
//        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the incoming request data
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'type' => ['required', 'integer', 'in:0,1'], // Validate type as either 0 or 1
        ]);

        // Check if validation fails
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        // Update the user's details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type; // Update the type (Admin or Stall Owner)

        // Update password only if provided
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Return a success response
        return response()->json(['code' => 200, 'msg' => 'User updated successfully.']);
    }

    /**
     * Remove the specified user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // If the user has a profile image, delete it from storage
        if ($user->profile_image) {
            $imagePath = 'storage/' . $user->profile_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the user
        $user->delete();

        // Return a success response
        return response()->json(['code' => 200, 'msg' => 'User deleted successfully.']);
    }



}
