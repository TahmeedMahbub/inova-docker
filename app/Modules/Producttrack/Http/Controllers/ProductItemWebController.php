<?php

namespace App\Modules\Producttrack\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use DB;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;

class ProductItemWebController extends Controller
{


    public function index($id)
    {
        $product_id = $id;
        $product = Product::find($id);
        $product_phases = $product->productPhases;
        //return $product_phases;
        return view('producttrack::item.index',compact('product','product_phases', 'product_id'));
    }

    public function index_1($phase_id)
    {

        $product_phase = ProductPhase::find($phase_id);



        if($product_phase['status'] > 0)
        {
            $product_phase->status = 0;

            if($product_phase->update())
            {
                return "Uncomplete";
            }
        }
        else
        {
            $product_phase->status = 1;

            if($product_phase->update())
            {
                return "Complete";
            }
        }

    }


    public function create($id)
    {
        $branch_id       = session('branch_id');
        if($branch_id == 1)
        {
          $recipients      = Contact::all();
          $issue_creators  = User::all();
        }
        if($branch_id != 1)
        {
          $recipients      = Contact::all();
          $issue_creators  = User::where('branch_id',$branch_id)->get();
        }
        $item_categories = ItemCategory::all();
        $items           = Item::all();
        $issue_number    = DB::table('product_phase_item')->latest()->first();

        if($issue_number)
          $issue_number  = $issue_number->issued_number + 1;
        else
          $issue_number = 1;
        $issue_number   = str_pad($issue_number,6,0,STR_PAD_LEFT);
        $issue_number   = 'RMI-'. $issue_number;


        $phases          = Product::find($id)->productPhases;
        return view('producttrack::item.create', compact('id','recipients','issue_creators','phases','item_categories','items', 'issue_number'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
        'recipient_id'     => 'required',
        'issued_by'        => 'required',
        'issued_number'    => 'required',
        'date'             => 'required',
        'phase'            => 'required'
        ]);

        try
        {
            $product_phase_data = $request->all();
            $product_id         = $product_phase_data['product_id'];
            //return $product_phase_data;

            $item_id = $product_phase_data['item_id'];
            $item_total = $product_phase_data['total'];
            for($i = 0; $i < count($item_id); $i++)
            {
                $item = Item::find($item_id[$i]);
                $total_purchases = $item['total_purchases'];
                $total_sales     = $item['total_sales'];

                // if(($total_purchases-$total_sales) >= $item_total[$i])
                // {
                //
                // }
                // else
                // {
                //     $item_name = $item['item_name'];
                //     return redirect()
                //         ->route('product_item_add',['id' => $product_id])
                //         ->with('alert.status', 'danger')
                //         ->with('alert.message', 'Sorry, '. $item_name .' has only '. ($total_purchases-$total_sales) .' quantity ');
                // }
            }

            for($i = 0; $i < count($item_id); $i++)
            {
                $item = Item::find($item_id[$i]);
                $total_sales     = $item['total_sales'];
                $item->total_sales = $total_sales+$item_total[$i];
                $item->save();
            }




            //...................................


            $created_by         = Auth::user()->id;
            $updated_by         = Auth::user()->id;
            //$product_id         = $product_phase_data['product_id'];
          $product_phase_data1 = explode('-',$product_phase_data['issued_number']);
          $product_phase1      = $product_phase_data1[1];

            $phase_item                       = new ProductPhaseItem;
            $phase_item->recipient_id         = $product_phase_data['recipient_id'];
            $phase_item->issued_by            = $product_phase_data['issued_by'];
            $phase_item->issued_number        = $product_phase1;
            $phase_item->reference            = $product_phase_data['reference'];
            $phase_item->date                 = $product_phase_data['date'];
            $phase_item->product_id           = $product_phase_data['product_id'];
            $phase_item->product_phase_id     = $product_phase_data['phase'];
            $phase_item->personal_note        = $product_phase_data['personal_note'];
            $phase_item->created_by           = $created_by;
            $phase_item->updated_by           = $updated_by;

            if($phase_item->save())
            {
                $phase_item               = ProductPhaseItem::orderBy('created_at','desc')->first();
                $product_phase_item_id    = $phase_item->id;
                $phase_item_data          = $request->all();
                $count                    = count($phase_item_data['total']);

                $amount_arary        = $phase_item_data['total'];
                $item_category_arary = $phase_item_data['item_category_id'];
                $item_arary          = $phase_item_data['item_id'];
                $product_phase_item = [];
                for($i=0; $i< $count; $i++)
                {

                    $product_phase_item[] = [
                        'item_category_id'      => $item_category_arary[$i] ,
                        'item_id'               => $item_arary[$i] ,
                        'total'                 => $amount_arary[$i] ,
                        'product_phase_item_id' => $product_phase_item_id,
                     ];
                }
                $save = DB::table('product_phase_item_add')->insert($product_phase_item);

                if($save)
                {
                    return redirect()
                        ->route('track')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Product Item  added successfully!');
                }
                else
                {
                    return redirect()
                        ->route('product_item_add',['id' => $product_id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
                }
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('product_item_add',['id' => $product_id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }


    }


    public function show($id)
    {
        $phase_item = ProductPhaseItem::find($id);
        $phase = ProductPhaseItem::find($id)->productPhase;
        $phase_item_adds = $phase_item->productPhaseItemAdds;

        return view('producttrack::item.show', compact('id','phase','phase_item','phase_item_adds'));

        // $product = $product_phase->product;

        // $recipients_id  = $product_phase_item->recipient_id;
        // $issued_by = $product_phase_item->issuedBy;

        //  $issued_by_id = $issued_by->id;

        //  return $issuedby  = User::where('id',$issued_by_id)->get();
        //  return $recipients = Contact::where('id',$recipients_id)->get();


    }


    public function edit($id)
    {
        $product_phase_item                   = ProductPhaseItem::find($id);
        $recipients                           = Contact::all();
        $issue_creators                       = User::all();
        $item_categories                      = ItemCategory::all();
        $items                                = Item::all();
        $product_phase_item_add               = DB::table('product_phase_item_add')->where('product_phase_item_id',$id)->get();


        $item_id = $id;
        return view('producttrack::item.edit', compact('product_phase_item','recipients','issue_creators','item_categories','items','item_id','product_phase_item_add'));

    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $this->validate($request, [
        'recipient_id'     => 'required',
        'issued_by'        => 'required',
        'issued_number'    => 'required',
        'date'             => 'required'
        ]);


        try
        {
            $phase_item_data    = $request->all();
            $phase_items = ProductPhaseItemAdd::where('product_phase_item_id',$id)->get();



            //first update item that will be edited.............
            for($i = 0; $i < count($phase_items); $i++)
            {
                $item = Item::find($phase_items[$i]->item_id);
                $total_sales     = $item['total_sales'];
                $item->total_sales = $total_sales-$phase_items[$i]->total;
                $item->update();
            }

            //return "ok1";


            //check item is available or not that is added.........
            $item_id    = $phase_item_data['item_id'];
            $item_total = $phase_item_data['total'];
            for($i = 0; $i < count($item_id); $i++)
            {
                $item = Item::find($item_id[$i]);
                $total_purchases = $item['total_purchases'];
                $total_sales     = $item['total_sales'];

                // if(($total_purchases-$total_sales) >= $item_total[$i])
                // {
                //
                // }
                // else
                // {
                //     //if item does not save than again add sales column in item...........
                //     for($i = 0; $i < count($phase_items); $i++)
                //     {
                //         $item = Item::find($phase_items[$i]->item_id);
                //         $total_sales     = $item['total_sales'];
                //         $item->total_sales = $total_sales+$phase_items[$i]->total;
                //         $item->update();
                //     }
                //
                //     $item_name       = $item['item_name'];
                //     return redirect()
                //         ->route('product_phase_item_edit',['id' => $id])
                //         ->with('alert.status', 'danger')
                //         ->with('alert.message', 'Sorry, '. $item_name .' has only '. ($total_purchases-$total_sales) .' quantity ');
                // }
            }

            //return "ok";

            for($i = 0; $i < count($item_id); $i++)
            {
                $item = Item::find($item_id[$i]);
                $total_sales     = $item['total_sales'];
                $item->total_sales = $total_sales+$item_total[$i];
                $item->update();
            }
            //return "ok";
            ProductPhaseItemAdd::where('product_phase_item_id' , $id)->delete();


            $created_by         = Auth::user()->id;
            $updated_by         = Auth::user()->id;


            $phase_item = ProductPhaseItem::find($id);
            $phase_item->recipient_id         = $phase_item_data['recipient_id'];
            $phase_item->issued_by            = $phase_item_data['issued_by'];
            $phase_item->issued_number        = $phase_item_data['issued_number'];
            $phase_item->reference            = $phase_item_data['reference'];
            $phase_item->date                 = $phase_item_data['date'];
            $phase_item->personal_note        = $phase_item_data['personal_note'];
            $phase_item->created_by           = $created_by;
            $phase_item->updated_by           = $updated_by;


            if($phase_item->update())
            {
                $count               = count($phase_item_data['total']);
                $amount_arary        = $phase_item_data['total'];
                $item_category_arary = $phase_item_data['item_category_id'];
                $item_arary          = $phase_item_data['item_id'];
                $product_phase_item = [];
                for($i=0; $i< $count; $i++)
                {

                    $product_phase_item[] = [
                        'item_category_id'      => $item_category_arary[$i] ,
                        'item_id'               => $item_arary[$i] ,
                        'total'                 => $amount_arary[$i] ,
                        'product_phase_item_id' => $id,
                    ];
                }


                $save = DB::table('product_phase_item_add')->insert($product_phase_item);

                if($save)
                {
                    return redirect()
                        ->route('product_item_list',['id' => $id])
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Phase Item Updated successfully!');
                }

                else
                {
                    return redirect()
                        ->route('product_phase_item_edit',['id' => $id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
                }

            }

        }
        catch (Exception $e)
        {

        }

    }

    public function destroy($id)
    {
        $phase_item = ProductPhaseItem::find($id);

        $phase_id = ProductPhaseItem::find($id)->productPhase->id;

        $product_id = ProductPhase::find($phase_id)->product->id;



        if($phase_item->delete())
        {
            return redirect()
                ->route('product_item_list',['id' => $product_id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Phase item deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('product_item_list',['id' => $product_id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
        }
    }


    //api for get product phase item list
    public function getProductPhaseItem($id)
    {
        $data = ProductPhaseItemAdd::where('product_phase_item_id', $id)->get();
        $item_category = DB::table('item_category')->select('item_category_name as text', 'id as value')->get();
        return response()->json([
            'item_category' =>  $item_category,
            'data' => $data,
        ], 201);
    }

    public function ItemSubCategory($id)
    {
      $item_sub_cat  = Item::where('item_category_id',$id)->get();
      return response($item_sub_cat);
    }

    public function ItemAdd($id)
    {
      $created_by  = Auth::user()->id;
      $updated_by  = Auth::user()->id;
      $product_id              = $id;
      $product                 = Product::find($id);
      $product_phases          = $product->productPhases;
       $product = Product::where('id',$id)->first();
       $items                      = Item::find($product->product_name);
       $total_manufactor            = $items->total_manufacture + $product->total_product;
       $items->total_manufacture   = $total_manufactor;
       $items->save();
       $stock = new Stock;
       $stock->branch_id            = session('branch_id');
       $stock->item_category_id     = $items->item_category_id;
       $stock->item_id              = $items->id;
       $stock->date                 = Carbon::now()->format('d-m-Y');
       $stock->total                = $product->total_product;
       $stock->created_by           = $created_by;
       $stock->updated_by           = $updated_by;
       $stock->project_id           = $id;
       $stock->save();
         if($items && $stock )
         {
           $Product_item           = Product::find($id);
           $Product_item->item_add = 1;
           $Product_item->save();
         }
          return redirect()->route('track')
                           ->with('alert.status', 'success')
                           ->with('alert.message', 'Added to Item Successfully');
    }
    public function ItemAdd1($id)
    {
      $created_by  = Auth::user()->id;
      $updated_by  = Auth::user()->id;
      $product_id              = $id;
      $product                 = Product::find($id);
      $product_phases          = $product->productPhases;
       $product = Product::where('id',$id)->first();
       $items                      = Item::find($product->product_name);
       $total_manufactor            = $items->total_manufacture + $product->total_product;
       $items->total_manufacture   = $total_manufactor;
       $items->save();
       $stock = new Stock;
       $stock->branch_id            = session('branch_id');
       $stock->item_category_id     = $items->item_category_id;
       $stock->item_id              = $items->id;
       $stock->date                 = Carbon::now()->format('d-m-Y');
       $stock->total                = $product->total_product;
       $stock->created_by           = $created_by;
       $stock->updated_by           = $updated_by;
       $stock->project_id           = $id;
       $stock->save();
         if($items && $stock )
         {
           $Product_item           = Product::find($id);
           $Product_item->item_add = 1;
           $Product_item->save();
         }
          return redirect()->route('track')
                           ->with('alert.status', 'success')
                           ->with('alert.message', 'Added to Item Successfully');
    }
    public function phaseId($phase_id, $phase)
    {

      $phase_id     =  ProductPhase::find($phase);
      if($phase_id->status ==1)
      {
          $phase_id->status = 0;
          $phase_id->save();
          $product_pase = ProductPhase::where('product_id',$phase_id->product_id)->get();

      }
      else
      {
         $phase_id->status = 1;
         $phase_id->save();
         $product_pase = ProductPhase::where('product_id',$phase_id->product_id)->get();
      }

      return response($product_pase);
    }
}
