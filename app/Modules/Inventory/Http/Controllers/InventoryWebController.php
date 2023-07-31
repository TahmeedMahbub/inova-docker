<?php

namespace App\Modules\Inventory\Http\Controllers;

use DB;
use Excel;
use Session;
use App\User;

use DateTime;
use Response;
use Exception;
use Carbon\Carbon;
use App\Models\Tax;
use App\Lib\Helpers;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Imports\MenuImport;

// Models
use Illuminate\Support\Str;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\Offers\Offers;
use App\Models\Inventory\Item;
use App\Models\Company\Company;
use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use App\Models\Inventory\Product;
use App\Models\MoneyOut\BillEntry;
use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\Inventory\DamageItem;
use App\Models\Moneyin\InvoiceEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Attributes\Attributes;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ItemVariation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Inventory\ItemSubCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Attributes\AttributeValues;
use App\Models\Inventory\ItemMultipleFile;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ItemAttributeValues;

use App\Models\Inventory\ItemVariationAttributeValues;
use App\Models\OrganizationProfile\OrganizationProfile;

class InventoryWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function apiAllInventory(Request $request)
    {
        try {

            $branch_id = session('branch_id');
            $op        = OrganizationProfile::findOrFail(1);

            if ($op->show_all_item == 1 || $branch_id == 1) {
                $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                    ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                    ->leftjoin('users', 'users.id', '=', 'item.created_by')
                    ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                    ->select(
                        "item.created_at",
                        "item.id",
                        "item.item_category_id",
                        "item.subject_name",
                        "item_category.item_category_name as item_category_name",
                        "item.barcode_no",
                        "item_sub_category.item_sub_category_name as item_sub_category_name",
                        "item.item_name as item_name",
                        "branch.branch_name"
                    )
                    ->where('item.item_category_id', '!=', 3)
                    ->get();
            } else {
                if ($branch_id) {
                    $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                        ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                        ->leftjoin('users', 'users.id', '=', 'item.created_by')
                        ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                        ->select(
                            "item.created_at",
                            "item.id",
                            "item.item_category_id",
                            "item.subject_name",
                            "item_category.item_category_name as item_category_name",
                            "item.barcode_no",
                            "item_sub_category.item_sub_category_name as item_sub_category_name",
                            "item.item_name as item_name",
                            "branch.branch_name"
                        )
                        ->where('item.branch_id', $branch_id)
                        ->where('item.item_category_id', '!=', 3)
                        ->get();
                }
            }

            if ($items) {
                foreach ($items as $value) {
                    $value->format_created_at = date("d-m-Y", strtotime($value->created_at));
                    $value->barcode_no        = $value->barcode_no;
                }
            }

            return response($items);
        } catch (\Exception $exception) {

            return response([]);
        }
    }

    public function apiFindInventory(Request $request)
    {

        try {

            $branch_id = session('branch_id');

            $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                ->leftjoin('users', 'users.id', '=', 'item.created_by')
                ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                ->select("item.created_at", "item.id", "item.item_category_id", "item.subject_name", "item_category.item_category_name as item_category_name", "item_sub_category.item_sub_category_name as item_sub_category_name", "item.item_name as item_name", "branch.branch_name")
                ->where('item.item_name', "like", "%$request->name%")
                ->where('item.item_category_id', '!=', 3)
                ->get();



            foreach ($items as $value) {
                $value->format_created_at = date("d-m-Y", strtotime($value->created_at));
            }

            return response($items);
        } catch (\Exception $exception) {

            return response([]);
        }
    }

    public function index()
    {
        $branch_id  = session('branch_id');

        $op         = OrganizationProfile::findOrFail(1);

        if ($op->show_all_item == 1 || $branch_id == 1) {
            $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                ->select(
                    "item.id",
                    "item.item_category_id",
                    "item.reorder_point",
                    "item_category.item_category_name as item_category_name",
                    "item.item_name as item_name",
                    "item.total_purchases",
                    "item.total_sales",
                    "item.total_purchases"
                )
                ->where('item.item_category_id', '!=', 3)
                ->get();

            $item_categories       = ItemCategory::select("item_category_name", 'id', 'created_by')->get();
        } else {
            if ($branch_id) {
                $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                    ->where('item.branch_id', $branch_id)
                    ->select(
                        "item.id",
                        "item.item_category_id",
                        "item.reorder_point",
                        "item_category.item_category_name as item_category_name",
                        "item.item_name as item_name",
                        "item.total_purchases",
                        "item.total_sales",
                        "item.total_purchases"
                    )
                    ->where('item.item_category_id', '!=', 3)
                    ->get();

                $item_categories       = ItemCategory::select("item_category_name", 'id', 'created_by')
                    ->where('branch_id', $branch_id)
                    ->get();
            }
        }

        $current_time          = Carbon::now()->toDayDateTimeString();
        $start                 = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                   = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        // $stock_report          = route("report_stock_details_item",["id"=>'new_id',"start"=>$start,'end'=>$end]);
        // $item_report           = route("report_account_item_details",["id"=>'new_id',"start"=>$start,'end'=>$end]);


        return view('inventory::inventory.Ajax.index', compact('items', 'item_categories'));
    }

    public function create(Request $request)
    {
        // $branch_id = Auth::user()->brach_id;
        $branch_id = session('branch_id');

        $item_categories                = ItemCategory::all();
        $item_sub_categories            = ItemSubCategory::all();
        $attributes                     = Attributes::all();
        $accounts                       = Account::all();
        $branches                       = Branch::all();
        $taxs                           = Tax::all();
        $units                          = Unit::where('id', '!=', 1)->get();
        $company                        = [];
        $confirmation_id                = null;
        $order_id                       = null;

        if ($request->confirmation) {
            $confirmation_id            = $request->confirmation;
        }
        if ($request->order) {
            $order_id                   = $request->order;
        }

        return view('inventory::inventory.create', compact('company', 'units', 'item_categories', 'item_sub_categories', 'accounts', 'branches', 'taxs', 'confirmation_id', 'order_id', 'attributes'));
    }

    public function subCategory($id)
    {
        $data = ItemSubCategory::where('item_category_id', $id)->get()->toArray();

        return Response::json($data);
    }

    public function store(Request $request)
    {
     
        $user = Auth::user();
        $helper = new Helpers;
        DB::beginTransaction();
        $item_data = $request->all();

        // if(in_array(!'', $request->attribute) || in_array(!'', $request->attributes_value) || in_array(!'', $request->variation_name_id) || in_array(!'', $request->sku)){
        //     $validator = Validator::make($request->all(), [
        //         'item_name'                 => 'required',
        //         'item_category_id'          => 'required',
        //         'barcode_no'                => 'unique:item',
        //     ]);
        // }else{
        $validator = Validator::make($request->all(), [
            'item_name'                 => 'required',
            'item_category_id'          => 'required',
            'barcode_no'                => 'unique:item'
        ]);
        // }

        try {

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $item                                   = new Item;
            $item->item_category_id                 = $item_data['item_category_id'];
            $item->item_sub_category_id             = isset($item_data['item_sub_category_id']) && intval($item_data['item_sub_category_id']) > 0 ? $item_data['item_sub_category_id'] : null;
            $item->item_name                        = $item_data['item_name'];
            $item->unit_id                          = isset($item_data['unit_id']) ? $item_data['unit_id'] : null;
            $item->carton_size                      = isset($item_data['carton_unit']) ? $item_data['carton_unit'] : 0;
            $item->branch_id                        = $user->branch_id;
            $item->created_by                       = $user->id;
            $item->updated_by                       = $user->id;
            $item->created_at                       = \Carbon\Carbon::now()->toDateTimeString();
            $item->updated_at                       = \Carbon\Carbon::now()->toDateTimeString();

          
          


            if ($item->save()) {
     // sop files upload

     if (isset($item_data['sop_file']) && $item_data['sop_file'] != '') 
     {
        foreach($item_data['sop_file'] as $sop_file)
        {
             // for multiple sop  files upload

                 $fileName = $sop_file->getClientOriginalName();

                 $destinationPath ='uploads/sopFiles/';
                 $destinationFile = $destinationPath . $fileName;
                 
                 if (File::exists($destinationFile)) {
                     $folderPath = public_path('uploads/sopFiles/');
                     $extension =pathinfo($fileName, PATHINFO_EXTENSION);
                     $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                  
                     $files = File::glob($folderPath . $fileName);
                    
                     if(count($files)>0)
                     {
                        
                         $timestamp = time();
                         $dateTime = date('H-i-s', $timestamp);
                         $final_file         =  $fileNameWithoutExtension. '_' .  time().'.'.$extension;
                        
                     }
                 } else {
                     $final_file = $fileName;
                 }
               
                $success                    = $sop_file->move('uploads/sopFiles',  $final_file );
              
             if (isset($success)&& $success!= '') {
                 $item_multiple_file                   = new ItemMultipleFile;
                 $item_multiple_file->sop_file         = 'uploads/sopFiles/' . $final_file;
                 $item_multiple_file->item_id          = $item->id;
                 $item_multiple_file->created_by       = $user->id;
                 $item_multiple_file->updated_by       = $user->id;
                 $item_multiple_file->save();
             
             }
        }
     }
// design files upload
     if (isset($item_data['design_file']) && $item_data['design_file'] != '') 
     {
             foreach($item_data['design_file'] as $design_files)
             {
                     // for multiple sop and design files upload

                     $fileName = $design_files->getClientOriginalName();

                     $destinationPath ='uploads/designFiles/';
                     $destinationFile = $destinationPath . $fileName;
                     
                     if (File::exists($destinationFile)) {
                         $folderPath = public_path('uploads/designFiles/');
                         $extension =pathinfo($fileName, PATHINFO_EXTENSION);
                         $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                      
                         $files = File::glob($folderPath . $fileName);
                        
                         if(count($files)>0)
                         {
                            
                             $timestamp = time();
                             $dateTime = date('H-i-s', $timestamp);
                             $final_file         =  $fileNameWithoutExtension. '_' .  time().'.'.$extension;
                            
                         }
                     } else {
                         $final_file = $fileName;
                     }
                     $success                    = $design_files->move('uploads/designFiles',  $final_file );
                 
                     if (isset($success)&& $success!= '') {
                         $item_multiple_file                   = new ItemMultipleFile;
                         $item_multiple_file->design_file      = 'uploads/designFiles/' . $final_file;
                         $item_multiple_file->item_id          = $item->id;
                         $item_multiple_file->created_by       = $user->id;
                         $item_multiple_file->updated_by       = $user->id;

                         $item_multiple_file->save();
                     
                     }
             }
     }



                if(in_array(!'', $request->item_attributes_value)){
                    foreach($request->item_attributes_value as $key => $attribute_value_id){
                        $item_attribute_values[] = ItemAttributeValues::create([
                            'item_id'               => $item->id,
                            'attribute_values_id'   => $attribute_value_id,
                            'measurable'            => $item_data['measurable_attr'][$key],
                            'created_by'            => $user->id,
                            'updated_by'            => $user->id    
                        ]);
                    }
                }

                if($helper->not_in_array_r('', $request->attribute) || $helper->not_in_array_r('', $request->attributes_value) || in_array(!'', $request->variation_name_id) || in_array(!'', $request->sku)){
                    foreach ($item_data['variation_name_id'] as $key => $variation) {
                        $item_variation                             = new ItemVariation;
                        $item_variation->variation_name             = $variation;
                        $item_variation->variation_sales_rate       = isset($item_data['item_sales_rate'][$key]) ? $item_data['item_sales_rate'][$key] : null;
                        $item_variation->variation_purchase_rate    = isset($item_data['item_purchase_rate'][$key]) ? $item_data['item_purchase_rate'][$key] : null;
                        $item_variation->variation_about            = isset($item_data['item_about'][$key]) ? $item_data['item_about'][$key] : null;
                        $item_variation->item_id                    = $item->id;
                        $item_variation->carton_size                = $item_data['carton_size'][$key] == '' ? 0 : $item_data['carton_size'][$key];
                        $item_variation->created_by                 = $user->id;
                        $item_variation->updated_by                 = $user->id;
                        $item_variation->created_at                 = \Carbon\Carbon::now()->toDateTimeString();
                        $item_variation->updated_at                 = \Carbon\Carbon::now()->toDateTimeString();
    
                        if ($item_variation->save()) {
                            $item_variation->sku                        = strlen($item_data['sku'][$key] ?? 0) > 3 ? $item_data['sku'][$key] : str_pad($item->id, 6, 0, STR_PAD_LEFT) . '' . str_pad($item_variation->id, 6, 0, STR_PAD_LEFT);
                            foreach ($item_data['attribute'][$key] as $key1 => $value) {
                                ItemVariationAttributeValues::create([
                                    'item_variation_id'     => $item_variation->id,
                                    'attribute_values_id'   => $item_data['attributes_value'][$key][$key1],
                                    'created_by'            => $user->id,
                                    'updated_by'            => $user->id,
                                    'created_at'            => Carbon::now()->toDateTimeString(),
                                    'updated_at'            => Carbon::now()->toDateTimeString(),
                                ]);
                            }
                        }
                        $item_variation->save();
                    }
                }
                $item->barcode_no                       = strlen($item_data['barcode_no'][0] ?? 0) > 3 ? $item_data['barcode_no'][0] : str_pad($item->id, 6, 0, STR_PAD_LEFT);
                $item->save();
                
                DB::commit();
                return redirect()
                    ->route('inventory')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Item Added Successfully!');
            } else {
                throw new \Exception("Something Went Wrong");
            }
        } catch (\Exception $e) {

            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

   


    public function show($id)
    {
        $branch_id = Auth::user()->brach_id;

        $item                   = Item::find($id);
        $item_categories        = ItemCategory::all();
        $item_sub_categories    = ItemSubCategory::find($id);

        return view('inventory::inventory.show', compact('item', 'item_categories', 'item_sub_categories'));
    }

    public function consolidatedView()
    {
        $branch_id  = session('branch_id');

        $op         = OrganizationProfile::findOrFail(1);

        if ($op->show_all_item == 1 || $branch_id == 1) {
            $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                ->select(
                    "item.id",
                    "item.item_category_id",
                    "item.reorder_point",
                    "item_category.item_category_name as item_category_name",
                    "item.item_name as item_name",
                    "item.total_purchases",
                    "item.total_sales",
                    "item.total_purchases",
                    "item.barcode_no"
                )
                ->orderBy('item_name', 'ASC')
                ->get();
        } else {
            if ($branch_id) {
                $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                    ->where('item.branch_id', $branch_id)
                    ->select(
                        "item.id",
                        "item.item_category_id",
                        "item.reorder_point",
                        "item_category.item_category_name as item_category_name",
                        "item.item_name as item_name",
                        "item.total_purchases",
                        "item.total_sales",
                        "item.total_purchases",
                        "item.barcode_no"
                    )
                    ->orderBy('item_name', 'ASC')
                    ->get();
            }
        }


        foreach ($items as $key => $item_tmp) {
            $generator              = new \Picqer\Barcode\BarcodeGeneratorHTML();
            $item_tmp->barcodes     = '';

            for ($i = 0; $i < 1; $i++) {

                $item_tmp->barcodes .= '<div style="padding: 4px; display: inline-block; font-size: 12px; margin: 2px; width: 136px; height: 88px;">';
                $item_tmp->barcodes .= '<div class="barcode">' . $generator->getBarcode($item_tmp->barcode_no, $generator::TYPE_CODE_128, 2, 64) . '</div>';
                $item_tmp->barcodes .= '</div>';
            }
        }

        return view('inventory::inventory.Ajax.consolidatedview', compact('items'));
    }

    public function edit($id)
    {
        $item                   = Item::findorfail($id);
        $item_multiple_files    = itemMultipleFile::where('item_id', $id)->get();
        $item_attribute_values  = ItemAttributeValues::where('item_id', $id)->get();
        $item_categories        = ItemCategory::all();
        $item_sub_categories    = ItemSubCategory::all();
        $item_variations        = ItemVariation::where('item_id', $item->id)->get();
        $attributes             = Attributes::all();
        $units                  = Unit::where('id', '!=', 1)->get();
        $attribute_values       = AttributeValues::all();
        return view('inventory::inventory.edit', compact('item_categories', 'units', 'item_sub_categories', 'item_multiple_files','item_attribute_values', 'attribute_values', 'item', 'id', 'item_variations', 'attributes'));
    }

    public function update(Request $request, $id)
    {
       
        try {

        DB::beginTransaction();

        $user = Auth::user();
        $helper = new Helpers;
        $item_data = $request->all();

            $item                                   = Item::findorfail($id);
            $item->item_category_id                 = $item_data['item_category_id'];
            $item->item_sub_category_id             = isset($item_data['item_sub_category_id']) && intval($item_data['item_sub_category_id']) > 0 ? $item_data['item_sub_category_id'] : null;
            $item->item_name                        = $item_data['item_name'];
            $item->unit_id                          = isset($item_data['unit_id']) ? $item_data['unit_id'] : null;
            $item->carton_size                      = isset($item_data['carton_unit']) ? $item_data['carton_unit'] : 0;
            $item->branch_id                        = $user->branch_id;
            $item->updated_by                       = $user->id;
            $item->updated_at                       = \Carbon\Carbon::now()->toDateTimeString();

        //    $multi_files=ItemMultiFile::where('id',$)
            
            if ($item->save()) {

           
                if (isset($item_data['sop_file']) && $item_data['sop_file'] != '') 
                {
                   foreach($item_data['sop_file'] as $sop_file)
                   {
                        // for multiple sop  files upload
    
                            $fileName = $sop_file->getClientOriginalName();

                            $destinationPath ='uploads/sopFiles/';
                            $destinationFile = $destinationPath . $fileName;
                            
                            if (File::exists($destinationFile)) {
                                $folderPath = public_path('uploads/sopFiles/');
                                $extension =pathinfo($fileName, PATHINFO_EXTENSION);
                                $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                             
                                $files = File::glob($folderPath . $fileName);
                               
                                if(count($files)>0)
                                {
                                   
                                    $timestamp = time();
                                    $dateTime = date('H-i-s', $timestamp);
                                    $final_file         =  $fileNameWithoutExtension. '_' .  time().'.'.$extension;
                                   
                                }
                            } else {
                                $final_file = $fileName;
                            }
                          
                           $success                    = $sop_file->move('uploads/sopFiles',  $final_file );
                         
                        if (isset($success)&& $success!= '') {
                            $item_multiple_file                   = new ItemMultipleFile;
                            $item_multiple_file->sop_file         = 'uploads/sopFiles/' . $final_file;
                            $item_multiple_file->item_id          = $item->id;
                            $item_multiple_file->created_by       = $user->id;
                            $item_multiple_file->updated_by       = $user->id;
                            $item_multiple_file->save();
                        
                        }
                   }
                }
        // design files upload
                if (isset($item_data['design_file']) && $item_data['design_file'] != '') 
                {
                        foreach($item_data['design_file'] as $design_files)
                        {
                                // for multiple sop and design files upload

                                $fileName = $design_files->getClientOriginalName();

                                $destinationPath ='uploads/designFiles/';
                                $destinationFile = $destinationPath . $fileName;
                                
                                if (File::exists($destinationFile)) {
                                    $folderPath = public_path('uploads/designFiles/');
                                    $extension =pathinfo($fileName, PATHINFO_EXTENSION);
                                    $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                                 
                                    $files = File::glob($folderPath . $fileName);
                                   
                                    if(count($files)>0)
                                    {
                                       
                                        $timestamp = time();
                                        $dateTime = date('H-i-s', $timestamp);
                                        $final_file         =  $fileNameWithoutExtension. '_' .  time().'.'.$extension;
                                       
                                    }
                                } else {
                                    $final_file = $fileName;
                                }
                                $success                    = $design_files->move('uploads/designFiles',  $final_file );
                            
                                if (isset($success)&& $success!= '') {
                                    $item_multiple_file                   = new ItemMultipleFile;
                                    $item_multiple_file->design_file      = 'uploads/designFiles/' . $final_file;
                                    $item_multiple_file->item_id          = $item->id;
                                    $item_multiple_file->created_by       = $user->id;
                                    $item_multiple_file->updated_by       = $user->id;

                                    $item_multiple_file->save();
                                
                                }
                        }
                }




                $item_attribute_val = ItemAttributeValues::where('item_id', $id)->delete();
                if(in_array(!'', $request->item_attributes_value)){
                    foreach($request->item_attributes_value as $key => $attribute_value_id){
                        $item_attribute_values[] = ItemAttributeValues::create([
                            'item_id'               => $item->id,
                            'attribute_values_id'   => $attribute_value_id,
                            'measurable'            => $item_data['measurable_attr'][$key],
                            'created_by'            => $user->id,
                            'updated_by'            => $user->id    
                        ]);
                    }
                }

                // if($helper->not_in_array_r('', $request->attribute) || $helper->not_in_array_r('', $request->attributes_value) || in_array(!'', $request->variation_name_id) || in_array(!'', $request->sku)){
                //     $item_var = ItemVariation::where('item_id', $item->id)->delete();
                //     foreach ($item_data['variation_name_id'] as $key => $variation) {
                //         $item_variation                             = new ItemVariation;
                //         $item_variation->variation_name             = $variation;
                //         $item_variation->variation_sales_rate       = isset($item_data['item_sales_rate'][$key]) ? $item_data['item_sales_rate'][$key] : null;
                //         $item_variation->variation_purchase_rate    = isset($item_data['item_purchase_rate'][$key]) ? $item_data['item_purchase_rate'][$key] : null;
                //         $item_variation->variation_about            = isset($item_data['item_about'][$key]) ? $item_data['item_about'][$key] : null;
                //         $item_variation->item_id                    = $item->id;
                //         $item_variation->carton_size                = $item_data['carton_size'][$key] == '' ? 0 : $item_data['carton_size'][$key];
                //         $item_variation->created_by                 = $user->id;
                //         $item_variation->updated_by                 = $user->id;
                //         $item_variation->created_at                 = \Carbon\Carbon::now()->toDateTimeString();
                //         $item_variation->updated_at                 = \Carbon\Carbon::now()->toDateTimeString();
    
                //         if ($item_variation->save()) {
                //             $item_variation->sku                        = strlen($item_data['sku'][$key] ?? 0) > 3 ? $item_data['sku'][$key] : str_pad($item->id, 6, 0, STR_PAD_LEFT) . '' . str_pad($item_variation->id, 6, 0, STR_PAD_LEFT);
                            
                //             foreach ($item_data['attribute'][$key] as $key1 => $value) {
                //                 ItemVariationAttributeValues::create([
                //                     'item_variation_id'     => $item_variation->id,
                //                     'attribute_values_id'   => $item_data['attributes_value'][$key][$key1],
                //                     'created_by'            => $user->id,
                //                     'updated_by'            => $user->id,
                //                     'created_at'            => Carbon::now()->toDateTimeString(),
                //                     'updated_at'            => Carbon::now()->toDateTimeString(),
                //                 ]);
                //             }
                //         }
                //         $item_variation->save();
                //     }
                // }
            }
            
            $item_variations                    = ItemVariation::where('item_id', $item->id)->get();

            if (strtolower($item->item_name) == strtolower($request->item_name) && $item->barcode_no == $request->barcode_no) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'item_category_id'          => 'required',
                    ]
                );
                if ($validator->fails()) {
                    return redirect::back()->withErrors($validator);
                }
            } else {
                if (strtolower($item->item_name) == strtolower($request->item_name)) {
                    if(in_array(!'', $request->attribute) || in_array(!'', $request->attributes_value) || in_array(!'', $request->sku)){
                        $validator = Validator::make(
                            $request->all(),
                            [
                                'item_category_id'          => 'required',
                                'attributes.*.*'            => 'required',
                                'attributes_value.*.*'      => 'required',
                                'variation_name_id.*'       => 'required',
                                'barcode_no'                => 'unique:item'
                            ]
                        );
                    }else{
                        $validator = Validator::make(
                            $request->all(),
                            [
                                'item_category_id'          => 'required',
                                'barcode_no'                => 'unique:item'
                            ]
                        );
                    }

                    if ($validator->fails()) {
                        return redirect::back()->withErrors($validator);
                    }
                } else if ($item->barcode_no == $request->barcode_no) {
                    if(in_array(!'', $request->attribute) || in_array(!'', $request->attributes_value) || in_array(!'', $request->variation_name_id) || in_array(!'', $request->sku)){
                        $validator = Validator::make(
                            $request->all(),
                            [
                                'item_name'                 => 'required',
                                'item_category_id'          => 'required',
                                'attributes.*.*'            => 'required',
                                'attributes_value.*.*'      => 'required',
                                'variation_name_id.*'       => 'required'
                            ]
                        );
                    }else{
                        $validator = Validator::make(
                            $request->all(),
                            [
                                'item_name'                 => 'required',
                                'item_category_id'          => 'required',
                            ]
                        );
                    }

                    if ($validator->fails()) {
                        return redirect::back()->withErrors($validator);
                    }
                }
            }

            if(!empty($request->variation_id)){
                foreach ($request->variation_id as $key => $variation) {
                    $test_variation = ItemVariation::find($variation);
                    $sku_match = ItemVariation::where('sku', $request->sku[$key])->first();
                    if ($variation != 0 && isset($test_variation) && isset($sku_match) && $sku_match->id != $test_variation->id) {
                        return redirect()
                            ->back()
                            ->with('alert.message', 'SKU used for ' . $request->variation_name_id[$key] . ' is already used for ' . ItemVariation::where('sku', $request->sku[$key])->first()->variation_name)
                            ->with('alert.status', 'danger');
                    }
                }                
            }
            DB::commit();
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Item Updated Successfully!');

            foreach (array_diff($item_variations->pluck('id')->toArray(), array_filter($request->variation_id)) as $key => $variation) {
                $delete_match = ItemVariation::find($variation);

                if (isset($delete_match) && (count($delete_match->billEntry) > 0 || count($delete_match->billFreeEntry) > 0)) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in purchase, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && count($delete_match->creditNoteEntry) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in sales return, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && count($delete_match->damageItems) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in damaged, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && (count($delete_match->depoSaleEntry) > 0 || count($delete_match->depoSaleFreeEntry) > 0)) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in depo sale, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && count($delete_match->estimateEntry) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in quotation, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && (count($delete_match->invoiceEntry) > 0 || count($delete_match->invoiceFreeEntry) > 0)) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in sales, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && (count($delete_match->manufactureEntry) > 0 || count($delete_match->manufacturePhaseDisburse) > 0) || count($delete_match->manufacturePhaseRawMaterials) > 0 || count($delete_match->manufacturePhaseReceiveFromFactory) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in manufacture, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && (count($delete_match->offerBaseItemVariation) > 0) || count($delete_match->offerFreeItemVariation) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in offer, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && count($delete_match->stockTransferEntry) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in stock transfer, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else if (isset($delete_match) && count($delete_match->vendorCreditEntry) > 0) {
                    return redirect()
                        ->back()
                        ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in purchase return, item variation cannot be removed')
                        ->with('alert.status', 'danger');
                } else {
                    $delete_match->itemVariationAttributeValues()->delete();
                    $delete_match->delete();
                }
            }

            $item_data = $request->all();
            $unit = !empty($item_data['unit_id']) ? Unit::where('id', $item_data['unit_id'])->first() : null;

            $item->item_category_id                 = $item_data['item_category_id'];
            $item->item_sub_category_id             = isset($item_data['item_sub_category_id']) && intval($item_data['item_sub_category_id']) > 0 ? $item_data['item_sub_category_id'] : null;
            $item->item_name                        = $item_data['item_name'];
            $item->unit_type                        = isset($item_data['unit_type']) ? $item_data['unit_type'] : null;
            $item->unit_id                          = !empty($unit->id) ? $unit->id : null;
            $item->basic_unit_conversion            = !empty($unit) ? $unit->basic_unit_conversion : null;
            $item->carton_size                      = isset($item_data['carton_unit']) ? $item_data['carton_unit'] : 0;
            $item->updated_by                       = Auth::user()->id;
            $item->updated_at                       = Carbon::now();

            if ($item->update()) {
                foreach ($item_data['variation_id'] as $key => $variation) {
                    if ($variation == 0) {
                        $item_variation                             = new ItemVariation;
                        $item_variation->variation_name             = $item_data['variation_name_id'][$key];
                        $item_variation->variation_sales_rate       = isset($item_data['item_sales_rate'][$key]) ? $item_data['item_sales_rate'][$key] : null;
                        $item_variation->variation_purchase_rate    = isset($item_data['item_purchase_rate'][$key]) ? $item_data['item_purchase_rate'][$key] : null;
                        $item_variation->variation_about            = isset($item_data['item_about'][$key]) ? $item_data['item_about'][$key] : null;
                        $item_variation->item_id                    = $item->id;
                        $item_variation->carton_size                = $item_data['carton_size'][$key] == '' ? 0 : $item_data['carton_size'][$key];
                        $item_variation->created_by                 = Auth::user()->id;
                        $item_variation->updated_by                 = Auth::user()->id;
                        $item_variation->created_at                 = \Carbon\Carbon::now()->toDateTimeString();
                        $item_variation->updated_at                 = \Carbon\Carbon::now()->toDateTimeString();
                        if ($item_variation->save()) {
                            $item_variation->sku = strlen($item_data['sku'][$key] ?? 0) > 3 ? $item_data['sku'][$key] : str_pad($item->id, 6, 0, STR_PAD_LEFT) . '' . str_pad($item_variation->id, 6, 0, STR_PAD_LEFT);
                            foreach ($item_data['attributes'][$key] as $key1 => $value) {
                                ItemVariationAttributeValues::create([
                                    'item_variation_id'     => $item_variation->id,
                                    'attribute_values_id'   => $item_data['attributes_value'][$key][$key1],
                                    'created_by'            => Auth::user()->id,
                                    'updated_by'            => Auth::user()->id,
                                    'created_at'            => Carbon::now()->toDateTimeString(),
                                    'updated_at'            => Carbon::now()->toDateTimeString(),
                                ]);
                            }
                            $item_variation->save();
                        }
                    } else {
                        $item_variation = ItemVariation::find($variation);
                        $item_variation->variation_name             = $item_data['variation_name_id'][$key];
                        $item_variation->sku                        = $item_data['sku'][$key];
                        $item_variation->variation_sales_rate       = isset($item_data['item_sales_rate'][$key]) ? $item_data['item_sales_rate'][$key] : null;
                        $item_variation->variation_purchase_rate    = isset($item_data['item_purchase_rate'][$key]) ? $item_data['item_purchase_rate'][$key] : null;
                        $item_variation->variation_about            = isset($item_data['item_about'][$key]) ? $item_data['item_about'][$key] : null;
                        $item_variation->carton_size                = $item_data['carton_size'][$key] == '' ? 0 : $item_data['carton_size'][$key];
                        $item_variation->updated_by                 = Auth::user()->id;
                        $item_variation->updated_at                 = Carbon::now();
                        $item_variation->update();
                        $item_variation->itemVariationAttributeValues()->delete();
                        foreach ($item_data['attributes'][$key] as $key1 => $value) {
                            ItemVariationAttributeValues::create([
                                'item_variation_id'     => $item_variation->id,
                                'attribute_values_id'   => $item_data['attributes_value'][$key][$key1],
                                'created_by'            => Auth::user()->id,
                                'updated_by'            => Auth::user()->id,
                                'created_at'            => $item->created_at,
                                'updated_at'            => date('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                }

                DB::commit();
                return redirect()
                    ->route('inventory')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Item Updated Successfully!');
            } else {
                DB::rollback();
                return redirect()
                    ->route('inventory', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->route('inventory', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Reason: '.$e);
        }
    }
    function getUniqueSuffixedFileName($filePath, $suffix = 1)
    {
        if (File::exists($filePath)) {
            $directory = pathinfo($filePath, PATHINFO_DIRNAME);
            $filename = pathinfo($filePath, PATHINFO_FILENAME);
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    
            $suffixedFileName = $filename . '_' . $suffix . '.' . $extension;
            $suffixedFilePath = $directory . '/' . $suffixedFileName;
    
            return getUniqueSuffixedFileName($suffixedFilePath, $suffix + 1);
        }
    
        return $filePath;
    }
    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $item                               = Item::findorfail($id);
    //         $item_variations                    = ItemVariation::where('item_id', $item->id)->get();
    //         $item_variations_attribute_values   = ItemVariationAttributeValues::whereIn('item_variation_id', $item_variations->pluck('id')->toArray())->get();

    //         $item_variations_attribute_values->each(function ($item_variations_attribute_values) {
    //             $item_variations_attribute_values->delete();
    //         });
    //         $item_variations->each(function ($item_variation) {
    //             $item_variation->delete();
    //         });

    //         if (strtolower($item->item_name) == strtolower($request->item_name) && $item->barcode_no == $request->barcode_no) {
    //             $validator = Validator::make(
    //                 $request->all(),
    //                 [
    //                     'item_category_id'          => 'required',
    //                     'attributes.*.*'            => 'required',
    //                     'attributes_value.*.*'      => 'required',
    //                     'variation_name_id.*'       => 'required',
    //                     'sku.*'                     => 'unique:item_variations,sku'
    //                 ],
    //                 [
    //                     'sku.*.required'            => 'SKU is required',
    //                     'sku.*.unique'              => 'This SKU already exists'
    //                 ]
    //             );

    //             if ($validator->fails()) {
    //                 return redirect::back()->withErrors($validator);
    //             }
    //         } else {
    //             if (strtolower($item->item_name) == strtolower($request->item_name)) {
    //                 $validator = Validator::make(
    //                     $request->all(),
    //                     [
    //                         'item_category_id'          => 'required',
    //                         'attributes.*.*'            => 'required',
    //                         'attributes_value.*.*'      => 'required',
    //                         'variation_name_id.*'       => 'required',
    //                         'barcode_no'                => 'unique:item',
    //                         'sku.*'                     => 'unique:item_variations,sku'
    //                     ],
    //                     [
    //                         'sku.*.required'            => 'SKU is required',
    //                         'sku.*.unique'              => 'This SKU already exists'
    //                     ]
    //                 );

    //                 if ($validator->fails()) {
    //                     return redirect::back()->withErrors($validator);
    //                 }
    //             } else if ($item->barcode_no == $request->barcode_no) {
    //                 $validator = Validator::make(
    //                     $request->all(),
    //                     [
    //                         'item_name'                 => 'required',
    //                         'item_category_id'          => 'required',
    //                         'attributes.*.*'            => 'required',
    //                         'attributes_value.*.*'      => 'required',
    //                         'variation_name_id.*'       => 'required',
    //                         'sku.*'                     => 'unique:item_variations,sku'
    //                     ],
    //                     [
    //                         'sku.*.required'            => 'SKU is required',
    //                         'sku.*.unique'              => 'This SKU already exists'
    //                     ]
    //                 );

    //                 if ($validator->fails()) {
    //                     return redirect::back()->withErrors($validator);
    //                 }
    //             }
    //         }

    //         $item_data = $request->all();

    //         $item->item_category_id                 = $item_data['item_category_id'];
    //         $item->item_sub_category_id             = isset($item_data['item_sub_category_id']) && intval($item_data['item_sub_category_id']) > 0 ? $item_data['item_sub_category_id'] : null;
    //         $item->item_name                        = $item_data['item_name'];
    //         $item->unit_type                        = isset($item_data['unit_type']) ? $item_data['unit_type'] : null;
    //         $item->carton_size                      = isset($item_data['carton_unit']) ? $item_data['carton_unit'] : 0;
    //         $item->updated_by                       = Auth::user()->id;
    //         $item->updated_at                       = Carbon::now();

    //         if ($item->update()) {
    //             foreach ($item_data['variation_name_id'] as $key => $variation) {
    //                 $item_variation                             = new ItemVariation;
    //                 $item_variation->variation_name             = $variation;
    //                 $item_variation->variation_sales_rate       = isset($item_data['item_sales_rate'][$key]) ? $item_data['item_sales_rate'][$key] : null;
    //                 $item_variation->variation_purchase_rate    = isset($item_data['item_purchase_rate'][$key]) ? $item_data['item_purchase_rate'][$key] : null;
    //                 $item_variation->variation_about            = isset($item_data['item_about'][$key]) ? $item_data['item_about'][$key] : null;
    //                 $item_variation->item_id                    = $item->id;
    //                 $item_variation->carton_size                = $item_data['carton_size'][$key] == '' ? 0 : $item_data['carton_size'][$key];
    //                 $item_variation->sku                        = $item_data['sku'][$key] ?? null;
    //                 $item_variation->created_by                 = Auth::user()->id;
    //                 $item_variation->updated_by                 = Auth::user()->id;
    //                 $item_variation->created_at                 = $item->created_at;
    //                 $item_variation->updated_at                 = \Carbon\Carbon::now()->toDateTimeString();

    //                 if ($item_variation->save()) {
    //                     $item_variation->sku  = strlen($item_data['sku'][$key] ?? 0) > 3 ? $item_data['sku'][$key] : str_pad($item->id, 6, 0, STR_PAD_LEFT) . '' . str_pad($item_variation->id, 6, 0, STR_PAD_LEFT);
    //                     foreach ($item_data['attributes'][$key] as $key1 => $value) {
    //                         ItemVariationAttributeValues::create([
    //                             'item_variation_id'     => $item_variation->id,
    //                             'attribute_values_id'   => $item_data['attributes_value'][$key][$key1],
    //                             'created_by'            => Auth::user()->id,
    //                             'updated_by'            => Auth::user()->id,
    //                             'created_at'            => $item->created_at,
    //                             'updated_at'            => \Carbon\Carbon::now()->toDateTimeString(),
    //                         ]);
    //                     }
    //                     $item_variation->save();
    //                 }
    //             }

    //             DB::commit();
    //             return redirect()
    //                 ->route('inventory')
    //                 ->with('alert.status', 'success')
    //                 ->with('alert.message', 'Item Updated Successfully!');
    //         } else {
    //             DB::rollback();
    //             return redirect()
    //                 ->route('inventory', ['id' => $id])
    //                 ->with('alert.status', 'danger')
    //                 ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
    //         }
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         dd($e);
    //         return redirect()
    //             ->route('inventory', ['id' => $id])
    //             ->with('alert.status', 'danger')
    //             ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
    //     }
    // }
     // multi file delete

     public function itemMultiFileDestroy($id)
     {
        try {

        DB::beginTransaction();
        $multifile=ItemMultipleFile::where('id',$id)->first();
        if( $multifile->sop_file)
        {
                $delete_path = public_path($multifile->sop_file);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
        }
        if( $multifile->design_file)
        {
                $delete_path = public_path($multifile->design_file);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
        }
        $multifile->delete();
      
        DB::commit();
        return redirect()
            ->back()
            ->with('alert.status', 'success')
            ->with('alert.message', 'File Deleted Successfully!');
        }
        catch (Exception $e) {  
            dd($e) ;
                DB::rollback();
                return redirect()
                    ->route('inventory', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Reason: '.$e);
        }

     }
    public function destroy($id)
    {
        $item = Item::find($id);

        foreach ($item->itemVariations as $key => $delete_match) {

            if (isset($delete_match) && (count($delete_match->billEntry) > 0 || count($delete_match->billFreeEntry) > 0)) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in purchase, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && count($delete_match->creditNoteEntry) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in sales return, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && count($delete_match->damageItems) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in damaged, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && (count($delete_match->depoSaleEntry) > 0 || count($delete_match->depoSaleFreeEntry) > 0)) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in depo sale, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && count($delete_match->estimateEntry) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in quotation, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && (count($delete_match->invoiceEntry) > 0 || count($delete_match->invoiceFreeEntry) > 0)) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in sales, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && (count($delete_match->manufactureEntry) > 0 || count($delete_match->manufacturePhaseDisburse) > 0) || count($delete_match->manufacturePhaseRawMaterials) > 0 || count($delete_match->manufacturePhaseReceiveFromFactory) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in manufacture, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && (count($delete_match->offerBaseItemVariation) > 0) || count($delete_match->offerFreeItemVariation) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in offer, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else if (isset($delete_match) && count($delete_match->vendorCreditEntry) > 0) {
                return redirect()
                    ->back()
                    ->with('alert.message', 'Variation ' . $delete_match->variation_name . ' is already used in purchase return, item variation cannot be removed')
                    ->with('alert.status', 'danger');
            } else {
                $delete_match->itemVariationAttributeValues()->delete();
                $delete_match->delete();
            }
        }

        if ($item->invoiceEntries->count() > 0 || $item->invoiceFreeEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in invoice. You can not delete this item.');
        }

        if ($item->billEntries->count() > 0 || $item->billFreeEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in bill. You can not delete this item.');
        }

        if ($item->itemOffers->count() > 0 || $item->itemFreeOffers->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in offers. You can not delete this item.');
        }

        if ($item->creditNoteEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in sales return. You can not delete this item.');
        }

        if($item->vendorCreditEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in purchase return. You can not delete this item.');
        }

        if ($item->damage->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in damage items. You can not delete this item.');
        }

        if ($item->depoSaleEntries->count() > 0 || $item->depoSalesFreeEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in depo sales. You can not delete this item.');
        }

        if ($item->estimateEntries->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in estimate. You can not delete this item.');
        }

        if ($item->manufactureEntries->count() > 0 || $item->manufacturePhaseDisburse->count() > 0 || $item->manufacturePhaseReceiveFromFactory->count() > 0 || $item->manufacturePhaseRawMaterial->count() > 0) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in manufacture. You can not delete this item.');
        }

        if ($item->stockTransfer->count() > 0){
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in stock transfer. You can not delete this item.');
        }

        $item_variations                    = ItemVariation::where('item_id', $item->id)->get();
        $item_variations_attribute_values   = ItemVariationAttributeValues::whereIn('item_variation_id', $item_variations->pluck('id')->toArray())->get();
        $item_multifiles                    = ItemMultipleFile::where('item_id', $item->id)->get();

        $item_variations_attribute_values->each(function ($item_variations_attribute_values) {
            $item_variations_attribute_values->delete();
        });

        $item_variations->each(function ($item_variation) {
            $item_variation->delete();
        });

        foreach($item_multifiles  as $file )
        {
        $multifile=ItemMultipleFile::where('id',$file->id)->first();
        if( $multifile->sop_file)
        {
                $delete_path = public_path($multifile->sop_file);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
        }
        if( $multifile->design_file)
        {
                $delete_path = public_path($multifile->design_file);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
        }
       }
        $multifile->delete();
        $item_multifiles->each(function ($item_multifile) {
            $item_multifile->delete();
        });


        if ($item->delete()) {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Item Deleted Successfully!');
        } else {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }

    public function apiAllAsset(Request $request)
    {
        try {

            $branch    = Branch::find(isset($_GET['branch_id']) ? $_GET['branch_id'] : Auth::user()->branch_id);
            $branch_id = session('branch_id');
            $op        = OrganizationProfile::findOrFail(1);

            if ($op->show_all_item == 1 || $branch_id == 1) {
                $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                    ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                    ->leftjoin('users', 'users.id', '=', 'item.created_by')
                    ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                    ->select(
                        "item.created_at",
                        "item.id",
                        "item.item_category_id",
                        "item.subject_name",
                        "item_sales_rate",
                        "item_purchase_rate",
                        "item_category.item_category_name as item_category_name",
                        "item.barcode_no",
                        "item_sub_category.item_sub_category_name as item_sub_category_name",
                        "item.item_name as item_name",
                        "branch.branch_name"
                    )
                    ->where('item.item_category_id', 3)
                    ->get();
            } else {
                if ($branch_id) {
                    $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                        ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                        ->leftjoin('users', 'users.id', '=', 'item.created_by')
                        ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                        ->select(
                            "item.created_at",
                            "item.id",
                            "item.item_category_id",
                            "item.subject_name",
                            "item_sales_rate",
                            "item_purchase_rate",
                            "item_category.item_category_name as item_category_name",
                            "item.barcode_no",
                            "item_sub_category.item_sub_category_name as item_sub_category_name",
                            "item.item_name as item_name",
                            "branch.branch_name"
                        )
                        ->where('item.branch_id', $branch_id)
                        ->where('item.item_category_id', 3)
                        ->get();
                }
            }

            if ($items) {
                foreach ($items as $value) {
                    $value->format_created_at = date("d-m-Y", strtotime($value->created_at));
                    $value->barcode_no        = $value->barcode_no;
                }
            }

            return response($items);
        } catch (\Exception $exception) {

            return response([]);
        }
    }

    public function apiFindAsset(Request $request)
    {

        $branch    = Branch::find(isset($_GET['branch_id']) ? $_GET['branch_id'] : Auth::user()->branch_id);
        $branch_id = session('branch_id');

        try {

            $branch_id = session('branch_id');

            $items = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                ->leftjoin("item_sub_category", "item_sub_category.id", "item.item_sub_category_id")
                ->leftjoin('users', 'users.id', '=', 'item.created_by')
                ->leftjoin('branch', 'branch.id', '=', 'users.branch_id')
                ->select("item.created_at", "item.id", "item.item_category_id", "item.subject_name", "item_sales_rate", "item_purchase_rate", "item_category.item_category_name as item_category_name", "item_sub_category.item_sub_category_name as item_sub_category_name", "item.item_name as item_name", "branch.branch_name")
                ->where('item.item_name', "like", "%$request->name%")
                ->where('item.item_category_id', 3)
                ->get();



            foreach ($items as $value) {
                $value->format_created_at = date("d-m-Y", strtotime($value->created_at));
            }

            return response($items);
        } catch (\Exception $exception) {

            return response([]);
        }
    }

    public function asset_index()
    {
        $branch_id  = session('branch_id');

        $op         = OrganizationProfile::findOrFail(1);

        if ($op->show_all_item == 1 || $branch_id == 1) {
            $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                ->select(
                    "item.id",
                    "item.item_category_id",
                    "item.reorder_point",
                    "item_category.item_category_name as item_category_name",
                    "item.item_name as item_name",
                    "item.total_purchases",
                    "item.total_sales",
                    "item.total_purchases"
                )
                ->where('item_category_id', 3)
                ->get();

            $item_categories       = ItemCategory::select("item_category_name", 'id', 'created_by')->get();
        } else {
            if ($branch_id) {
                $items                  = Item::leftjoin("item_category", "item_category.id", "item.item_category_id")
                    ->where('item.branch_id', $branch_id)
                    ->select(
                        "item.id",
                        "item.item_category_id",
                        "item.reorder_point",
                        "item_category.item_category_name as item_category_name",
                        "item.item_name as item_name",
                        "item.total_purchases",
                        "item.total_sales",
                        "item.total_purchases"
                    )
                    ->where('item_category_id', 3)
                    ->get();

                $item_categories       = ItemCategory::select("item_category_name", 'id', 'created_by')
                    ->where('branch_id', $branch_id)
                    ->get();
            }
        }

        $current_time          = Carbon::now()->toDayDateTimeString();
        $start                 = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                   = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        // $stock_report          = route("report_stock_details_item",["id"=>'new_id',"start"=>$start,'end'=>$end]);
        // $item_report           = route("report_account_item_details",["id"=>'new_id',"start"=>$start,'end'=>$end]);


        return view('inventory::asset.index', compact('items', 'item_categories'));
    }

    public function asset_create(Request $request)
    {
        // $branch_id = Auth::user()->brach_id;
        $branch_id = session('branch_id');

        $item_categories                = ItemCategory::all();
        $item_sub_categories            = ItemSubCategory::all();

        $accounts                       = Account::all();
        $branches                       = Branch::all();
        $taxs                           = Tax::all();
        $company                        = [];
        $confirmation_id                = null;
        $order_id                       = null;

        if ($request->confirmation) {
            $confirmation_id            = $request->confirmation;
        }
        if ($request->order) {
            $order_id                   = $request->order;
        }

        return view('inventory::asset.create', compact('company', 'item_categories', 'item_sub_categories', 'accounts', 'branches', 'taxs', 'confirmation_id', 'order_id'));
    }

    public function asset_store(Request $request)
    {

        $item_data = $request->all();

        try {

            $validator = Validator::make($request->all(), [
                'item_name'                 => 'required|unique:item',
            ]);
            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            if (isset($item_data['barcode_no']) && Item::where('barcode_no', $item_data['barcode_no'])->first()) {
                return redirect()
                    ->back()
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'The barcode has already been taken!');
            }

            $item                                   = new Item;
            $item->item_name                        = $item_data['item_name'];
            $item->item_about                       = $item_data['item_about'];
            $item->item_sales_rate                  = $item_data['item_sales_rate'];
            $item->item_purchase_rate               = $item_data['item_purchase_rate'];
            $item->unit_type                        = $item_data['unit_type'];
            $item->item_category_id                 = 3;
            $item->item_sub_category_id             = null;
            $item->branch_id                        = Auth::user()->branch_id;
            $item->created_by                       = Auth::user()->id;
            $item->updated_by                       = Auth::user()->id;

            if ($item->save()) {

                $item->barcode_no                = strlen($item_data['barcode_no']) > 3 ? $item_data['barcode_no'] : str_pad($item->id, 6, 0, STR_PAD_LEFT);
                $item->save();

                if (!empty($request->confirmation_id)) {
                    return redirect()
                        ->route('confirmation_edit', $request->confirmation_id)
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Item Added Successfully!');
                }
                if (!empty($request->order_id)) {
                    return redirect()
                        ->route('confirmation_create', $request->order_id)
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Item Added Successfully!');
                }
                return redirect()
                    ->route('asset')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Asset Added Successfully!');
            } else {

                throw new \Exception("Something Went Wrong");
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('asset')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function asset_edit($id)
    {
        $item                           = Item::find($id);

        return view('inventory::asset.edit', compact('item'));
    }

    public function asset_update(Request $request, $id)
    {

        if (Item::where('id', '!=', $id)->where('barcode_no', $request['barcode_no'])->first()) {
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'The barcode has already been taken!');
        }

        $items = Item::find($id);

        $validator = Validator::make($request->all(), [
            'item_name'                 => 'required'
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        try {

            $item_data = $request->all();
            $updated_by = Auth::user()->id;

            $item = Item::find($id);

            $item->item_name                 = $item_data['item_name'];
            $item->barcode_no                = strlen($item_data['barcode_no']) > 3 ? $item_data['barcode_no'] : str_pad($item->id, 6, 0, STR_PAD_LEFT);
            $item->item_about                = $item_data['item_about'];
            $item->item_sales_rate           = $item_data['item_sales_rate'];
            $item->item_purchase_rate        = $item_data['item_purchase_rate'];
            $item->unit_type                 = $item_data['unit_type'];
            $item->item_category_id          = 3;
            $item->item_sub_category_id      = null;
            $item->updated_by                = $updated_by;


            if ($item->update()) {
                return redirect()
                    ->route('asset', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Asset Updated Successfully!');
            } else {
                return redirect()
                    ->route('asset', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        } catch (Exception $e) {
            return redirect()
                ->route('asset', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function asset_destroy($id)
    {
        $item = Item::find($id);

        if ($item->delete()) {
            return redirect()
                ->route('asset')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Asset Deleted Successfully!');
        } else {
            return redirect()
                ->route('asset')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function damage_index()
    {
        $damage_items = DamageItem::all();

        return view('inventory::damage.index', compact('damage_items'));
    }

    public function damage_create()
    {
        $vendors            = Contact::where('contact_category_id', 4)->get();
        $items              = Item::all();
        $attributes         = Attributes::all();
        $item_variations    = ItemVariation::all();
        $units = Unit::get();

        return view('inventory::damage.create', compact('items', 'attributes', 'item_variations', 'vendors', 'units'));
    }

    public function damage_store(Request $request)
    {
        //  dd($request->unit_id);
        $validator = Validator::make($request->all(), [
            'item_id'                   => 'required',
            'quantity_ctn'              => 'required | numeric',
            'quantity_pcs'              => 'required | numeric',
            'date'                      => 'required',
            'vendor_id'                 => 'required',

        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            $helper = new \App\Lib\Helpers;
            $unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();
            $damage_item = DamageItem::create([

                'date'                      => date('Y-m-d', strtotime($request->date)),
                'item_id'                   => $request->item_id,
                'variation_id'              => empty($request->selected_variation) ? null : $request->selected_variation,
                'quantity'                  => $helper->unitQuantity($request->quantity_pcs, $unit->basic_unit_conversion),
                'unit_id'                   => $request->unit_id,
                'basic_unit_conversion'     => $unit->basic_unit_conversion,
                'vendor_id'                 => $request->vendor_id,
                'note'                      => $request->note == '' ? null : $request->note,
                'created_by'                => Auth::user()->id,
                'updated_by'                => Auth::user()->id,
                'created_at'                => Carbon::now(),
                'updated_at'                => Carbon::now(),
            ]);


            DB::commit();

            return redirect()
                ->route('damage')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Damage Item Added Successfully!');
        } catch (Exception $e) {
            dd($e);
            return redirect()
                ->route('damage_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function damage_edit($id)
    {
        $damage                             = DamageItem::find($id);
        $vendors                            = Contact::where('contact_category_id', 4)->get();
        $items                              = Item::all();
        $attributes                         = Attributes::all();
        $item_variations                    = ItemVariation::all();
        $units = Unit::get();

        return view('inventory::damage.edit', compact('damage', 'items', 'attributes', 'item_variations', 'vendors', 'units'));
    }

    public function damage_update(Request $request, $id)
    {

        $damage_item = DamageItem::find($id);

        $validator = Validator::make($request->all(), [
            'item_id'                   => 'required',
            'quantity_ctn'              => 'required | numeric',
            'quantity_pcs'              => 'required | numeric',
            'date'                      => 'required',
            'vendor_id'                 => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            $helper = new \App\Lib\Helpers;
            $unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();

            $damage_item->date                      = date('Y-m-d', strtotime($request->date));
            $damage_item->item_id                   = $request->item_id;
            $damage_item->variation_id              = empty($request->selected_variation) ? null : $request->selected_variation;
            $damage_item->quantity                  = $helper->unitQuantity($request->quantity_pcs, $unit->basic_unit_conversion);
            $damage_item->unit_id                   = $request->unit_id;
            $damage_item->basic_unit_conversion     = $unit->basic_unit_conversion;
            $damage_item->vendor_id                 = $request->vendor_id;
            $damage_item->note                      = $request->note == '' ? null : $request->note;;
            $damage_item->updated_by                = Auth::user()->id;
            $damage_item->updated_at                = Carbon::now();

            $damage_item->update();

            DB::commit();

            return redirect()
                ->route('damage')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Damage Item Updated Successfully!');
        } catch (Exception $e) {
            return redirect()
                ->route('damage_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function damage_destroy($id)
    {
        $damage_item = DamageItem::find($id);

        if ($damage_item->delete()) {
            return redirect()
                ->route('damage')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Damage Item Deleted Successfully!');
        } else {
            return redirect()
                ->route('damage')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        $branch_users = User::where('branch_id', $this->branch_id)->get();

        if (isset($branch_users)) {

            foreach ($branch_users as $users) {
                $tmp_targeted_users[] = $users->id;
            }
        } else {

            $tmp_targeted_users = [];
        }

        $this->targeted_users = $tmp_targeted_users;
    }

    public function barcode($id)
    {
        $item = Item::find($id);
        return view('inventory::inventory.Ajax.barcode', compact('item'));
    }

    public function barcodeGenerate($id, Request $request)
    {
        $item = Item::find($id);
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = '';
        for ($i = 0; $i < $request->barcode_amount; $i++) {
            $barcodes .= '<div style="padding: 4px; display: inline-block; font-size: 12px; margin: 2px; width: 136px; height: 88px;">';
            $barcodes .= '<div class="barcode">' . $generator->getBarcode($request->barcode_code, $generator::TYPE_CODE_128, 2, 64) . '</div>';
            $barcodes .= '<center style="margin-top: 5px;"><b>' . STR::limit($item->item_name, 30) . '</b></center>';
            $barcodes .= '<div style="float: left; font-size: 12px;"><b><span style="font-size: 8px;">Code:</span> ' . $request->barcode_code . '</b></div>';
            $barcodes .= '<div style="float: right; font-size: 12px;"><b><span style="font-size: 8px;">Price:</span> ' . number_format($item->item_sales_rate, '2', '.', ',') . '</b></div>';
            $barcodes .= '</div>';

            if (($i + 1) % 2 == 0) $barcodes .= '<br>';
        }

        return back()->with('barcodes', $barcodes);
    }

    public function excel_import()
    {
        return view('inventory::inventory.excel.index');
    }

    public function excel_demo($filename)
    {
        $path = public_path() . '/excel/' . $filename;

        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function excel_upload(Request $request)
    {
        DB::beginTransaction();

        try {
            $filepath       = $request->upload_excel;
            $import         = new MenuImport;
            $data           = $import->import($filepath);

            if ($data == []) {
                return redirect()
                    ->back()
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Failed to import inventory! Please try again.');
            }

            DB::commit();
            return redirect()
                ->back()
                ->with('alert.message', 'Inventory imported successfully!')
                ->with('alert.status', 'success');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Failed to import inventory! Please try again.');
        }
    }

    public function bulk_edit()
    {
        $branch_id  = session('branch_id');

        $op         = OrganizationProfile::findOrFail(1);

        if ($op->show_all_item == 1 || $branch_id == 1) {
            $items                  = Item::orderBy('id', 'DESC')->get();
        } else {
            if ($branch_id) {
                $items              = Item::where('branch_id', $branch_id)
                    ->orderBy('item_name', 'ASC')
                    ->get();
            }
        }

        return view('inventory::inventory.bulk_edit.edit', compact('items'));
    }

    public function bulk_edit_update(Request $request)
    {
        $duplicates = [];
        $barcode_no = $request->barcode_no;

        foreach ($request->item_id as $key => $value) {
            $item                       = Item::findOrFail($value);

            $item->item_name            = $request->item_name[$value];
            $item->item_sales_rate      = $request->item_sales_rate[$value];
            $item->item_purchase_rate   = $request->item_purchase_rate[$value];

            if (strlen($barcode_no) > 3) {
                $item->barcode_no       = $barcode_no[$value];
            }

            // $barcode_no[$item->id] = false;
            // if (in_array($item->barcode_no, $barcode_no) && strlen($item->barcode_no) > 0) {
            //     // $duplicates[$item->id] = true;
            //     $barcode_no[$item->id] = $item->barcode_no;
            //     continue;
            // }

            $item->save();
        }

        // if (count($duplicates) > 0) {
        //     return redirect()->back()->with('duplicates', $duplicates)
        //             ->with('alert.status', 'danger')
        //             ->with('alert.message', 'Barcodes must have to be unique!');;
        // }

        return redirect()
            ->back()
            ->with('alert.status', 'success')
            ->with('alert.message', 'Inventory updated Successfully!');
    }

    public function bulk_edit_update_single(Request $request)
    {
        try {
            $barcode_no                 = $request->barcode_no;

            $item                       = Item::findOrFail($request->item_id);

            $item->item_name            = $request->item_name;
            $item->item_sales_rate      = $request->item_sales_rate;
            $item->item_purchase_rate   = $request->item_purchase_rate;

            if (strlen($barcode_no) > 3) {
                $item->barcode_no   = $barcode_no;
            }

            $item->save();

            return 'Updated Successfully.';
        } catch (Exception $e) {
            return 'Please try again.';
        }
    }

    public function checkVariation($id)
    {
        $item_variations = ItemVariation::where('item_id', $id)->get();
        $item_variation_ids = $item_variations->pluck('id')->toArray();
        $item_variation_attribute_values = ItemVariationAttributeValues::whereIn('item_variation_id', $item_variation_ids)->get()->groupBy('item_variation_id');
        $attributes = Attributes::all()->pluck('name', 'id')->toArray();
        $attribute_values = [];
        foreach (AttributeValues::all() as $value) {
            $attribute_values[$value->id]['value'] = $value->value;
            $attribute_values[$value->id]['attribute_id'] = $value->attribute_id;
        }
        if (count($item_variations) > 0) {
            return response()->json(['success' => 'Variations exist', 'variations'   =>  $item_variations, 'variation_attribute_values' => $item_variation_attribute_values, 'attributes' => $attributes, 'attribute_values' => $attribute_values]);
        } else {
            return response()->json(['error' => 'Variations does not exist'], 404);
        }
    }

    public function getItem($id)
    {
        try {
            $item = Item::findOrFail($id);
            return response()->json(['success' => 'Item found', 'item' => $item]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Item not found']);
        }
    }

    public function getOtherItems($id)
    {
        $items = Item::where('id', '!=', $id)->get();
        return response()->json(['success' => 'Items found', 'items' => $items]);
    }

    public function syncAllProducts()
    {
        $user = Auth::user();
        $count = 0;
        $graphqlEndpoint = env("graphql_endpoint");

        $query = 'query {
            allProducts {
                id,
                name,
                code,
                description,
                unitPrice,
                discountPercentage,
                images
                {
                    img
                }
            }
        }';

        $client = new Client();

        try {
            $response = $client->get($graphqlEndpoint, [
                'json' => ['query' => $query],
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            $products = $data['data']['allProducts'];
            foreach ($products as $product) {
                $item = Item::where('ecom_id', $product['id'])->orWhere('ecom_code', $product['code'])->first();
                if(empty($item))
                {
                    $item = new Item;
                    $item->barcode_no           = str_pad($item->id, 6, 0, STR_PAD_LEFT);
                    $item->ecom_id              = $product['id'];
                    $item->ecom_code            = $product['code'];
                    $item->item_name            = $product['name'];
                    $item->item_about           = $product['description'];
                    $item->item_sales_rate      = $product['unitPrice'];
                    $item->discount_percentage  = $product['discountPercentage'];
                    $item->item_image_url       = !empty($product['images'][0]['img']) ? $product['images'][0]['img'] : null;
                    $item->unit_id              = 2; // UNIT IS PCS
                    $item->item_category_id     = 4; // CATEGORY IS BY DEFAULT INITIALLY
                    $item->branch_id            = $user->branch_id;
                    $item->created_by           = $user->id;
                    $item->updated_by           = $user->id;
                    $item->created_at           = \Carbon\Carbon::now()->toDateTimeString();
                    $item->updated_at           = \Carbon\Carbon::now()->toDateTimeString();
                    $item->save();
                    $item->barcode_no           = str_pad($item->id, 6, 0, STR_PAD_LEFT);
                    $item->save();

                    $count++;
                }
            }
            
            return redirect()
            ->route('inventory')
            ->with('alert.status', 'success')
            ->with('alert.message', $count.' Items Synced from Ecommerce.');

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return redirect()
            ->route('inventory')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Facing Problem Syncing Items from Ecommerce! Problem: '.$e);
        }
    }

    public function rafidTest()
    {
        $graphqlEndpoint = env("graphql_endpoint");

        $query = 'query {
            allProducts {
                id,
                name,
                code,
                description,
                seoName,
                unitPrice,
                discountPercentage,
                isAvailable,
                isDesignApproved,
                stockCount,
                meta
            }
        }';

        $client = new Client();

        try {
            $response = $client->get($graphqlEndpoint, [
                'json' => ['query' => $query],
            ]);
            
            $data = json_decode($response->getBody(), true);
            dd($data['data']['allProducts']);

            // Process the data as needed.
            // For example, you can access the customers' names and usernames as follows:
            $customers = $data['data']['customers'];
            foreach ($customers as $customer) {
                $name = $customer['name'];
                $username = $customer['user']['username'];
                // Do something with the name and username...
            }

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            // Handle any errors that occurred during the API request.
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $items = Item::get();
        return response()->json(['success' => 'Items found', 'items' => $items]);
    }
}
