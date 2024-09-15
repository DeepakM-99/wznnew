<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Users;
use App\Models\Category;
use App\Models\Allergy;
use App\Models\FoodMenu;
use App\Models\MealPlan;
use App\Models\DeliveryLocation;
use App\Models\Membership;
use App\Models\DeliveryTeam;
use App\Models\Inventory;
use App\Models\PickupDelivery;
use App\Models\Order;
use App\Models\Coupon;
use Redirect;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request)
    {
    	if(isset($_POST['submit']))
    	{
    		 $validatedData = $request->validate([
			    'email_id' => 'required|email',
			    'password' => 'required|string',
			]);

    		$admin=Admin::where(['email_id'=>$request->email_id,'password'=>$request->password,'is_delete'=>0])->count();

	        if($admin>0)
	        {
	            $adminData=Admin::where(['email_id'=>$request->email_id,'password'=>$request->password])->get();
	            session(['adminData'=>$adminData]);
	            return redirect('admin/dashboard');
	        }
	        else
	        {
	            return redirect('admin/login')->with('message','Invalid Email Id Or Password!');
	        }
    	}
    	return view('login');
    }

    public function dashboard(Request $request)
    {    
    	// $data['users'] = Users::where('is_delete','=',0)->count();

    	// return view('admin.dashboard',compact('data'));
    	return view('admin.dashboard');
    }

    public function create_admin(Request $request)
	{
	    if ($request->isMethod('post')) {
	        $save = Admin::create(['username' => $request->input('username'), 'email_id' => $request->input('email_id'), 'password' => $request->input('password'), 'is_active' => $request->input('is_active'), 'type' => 2]);
	        if (!$save) {
	            return redirect()->route('admin.create-admin')->with('message', 'Unable to save!');
	        }
	        return redirect()->route('admin.create-admin')->with('message', 'Admin Added Successfully!');
	    }

	    $data = Admin::where('type', '=', 2)->where('is_delete', 0)->get();
	    return view('admin.create_admin', compact('data'));
	}

	public function updateAdmin(Request $request)
	{
	    $admin = Admin::find($request->input('admin_id'));
	    if ($admin) {
	        $admin->username = $request->input('username');
	        $admin->email_id = $request->input('email_id');
	        $admin->password = $request->input('password');
	        $admin->is_active = $request->input('is_active');
	        $admin->save();
	        return redirect()->route('admin.create-admin')->with('message', 'Admin Updated Successfully!');
	    } else {
	        return redirect()->route('admin.create-admin')->with('message', 'Admin Not Found!');
	    }
	}

	public function deleteadmin(Request $request,$id)
	{
		$admin_id = decrypt($id);
		$delete = Admin::where('admin_id',$admin_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.create-admin')->with('message', 'Admin Not Found!');
		}else {
	        return redirect()->route('admin.create-admin')->with('message', 'Admin Deleted Successfully!');
	    }
	}

    public function category_menu(Request $request)
	{
	    if ($request->isMethod('post')) {
	        $save = Category::create(['category_name' => $request->input('category_name')]);
	        if (!$save) {
	            return redirect()->route('admin.category_menu')->with('message', 'Unable to save!');
	        }
	        return redirect()->route('admin.category_menu')->with('message', 'Category Added Successfully!');
	    }

	    $data = Category::all();
	    return view('admin.category_menu', compact('data'));
	}

	public function updateCategory(Request $request)
	{
	    $category = Category::find($request->input('category_id'));
	    if ($category) {
	        $category->category_name = $request->input('category_name');
	        $category->save();
	        return redirect()->route('admin.category_menu')->with('message', 'Category Updated Successfully!');
	    } else {
	        return redirect()->route('admin.category_menu')->with('message', 'Category Not Found!');
	    }
	}

	public function deletecategory(Request $request,$id)
	{
		$category_id = decrypt($id);
		$delete = Category::where('category_id',$category_id)->delete();
		if(!$delete)
		{
			return redirect()->route('admin.category_menu')->with('message', 'Category Not Found!');
		}else {
	        return redirect()->route('admin.category_menu')->with('message', 'Category Deleted Successfully!');
	    }
	}

    public function food_menu(Request $request)
    {
	    if ($request->isMethod('post')) {
			$file = $request->file('media_file');
			$fileName = time() . '_' . $file->getClientOriginalName();
			$destinationPath = public_path('/uploads/food-menu');
			$file->move($destinationPath, $fileName);
	
			// Get the full URL of the uploaded file
			$mediaFileUrl = url('/uploads/food-menu/' . $fileName);
	
			$allergy_id = implode(',', $request->input('allergy_id'));			
			$item_id = implode(',', $request->input('item_id'));

	        $save = FoodMenu::insert([
				'category_id' => $request->input('category_id'),
				'menu' => $request->input('menu'),
				'menu_arabic' => $request->input('menu_arabic'),
				// 'sweet_or_salad' => $request->input('sweet_or_salad'),
				'allergy_id' => $allergy_id,
				'item_id' => $item_id,
				// 'type' => $type,
				'calories' => $request->input('calories'),
                'tdMCarb' => $request->input('tdMCarb'),
                'tdMFat' => $request->input('tdMFat'),
                'tdMProt' => $request->input('tdMProt'),
                'tdMFiber' => $request->input('tdMFiber'),
				'english_text' => $request->input('english_text'),
				'arabic_text' => $request->input('arabic_text'),
				'english_description' => $request->input('english_description'),
				'arabic_description' => $request->input('arabic_description'),
				// 'selling_price' => $request->input('selling_price'),
				'media_file' => $mediaFileUrl,
			]);
	        if (!$save) {
	            return redirect()->route('admin.food-menu')->with('message', 'Unable to save!');
	        }
	        return redirect()->route('admin.food-menu')->with('message', 'Food Menu Added Successfully!');
	    }

		$category = Category::all();
		$inventory = Inventory::all();
		$allergy = Allergy::all();
		$data = FoodMenu::with('category')->orderBy('menu_id', 'desc')->get();
    	return view('admin.food_menu', compact('data', 'category', 'inventory', 'allergy'));
    }

	public function updateFoodmenu(Request $request)
	{
	    $menu = FoodMenu::find($request->input('menu_id'));
	    if ($menu) {
	        $menu->category_id = $request->input('category_id');
	        $menu->menu = $request->input('menu');
	        $menu->menu_arabic = $request->input('menu_arabic');
	        // $menu->sweet_or_salad = $request->input('sweet_or_salad');
	        $menu->allergy_id = implode(',', $request->input('allergy_id'));
	        $menu->item_id = implode(',', $request->input('item_id'));
	        $menu->calories = $request->input('calories');
	        $menu->type = $request->input('type');
	        $menu->tdMCarb = $request->input('tdMCarb');
	        $menu->tdMFat = $request->input('tdMFat');
	        $menu->tdMProt = $request->input('tdMProt');
	        $menu->tdMFiber = $request->input('tdMFiber');
	        $menu->cooking_instruction = $request->input('cooking_instruction');
	        $menu->english_text = $request->input('english_text');
	        $menu->arabic_text = $request->input('arabic_text');
	        $menu->english_description = $request->input('english_description');
	        $menu->arabic_description = $request->input('arabic_description');

			// Handle file upload if a new file is uploaded
			if ($request->hasFile('media_file')) {
				// Store the new file and get its path
				$file = $request->file('media_file');
				$fileName = time() . '_' . $file->getClientOriginalName();
				$destinationPath = public_path('/uploads/food-menu');
				$file->move($destinationPath, $fileName);
		
				// Get the full URL of the uploaded file
				$mediaFileUrl = url('/uploads/food-menu/' . $fileName);
		
				
				// Update the menu with the new file path
				$menu->media_file = $mediaFileUrl;
			}
	        $menu->save();
	        return redirect()->route('admin.food-menu')->with('message', 'Menu Updated Successfully!');
	    } else {
	        return redirect()->route('admin.food-menu')->with('message', 'Menu Not Found!');
	    }
	}

	public function deletefoodmenu(Request $request,$id)
	{
		$menu_id = decrypt($id);
		$delete = FoodMenu::where('menu_id',$menu_id)->delete();
		if(!$delete)
		{
			return redirect()->route('admin.food-menu')->with('message', 'Menu Not Found!');
		}else {
	        return redirect()->route('admin.food-menu')->with('message', 'Menu Deleted Successfully!');
	    }
	}

	public function updateStatus(Request $request)
	{
		$menu = FoodMenu::find($request->input('menu_id'));

		if (!$menu) {
			return response()->json(['status' => false, 'message' => 'Menu not found.'], 404);
		}

		// Update menu status
		$menu->is_active = $request->input('is_active');
		$menu->save();

		return response()->json(['status' => true, 'message' => 'Menu status updated successfully.']);
	}

    public function allergy(Request $request)
    {
	    if ($request->isMethod('post')) {
	        $save = Allergy::create(['allergy_name' => $request->input('allergy_name')]);
	        if (!$save) {
	            return redirect()->route('admin.allergy')->with('message', 'Unable to save!');
	        }
		}

	    $data = Allergy::all();
    	return view('admin.allergy', compact('data'));
    }

	public function updateAllergy(Request $request)
	{
	    $allergy = Allergy::find($request->input('allergy_id'));
	    if ($allergy) {
	        $allergy->allergy_name = $request->input('allergy_name');
	        $allergy->save();
	        return redirect()->route('admin.allergy')->with('message', 'Allergy Updated Successfully!');
	    } else {
	        return redirect()->route('admin.allergy')->with('message', 'Allergy Not Found!');
	    }
	}

	public function deleteallergy(Request $request,$id)
	{
		$allergy_id = decrypt($id);
		$delete = Allergy::where('allergy_id',$allergy_id)->delete();
		if(!$delete)
		{
			return redirect()->route('admin.allergy')->with('message', 'Allergy Not Found!');
		}else {
	        return redirect()->route('admin.allergy')->with('message', 'Allergy Deleted Successfully!');
	    }
	}

    public function orderList(Request $request)
    {
        $data = DB::table('user_order')->join('users', 'user_order.user_id', 'users.user_id')
        ->join('meal_plan', 'user_order.meal_id', 'meal_plan.meal_id')
        ->where('users.is_delete', 0)
        ->select('user_order.*', 'users.first_name', 'users.last_name', 'users.email_id', 'meal_plan.meal_name')->orderBy('user_order.order_id', 'DESC')->get();

        return view('admin.user_order_list', compact('data'));
    }


    public function meal_plan(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = MealPlan::create([
				'meal_name' => $request->input('meal_name'),
				// 'from_date' => $request->input('from_date'),
				// 'to_date' => $request->input('to_date'),
				'total_amount' => $request->input('total_amount'),
				'meal_calories' => $request->input('meal_calories'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.meal-plan')->with('message', 'Unable to save!');
	        }
		}

	    $data = MealPlan::where('is_delete', 0)->orderBy('meal_id','ASC')->get();
    	return view('admin.mealplans', compact('data'));
    }

	public function updateMealPlan(Request $request)
	{
	    $meal = MealPlan::find($request->input('meal_id'));
	    if ($meal) {
	        $meal->meal_name = $request->input('meal_name');
	        // $meal->from_date = $request->input('from_date');
	        // $meal->to_date = $request->input('to_date');
	        $meal->total_amount = $request->input('total_amount');
	        $meal->meal_calories = $request->input('meal_calories');
	        $meal->save();
	        return redirect()->route('admin.meal-plan')->with('message', 'Meal plan Updated Successfully!');
	    } else {
	        return redirect()->route('admin.meal-plan')->with('message', 'Meal plan Not Found!');
	    }
	}

	public function deletemealplan(Request $request,$id)
	{
		$meal_id = decrypt($id);

		$delete = MealPlan::where('meal_id', $meal_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.meal-plan')->with('message', 'Meal Plan Not Found!');
		}else {
	        return redirect()->route('admin.meal-plan')->with('message', 'Meal Plan Deleted Successfully!');
	    }
	}

    public function delivery_location(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = DeliveryLocation::create([
				'location_name' => $request->input('location_name'),
				'delivery_zone' => $request->input('delivery_zone'),
				// 'delivery_amount' => $request->input('delivery_amount'),
				// 'delivery_type' => $request->input('delivery_type'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.delivery-location')->with('message', 'Unable to save!');
	        }
		}

		$data = DeliveryLocation::where('is_delete', 0)->get();
    	return view('admin.delivery_location', compact('data'));
    }

	public function updateDeliveryLoc(Request $request)
	{
	    $location = DeliveryLocation::find($request->input('location_id'));
	    if ($location) {
	        $location->location_name = $request->input('location_name');
	        $location->delivery_zone = $request->input('delivery_zone');
	        // $meal->delivery_amount = $request->input('delivery_amount');
	        // $meal->delivery_type = $request->input('delivery_type');
	        $location->save();
	        return redirect()->route('admin.delivery-location')->with('message', 'Delivery Location Updated Successfully!');
	    } else {
	        return redirect()->route('admin.delivery-location')->with('message', 'Delivery Location Not Found!');
	    }
	}

	public function deletedeliveryloc(Request $request,$id)
	{
		$location_id = decrypt($id);

		$delete = DeliveryLocation::where('location_id', $location_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.delivery-location')->with('message', 'Delivery Location Not Found!');
		}else {
	        return redirect()->route('admin.delivery-location')->with('message', 'Delivery Location Deleted Successfully!');
	    }
	}

	public function deliveryStatus(Request $request)
	{
		$location = DeliveryLocation::find($request->input('location_id'));

		if (!$location) {
			return response()->json(['status' => false, 'message' => 'Location not found.'], 404);
		}

		// Update menu status
		$location->is_active = $request->input('is_active');
		$location->save();

		return response()->json(['status' => true, 'message' => 'Location status updated successfully.']);
	}

    public function membershipPlan(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = Membership::create([
				'membership_plan' => $request->input('membership_plan'),
				'language_id' => $request->input('language_id'),
				'plan_duration' => $request->input('plan_duration'),
				'price' => $request->input('price'),
				'gender' => $request->input('gender'),
				'per_day_meal_count' => $request->input('per_day_meal_count'),
				'snack_breakfast_count' => $request->input('snack_breakfast_count'),
				'per_day_calory' => $request->input('per_day_calory'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.membership-plan')->with('message', 'Unable to save!');
	        }
		}

		$language = DB::table('languages')->get();
	    $data = Membership::where('is_delete', 0)->get();
		$data = Membership::join('languages', 'membership_plan.language_id', 'languages.language_id')
				->where('membership_plan.is_delete', 0)
				->select('membership_plan.*', 'languages.language_name')->get();
    	return view('admin.membership_plan', compact('data', 'language'));
    }

	public function updateMembership(Request $request)
	{
	    $plan = Membership::find($request->input('plan_id'));
	    if ($plan) {
	        $plan->membership_plan = $request->input('membership_plan');
	        $plan->language_id = $request->input('language_id');
	        $meal->plan_duration = $request->input('plan_duration');
	        $meal->price = $request->input('price');
	        $plan->gender = $request->input('gender');
	        $meal->per_day_meal_count = $request->input('per_day_meal_count');
	        $meal->snack_breakfast_count = $request->input('snack_breakfast_count');
	        $plan->per_day_calory = $request->input('per_day_calory');
	        $plan->save();
	        return redirect()->route('admin.membership-plan')->with('message', 'Membership Plan Updated Successfully!');
	    } else {
	        return redirect()->route('admin.membership-plan')->with('message', 'Membership Plan Not Found!');
	    }
	}

	public function deletemembership(Request $request,$id)
	{
		$plan_id = decrypt($id);

		$delete = Membership::where('plan_id', $plan_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.membership-plan')->with('message', 'Membership Plan Not Found!');
		}else {
	        return redirect()->route('admin.membership-plan')->with('message', 'Membership Plan Deleted Successfully!');
	    }
	}

    public function deliveryTeam(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = DeliveryTeam::create([
				'name' => $request->input('name'),
				'mobile' => $request->input('mobile'),
				'email_id' => $request->input('email_id'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.delivery-team')->with('message', 'Unable to save!');
	        }
		}

	    $data = DeliveryTeam::where('is_delete', 0)->get();
    	return view('admin.delivery_team', compact('data'));
    }

	public function updateTeam(Request $request)
	{
	    $team = DeliveryTeam::find($request->input('team_id'));
	    if ($team) {
	        $team->name = $request->input('name');
	        $team->mobile = $request->input('mobile');
	        $team->email_id = $request->input('email_id');
	        $team->save();
	        return redirect()->route('admin.delivery-team')->with('message', 'Delivery Team Updated Successfully!');
	    } else {
	        return redirect()->route('admin.delivery-team')->with('message', 'Delivery Team Not Found!');
	    }
	}

	public function deleteteam(Request $request,$id)
	{
		$team_id = decrypt($id);

		$delete = DeliveryTeam::where('team_id', $team_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.delivery-team')->with('message', 'Delivery Team Not Found!');
		}else {
	        return redirect()->route('admin.delivery-team')->with('message', 'Delivery Team Deleted Successfully!');
	    }
	}

    public function inventory(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = Inventory::create([
				'item_name' => $request->input('item_name'),
				'item_code' => $request->input('item_code'),
				'unit_id' => $request->input('unit_id'),
				'price' => $request->input('price'),
				'is_active' => $request->input('is_active'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.inventory')->with('message', 'Unable to save!');
	        }
		}

		$unit = DB::table('unit_of_measure')->get();
	    $data = Inventory::join('unit_of_measure', 'inventory_item.unit_id', 'unit_of_measure.unit_id')
				->where('inventory_item.is_delete', 0)
				->select('inventory_item.*', 'unit_of_measure.unit_name')->get();
    	return view('admin.inventory', compact('data', 'unit'));
    }

	public function updateInventory(Request $request)
	{
	    $inventory = Inventory::find($request->input('item_id'));
	    if ($inventory) {
	        $inventory->item_name = $request->input('item_name');
	        $inventory->item_code = $request->input('item_code');
	        $inventory->unit_id = $request->input('unit_id');
	        $inventory->price = $request->input('price');
	        $inventory->is_active = $request->input('is_active');
	        $inventory->save();
	        return redirect()->route('admin.inventory')->with('message', 'Inventory Updated Successfully!');
	    } else {
	        return redirect()->route('admin.inventory')->with('message', 'Inventory Not Found!');
	    }
	}

	public function deleteinventory(Request $request,$id)
	{
		$item_id = decrypt($id);

		$delete = Inventory::where('item_id', $item_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.inventory')->with('message', 'Inventory Not Found!');
		}else {
	        return redirect()->route('admin.inventory')->with('message', 'Inventory Deleted Successfully!');
	    }
	}

    public function userDetail(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = Users::create([
				'first_name' => $request->input('first_name'),
				'last_name' => $request->input('last_name'),
				'mobile' => $request->input('mobile'),
				'email_id' => $request->input('email_id'),
				'password' => $request->input('password'),
				'is_active' => $request->input('is_active'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.user-detail')->with('message', 'Unable to save!');
	        }
		}

	    $data = Users::where('is_delete', 0)->get();
    	return view('admin.user_detail', compact('data'));
    }

	public function updateUser(Request $request)
	{
	    $user = Users::find($request->input('user_id'));
	    if ($user) {
	        $user->first_name = $request->input('first_name');
	        $user->last_name = $request->input('last_name');
	        $user->mobile = $request->input('mobile');
	        $user->email_id = $request->input('email_id');
	        $user->password = $request->input('password');
	        $user->is_active = $request->input('is_active');
	        $user->save();
	        return redirect()->route('admin.user-detail')->with('message', 'User Updated Successfully!');
	    } else {
	        return redirect()->route('admin.user-detail')->with('message', 'User Not Found!');
	    }
	}

	public function deleteuser(Request $request,$id)
	{
		$user_id = decrypt($id);

		$delete = Users::where('user_id', $user_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.user-detail')->with('message', 'User Not Found!');
		}else {
	        return redirect()->route('admin.user-detail')->with('message', 'User Deleted Successfully!');
	    }
	}

    public function pickupDelivery(Request $request)
    {
		if ($request->isMethod('post')) {
	        $save = PickupDelivery::create([
				'status' => $request->input('status'),
			]);
	        if (!$save) {
	            return redirect()->route('admin.pickup-delivery')->with('message', 'Unable to save!');
	        }
		}

	    $data = PickupDelivery::where('is_delete', 0)->get();
    	return view('admin.pickup_delivery', compact('data'));
    }

	public function updatePickupDel(Request $request)
	{
	    $status = PickupDelivery::find($request->input('delivery_id'));
	    if ($status) {
	        $status->status = $request->input('status');
	        $status->save();
	        return redirect()->route('admin.pickup-delivery')->with('message', 'Pickup Delivery Updated Successfully!');
	    } else {
	        return redirect()->route('admin.pickup-delivery')->with('message', 'Pickup Delivery Not Found!');
	    }
	}

	public function deletepickup(Request $request,$id)
	{
		$delivery_id = decrypt($id);

		$delete = PickupDelivery::where('delivery_id', $delivery_id)->update(['is_delete' => 1]);
		if(!$delete)
		{
			return redirect()->route('admin.pickup-delivery')->with('message', 'Pickup Delivery Not Found!');
		}else {
	        return redirect()->route('admin.pickup-delivery')->with('message', 'Pickup Delivery Deleted Successfully!');
	    }
	}

	public function fetchMenu(Request $request)
	{
	    // Extract meal_id from the request
	    $meal_id = $request->input('meal_id'); // This assumes you are sending meal_id in the request

	    // Fetch the menu items with the relevant categories
	    $data = FoodMenu::with('category')
	                    ->whereIn('category_id', [3, 4])
	                    ->get();

	    // Return the data along with the meal_id
	    return response()->json([
	        'meal_id' => $meal_id, // Include the meal_id in the response
	        'menuItems' => $data   // Include the menu items in the response
	    ]);
	}

	public function saveFoodSelection(Request $request)
	{
	    $meal_id = $request->input('meal_id');
	    $selected_menu_id = $request->input('menu_id');
	    $position = $request->input('position');
	    $day = $request->input('day');
	    $week = $request->input('week');
	    $is_active = $request->input('is_active', 1);
	    $meal_type = $request->input('meal_type');

	    // Fetch the item to check its category and type
	    $item = DB::table('food_menu')->where('menu_id', $selected_menu_id)->first();

	    if ($item) {
	        $is_primary = in_array($position, [1, 5, 9, 13, 17, 21, 25, 29]);

	        $existingRecord = DB::table('generated_plans')
	            ->where('meal_id', $meal_id)
	            ->where('position', $position)
	            ->where('is_primary', $is_primary)
	            ->where('day', $day)
	            ->where('week', $week)
	            ->where('meal_type', $meal_type)
	            ->first();

	        if ($existingRecord) {
	            // Update the existing record
	            DB::table('generated_plans')
	                ->where('id', $existingRecord->id)
	                ->update([
	                    'menu_id'    => $selected_menu_id,
	                    'meal_type'  => $meal_type,
	                    'is_active'  => $is_active,
	                    'updated_at' => now()
	                ]);

	            $savedRecord = $existingRecord; // Use existingRecord for the response
	        } else {
	            // Insert data into the generated_plans table
	            $savedRecord = DB::table('generated_plans')->insertGetId([
	                'meal_id'    => $meal_id,
	                'menu_id'    => $selected_menu_id,
	                'position'   => $position,
	                'is_primary' => $is_primary,
	                'day'        => $day,
	                'week'       => $week,
	                'is_active'  => $is_active,
	                'meal_type'  => $meal_type,
	                'created_at' => now(),
	                'updated_at' => now()
	            ]);
	        }

	        // Fetch the saved menu item details
	        $savedMenuItem = DB::table('food_menu')->where('menu_id', $selected_menu_id)->first();

	        return response()->json([
	            'success' => true,
	            'message' => 'Record saved successfully',
	            'menuItem' => $savedMenuItem,
	            'position' => $position,
	            'mealType' => $meal_type,
	            'week' => $week,
	            'day' => $day,
	        ]);
	    } else {
	        return response()->json(['error' => 'Invalid menu selection'], 400);
	    }
	}



	public function coupon(Request $request)
    {
        if ($request->isMethod('post')) {
            $save = Coupon::create([
                'coupon_title' => $request->input('coupon_title'),
                'description' => $request->input('description'),
                'expiry_date' => $request->input('expiry_date'),
                'discount_type' => $request->input('discount_type'),
                'percent_discount' => $request->input('percent_discount'),
                'rupee_discount' => $request->input('rupee_discount'),
            ]);
            if (!$save) {
                return redirect()->route('admin.coupon')->with('message', 'Unable to save!');
            }
        }


        $data = Coupon::where('is_delete', 0)->get();
        return view('admin.coupons', compact('data'));
    }


    public function updateCoupon(Request $request)
    {
        $coupon = Coupon::find($request->input('coupon_id'));
        if ($coupon) {
            $coupon->coupon_title = $request->input('coupon_title');
            $coupon->description = $request->input('description');
            $coupon->discount_type = $request->input('discount_type');
            $coupon->percent_discount = $request->input('percent_discount');
            $coupon->rupee_discount = $request->input('rupee_discount');
            $coupon->expiry_date = $request->input('expiry_date');
            $coupon->save();
            return redirect()->route('admin.coupon')->with('message', 'Coupon Updated Successfully!');
        } else {
            return redirect()->route('admin.coupon')->with('message', 'Coupon Not Found!');
        }
    }


    public function deletecoupon(Request $request,$id)
    {
        $coupon_id = decrypt($id);


        $delete = Coupon::where('coupon_id', $coupon_id)->update(['is_delete' => 1]);
        if(!$delete)
        {
            return redirect()->route('admin.coupon')->with('message', 'Coupon Not Found!');
        }else {
            return redirect()->route('admin.coupon')->with('message', 'Coupon Deleted Successfully!');
        }
    }


    public function couponStatus(Request $request)
    {
        $coupon = Coupon::find($request->input('coupon_id'));


        if (!$coupon) {
            return response()->json(['status' => false, 'message' => 'Coupon not found.'], 404);
        }


        // Update menu status
        $coupon->is_active = $request->input('is_active');
        $coupon->save();


        return response()->json(['status' => true, 'message' => 'Coupon status updated successfully.']);
    }

    public function ordersReport(Request $request)
    {  
        $data = DB::table('user_order')->join('users', 'user_order.user_id', 'users.user_id')
        ->join('meal_plan', 'user_order.meal_id', 'meal_plan.meal_id')
        ->join('delivery_status', 'user_order.delivery_id', 'delivery_status.delivery_id')
        ->where('users.is_delete', 0)
        // ->where('user_order.order_status', 1)
        ->select('user_order.*', 'users.first_name', 'users.last_name', 'users.email_id', 'meal_plan.meal_name', 'delivery_status.status')->get();

        return view('admin.order_report', compact('data'));
    }

     public function exportCsv()
    {
        $orders = DB::table('user_order')->join('users', 'user_order.user_id', 'users.user_id')
        ->join('meal_plan', 'user_order.meal_id', 'meal_plan.meal_id')
        ->join('delivery_status', 'user_order.delivery_id', 'delivery_status.delivery_id')
        ->where('users.is_delete', 0)
        // ->where('user_order.order_status', 1)
        ->select('user_order.*', 'users.first_name', 'users.last_name', 'users.email_id', 'meal_plan.meal_name', 'delivery_status.status')->get();

        $csvFileName = 'orders-report.csv';
        $handle = fopen($csvFileName, 'w+');
        fputcsv($handle, ['ID', 'Product Name', 'Price', 'Delivery Type', 'Status']);

        foreach ($orders as $order) {
            $orderStatus = $this->getOrderStatusLabel($order->order_status);
            fputcsv($handle, [$order->order_id, $order->meal_name, $order->order_amount, $order->status, $orderStatus]);
        }

        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return Response::download($csvFileName, $csvFileName, $headers)->deleteFileAfterSend(true);
    }


    private function getOrderStatusLabel($status)
    {
        // Define a mapping of status values to labels
        $statusLabels = [
            1 => 'Completed',
            0 => 'Pending', // Example for other status values
            // Add other mappings as needed
        ];


        return $statusLabels[$status] ?? 'Unknown'; // Default to 'Unknown' if status is not mapped
    }

    public function generate_plan(Request $request, $id)
	{
	    $meal_id = decrypt($id);	    	    
		// Fetch all relevant data for the given meal_id	     
		$planData = DB::table('generated_plans')
		    ->join('food_menu', 'generated_plans.menu_id', '=', 'food_menu.menu_id')
		    ->select('generated_plans.*', 'food_menu.*')
		    ->where('generated_plans.meal_id', $meal_id)
		    ->get();

		$structuredData = [];
		foreach ($planData as $data) {
		    $dayWithoutPrefix = str_replace('Day', '', $data->day);
		    // Index by meal_id and position to avoid overwriting
		    $structuredData[$data->week][$dayWithoutPrefix][$data->meal_type][$data->meal_id][$data->position] = $data;
		}

	    // Pass the data to the appropriate view based on meal_id
	    if($meal_id == 1){
	        return view('admin.generate_plan_one', compact('structuredData'));
	    } elseif($meal_id == 2){
	        return view('admin.generate_plan_two', compact('structuredData'));
	    } elseif ($meal_id == 3) {
	        return view('admin.generate_plan_three', compact('structuredData'));
	    } elseif ($meal_id == 4) {
	        return view('admin.generate_plan_four', compact('structuredData'));
	    } else {
	        return redirect()->back()->with('error', 'Invalid meal ID');
	    }
	}

	public function updateOrderStatus(Request $request)
	{
		$order = DB::table('user_order')->where('order_id', $request->input('order_id'))->first();

		if ($order) {
			DB::table('user_order')
				->where('order_id', $request->input('order_id'))
				->update(['order_status' => $request->input('order_status')]);

			return redirect()->route('admin.order-list')->with('message', 'Order Status Updated Successfully!');
		} else {
			return redirect()->route('admin.order-list')->with('message', 'Order Status Not Found!');
		}
	}

    public function OrderDetail(Request $request, $id)
    {
        $order_id = decrypt($id);

        $data = DB::table('user_order')
            ->join('users', 'user_order.user_id', '=', 'users.user_id')
            ->join('user_plan', 'user_order.order_id', '=', 'user_plan.order_id')
            ->join('food_menu', 'user_plan.menu_id', '=', 'food_menu.menu_id')
            ->join('meal_plan', 'user_order.meal_id', '=', 'meal_plan.meal_id')
            ->join('delivery_status', 'user_order.delivery_id', '=', 'delivery_status.delivery_id')
            ->where('user_order.order_id', $order_id)
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


        return view('admin.order_detail', compact('data'));
    }


    public function logout()
    {
    	session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
