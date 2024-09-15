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
use Redirect;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}