<?php

namespace App\Models\Section;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory, Translatable;
    protected $table = 'sections';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'section_id';
}
