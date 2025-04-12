<?php

return [

    //GENERAL
    'success_create' => "تم الانشاء بنجاح",
    'success_update' => "تم التعديل بنجاح",
    'success_delete' => "تم الحذف بنجاح",
    'not_found' => "غير موجود",
    'success_check_phone' => "تم التحقق بنجاح",
    'phone_verified' => "تم التحقق من الهاتف بنجاح",
    //SEARCH
    "id_or_word_required" => "يجب داخال الأيدي او الكلمة",
    "global_search_required" => "يجب ادخال الكلمةالمراد البحث عنها",
    //TITLEs
    'title_ar_required' => "الحقل العربي مطلوب",
    'title_en_required' => "الحقل الانجليزي مطلوب",
    'title_ar_min' => "يجب أن يكون الحقل باللغة العربية 4 أحرف على الأقل",
    'title_en_min' => "يجب أن يكون الحقل باللغة الانجليزية 4 أحرف على الأقل",
    'title_ar_max' => "يجب أن يكون الحقل باللغة العربية 255 حرف على الأكثر",
    'title_en_max' => "يجب أن يكون الحقل باللغة الانجليزية 255 حرف على الأكثر",
    //DESCRIPTIONS
    'description_ar_required' => "الوصف باللغة العربية مطلوب",
    'description_en_required' => "الوصف باللغة الانجليزية مطلوب",
    'description_ar_min' => "الوصف باللغة العربية يجب أن يكون 4 حروف على الأقل",
    'description_en_min' => "الوصف باللغة الانجليزية يجب أن يكون 4 حروف على الأقل",
    'description_ar_max' => "الوصف باللغة العربية يجب أن يكون 255 حروف على الأكثر",
    'description_en_max' => "الوصف باللغة الانجليزية يجب أن يكون 255 حروف على الأكثر",
    //NATIONALITY TYPE
    'nationality_id_required' => "الجنسية مطلوبه",
    'nationality_id_exists' => "الجنسية غير موجوده",
    'service_type_id_required' => "الخدمة مطلوبه",
    'service_type_id_exists' => "الخدمة غير موجوده",
    'price_required' => "السعر مطلوب",
    'price_numeric' => "السعر يجب أن يكون عدد",
    'nationality_service_type_unique' => 'لا يمكن تكرار الجنسية والخدمة في نفس الوقت.',
    //IMAGE
    "image_required" => "الصورة مطلوبة",
    'image_invalid' => 'الصورة غير صالحة',
    'image_mimes' => 'png, jpg, jpeg الصورة يجب ان تكون من نوع',
    //SOCIAL
    'name_required' => 'الاسم مطلوب',
    'name_min' => 'الاسم يجب أن يكون 4 حروف على الأقل',
    'name_max' => 'الاسم يجب أن يكون 255 حروف على الأكثر',
    'phone_required' => 'رقم الهاتف مطلوب',
    'phone_min' => 'رقم الهاتف يجب أن يكون 4 حروف على الأقل',
    'phone_max' => 'رقم الهاتف يجب أن يكون 255 حروف على الأكثر',
    'address_required' => 'العنوان مطلوب',
    'address_min' => 'العنوان يجب أن يكون 4 حروف على الأقل',
    'address_max' => 'العنوان يجب أن يكون 255 حروف على الأكثر',
    'whatsapp_required' => 'الواتساب مطلوب',
    'whatsapp_min' => 'الواتساب يجب أن يكون 8 حروف على الأقل',
    'whatsapp_max' => 'الواتساب يجب أن يكون 255 حروف على الأكثر',
    'facebook_url_min' => 'رابط الفيسبوك يجب أن يكون 17 حرف على الأقل',
    'facebook_url_max' => 'رابط الفيسبوك يجب أن يكون 255 حرف على الأكثر',
    'facebook_url' => 'رابط الفيسبوك غير صالح',
    'x_url_min' => 'رابط اكس يجب أن يكون 17 حرف على الأقل',
    'x_url_max' => 'رابط اكس يجب أن يكون 255 حرف على الأكثر',
    'x_url' => 'رابط اكس غير صالح',
    'youtube_url_min' => 'رابط يوتيوب يجب أن يكون 17 حرف على الأقل',
    'youtube_url_max' => 'رابط يوتيوب يجب أن يكون 255 حرف على الأكثر',
    'youtube_url' => 'رابط يوتيوب غير صالح',
    'instagram_url_min' => 'رابط انستغرام يجب أن يكون 17 حرف على الأقل',
    'instagram_url_max' => 'رابط انستغرام يجب أن يكون 255 حرف على الأكثر',
    'instagram_url' => 'رابط انستغرام غير صالح',
    'linkedin_url_min' => 'رابط لينكدان يجب أن يكون 17 حرف على الأقل',
    'linkedin_url_max' => 'رابط لينكدان يجب أن يكون 255 حرف على الأكثر',
    'linkedin_url' => 'رابط لينكدان غير صالح',
    'link_url' => 'الرابط غير صالح',
    'link_required' => 'الرابط مطلوب',
    /*START CUSTOM RULES */
    'exists_in_table' => ':attribute المختار غير تابع لهذه المنظمة',
    'unique_in_table' => ":attribute مستخدم بالفعل ",
    /*END CUSTOM RULES */
    /*START COLUMNS */
    'email_column' => 'البريد الالكتروني',
    'phone_column' => 'رقم الهاتف',
    'id_category_column' => 'معرف التصنيف',
    'code_column' => 'الكود',
    "category_column" => "التصنيف",
    "product_column" => "المنتج",
    "cart_column" => "السلة",
    /*END COLUMNS */
    /*START PRODUCT */
    "failed_create_product" => "يوجد خطأ, لم يتم اضافة المنتج",
    /*END PRODUCT */
    //COUPON
    'coupon_not_vaild' => 'الكوبون غير صالح',
    'coupon_min_purchase_not_vaild' => 'لم يتم الوصول للحد الادني من الشراء',
    //PRODUCT
    'insufficient_stock' => 'الكمية غير متوفرة',
    'available_quantity' => 'هذه الكمية غير متوفره الكمية المتاحة :quantity',
    //CART
    'empty_cart' => 'السلة فارغة',
    //ORDER
    'order_creation_failed' => 'فشل انشاء الطلب',
];
