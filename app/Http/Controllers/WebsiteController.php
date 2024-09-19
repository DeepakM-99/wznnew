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
use App\Models\MealPlan;
use App\Models\Order;
use App\Models\PickupDelivery;
use App\Models\Allergy;
use App\Models\Inventory;
use DB;
use Illuminate\Support\Facades\Log;
use \PDF;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        $mealPlans = MealPlan::where('is_active', 1)->get();
        return view('web.index', compact('mealPlans'));
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($_POST);
            $email = $request->input('email_id');

            $existingUser = Users::where('email_id', $email)->first();
            if ($existingUser) {
                return redirect()->route('register')->with('error', 'Email already exists! Please use a different email.');
            }
	        $save = Users::create(['full_name' => $request->input('full_name'), 'email_id' => $request->input('email_id'), 'password' => $request->input('password'), 'mobile' => $request->input('mobile'), 'country_code' => $request->input('country_code'), 'is_active' => 1]);
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
    public function mealPlans1($id)
    {
        $meal_id = decrypt($id);
        return view('web.meal_plan_one',compact('meal_id'));
    }

    public function mealPlans2(Request $request)
    {
        $data = session()->get('userData');
        if(!empty($data))
        {
            $meal_id = $request->input('meal_id');
            $days = $request->input('days');    
            $allergy_ids = $request->input('allergy_id', []); // Accept selected allergy IDs
            $totalWeeks = $days > 6 ? 2 : 1; // Determine if the data spans 2 weeks
            $start_date = $request->start_date;
            
            // Convert the start date to a DateTime object for manipulation
            $startDate = new \DateTime($start_date);

            // Initialize days added counter
            $daysAdded = 0;

            // Keep adding days until the total number of valid (non-Friday) days is reached
            while ($daysAdded < $days) {
                // Add one day
                $startDate->modify('+1 day');
                
                // Check if the current day is not Friday (Friday is 5)
                if ($startDate->format('N') != 5) {
                    // If it's not Friday, count this day
                    $daysAdded++;
                }
            }

            // Format the end date as Y-m-d
            $end_date = $startDate->format('Y-m-d');

            $results = [];

            $daysOfWeek = [
                'Saturday1' => '1',
                'Sunday1' => '2',
                'Monday1' => '3',
                'Tuesday1' => '4',
                'Wednesday1' => '5',
                'Thursday1' => '6',
            ];

            for ($week = 1; $week <= $totalWeeks; $week++) {
                $daysInWeek = $week == 1 ? min($days, 6) : max($days - 6, 0);
                $weekDays = array_slice($daysOfWeek, 0, $daysInWeek, true);

                foreach ($weekDays as $dayLabel => $dayNumber) {
                    if ($week == 2) {
                        $dayLabel = str_replace('1', '2', $dayLabel);
                    }
                    $generatedPlans = DB::table('generated_plans')
                        ->where('meal_id', $meal_id)
                        ->where('day', $dayNumber)
                        ->where('week', $week)
                        ->where('is_primary', 1)
                        ->orderByRaw("FIELD(meal_type, 3, 4)")
                        ->get();

                    $meals = collect();
                    foreach ($generatedPlans as $plan) {
                        $meal = DB::table('food_menu')
                            ->join('category', 'food_menu.category_id', '=', 'category.category_id')
                            ->select('food_menu.*', 'category.category_name')
                            ->where('food_menu.menu_id', $plan->menu_id)
                            ->first();
                        if ($meal) {
                            if (!empty($allergy_ids)) {
                                $mealAllergies = explode(',', $meal->item_id);
                                $hasAllergy = !empty(array_intersect($mealAllergies, $allergy_ids));

                                if ($hasAllergy) {
                                    // Get only the allergy names that are in the selected allergy IDs
                                    // $allergyNames = DB::table('allergy')
                                    //     ->whereIn('allergy_id', array_intersect($mealAllergies, $allergy_ids))
                                    //     ->pluck('allergy_name')
                                    //     ->toArray();
                                    $allergyNames = DB::table('inventory_item')
                                        ->whereIn('item_id', array_intersect($mealAllergies, $allergy_ids))
                                        ->pluck('item_name')
                                        ->toArray();

                                    $meal->allergyNames = $allergyNames; // Store filtered allergy names
                                } else {
                                    $meal->allergyNames = []; // No matching allergies
                                }

                                $meal->hasAllergy = $hasAllergy;
                            } else {
                                $meal->hasAllergy = false;
                                $meal->allergyNames = [];
                            }

                            $meals->push($meal);
                        }
                    }


                    $calories = $meals->sum('calories');
                    $protein = $meals->sum('tdMProt');
                    $carbs = $meals->sum('tdMCarb');
                    $fat = $meals->sum('tdMFat');

                    $results[$dayLabel] = [
                        'meals' => $meals,
                        'calories' => $calories,
                        'protein' => $protein,
                        'carbs' => $carbs,
                        'fat' => $fat,
                    ];
                }
            }

            $pickup_delivery = PickupDelivery::where('is_delete', 0)->get();

            $allergies_ids = '';
            if(!empty($allergy_ids))
            {
                // $allergies_ids = $allergy_ids;
                $allergies_ids = implode(',', $allergy_ids);
            }

            $meal_data = MealPlan::where('meal_id', $meal_id)->first();
            $meal_price = $meal_data ? $meal_data->total_amount : 0;  // Default to 0 if no meal price is found    

            return view('web.meal_plan_two', [
                'results' => $results,
                'meal_id' => $meal_id, 
                'days' => $days,
                'pickup_delivery' => $pickup_delivery,
                'allergy_ids' => $allergies_ids,
                'meal_price' => $meal_price,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Please log in first before placing the order.');
        }        
    }


    public function replaceMeal(Request $request)
    {
        $mealId = $request->input('meal_id');

        // Retrieve the meal from the food_menu table
        $meal = DB::table('food_menu')
            ->where('menu_id', $mealId)
            ->first();

        // Check if the meal was found
        if (!$meal) {
            return response()->json([
                'status' => 'error',
                'message' => $mealId
            ], 404);
        }

        // Retrieve the allergy IDs as an array
        $allergyIds = explode(',', $meal->allergy_id);
        $selectedAllergies = $request->input('allergy_id', []);

        // Check if any of the allergies match
        $hasAllergy = !empty(array_intersect($allergyIds, $selectedAllergies));

        // Fetch allergy names
        $allergyNames = \App\Models\Allergy::whereIn('allergy_id', $allergyIds)
            ->pluck('allergy_name')
            ->toArray();

        return response()->json([
            'status' => 'success',
            'meal_name' => $meal->menu,
            'media_file' => $meal->media_file,
            'nutrition_info' => $meal->calories . ' CAL / ' . $meal->tdMProt . 'g PRO / ' . $meal->tdMCarb . 'g CARBS / ' . $meal->tdMFat . 'g FAT',
            'has_allergy' => $hasAllergy,
            'allergy_names' => $allergyNames
        ]);
    }


    public function getMealData($mealId)
    {
        // Retrieve the meal with its associated allergy information
        $meal = DB::table('food_menu')
                  ->join('inventory_item', 'food_menu.itme_id', '=', 'inventory_item.item_id')
                  ->select('food_menu.*', 'inventory_item.item_name')
                  ->where('food_menu.menu_id', $mealId)
                  ->first();
        if ($meal) {
            return response()->json([
                'status' => 'success',
                'meal' => $meal,
                'allergy_name' => $meal->itme_name, // Return the allergy name
                'allergy_ids' => $meal->itme_id
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Meal not found',
            ], 404);
        }
    }


    public function getGeneratedPlans(Request $request)
    {
        Log::info('Request Data:', $request->all());
        $mealType = $request->input('meal_type');
        $day = $request->input('day');
        $categoryId = $request->input('category_id');

        $generatedPlans = DB::table('generated_plans')
            ->join('food_menu', 'generated_plans.menu_id', '=', 'food_menu.menu_id')
            ->where('generated_plans.meal_type', $mealType)
            ->where('generated_plans.day', $day)
            ->where('food_menu.category_id', $categoryId)
            ->select(
                'generated_plans.menu_id',
                'food_menu.media_file',
                'food_menu.menu',
                'food_menu.calories',
                'food_menu.tdMProt',
                'food_menu.tdMCarb',
                'food_menu.tdMFat'
            )
            ->distinct()
            ->get();


        return response()->json($generatedPlans);
    }

    public function getMealOptions(Request $request)
    {
        $mealType = $request->get('meal_type');
        $day = $request->get('day');
        $categoryId = $request->get('category_id');
    
        $options = FoodMenu::where('category_id', $categoryId)
                            ->whereRaw('FIND_IN_SET(?, day)', [$day])
                            ->get();
        //    echo "<pre>";print_r($day);die;
    
        return response()->json($options);
    }
    public function getMealOptions1(Request $request)
    {
        $mealType = $request->get('meal_type');
        $day = $request->get('day');
        $categoryId = $request->get('category_id');
    
        $options = FoodMenu::where('category_id', $categoryId)
                            ->whereRaw('FIND_IN_SET(?, day)', [$day])
                            ->get();
        //    echo "<pre>";print_r($day);die;
    
        return response()->json($options);
    }
    public function getMeals(Request $request)
    {
        $type = $request->input('type');
        $category_id = $request->input('category_id');
        $day = $request->input('day');

        // Assuming you have 'type', 'category_id', 'gender', and 'day' columns in your 'food_menus' table
        $meals = FoodMenu::where('type', $type)
            ->where('category_id', $category_id)
            ->whereRaw("FIND_IN_SET(?, day) > 0", [$day])
            ->get();

        return response()->json($meals);
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
    
    public function user_account()
    {
        $data = session()->get('userData');
        if(!empty($data))
        {
            $orders = DB::table('user_order')->join('users', 'user_order.user_id', 'users.user_id')
            ->join('meal_plan', 'user_order.meal_id', 'meal_plan.meal_id')
            ->where('users.user_id', $data['user_id'])
            ->where('users.is_delete', 0)
            ->select('user_order.*', 'users.first_name', 'users.last_name', 'users.email_id', 'meal_plan.meal_name')->get();

            // Fetch user subscription
            $subscriptions = DB::table('user_order')
            ->join('meal_plan', 'user_order.meal_id', 'meal_plan.meal_id')
            ->where('user_order.user_id', $data['user_id'])
            ->get();

            return view('web.myaccount', compact('data', 'orders', 'subscriptions'));
        }
        else
        {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
    }

    public function updateAccount(Request $request)
    {
        // Assuming you store user data in the session and have a User model
        $userId = session()->get('userData')['user_id'];

        // Validate incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email_id' => 'required|email|max:255',
            'currentPassword' => 'nullable|string',
            'newPassword' => 'nullable|string',
            'newPassword_confirmation' => 'nullable|string',
        ]);
        // echo "<pre>";print_r($validatedData);die;

        // Find the user
        $user = Users::findOrFail($userId);

        // Update user details
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->mobile = $validatedData['mobile'];
        $user->email_id = $validatedData['email_id'];

        if (!empty($validatedData['currentPassword'])) {
            if ($validatedData['currentPassword'] !== $user->password) {
                // If the current password doesn't match, return an error message
                return redirect()->back()->with('error', 'The current password does not match our records.');
            }
    
            // Check if new password is provided and matches the confirmation password
            if (!empty($validatedData['newPassword'])) {
                if ($validatedData['newPassword'] === $validatedData['newPassword_confirmation']) {
                    // Update the password if all checks pass
                    $user->password = $validatedData['newPassword'];
                } else {
                    // Return an error if the new password and confirmation do not match
                    return redirect()->back()->with('error', 'The new password and confirmation password do not match.');
                }
            }
        }

        // Save the updated user details
        $user->save();

        // Optionally, update session data
        session()->put('userData', $user->toArray());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your account details have been updated.');
    }

    public function checkoutPage(Request $request)
    {
        $data = session()->get('userData');
        if(!empty($data))
        {
            $meal_id = $request->meal_id;            

            if (session()->has('userData')) {
                $user_id = session('userData.user_id');
            }

            $mealData = $request->input('meals');            

            $userPlans = []; // Initialize an array to hold user plan data

            if (isset($mealData) && count($mealData) > 0) {
                foreach ($mealData as $day => $meals) {
                    // Determine the week based on the suffix in the day value
                    $week = (strpos($day, '2') !== false) ? 2 : 1;                    
                    
                    // Map the day value to a numeric value
                    $dayMapping = [
                        'Saturday1' => 1,
                        'Sunday1' => 2,
                        'Monday1' => 3,
                        'Tuesday1' => 4,
                        'Wednesday1' => 5,
                        'Thursday1' => 6,
                        'Friday1' => 7,
                        'Saturday2' => 1,
                        'Sunday2' => 2,
                        'Monday2' => 3,
                        'Tuesday2' => 4,
                        'Wednesday2' => 5,
                        'Thursday2' => 6,
                        'Friday2' => 7,
                    ];

                    // Convert the day to its corresponding numeric value
                    $numericDay = $dayMapping[$day];                                  

                    foreach ($meals as $menuId => $meal) {

                        $userPlans[] = [
                            'user_id' => $user_id,
                            'week' => $week,
                            'day' => $numericDay,
                            'menu_id' => $meal['menu_id'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];                         
                    }

                    session(['userPlanData' => $userPlans]);
                }
            }

            // Fetch meal data
            $mealData = MealPlan::where('meal_id', $meal_id)->first();
            $meal_name = $mealData->meal_name;
            $meal_price = $mealData->total_amount;

            // Get other request data
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $pickup_delivery = PickupDelivery::where('is_delete', 0)->get();            
            // dd($userPlans);die;
            // Pass all the data to the checkout view
            return view('web.checkout', compact(
                'meal_id', 
                'start_date',
                'end_date',
                'meal_name', 
                'meal_price',
                'userPlans', // Pass the user plan data to the view
                'pickup_delivery'  
            ));
        }
        else
        {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
    }


    public function placeOrderPage(Request $request)
    {
        $user = session()->get('userData');
        // dd($user);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to place an order.');
        } else {
            $user_id = $user->user_id;
            $user_email = $user->email_id;
            // dd($user_email);
        }

        $meal_id = $request->meal_id;
        $full_name = $request->full_name;
        $personal_no = $request->personal_no;
        $personal_no_country_code = $request->personal_no_country_code;
        $delivery_no_country_code = $request->delivery_no_country_code;
        $delivery_no = $request->delivery_no;
        $dob = $request->dob;
        $order_amount = $request->order_amount;
        $height = $request->height;
        $weight = $request->weight;
        $physical_activity = $request->physical_activity;
        $medical_condition = $request->medical_condition;
        $dietary_supplements = $request->dietary_supplements;
        $food_dislikes = $request->food_dislikes;
        $address = $request->address;
        $zone_number = $request->zone_number;
        $street_number = $request->street_number;
        $building_number = $request->building_number;
        $delivery_instructions = $request->delivery_instructions;
        $delivery_id = $request->delivery_id;
        $start_date = $request->start_date;
        $allergy_id = $request->allergy_id;
        $coupon_code = $request->coupon_code;

        // Handle file upload
        $FileUrl = null;
        if ($request->hasFile('id_proof')) {
            $file = $request->file('id_proof');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/id_proof');
            $file->move($destinationPath, $fileName);
            $FileUrl = url('/uploads/id_proof/' . $fileName);
        }

        if (is_array($allergy_id)) {
            $allergy_id = implode(',', $allergy_id);
        }

        // Save the data in the orders table
        $order = DB::table('user_order')->insertGetId([
            'meal_id' => $meal_id,
            'user_id' => $user_id,
            'start_date' => $start_date,
            'allergy_id' => $allergy_id,
            'full_name' => $full_name,
            'personal_no' => $personal_no,
            'personal_no_country_code' => $personal_no_country_code,
            'delivery_no_country_code' => $delivery_no_country_code,
            'delivery_no' => $delivery_no,
            'dob' => $dob,
            'order_amount' => $order_amount,
            'height' => $height,
            'weight' => $weight,
            'physical_activity' => $physical_activity,
            'medical_condition' => $medical_condition,
            'dietary_supplements' => $dietary_supplements,
            'food_dislikes' => $food_dislikes,
            'address' => $address,
            'zone_number' => $zone_number,
            'street_number' => $street_number,
            'building_number' => $building_number,
            'delivery_instructions' => $delivery_instructions,
            'delivery_id' => $delivery_id,
            'order_status' => 0,
            'coupon_code' => $coupon_code,
            'id_proof' => $FileUrl,
        ]);

        // Get the user plan data from session and save it in the user_plan table
        $userPlanData = session()->get('userPlanData');
        if ($userPlanData) {
            foreach ($userPlanData as $plan) {
                DB::table('user_plan')->insert(array_merge($plan, ['order_id' => $order]));
            }
            session()->forget('userPlanData');  // Clear the session after saving
        }
        
        // After saving the order
        if ($order) {
            // Fetch the order data
            $orderData = DB::table('user_order')->where('order_id', $order)->first();
            $orderMenu = DB::table('user_plan')
                        ->join('food_menu', 'user_plan.menu_id', '=', 'food_menu.menu_id')
                        ->where('user_plan.order_id', $order)
                        ->select('user_plan.*', 'food_menu.menu', 'food_menu.media_file')
                        ->get();
                        // dd($orderMenu);

            // Generate the PDF using the order data
            $pdf = Pdf::loadView('web.order_pdf', ['order' => $orderData, 'menu' => $orderMenu, 'email_id' => $user_email]);
            // $user_email = "malviyadeepak7999@gmail.com";
            $user_email = $user_email;
            // Send the email with the order PDF
            Mail::send([], [], function ($message) use ($pdf, $orderData, $user_email) {
                $message->to($user_email, $orderData->full_name)
                        ->subject('Order Confirmation - ' . $orderData->order_id)
                        ->attachData($pdf->output(), "order_{$orderData->order_id}.pdf");
            });

            print_r('Successfully Send');die();

            return redirect('/')->with('success', 'Order has been successfully placed, and the confirmation has been sent via email.');
        } else {
            return redirect('/')->with('error', 'There was an issue placing the order.');
        }
    }
    
    public function userOrderDetail(Request $request, $id)
    {
        $order_id = decrypt($id);
        $user = session()->get('userData');
        $user_id = $user->user_id;

        $data = DB::table('user_order')
            ->join('users', 'user_order.user_id', '=', 'users.user_id')
            ->join('user_plan', 'user_order.order_id', '=', 'user_plan.order_id')
            ->join('food_menu', 'user_plan.menu_id', '=', 'food_menu.menu_id')
            ->join('meal_plan', 'user_order.meal_id', '=', 'meal_plan.meal_id')
            ->join('delivery_status', 'user_order.delivery_id', '=', 'delivery_status.delivery_id')
            ->where('user_order.order_id', $order_id)
            ->where('user_order.user_id', $user_id)
            ->select(
                'user_order.*',
                'user_plan.day',
                'user_plan.week',
                'user_plan.menu_id',
                'users.first_name',
                'users.last_name',
                'users.email_id',
                'meal_plan.meal_name',
                'food_menu.menu',
                'food_menu.media_file',
                'delivery_status.status',
                'food_menu.category_id', // Select category_id to determine meal_type
                DB::raw('
                    CASE 
                        WHEN food_menu.category_id = 3 THEN 3
                        WHEN food_menu.category_id = 4 THEN 4
                    END as meal_type'
                ) // Assign meal_type
            )
            ->orderBy('user_plan.day')
            ->get()
            ->groupBy('day');
            // dd($data);

        return view('web.user_order_detail', compact('data'));
    }



    public function getAllergyOptions()
    {
        // $allergies = Allergy::all();
         $allergies = Inventory::all();
         return response()->json($allergies);
    }

}
