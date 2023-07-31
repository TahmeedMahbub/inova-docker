<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Contact\Agent;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use Carbon\Carbon;
use DateTime;
use DB;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\Inventory\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{ 
    public function index()
    {
      $OrganizationProfile    = OrganizationProfile::find(1);
      $current_time           = Carbon::now()->toDayDateTimeString();
      $start                  = isset($_GET['from']) ? $_GET['from'] : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
      $end                    = isset($_GET['to']) ? $_GET['to'] : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

      $project_id             = isset($_GET['project_id']) ? $_GET['project_id'] : 0;
      $final_project_id       = isset($_GET['final_project_id']) ? $_GET['final_project_id'] : 0;
      $raw_material_id        = isset($_GET['raw_material_id']) ? $_GET['raw_material_id'] : 0;

      $project_name           = Product::find($project_id);
      $final_project_name     = Product::find($final_project_id);
      $raw_material_name      = Item::find($raw_material_id);

      $issue_raw_material     = Item::all();
      
      $product                = Product::where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '>=', $start)
                                                      ->where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '<=', $end)
                                                      ->join('item','product.product_name','item.id')
                                                      ->when($project_id != 0,function($query) use ($project_id){
                                                          return $query->where('product.id', $project_id);
                                                      })
                                                      ->when($final_project_id != 0,function($query) use ($final_project_id){
                                                          return $query->where('product.id', $final_project_id);
                                                      })
                                                      ->selectRaw('product.*,item.item_name')
                                                      ->get()
                                                      ->toArray();
     
      $projects = Product::where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '>=', $start)
                                                      ->where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '<=', $end)
                                                      ->join('item','product.product_name','item.id')
                                                      ->whereNull('item_add')
                                                      ->selectRaw('product.*,item.item_name')
                                                      ->get()
                                                      ->toArray();

      $products = Product::where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '>=', $start)
                                                      ->where(DB::Raw('STR_TO_DATE(product.created_at, "%Y-%m-%d")'), '<=', $end)
                                                      ->join('item','product.product_name','item.id')
                                                      ->where('item_add', 1)
                                                      ->selectRaw('product.*,item.item_name')
                                                      ->get()
                                                      ->toArray();


      $phases                 = ProductPhase::all();
      $all                    = $product;
      $all_items              = Item::all();

      foreach ($all as $key => $value)
      {   
          $product_phases     = $phases->where('product_id', $value['id'])->toArray();
          $item_name          = $all_items->where('id', $value['product_name'])->first();

          $data[$value['id']]['product_id']        = $item_name['id'];
          $data[$value['id']]['product_id_date']   = $value['id'];
          $data[$value['id']]['product_name']      = $item_name['item_name'];
          $data[$value['id']]['product_phase']     = $product_phases;
      }

      if (!empty($data))
      {
        $data = array_values($data);
      }else{
        $data = '';
      }
      

      return view('report::project.index',compact( 'start', 'end', 'issue_raw_material', 'OrganizationProfile', 'products', 'projects', 'data', 'project_id', 'project_name', 'final_project_id', 'final_project_name', 'raw_material_id', 'raw_material_name'));
    }
}
