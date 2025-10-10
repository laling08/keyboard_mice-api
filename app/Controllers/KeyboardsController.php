<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Models\KeyboardsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class KeyboardsController extends BaseController
{
    public function __construct(private KeyboardsModel $keyboards_model) {}

    /**
     * Handles GET /keyboards/{keyboard_id}
     * Returns a paginated list of keyboards with optional filters
     * @param \Psr\Http\Message\ServerRequestInterface $request The HTTP request
     * @param \Psr\Http\Message\ResponseInterface $response The HTTP response
     * @return Response JSON response containing the filtered keyboard data.
     */
    public function handleGetKeyboards (Request $request, Response $response): Response
    {
        //* Step 1: Get filters from query string
        $filters = $request->getQueryParams();

        //* Step 2: Pass filters to model
        $keyboards = $this->keyboards_model->getKeyboards($filters);

        //* Step 3: Return JSON response
        return $this->renderJson($response, $keyboards);

    }

    public function handleGetKeyboardById (
        Request $request,
        Response $response,
        array $uri_args
    ) : Response {

        //* Step 1: Get ID from URI
        $keyboard_id = (int) $uri_args["keyboard_id"];

        //* Step 2: Fetch from database
        $keyboard = $this->keyboards_model->findKeyboardById($keyboard_id);

        //* Step 3: Handle not found
        if ($keyboard === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Keyboard not found with ID: " . $keyboard_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        return $this->renderJson($response, $keyboard);
    }

}
