<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Định rõ bảng
    protected $table = 'permissions';

    // Định rõ khóa chính
    protected $primaryKey = 'id';

    // Các cột có thể gán giá trị
    protected $fillable = [
        'name',
        'guard_name',
    ];

    // Các cột không được gán giá trị
    protected $guarded = [];
}
