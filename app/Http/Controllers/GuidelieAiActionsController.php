<?php

namespace App\Http\Controllers;

use App\Services\GuidelieAiActionsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuidelieAiActionsController extends Controller
{
    public function __construct(private readonly GuidelieAiActionsService $service) {}

    public function index(): View
    {
        return view('guidelie_ai_actios');
    }

    public function ask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:2000'],
        ]);

        return response()->json(
            $this->service->answer($validated['question'])
        );
    }
}
