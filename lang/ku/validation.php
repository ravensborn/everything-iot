<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'phone' => 'پێویستە :attribute ژمارەی مۆبایلی دروست بێت.',
    'accepted' => 'پێویستە :attribute قبوڵ بکرێت.',
    'accepted_if' => 'پێویستە :attribute قبوڵ بکرێت کاتێک :other :value بێت.',
    'active_url' => ':attribute بەستەرێکی ڕاست نیە.',
    'after' => 'پێویستە :attribute دوای بەرواری :date بێت.',
    'after_or_equal' => 'پێویستە :attribute رۆژی :date یان رۆژی دوای ئەو بێت.',
    'alpha' => 'پێویستە :attribute تەنها لە پیت پێکهاتبێت.',
    'alpha_dash' => 'پێویستە :attribute تەنها پێکهاتبێت لە پیت و ژمارە و ئەندەرسکۆر و داش.',
    'alpha_num' => 'پێویستە :attribute تەنها لە پیت و ژمارە پێکهاتبێت.',
    'array' => 'پێویستە :attribute ئەڕێی بێت.',
    'before' => 'پێویستە :attribute پێش بەرواری :date بێت.',
    'before_or_equal' => 'پێویستە :attribute رۆژی :date بێت یان ڕۆژێکی پێش ئەوە.',
    'between' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'boolean' => 'پێویستە :attribute تەنها True یان False بێت',
    'confirmed' => ':attribute دووپات کردنەوەکە وەکو یەک نیە.',
    'current_password' => 'وشەی تێپەڕت هەڵەیە.',
    'date' => ':attribute بەروارێکی دروست نیە.',
    'date_equals' => 'پێویستە :attribute یەکسان بێت بە هەمان رۆژی :date.',
    'date_format' => ':attribute وەکو ئەم شێوازە نیە :format.',
    'declined' => 'پێویستە :attribute ڕەتبکرێتەوە.',
    'declined_if' => ':attribute دەبێت رەتبکرێتەوە کاتێک :other :value بێت.',
    'different' => 'پێویستە :attribute و :other جیاوازبن.',
    'digits' => 'پێویستە :attribute ژمارەی ژمارەکانی :digits ژمارە بێت.',
    'digits_between' => 'پێویستە ژمارەی ژمارەکانی :attribute لەنێوان :min و :max بێت.',
    'dimensions' => ':attribute قەبارەی وێنەکە هەڵەیە.',
    'distinct' => 'لە :attribute نرخێکی دووبارە هەیە.',
    'doesnt_end_with' => 'لەوانەیە :attribute بە یەکێک لەمانەی خوارەوە کۆتایی نەهاتبێت: :values.',
    'doesnt_start_with' => 'لەوانەیە :attribute بە یەکێک لەمانەی خوارەوە دەست پێ نەکات: :values.',
    'email' => 'پێویستە :attribute ئیمەیڵێکی دروست بێت.',
    'ends_with' => 'پێویستە :attribute کۆتایی بێت بە یەکێک لە :values ی خوارەوە',
    'enum' => ':attribute هەڵبژێردراو نادروستە.',
    'exists' => ':attribute دروست نیە.',
    'file' => 'پێویستە :attribute فایل بێت',
    'filled' => 'پێویستە :attribute نرخێکی تێدابێت.',
    'gt' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'gte' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'image' => 'دەبێت :attribute وێنە بێت.',
    'in' => ':attribute نادروستە',
    'in_array' => ' :attribute بوونی نیە لە :other.',
    'integer' => 'پێویستە :attribute ژمارە بێت.',
    'ip' => 'پێویستە :attribute ئایپی ئەدرێسێکی دروست بێت.',
    'ipv4' => 'پێویستە :attribute ئایپی ئەدرێسێکی دروستی ڤێرژنی 4 بێت.',
    'ipv6' => 'پێویستە :attribute ئایپی ئەدرێسێکی دروستی ڤێرژنی 6 بێت.',
    'json' => 'پێویستە :attribute کۆدێکی دروستی JSON بێت.',
    'lt' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'lte' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'mac_address' => 'دەبێت :attribute ناونیشانێکی دروستی ماک ئەدرێس بێت.',
    'max' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'max_digits' => 'نابێت :attribute ژمارەی ژمارەکانی لە :max زیاتربێت.',
    'mimes' => ':attribute دەبێت فایلێک بێت لە جۆری: :values.',
    'mimetypes' => ':attribute دەبێت فایلێک بێت لە جۆری: :values.',
    'min' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'min_digits' => 'دەبێت :attribute بەلایەنی کەم ژمارەی ژمارەکانی :min بێت.',
    'multiple_of' => 'دەبێت :attribute چەندجارە بێت لە :value.',
    'not_in' => 'ئەو :attribute هەڵبژێردراوە نادروستە.',
    'not_regex' => 'شێوازی :attribute نادروستە.',
    'numeric' => 'پێویستە :attribute ژمارە بێت.',
    'password' => [
        'letters' => 'دەبێت :attribute لانیکەم یەک پیتی تێدابێت.',
        'mixed' => 'پێویستە :attribute لانیکەم یەک پیتی گەورە و یەک پیتی بچووکی تێدابێت.',
        'numbers' => ':attribute دەبێت لانیکەم یەک ژمارەی تێدابێت.',
        'symbols' => 'دەبێت :attribute لانیکەم یەک هێمای تێدابێت.',
        'uncompromised' => ':attribute ی پێدراو لە دزەکردنی داتادا دەرکەوتووە. تکایە :attribute ێکی جیاواز هەڵبژێرە.',
    ],
    'present' => 'پێویستە :attribute بوونی هەبێت.',
    'prohibited' => 'خانەی :attribute رێپێنەدراوە.',
    'prohibited_if' => 'خانەی :attribute رێپێنەدراوە کاتێک :other :values بێت.',
    'prohibited_unless' => 'خانەی :attribute رێپێنەدراوە مەگەر :other لە :values بێت.',
    'prohibits' => 'خانەی :attribute :other رێپێنەدراوە دەکات لە ئامادەبوون.',
    'regex' => 'شێوازی :attribute هەڵەیە.',
    'required' => ':attribute داواکراوە.',
    'required_array_keys' => 'پێویستە :attribute: :values لەخۆبگرێت.',
    'required_if' => ':attribute داواکراوە کاتێک :other بریتی بێت لە :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => ':attribute داواکراوە مەگەر :other هەبێت لەناو :values.',
    'required_with' => ':attribute داواکراوە کاتێک :values بوونی هەبێت.',
    'required_with_all' => ':attribute داواکراوە کاتێک :values بوونیان هەبێت.',
    'required_without' => ':attribute داواکراوە کاتێک :values بوونی نەبێت.',
    'required_without_all' => ':attribute داواکراوە کاتێک هیچ کام لە :values بوونیان نەبێت.',
    'same' => 'پێویستە :attribute و :other هاوتا بن.',
    'size' => [
        'array' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'file' => 'پێویستە قەبارەی :attribute لەنێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'پێویستە :attribute لەنێوان :min و :max بێت.',
        'string' => 'پێویستە ژمارەی پیتەکانی :attribute لەنێوان :min و :max بێت.',
    ],
    'starts_with' => 'پێویستە :attribute دەست پێبکات بە یەکێک لەمانە :values',
    'string' => 'پێویستە :attribute نووسین بێت.',
    'timezone' => 'پێویستە :attribute شوێنکاتی دروست بێت.',
    'unique' => ':attribute پێشتر گیراوە.',
    'uploaded' => 'بەرزبوونەوەی :attribute سەرکەوتوو نەبوو.',
    'url' => 'جۆری :attribute دروست نیە.',
    'uuid' => ' :attribute پێویستە uuidی گونجاو بێت.',

    'difference_between.min' => 'بەلایەنی کەم پێویستە یەک رۆژ هەڵبژێریت.',
    'difference_between.max' => 'بەکارهێنانی داتا ئەتوانرێ تەنها بۆ ٩٠ رۆژ پێش ئێستا پیشانبدرێت.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
