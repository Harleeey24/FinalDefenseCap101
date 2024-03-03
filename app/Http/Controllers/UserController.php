<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\TbUserAcc;
use App\Models\userOrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    public function landingpage()
    {
        return view('landingpage');
    }

    public function login()
    {
        return view('login');
    }
    

    public function signup()
    {
        $data['title'] = 'signup';
        return view('signup', $data);
    }

    public function signin()
{
    return view('signin');
}

    public function password()
    {
        return view('password');
    }

    //EMPLOYEE
    public function employee_dashboard()
    {
        return view('employee_dashboard');
    }

    public function viewuser(Request $request)
{
    $query = $request->input('search');
    $TbUserAcc = $query ? TbUserAcc::search($query) : TbUserAcc::all();
    return view('viewuser', compact('TbUserAcc'));
}



    //Links
    public function order(){
        return view('order');
    }


    //VIEWORDER&TRACKORDER
    public function vieworder()
{
    // Fetch all data from the userformdetails table
    $userOrderDetails = userOrderDetails::all();

    // Pass the data to the view
    return view('vieworder', ['userOrderDetails' => $userOrderDetails]);
}

public function searchOrders(Request $request)
{
    $query = $request->input('search');
    $userOrderDetails = $query ? userOrderDetails::searchOrders($query) : userOrderDetails::all();
    return view('vieworder', compact('userOrderDetails'));
}

    public function profile()
{
    // Fetch the authenticated user's data
    $user = Auth::user();
    
    // Pass the user data to the view
    return view('profile', ['TbUserAcc' => $user]);
}

public function signup_action(Request $request)
{
    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'contact' => 'required',
        'email' => 'required',
        'username' => 'required|unique:fms_g18_tbuseracc',
        'password' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/images');
    }

    $TbUserAcc = new TbUserAcc([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'contact' => $request->contact,
        'image' => $imagePath ? basename($imagePath) : null,
        'email' => $request->email, 
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);
    $TbUserAcc->save();

    return redirect()->route('signin')->with('success', 'Registration Success. Please Login');
}

public function signin_action(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    // Check if the user exists in the database
    $user = TbUserAcc::where('username', $credentials['username'])->first();

    if (!$user) {
        // User doesn't exist
        return redirect()->route('signin')->withErrors(['username' => 'User not found']);
    }

    // Verify the password
    if (Hash::check($credentials['password'], $user->password)) {
        // Password is correct, authenticate the user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect user based on their role
        switch ($user->role) {
            case 'admin':
                return redirect()->intended('admin_dashboard');
                break;
            case 'employee':
                return redirect()->intended('employee_dashboard');
                break;
            default:
                return redirect()->intended('userdashboard');
                break;
        }
    } else {
        // Authentication failed, redirect back with error
        return redirect()->route('signin')->withErrors(['username' => 'Wrong username or password']);
    }
}

    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('login');
    }

    //change password
    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $TbUserAcc = TbUserAcc::find(Auth:: id());
        $TbUserAcc->password = Hash::make($request->new_password);
        $TbUserAcc->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Change');
    }

    //DELETE USER 
    public function users_delete(int $id)
{
    $TbUserAcc = TbUserAcc::find($id);
    $TbUserAcc->delete();

    return redirect()->route('viewuser')->with('success', 'User deleted successfully');
}

    //SEARCH USER
    public function search(Request $request)
    {
        $query = $request->input('search');
        $TbUserAcc = $query ? TbUserAcc::search($query) : TbUserAcc::all();
        return view('viewuser', compact('TbUserAcc'));
    }

    //USER DELETE/CANCEL
    public function placeOrder(Request $request)
{
    // Retrieve all the form data from the request
    $formData = $request->all();

    // Retrieve the authenticated user
    $user = Auth::user();

    // Generate a unique numeric ID for the order
    $orderId = (string) Str::uuid();

    // Convert delivery date to MySQL compatible format
    $deliveryDate = Carbon::parse($formData['deliveryDate'])->format('Y-m-d');

    // Create a new order detail record
    $userOrderDetails = new userOrderDetails();
    $userOrderDetails->order_id = $orderId; // Assign the generated ID to order_id
    $userOrderDetails->user_id = $user->id;
    $userOrderDetails->firstname = $user->firstname; // Add user's first name
    $userOrderDetails->lastname = $user->lastname; // Add user's last name
    $userOrderDetails->email = $user->email; // Add user's email
    $userOrderDetails->contact = $user->contact; // Add user's contact number
    $userOrderDetails->item = $formData['item'];
    $userOrderDetails->dimensions = $formData['Dimensions'];
    $userOrderDetails->consigneeName = $formData['consigneeName'];
    $userOrderDetails->receiverContact = $formData['receiverContact'];
    $userOrderDetails->receiveraddress = $formData['receiveraddress'];
    $userOrderDetails->LocationFrom = $formData['LocationFrom'];
    $userOrderDetails->LocationTo = $formData['LocationTo']; // Corrected field name
    $userOrderDetails->DropOffWarehouse = $formData['DropOffWarehouse']; // Corrected field name with underscore
    $userOrderDetails->modeSelection = $formData['modeSelection'];
    $userOrderDetails->deliveryDate = $deliveryDate; // Use the converted date format
    $userOrderDetails->price = $formData['price'];
    $userOrderDetails->fee = $formData['fee'];
    $userOrderDetails->totalAmount = $formData['totalAmount'];

    // Save the order detail
    $userOrderDetails->save();

    // Redirect the user or return a response
    return redirect()->back()->with('success', 'Order placed successfully!');
}

    //ADMIN RECENT ORDER
    public function getOrderCount()
{
    $orderCount = userOrderDetails::count();
    
    // Pass $orderCount to the view
    return view('admin_dashboard', ['orderCount' => $orderCount]);
}

