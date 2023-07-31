<?php

namespace App\Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\Stock;
use App\Models\AccountChart\Account;
use App\User;

class CategoryWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

	public function index()
    {
        $branch_id = session('branch_id');

        $item_categories      = ItemCategory::all();

		$branches             = Branch::all();
        return view('inventory::category.index', compact('branches','item_categories'));
	}

    public function create()
    {
        $branches = Branch::all();
        return view('inventory::category.create', compact('branches'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'item_category_name' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = new ItemCategory;

            $category->item_category_name = $category_data['item_category_name'];
            $category->item_category_description = $category_data['item_category_description'];
            $category->branch_id = Auth::user()->branch_id;
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;

            if ($category->save())
            {
                return redirect()->route('inventory_category')
                                 ->with('alert.status', 'success')
                                 ->with('alert.message', 'Category Added Successfully!');
            }
            else
            {
                return redirect()->route('inventory_category_create')
                                 ->with('alert.status', 'danger')
                                 ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()->route('inventory_category_create')
                             ->with('alert.status', 'danger')
                             ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function edit($id)
    {
        $branch_id = session('branch_id');

        $category    = ItemCategory::find($id);
        
    	$branches = Branch::all();
        return view('inventory::category.edit', compact('category', 'branches'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item_category_name' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = ItemCategory::find($id);

            $category->item_category_name = $category_data['item_category_name'];
            $category->item_category_description = $category_data['item_category_description'];
            $category->branch_id = Auth::user()->branch_id;
            $category->updated_by = $updated_by;

            if ($category->update())
            {
                return redirect()->route('inventory_category')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category Updated Successfully!');
            }
            else
            {
                return redirect()->route('inventory_category_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('inventory_category_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }


    public function destroy($id)
    {

        $check_in_item = Item::where('item_category_id', $id)->count();

        if($check_in_item > 0){

            return redirect()->route('inventory_category')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You have data under this Category.');

        }

        $category = ItemCategory::find($id);

        if ($category->delete())
        {
            return redirect()->route('inventory_category')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Category deleted successfully!');
        }
        else
        {
            return redirect()->route('inventory_category')
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
