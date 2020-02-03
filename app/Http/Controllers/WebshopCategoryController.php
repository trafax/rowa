<?php

namespace App\Http\Controllers;

use App\Models\WebshopCategory;
use App\Models\WebshopFilter;
use App\Models\WebshopProduct;
use App\Models\WebshopProductFilter;
use Illuminate\Http\Request;

class WebshopCategoryController extends Controller
{
    public function index($slug, $url_filters = null)
    {
        $webshopCategory = WebshopCategory::where('slug', $slug)->first();

        $productIds = $webshopCategory->products->pluck('id');
        $productIds = ! $productIds ? array() : $productIds;

        $filters = [];
        $all_filter_ids = WebshopProductFilter::select('webshop_filter_id')->whereIn('webshop_product_id', $productIds)->groupBy('webshop_filter_id')->get()->pluck('webshop_filter_id');
        $filters_tmp = WebshopFilter::orderBy('sort')->findMany($all_filter_ids);

        foreach ($filters_tmp as $filter)
        {
            $values = WebshopProductFilter::where('webshop_filter_id', $filter->id)->whereIn('webshop_product_id', $productIds)->groupBy('value');

            if ($filter->sort_by == 'number') {
                $values = $values->orderByRaw('CAST(value as UNSIGNED) ASC');
            }
            else if ($filter->sort_by == 'alfabetic') {
                $values = $values->orderBy('value');
            }
            else if ($filter->sort_by == 'price') {
                $values = $values->orderBy('added_price')->orderBy('added_price');
            }
            $values = $values->get(['id', 'value', 'slug']);
            $filter->values = $values;
            $filters[] = $filter;
        }

        // Geselecteerde filters
        $active_filters = [];
        $url_filters_explode = explode('/', $url_filters);
        if ($url_filters_explode)
        {
            foreach ($url_filters_explode as $url_filter)
            {
                if ($url_filter)
                {
                    $row_url_filter = explode(':', $url_filter);
                    $active_filters[$row_url_filter[0]] = $row_url_filter[1];
                }
            }
        }

        if ($url_filters)
        {
            $product_ids = $this->filter_products([
                'product_ids' => $productIds,
                'filters' => $url_filters
            ]);

            $products = WebshopProduct::whereIn('id',  $product_ids)->get();
        }
        else
        {
            $products = $webshopCategory->products;
        }

        return view('webshop.categories.index')->with([
            'webshopCategory' => $webshopCategory,
            'webshopProducts' => $products,
            'filters' => $filters,
            'active_filters' => $active_filters
        ]);
    }

    public function set_filter(Request $request, $slug)
    {
        $filter_arguments = [];

        if ($request->get('filters'))
        {
            foreach ($request->get('filters') as $filter => $values)
            {
                $filter_arguments[] = $filter . ':' . implode(',', $values);
            }
        }

        return redirect()->route('webshopCategory', [$slug, implode('/', $filter_arguments)]);
    }

    public function filter_products($filters = [])
    {
        $product_ids = [];

        $filter_slugs = [];
        if (isset($filters['product_ids']) && isset($filters['filters']))
        {
            $explode = explode('/', $filters['filters']);
            foreach ($explode as $filter_exploded)
            {
                $filter_slugs = explode(',', last(explode(':', $filter_exploded)));
                $ids = WebshopProductFilter::slugs($filter_slugs)->get();
                $product_ids[] = $ids->toArray();
            }

            $temp_ids = [];
            foreach ($explode as $key => $filter_exploded)
            {
                foreach ($filters['product_ids'] as $product_id)
                {
                    $count_value = array_count_values(array_column($product_ids[$key], 'webshop_product_id'));
                    if (isset($count_value[$product_id]) && $count_value[$product_id] > 0)
                    {
                        $temp_ids[] = $product_id;
                    }
                }
            }

            $product_ids = [];
            foreach ($filters['product_ids'] as $product_id)
            {
                $count_value = array_count_values($temp_ids);
                if (isset($count_value[$product_id]) && $count_value[$product_id] >= count($explode))
                {
                    $product_ids[] = $product_id;
                }
            }

            return $product_ids;
        }
    }
}
