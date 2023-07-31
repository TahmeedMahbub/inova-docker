<?php

namespace App\Modules\Producttrack\Http\Controllers;


use File;
use Repsonse;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Contact\Contact;
use App\Models\Moneyin\Estimate;

use App\Models\Inventory\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes\Attributes;
use App\Models\Inventory\Manufacture;
use App\Models\Inventory\ProductPhase;
use App\Models\Moneyin\BillOfMaterial;
use App\Models\Moneyin\Estimate_Entry;
use App\Models\Inventory\ItemVariation;
use Illuminate\Support\Facades\Response;
use App\Models\Inventory\ItemMultipleFile;
use App\Models\Inventory\ManufactureEntry;
use App\Models\Inventory\ManufacturePhase;
use App\Models\Inventory\ManufacturePhaseDisburse;
use App\Models\Inventory\ManufacturePhaseRawMaterials;
use App\Models\OrganizationProfile\OrganizationProfile;

class ProductTrackWebController extends Controller
{
    protected $organization_profile;

    public function __construct()
    {
        $this->organization_profile = OrganizationProfile::first();
    }

    public function index()
    {

        // $products = Product::join('item', 'product.product_name', 'item.id')
        //             ->selectRaw('item.item_name, product.*')
        //             ->get();
        $branches = Branch::all();
        $manufactures=Manufacture::with('manufacturePhases','billOfMaterial')->get();  

        return view('producttrack::track.index' , compact('branches','manufactures'));
    }

