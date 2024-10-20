<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class BusinessLocation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'featured_products' => 'array',
    ];

    /**
     * Return list of locations for a business
     *
     * @param  int  $business_id
     * @param  bool  $show_all = false
     * @param  array  $receipt_printer_type_attribute =
     * @return array
     */
    public static function forDropdown($business_id, $show_all = false, $receipt_printer_type_attribute = false, $append_id = true, $check_permission = true)
    {
        $query = BusinessLocation::where('business_id', $business_id)->Active();

        if ($check_permission) {
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('id', $permitted_locations);
            }
        }

        if ($append_id) {
            $query->select(
                DB::raw("IF(location_id IS NULL OR location_id='', name, CONCAT(name, ' (', location_id, ')')) AS name"),
                'id',
                'receipt_printer_type',
                'selling_price_group_id',
                'default_payment_accounts',
                'invoice_scheme_id',
                'invoice_layout_id'
            );
        }

        $result = $query->get();

        $locations = $result->pluck('name', 'id');

        $price_groups = SellingPriceGroup::forDropdown($business_id);

        if ($show_all) {
            $locations->prepend(__('report.all_locations'), '');
        }

        if ($receipt_printer_type_attribute) {
            $attributes = collect($result)->mapWithKeys(function ($item) use ($price_groups) {
                $default_payment_accounts            = json_decode($item->default_payment_accounts, true);
                $default_payment_accounts['advance'] = [
                    'is_enabled' => 1,
                    'account'    => null,
                ];

                return [
                    $item->id => [
                        'data-receipt_printer_type'      => $item->receipt_printer_type,
                        'data-default_price_group'       => !empty($item->selling_price_group_id) && array_key_exists($item->selling_price_group_id, $price_groups) ? $item->selling_price_group_id : null,
                        'data-default_payment_accounts'  => json_encode($default_payment_accounts),
                        'data-default_invoice_scheme_id' => $item->invoice_scheme_id,
                        'data-default_invoice_layout_id' => $item->invoice_layout_id,
                    ],
                ];
            })->all();

            return ['locations' => $locations, 'attributes' => $attributes];
        } else {
            return $locations;
        }
    }

    public static function forDropdownAll($show_all = false, $receipt_printer_type_attribute = false, $check_permission = true)
    {
        // Query to get all active business locations without filtering by business_id
        $query = BusinessLocation::Active();

        // If permission check is enabled
        if ($check_permission) {
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('id', $permitted_locations);
            }
        }

        // Select the required fields (no need for business_id anymore)
        $query->select(
            DB::raw("IF(location_id IS NULL OR location_id='', name, CONCAT(name, ' (', location_id, ')')) AS name"),
            'id',
            'receipt_printer_type',
            'selling_price_group_id',
            'default_payment_accounts',
            'invoice_scheme_id',
            'invoice_layout_id'
        );

        // Execute the query and get the result
        $result = $query->get();

        // Extract the location names with their IDs
        $locations = $result->pluck('name', 'id');

        // If show_all is enabled, prepend 'All Locations' to the locations list
        if ($show_all) {
            $locations->prepend(__('report.all_locations'), '');
        }

        // Check if receipt_printer_type_attribute is needed
        if ($receipt_printer_type_attribute) {
            $price_groups = SellingPriceGroup::all()->pluck('name', 'id');  // Get all price groups

            // Generate attributes for each location
            $attributes = collect($result)->mapWithKeys(function ($item) use ($price_groups) {
                $default_payment_accounts            = json_decode($item->default_payment_accounts, true);
                $default_payment_accounts['advance'] = [
                    'is_enabled' => 1,
                    'account'    => null,
                ];

                return [
                    $item->id => [
                        'data-receipt_printer_type'      => $item->receipt_printer_type,
                        'data-default_price_group'       => !empty($item->selling_price_group_id) && array_key_exists($item->selling_price_group_id, $price_groups) ? $item->selling_price_group_id : null,
                        'data-default_payment_accounts'  => json_encode($default_payment_accounts),
                        'data-default_invoice_scheme_id' => $item->invoice_scheme_id,
                        'data-default_invoice_layout_id' => $item->invoice_layout_id,
                    ],
                ];
            })->all();

            // Return the locations and attributes
            return ['locations' => $locations, 'attributes' => $attributes];
        } else {
            // Return only the locations
            return $locations;
        }
    }

    public function price_group()
    {
        return $this->belongsTo(\App\SellingPriceGroup::class, 'selling_price_group_id');
    }

    /**
     * Scope a query to only include active location.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Get the featured products.
     *
     * @return array/object
     */
    public function getFeaturedProducts($is_array = false, $check_location = true)
    {
        if (empty($this->featured_products)) {
            return [];
        }
        $query = Variation::whereIn('variations.id', $this->featured_products)
            ->join('product_locations as pl', 'pl.product_id', '=', 'variations.product_id')
            ->join('products as p', 'p.id', '=', 'variations.product_id')
            ->where('p.not_for_selling', 0)
            ->with(['product_variation', 'product', 'media'])
            ->select('variations.*');

        if ($check_location) {
            $query->where('pl.location_id', $this->id);
        }
        $featured_products = $query->get();
        if ($is_array) {
            $array = [];
            foreach ($featured_products as $featured_product) {
                $array[$featured_product->id] = $featured_product->full_name;
            }

            return $array;
        }

        return $featured_products;
    }

    public function getLocationAddressAttribute()
    {
        $location       = $this;
        $address_line_1 = [];
        if (!empty($location->landmark)) {
            $address_line_1[] = $location->landmark;
        }
        if (!empty($location->city)) {
            $address_line_1[] = $location->city;
        }
        if (!empty($location->state)) {
            $address_line_1[] = $location->state;
        }
        if (!empty($location->zip_code)) {
            $address_line_1[] = $location->zip_code;
        }
        $address        = implode(', ', $address_line_1);
        $address_line_2 = [];
        if (!empty($location->country)) {
            $address_line_2[] = $location->country;
        }
        $address .= '<br>';
        $address .= implode(', ', $address_line_2);

        return $address;
    }

    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('name', 'asc');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function services()
    {
        return $this->hasMany('App\UserService', 'shop_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'shop_id', 'id');
    }

    // get 2 products for marketing
    public function marketingProducts()
    {
        return $this->hasMany('App\Product', 'shop_id', 'id');
    }

    public function partnership_shops()
    {
        return $this->hasMany(PartnershipShop::class, 'partnership_shop_id');
    }

    public function invoice_schemes()
    {
        return $this->belongsTo(InvoiceScheme::class, 'invoice_scheme_id');
    }

    public function invoice_layouts()
    {
        return $this->belongsTo(InvoiceLayout::class, 'invoice_layout_id');
    }

    public function invoice_layouts_sale()
    {
        return $this->belongsTo(InvoiceLayout::class, 'sale_invoice_layout_id');
    }

    public function selling_price_group()
    {
        return $this->belongsTo(SellingPriceGroup::class, 'selling_price_group_id');
    }
}
