<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentTypeController extends Controller
{
    public function index($user)
    {
        // Step 1: Handle special cases based on office
        if ($user->office->id == 18) {
            return DocumentType::whereIn('id', [1, 2, 3, 4, 5])->get();
        } elseif ($user->office->office_type == 'ADMIN') {
            return DocumentType::whereIn('id', [1, 2, 3, 5])->get();
        } elseif ($user->office->office_type == 'ACAD') {
            return DocumentType::whereIn('id', [1, 3, 5, 6])->get();
        }

        // Step 2: Handle role-based permissions
        $allowedIds = DB::table('role_document_types')
            ->where('role_id', $user->role_id)
            ->where('is_allowed', true)
            ->pluck('document_type_id');

        if ($allowedIds->isNotEmpty()) {
            return DocumentType::whereIn('id', $allowedIds)->get();
        }

        // Step 3: Default fallback
        return DocumentType::all();
    }
}
