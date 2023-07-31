<?php

namespace App\Imports;

use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class MenuImport implements ToModel
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        DB::beginTransaction();

        try
        {
            if($row[0] == 'Item Name' || !isset($row[0]) || $row[1] == 'Category' || !isset($row[1]))
            {
                DB::commit();
                return null;

            }
            else
            {
                $category                       = ItemCategory::where('item_category_name', $row[1])->first();

                if (!$category) 
                {
                    $category                   = new ItemCategory;
                }

                $category->item_category_name   = $row[1];
                $category->branch_id            = Auth::user()->branch_id;
                $category->created_by           = Auth::user()->id;
                $category->updated_by           = Auth::user()->id;
                $category->save();

                if (isset($row[2])) 
                {
                    $sub_category               = ItemSubCategory::where('item_sub_category_name', $row[2])->first();

                    if (!$sub_category) {
                        $sub_category                       = new ItemSubCategory;   
                    }

                    $sub_category->item_category_id         = $category->id;
                    $sub_category->item_sub_category_name   = $row[2];
                    $sub_category->created_by               = Auth::user()->id;
                    $sub_category->updated_by               = Auth::user()->id;
                    $sub_category->save();
                }

                $item                           = Item::where('item_name', $row[0])->first();

                if (!$item) {
                    $item                       = new Item;
                }

                $item->item_name                = $row[0];
                $item->item_sales_rate          = $row[3] ?? 0;
                $item->item_purchase_rate       = $row[4] ?? 0;
                $item->item_category_id         = $category->id;
                
                if(isset($sub_category)){
                    $item->item_sub_category_id = $sub_category->id;    
                }
                
                $item->branch_id                = Auth::user()->branch_id;
                $item->created_by                = Auth::user()->id;
                $item->updated_by                = Auth::user()->id;
                $item->save();
                
                $item->barcode_no               = str_pad($item->id, 6, 0, STR_PAD_LEFT);
                $item->save();
            }

            DB::commit();

            return $item;

        }
        catch (Exception $e)
        {
            DB::rollBack();
            return 0;
        }

    }

    public function rules(): array
    {
        return [
            '1' => 'regex:/^\d+(\.\d{1,2})?$/',
        ];

    }
}