//Employee Recent Order
public function empOrderCount()
{
    $orderCount = userOrderDetails::count();
    
    // Pass $orderCount to the view
    return view('employee_dashboard', ['orderCount' => $orderCount]);
}

//USER RECENTORDERS
public function userDashboard()
{
    // Retrieve the count of orders for the authenticated user
    $orderUserCount = userOrderDetails::where('user_id', Auth::id())->count();
    
    // Pass the count to the view
    return view('userdashboard', ['orderUserCount' => $orderUserCount]);
}

    //ORDER DELETE
    public function destroy($order_id)
    {
    $userOrderDetails = userOrderDetails::findOrFail($order_id);
    $userOrderDetails->delete();

    return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function store(){
        return view('order');
    }

    //viewspecificorder
    public function userorderonly() {
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Fetch user orders for the authenticated user
        $userOrderDetails = userOrderDetails::where('user_id', $userId)->get();
    
        // Pass $userOrderDetails to the view
        return view('userorderonly', compact('userOrderDetails'));
    }

    //ADMINSIDE
    public function admin_dashboard(){
        return view('admin_dashboard');
    }

    public function adminprofile(){
        return view('adminprofile');
    }

    //ADMIN ORDERS ONLY
    public function adminorder_only() {
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Fetch user orders for the authenticated user
        $userOrderDetails = userOrderDetails::where('user_id', $userId)->get();
    
        // Pass $userOrderDetails to the view
        return view('adminorder_only', compact('userOrderDetails'));
    }



    //ADMINVIEWUSER
    public function admin_viewuser(){
        return view('vieworder');
    }

    public function admin_vieworder()
{
    // Retrieve all user order details from the database
    $userOrderDetails = userOrderDetails::all();

    // Pass the user order details to the view
    return view('admin_vieworder', ['userOrderDetails' => $userOrderDetails]);
}

//UPDATE ORDER FORM DETAILS via ADMIN
public function updateUserOrder(Request $request, $id) {
    // Retrieve the user ID from the request
    $userId = $id;

    // Retrieve the user order details from the request
    $userOrderDetails = $request->only(['firstname', 'lastname', 'email', 'contact', 'item', 'dimensions', 'LocationTo', 'DropOffWarehouse', 'deliveryDate', 'price', 'fee', 'totalAmount', 'modeSelection']);

    // Update the user order details in the database
    User::where('id', $userId)->update($userOrderDetails);

    // Redirect or return response as needed
}

//ADMIN CREATE ORDER
public function admin_create(){
    return view('admin_create');
}

//EMPLOYEE

public function employee_order(){
    return view('employee_order');
}

public function employeevieworder()
{
    // Assuming $userOrderDetails is retrieved from your database
    $userOrderDetails = userOrderDetails::all(); // Or whatever logic to fetch the data

    return view('employeevieworder', compact('userOrderDetails'));
}

public function employee_profile(){
    return view('employee_profile');
}

//viewspecific order
public function employeeorder_only() {
    // Get the authenticated user's ID
    $userId = auth()->id();

    // Fetch user orders for the authenticated user
    $userOrderDetails = userOrderDetails::where('user_id', $userId)->get();

    // Pass $userOrderDetails to the view
    return view('employeeorder_only', compact('userOrderDetails'));
}





}

