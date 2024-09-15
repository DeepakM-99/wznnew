<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Models\Users;
use App\Models\Contact;
use App\Models\Category;
use App\Models\FoodMenu;
use App\Models\Cart;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        return view('web.index');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email_id');

            $existingUser = Users::where('email_id', $email)->first();
            if ($existingUser) {
                return redirect()->route('register')->with('error', 'Email already exists! Please use a different email.');
            }
	        $save = Users::create(['first_name' => $request->input('first_name'), 'last_name' => $request->input('last_name'), 'email_id' => $request->input('email_id'), 'password' => $request->input('password'), 'mobile' => $request->input('mobile'), 'is_active' => 1]);
	        if (!$save) {
	            return redirect()->route('register')->with('error', 'Unable to save!');
	        }
	        return redirect()->route('login')->with('success', 'Registration Done Successfully! Please Login.');
	    }
        return view('web.register_form');
    }
    public function login(Request $request)
    {
        if(isset($_POST['submit']))
    	{
    		 $validatedData = $request->validate([
			    'email_id' => 'required|email',
			    'password' => 'required|string',
			]);

    		$userData=Users::where(['email_id'=>$request->email_id,'password'=>$request->password,'is_delete'=>0])->first();

	        if ($userData) {
                session(['userData' => $userData]);
                return redirect('/')->with('success', 'Login Successfully.');
            } else {
                return redirect('login')->with('error', 'Invalid Credentials');
            }
    	}
        return view('web.login_form');
    }
    public function logout(Request $request)
    {
        $request->session()->flush(); // Clear all session data
        $request->session()->regenerateToken(); // Regenerate the CSRF token
        return redirect('/');
    }
    public function contactUs(Request $request)
    {
        if ($request->isMethod('post')) {

	        $save = Contact::create(['first_name' => $request->input('first_name'), 'last_name' => $request->input('last_name'), 'email_id' => $request->input('email_id'), 'mobile' => $request->input('mobile'), 'message' => $request->input('message')]);
	        if (!$save) {
	            return redirect()->route('contactus')->with('error', 'Unable to save!');
	        }
	        return redirect()->route('contactus')->with('success', 'Message Sent Successfully!!!');
	    }
        return view('web.contact_us');
    }
    public function ourMenu()
    {
        $categories = Category::all();
        $food_menus = FoodMenu::where('is_delete', 0)->where('is_active', 1)->get();

        // dd($categories, $food_menus);
        return view('web.our_menu', compact('categories', 'food_menus'));
    }
    public function howItWorks()
    {
        return view('web.how_it_works');
    }
    public function Faq()
    {
        return view('web.faq');
    }
    public function blogs()
    {
        return view('web.blogs');
    }
    public function privacyPolicy()
    {
        return view('web.privacy_policy');
    }
    public function termsConditions()
    {
        return view('web.terms_condition');
    }
    public function refundPolicy()
    {
        return view('web.refund_policy');
    }
    public function mealPlans1()
    {
        // $data = FoodMenu::where('is_delete', 0)->where('is_active', 1)->get();
        return view('web.meal_plan_one');
    }
    // public function mealPlans2(Request $request)
    // {
    //     $gender = $request->input('gender');
    //     $Day1 = 'Sunday1';
    //     $meals1 = FoodMenu::whereRaw("FIND_IN_SET(?, day)", [$Day1])
    //               ->whereRaw("FIND_IN_SET(?, gender)", [$gender])
    //               ->take(2) // Limit the results to 2
    //               ->get();

    //     $cal1 = $meals1->sum('calories');
    //     $pro1 = $meals1->sum('tdMProt');
    //     $carb1 = $meals1->sum('tdMCarb');
    //     $fat1 = $meals1->sum('tdMFat');

    //     // return view('web.meal_plan_two', compact('meals'));
    //     return view('web.meal_plan_two', [
    //         'meals1' => $meals1,
    //         'cal1' => $cal1,
    //         'pro1' => $pro1,
    //         'carb1' => $carb1,
    //         'fat1' => $fat1,
    //     ]);
    // }
    public function mealPlans2(Request $request)
    {        
        $gender = $request->input('gender');
        
        // Define the days of the week
        $daysOfWeek = [
            'Sunday' => 'Sunday1',
            'Monday' => 'Monday1',
            'Tuesday' => 'Tuesday1',
            'Wednesday' => 'Wednesday1',
            'Thursday' => 'Thursday1',
            'Friday' => 'Friday1',
            'Saturday' => 'Saturday1',
        ];

        $results = [];        

        foreach ($daysOfWeek as $fullDay => $dayPattern) {
            $meals = FoodMenu::where(function ($query) use ($dayPattern) {
                $query->whereRaw("FIND_IN_SET(?, day) > 0", [$dayPattern]);
            })
            ->whereRaw("FIND_IN_SET(?, gender)", [$gender])
            ->take(2) // Limit the results to 2
            ->get();

            $calories = $meals->sum('calories');
            $protein = $meals->sum('tdMProt');
            $carbs = $meals->sum('tdMCarb');
            $fat = $meals->sum('tdMFat');

            $results[$fullDay] = [
                'meals' => $meals,
                'calories' => $calories,
                'protein' => $protein,
                'carbs' => $carbs,
                'fat' => $fat,
            ];
        }        

        return view('web.meal_plan_two', [
            'results' => $results,
        ]);
    }

    public function getMealOptions(Request $request)
    {
         \Log::info($request->header('X-CSRF-TOKEN'));
         \Log::info(csrf_token());
        $mealType = $request->get('meal_type');
        $day = $request->get('day');
        $categoryId = $request->get('category_id');
        $gender = $request->get('gender');
    
        // Debugging output
        \Log::info('Meal Type: ' . $mealType);
        \Log::info('Day: ' . $day);
        \Log::info('Category ID: ' . $categoryId);
        \Log::info('Gender: ' . $gender);
    
        $options = FoodMenu::where('day', $day)
                           ->where('category_id', $categoryId)
                           ->where('gender', $gender)
                           ->get();
    
        // Debugging output
        \Log::info('Options: ', $options->toArray());
    
        return response()->json($options);
    }
    

    public function addToCart(Request $request)
    {
        $data = session()->get('userData');
        $user_id = $data->user_id;

        $menu_id = $request->input('menu_id');

        Cart::insert([
            'user_id' => $user_id,
            'menu_id' => $menu_id,
            'quantity' => 1,
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Meal added to cart!');
    }
}
