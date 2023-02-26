<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRankException;
use App\Exceptions\InvalidSuitException;
use App\Http\Requests\HandRequest;
use App\Models\Card;
use App\Models\Hand;
use App\Services\HandEvaluatorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{

    /**
     * @return Factory|View|Application
     */
    public function showForm(): Factory|View|Application
    {
        return view('home');
    }

    /**
     * @param HandRequest $request
     * @return Factory|View|Application
     */
    public function evaluate(HandRequest $request): Factory|View|Application
    {
        try {
            $cards = $request->validationData()['cards'];
            $hand = new Hand($this->formatCards($cards));
            $handEvaluator = new HandEvaluatorService($hand);
            $evaluation = $handEvaluator->evaluateHand();
            return view('home', compact('evaluation'));
        } catch (InvalidRankException|InvalidSuitException $e) {
            $error = $e->getMessage();
            return view('home', compact('error'));
        }
    }

    public function evaluateApi(HandRequest $request): JsonResponse
    {
        $cards = $request->validationData()['cards'];
        $hand = new Hand($this->formatCards($cards));
        $handEvaluator = new HandEvaluatorService($hand);
        $evaluation = $handEvaluator->evaluateHand();

        $response = [
            'success' => true,
            'message' => $evaluation,
        ];
        return response()->json($response);

    }

    /**
     * @param string $hand
     * @return array
     * @throws InvalidRankException|InvalidSuitException
     */
    protected function formatCards(string $hand): array
    {
        $cards = explode(' ', $hand);
        $cardsArray = [];
        foreach ($cards as $card) {
            $cardsArray[] = new Card(substr($card, 0, -1), substr($card, -1));
        }

        return $cardsArray;
    }
}
