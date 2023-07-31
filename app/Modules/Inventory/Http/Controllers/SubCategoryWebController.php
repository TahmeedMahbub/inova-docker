<?php

namespace App\Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\Stock;
use App\Models\AccountChart\Account;
use App\User;

class SubCategoryWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $branch_id              = session('branch_id');
       
        $category_name          = ItemSubCategory::join('item_category', 'item_category.id','item_sub_category.item_category_id')
                                                ->selectRaw('item_category.item_category_name as item_category_name')
                                                ->get();

        $item_sub_categories    = ItemSubCategory::all();

        return view('inventory::subcategory.index', compact('item_sub_categories', 'category_name'));

    }

    public function add()
    {
        $branch_id = session('branch_id');

        $categories    = ItemCategory::all();
        
        return view('inventory::subcategory.add', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'item_category_id' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $subcategory = new ItemSubCategory;
            $subcategory->item_category_id = $category_data['item_category_id'];
            $subcategory->item_sub_category_name = $category_data['item_sub_category_name'];
            $subcategory->item_sub_category_description = $category_data['item_sub_category_description'];
            $subcategory->created_by = $created_by;
            $subcategory->updated_by = $updated_by;

            if ($subcategory->save())
            {
                return redirect()->route('inventory_sub_category')
                                 ->with('alert.status', 'success')
                                 ->with('alert.message', 'Sub Category Added Successfully!');
            }
            else
            {
                return redirect()->route('inventory_sub_category_add')
                                 ->with('alert.status', 'danger')
                                 ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()->route('inventory_sub_category_add')
                             ->with('alert.status', 'danger')
                             ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function edit($id)
    {
        $branch_id = session('branch_id');

        $categories      = ItemCategory::all();
        $categoryById    = ItemSubCategory::find($id);
        
        return view('inventory::subcategory.edit', compact('categoryById', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item_category_id' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $subcategory = ItemSubCategory::find($id);
            $subcategory->item_category_id = $category_data['item_category_id'];
            $subcategory->item_sub_category_name = $category_data['item_sub_category_name'];
            $subcategory->item_sub_category_description = $category_data['item_sub_category_description'];
            $subcategory->updated_by = $updated_by;

            if ($subcategory->update())
            {
                return redirect()->route('inventory_sub_category')
                                  ->with('alert.status', 'success')
                                  ->with('alert.message', 'Sub Category Updated Successfully!');
            }
            else
            {
                return redirect()->route('inventory_sub_category_edit', ['id' => $id])
                                 ->with('alert.status', 'danger')
                                 ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()->route('inventory_sub_category_edit', ['id' => $id])
                             ->with('alert.status', 'danger')
                             ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }


    public function destroy($id)
    {

        $item_use = Item::where('item_sub_category_id', $id)->get();

        if (count($item_use) > 0)
        {
            return redirect()
                ->route('inventory_sub_category')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Sub Category is used in item.');
        }

        $subcategory = ItemSubCategory::find($id);

        if ($subcategory->delete())
        {
            return redirect()
                ->route('inventory_sub_category')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Sub Category deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('inventory_sub_category')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        $branch_users = User::where('branch_id', $this->branch_id)->get();

        if(isset($branch_users)){
            foreach($branch_users as $users){
                $tmp_targeted_users[] = $users->id;
            }
        }else{
            $tmp_targeted_users = [];
        }

        $this->targeted_users = $tmp_targeted_users;
    }
}
