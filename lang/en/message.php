<?php

return [

    //GENERAL
    'success_create' => "create successfuly",
    'success_update' => "update successfuly",
    'success_delete' => "delete successfuly",
    'not_found' => "not found",
    'success_check_phone' => "check phone successfuly",
    'phone_verified' => "Phone Verified successfully",
    //SEARCH
    "id_or_word_required" => "id or word is required",
    "global_search_required" => "You must enter the word you want to search for.",
    //TITLEs
    'title_ar_required' => "title in arabic is required",
    'title_en_required' => "title in english is required",
    'title_ar_min' => "title in arabic must be at least 4 characters",
    'title_en_min' => "title in english must be at least 4 characters",
    'title_ar_max' => "title in arabic must not be greater than 255 characters",
    'title_en_max' => "title in english must not be greater than 255 characters",
    //DESCRIPTIONS
    'description_ar_required' => "description in arabic is required",
    'description_en_required' => "description in english is required",
    'description_ar_min' => "description in arabic must be at least 4 characters",
    'description_en_min' => "description in english must be at least 4 characters",
    'description_ar_max' => "description in arabic must not be greater than 255 characters",
    'description_en_max' => "description in english must not be greater than 255 characters",
    //NATIONALITY TYPE
    'nationality_id_required' => "nationality id is required",
    'nationality_id_exists' => "nationality id is not exists",
    'service_type_id_required' => "service type id is required",
    'service_type_id_exists' => "service type id is not exists",
    'price_required' => "price is required",
    'price_numeric' => "price must be numeric",
    'nationality_service_type_unique' => 'The combination of nationality and service type must be unique',
    //IMAGE
    "image_required" => "image is required",
    'image_invalid' => 'The image is not valid',
    'image_mimes' => 'The image must be a file of type: png, jpg, jpeg',
    //SOCIAL
    'name_required' => 'name is required',
    'name_min' => 'name must be at least 4 characters',
    'name_max' => 'name must not be greater than 255 characters',
    'phone_required' => 'phone is required',
    'phone_min' => 'phone must be at least 4 characters',
    'phone_max' => 'phone must not be greater than 255 characters',
    'address_required' => 'address is required',
    'address_min' => 'address must be at least 4 characters',
    'address_max' => 'address must not be greater than 255 characters',
    'whatsapp_required' => 'whatsapp is required',
    'whatsapp_min' => 'whatsapp must be at least 8 characters',
    'whatsapp_max' => 'whatsapp must not be greater than 255 characters',
    'facebook_url_min' => 'facebook url must be at least 17 characters',
    'facebook_url_max' => 'facebook url must not be greater than 255 characters',
    'facebook_url' => 'facebook url is not valid',
    'x_url_min' => 'x url must be at least 17 characters',
    'x_url_max' => 'x url must not be greater than 255 characters',
    'x_url' => 'x url is not valid',
    'youtube_url_min' => 'youtube url must be at least 17 characters',
    'youtube_url_max' => 'youtube url must not be greater than 255 characters',
    'youtube_url' => 'youtube url is not valid',
    'instagram_url_min' => 'instagram url must be at least 17 characters',
    'instagram_url_max' => 'instagram url must not be greater than 255 characters',
    'instagram_url' => 'instagram url is not valid',
    'linkedin_url_min' => 'linkedin url must be at least 17 characters',
    'linkedin_url_max' => 'linkedin url must not be greater than 255 characters',
    'linkedin_url' => 'linkedin url is not valid',
    'link_url' => 'link must be url',
    'link_required' => 'link is required',
    /*START CUSTOM RULES */
    'exists_in_table' => "The selected :attribute is invalid or does not exist for this organization.",
    'unique_in_table' => "The :attribute has already been taken",
    /*END CUSTOM RULES */
    /*START COLUMNS */
    'email_column' => 'Email',
    'phone_column' => 'Phone',
    'id_category_column' => 'ID Category',
    'code_column' => 'Code',
    "category_column" => "Category",
    "product_column" => "Product",
    "cart_column" => "Cart",
    /*END COLUMNS */
    //COUPON
    'coupon_not_vaild' => 'coupon not vaild',
    'coupon_min_purchase_not_vaild' => 'Minimum not reached',
    //PRODUCT
    'insufficient_stock' => 'Insufficient stock',
    'available_quantity' => 'This quantity not available , available quantity :quantity',
    //CART
    'empty_cart' => 'Empty cart',
    //ORDER
    'order_creation_failed' => 'Failed to create order',
];