    public function create()
    {
        $item               = Item::when($this->organization_profile->costing_sheet == 1, function($query){
                                $query->join('item_category', 'item.item_category_id', 'item_category.id')
                                ->where('item_category.category_type', 'end_product')
                                ->select('item.*');
                                })
                                ->get();
        $branches           = Branch::all();
        $boms               = BillOfMaterial::all();
        $contacts           = Contact::where('contact_category_id', 9)->get();
        $attributes         = Attributes::all();
        $item_variations    = ItemVariation::all();
        return view('producttrack::track.create' , compact('branches', 'item','boms','contacts', 'attributes', 'item_variations'));
    }
    public function bomGet($id)
    {
        $bill_of_material = BillOfMaterial::where('id', $id)->with('billOfMaterialEntries', 'item')->first();
        return response()->json(['bill_of_material' => $bill_of_material]);
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $start_date=date('Y-m-d', strtotime($request->start_date));
        $end_date=date('Y-m-d', strtotime($request->end_date));
           
        try
        {
            DB::beginTransaction();
            $manufacture= new Manufacture();
            $manufacture->bill_of_material_id   = empty($request->bom_id) ? null : $request->bom_id;
            $manufacture->start_date            = date('Y-m-d', strtotime($start_date));
            $manufacture->end_date              = date('Y-m-d', strtotime($end_date));
            $manufacture->created_by            = Auth::user()->id;
            $manufacture->updated_by            = Auth::user()->id;
            $manufacture->save();
           

            foreach ($request->item as $key => $item) {
                $manufacture_entries = [];
                $manufacture_entries[$key]                          = new ManufactureEntry();
                $manufacture_entries[$key]->manufacture_id          = $manufacture->id;
                $manufacture_entries[$key]->item_id                 = $item;
                $manufacture_entries[$key]->variation_id            = !empty($request->selected_variation[$key]) ? $request->selected_variation[$key] : null;
                $manufacture_entries[$key]->required_quantity       = $request->remaining_pcs[$key];
                $manufacture_entries[$key]->manufacture_quantity    = $request->manufacture_pcs[$key];
                $manufacture_entries[$key]->save();                
            }

            foreach ($request->phase_name as $key => $phase) {
                $manufacture_phases = [];
                $manufacture_phases[$key]                   = new ManufacturePhase();
                $manufacture_phases[$key]->phase_name       = $phase;
                $manufacture_phases[$key]->manufacture_id   = $manufacture->id;
                $manufacture_phases[$key]->factory_id       = $request->factory_id[$key];
                $manufacture_phases[$key]->created_by       = $user->id;
                $manufacture_phases[$key]->updated_by       = $user->id;
                $manufacture_phases[$key]->status           ='incomplete';
                $manufacture_phases[$key]->save();
            }

            $bill_of_material = BillOfMaterial::find($request->bom_id);
            foreach ($bill_of_material->billOfMaterialEntries as $key => $value) {
                ManufacturePhaseRawMaterials::create([
                    'item_id'               => $value->item_id,
                    'manufacture_phase_id'  => $manufacture_phases[0]->id,
                    'quantity'              => $value->quantity,
                    'created_by'            => $user->id,
                    'updated_by'            => $user->id,
                ]);
                ManufacturePhaseDisburse::create([
                    'date'                  => date('Y-m-d'),
                    'manufacture_phase_id'  => $manufacture_phases[0]->id,
                    'item_id'               => $value->item_id,
                    'quantity'              => $value->quantity,
                    'created_by'            => $user->id,
                    'updated_by'            => $user->id,
                ]);
            }
            DB::commit();
            return redirect()
                        ->route('track')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Manufacture added successfully!');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
            return redirect()
                ->route('track_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function show($id)
    {
        try{
            $manufacture=Manufacture::where('id',$id)->first();
            return view('producttrack::track.show',compact('manufacture', 'id'));
        }catch(\Exception $e){
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }
    //sop all file show
    public function sopAllFileShow($id)
    {
       
       $sop_files=ItemMultipleFile::where('item_id',$id)->where('sop_file','!=',null)->get();
      
    
       return view('producttrack::track.sop_file_show' , compact('sop_files'));
       
    }
     //design all file show
     public function designAllFileShow($id)
     {
       
        $design_files=ItemMultipleFile::where('item_id',$id)->where('design_file','!=',null)->get();
       
      

        return view('producttrack::track.design_file_show' , compact('design_files'));
       
     }
     public function excelFileDownlaod($id)
     {
        $file=ItemMultipleFile::where('id',$id)->first();
        $ext =pathinfo($file->sop_file, PATHINFO_EXTENSION);

        if($ext == 'pdf')
        {
            $filename =$file->sop_file;
            header("Content-type: application/pdf");
            header("Content-Length: " . filesize($filename));
            readfile($filename);
        }
        else{
          $filepath = public_path($file->sop_file !=null?$file->sop_file:$file->design_file); 
     
          return Response::download($filepath); 
        }
      



// dd($file->sop_file);
        // return Response::make(file_get_contents($file->sop_file), 200, [
        //     'content-type'=>'application/pdf',
            
        // ])->set_output(file_get_contents($file->sop_file));
        // $pdf = PDF::loadView($file->sop_file);
        // return $pdf->stream('document.pdf');
        
     }

    public function edit($id)
    {
      
        $item                   = Item::with('itemVariations')->get();
        $boms                   = BillOfMaterial::all();
        $contacts               = Contact::where('contact_category_id', 9)->get();
        $attributes             = Attributes::all();
        $item_variations        = ItemVariation::all();
        $manufacture            = Manufacture::findOrFail($id);
        return view('producttrack::track.edit' , compact('item','boms','contacts','attributes','item_variations','manufacture'));
    }

    public function update(Request $request, $id)
    {

        try
        {
            DB::beginTransaction();
            $manufacture = Manufacture::findOrFail($id);

            $manufacture->manufactureEntries()->delete();
            foreach($manufacture->manufacturePhases as $manufacture_phase)
            {
                $manufacture_phase->manufacturePhaseRawMaterials()->delete();
                $manufacture_phase->manufacturePhaseDisburses()->delete();
                $manufacture_phase->manufacturePhaseReceivesFromFactory()->delete();
            }
            $manufacture->manufacturePhases()->delete();

            $manufacture->estimate_id= empty($request->quotation_id) ? null : $request->quotation_id;
            $manufacture->start_date=$request->start_date;
            $manufacture->end_date=$request->end_date;
            $manufacture->created_by=Auth::user()->id;
            $manufacture->updated_by=Auth::user()->id;
            $manufacture->update();

            foreach ($request->item as $key => $item) {
                $manufacture_entries[$key]                        = new ManufactureEntry();
                $manufacture_entries[$key]->manufacture_id        = $manufacture->id;
                $manufacture_entries[$key]->item_id               = $item;
                $manufacture_entries[$key]->variation_id          = !empty($request->selected_variation[$key]) ? $request->selected_variation[$key] : null;
                $manufacture_entries[$key]->required_quantity     = $request->remaining_pcs[$key];
                $manufacture_entries[$key]->manufacture_quantity  = $request->manufacture_pcs[$key];
                $manufacture_entries[$key]->save();
            }
            foreach ($request->phase_name as $key => $phase) {
                $manufacture_phases[$key]                 = new ManufacturePhase();
                $manufacture_phases[$key]->phase_name     = $phase;
                $manufacture_phases[$key]->manufacture_id = $manufacture->id;
                $manufacture_phases[$key]->factory_id     = $request->factory_id[$key];
                $manufacture_phases[$key]->created_by     = Auth::user()->id;
                $manufacture_phases[$key]->updated_by     = Auth::user()->id;
                $manufacture_phases[$key]->status         = 'incomplete';
                $manufacture_phases[$key]->save();
            }            
            foreach($manufacture_entries as $key => $manufacture_entry)
            {
                foreach($manufacture_entry->item_variation->costingSheet as $key2 => $raw_material)
                {
                    ManufacturePhaseRawMaterials::create([
                        'manufacture_phase_id'  => $manufacture_phases[0]->id,
                        'item_id'               => ItemVariation::where('id', $raw_material->raw_material_id)->first()->item->id,
                        'variation_id'          => $raw_material->raw_material_id,
                        'quantity'              => $raw_material->quantity * $manufacture_entry->manufacture_quantity,
                        'created_by'            => Auth::user()->id,
                        'updated_by'            => Auth::user()->id,
                    ]);
                }
            }
            DB::commit();
           
            return redirect()
            ->route('track')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Product Track Updated Successfully!');

        }
        catch (\Exception $e)
        {
            return redirect()
                ->route('track_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }

    }

    public function destroy($id)
    {
        try
        {            
            DB::beginTransaction();
            $manufacture = Manufacture::findOrFail($id);
            $manufacture->manufactureEntries()->delete();
            foreach($manufacture->manufacturePhases as $manufacture_phase)
            {
                $manufacture_phase->manufacturePhaseRawMaterials()->delete();
                $manufacture_phase->manufacturePhaseDisburses()->delete();
                $manufacture_phase->manufacturePhaseReceivesFromFactory()->delete();
            }
            $manufacture->manufacturePhases()->delete();
            $manufacture->delete();
            DB::commit();
            return redirect()
                ->back()
                ->with('alert.status', 'success')
                ->with('alert.message', 'Product deleted successfully!');      
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()
                ->route('track')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }


    }

    //api for get product phase item list
    public function getProduct($id)
    {
       
        $data = ProductPhase::where('product_id', $id)->get();
        return $data;
    }

    public function updatePhaseStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $manufacture_phase = ManufacturePhase::findOrFail($request->id);
            $manufacture_phase->status = $request->status;
            $manufacture_phase->update();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Status change successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function addToStock(Request $request){
        try {
            DB::beginTransaction();
            $manufacture = Manufacture::findOrFail($request->id);
            foreach($manufacture->manufactureEntries as $key => $manufactureEntry){
                if(!empty($manufactureEntry->variation_id)){
                    ItemVariation::where('id', $manufactureEntry->variation_id)->update([
                        'total_manufacture' => DB::raw('total_manufacture + '.$manufactureEntry->manufacture_quantity),
                    ]);
                }else{
                    Item::where('id', $manufactureEntry->item_id)->update([
                        'total_manufacture' => DB::raw('total_manufacture + '.$manufactureEntry->manufacture_quantity),
                    ]);
                }
            }
            $manufacture->status = 'complete';
            $manufacture->update();            
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Stock added successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
